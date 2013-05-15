<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;

	/*include('includes/condb.php');
	error_reporting(0);
	connect_db();*/

	if($currentamt=="")
	      $currentamt=0;

	$presdate=date("Y-m-d");
	$presdatetime=date("Y-m-d H:i:s");
	
	$sql="SELECT payment_receipt_no FROM care_billing_payment ORDER BY payment_receipt_no DESC";
	$ergebnis=$db->SelectLimit($sql,1);
	if(is_object($ergebnis)) $cntergebnis=$ergebnis->RecordCount();
/*	$ergebnis=mysql_query($sql);
	$cntergebnis=mysql_num_rows($ergebnis);
*/
	$actMil=2000;
	$ybr=date(Y)-$actMil;



	//check for empty set

	if($cntergebnis !=0)
	{
		$result=$ergebnis->FetchRow();
		$receipt_no=$result['payment_receipt_no'];

		// add one to receipt number for new bill
		$receipt_no+=1;
	}
	else
	{
		//generate new bill number

		$ybr="6".$ybr."000000";

		$receipt_no=(int)$ybr;

	}


	if($receipt_no==10000000000) $receipt_no="6".$ybr."000000";
	// limit to 10 digit, reset variables
	

	$chkfinalquery="SELECT * from care_billing_final WHERE final_encounter_nr='$patientno'";
	$chkfinalresult=$db->Execute($chkfinalquery);
	$chkexists=$chkfinalresult->RecordCount();
	if($chkexists<1)
	{
		$insfinalbill="INSERT INTO care_billing_final (final_encounter_nr, final_bill_no, final_date, final_total_bill_amount, final_discount, final_total_receipt_amount, final_amount_due, final_amount_recieved) VALUES ($patientno, $final_bill_no, '$presdate', $totalbill,$discount, $paidamt,$amtdue,$currentamt)";
		//$resultinsfinalbill=mysql_query($insfinalbill);
		$core->Transact($insfinalbill);
	}
	
	
	$inspmtqry="INSERT INTO care_billing_payment VALUES ('','$patientno','$receipt_no','$presdatetime','$currentamt','0','0','0','0','$currentamt')";
	//$inspmtqryres=mysql_query($inspmtqry);
	$core->Transact($inspmtqry);
	
	
	//disconnect_db();
/*	$patmenu="patientbill.php?patnum=$patientno";
	echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
*/
	$patmenu="patientbill.php".URL_REDIRECT_APPEND."&patnum=$patientno&full_en=$full_en&service=$service";
	//echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
header('Location:'.$patmenu);
exit;

?>
