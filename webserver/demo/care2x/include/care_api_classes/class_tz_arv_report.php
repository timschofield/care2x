<?php
require_once($root_path.'include/care_api_classes/class_report.php');

/*
Class Structure:

Class Core
    |
    `---> Class Report
              |
              `--->Class ARV_report
*/             
              
class ARV_report extends report{
	
	var $sql;
	var $res;
	var $row_elem;	
	var $debug;
	var $timeframe_start;
	var $timeframe_end;
	var $tbl_visit;
	var $msg_tpl="<div class=\"error\">%s</div>";
	var $errors;
	var $message;
	var $ok;
	var $arr_status=array(1=>'no arv', 2=>'start arv', 3=>'continue', 4=>'change', 5=>'stop arv',-1=>'don\'t&nbsp;know');
	var	$arr_tb=array(1=>'yes', 2=>'no', -1=>'don\'t&nbsp;know');
	var $arr_regimen=array('3TC+d4T+NVP',
		                   '3TC+d4T+EFV',
		                   '3TC+d4T+LPV',
		                   '3TC+AZT+NVP',
		                   '3TC+AZT+EFV',
		                   '3TC+AZT+LPV',
		                   'ABC+DDI+LPV',
		                   'AZT+ddl+NVP',
		                   'AZT+ddl+EFV',
		                   'AZT+ddl+LPV',
		                   'd4T+ddl+NVP',
		                   'd4T+ddl+EFV',
		                   'd4T+ddl+LPV',
		                   '3TC+d4T+EFF',
		                   'Unknown');
	
	var	$arr_code=array(142,
                        145,
                        147,
                        146,
                        -1);
                        	
	var $arr_code_text=array(142=>'Stopped',
                        145=>'Transferred out',
                        147=>'Death',
                        146=>'Lost to follow-up',
                        -1=>'Unknown');
                        
    var $arr_date=array(1=>'Jan',2=>'Feb',3=>'March',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dez');
	
	var $patient_basic_data;
	
	function ARV_report () {
		$this->ok=true;
	}
	
	function calc_timeframe() {
		if($this->timeframe_start>time()) {
			$this->message[]=sprintf($this->msg_tpl,"Selected quarter lies in the future!");
			$this->ok=false;
		}
	}

	function isOK() {
		return $this->ok;
	}
	
	function getMessages() {
		foreach($this->message as $msg) {
			echo $msg;	
		}	
	}
	
	function setTempTable($fields,$sql) {
	    global $db;
	    $this->debug=false;
		// enlarge the max_tmp_table_size to the maximum what we can use:
		$this->Transact("SET @@max_heap_table_size=4294967296");    
	    if (!(empty($sql))) { 
	    	$this->setTable($this->tmp_tbl_name.=time());
	      	$this->sql="CREATE TEMPORARY TABLE $this->coretable ($fields)
					    TYPE=HEAP ($sql)";
	      	return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
	    } 
	    else {
	      	return FALSE;
	    }
	}
	
	function createTables() {
		$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
    	
    	$this->tbl_visit=$this->SetReportingTable('care_tz_arv_visit');	
    	
    	$fields="pid INT, 
                 arv_pid INT, 
				 care_tz_arv_case_id BIGINT,
				 sex CHAR(1), 
                 age TINYINT,
				 adult TINYINT,
                 datetime_of_enrollment BIGINT, 
				 datetime_start_arv BIGINT,
                 datetime_visit BIGINT,
				 arv_status TINYINT,
				 status_code INT,
				 serial_value VARCHAR(400),
				 test_TB TINYINT,
				 regimen VARCHAR(400)
                 ";
    	
    	$sql="SELECT DISTINCT
			    pers.pid AS pid,
			    arv_pid,
                arv.care_tz_arv_case_id 'care_tz_arv_case_id',
                sex,
				IF( date_birth != '0000-00-00', ( YEAR( CURRENT_DATE ) - YEAR( date_birth ) - IF( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_birth, 5 ) , 1, 0 ) ) , NULL ) AS age,
			    arv.create_time AS 'datetime_of_enrollment',
				IF(IF( date_birth != '0000-00-00', (
				YEAR( CURRENT_DATE ) - YEAR( date_birth ) - IF( RIGHT( CURRENT_DATE, 5 ) < RIGHT( date_birth, 5 ) , 1, 0 ) ) , NULL
				)>=15,1,0) AS 'adult',
			    start_arv_tab.datetime_start_arv AS 'datetime_start_arv',
			    visit.create_time AS 'datetime_visit',
			    IFNULL(care_tz_arv_status_id,-1) 'arv_status',
			    status_code,
			    serial_value,
			    test_TB,
			    regimen
			FROM care_person pers
			INNER JOIN care_tz_arv_case arv ON pers.pid=arv.pid
			LEFT OUTER JOIN (
			  SELECT
			    care_tz_arv_case_id,
			    visit.create_time 'datetime_start_arv'
			  FROM care_tz_arv_visit visit
			  WHERE visit.create_time=(
			      SELECT MIN(visit2.create_time)
			      FROM care_tz_arv_visit visit2
			      WHERE visit.care_tz_arv_case_id=visit2.care_tz_arv_case_id
			      AND care_tz_arv_status_id=2
			  )
			) AS start_arv_tab ON arv.care_tz_arv_case_id=start_arv_tab.care_tz_arv_case_id
			LEFT OUTER JOIN care_tz_arv_visit visit ON arv.care_tz_arv_case_id=visit.care_tz_arv_case_id
			LEFT OUTER JOIN care_tz_arv_status_txt reason_txt ON visit.care_tz_arv_visit_id=reason_txt.care_tz_arv_visit_id
			LEFT OUTER JOIN care_tz_arv_status_txt_code code ON reason_txt.care_tz_arv_status_txt_code_id=code.care_tz_arv_status_txt_code_id
			LEFT OUTER JOIN (
			    SELECT serial_value, encounter_nr
			    FROM care_test_findings_chemlab chem
			    WHERE LOCATE('95',serial_value)<>0
			) AS chem
			ON visit.encounter_nr=chem.encounter_nr
			LEFT OUTER JOIN (
			SELECT
			  visit.create_time AS 'create_time',
			  GROUP_CONCAT(DISTINCT item_description ORDER BY item_description SEPARATOR '+') AS regimen
			FROM care_tz_arv_visit visit
			INNER JOIN care_encounter_prescription pres ON visit.encounter_nr=pres.encounter_nr
			INNER JOIN (
			    SELECT
			      CASE WHEN (item_description LIKE 'Triomune%' ) THEN 'd4T+3TC+NVP'
			      WHEN(item_description LIKE 'Combivir%' ) THEN 'ZDV+3TC'
			      WHEN(item_description LIKE 'Duovir%' ) THEN 'ZDV+3TC'
			      WHEN(item_description LIKE 'Kaletra%' ) THEN 'LPV+RTV'
			      WHEN(item_description LIKE 'Zidovudine%' ) THEN 'ZDV'
			      WHEN(item_description LIKE 'Lamivudine%' ) THEN '3TC'
			      WHEN(item_description LIKE 'Stavudine%' ) THEN 'd4T'
			      WHEN(item_description LIKE 'Didanosine%' ) THEN 'ddl'
			      WHEN(item_description LIKE 'Abacavir%' ) THEN 'ABC'
			      WHEN(item_description LIKE 'Efavirenz%' ) THEN 'EFV'
			      WHEN(item_description LIKE 'Nevirapine%' ) THEN 'NVP'
			      WHEN(item_description LIKE 'Nelfinavir%' ) THEN 'NFV'
			      WHEN(item_description LIKE 'Didanosine%' ) THEN 'ddl'
			      WHEN(item_description LIKE 'Saquinavir' ) THEN 'SQV'
					  WHEN(item_description LIKE 'Ritonavir%' ) THEN 'RTV'
					  WHEN(item_description LIKE 'Lopinavir%' ) THEN 'LPV'
					  ELSE 'unknown'
					  END
					  item_description,
					  item_id
			      FROM care_tz_drugsandservices drugs
			      WHERE purchasing_class = 'drug_list'
			      AND is_consumable =1
			) AS drugs
			ON pres.article_item_number=drugs.item_id
			GROUP BY visit.encounter_nr
			) AS regimen
			ON regimen.create_time=visit.create_time
			ORDER BY arv.create_time ASC
			";
		  
    	return $this->setTempTable($fields,$sql);
	}

//-------------------------------------------------------------------------------------------------------------------------------------------------

