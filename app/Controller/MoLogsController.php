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
    
    public function beforeFilter(){
        $this->Auth->allow(array('add_sale','add_coupon'));
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

        if( ($params[0]=='TLP' && count($params)!=15) || $params[0]!='TLP' || !$this->MoLog->numeric_check($params) )
        {
            $error = "Your SMS format is wrong, plesae try again with right format.";
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }	
        $sr_code = $params[1];
        $tlp_code = $params[2];       
        
        
        $passed = $this->MoLog->check_sr_tlp_mobile( $params[1], $params[2], $mobile_number);
        
        if( !$passed ){
            $error = 'Invalid SR or TLP code! Please try again with valid code.';
            $this->MoLog->send_sms_free_of_charge($mobile_number, $error, 796, $keyword, $date, $time_int);
            die();
        }else{
            $sr_tlp_id = $this->MoLog->srTlpId( $mobile_number, $tlp_code );
            
            if( $sr_tlp_id ){
                $res = $this->MoLog->query('SELECT id FROM sales WHERE date="'.$date.'" AND representative_id='.
                        $sr_tlp_id['representative_id'].' AND outlet_id='.$sr_tlp_id['outlet_id'].' AND sale_counter='.
                        $params[14]);
                
                if(count($res)>0)
                {
                    $update_qry = 'UPDATE sales SET ';
                    for($i=1;$i<=11;$i++){
                        $update_qry .= 'sls_b'.$i.'='.$params[$i+2].',';
                    }
                    $update_qry = rtrim($update_qry, ',');
                    $update_qry .= ' WHERE id='.$res[0]['sales']['id'];
                    
                    $this->MoLog->query( $update_qry );                    
                    
                    $msg = "Your record have been successfully updated, thanks.";
                    $this->MoLog->send_sms_free_of_charge($mobile_number, $msg, 796, $keyword, $date, $time_int);
                }
                else
                {
                    $insert_qry = 'INSERT INTO sales(representative_id, outlet_id, section_id, date_time, sale_counter,';
                    for($i=1;$i<=11;$i++){
                        $insert_qry .= 'sls_b'.$i.',';
                    }
                    $insert_qry = rtrim($insert_qry,',');
                    $insert_qry .= ', date) values('.$sr_tlp_id['representative_id'].','.$sr_tlp_id['outlet_id'].','.
                            $sr_tlp_id['section_id'].','.$time_int.','.$params[14].',';
                    
                    for($i=3;$i<=13;$i++){
                        $insert_qry .= $params[$i].',';
                    }                    
                    $insert_qry .= '"'.$date.'")';
                    
                    $this->MoLog->query($insert_qry);
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
}