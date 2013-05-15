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
                        `--->Class Report_cStatistics
*/         
class Report_cStatistics extends ARV_report {
	
	var $year_count;
	var $year_start;
	var $year_end;
	var $table;
	
	function Report_cStatistics($year_start,$year_end) {
		parent::ARV_report();
		$this->year_start=$year_start;
		$this->year_end=$year_end;
		$this->year_count=0;
		$this->table=$this->createTables();
	}	
	
	function calc_timeframe() {
		$debug=false;
		
		$this->timeframe_start = mktime(0,0,0,1,1,$this->year_start);
		$this->timeframe_end = mktime(0,0,0,1,1,$this->year_end+1);
		
		$this->year_count=$this->year_end-$this->year_start;
		
		for($i=0;$i<=$this->year_count;$i++) {
			$this->years[$this->year_start+$i]['start']=mktime(0,0,0,1,1,$this->year_start+$i);
			$this->years[$this->year_start+$i]['end']=mktime(0,0,0,1,1,$this->year_start+1+$i);
			for($j=1;$j<=12;$j++) {
				$this->months[$this->year_start+$i][$j]['start']=mktime(0,0,0,$j,1,$this->year_start+$i);
				$this->months[$this->year_start+$i][$j]['end']=mktime(0,0,0,$j+1,1,$this->year_start+$i);
			}
		}
		
		if ($debug) {
			echo "year_count:".$this->year_count."<br>";
			echo "year_start:".$this->year_start."<br>";
			echo "year_end:".$this->year_end."<br>";
			for($i=0;$i<=$this->year_count;$i++) {
				echo date('Y-m-d',$this->years[$this->year_start+$i]['start'])."<br>";
				echo date('Y-m-d',$this->years[$this->year_start+$i]['end'])."<br>";
				echo "-----------------------<br>";
				echo date('Y-m-d',$this->months[$this->year_start+$i][1]['start'])."<br>";
				echo date('Y-m-d',$this->months[$this->year_start+$i][1]['end'])."<br>";
				echo "-----------------------<br>";
			}
		}
		parent::calc_timeframe();	
	}
	
	function getValue($report_no,$sex,$age,$code,$time_start,$time_stop) {
		global $db;
    	$this->debug=false;
    	$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
		
		switch ($report_no) {
		case 1:
   			{
   				$sql_string="AND datetime_of_enrollment>=$time_start AND datetime_of_enrollment<$time_stop ";
   				break;
   			}
		case 2:
   			{
   				$sql_string.="AND datetime_start_arv>=$time_start AND datetime_start_arv<$time_stop ";
   				break;
   			}
   		case 3:
   			{
   				$sql_string="AND datetime_start_arv IS NOT NULL
   				             AND arv_status<>5 " ;
   			    $sql_string.="AND datetime_visit=(
        						SELECT MAX(visit2.create_time)
		    					FROM ".$this->tbl_visit." visit2
		    					WHERE $this->table.care_tz_arv_case_id=visit2.care_tz_arv_case_id
		    					AND visit2.create_time>=$time_start AND visit2.create_time<$time_stop
    						 ) ";
   				break;
   			}
   		case 4:
   			{
   				$sql_string="AND datetime_start_arv IS NOT NULL
   				             AND arv_status<>5 
							 AND regimen IS NOT NULL ";
   				
   				isset($code) ? $sql_string.="AND LOCATE('$code',regimen)>0 " : "";
			 	$sql_string.="AND datetime_visit=(
        						SELECT MAX(visit2.create_time)
		    					FROM ".$this->tbl_visit." visit2
		    					WHERE $this->table.care_tz_arv_case_id=visit2.care_tz_arv_case_id
		    					AND visit2.create_time>=$time_start AND visit2.create_time<$time_stop
    						 ) ";
   				break;
   			}
   		case 5:
   			{
   				$sql_string="AND datetime_start_arv IS NOT NULL
   				             AND arv_status=5 ";
   			    
   			    isset($code) ? $sql_string.="AND status_code=$code " : "";
   			    $sql_string.="AND datetime_visit=(
        						SELECT MAX(visit2.create_time)
		    					FROM ".$this->tbl_visit." visit2
		    					WHERE ".$this->table.".care_tz_arv_case_id=visit2.care_tz_arv_case_id
		    					AND visit2.create_time>=$time_start AND visit2.create_time<$time_stop
    						 ) ";
   			    break;	          
   			}
		}
		
		
		isset($sex) ? $sql_string.="AND sex='$sex' " : "";
		isset($age) ? $sql_string.="AND adult=$age ": "";
		
		$this->sql="SELECT count(DISTINCT pid)
                    FROM ".$this->table."
                    WHERE 1
                    $sql_string
  					";         
        if (!$this->res = $db->Execute($this->sql)) return false;
		$this->row_elem = $this->res->FetchRow();
		
		return $this->row_elem[0];
	}

//-------------------------------------------------------------------------------------------------------------------------------------------------

	function display_a($no){	
		$table_string="<table class=\"mainTable\">
						  <tr>
						    <th>&nbsp;</th>
						    <th colspan=\"2\">Male</th>
						    <th colspan=\"2\">Female</th>
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    <th>Child</th>
						    <th>Adult</th>
						    <th>Child</th>
						    <th>Adult</th>
						    <th>Total</th>
						  </tr>";
						  foreach ($this->years as $year=>$value) {
							$table_string.="<tr>
										    <th>".$year."</th>
										    <td>".$this->getValue($no,'m',0,null,$value['start'],$value['end'])."</td>
										    <td>".$this->getValue($no,'m',1,null,$value['start'],$value['end'])."</td>
										    <td>".$this->getValue($no,'f',0,null,$value['start'],$value['end'])."</td>
										    <td>".$this->getValue($no,'f',1,null,$value['start'],$value['end'])."</td>
										    <td>".$this->getValue($no,null,null,null,$value['start'],$value['end'])."</td>
									   </tr>";
							}
						  $table_string.="<tr>
						    <th>Total</th>
						    <td>".$this->getValue($no,'m',0,null,$this->timeframe_start,$this->timeframe_end)."</td>
					    	<td>".$this->getValue($no,'m',1,null,$this->timeframe_start,$this->timeframe_end)."</td>
					    	<td>".$this->getValue($no,'f',0,null,$this->timeframe_start,$this->timeframe_end)."</td>
					    	<td>".$this->getValue($no,'f',1,null,$this->timeframe_start,$this->timeframe_end)."</td>
					    	<td>".$this->getValue($no,null,null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						</table>";
		
		return $table_string;
	}

	function display_b($no) {
		$table_string.="<table class=\"mainTable\">
						  <tr>
						    <th>&nbsp;</th>
						    <th>Male</th>
						    <th>Female</th>
						    <th>Total</th>
						  </tr>
						  <tr>
						    <th>Child</th>
						    <td>".$this->getValue($no,'m',0,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,'f',0,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,null,0,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						  <tr>
						    <th>Adult</th>
						    <td>".$this->getValue($no,'m',1,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,'f',1,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,null,1,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						  <tr>
						    <th>Total</th>
						    <td>".$this->getValue($no,'m',null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,'f',null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						    <td>".$this->getValue($no,null,null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						</table>";
		
		return $table_string;
	}
	
	function display_c($no) {
		foreach ($this->months as $year=>$value) {
			$td1.="<th colspan=\"4\">$year</th>";
			
			$td2.="<th colspan=\"2\">Male</th>
				   <th colspan=\"2\">Female</th>";
			
			$td3.="<th>Child</th>
				   <th>Adult</th>
				   <th>Child</th>
				   <th>Adult</th>";
			
			foreach ($value as $month=>$time) {	
				$sum_months[$month]+=$this->getValue($no,null,null,null,$this->months[$year][$month]['start'],$this->months[$year][$month]['end']);
				$$month.="<td>".$this->getValue($no,'m',0,null,$time['start'],$time['end'])."</td>
					      <td>".$this->getValue($no,'m',1,null,$time['start'],$time['end'])."</td>
					      <td>".$this->getValue($no,'f',0,null,$time['start'],$time['end'])."</td>
					      <td>".$this->getValue($no,'f',1,null,$time['start'],$time['end'])."</td>";
			}
			
			$td5.="<td>".$this->getValue($no,'m',0,null,$this->years[$year]['start'],$this->years[$year]['end'])."</td>
				   <td>".$this->getValue($no,'m',1,null,$this->years[$year]['start'],$this->years[$year]['end'])."</td>
				   <td>".$this->getValue($no,'f',0,null,$this->years[$year]['start'],$this->years[$year]['end'])."</td>
				   <td>".$this->getValue($no,'f',1,null,$this->years[$year]['start'],$this->years[$year]['end'])."</td>";
		}
		
		$table_string.="<table class=\"mainTable\">
						  <tr>
						    <th>&nbsp;</th>
						    $td1
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td2
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td3
						    <th>Total</th>
						  </tr>";
		  foreach ($value as $month=>$time) {	
			  $table_string.="<tr>
							    <th>".$this->arr_date[$month]."</th>
							    ".$$month."
							    <td>".$sum_months[$month]."</td>
							  </tr>";
		  }
		  $table_string.="<tr>
						    <th>Total</th>
						    $td5
						    <td>".$this->getValue($no,null,null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						</table>";
						
		  return $table_string;
	}
	
	function display_d($no) {
		
		switch($no) {
		case 4: $code_arr=$this->arr_regimen;	
				break;
		case 5: $code_arr=$this->arr_code;
		        break;
		}
	 	
		foreach ($this->years as $year=>$value) {
			
			$td1.="<th colspan=\"4\">$year</th>";
			
			$td2.="<th colspan=\"2\">Male</th>
				   <th colspan=\"2\">Female</th>";
			
			$td3.="<th>Child</th>
				   <th>Adult</th>
				   <th>Child</th>
				   <th>Adult</th>";
			
			foreach ($code_arr as $index=>$code) { 
			$$index.="<td>".$this->getValue($no,'m',0,$code,$value['start'],$value['end'])."</td>
				      <td>".$this->getValue($no,'m',1,$code,$value['start'],$value['end'])."</td>
				      <td>".$this->getValue($no,'f',0,$code,$value['start'],$value['end'])."</td>
				      <td>".$this->getValue($no,'f',1,$code,$value['start'],$value['end'])."</td>";
			
			}
		
			$td5.="<td>".$this->getValue($no,'m',0,null,$value['start'],$value['end'])."</td>
				   <td>".$this->getValue($no,'m',1,null,$value['start'],$value['end'])."</td>
				   <td>".$this->getValue($no,'f',0,null,$value['start'],$value['end'])."</td>
				   <td>".$this->getValue($no,'f',1,null,$value['start'],$value['end'])."</td>";	
		
		}
		
		$table_string.="<table class=\"mainTable\">
						  <tr>
						    <th>&nbsp;</th>
						    $td1
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td2
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td3
						    <th>Total</th>
						  </tr>";
             
            foreach ($code_arr as $index=>$code) {           
				if($no==5) {
					$table_string.="<tr>
	                                <th>".$this->arr_code_text[$code]."</th>
		    						".$$index."
		    						<td>".$this->getValue($no,null,null,$code,$this->timeframe_start,$this->timeframe_end)."</td></tr>";
				}
				else {
					$table_string.="<tr>
	                                <th>$code</th>
		    						".$$index."
		    						<td>".$this->getValue($no,null,null,$code,$this->timeframe_start,$this->timeframe_end)."</td></tr>";
				}
            }
			$table_string.="<tr>
						    <th>Total Active on ARTs</th>
						    $td5
						    <td>".$this->getValue($no,null,null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						</table>";
		
		return $table_string;
	}
	
	function display_e($no) {
		
		switch($no) {
		case 4: $code_arr=$this->arr_regimen;	
				break;
		case 5: $code_arr=$this->arr_code;
		        break;
		}
		
		foreach ($this->months as $year=>$value) {
			$td1.="<th colspan=\"48\">$year</th>";
			for ($i=1; $i<=12; $i++) {
				
				$td2.="<th colspan=\"4\">".$this->arr_date[$i]."</th>";
				
				$td3.="<th colspan=\"2\">Male</th>
				       <th colspan=\"2\">Female</th>";
				
				$td4.="<th>Child</th>
					   <th>Adult</th>
					   <th>Child</th>
					   <th>Adult</th>";
					   
				foreach ($code_arr as $index=>$code) { 
				
					$$index.="<td>".$this->getValue($no,'m',0,$code,$value[$i]['start'],$value[$i]['end'])."</td>
						      <td>".$this->getValue($no,'m',1,$code,$value[$i]['start'],$value[$i]['end'])."</td>
						      <td>".$this->getValue($no,'f',0,$code,$value[$i]['start'],$value[$i]['end'])."</td>
						      <td>".$this->getValue($no,'f',1,$code,$value[$i]['start'],$value[$i]['end'])."</td>";
				}
			
				$td5.="<td>".$this->getValue($no,'m',0,null,$value[$i]['start'],$value[$i]['end'])."</td>
					   <td>".$this->getValue($no,'m',1,null,$value[$i]['start'],$value[$i]['end'])."</td>
					   <td>".$this->getValue($no,'f',0,null,$value[$i]['start'],$value[$i]['end'])."</td>
					   <td>".$this->getValue($no,'f',1,null,$value[$i]['start'],$value[$i]['end'])."</td>";	
			}
		}
		
		$table_string.="<table class=\"mainTable\">
						  <tr>
						    <th>&nbsp;</th>
						    $td1
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td2
						    <th>Total</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td3
						    <th>&nbsp;</th>
						  </tr>
						  <tr>
						    <th>&nbsp;</th>
						    $td4
						    <th>&nbsp;</th>
						  </tr>";
		  foreach ($code_arr as $index=>$code) { 
			  if($no==5) {
				  $table_string.="<tr>
								    <th>".$this->arr_code_text[$code]."</th>
								    ".$$index."
								    <td>".$this->getValue($no,null,null,$code,$this->timeframe_start,$this->timeframe_end)."</td>
								  </tr>";
			  }
			  else {
				  $table_string.="<tr>
								    <th>$code</th>
								    ".$$index."
								    <td>".$this->getValue($no,null,null,$code,$this->timeframe_start,$this->timeframe_end)."</td>
								  </tr>";
			  }
		  }
		 $table_string.="<tr>
						    <th>Total Active    on ARTs</th>
						    $td5
						    <td>".$this->getValue($no,null,null,null,$this->timeframe_start,$this->timeframe_end)."</td>
						  </tr>
						</table>
						";
		
		return $table_string;
	}
//------------------------------------------------------------------------------
	
}
?>