	function getFacilityInfo() {
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT TYPE , value
					FROM care_config_global
					WHERE TYPE = 'main_info_facility_name'
					OR TYPE = 'main_info_facility_code'
					OR TYPE = 'main_info_facility_district'
					";
					
		if($this->res = $db->Execute($this->sql)) {
			if($this->res->RecordCount()) {
				while ($this->row_elem = $this->res->FetchRow()) {
					$temp=$this->row_elem[0];
					$this->arv_facility_data[$temp]=$this->row_elem[1];;
				}	
				return $this->arv_facility_data;
			}
		}
		else {return false;}		
	}	
	
	function calc_median($res) {
		$median_array=array();
		$i=0;
		
		if(!($res->RecordCount())) {return false;}
		while ($this->row_elem = $res->FetchRow()) {
			$temp=unserialize($this->row_elem[0]);
			$median_array[$i]=$temp[95];
			$i++;
		}
		
	    sort($median_array);
		$n=count($median_array);
		
		if (bcmod(count($median_array),2)==0) {
			return ($median_array[$n/2-1]+$median_array[$n/2])/2;
		}
		else {
			return $median_array[($n+1)/2-1];
		}	
	}
	
	function count_arr($arr,$arr2,$i) {	  
	  	if(!is_array($arr)){  return $arr; } ;
	  	
	  	foreach($arr as $key=>$value) {
  			echo $arr2[$i]." $i<br>";
  			if ($arr2[$i]) { 
	  			if($key==$arr2[$i]) {
	  				$i++;
	  				$totale +=$this->count_arr($value,$arr2,$i);
	  				$i=0;
	  			}
	  			else {continue;}
  			}
  		    elseif(!$arr2[$i]) {
  		    	$i++;	
				$totale +=$this->count_arr($value,$arr2,$i);	
				$i=0;
  		    }	
	  	}
	  	
	  	return $totale;
	} 

//----------------------------------------------------------------------------------------------------------------------------
}
?>
