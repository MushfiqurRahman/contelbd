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
        $this->Auth->allow(array('add_sale','add_coupon', 'redeem'));
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
        $data['Sale']['sale_counter'] = $sl_counter;
        $data['Sale']['date'] = $date;
        $data['SaleDetail'] = $sale_detail;
        
//        echo $sale_id;exit;
        
        if( $sale_id ){   
            $data['Sale']['id'] = $sale_id;            
            $slDtl = $this->Sale->SaleDetail->find('all',array('conditions' => array('SaleDetail.sale_id' => $sale_id),
                'recursive' => -1));
//            pr($slDtl);exit;
            foreach( $data['SaleDetail'] as $k => $v ){
                $data['SaleDetail'][$k]['sale_id'] = $sale_id;
                foreach( $slDtl as $sD ){
                    if( $sD['SaleDetail']['product_id'] == $data['SaleDetail'][$k]['product_id'] ){
                        $data['SaleDetail'][$k]['id'] = $sD['SaleDetail']['id'];
                        break;
                    }
                }
            }     
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
     * Check the sale message format and also format and array for sale detail
     */
    protected function _format_sale_detail( $params ){
        $productList = $this->Sale->SaleDetail->Product->find('list', array('fields' => array('id','code')));
        $total = count($params);
        $data = array();
        
        for( $j=0, $i=2; $i<$total-1; $i++ ){
            $flag_found = false;
            
            foreach( $productList as $k => $v ){
                if( $v == $params[$i] || strtoupper($params[$i]) == $v){
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
        }
        return $data;
    }
        
    /**
     * 
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
        $ttl_msg_part = count($params);

        if( $params[0]!='PSTT' || !is_numeric($params[$ttl_msg_part-1]) ) {
            
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }
        $tlp_code = $params[1];
        $outletId = $this->MoLog->check_sr_tlp_mobile( $params[1], $mobile_number);
        
        if( !is_array($outletId) ){
            $error = 'Invalid Mobile no or Outlet code! Please try again with valid code.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }else{
            $this->loadModel('Sale');
            $sale_detail = $this->_format_sale_detail($params);
            
            if( isset($sale_detail['error']) ){
                $error = 'Invalid Message format or Product code! Please try again with valid data.';
                $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
                die();
            }else{                
                $res = $this->MoLog->query('SELECT id FROM sales WHERE date="'.$date.'" AND representative_id='.
                        $outletId[0]['representatives']['id'].' AND outlet_id='.$outletId[0]['outlets']['id'].
                        ' AND sale_counter='.$params[ $ttl_msg_part - 1 ]);
                
                //pr($res);exit;
                if(count($res)>0) {                    
                    $this->_save_sales($outletId[0]['representatives']['id'], $outletId[0]['outlets']['id'],
                            $outletId[0]['sections']['id'], $params[$ttl_msg_part-1], $date, 
                            $sale_detail['SaleDetail'], $res[0]['sales']['id']);                                        
                    
                    $msg = "Your record have been successfully updated, thanks.";
                    $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);
                }
                else {
                    $this->_save_sales($outletId[0]['representatives']['id'], $outletId[0]['outlets']['id'],
                            $outletId[0]['sections']['id'], $params[$ttl_msg_part-1], $date, $sale_detail['SaleDetail']);//                    
                    
                    $msg = "We have received your request. Thank you.";
                    $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);                        
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

        if( ($params[0]=='CUP' && count($params)!=7) || $params[0]!='CUP' || !$this->MoLog->numeric_check($params) )
        {
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }
        if( $params[2] != ($params[3]+$params[4]+$params[5]) ){
            $error = 'Invalid value! Total point is not equal to the sum of activity points';
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }
        $sr_code = $params[1];
        $tlp_code = $params[2];
        
        $passed = $this->MoLog->check_tlp_mobile( $params[1], $mobile_number);
        
        if( !$passed ){
            $error = 'Invalid user or TLP code! Please try again with valid info.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }else{
            $sr_tlp_id = $this->MoLog->srTlpId( $mobile_number, $tlp_code );
            
            $res = $this->MoLog->query('SELECT id FROM coupons WHERE date="'.$date.'" AND representative_id='.
                    $sr_tlp_id['representative_id'].' AND outlet_id='.$sr_tlp_id['outlet_id'].' AND coupon_counter='.
                    $params[6]);
//                pr($res);

            if( count($res)>0 )
            {
                $update_qry = 'UPDATE coupons SET total_score='.$params[2].', first_act_score='.
                        $params[3].', second_act_score='.$params[4].', third_act_score='.$params[5].
                        ' WHERE coupons.id='.$res[0]['coupons']['id'];

                $this->MoLog->query( $update_qry );                    

                $msg = "Your record have been successfully updated, thanks.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);
            }
            else
            {
                $insert_qry = 'INSERT INTO coupons(representative_id, outlet_id, section_id, coupon_counter,'.
                        'total_score, first_act_score, second_act_score, third_act_score, date_time, date) '.
                        'values('.$sr_tlp_id['representative_id'].','.$sr_tlp_id['outlet_id'].','.$sr_tlp_id['section_id'].
                        ','.$params[6].','.$params[2].','.$params[3].','.$params[4].','.$params[5].','.$time_int.
                        ',"'.$date.'")';                    

                $this->MoLog->query($insert_qry);
                $msg = "We have received your request. Thank you.";
                $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);                        
            }
        }
    }
    
    /**
     * 
     */
    public function get_coupon_point(){
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
                
            }
        }        
    }
    
    /**
     * 
     */
    public function redeem(){
        
    }
    
    /**
     * Gives the total point of an outlet owner 
     */
    public function total_point(){
        
    }
}