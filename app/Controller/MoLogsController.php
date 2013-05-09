<?php
date_default_timezone_set('Asia/Dhaka');
ini_set('max_execution_time', 50000);

App::uses('AppController', 'Controller');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoLogsController
 *
 * @author Shakil
 */
class MoLogsController extends AppController{
    //put your code here    
    
    var $keywords = array('PSTT', 'CUP', 'RP', 'POINT');
    
    public function beforeFilter(){
        $this->Auth->allow(array('add_sale','add_coupon', 'redeem', 'total_point'));
    }
    
    /**
     * 
     */
    public function index(){
        $this->paginate = array('limit' => 100);
        $this->set('mo_logs',$this->paginate());
    }
    
    /**
     *
     * @param type $id 
     */
    public function delete( $id = null ){
        $this->MoLog->id = $id;
        $this->request->onlyAllow('post', 'delete');
        if( $this->MoLog->delete() ){
            $this->loadModel('SaleDetail');
            $this->SaleDetail->deleteAll(array('mo_log_id' => $id));
            $this->loadModel('Coupon');
            $this->Coupon->deleteAll(array('mo_log_id' => $id));
            $this->Session->setFlash(__('Mo Log delete successful!'));
            $this->redirect(array('controller' => 'MoLogs','action' => 'index'));
        }else{
            $this->Session->setFlash(__('Mo Log delete failed!'));
            $this->redirect(array('action' => 'index'));
        }
    }
    
    /**
     * @desc Save and update Sale and SaleDetail
     * @param type $rep_id
     * @param type $outlet_id
     * @param type $sec_id
     * @param type $sl_counter
     * @param type $date 
     * @param int $sale_id if it is present then this method do update otherwise save
     */
    protected function _save_sales($rep_id, $outlet_id, $sec_id=null, $sl_counter=1, $date, $sale_detail, $sale_id = null){
        
        $data['Sale']['representative_id'] = $rep_id;
        $data['Sale']['outlet_id'] = $outlet_id;
        if( $sec_id ){
            $data['Sale']['section_id'] = $sec_id;
        }
        $data['Sale']['date'] = $date;
        $data['SaleDetail'] = $sale_detail;
        
        if( $sale_id ){   
            $data['Sale']['id'] = $sale_id;   
            $this->Sale->SaleDetail->deleteAll(array('SaleDetail.sale_id'=>$sale_id,
                'SaleDetail.sale_counter' => $sl_counter));
            if( $this->Sale->saveAll($data) ){
                return true;
            }
        }else{
            if( $this->Sale->saveAssociated($data) ){
                return true;
            }        
        }
        return false;
    }
    
    /**
     * Check the sale message format, product codes validity and also format and array for sale detail
     */
    protected function _format_sale_detail( $params, $sale_id = null, $sale_counter = 1, $moLogId ){
        $productList = $this->Sale->SaleDetail->Product->find('list', array('fields' => array('id','code')));
        
        
        $total = count($params);
        $data = array();
        
        for( $j=0, $i=2; $i<$total-1; $i++ ){
            if( !is_numeric($params[$i]) && is_numeric($params[$i+1]) ){                
                
                $flag_found = false;

                foreach( $productList as $k => $v ){
                    if( $v == $params[$i] || strtoupper($params[$i]) == $v){
                        
                        //checking same products code present more than one or not
                        for( $l=$i+1; $l < $total-1; $l++ ){
                            if( $params[$i]==$params[$l] ){
                                $data['error'] = 'Invalid message format. You have entered same product code for twice.';
                                return $data;
                            }
                        }
                        
                        if( $sale_id ){
                            $data['SaleDetail'][$j]['sale_id'] = $sale_id;
                        }
                        $data['SaleDetail'][$j]['mo_log_id'] = $moLogId;
                        $data['SaleDetail'][$j]['sale_counter'] = $sale_counter;
                        $data['SaleDetail'][$j]['product_id'] = $k;
                        $data['SaleDetail'][$j++]['quantity'] = $params[$i+1];           
                        
                        $i++;
                        $flag_found = true;
                        break;
                    }
                }
                if( !$flag_found ){
                    $data['error'] = 'Invalid product code';
                    return $data;
                }
            }else{
                $data['error'] = 'Invalid sms format or product code! Please send sms with valid format.';
            }
        }
        return $data;
    }
    
