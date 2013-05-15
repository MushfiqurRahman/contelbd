<?php
App::uses('AppModel', 'Model');
/**
 * Outlet Model
 *
 * @property Section $Section
 * @property House $House
 * @property Coupon $Coupon
 * @property Sale $Sale
 */
class Outlet extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'house_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select a house for this outlet.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
                'section_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
                        'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select a section for this outlet.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
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
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'priority' => array(
                    'notempty' => array(
                        'rule' => array('notempty'),
                        'message' => 'Please select priority value for the outlet.',
                    )
                )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'House' => array(
			'className' => 'House',
			'foreignKey' => 'house_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Coupon' => array(
			'className' => 'Coupon',
			'foreignKey' => 'outlet_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Sale' => array(
			'className' => 'Sale',
			'foreignKey' => 'outlet_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
        
        function beforeSave(){
            if( strpos($this->data['Outlet']['phone_no'], '88')!==0 ){
                $this->data['Outlet']['phone_no'] = '88'.$this->data['Outlet']['phone_no'];
            }
            return true;
        }
        
        /**
         *
         * @param type $outletList
         * @return type 
         */
        
        public function id_from_list( $outletList ){
            $outletIds = array();
            
            foreach($outletList as $key => $val){
                $outletIds[] = $key;
            }
            return $outletIds;
        }
        
        /**
         *
         * @param array $outletIds list of outlet ids
         * @return array
         */
        public function outlet_by_priority( $outletIds ){
            $priority_total = $this->find('all',array('fields' => array('priority','count(priority) AS priority_total'),
                'conditions' => array('id' => $outletIds),
                'group' => 'priority',
                'recursive' => -1));
            $res = array();
            foreach($priority_total as $pt){
                $res[$pt['Outlet']['priority']] = $pt[0]['priority_total'];
            }
            return $res;
        }

}
