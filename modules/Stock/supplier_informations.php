<?php
require('./roots.php');

require($root_path.'include/care_api_classes/supplier_database_class.php');

global $mode,$supplier_id,$result,$show_result,$results;

$mode=$_REQUEST['mode'];
$supplier_id=$_REQUEST['supplier_id'];
if(!$mode || !$supplier_id){
	header('Location:supplier_serach.php');
	exit;
}
$supplier_obj=new supplier;
$supplier_obj->dbconnect();
$supplier_obj->dbselect();

switch($mode){
	case 'show':
	$result=$supplier_obj->show_supplier_details($supplier_id);
	$results='gui/gui_show_supplier.php';
	break;

	case 'edit':
	$result=$supplier_obj->show_supplier_details($supplier_id);

	$results='gui/gui_edit_supplier.php';
	break;
	case 'erase':
	$result=$supplier_obj->show_supplier_details($supplier_id);
	$results='gui/gui_delete_supplier.php';
}
while($show_result=$supplier_obj->fetch_object($result)){
	$id=$show_result->Suplier_id;
	$company=$show_result->Company_Name;
	$person=$show_result->Contact_Person;
	$address1=$show_result->Address1;
	$address2=$show_result->Address2;
	$phone1=$show_result->Phone1;
	$phone2=$show_result->Phone2;
	$cell1=$show_result->Cell1;
	$cell2=$show_result->Cell2;
	$mail=$show_result->Email;
	$fax=$show_result->Fax;
	$banker=$show_result->Banker;
	$bankdetails=$show_result->Bank_Details;
	$account=$show_result->Account_no;
	$creditlimit=$show_result->Credit_Limit;
	$creditperiod=$show_result->Credit_Period;
}

require_once($results);
exit;
?>