    /**
     *
     * @param type $mobile_number
     * @param type $sms
     * @param type $keyword
     * @param type $date
     * @param type $time_int
     * @return type 
     */
    protected function _save_log( $mobile_number, $sms, $keyword, $date, $time_int){
        $moLog['MoLog']['msisdn'] = $mobile_number;
        $moLog['MoLog']['sms'] = $sms;
        $moLog['MoLog']['keyword'] = $keyword;
        $moLog['MoLog']['datetime'] = $date;
        $moLog['MoLog']['time_int'] = $time_int;        
        $this->MoLog->save($moLog);
        return $this->MoLog->id;
    }
        
    /**
     * This processes add and update sales request
     */
    public function add_sale(){
        
        $this->layout = $this->autoRender = false;

        $error = '';
        $date = date("Y-m-d");
        $dates = date("Y-m-d H:i:s");
        $time_int = strtotime($dates);

        $mobile_number_temp = $_REQUEST['MSISDN'];
        $sms_text_temp = $_REQUEST['MSG'];

        $sms = $this->MoLog->sms_process($sms_text_temp);
        $mobile_number = $this->MoLog->mobile_number_process($mobile_number_temp);

        $sms_slice = explode(' ', $sms);
        $keyword = $sms_slice[0];
        
        $lastMoLogId = $this->_save_log($mobile_number,$sms,$keyword,$date,$time_int);
        
        $params = array();
        
        $tok = strtok( $sms, ' ,\t\n');
        $tok = trim($tok);
        while( $tok ){
            $params[] = $tok;
            $tok = strtok(' ,\t\n');
            $tok = trim($tok);
        }       
        
        $params[0] = isset($params[0]) ? strtoupper($params[0]) : 'XXX';
        $ttl_msg_part = count($params);

        if( $params[0]!='PSTT' || !is_numeric($params[$ttl_msg_part-1]) || $ttl_msg_part % 2 == 0 || $ttl_msg_part < 5) {
            
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }
        $tlp_code = $params[1];
        $outletId = $this->MoLog->check_sr_tlp_mobile( $params[1], $mobile_number);
        
        if( !is_array($outletId) ){
            $error = 'Invalid Mobile no or Outlet code! Please try again with valid code.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }else{
            $this->loadModel('Sale');
                
            $res = $this->MoLog->query('SELECT sales.id, sale_details.sale_counter FROM sales LEFT JOIN sale_details ON sales.id=sale_details.sale_id WHERE DATE(date)="'.$date.'" AND representative_id='.
                    $outletId[0]['representatives']['id'].' AND outlet_id='.$outletId[0]['outlets']['id']);

            //pr($res);exit;
            if(count($res)>0) { 
                $sale_detail = $this->_format_sale_detail($params, $res[0]['sales']['id'], $params[ $ttl_msg_part - 1 ], $lastMoLogId);

                if( isset($sale_detail['error']) ){                    
                    $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $sale_detail['error'], 796, $keyword, $date, $time_int);
                    die();
                }else{
                    $this->_save_sales($outletId[0]['representatives']['id'], $outletId[0]['outlets']['id'],
                            $outletId[0]['sections']['id'], $params[$ttl_msg_part-1], $dates, 
                            $sale_detail['SaleDetail'], $res[0]['sales']['id']);   
                    
                    $is_update = false;
                    foreach( $res as $rs ){
                        if( $rs['sale_details']['sale_counter'] == $params[ $ttl_msg_part -1 ] ){
                            $is_update = true;
                            break;
                        }
                    }
                    $msg = $is_update ? "Your record have been successfully updated, thanks." : "We have received your request. Thank you.";
                    $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);
                }
            }
            else {
                $sale_detail = $this->_format_sale_detail($params, null, $params[ $ttl_msg_part - 1 ], $lastMoLogId);
                if( isset($sale_detail['error']) ){                    
                    $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $sale_detail['error'], 796, $keyword, $date, $time_int);
                    die();
                }else{
                    $this->_save_sales($outletId[0]['representatives']['id'], $outletId[0]['outlets']['id'],
                            $outletId[0]['sections']['id'], $params[$ttl_msg_part-1], $dates, $sale_detail['SaleDetail']);//                    

                    $msg = "We have received your request. Thank you.";
                    $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);                        
                }
            }
        }
    }
    
    /**
     * 
     */
    public function add_coupon(){
        $this->layout = $this->autoRender = false;
        
        $error = '';
        $date = date("Y-m-d");
        $dates = date("Y-m-d H:i:s");
        $time_int = strtotime($dates);

        $mobile_number_temp = $_REQUEST['MSISDN'];
        $sms_text_temp = $_REQUEST['MSG'];

        $sms = $this->MoLog->sms_process($sms_text_temp);
        $mobile_number = $this->MoLog->mobile_number_process($mobile_number_temp);

        $sms_slice = explode(' ', $sms);
        $keyword = $sms_slice[0];
        $lastMoLogId = $this->_save_log($mobile_number,$sms,$keyword,$date,$time_int);
        
        $params = array();
        
        $tok = strtok( $sms, ' ,\t\n');
        $tok = trim($tok);
        while( $tok ){
            $params[] = $tok;
            $tok = strtok(' ,\t\n');
            $tok = trim($tok);
        }
        
        $params[0] = isset($params[0]) ? strtoupper($params[0]) : 'XXX';        

        if( ($params[0]=='CUP' && count($params)!=7) || $params[0]!='CUP' || !$this->MoLog->numeric_check($params) )
        {
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }
        if( $params[2] != ($params[3]+$params[4]+$params[5]) ){
            $error = 'Invalid value! Total point is not equal to the sum of activity points';
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }
        
        $outletId = $this->MoLog->check_sr_tlp_mobile( $params[1], $mobile_number, 'tsa');
        
        if( !is_array($outletId) ){
            $error = 'Invalid user or TLP code! Please try again with valid info.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }else{            
            $res = $this->MoLog->query('SELECT id FROM coupons WHERE DATE(date)="'.$date.'" AND representative_id='.
                    $outletId[0]['representatives']['id'].' AND outlet_id='.$outletId[0]['outlets']['id'].
                    ' AND is_redeem=0 AND coupon_counter='.$params[6]);
//                pr($res);

            if( count($res)>0 )
            {
                $update_qry = 'UPDATE coupons SET total_score='.$params[2].', first_act_score='.
                        $params[3].', second_act_score='.$params[4].', third_act_score='.$params[5].
                        ' WHERE coupons.id='.$res[0]['coupons']['id'];

                $this->MoLog->query( $update_qry );        
                
                $tp = $this->_get_total_coupon_point($outletId[0]['outlets']['id']);

                $msg = "After successful update your current coupon point total is: ".$tp.". Thank you.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);
            }
            else
            {
                $outletId[0]['sections']['id']  = empty($outletId[0]['sections']['id']) ? 0 : $outletId[0]['sections']['id'];
                $insert_qry = 'INSERT INTO coupons(representative_id, mo_log_id, outlet_id, section_id, coupon_counter,'.
                        'total_score, first_act_score, second_act_score, third_act_score, date) '.
                        'values('.$outletId[0]['representatives']['id'].','.$lastMoLogId.','.
                        $outletId[0]['outlets']['id'].','.
                        $outletId[0]['sections']['id'].','.$params[6].','.$params[2].','.$params[3].','.$params[4].
                        ','.$params[5].',"'.$dates.'")';                    

                $this->MoLog->query($insert_qry);
                
                $tp = $this->_get_total_coupon_point($outletId[0]['outlets']['id']);
                $msg = "After successful add your current coupon point total is: ". $tp.". Thank you.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);                        
            }
        }
    }
    
    protected function _get_total_coupon_point( $outletId ){
        $total_point = $this->MoLog->query('SELECT SUM(total_score) AS total_point FROM coupons '.
                        'WHERE coupons.outlet_id='.$outletId);

        $tp = isset($total_point[0][0]['total_point']) ? $total_point[0][0]['total_point'] : 0;
        return $tp;
    }
    
    /**
     * 
     */
    public function total_point(){
        $this->layout = $this->autoRender = false;
        
        $error = '';
        $date = date("Y-m-d");
        $dates = date("Y-m-d H:i:s");
        $time_int = strtotime($dates);

        $mobile_number_temp = $_REQUEST['MSISDN'];
        $sms_text_temp = $_REQUEST['MSG'];

        $sms = $this->MoLog->sms_process($sms_text_temp);
        $mobile_number = $this->MoLog->mobile_number_process($mobile_number_temp);

        $sms_slice = explode(' ', $sms);
        $keyword = $sms_slice[0];
        $this->MoLog->query("INSERT INTO mo_logs VALUES(NULL,'$mobile_number','$sms','$keyword','$date',$time_int)");
        
        $params = array();
        
        $tok = strtok( $sms, ' ,\t\n');
        $tok = trim($tok);
        while( $tok ){
            $params[] = $tok;
            $tok = strtok(' ,\t\n');
            $tok = trim($tok);
        }
        
        $params[0] = isset($params[0]) ? strtoupper($params[0]) : 'XXX';        

        if( ($params[0]=='POINT' && count($params)!=2) || $params[0]!='POINT' )
        {
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }else{
            $outletId = $this->MoLog->get_outlet_id( $params[1], $mobile_number);
        
            if( !$outletId ){
                $error = 'Invalid Outlet code or mobile no! Please try again with valid info.';
                $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
                die();
            }else{
                $tp = $this->_get_total_coupon_point($outletId);
                $msg = 'Till now you total point is:'.$tp;
                $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);
                die();
                
            }
        }        
    }
    
    /**
     * Redeem coupon point
     */
    public function redeem(){
        $this->layout = $this->autoRender = false;
        
        $error = '';
        $date = date("Y-m-d");
        $dates = date("Y-m-d H:i:s");
        $time_int = strtotime($dates);

        $mobile_number_temp = $_REQUEST['MSISDN'];
        $sms_text_temp = $_REQUEST['MSG'];

        $sms = $this->MoLog->sms_process($sms_text_temp);
        $mobile_number = $this->MoLog->mobile_number_process($mobile_number_temp);

        $sms_slice = explode(' ', $sms);
        $keyword = $sms_slice[0];
        $this->MoLog->query("INSERT INTO mo_logs VALUES(NULL,'$mobile_number','$sms','$keyword','$date',$time_int)");
        
        $params = array();
        
        $tok = strtok( $sms, ' ,\t\n');
        $tok = trim($tok);
        while( $tok ){
            $params[] = $tok;
            $tok = strtok(' ,\t\n');
            $tok = trim($tok);
        }
        
        $params[0] = isset($params[0]) ? strtoupper($params[0]) : 'XXX';        

        if( ($params[0]=='RP' && count($params)!=4) || $params[0]!='RP' || !$this->MoLog->numeric_check($params) )
        {
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }
        
        $outletId = $this->MoLog->check_sr_tlp_mobile( $params[1], $mobile_number, 'tsa');
        
        if( !is_array($outletId) ){
            $error = 'Invalid user or TLP code! Please try again with valid info.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, 0, $error, 796, $keyword, $date, $time_int);
            die();
        }else{            
            $res = $this->MoLog->query('SELECT id, total_score FROM coupons WHERE DATE(date)="'.$date.'" AND representative_id='.
                    $outletId[0]['representatives']['id'].' AND outlet_id='.$outletId[0]['outlets']['id'].
                    ' AND is_redeem=1 AND coupon_counter='.$params[3]);
                //pr($res);exit;
            
            $totalQp = $this->_get_total_coupon_point($outletId[0]['outlets']['id']);    
            
            if( count($res)>0 ){
                $totalQp += (-$res[0]['coupons']['total_score']);
            }
            
            if( $params[2] > $totalQp ){
                $msg = 'Invalid request! Sorry, your redeem point is greater than your total point. You total point is: '.
                        $totalQp;
                $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);
                exit;
            }
            
            $params[2] = -($params[2]);

            if( count($res)>0 ) { 
                
                $update_qry = 'UPDATE coupons SET total_score='.$params[2].', first_act_score = 0,'.
                        ' second_act_score=0, third_act_score = 0 WHERE coupons.id='.$res[0]['coupons']['id'];

                $this->MoLog->query( $update_qry );  
                
                $tp = $this->_get_total_coupon_point($outletId[0]['outlets']['id']);

                $msg = "After successful update your current coupon point total is: ".$tp.". Thank you.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);
            }
            else {
                $outletId[0]['sections']['id']  = empty($outletId[0]['sections']['id']) ? 0 : $outletId[0]['sections']['id'];
                $insert_qry = 'INSERT INTO coupons(representative_id, outlet_id, section_id, coupon_counter,'.
                        'is_redeem, total_score, first_act_score, second_act_score, third_act_score, date) '.
                        'values('.$outletId[0]['representatives']['id'].','.$outletId[0]['outlets']['id'].','.
                        $outletId[0]['sections']['id'].','.$params[3].', 1,'.$params[2].',0,0,0,'.
                        '"'.$dates.'")';                    

                $this->MoLog->query($insert_qry);
                $totalQp -= $params[3];

                $msg = "Redeem successful. Redeemed ".$params[2]." point. Current total coupon point is: ".$totalQp.". Thank you.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $outletId[0]['outlets']['id'], $msg, 796, $keyword, $date, $time_int);                        
            }
        }
    }    
}