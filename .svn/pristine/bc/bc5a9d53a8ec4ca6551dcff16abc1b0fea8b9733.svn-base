<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_patient.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_form_validator.php');
//----------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------
$debug=false;
$breakfile="modules/arv_2/arv_menu.php";
$add_breakfile="&pid=".$_REQUEST['pid']."&encounter_nr=".$_REQUEST['encounter_nr']; ;

if(empty($_REQUEST['pid']) OR empty($_REQUEST['encounter_nr'])){
	$error_messages="<div class=\"errorMessages\">No patient is selected! </div>";
	echo "No patient selected";
	require ("gui/gui_arv_education.php");
	die();
}
if(!$o_arv_patient=new ART_patient($_REQUEST['pid'])){
	echo "test";
	require ("gui/gui_arv_education.php");
	die();
}

$comments=$o_arv_patient->loadAllComments();
$max_comments=0;
$count=1;
foreach($comments as $i=>$v){
	$temp=count($comments[$i]);
	if($temp>$max_comments) { $max_comments=$temp; };
}

if($_REQUEST['mode']=='print') {
	require ("gui/gui_arv_education_overview_print.php");
}
else {
	require ("gui/gui_arv_education_overview.php");
}
?>

