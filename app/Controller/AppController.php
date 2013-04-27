<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $total_outlet = 0;
    
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array('Controller'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email','password' => 'password')))));

    public function beforeFilter(){    
        parent::beforeFilter();
    }

    public function isAuthorized($user) {
        if( $this->Auth->user() ){
            return true;
        }
        return false;
    }
    
    
    
    function _day_interval(){
        if( isset($this->request->data['from_date']) && isset($this->request->data['till_date']) ){            
            $total_day = strtotime($this->request->data['till_date']) - strtotime($this->request->data['from_date']);
            $total_day /= (24*3600);
            $total_day = (int)$total_day;
            return ($total_day > 0 ? $total_day : 1);
        }
        return 1;
    }
    
    /**
    * 
    */
    protected function _format_date_fields(){            
        if( isset($this->request->data['from_date']) ){
            $this->request->data['from_date'] = is_numeric($this->request->data['from_date']) ? date('Y-m-d',$this->request->data['from_date']) : $this->request->data['from_date'];
        }
        if( isset($this->request->data['till_date']) ){
            $this->request->data['till_date'] = is_numeric($this->request->data['till_date']) ? date('Y-m-d', $this->request->data['till_date']) : $this->request->data['till_date'];
        }
    }
    
//    protected function _find_titles( $data ){
//        $titles = array();
//        if( !$data['Region']['id'] ){
//            $titles['region_title'] = 'All';
//            $titles['area_title'] = 'All';
//            $titles['house_title'] = 'All';
//        }else{
//            $titles['region_title'] = $reg_area_house_detail[0]['Region']['title'];
//
//            if( !$this->request->data['Area']['id'] ){
//                $title_n_ids['area_title'] = 'All';
//                $title_n_ids['house_title'] = 'All';
//            }else{
//                $title_n_ids['area_title'] = $this->Sale->find_title( 'Area', $reg_area_house_detail, $this->request->data['Area']['id'] );
//
//                if( !isset($this->request->data['House']['id']) ){
//                    $title_n_ids['house_title'] = 'All';
//                }else{
//                    $title_n_ids['house_title'] = $this->Sale->find_title( 'House', $reg_area_house_detail, $this->request->data['House']['id'] );
//                }
//            }
//        }
//    }
}
