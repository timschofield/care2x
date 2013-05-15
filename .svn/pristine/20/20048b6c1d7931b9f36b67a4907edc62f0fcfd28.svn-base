<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//require('con_db.php');
//connect_db();
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/inc_front_chain_lang.php');
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
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	//$start_timeframe = mktime (0,0,0,$month, 1, $year);
	//$end_timeframe = mktime (0,0,0,$month+1, 0, $year);
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);



$tmp_table = $rep_obj->SetReportingTable("care_encounter");

$tmp_table1=$rep_obj->SetReportingLink($tmp_table,"pid","care_person","pid");

$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");



//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , count( distinct(pid) ) as NEW , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE,count( encounter_nr ) - count( DISTINCT (pid) ) as RET FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();

/*
$sql_underage="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$db_ptr_underage=$db->Execute($sql_underage);
$res_array_underage = $db_ptr_underage->GetArray();

$sql_14="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$db_ptr_14=$db->Execute($sql_14);
$res_array_14 = $db_ptr_14->GetArray();


 **/

require_once('gui/gui_OPD_Admission.php');
?>