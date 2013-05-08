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
                        'SaleDetail' => array(
                          'fields' => array('product_id','quantity'),  
                        ),
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
        public function set_conditions( $saleIds = null, $data = array() ){
        
            //pr($outletIds);exit;
            
            $conditions = array();
            
            if( $saleIds ){
                $conditions[]['Sale.id'] = $saleIds;                
            }
            if( isset($data['from_date']) && !empty($data['from_date']) ){
                $conditions[]['DATE(Sale.date) >='] = $data['from_date'];
            }
            if( isset($data['till_date']) && !empty($data['till_date']) ){
                $conditions[]['DATE(Sale.date) <='] = $data['till_date'];
            }
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
        public function format_report( $sales, $productsList, $report_type = 'sales' ){
            $formatted = array();
            $i = 0;
            foreach( $sales as $sale ){
                $formatted[$i]['region'] = $sale['Outlet']['House']['Area']['Region']['title'];
                $formatted[$i]['area'] = $sale['Outlet']['House']['Area']['title'];
                $formatted[$i]['house'] = $sale['Outlet']['House']['title'];
                $formatted[$i]['outlet'] = $sale['Outlet']['title'];
                $formatted[$i]['section'] = $sale['Section']['title'];
                $formatted[$i]['representative'] = $sale['Representative']['name'];
                
                foreach($productsList as $k => $pl){
                    $found = false;
                    foreach( $sale['SaleDetail'] as $sD ){
                        if( $k==$sD['product_id']){
                            $formatted[$i][$pl] = $sD['quantity'];
                            $found = true;
                            break;
                        }
                    }
                    if( !$found ){
                        $formatted[$i][$pl] = 0;
                    }
                }                
                $formatted[$i]['date_n_time'] = $sale['Sale']['date'];  
                $i++;
            }
            return $formatted;
        }
}
