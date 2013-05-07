<?php
App::uses('AppController', 'Controller');
/**
 * Campaigns Controller
 *
 * @property Campaign $Campaign
 */
class CampaignsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
            
            $this->set('campaigns',$this->Campaign->find('list',array('conditions' => 
                $this->Campaign->set_conditions($this->request->data))));
	}
        
        /**
         * This is used in the target_vs_achieve() method 
         */
        protected function _set_trgt_vs_achv_params(){
            if( !empty($this->request->params['named']) ){
                if( isset($this->request->params['named']['campaign_id']) ){
                    $this->request->data['Campaign']['id'] = $this->request->params['named']['campaign_id'];
                }
                if( isset($this->request->params['from']) ){
                    $this->request->data['Campaign']['from'] = $this->request->params['named']['from'];
                }
                if( isset($this->request->params['to']) ){
                    $this->request->data['Campaign']['to'] = $this->request->params['named']['to'];
                }
            }
        }
        
        public function export_achievement(){
            $this->layout = 'ajax';
            $outletIds = $this->Campaign->Base->find('list', array('conditions' => array('Base.campaign_id' => $this->request->data['Campaign']['id']),
                    'fields' => array('Base.outlet_id')));
            
            $this->loadModel('Sale');
            $this->Sale->Behaviors->load('Containable');

            $sales = $this->Sale->find('all',array(
                    'fields' => $this->Sale->make_total_fields(),
                    'contain' => $this->Sale->get_contain_array(),                
                    'conditions' => array('Sale.outlet_id' => $outletIds,
                        'Sale.date_time >=' => $this->request->data['Campaign']['from'],
                        'Sale.date_time <=' => $this->request->data['Campaign']['to']),
                    'group' => 'Sale.outlet_id'
                )
            );  
            $exportable = array();
            $i = 0;
            
            foreach( $sales as $sale ){
                $exportable[$i]['region'] = $sale['Outlet']['House']['Area']['Region']['title'];
                $exportable[$i]['area'] = $sale['Outlet']['House']['Area']['title'];
                $exportable[$i]['house'] = $sale['Outlet']['House']['title'];
                $exportable[$i]['outlet'] = $sale['Outlet']['title'];
                
                for($j=0;$j<11;$j++){
                    $exportable[$i]['b'.($j+1)] = $sale[0]['total_b'.($j+1)];
                }
                $i++;                
            }
            $this->set('sales', $exportable);
        }
        
        /**
         * 
         */
        public function target_vs_achieve(){
            //$this->set('data',$this->request->data);
            $campaigns = $this->Campaign->find('list',array('conditions' => $this->Campaign->set_conditions($this->request->data)));
            $this->set('campaigns', $campaigns);
            
            //pr($campaigns);
            
            //pr($this->request->data);           
            
            if( $this->request->is('post') ){
                if( !isset($this->request->data['Campaign']['id']) ){
                    $this->_get_campaigns_sale($campaigns);
                }else{
                    $u = array('action' => 'target_vs_achieve');
                    $this->request->data['Campaign']['from'] = empty($this->request->data['Campaign']['from']) ? 
                        $this->Campaign->field('start_date',array('Campaign.id',$this->request->data['Campaign']['id'])) : 
                        strtotime($this->request->data['Campaign']['from']);

                    $this->request->data['Campaign']['to'] = empty($this->request->data['Campaign']['to']) ? time() : strtotime($this->request->data['Campaign']['to']);                

                    $this->redirect( array_merge($u, $this->request->data['Campaign']));
                }
            
            }else{                
                $this->_get_campaigns_sale($campaigns);
            }
        }
        
        /**
         * 
         */
        protected function _get_campaigns_sale($campaigns){
            
            $conditions = array();
            if( isset($this->request->params['named']['id']) ){
                $conditions = array('Base.campaign_id' => $this->request->params['named']['id']);
            }else{
                $conditions = array('Base.campaign_id' => $campaigns );
            }
            
            $outletIds = $this->Campaign->Base->find('list', array('conditions' => $conditions,
                'fields' => array('Base.outlet_id')));

            //pr($outletIds);

            $this->loadModel('Sale');
            $this->Sale->Behaviors->load('Containable');
            
            $conditions = array('Sale.outlet_id' => $outletIds);            
            $conditions['Sale.date_time >='] = isset($this->request->params['named']['from'])?$this->request->params['named']['from']:0;
            $conditions['Sale.date_time <='] = isset($this->request->params['named']['to'])?$this->request->params['named']['to']:time();
            

            $this->paginate = array(
                'Sale' => array(      
                    'fields' => $this->Sale->make_total_fields(),
                    'contain' => $this->Sale->get_contain_array(),                
                    'conditions' => $conditions,
                    'group' => 'Sale.outlet_id',
                    'limit' => 50
                )
            );

            $sales = $this->paginate('Sale');
            $this->set('sales', $sales);
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Campaign->exists($id)) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		$options = array('conditions' => array('Campaign.' . $this->Campaign->primaryKey => $id));
		$this->set('campaign', $this->Campaign->find('first', $options));
	}
        
        protected function _set_request_data_from_params(){
            $this->request->data['Region']['id'] = str_replace('region_id=','',$this->request->params['pass'][0]);
            $this->request->data['Area']['id'] = str_replace('area_id=','',$this->request->params['pass'][1]);
            $this->request->data['House']['id'] = str_replace('house_id=','',$this->request->params['pass'][2]);
            $this->request->data['from_date'] = str_replace('from_date=','',$this->request->params['pass'][3]);
            $this->request->data['till_date'] = str_replace('till_date=','',$this->request->params['pass'][4]);
            
            $this->request->data['from_date'] = date('Y-m-d H:i:s', $this->request->data['from_date']);
            $this->request->data['till_date'] = date('Y-m-d H:i:s', $this->request->data['till_date']);
        }
        
        /**
         *
         * @return type 
         */
        protected function calculate_base(){
            
            $this->_set_request_data_from_params(); 
            
            $days = 1;
            
            $this->loadModel('Sale');
            
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
                'group' => 'Sale.outlet_id'
            ));
            
            //pr($sales);
            
            $bases = array();
            $i = 0;
            
            foreach( $sales as $sale ){
                foreach( $sale[0] as $k => $bs ){
                    $bases[$i][$k] = $bs;
                }
                $bases[$i]['outlet_id'] = $sale['Outlet']['id'];
                $i++;
            }
            return $bases;
        }
        
        /**
         * 
         */
        protected function _unset_fields(){
            
            if( empty($this->request->data['Region']['id']) ){
                unset($this->request->data['Region']);
            }
            if( empty($this->request->data['Area']['id']) ){
                unset($this->request->data['Area']);
            }
            if( empty($this->request->data['House']['id']) ){
                unset($this->request->data['House']);
            }
        }

