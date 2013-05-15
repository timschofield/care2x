<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_patient.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_form_validator.php');

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
$debug=false;
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	
$add_breakfile="&pid=".$_REQUEST['pid']."&encounter_nr=".$_REQUEST['encounter_nr']; 
$filename="arv_menu.php";
$breakfile="modules/arv_2/arv_menu.php";

if($debug) {
	echo "<pre>";
	print_r($_REQUEST);
}
//------------------------------------------------------------------------------------------------------------
if(empty($_REQUEST['pid']) OR empty($_REQUEST['encounter_nr'])){
	$error_messages="<div class=\"errorMessages\">No patient is selected! </div>";
	require ("gui/gui_arv_registration.php");
	die();
}
if(!$o_arv_patient=new ART_patient($_REQUEST['pid'],$_REQUEST['registration_id'])){
	require ("gui/gui_arv_registration.php");
	die();
}

$facility_info=$o_arv_patient->getFacilityInfo();
$registration_data=$o_arv_patient->getRegistrationData();

if(isset($_POST['submit'])) {
	$o_val=new Validator($o_arv_patient->getDefaultData(),$_REQUEST);
	$o_val->set_rule('ctc_id','rule_required');		 		
	$o_val->set_rule('signature','rule_required');	
	
	$o_val->set_rule('ctc_id','rule_numeric');	
	$o_val->set_rule('status_cd4','rule_numeric');	
	$o_val->set_rule('eligible_reason_cd4','rule_numeric');	
	$o_val->set_rule('eligible_reason_tlc','rule_numeric');	
	
	$o_val->set_rule('ctc_id','rule_min_chars',3);
	$o_val->set_rule('chairman_vname','rule_min_chars',2);
	$o_val->set_rule('chairman_nname','rule_min_chars',2);
	$o_val->set_rule('signature','rule_min_chars',2);	
	
	$o_val->set_rule('date_first_hiv_test','rule_date');
	$o_val->set_rule('date_confirmed_hiv','rule_date');
	$o_val->set_rule('date_enrolled','rule_date');
	$o_val->set_rule('date_eligible','rule_date');
	$o_val->set_rule('date_ready','rule_date');
	$o_val->set_rule('date_start_art','rule_date');
	
	$o_val->set_rule('status_weight','rule_decimal');
	$o_val->applyRules(); 

	if(($o_val->getErrors())==0){ 	
		if ($_REQUEST['mode']=='edit') { 
	 		if($o_arv_patient->updateARTPatient($o_val->getValues())) {
	 			header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
	 		}
	 	}
	 	else if($_REQUEST['mode']=='new') { 
	 		if($o_arv_patient->insertARTPatient($o_val->getValues())){
	 			header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
	 		}
	 	}
  	}
  	else {
  		$messages=$o_val->getMessages();
  		$values=$o_arv_patient->getFormData($o_val->getValues());
  	}	
}
else {
	if($_GET['mode']=="new") {
		$values=$o_arv_patient->getDefaultData();
	}
	else if($_GET['mode']=="edit") {
		$values=$o_arv_patient->getFormData($o_arv_patient->getARTData());
	}
}

$errors=$o_arv_patient->getErrors();
$error_messages=$o_arv_patient->getErrorMessages();
if($errors!=0) {
	$errorString.="<div class=\"errorMessages\">"; 
	foreach($error_messages as $msg) {
		echo $msg;
	}
	$errorString.="</div>";
}

require ("gui/gui_arv_registration.php");

?>



