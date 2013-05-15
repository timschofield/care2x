<?php
require_once($root_path.'include/care_api_classes/class_tz_arv_report.php');
/*
Class Structure:

Class Core
    |
    `---> Class Report
              |
              `--->Class ARV_report
              			|
                        `--->Class Quarterly_report
*/     
class Quarterly_report extends ARV_report {
		
	var $nr_6;
	var $nr_12;
	var $month;
	var $year;
	var $table;
	
	function Quarterly_report($month,$year,$nr_6,$nr_12) {
		parent::ARV_report();
		$this->month=$month;
		$this->year=$year;
		$this->table=$this->createTables();
		$this->nr_6=$nr_6;
		$this->nr_12=$nr_12;
	}
	
	function calc_timeframe() {
		$debug=false;
		
		$this->timeframe_start = mktime(0,0,0,$this->month,1,$this->year);
		$this->timeframe_end = mktime(0,0,0,$this->month+3,1,$this->year);
		
		$this->cohort_timestamp[6]['baseline_start']=mktime(0,0,0,$this->month-7+$this->nr_6,1,$this->year);
		$this->cohort_timestamp[6]['baseline_stop']=mktime(0,0,0,$this->month-6+$this->nr_6,1,$this->year);
		$this->cohort_timestamp[6]['end_cohort_start']= mktime(0,0,0,$this->month-1+$this->nr_6,1,$this->year);
		$this->cohort_timestamp[6]['end_cohort_stop']=mktime(0,0,0,$this->month+$this->nr_6,1,$this->year);
		
		$this->cohort_timestamp[12]['baseline_start']=mktime(0,0,0,$this->month-13+$this->nr_12,1,$this->year);
		$this->cohort_timestamp[12]['baseline_stop']= mktime(0,0,0,$this->month-12+$this->nr_12,1,$this->year);
		$this->cohort_timestamp[12]['end_cohort_start']=mktime(0,0,0,$this->month-1+$this->nr_12,1,$this->year);
		$this->cohort_timestamp[12]['end_cohort_stop']=mktime(0,0,0,$this->month+$this->nr_12,1,$this->year);
				
		if($debug) {
			foreach ($this->cohort_timestamp[6] as $var ) {
				echo date('Y-m-d',$var)."<br>";
			}
		}
		
		parent::calc_timeframe();	
	}	
	
//-----------------------------------------------------------------------------------------------------------------
	
	function display_quarterly_art_report_no1() {
		global $db;
		$this->debug=FALSE;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
			
		$arr_row[1]="AND SEX='m' AND adult=0";
		$arr_row[2]="AND SEX='m' AND adult=1";
		$arr_row[3]="AND SEX='f' AND adult=0";
		$arr_row[4]="AND SEX='f' AND adult=1";
		$arr_row[5]="";
		
		$arr_col[1]="datetime_of_enrollment<=".$this->timeframe_start;
		$arr_col[2]="datetime_of_enrollment>=".$this->timeframe_start." AND datetime_of_enrollment<".$this->timeframe_end."";
		$arr_col[3]="datetime_of_enrollment<".$this->timeframe_end."";
		$arr_col[4]="datetime_of_enrollment>=".$this->timeframe_start." AND datetime_of_enrollment<".$this->timeframe_end."
		             AND datetime_visit IS NOT NULL";
		
		foreach ($arr_col as $c_index=>$col) {
			foreach ($arr_row as $r_index=>$row) {
				$this->sql="SELECT COUNT(DISTINCT pid)
	                        FROM ".$this->table."
	                        WHERE 
							$col
                            $row";
                
                if ($this->res = $db->Execute($this->sql)) {
					$this->row_elem=$this->res->FetchRow();
					$arr[$c_index][$r_index]=$this->row_elem[0];
                } else {
                	return FALSE;
                }
			}	
		}
		
		$arr[4][6]=$arr[2][5]-$arr[4][5];	
		return $arr;
	}
	
	function display_quarterly_art_report_no2() {
    	global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $arr_row[1]="AND SEX='m' AND adult=0";
		$arr_row[2]="AND SEX='m' AND adult=1";
		$arr_row[3]="AND SEX='f' AND adult=0";
		$arr_row[4]="AND SEX='f' AND adult=1";
		$arr_row[5]="";
		$arr_row[6]="AND status_code=143 AND datetime_visit=datetime_start_arv";
		$arr_col[1]="datetime_start_arv<=".$this->timeframe_start;
		$arr_col[2]="datetime_start_arv>=".$this->timeframe_start." AND datetime_start_arv<".$this->timeframe_end;
		$arr_col[3]="datetime_start_arv<".$this->timeframe_end;
		$arr_col[4]="arv_status<>5
					 AND datetime_visit=(
							SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time<".$this->timeframe_end."
					 )";
                     
        foreach ($arr_col as $c_index=>$col) {
			foreach ($arr_row as $r_index=>$row) {
				$this->sql="SELECT COUNT(DISTINCT pid)
	                        FROM ".$this->table."
	                        WHERE 
							$col
                            $row";
                
                if ($this->res = $db->Execute($this->sql)) {
					$this->row_elem=$this->res->FetchRow();
					$arr[$c_index][$r_index]=$this->row_elem[0];
                } else {
                	return false;
                }
			}	
		}
		
		return $arr;
    }
    
