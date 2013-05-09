<?php
App::uses('AppModel', 'Model');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoLog
 *
 * @author Shakil
 */
class MoLog extends AppModel{
    //put your code here
  public function sms_process($sms_temp) {
	
	while(substr_count($sms_temp, '  ')) {
		$sms_temp = str_replace('  ',' ',trim($sms_temp));
	}
	return strtoupper($sms_temp);
}  

     public function check_sr_tlp_mobile($tlp, $mobile, $sr_type = null){
         
         /**** Representative may have multiple mobiles ****/
        
        $res = $this->query('SELECT mobiles.mobile_no, representatives.id, representatives.type, outlets.id,'.
                'outlets.title, outlets.code, sections.id FROM mobiles INNER JOIN representatives ON mobiles.representative_id = '.
                'representatives.id INNER JOIN outlets ON representatives.house_id = outlets.house_id'.
                ' LEFT JOIN sections ON representatives.id=sections.representative_id WHERE mobiles.mobile_no ="'.
                $mobile.'" AND outlets.code="'.$tlp.'"');
        
//        pr($res);exit;
        
        if( count($res)>0 && $res[0]['outlets']['code']==$tlp ){
            if( $sr_type && $res[0]['representatives']['type']== $sr_type ){                
                return $res;
            }else if( !$sr_type && ($res[0]['representatives']['type']=='ss' ||
                $res[0]['representatives']['type']=='sr') ){
                return $res;
            }
        }
        return false;
    }
    
    /**
     *
     * @param type $tlp
     * @param type $mobile
     * @return boolean 
     */
    public function check_tlp_mobile( $tlp, $mobile ){
        $res = $this->query('SELECT * FROM representatives LEFT JOIN outlets ON '.
                'representatives.house_id = outlets.house_id WHERE representatives.mobile_no="'.
                $mobile.'" AND outlets.code="'.$tlp.'"');
        
//        pr($res);
        
        if( count($res)>0 && ( isset($res[0]['outlets']['code']) && $res[0]['outlets']['code'] == $tlp ) ){
            return true;
        }
        return false;
    }
    
    /**
     *
     * @param type $outletCode
     * @param type $mobile
     * @return boolean 
     */
    public function get_outlet_id( $outletCode, $mobile ){
        $res = $this->query('SELECT * FROM outlets WHERE outlets.code="'.$outletCode.'" AND outlets.phone_no="'.
                $mobile.'"');
        //pr($res);
        
        if( count($res)>0 ){
            return $res[0]['outlets']['id'];
        }
        return false;
    }
    
