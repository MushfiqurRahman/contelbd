<?php
App::uses('AppModel', 'Model');

class Base extends AppModel{
    
    public $belongsTo = array( 
        'Campaign' => array(
            'className' => 'Campaign',
            'foreignKey' => 'campaign_id'
        ),
        'Outlet' => array(
        'className' => 'Outlet',
        'foreignKey' => 'outlet_id'
    ));
    
    /**
     *
     * @param type $bases 
     */
//    public function save_bases( $bases ){
//        $baseData = array();
//        $campaing_id = time();//just for temporary
//        
//        $i = 0;
//        
//        foreach( $bases as $base ){
//            $baseData['Base'][$i]['outlet_id'] = $sale['Outlet']['id'];
//            $baseData['Base'][$i]['campaign_id'] = $campaing_id;
//            
//            foreach( $base[0] as $key => $val ){
//                $baseData['Base'][$i][$key] = $val;
//            }
//            $i++;
//        }
//        $this->saveAll($baseData);
//        return $campaing_id;
//    }
}