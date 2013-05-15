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
	$end =$_GET['end'];
	$start_timeframe = $start;
	$end_timeframe = $end;
	$startdate = date("y.m.d ", $start_timeframe);
	$enddate = date("y.m.d", $end_timeframe);
	
} else {
	$start = mktime (0,0,0,$month, 1, $year);
	$end = mktime (0,0,0,$month+1, 1, $year);
	$start_timeframe = mktime (0,0,0,$month, 1, $year);
	$end_timeframe = mktime (0,0,0,$month+1, 0, $year);
	$startdate = date("y.m.d ", $start);
	$enddate = date("y.m.d", $end);
}
$debug=FALSE;
($debug)?$db->debug=TRUE:$db->debug=FALSE;

		  // Last day of requested month
		//echo $startdate = gmdate("Y-m-d H:i:s", $start_timeframe);
		//echo $enddate = gmdate("Y-m-d H:i:s", $end_timeframe);
		
			

$tmp_table = $rep_obj->SetReportingTable("care_encounter");

$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");

$sql_d ="DROP TEMPORARY TABLE IF EXISTS `tmp_docs`";
$db->Execute($sql_d);
		
$sql_tmp_docs = "CREATE  TEMPORARY TABLE tmp_docs TYPE=HEAP (SELECT distinct(consulting_dr) FROM care_encounter WHERE UNIX_TIMESTAMP(encounter_date) >= '$start' AND UNIX_TIMESTAMP(encounter_date) <= '$end')"; 
$db->Execute($sql_tmp_docs);
$sql_docs = "select * from tmp_docs";  
$docs_list = $db->Execute($sql_docs);

$sql_e ="DROP TEMPORARY TABLE IF EXISTS `tmp_table`";
$db->Execute($sql_e);


$sql_tmp_enc = "CREATE  TEMPORARY TABLE tmp_table TYPE=HEAP(SELECT distinct(enc.encounter_nr),enc.encounter_date,enc.consulting_dr,
lab.create_id as lab_dr,rad.send_doctor as rad_dr,presc.prescriber as presc_dr,presc.drug_class,diag.doctor_name as diag_dr  FROM care_encounter enc
LEFT JOIN care_test_request_chemlabor lab ON
enc.encounter_nr = lab.encounter_nr
LEFT JOIN care_test_request_radio rad ON
enc.encounter_nr = rad.encounter_nr
LEFT JOIN care_encounter_prescription presc ON
enc.encounter_nr = presc.encounter_nr
LEFT JOIN care_tz_diagnosis diag ON
enc.encounter_nr = diag.encounter_nr
WHERE UNIX_TIMESTAMP(encounter_date) >= '$start' AND UNIX_TIMESTAMP(encounter_date) <= '$end')";

$db->Execute($sql_tmp_enc);
$sql_patients = "select * from tmp_table";
$patients_list = $db->Execute($sql_patients);

require_once('gui/gui_docs_util.php');
?>