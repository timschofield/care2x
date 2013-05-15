<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/care_api_classes/class_tz_arv_case.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_visit.php');
//-------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------
$breakfile="modules/arv/arv_overview.php";
$add_breakfile="&pid=".$_GET['pid'];

$o_arv_case=&new ARV_case($_GET['pid']);
$o_arv_case->getPatientARVData();
$o_arv_visit=&new ARV_visit($o_arv_case->CurrentEncounter($_GET['pid']),$o_arv_case->getARVcaseID(),$_GET['arv_visit_id']);

$visit_data=$o_arv_visit->get_visit_data();
$codes=$o_arv_visit->get_aidsdef_codes();

foreach ($codes as $var) {
	$codes_string.=$var." | ";
}

$r_item_no_data=$o_arv_visit->get_arv_status_reasons();

$label=array(1=>'yes',2=>'no',-1=>'don\'t know');
$label2=array(1=>'no arv',2=>'start arv', 3=>'continue', 4=>'change', 5=>'stop arv',-1=>'don\'t know');

require ("gui/gui_arv_print.php");

?>
