<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//require('con_db.php');
//connect_db();
#Load and create paginator object
$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'language/en/lang_en_reporting.php');
require($root_path.'language/en/lang_en_date_time.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');

/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


require_once('include/inc_timeframe.php');
$month=array_search(1,$ARR_SELECT_MONTH);
$year=array_search(1,$ARR_SELECT_YEAR);

if ($printout) {
	$start = $_GET['start'];
	$end = $_GET['end'];
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start_timeframe);
	 $enddate = date("y.m.d", $end_timeframe);
} else {

	if(isset($selected_date)&&!empty($selected_date)) 
			{
					$f_date = strtotime($selected_date);       
					$day = date("d",$f_date); 
					$month = date("n",$f_date);
					$year = date("Y",$f_date);
			}
			
	$start =  mktime (0,0,0,$month, $day, $year);
	$end =   mktime (23,59,59,$month, $day, $year);
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		 // $start_timeframe = mktime (0,0,0,$month, 1, $year);
		  //$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);

			$startdate = date("y.m.d ", $start_timeframe);
		    $enddate = date("y.m.d", $end_timeframe);

$tmp_table = $rep_obj->SetReportingTable("care_tz_billing_archive_elem");
$tmp_table1 = $rep_obj->SetReportingTable("care_tz_drugsandservices");

//$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");

//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , count( distinct(pid) ) as NEW , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE,count( encounter_nr ) - count( DISTINCT (pid) ) as RET FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
//$sql="SELECT DISTINCT (description) AS SERVICE , count( amount ) AS TESTS FROM $tmp_table  WHERE description IN (SELECT item_description FROM $tmp_table1 WHERE purchasing_class LIKE '%dental') AND date_change>='$start_timeframe' AND date_change<='$end_timeframe' GROUP BY description";

$sql="Select DISTINCT ($tmp_table.description) AS SERVICE , count( $tmp_table.amount ) AS TESTS from $tmp_table " .
		"left join $tmp_table1 on $tmp_table1.item_id=$tmp_table.item_number " .
		"where ($tmp_table1.purchasing_class LIKE '%minor_proc_op') " .
		"AND ($tmp_table.date_change>='$start_timeframe' AND $tmp_table.date_change<='$end_timeframe') " .
		"GROUP BY $tmp_table.description ";

//$sql="SELECT DISTINCT(item_description) AS SERVICE , unit_price AS PRICE FROM $tmp_table1 WHERE purchasing_class LIKE '%minor_proc_op' " ;
$db_ptr=$db->Execute($sql);
if ($db_ptr)
	$res_array = $db_ptr->GetArray();
else
	$res_array= FALSE;




require_once('gui/gui_reporting_minor_proc.php');
?>
