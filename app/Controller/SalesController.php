<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 */
class SalesController extends AppController {
    
    public $helpers = array('Excel');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
    }


    //public $uses = array('Sale','House');
    
    
    
    /**
     * 
     */
    protected function _set_request_data_from_params(){
        
        if( !$this->request->is('post') && !empty($this->request->params['named'])){
            $this->request->data['Region']['id'] = $this->request->params['named']['region_id'];
            $this->request->data['Area']['id'] = $this->request->params['named']['area_id'];
            $this->request->data['House']['id'] = $this->request->params['named']['house_id'];
            
            if( isset($this->request->params['named']['house_id']) ){
                $this->request->data['House']['id'] = $this->request->params['named']['house_id'];
            }
            if( isset($this->request->params['named']['representative_id']) ){
                $this->request->data['Representative']['id'] = $this->request->params['named']['representative_id'];
            }
            if( isset($this->request->params['named']['section_id']) ){
                $this->request->data['Section']['id'] = $this->request->params['named']['section_id'];
            }
            if( isset($this->request->params['named']['outlet_id']) ){
                $this->request->data['Outlet']['id'] = $this->request->params['named']['outlet_id'];
            }
            if( isset($this->request->params['named']['from_date']) ){
                $this->request->data['from_date'] = $this->request->params['named']['from_date'];
            }
            if( isset($this->request->params['named']['till_date']) ){
                $this->request->data['till_date'] = $this->request->params['named']['till_date'];
            }
        } 
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
            
                $this->_set_request_data_from_params();

                $titles = $this->Sale->Outlet->House->Area->Region->get_titles($this->request->data);

                $houseIds = $this->Sale->Outlet->House->get_ids( $this->request->data);                

                $repList = $this->Sale->Representative->find('list',array('conditions' => array(
                    'Representative.house_id' => $houseIds, 'Representative.type' => 'Sales'
                )));

                $secList = $this->Sale->Section->find('list', array('conditions' => array(
                    'Section.house_id' => $houseIds
                )));

                $outletList = $this->Sale->Outlet->find('list', array('conditions' => array(
                    'Outlet.house_id' => $houseIds
                )));

                $outletIds = $this->Sale->Outlet->id_from_list($outletList);                                

                $this->set('titles', $titles);            
//                $this->set('representatives',$repList);
//                $this->set('sections', $secList);
//                $this->set('outlets', $outletList);
                $this->set('outlet_by_priority',$this->Sale->Outlet->outlet_by_priority($outletIds));
                $this->set('house_id', str_replace('"','\"',serialize($houseIds)));
                $this->set('houses', $this->Sale->Outlet->House->house_list( $this->request->data));
                
                $this->Sale->Behaviors->load('Containable');
                $this->paginate = array(
                    'contain' => $this->Sale->get_contain_array(),
                    'conditions' => $this->Sale->set_conditions($outletIds, $this->request->data),
                    'limit' => 1
                );
                
                $this->_format_date_fields();

                $this->set('sales', $this->paginate());
	}
        
        /**
         * 
         */
        public function calculate_base(){
            
            $this->_set_request_data_from_params(); 
            
            $days = 1;
            
            $titles = $this->Sale->Outlet->House->Area->Region->get_titles($this->request->data);
            
            $houseIds = $this->Sale->Outlet->House->get_ids( $this->request->data);
            
            $outletList = $this->Sale->Outlet->find('list', array('conditions' => array(
                'Outlet.house_id' => $houseIds
            )));           
            
            $outletIds = $this->Sale->Outlet->id_from_list($outletList);
            
            $this->total_outlet = count($outletIds);
            
            //pr($outletIds);exit;
         
            $this->Sale->Behaviors->load('Containable');
            $this->paginate = array(      
                'fields' => $this->Sale->make_base_fields( $this->_day_interval()),
                'contain' => $this->Sale->get_contain_array(),
                'conditions' => $this->Sale->set_conditions($outletIds),
                'limit' => 1,
                'group' => 'Sale.outlet_id'
            );
            $sales = $this->paginate();

            $sales = $this->Sale->fill_essential_fields($sales);            
            $this->_format_date_fields();
            
            $this->set('titles', $titles); 
            //$this->set('data',$this->request->data);
            $this->set('total_outlet', $this->total_outlet);
            $this->set('outlet_by_priority',$this->Sale->Outlet->outlet_by_priority($outletIds));
            $this->set('sales', $sales);
        }
        
        
        /**
         * 
         */
        public function export_calculated_base(){
            
            $this->layout = 'ajax';
            
            $this->_set_request_data_from_params(); 
            
            $days = 1;
            
            $houseIds = $this->Sale->Outlet->House->get_ids( $this->request->data);            
            $outletList = $this->Sale->Outlet->find('list', array('conditions' => array(
                'Outlet.house_id' => $houseIds
            )));            
            $outletIds = $this->Sale->Outlet->id_from_list($outletList);
         
            $this->Sale->Behaviors->load('Containable');
            $sales = $this->Sale->find('all', array(      
                'fields' => $this->Sale->make_base_fields( $this->_day_interval()),
                'contain' => $this->Sale->get_contain_array(),
                'conditions' => $this->Sale->set_conditions($outletIds),
                'limit' => 1,
                'group' => 'Sale.outlet_id'
            ));
            
            //$campaign_id = $this->Sale->Outlet->Base->save_bases( $sales );
            $sales = $this->Sale->fill_essential_fields($sales);
            $sales = $this->Sale->format_report($sales, 'base');
            $this->set('sales', $sales);
            //$this->set('campaign_id', $campaign_id);
        }
        
        /**
         * 
         */
        public function get_report(){ 
            
            $this->layout = 'ajax';           
            
            if( !empty($this->request->data) ){

                $this->Sale->Behaviors->load('Containable');                
                
                $sales = $this->Sale->find('all', array(
                    'contain' => $this->Sale->get_contain_array(),
                    'conditions' => $this->Sale->set_conditions()));                
                
                $sales = $this->Sale->format_report($sales);
                
                $this->set('sales',$sales);                
            }
        }
        
        
        
        /**
         *
         * @return type 
         */
