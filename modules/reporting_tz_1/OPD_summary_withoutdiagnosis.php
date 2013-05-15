<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//require('con_db.php');
//connect_db();
#Load and create paginator object

$lang_tables[]='aufnahme.php';
$lang_tables[]='reporting.php';
require($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');
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

// how many rows to show per page
$rowsPerPage = 20;

// by default we show first page
$pageNum = 1;

// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;




$tmp_table = $rep_obj->SetReportingTable("care_encounter");
$tmp_table_diag = $rep_obj->SetReportingTable("care_tz_diagnosis");
$tmp_table_per = $rep_obj->SetReportingTable("care_person");

//$tmp_table2 = $rep_obj->SetReportingLink_OPDAdmission($tmp_table,"pid","encounter_date","care_person","pid","date_reg");

$tmp_tbl_OPD_diagnostic = $rep_obj -> SetReportingLink('care_person','pid', 'care_tz_diagnosis','PID');

	// get the Diagnostic-Codes, Diagnostic-full-name and total out of this table:
	//$sql = "SELECT ICD_10_code, ICD_10_description
		 //  FROM $tmp_table where ICD_10_code in('A88.8','A00.9','A03.9','A75.0','B05','G00.9','A20.9','Z20.3','A82.9','A01.0','A95.9')
			//	";
$sql = "SELECT distinct(pid) AS PID ,encounter_nr as ENR FROM $tmp_table where pid not in(select distinct(pid) from $tmp_table_diag) and encounter_date >= '2006-11-01 00:00:00' LIMIT $offset, $rowsPerPage";

//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , count( distinct(pid) ) as NEW , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE,count( encounter_nr ) - count( DISTINCT (pid) ) as RET FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
//$sql="SELECT count( encounter_nr ) AS AMOUNT_ENCOUTERS , date_format( encounter_date, '%d.%m.%y' ) as REGISTRATION_DATE FROM $tmp_table WHERE encounter_date >= '$startdate' AND encounter_date <= '$enddate' GROUP BY date_format(encounter_date,'%y %m %d')";
$db_ptr=$db->Execute($sql);
$res_array = $db_ptr->GetArray();


// how many rows we have in database
$query   = "SELECT COUNT(distinct(pid)) AS numrows  FROM $tmp_table where pid not in(select distinct(pid) from $tmp_table_diag)";
$result  = $db->Execute($query);
$row     = $result->FetchRow();
$numrows = $row[0];



require_once('gui/gui_OPD_summary_withoutdiagnosis.php');
?>