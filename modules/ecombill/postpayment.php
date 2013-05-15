<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* Dilip Bharatee
* Abrar Hazarika
* Prantar Deka
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;

	/*include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
	$presdatetime=date("Y-m-d G:i:s");
	
	if($amtcash=="")
	    $amtcash=0;
	if($cdno=="")
	    $cdno=0;    
        if($amtcc=="")
	    $amtcc=0;
        if($chkno=="")
	    $chkno=0;
        if($amtcheque=="")
	    $amtcheque=0;
	
	$totalamount=$amtcash+$amtcc+$amtcheque;
	$paymentqry="INSERT INTO care_billing_payment (payment_encounter_nr,payment_receipt_no,payment_date,payment_cash_amount,payment_cheque_no,payment_cheque_amount,payment_creditcard_no,payment_creditcard_amount,payment_amount_total) VALUES ($patientno,$receipt_no,'$presdatetime',$amtcash,$chkno,$amtcheque,$cdno,$amtcc,$totalamount)";
	//$resultpaymentqry=mysql_query($paymentqry);
	
	$core->Transact($paymentqry);

 	//disconnect_db();
 	//$patmenu="patientbill.php?patnum=$patientno";
	$patmenu="patient_payment_links.php".URL_REDIRECT_APPEND."&patientno=$patientno&full_en=$full_en";
	//echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
header('Location:'.$patmenu);
exit;
?>
