<?php
App::uses('AppModel', 'Model');
/**
 * Campaign Model
 *
 * @property Area $Area
 */
class Campaign extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';
        public $last_inserted_id;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
		),
		'end_date' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
		),
//		'trgt_b1' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b2' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b3' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b4' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b5' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b6' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b7' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b8' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b9' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b10' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
//		'trgt_b11' => array(
//			'numeric' => array(
//				'rule' => array('numeric'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
            'Region' => array(
              'className' => 'Region',
                'foreignKey' => 'region_id'
            ),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
                'House' => array(
                    'className' => 'House',
                    'foreignKey' => 'house_id'
                )
	);
        
        public $hasMany = array(
          'Base' => array(
              'className' => 'Base',
              'foreignKey' => 'campaign_id'
          )  
        );
        
        public function set_conditions( $data = array() ){
            $conditions = array();
            if( !empty($data['Region']['id']) ){
                $conditions['region_id'] = $data['Region']['id'];
                
                if( !empty($data['Area']) ){
                    $conditions['area_id'] = $data['Area']['id'];
                    
                    if( !empty($data['House']['id']) ){
                        $conditions['house_id'] = $data['House']['id'];
                    }
                }
            }else if( isset($data['Region']['id']) ){
                $conditions['id >'] = 0;
            }//so that no campaigns can be found
            else{
                $conditions['id <'] = 1;
            }
            return $conditions;
        }
        
        public function achievement( $data ){
            $this->Behaviors->load('Containable');
            $outletIds = $this->Base->find('list', array('conditions' => array('Base.campaign_id' => $data['Campaign']['id'])));
//            pr( $this->Base->Outlet->Sale->find('all', array('fields' => 
//                $this->Base->Outlet->Sale->make_total_fields(),                
//                'conditions' => array( 'Sale.outlet_id' => $outletIds,
//                    'Sale.date_time >' => $data['Campaign']['from'],
//                    'Sale.date_time <' => $data['Campaign']['to']))));exit;
            
            pr($this->query('Select * from sales as Sale left join outlets as Outlet ON Sale.outlet_id = 
                Outlet.id Left join houses as House ON Outlet.house_id = House.id Left join areas as Area
                On House.area_id = Area.id Left join regions as Region ON Area.region_id = Region.id'));
            
        }
        
        /**
         *
         * @param type $options
         * @return boolean 
         */
        public function beforeSave($options = array()) {
            $this->data['Campaign']['start_date'] = strtotime($this->data['Campaign']['start_date']);
            $this->data['Campaign']['end_date'] = strtotime($this->data['Campaign']['end_date']);
            //unset($this)
            
            for($i=1;$i<=11;$i++){
                if( empty($this->data['Campaign']['trgt_b'.$i]) ){
                    unset($this->data['Campaign']['trgt_b'.$i]);
                }
            }
            
            if( !empty($this->data['Region']['id']) ){
                $this->data['Campaign']['region_id'] = $this->data['Region']['id'];
                //unset($this->data['Region']);
            }
            if( !empty($this->data['Area']['id']) ){
                $this->data['Campaign']['area_id'] = $this->data['Area']['id'];
                //unset($this->data['Area']);                
            }
            if( !empty($this->data['House']['id'])){
                $this->data['Campaign']['house_id'] = $this->data['House']['id'];
                //unset($this->data['House']);
            }
            return true;
        }
        
        public function afterSave($created) {
            parent::afterSave($created);
            
            //$this->last_inserted_id = $this->getLastInsertID();
        }
        
        /**
         *
         * @param type $camp_id
         * @return array 
         */
        public function calculate_target( $id ){            
            //$this->unbindModel(array('belongsTo' => array('Region', 'Area', 'House')));
            
            $this->Behaviors->load('Containable');
            
            $campDetail = $this->find('first',array('contain' => array('Base' => array(
                'Outlet' => array('title')),
                'Region' => array('title'),
                'Area' => array('title'),
                'House' => array('title')),
                'conditions' => array('Campaign.id' => $id)));
            
            //pr($campDetail);
            
            
            $target_detail = array();
            $dateDiff = ($campDetail['Campaign']['end_date'] - $campDetail['Campaign']['start_date'])/(24*3600);
            $i = 0;
            
            foreach( $campDetail['Base'] as $base ){

                $target_detail[$i]['title'] = $campDetail['Campaign']['title'];

                $target_detail[$i]['region'] = !empty($campDetail['Campaign']['region_id']) ? $campDetail['Region']['title'] : 'All';
                unset($target_detail[$i]['region_id']);

                $target_detail[$i]['area'] = !empty($campDetail['Campaign']['area_id']) ? $campDetail['Area']['title'] : 'All';
                unset($target_detail[$i]['area_id']);

                $target_detail[$i]['house'] = !empty($campDetail['Campaign']['house_id']) ? $campDetail['House']['title'] : 'All';
                unset($target_detail[$i]['house_id']);

                $target_detail[$i]['outlet'] = $campDetail['Base'][$i]['Outlet']['title'];

                for( $j=1; $j<=11; $j++){
                    $target_detail[$i]['target_b'.$j] = ($campDetail['Base'][$i]['base_b'.$j]*$dateDiff*$campDetail['Campaign']['trgt_b'.$j])/100;
                }
                $i++;
            }
            //pr($target_detail);exit;
            return $target_detail;
        }
}
