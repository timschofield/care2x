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
                        `--->Class Report_overview
*/     
class Report_overview extends ARV_report {
	
	var $month;
	var $year;
	var $pager_limit;
	var	$arr_header=array('ARV PID',
                          'Sex',
                          'Age',
                          'Date of enrollment',
                          'Date start ARV',
                          'Visit time',
                          'ARV&nbsp;status',
                          'Why change status',
                          'Regimen',
                          'TB',
                          'CD4');
	
	function Report_overview($month,$year) {
		parent::ARV_report();
		$this->month=$month;
		$this->year=$year;
    	$this->pager_limit=30;
	}	
	
	function calc_timeframe() {
		$debug=false;	
		$this->timeframe_start = mktime(0,0,0,$this->month,1,$this->year);
		$this->timeframe_end = mktime(0,0,0,$this->month+1,1,$this->year);
		
		parent::calc_timeframe();	
	}
	
	function display_list() {
		global $db,$date_format;
    	$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
		
		$color_change=false;
		
		$table_string.="<table class=\"maintable\">";
		$table_string.="<tr>";
		
		$table=$this->createTables();
		foreach ($this->arr_header as $string) {
			$table_string.="<th>$string</th>";
		}
		$table_string.="</tr>";
		$i=0;
		$BGCOLOR='bgcolor="#FFE8F4"';
		
		$this->sql="SELECT 
						arv_pid,
						sex,
						age,
						FROM_UNIXTIME(datetime_of_enrollment,'%d/%m/%Y') AS 'datetime_of_enrollment',
						FROM_UNIXTIME(datetime_start_arv,'%d/%m/%Y') AS 'datetime_start_arv' ,
						FROM_UNIXTIME(datetime_visit,'%d/%m/%Y') AS 'datetime_visit',
						arv_status,
						GROUP_CONCAT(DISTINCT status_code ORDER BY status_code SEPARATOR ',') AS 'status_code',
						regimen,
						test_TB,
						serial_value
                    FROM $table
					WHERE datetime_of_enrollment>=".$this->timeframe_start."
					AND datetime_of_enrollment<".$this->timeframe_end."
					GROUP BY arv_pid, datetime_visit
  					LIMIT ".$this->pager_limit;         
       
        if (!$this->res = $db->Execute($this->sql)) return false;
	
		while ($this->row_elem = $this->res->FetchRow()) {
	     	$temp=unserialize($this->row_elem['serial_value']);	
			
			if($i=0) {
				$temp2=$this->row_elem['arv_pid'];
			}
			if($temp2!=$this->row_elem['arv_pid']) {
				if($BGCOLOR=='bgcolor="#F0F5FF"') {
					$BGCOLOR='bgcolor="#FFE8F4"';
				}
				else {
					$BGCOLOR='bgcolor="#F0F5FF"';
				}
			}
		
			$temp2=$this->row_elem['arv_pid'];
			
			$i++;
			
			$table_string.="<tr $BGCOLOR>
								<td>".$this->row_elem['arv_pid']."</td>
								<td>".$this->row_elem['sex']."</td>
								<td>".$this->row_elem['age']."</td>
								<td>".$this->row_elem['datetime_of_enrollment']."</td>
								<td>".$this->row_elem['datetime_start_arv']."</td>
								<td>".$this->row_elem['datetime_visit']."</td>
								<td>".$this->arr_status[$this->row_elem['arv_status']]."</td>
								<td>".$this->row_elem['status_code']."</td>
								<td>".$this->row_elem['regimen']."</td>
								<td>".$this->arr_tb[$this->row_elem['test_TB']]."</td>
								<td>".$temp[95]."</td>
							</tr>";
		}
		$table_string.="<table>";		
		return $table_string;
	}
}
?>
