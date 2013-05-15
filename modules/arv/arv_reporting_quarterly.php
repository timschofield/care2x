<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_report_quarterly.php');
//------------------------------------------------------------------------------------------------------
$debug=false;
$curr_month = date("m", time());
$curr_year = date("Y", time());

if (isset($_GET['submit'])) {
	#Please select Timeframe
}
else {
	$start_month_timestamp = mktime(0,0,0,$curr_month,1,$curr_year);
	$end_month_timestamp = mktime(0,0,0,$curr_month+3,1,$curr_year);	
	$_GET['quarter']=$curr_month;
	$_GET['year']=$curr_year;
	$_GET['month_6']=1;
	$_GET['month_12']=1;
}

//------------------------------------------------------------------------------------------------------
$arv_report=&new Quarterly_report($_GET['quarter'],$_GET['year'],$_GET['month_6'],$_GET['month_12']);
$arv_report->calc_timeframe();
$arr_facility=$arv_report->getFacilityInfo();
$arr_r1=$arv_report->display_quarterly_art_report_no1();
$arr_r2=$arv_report->display_quarterly_art_report_no2();
$arr_c6=$arv_report->display_quarterly_art_report_no4(6);
$arr_c12=$arv_report->display_quarterly_art_report_no4(12);
$arr_r6=$arv_report->display_quarterly_art_report_no6();
//------------------------------------------------------------------------------------------------------

require ("gui/gui_arv_reporting_quarterly.php");
?>
