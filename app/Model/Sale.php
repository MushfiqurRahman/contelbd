<?php
App::uses('AppModel', 'Model');
/**
 * Sale Model
 *
 * @property Representative $Representative
 * @property Outlet $Outlet
 * @property Section $Section
 */
class Sale extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'representative_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'outlet_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_time' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b1' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b2' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b3' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b4' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b5' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b6' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b7' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b8' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b9' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b10' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sls_b11' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Representative' => array(
			'className' => 'Representative',
			'foreignKey' => 'representative_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Outlet' => array(
			'className' => 'Outlet',
			'foreignKey' => 'outlet_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
        
        public $hasMany = array(
            'SaleDetail' => array(
                'className' => 'SaleDetail',
                'foreignKey' => 'sale_id'
            )
        );
        
        /**
        *
        * @return type 
        */
        public function get_contain_array(){

            return array(
                            'Outlet' => array(
                                'fields' => array('title'),
                                'House' => array(
                                    'fields' => array('title'),
                                    'Area' => array(
                                        'fields' => array('title'),
                                        'Region' => array('fields' => array('title'))))),
                            'Section' => array('title'),
                            'Representative' => array('name'));
        }
        
        /**
         *
         * @return type 
         */
        public function set_conditions( $outletIds = null, $data = array() ){
            //pr($data);
            
            $conditions = array();
//            if( !empty($this->data['Representative']['id']) ){
//                $conditions[]['Sale.representative_id'] = $this->data['Representative']['id'];
//            }
//            if( !empty($this->data['Section']['id']) ){
//                $conditions[]['Sale.section_id'] = $this->data['Section']['id'];
//            }
//            
//            if( !empty($this->data['Outlet']['id'])){
//                $conditions[]['Sale.outlet_id'] = $this->data['Outlet']['id'];
//            }else if( $outletIds ){
//                $conditions[]['Sale.outlet_id'] = $outletIds;                
//            }
//            if( !empty($this->data['from_date']) ){
//                $conditions[]['date_time >='] = strtotime($this->data['from_date']);
//            }
//            if( !empty($this->data['till_date']) ){
//                $conditions[]['date_time <='] = strtotime($this->data['till_date']);
//            }     
            
            //pr($data);
            
            if( !empty($data['Representative']['id']) ){
                $conditions[]['Sale.representative_id'] = $data['Representative']['id'];
            }
            if( !empty($data['Section']['id']) ){
                $conditions[]['Sale.section_id'] = $data['Section']['id'];
            }
            
            if( !empty($data['Outlet']['id'])){
                $conditions[]['Sale.outlet_id'] = $data['Outlet']['id'];
            }else if( $outletIds ){
                $conditions[]['Sale.outlet_id'] = $outletIds;                
            }
            if( !empty($data['from_date']) && !empty($data['till_date']) ){
                $conditions[]['Sale.date_time >='] = strtotime($data['from_date']).' AND '.
                    '<= '.strtotime($data['till_date']);
            }
//            if( !empty($data['till_date']) ){
//                $conditions[]['Sale.date_time'] = '<='.strtotime($data['till_date']);
//            }
            return $conditions;
        }
        
        /**
         *
         * @return string 
         */
        public function make_base_fields( $day_interval = 1 ){            
            $sum_fields = array();
            for($i=1;$i<=11;$i++){                
                $sum_fields[] = 'SUM(Sale.sls_b'.$i.')/'.$day_interval.' AS base_b'.$i;
            }
            $sum_fields[] = 'Sale.date_time';
            return $sum_fields;            
        }
        
        public function make_total_fields(){
            $sum_fields = array();
            
            $sum_fields[] = 'Sale.outlet_id';
            
            for($i=1;$i<=11;$i++){                
                $sum_fields[] = 'SUM(Sale.sls_b'.$i.') AS total_b'.$i;
            }            
            //$sum_fields[] = 'representative_id';
            //$sum_fields[] = 'house_id';
            //$sum_fields[] = 'area_id';
            //$sum_fields[] = 'region_id';
            return $sum_fields;
        }
        
        /**
         *
         * @param type $sales 
         */
        public function fill_essential_fields( $sales ){
            //pr($sales);
            foreach( $sales as $key => $sale ){
                
                $tmp = $this->query('SELECT House.title, Area.title, Region.title FROM houses AS House LEFT JOIN
                    areas AS Area ON House.area_id = Area.id LEFT JOIN regions as Region ON Area.region_id = Region.id 
                    WHERE House.id = '.$sale['Outlet']['house_id']);
                
                //pr($tmp);
                
                $sales[$key]['Outlet']['House']['title'] = $tmp[0]['House']['title'];
                $sales[$key]['Outlet']['House']['Area']['title'] = $tmp[0]['Area']['title'];
                $sales[$key]['Outlet']['House']['Area']['Region']['title'] = $tmp[0]['Region']['title'];
            }
            return $sales;
            
        }
        
        
        
        /**
         *
         * @param type $sales
         * @return array 
         */
        public function format_report( $sales, $report_type = 'sales' ){
            $formatted = array();
            $i = 0;
            foreach( $sales as $sale ){
                $formatted[$i]['region'] = $sale['Outlet']['House']['Area']['Region']['title'];
                $formatted[$i]['area'] = $sale['Outlet']['House']['Area']['title'];
                $formatted[$i]['house'] = $sale['Outlet']['House']['title'];
                $formatted[$i]['outlet'] = $sale['Outlet']['title'];
                $formatted[$i]['section'] = $sale['Section']['title'];
                $formatted[$i]['representative'] = $sale['Representative']['name'];
                $formatted[$i]['b1'] = ( $report_type == 'base' ? $sale[0]['base_b1'] : $sale['Sale']['sls_b1'] );
                $formatted[$i]['b2'] = ( $report_type == 'base' ? $sale[0]['base_b2'] : $sale['Sale']['sls_b2'] );
                $formatted[$i]['b3'] = ( $report_type == 'base' ? $sale[0]['base_b3'] : $sale['Sale']['sls_b3'] );
                $formatted[$i]['b4'] = ( $report_type == 'base' ? $sale[0]['base_b4'] : $sale['Sale']['sls_b4'] );
                $formatted[$i]['b5'] = ( $report_type == 'base' ? $sale[0]['base_b5'] : $sale['Sale']['sls_b5'] );
                $formatted[$i]['b6'] = ( $report_type == 'base' ? $sale[0]['base_b6'] : $sale['Sale']['sls_b6'] );
                $formatted[$i]['b7'] = ( $report_type == 'base' ? $sale[0]['base_b7'] : $sale['Sale']['sls_b7'] );
                $formatted[$i]['b8'] = ( $report_type == 'base' ? $sale[0]['base_b8'] : $sale['Sale']['sls_b8'] );
                $formatted[$i]['b9'] = ( $report_type == 'base' ? $sale[0]['base_b9'] : $sale['Sale']['sls_b9'] );
                $formatted[$i]['b10'] = ( $report_type == 'base' ? $sale[0]['base_b10'] : $sale['Sale']['sls_b10'] );
                $formatted[$i]['b11'] = ( $report_type == 'base' ? $sale[0]['base_b11'] : $sale['Sale']['sls_b11'] );
                $formatted[$i]['date'] = date('Y-m-d H:i:s',$sale['Sale']['date_time']);                
                $i++;
            }
            return $formatted;
        }
}
