<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_case.php');
//------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//------------------------------------------------------------------------------------------------------

$debug=false;
$breakfile="modules/arv/arv_menu.php";
$filename="arv_menu.php";
$add_breakfile="&pid=".$_GET['pid'];
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	
$messages=null;
//------------------------------------------------------------------------------------------------------
$o_arv_case=new ARV_case($_GET['pid']);
if(!$o_arv_case->isOk()) {
	$messages_err=$o_arv_case->get_Error_message('all');
	require ("gui/gui_arv_case.php");
	die();
} 
$facility_data=$o_arv_case->getFacilityInfo();
$mode=="new" ? $src='New ARV Patient' : $src='Edit ARV Patient';
//------------------------------------------------------------------------------------------------------
$defaults = array(
    'arv_pid' => '',
    'district' => '',
    'village' => '',
    'street' => '',
    'balozi' => '',
    'chairman_of_village' => '',
    'head_of_family' => '',
    'name_of_secretary' => '', 
    'secretary_phone' => '',
    'secretary_adress' => '',
    'datetime_first_hivtest' => '',
    'datetime_start_arv' => ''
);

$o_arv_case->set_rule('arv_pid','rule_required');
$o_arv_case->set_rule('arv_pid','rule_numeric');
$o_arv_case->set_rule('secretary_phone','rule_numeric');
$o_arv_case->set_rule('arv_pid','rule_min_chars',2);
$o_arv_case->set_rule('datetime_first_hivtest','rule_date');
$o_arv_case->set_rule('datetime_start_arv','rule_date');

//------------------------------------------------------------------------------------------------------
if (!isset($_GET['arv_patient_data'])){
	if ($_GET['mode']=="edit") {
		$_GET['arv_patient_data']=$o_arv_case->getPatientARVData();
		$_GET['arv_patient_data']['datetime_start_arv']=formatDate2Local($_GET['arv_patient_data']['datetime_start_arv'],$date_format,null,null);
		$_GET['arv_patient_data']['datetime_first_hivtest']=formatDate2Local($_GET['arv_patient_data']['datetime_first_hivtest'],$date_format,null,null);
	}
}

if(isset($_GET['submit'])) {
	$result=$o_arv_case->apply_rules($defaults, $_GET['arv_patient_data']);
	$messages = $result['messages'];
	$values   = $result['values'];
	$errors   = $result['errors'];
	
	if ($errors==0) {
		if ($_GET['mode']=="new") { 
			if($o_arv_case->insertARVdata($values)) {
				header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
			} 
		}
		elseif ($_GET['mode']=="edit") 
		{
			if($o_arv_case->updateARVdata($values)){
				header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
			}
		}	
	}
}
//------------------------------------------------------------------------------------------------------
require ("gui/gui_arv_case.php");








?>