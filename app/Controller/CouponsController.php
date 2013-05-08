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
                'limit' => 50                
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
                'limit' => 50 
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
            
            $coupons = $this->_format_for_report($coupons, null);
            
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
        protected function _format_for_report( $coupons, $report_type = 'full' ){
            //pr($coupons);
            $formatted = array();
            $i = 0;
            foreach( $coupons as $coupon ){
                $formatted[$i]['region'] = $coupon['Outlet']['House']['Area']['Region']['title'];
                $formatted[$i]['area'] = $coupon['Outlet']['House']['Area']['title'];
                $formatted[$i]['house'] = $coupon['Outlet']['House']['title'];
                $formatted[$i]['outlet'] = $coupon['Outlet']['title'];
                $formatted[$i]['representative'] = $coupon['Representative']['name'];
                if( $report_type=='full' ){
                    $formatted[$i]['total_point'] = $coupon[0]['total'];
                    $formatted[$i]['total_redeemed'] = $coupon[0]['f_total'] + $coupon[0]['sec_total'] + $coupon[0]['third_total'] - $coupon[0]['total'];
                    $formatted[$i]['total_first_kpi'] = $coupon[0]['f_total'];
                    $formatted[$i]['total_second_kpi'] = $coupon[0]['sec_total'];
                    $formatted[$i]['total_third_kpi'] = $coupon[0]['third_total'];
                }else{
                    $formatted[$i]['total_point'] = $coupon['Coupon']['total_score'];
                    $formatted[$i]['total_redeemed'] = $coupon['Coupon']['first_act_score'] + $coupon['Coupon']['second_act_score'] + $coupon['Coupon']['third_act_score'] - $coupon['Coupon']['total_score'];
                    $formatted[$i]['first_kpi'] = $coupon['Coupon']['first_act_score'];
                    $formatted[$i]['second_kpi'] = $coupon['Coupon']['second_act_score'];
                    $formatted[$i]['third_kpi'] = $coupon['Coupon']['third_act_score'];
                }
                $i++;
            }
            return $formatted;
        }
        
        /**
         * This method exports a xls file for each day. This report is used to send bulk sms to outlet owner
         * Xls should contain the outlet owners mobile no and sms sent to tsa for this outlet coupon request
         */
        public function each_day_report(){            
            $this->layout = 'ajax';
            
            $data = $this->Coupon->query('SELECT mt_logs.outlet_id, mt_logs.sms, outlets.phone_no
                FROM mt_logs LEFT JOIN outlets
                ON mt_logs.outlet_id = outlets.id WHERE mt_logs.keyword="CUP" AND DATE(mt_logs.datetime)="'.
                    date('Y-m-d').'"');
            
            $outlets_n_sms = array();
            
            if( count($data)>0 ){           
                $i = 0;
                foreach( $data as $dt ){                    
                    if( !empty($dt['outlets']['phone_no']) ){
                        $outlets_n_sms[$i]['outlet_phone_no'] = $dt['outlets']['phone_no'];
                        $outlets_n_sms[$i]['sms'] = $dt['mt_logs']['sms'];
                        $i++;
                    }
                }
            }            
            $this->set('outlets_n_sms',$outlets_n_sms);            
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