/**
 * add method
 *
 * @return void 
 */
	public function add() {
            //pr($this->request->params);exit;
            if ($this->request->is('post')) {
                $this->request->data['Base'] = $this->calculate_base();
                
                $this->_unset_fields();
                
                $this->Campaign->create();
                if ($this->Campaign->saveAll($this->request->data) ){                    
                    $this->redirect(array('action' => 'target/'.$this->Campaign->getLastInsertID()));                    
                } else {                    
                    $this->Session->setFlash(__('The campaign could not be saved. Please, try again.'));
                }
            }
            $areas = $this->Campaign->Area->find('list');
            $this->set(compact('areas'));
	}
        
        public function target(){            
            if( $this->params->pass[0] ){
                $target_details = $this->Campaign->calculate_target($this->params->pass[0]);
                $this->set('target_details', $target_details);                
            }
        }
        
        /**
         *
         * @param type $id 
         */
        public function target_report(){
            $this->layout = 'ajax';
            
            if( $this->request->data['Campaign']['campaign_id'] ){
                $target_details = $this->Campaign->calculate_target($this->request->data['Campaign']['campaign_id']);
                $this->set('target_details', $target_details);                
            }
        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Campaign->exists($id)) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Campaign->save($this->request->data)) {
				$this->Session->setFlash(__('The campaign has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The campaign could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Campaign.' . $this->Campaign->primaryKey => $id));
			$this->request->data = $this->Campaign->find('first', $options);
		}
		$areas = $this->Campaign->Area->find('list');
		$this->set(compact('areas'));
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
		$this->Campaign->id = $id;
		if (!$this->Campaign->exists()) {
			throw new NotFoundException(__('Invalid campaign'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Campaign->delete()) {
			$this->Session->setFlash(__('Campaign deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Campaign was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}