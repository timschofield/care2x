<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_visit.php');
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

//------------------------------------------------------------------------------------------------------------
if(empty($_REQUEST['pid']) OR empty($_REQUEST['encounter_nr'])) {
	$error_messages="<div class=\"errorMessages\">No patient is selected! </div>";
	require ("gui/gui_arv_visit.php");
	die();
}
$o_arv_patient=new ART_patient($_REQUEST['pid']); 
$o_arv_patient->getARTData();
$o_arv_visit=new ARV_Visit($_REQUEST['encounter_nr'],$_REQUEST['visit_id'],$o_arv_patient->getRegistrationID());
	
$art_info=$o_arv_patient->getshortARTSummary();

if(isset($_REQUEST['submit'])) {
	$o_val=new Validator($o_arv_visit->getDefaultData(),$_REQUEST);
	$o_val->set_rule('visit_date','rule_required');
	$o_val->set_rule('signature','rule_required');
	
	$o_val->set_rule('regimen_days','rule_numeric');
	$o_val->set_rule('cd4','rule_numeric');
	$o_val->set_rule('hb','rule_numeric');
	$o_val->set_rule('alt','rule_numeric');
	
	$o_val->set_rule('signature','rule_min_chars',3);
	
	$o_val->set_rule('visit_date','rule_date');
	$o_val->set_rule('date_of_delivery','rule_date');
	$o_val->set_rule('next_visit_date','rule_date');
	
	$o_val->set_rule('weight','rule_decimal');
	$o_val->set_rule('height','rule_decimal');

	$o_val->applyRules(); 
	
	
	if(($o_val->getErrors())==0){ 	
		if (!empty($_REQUEST['visit_id'])) { 
	 		if($o_arv_visit->updateARTVisit($o_val->getValues())) {
	 			header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
	 		}
	 	}
	 	else if(empty($_REQUEST['visit_id'])) { 
	 		if($o_arv_visit->insertARTVisit($o_val->getValues())){
	 			header("location: http://$host$uri/$filename".URL_REDIRECT_APPEND."$add_breakfile");
				exit;
	 		}
	 	}
  	}
  	else {
  		$messages=$o_val->getMessages();
  		$values=$o_arv_visit->getFormData($o_val->getValues());
  	}	
}
else {
	if(!empty($_REQUEST['visit_id'])) {
		$vars=$o_arv_visit->getDefaultData();		
		$values=$o_arv_visit->getFormData($o_arv_visit->getVisitData());
		$values['signature']=$vars['signature'];
	}
	else  {
		$values=$o_arv_visit->getDefaultData();
	}
}

$errors=$o_arv_visit->getErrors();
$error_messages=$o_arv_visit->getErrorMessages();
if($errors!=0) {
	$errorString.="<div class=\"errorMessages\">"; 
	foreach($error_messages as $msg) {
		echo $msg;
	}
	$errorString.="</div>";
}

require ("gui/gui_arv_visit.php");
?>



