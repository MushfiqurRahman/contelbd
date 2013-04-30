<?php
App::uses('AppController', 'Controller');
/**
 * Coupons Controller
 *
 * @property Coupon $Coupon
 */
class CouponsController extends AppController {
    
    /**
     *
     * @return array
     */
    protected function _get_contain_array(){
        
        return array(            
                    'Outlet' => array(
                        'fields' => array('title'),
                        'House' => array(
                            'fields' => array('title'),
                            'Area' => array(
                                'fields' => array('title'),
                                'Region' => array(
                                    'fields' => array('title')
                                )
                            )
                        )
                    ),
                    'Section' => array('title'),
                    'Representative' => array('name'),
                );        
    }

    /**
 * index method
 *
 * @return void
 */
	public function index() {
            
            //pr($this->request->data);

            $this->_set_request_data_from_params();
            $titles = $this->Coupon->Outlet->House->Area->Region->get_titles($this->request->data);                            
            
            $this->Coupon->Behaviors->load('Containable');
            
            $this->paginate = array(
                'contain' => $this->_get_contain_array(),
                'conditions' => $this->_set_condition(),
                'limit' => 1                
            );
            $this->set('houses', $this->Coupon->Outlet->House->house_list( $this->request->data));
            $this->set('total_outlet',$this->total_outlet);       
            $this->set('titles', $titles);
            $this->set('data',$this->request->data);
            $this->set('coupons', $this->paginate());
	}
        
        /**
         * 
         */
        public function coupon_point_till_date(){
            $titles = $this->Coupon->Outlet->House->Area->Region->get_titles($this->request->data);  
            
            $this->Coupon->Behaviors->load('Containable');
            
            $this->paginate = array(
                'fields' => array('Coupon.outlet_id','SUM(Coupon.total_score) AS total','SUM(Coupon.first_act_score) AS f_total',
                    'SUM(Coupon.second_act_score) AS sec_total','SUM(Coupon.third_act_score) AS third_total'),
                'contain' => $this->_get_contain_array(),
                'conditions' => $this->_set_condition(),
                'group' => 'Coupon.outlet_id',
                'limit' => 2 
            );
            
            //pr($this->paginate());exit;
            $this->set('total_outlet',$this->total_outlet);       
            $this->set('titles', $titles);
            $this->set('data',$this->request->data);
            $this->set('coupons', $this->paginate());
        }
        
        /**
         *
         * @param type $outletIds
         * @return type 
         */
        protected function _set_condition(){
            
            //when searching for specific house
            if( $this->request->data['House']['id'] ){
                $houseIds = array($this->request->data['House']['id']);
            }//when need to search for all houses
            else{
                $houseIds = $this->Coupon->Outlet->House->get_ids( $this->request->data );
            }
            
            if( !empty($this->request->data['Outlet']['priority']) ){
                $outletList = $this->Coupon->Outlet->find('list', array('conditions' => array(
                    'Outlet.house_id' => $houseIds, 'Outlet.priority' => $this->request->data['Outlet']['priority']
                )));
            }else{
                $outletList = $this->Coupon->Outlet->find('list', array('conditions' => array(
                'Outlet.house_id' => $houseIds
                )));
            }
            
            $outletIds = $this->Coupon->Outlet->id_from_list($outletList);            
            $this->total_outlet = count($outletIds);            
            $this->set('outlet_by_priority',$this->Coupon->Outlet->outlet_by_priority($outletIds));
            
            $conditions = array();
            
            $conditions[]['Coupon.outlet_id'] = $outletIds;
            if( isset($this->request->data['from_date']) && !empty($this->request->data['from_date']) ){
                $conditions[]['Coupon.date >='] = $this->request->data['from_date'];
            }
            if( isset($this->request->data['till_date']) && !empty($this->request->data['till_date']) ){
                $conditions[]['Coupon.date <='] = $this->request->data['till_date'];
            }                        
            return $conditions;
        }
        
        /**
         * 
         */
        public function get_report(){
            $this->layout = 'ajax';
            $this->Coupon->Behaviors->load('Containable');
            
            $coupons = $this->Coupon->find('all', array(                
                'contain' => $this->_get_contain_array(),
                'conditions' => $this->_set_condition(),
            ));
            
            $coupons = $this->_format_for_report($coupons);
            
            //pr($coupons);exit;
            
            $this->set('coupons', $coupons);            
        }
        
        /**
         * 
         */
        public function get_report_till_date(){
            $this->layout = 'ajax';
            $this->Coupon->Behaviors->load('Containable');
            
            $coupons = $this->Coupon->find('all', array(
                'fields' => array('Coupon.outlet_id','SUM(Coupon.total_score) AS total','SUM(Coupon.first_act_score) AS f_total',
                    'SUM(Coupon.second_act_score) AS sec_total','SUM(Coupon.third_act_score) AS third_total'),
                'contain' => $this->_get_contain_array(),
                'conditions' => $this->_set_condition(),
                'group' => 'Coupon.outlet_id'
            ));            
            $coupons = $this->_format_for_report($coupons);
            
            $this->set('coupons', $coupons);
        }
        
        /**
         *
         * @param type $coupons
         * @return type 
         */
        protected function _format_for_report( $coupons ){
            pr($coupons);
            $formatted = array();
            $i = 0;
            foreach( $coupons as $coupon ){
                $formatted[$i]['region'] = $coupon['Outlet']['House']['Area']['Region']['title'];
                $formatted[$i]['area'] = $coupon['Outlet']['House']['Area']['title'];
                $formatted[$i]['house'] = $coupon['Outlet']['House']['title'];
                $formatted[$i]['outlet'] = $coupon['Outlet']['title'];
                $formatted[$i]['representative'] = $coupon['Representative']['name'];
                $formatted[$i]['total_point'] = $coupon[0]['total'];
                $formatted[$i]['total_first_kpi'] = $coupon[0]['f_total'];
                $formatted[$i]['total_second_kpi'] = $coupon[0]['sec_total'];
                $formatted[$i]['total_third_kpi'] = $coupon[0]['third_total'];
                $i++;
            }
            return $formatted;
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Coupon->exists($id)) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		$options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
		$this->set('coupon', $this->Coupon->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    $this->request->data['Coupon']['date_time'] = strtotime($this->request->data['Coupon']['date_time']);
			$this->Coupon->create();
			if ($this->Coupon->save($this->request->data)) {
				$this->Session->setFlash(__('The coupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon could not be saved. Please, try again.'));
			}
		}
		$representatives = $this->Coupon->Representative->find('list');
		$outlets = $this->Coupon->Outlet->find('list');
		$sections = $this->Coupon->Section->find('list');
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
		if (!$this->Coupon->exists($id)) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Coupon->save($this->request->data)) {
				$this->Session->setFlash(__('The coupon has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The coupon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Coupon.' . $this->Coupon->primaryKey => $id));
			$this->request->data = $this->Coupon->find('first', $options);
		}
		$representatives = $this->Coupon->Representative->find('list');
		$outlets = $this->Coupon->Outlet->find('list');
		$sections = $this->Coupon->Section->find('list');
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
		$this->Coupon->id = $id;
		if (!$this->Coupon->exists()) {
			throw new NotFoundException(__('Invalid coupon'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Coupon->delete()) {
			$this->Session->setFlash(__('Coupon deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Coupon was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
