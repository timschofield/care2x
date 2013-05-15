<?php
require_once($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
$app_types=$pres_obj->getAppTypes();
$pres_types=$pres_obj->getPrescriptionTypes();

require_once($root_path.'include/care_api_classes/class_person.php');
$person_obj = new Person;
if (empty($encounter_nr) and !empty($pid))
	$encounter_nr = $person_obj->CurrentEncounter($pid);

$debug = FALSE;

if ($debug) {
	if (!empty($back_path)) $backpath=$back_path;

	echo "file: show_prescription<br>";
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "backpath: ".$backpath."<br>";

    echo "pid:".$pid."<br>";

    echo "encounter_nr:".$encounter_nr;
}

if (!empty($show)) {
  // The $show-Value comes from the input-type button and will be send by javascript (check_prescriptions.js)
  if ($show=='Drug List') {
      $activated_tab='druglist';
      $db_drug_filter='drug_list';
    }
  if ($show=='Supplies') {
      $activated_tab='Supplies';
      $db_drug_filter='supplies';
    }
  if ($show=='Supplies-Lab') {
      $activated_tab='supplies-lab';
      $db_drug_filter='supplies_laboratory';
    }
  if ($show=='Special Others') {
      $activated_tab='special-others';
      $db_drug_filter='special_others_list';
    }
  if ($show=='service') {
      $activated_tab='service';
      $db_drug_filter='service';
    }
  if ($show=='xray') {
      $activated_tab='xray';
      $db_drug_filter='xray';
    }
  if ($show=='dental') {
      $activated_tab='dental';
      $db_drug_filter='dental';
    }
  if ($show=='Eye-service') {
      $activated_tab='eye-service';
      $db_drug_filter='eye-service';
    }
  if ($show=='Minor_op') {
      $activated_tab='minor_proc_op';
      $db_drug_filter='minor_proc_op';
    }
  if ($show=='Obgyne_op') {
      $activated_tab='obgyne_op';
      $db_drug_filter='obgyne_op';
    }
  if ($show=='Ortho_op') {
      $activated_tab='ortho_op';
      $db_drug_filter='ortho_op';
    }
  if ($show=='Surgical_op') {
      $activated_tab='surgical_op';
      $db_drug_filter='surgical_op';
    }



  if ($show=='insert') {
    if (empty($_SESSION['item_array'])) {
      //echo "Taking items from get values...<br>";
      $_SESSION[item_array]=$item_no; // this is comming from gui_inpuit_prescription_preselection.php as GET variables!
    }

    // The prescription list is complete, so we can go to ask about the details
    // of each item

    include('./gui_bridge/default/gui_input_prescription_details.php');
  } else {

    include('./gui_bridge/default/gui_input_prescription_preselection.php');
  }
} else {

	if ($prescrServ=="serv")
	   {
		$show ="service";
	   	echo 'show SERVICE activated';

	   }
	   else
	   {
	   	$show="druglist";
		echo 'show DRUGLIST activated';
	   }

  // first call of descriptions. The value $show is not set in this case.
  include('./gui_bridge/default/gui_input_prescription_preselection.php');
}