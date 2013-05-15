<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* 
* 
* 
* 
* 
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;

//$db->debug=1;

	//ob_start();
	/*include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
	
	$presdate=date("Y-m-d");

	$savebillquery="UPDATE care_billing_bill_item SET bill_item_status='1',bill_item_bill_no='$billno' where bill_item_encounter_nr='$patientno' and bill_item_status='0'";
	//$savebillresult=mysql_query($savebillquery);
	$core->Transact($savebillquery);
	
		
	/* $billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding) VALUES ($billno,$patientno,'$presdatetime',$total,$outstanding)";*/
	$billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding) VALUES ($billno,$patientno,'$presdate',$total,$outstanding)";

	//echo $billquery="INSERT INTO care_billing_bill (bill_bill_no, bill_encounter_nr, bill_date_time, bill_amount, bill_outstanding) VALUES ($billno,$patientno,'$presdate',$total,$outstanding)";

		
	$core->Transact($billquery);

	//$resultbillquery=mysql_query($billquery);	
	//$core->Transact($resultbillquery);
	
	//echo $resultbillquery;
	
	/*$redir="patientbill.php?patnum=".$pno;
	header("location:".$redir);
	exit;*/

	//disconnect_db();
	$patmenu="patient_bill_links.php".URL_REDIRECT_APPEND."&patientno=$patientno&full_en=$full_en";
	//echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
header('Location:'.$patmenu);
exit;

?>
