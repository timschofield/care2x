<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','billing.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'language/en/lang_en_date_time.php');
require($root_path.'language/en/lang_en_billing.php');
require($root_path.'include/inc_date_format_functions.php');


$txtsearch=$_REQUEST['txtsearch'];

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
$billing_tz = new Bill();
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = new Insurance_tz();
require_once($root_path.'include/care_api_classes/class_tz_insurance_reports.php');
$insurance_tz_report = new Insurance_Reports_tz();


require_once('include/inc_timeframe.php');
/**
 * Getting the timeframe...
 */

 if(empty($print))
 {
 	if ($debug) echo "no time value is set, we're using now the current month<br>";
	$day = date("d",time());
	$month=date("n",time());
	$year=date("Y",time());
	//$start_timeframe = mktime (0,0,0,$month, 1, $year);
	//$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
	$start_timeframe = mktime (0,0,0,$month, $day, $year);
	$end_timeframe = mktime (0,0,0,$month, $day+1, $year);
 }
 else
 {

 	if ($debug) echo "Getting an new time range...<br>";
	//$start_timeframe = mktime (0,0,0,$_REQUEST['month'], 1, $_REQUEST['year']);
	//$end_timeframe = mktime (0,0,0,$_REQUEST['month']+1, 0, $_REQUEST['year']);
	
	if(isset($selected_date)&&!empty($selected_date)) 
	{
	$selected_date=@formatDate2STD($selected_date,$date_format);

	$f_date = strtotime($selected_date);       
	$day = date("d",$f_date); 
	$month = date("n",$f_date);
	$year = date("Y",$f_date);
	}
	
	
	$start_timeframe =  mktime (0,0,0,$month, $day, $year);
        $end_timeframe =   mktime (0,0,0,$month, $day+1, $year);
 }
$enc_obj=new Encounter;
$bill_obj = new Bill;
$insurance_tz = new Insurance_tz;
$debug = false;

$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('main_info%');

$view ="day";

($debug) ? $db->debug=TRUE : $db->debug=FALSE;

 // require($root_path.'modules/registration_admission/aufnahme_daten_such.php');
  require ("gui/gui_billing_tz_archive_date.php");

?>
