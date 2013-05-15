<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_report_overview.php');
//------------------------------------------------------------------------------------------------------
$curr_month = date("m", time());
$curr_year = date("Y", time());

if (isset($_GET['submit'])) {
	
}
else {
	$_GET['month']=$curr_month;
	$_GET['year']=$curr_year;
}

//------------------------------------------------------------------------------------------------------
$arv_report=new Report_overview($_GET['month'],$_GET['year']);
$arv_report->calc_timeframe();

//------------------------------------------------------------------------------------------------------

require ("gui/gui_arv_reporting_overview.php");
?>