    /**
     *
     * @param type $mobile_number
     * @param type $tlp_code
     * @return boolean 
     */
    public function srTlpId( $mobile_number, $tlp_code ){
        $res = $this->query('SELECT * FROM representatives LEFT JOIN outlets ON representatives.house_id = outlets.house_id 
            WHERE representatives.mobile_no="'.$mobile_number.'" AND outlets.code="'.$tlp_code.'"');
        
        if( count($res)>0 && isset($res[0]['outlets'])){
            $ids['representative_id'] = $res[0]['representatives']['id'];
            $ids['outlet_id'] = $res[0]['outlets']['id'];
            $ids['section_id'] = $res[0]['outlets']['section_id'];
            return $ids;
        }
        return false;
    }
    
    /**
     *
     * @param type $params
     * @return boolean 
     */
    public function numeric_check( $params ){
        if( $params[0] == 'RP' ){
            $total = 4;
        }else if( $params[0] == 'CUP' ){
            $total = 7;
        }else{
            return false;
        }   
        for($i=3;$i<$total;$i++){
            if( $params[$i]===0 ) continue;
            if( !is_numeric($params[$i]) ){
                return false;
            }
        }
        return true;
    }

public function mobile_number_process($mobile_num_temp) {
		
	$mobile_num=str_replace('-','',$mobile_num_temp);
	$mobile_num=trim($mobile_num);
	
	if(strlen($mobile_num) < 13)
		$mobile_num = "88".$mobile_num;
	
	return $mobile_num;
}
    



public function get_sp($mobile_num_temp){
	
		$operator = substr($mobile_num_temp,0,5);
			
			if($operator == '88017'){
					$sp = '9933';
			}else if($operator == '88018'){
					$sp = '9934';
			}
		return $sp;	
	}

public function get_charge($mobile_num_temp){
	
		$operator = substr($mobile_num_temp,0,5);
			
			if($operator == '88017'){
					$charge = 200;
			}else if($operator == '88016'){
					$charge = 230;
			}
			
			return $charge;	
	}
	
public function check_sup_code($sup_code) {
	
	$result = mysql_query("SELECT * FROM data_brs WHERE sup_code=$sup_code");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_ms_code($ms_code) {
	
	$result = mysql_query("SELECT * FROM data_ms WHERE ms_code=$ms_code");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_house_code($house_code) {
	
	$result = mysql_query("SELECT * FROM data_bm WHERE house_code='$house_code'");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_section_code($section_code) {
	
	$result = mysql_query("SELECT * FROM sections WHERE section_code='$section_code'");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_br_code($br_code, $sup_code, $section_code) {

	$res = mysql_query("SELECT * FROM sections WHERE section_code='$section_code'");
	while($row = mysql_fetch_array($res))
	{
		$area = $row['area'];
	}
	
	$result = mysql_query("SELECT * FROM data_brs WHERE br_code='$br_code' AND sup_code=$sup_code AND area='$area'");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_br_code_ms($br_code, $ms_code, $section_code) {

	$res = mysql_query("SELECT * FROM sections WHERE section_code='$section_code'");
	if(mysql_num_rows($res))
	{
		while($row = mysql_fetch_array($res))
		{
			$area = $row['area'];
		}
	}
	
	$result = mysql_query("SELECT * FROM data_brs WHERE br_code='$br_code' AND area='$area'");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function check_user($msisdn) {

	$msisdn = substr($msisdn, 2);

	$result = mysql_query("SELECT * FROM users WHERE username='$msisdn'");
	if(mysql_num_rows($result))
		return 1;
	else
		return 0;
}

public function total_derby_stt()
{
	$res = mysql_query("SELECT SUM(derby_stt) aaa FROM sms_bm");
	while($row = mysql_fetch_array($res))
	{
		return $row['aaa'];
	}
}

public function total_count_house()
{
	return mysql_num_rows(mysql_query("SELECT * FROM data_bm"));
}

public function total_count_area()
{
	return mysql_num_rows(mysql_query("SELECT * FROM data_bm GROUP BY area"));
}

public function get_section_name($section_code)
{
	$ress = mysql_query("SELECT * FROM sections WHERE section_code='$section_code'");
	while($rows = mysql_fetch_array($ress))
	{
		return $section_name = $rows['section_name'];
	}
}

public function get_till_td_brstl($house_code)
{
	$res = mysql_query("SELECT AVG(bristol_stt) avgs from sms_bm WHERE house_code='$house_code'");
	while($rows = mysql_fetch_array($res))
	{
		return $rows['avgs'];
	}
}

public function get_till_td_drby($house_code)
{
	$res = mysql_query("SELECT AVG(derby_stt) avgs from sms_bm WHERE house_code='$house_code'");
	while($rows = mysql_fetch_array($res))
	{
		return $rows['avgs'];
	}
}

public function get_br_name($br_code)
{
	$ress = mysql_query("SELECT * FROM data_brs WHERE br_code='$br_code'");
	while($rows = mysql_fetch_array($ress))
	{
		return $section_name = $rows['br_name'];
	}
}

public function get_ms_name($ms_code)
{
	$ress = mysql_query("SELECT * FROM data_ms WHERE ms_code='$ms_code'");
	while($rows = mysql_fetch_array($ress))
	{
		return $section_name = $rows['ms_name'];
	}
}

public function get_sup_name($sup_code)
{
	$ress = mysql_query("SELECT * FROM data_brs WHERE sup_code='$sup_code' LIMIT 1");
	while($rows = mysql_fetch_array($ress))
	{
		return $section_name = $rows['sup_name'];
	}
}

public function last_entry() {

	$result1 = mysql_query("SELECT * FROM mo_log ORDER BY id DESC LIMIT 1");
	
	while($row1 = mysql_fetch_array($result1))
	{
		$datetime = $row1['time_int'];
	}
	
	$datetime = date("H:i:s", $datetime);
	return $datetime;
}

public function total_count_ms() {

	$result1 = mysql_query("SELECT * FROM sms_ms");
	return mysql_num_rows($result1);
	$english_format_number = number_format($result1);
}

public function total_count_brs() {

	$result2 = mysql_query("SELECT * FROM sms_brs");
	return mysql_num_rows($result2);
}

public function total_count_cluster() {

	$result1 = mysql_query("SELECT * FROM clusters_br");
	return mysql_num_rows($result1);;
}

public function get_cluster($cluster_name) {

	$result = mysql_query("SELECT cluster_code FROM clusters_br WHERE cluster_name = '$cluster_name'");
	while($row = mysql_fetch_array($result))
	{
		return $row['cluster_code'];
	}
}

public function get_occupation($occupation) {
	
	if($occupation == 'S1')
		return "Service";
	if($occupation == 'S2')
		return "Business";
	if($occupation == 'S3')
		return "Student";
	if($occupation == 'S4')
		return "Others";
}

public function get_comment($comment) {
	
	if($comment == 'TA')
		return "Taste";
	if($comment == 'DE')
		return "Design";
}

public function get_reaction($occupation) {
	
	if($occupation == 'AT')
		return "Attractive";
	if($occupation == 'NT')
		return "Nutral";
	if($occupation == 'NA')
		return "Not Attractive";
}

	
public function send_sms_free_of_charge($to, $outlet_id = 0, $msg,$recid,$keyword, $date = '', $time_int = 0){
		$this->query("INSERT INTO mt_logs(msisdn, outlet_id, sms,keyword,datetime,time_int) VALUES('$to',".
                        $outlet_id.",'$msg','$keyword','$date',$time_int)");
		
		$date=date('Y-m-d h:i A');
		$ftp = fopen("log.txt",'a+');
        	fwrite($ftp,$to." ".$msg."	".$date."\n");
        	fclose($ftp);
		
		echo $msg; 
}

public function get_telcoID($mobile_num_temp){
		
			$operator = substr($mobile_num_temp,0,5);
			
			if($operator == '88017'){
					$telcoID = '1';
			}else if($operator == '88018'){
					$telcoID = '4';
			}else if($operator == '88015'){
					$telcoID = '5';
			}else if($operator == '88019'){
					$telcoID = '3';
			}else if($operator == '88011'){
					$telcoID = '2';				
			}else if($operator == '88016'){
					$telcoID = '6';				
			}else{ $telcoID = '7'; }
			
			return $telcoID;
	}

}