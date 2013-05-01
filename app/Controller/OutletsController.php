<?php
App::uses('AppController', 'Controller');
/**
 * Outlets Controller
 *
 * @property Outlet $Outlet
 */
class OutletsController extends AppController {

    public $helpers = array('Excel');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Outlet->recursive = 0;
		$this->set('outlets', $this->paginate());
	}
        
        /**
         *
         * @param type $sales 
         */
        protected function _make_products_sum( $sales ){
            $productsList = $this->Outlet->Sale->SaleDetail->Product->find('list',array('fields' => array('id','name')));
            $productsSum = array();
            
            foreach( $productsList as $k => $pd ){
                $productsSum[$k]['name'] = $pd;
                $productsSum[$k]['quantity'] = 0;
            }
            //pr($productsSum);exit;
            //pr($sales);
            foreach( $sales as $v ){
                if( isset($v['Sale'][0]['SaleDetail']) && !empty($v['Sale'][0]['SaleDetail']) ){
                    foreach( $v['Sale'][0]['SaleDetail'] as  $sld ){
                        $productsSum[$sld['product_id']]['quantity'] += $sld['quantity'];
                    }            
                }
            }
            return $productsSum;
        }
        
        public function sales_report(){
            $this->_set_request_data_from_params();

            $titles = $this->Outlet->House->Area->Region->get_titles($this->request->data);

            $houseIds = $this->Outlet->House->get_ids( $this->request->data);
            $outletList = $this->Outlet->find('list', array('conditions' => array(
                'Outlet.house_id' => $houseIds
            )));
            $outletIds = $this->Outlet->id_from_list($outletList);
            $this->Outlet->Behaviors->load('Containable');
            
                $this->paginate = array(
                    'contain' => array(    
                        'Sale' => array(
                            'fields' => array('Sale.outlet_id','Sale.id','Sale.date'),
                            'conditions' => array('DATE(Sale.date) <=' =>  '2013-04-30','DATE(Sale.date) >=' => '2013-04-28'),
                            'Representative' => array(
                                'fields' => array('id','name'),
                            ),
                            'SaleDetail' => array(
                                'fields' => array('sale_id','product_id','quantity')
                            )
                        ),
                        'Section' => array(
                            'fields' => array('id','title')
                        ),
                        'House' => array(
                            'fields' => array('House.id','House.title'),
                            'Area' => array(
                                'fields' => array('Area.id','Area.title'),
                                'Region' => array('fields' => array('Region.id','Region.title'))
                            )
                        ),                        
                    ),
                    'fields' => array('id','house_id','title','outlet_retailer_name'),
                    'conditions' => array('Outlet.id' => $outletIds),
                    'limit' => 1,                    
                );
                $sales = $this->paginate();
                $productsSum = $this->_make_products_sum($sales);
                
                $this->_format_date_fields();
                
                $this->set('titles', $titles);
                $this->set('outlet_by_priority',$this->Outlet->outlet_by_priority($outletIds));
                $this->set('house_id', str_replace('"','\"',serialize($houseIds)));
                $this->set('houses', $this->Outlet->House->house_list( $this->request->data));
                $this->set('sales', $sales);
                $this->set('productsSum',$productsSum);
        }
        
        /**
         * 
         */
        public function ajax_outlet_list(){
            $this->autoRender = $this->layout = false;
            if( !empty($_POST['house_id']) ){
                $_POST['house_id'] = str_replace('\"', '"', $_POST['house_id']);
            }
            
            if( !empty($_POST['house_id']) && !empty($_POST['section_id']) ){
                $conditions = array('Outlet.house_id' => unserialize($_POST['house_id']), 'Outlet.section_id' => $_POST['section_id']);
            }else if( !empty($_POST['house_id']) ){
                $conditions = array('Outlet.house_id' => unserialize($_POST['house_id']));
            }else if( !empty($_POST['section_id']) ){
                $conditions = array('Outlet.section_id' => $_POST['section_id']);
            }else{
                $conditions = array();
            }           
            $outlets = $this->Outlet->find('list', array('conditions' => $conditions));
            echo json_encode($outlets);
            
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Outlet->exists($id)) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		$options = array('conditions' => array('Outlet.' . $this->Outlet->primaryKey => $id));
		$this->set('outlet', $this->Outlet->find('first', $options));
	}
        
        /**
         * 
         */
        protected function _check_mobile_nos(){
                                    
            if( !empty($this->request->data['Outlet']['phone_no']) ){
                if( strpos($this->request->data['Outlet']['phone_no'], '88')!==0 ){
                    $this->request->data['Outlet']['phone_no'] = '88'.$this->request->data['Outlet']['phone_no'];
                }
            }
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $this->_check_mobile_nos();
			$this->Outlet->create();
                        
			if ($this->Outlet->save($this->request->data)) {
				$this->Session->setFlash(__('The outlet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlet could not be saved. Please, try again.'));
			}
		}
		$sections = $this->Outlet->Section->find('list');
		$houses = $this->Outlet->House->find('list');
		$this->set(compact('sections', 'houses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Outlet->exists($id)) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $this->_check_mobile_nos();
			if ($this->Outlet->save($this->request->data)) {
				$this->Session->setFlash(__('The outlet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Outlet.' . $this->Outlet->primaryKey => $id));
			$this->request->data = $this->Outlet->find('first', $options);
		}
		$sections = $this->Outlet->Section->find('list');
		$houses = $this->Outlet->House->find('list');
		$this->set(compact('sections', 'houses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Outlet->id = $id;
		if (!$this->Outlet->exists()) {
			throw new NotFoundException(__('Invalid outlet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Outlet->delete()) {
			$this->Session->setFlash(__('Outlet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Outlet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