	function display_quarterly_art_report_no4($count_months) {
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $baseline_start=$this->cohort_timestamp[$count_months]['baseline_start'];
	    $baseline_stop=$this->cohort_timestamp[$count_months]['baseline_stop'];
	    $end_cohort_start=$this->cohort_timestamp[$count_months]['end_cohort_start'];
	    $end_cohort_stop=$this->cohort_timestamp[$count_months]['end_cohort_stop'];
	    
		$this->sql_b="SELECT COUNT(DISTINCT pid)
                      FROM ".$this->table."
					  WHERE datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop";
        
        if (!$this->res = $db->Execute($this->sql_b)) return false;
		
		$this->row_elem=$this->res->FetchRow();
		$row['b']=$this->row_elem[0];	
	
		$this->sql_e="SELECT COUNT(DISTINCT pid)
                      FROM ".$this->table."
					  WHERE datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop
					  AND arv_status<>5
                      AND datetime_visit=(
							SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time<$end_cohort_stop
					  )";
		
		if (!$this->res = $db->Execute($this->sql_e)) return false;
		
		$this->row_elem=$this->res->FetchRow();
		$row['e']=$this->row_elem[0];
		
		$this->sql_c="SELECT COUNT(DISTINCT pid)
                      FROM ".$this->table."
					  WHERE datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop
					  AND serial_value IS NOT NULL
                      AND datetime_visit=(
					  		SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time>=$baseline_start and visit2.create_time<$baseline_stop
					  )";

		if (!$this->res = $db->Execute($this->sql_c)) return false;
		
		$this->row_elem=$this->res->FetchRow();
		$row['c']=$this->row_elem[0];
	
		$this->sql_f="SELECT COUNT(DISTINCT pid)
                      FROM ".$this->table."
					  WHERE datetime_start_arv IS NOT null
					  AND datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop
					  AND serial_value IS NOT NULL
                      AND datetime_visit=(
					  		SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time>=$end_cohort_start and visit2.create_time<$end_cohort_stop
					  )";
		
		if (!$this->res = $db->Execute($this->sql_f)) return false;
		
		$this->row_elem=$this->res->FetchRow();
		$row['f']=$this->row_elem[0];
			
		$this->sql_d="SELECT serial_value
                      FROM ".$this->table."
					  WHERE datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop
					  AND serial_value IS NOT NULL
                      AND datetime_visit=(
					  		SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time>=$baseline_start and visit2.create_time<$baseline_stop
					  )
					  GROUP BY datetime_visit";
		
		if (!$this->res = $db->Execute($this->sql_d)) return false;
		
		$row['d']=$this->calc_median($this->res);
		
		$this->sql_g="SELECT serial_value
                      FROM ".$this->table."
					  WHERE datetime_start_arv IS NOT null
					  AND datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop
					  AND serial_value IS NOT NULL
                      AND datetime_visit=(
					  		SELECT MAX(visit2.create_time)
      						FROM ".$this->tbl_visit." visit2
      						WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      						AND visit2.create_time>=$end_cohort_start and visit2.create_time<$end_cohort_stop
					  )
					  GROUP BY datetime_visit";
					  
		
		if (!$this->res = $db->Execute($this->sql_g)) return false;
		
		$row['g']=$this->calc_median($this->res);
		
		$this->sql_h="SELECT COUNT(DISTINCT pid)
                      FROM ".$this->table." gesamt
					  WHERE datetime_start_arv>=$baseline_start
					  AND datetime_start_arv<$baseline_stop	  
					  AND NOT EXISTS (
    						SELECT *
    						FROM ".$this->tbl_visit." visit2
    						WHERE care_tz_arv_status_id=5
    						AND visit2.care_tz_arv_case_id=gesamt.care_tz_arv_case_id
					  )
					  ";
		
		if (!$this->res = $db->Execute($this->sql_h)) return false;
		
		$this->row_elem=$this->res->FetchRow();
		$row['h']=$this->row_elem[0];
		
		return $row;
	}
	
	function display_quarterly_art_report_no6() {
		global $db;
		$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
		
		$arr_code=array(142,145,146,147,-1);
		$arr_sex=array('m','f');
                     
		foreach ($arr_sex as $sex) {
			foreach ($arr_code as $code) {
				$this->sql="SELECT COUNT(DISTINCT pid)
                            FROM ".$this->table."
                            WHERE arv_status=5
							AND sex='$sex'
                            AND status_code=$code
                            AND datetime_visit=(
								SELECT MAX(visit2.create_time)
      							FROM ".$this->tbl_visit." visit2
      							WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
      							AND visit2.create_time>=".$this->timeframe_start." and visit2.create_time<".$this->timeframe_end."
					  )";
				
				if ($this->res = $db->Execute($this->sql)) {
					$this->row_elem=$this->res->FetchRow();
					$arr[$code][$sex]=$this->row_elem[0];
				} else {
					return false;
				}
			}	
		}
		foreach ($arr_code as $code) {
			$arr['all']['m']+=$arr[$code]['m'];
			$arr['all']['f']+=$arr[$code]['f'];
			$arr[$code]['all']+=$arr[$code]['f']+$arr[$code]['m'];
		}
		$arr['all']['all']=$arr['all']['m']+$arr['all']['f'];
		
		return $arr;
	}
	
	
}
?>
