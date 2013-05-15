<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_report_cstatistics.php');
//------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------
$breakfile='modules/reporting_tz/reporting_main_menu.php';
$debug=false;
$curr_year = date("Y", time());

if (isset($_GET['submit'])) {
	#Please select a timeframe
}
else {
	$_GET['year_start']=$curr_year-1;
	$_GET['year_end']=$curr_year;
}

$arv_report=&new Report_cStatistics($_GET['year_start'],$_GET['year_end']);
echo $arv_report->calc_timeframe();

//------------------------------------------------------------------------------------------------------
require ("gui/gui_arv_reporting_cstatistics.php");
?>
