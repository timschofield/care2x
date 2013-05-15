<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_case.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_patient.php');
//-----------------------------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------
$breakfile="modules/arv_2/arv_menu.php";
$add_breakfile="&pid=".$_REQUEST['pid']."&encounter_nr=".$_REQUEST['encounter_nr']; 

if(empty($_REQUEST['pid']) OR empty($_REQUEST['encounter_nr'])) {
	$error_messages="<div class=\"errorMessages\">No patient is selected! </div>";
	require ("gui/gui_arv_overview.php");
	die();
}

if(!($o_arv_patient=new ART_patient($_REQUEST['pid'])) ){
	require ("gui/gui_arv_overview.php");
	die();
}

$facility_info=$o_arv_patient->getFacilityInfo();
$registration_data=$o_arv_patient->getRegistrationData();
$art_data=$o_arv_patient->getARTData();
$visit_table_rows=$o_arv_patient->displayAllARTVisits();
if($_REQUEST['mode']=='print') {
	require ("gui/gui_arv_overview_print.php");
}
else {
	require ("gui/gui_arv_overview.php");
}

?>