//        protected function _set_conditions( $outletIds = null ){
//            $conditions = array();
//            if( !empty($this->request->data['Representative']['id']) ){
//                $conditions[]['Sale.representative_id'] = $this->request->data['Representative']['id'];
//            }
//            if( !empty($this->request->data['Section']['id']) ){
//                $conditions[]['Sale.section_id'] = $this->request->data['Section']['id'];
//            }
//            
//            if( !empty($this->request->data['Outlet']['id'])){
//                $conditions[]['Sale.outlet_id'] = $this->request->data['Outlet']['id'];
//            }else if( $outletIds ){
//                $conditions[]['Sale.outlet_id'] = $outletIds;
//                $this->total_outlet = count($outletIds);
//            }
//            if( !empty($this->request->data['from_date']) ){
//                $conditions[]['date_time >='] = strtotime($this->request->data['from_date']);
//            }
//            if( !empty($this->request->data['till_date']) ){
//                $conditions[]['date_time <='] = strtotime($this->request->data['till_date']);
//            }            
//            return $conditions;
//        }

        /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
		$this->set('sale', $this->Sale->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    if( !empty($this->request->data['Sale']['date_time'])){
                        $this->request->data['Sale']['date_time'] = strtotime($this->request->data['Sale']['date_time']);
                    }
			$this->Sale->create();
			if ($this->Sale->save($this->request->data)) {
				$this->Session->setFlash(__('The sale has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		}
		$representatives = $this->Sale->Representative->find('list');
		$outlets = $this->Sale->Outlet->find('list');
		$sections = $this->Sale->Section->find('list');
		$this->set(compact('representatives', 'outlets', 'sections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Sale->exists($id)) {
			throw new NotFoundException(__('Invalid sale'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sale->save($this->request->data)) {
				$this->Session->setFlash(__('The sale has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sale could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
			$this->request->data = $this->Sale->find('first', $options);
		}
		$representatives = $this->Sale->Representative->find('list');
		$outlets = $this->Sale->Outlet->find('list');
		$sections = $this->Sale->Section->find('list');
		$this->set(compact('representatives', 'outlets', 'sections'));
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
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid sale'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sale->delete()) {
			$this->Session->setFlash(__('Sale deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sale was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
