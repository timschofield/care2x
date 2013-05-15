<?php
require_once("roots.php");
;

require_once($root_path.'include/care_api_classes/supplier_database_class.php');//class file

global $supplier,$companyname,$contactperson,$address1,
         $address1,$phone1,$phone2,$cell1,$cell2,$email,$fax,
		 $banker,$bankdetail,$accountno,$creditlimit,$creditperiod;

$host="localhost";
$user="root";
$pass="";
$db=caredb;
$supplier=new supplier();

$supplier->setcompanyname($_POST['companyName']);
$companyname=$supplier->getcompanyname();

$supplier->setcontactperson($_POST['contactPerson']);
$contactperson=$supplier->getcontactperson();

$supplier->setaddress1($_POST['address1']);
$address1=$supplier->getaddress1();

$supplier->setaddress2($_POST['address2']);
$address2=$supplier->getaddress2();

$supplier->setphone1($_POST['phone1']);
$phone1=$supplier->getphone1();

$supplier->setphone2($_POST['phone2']);
$phone2=$supplier->getphone2();

$supplier->setcell1($_POST['cell1']);
$cell1=$supplier->getcell1();

$supplier->setcell2($_POST['cell2']);
$cell2=$supplier->getcell2();

$supplier->setemail($_POST['emailAddress']);
$email=$supplier->getemail();

$supplier->setfax($_POST['fax']);
$fax=$supplier->getfax();

$supplier->setbanker($_POST['banker']);
$banker=$supplier->getbanker();

$supplier->setbankdetail($_POST['bankDetail']);
$bankdetail=$supplier->getbankdetail();

$supplier->setaccountno($_POST['accountNumber']);
$accountno=$supplier->getaccountno();

$supplier->setcreditlimit($_POST['creditLimit']);
$creditlimit=$supplier->getcreditlimit();

$supplier->setcreditperiod($_POST['creditPeriod']);
$creditperiod=$supplier->getcreditperiod();
$supplier_id=$_POST['id'];
//make a connection to the database server
$connection=$supplier->dbconnect();
$supplier->dbselect();
if(isset($_POST['addsupplier']) && !$_POST['id']&& !$_POST['mode']){
//add supplier information to the database
$add=$supplier->addSupplier($companyname, $contactperson,$address1,$address2,$phone1,$phone2,$cell1,$cell2, $email,$fax,$banker,$bankdetail,$accountno,$creditlimit,$creditperiod );

if($add==true){
	$message="Supplier $companyname is Saved in the Database!";
}else{
	echo 'check your query';
}


}else if(isset($_POST['addsupplier'])&& $supplier_id && !$_POST['mode']){
	//here is where updation goes
	$edit=$supplier->update_supplier($supplier_id,$companyname, $contactperson,$address1,$address2,$phone1,$phone2,$cell1,$cell2, $email,$fax,$banker,$bankdetail,$accountno,$creditlimit,$creditperiod );
	if($edit==true){
		$message="Supplier $companyname `s informations modified succesful";
	}else{
		echo "Check query";
	}
}else if(isset($_POST['addsupplier'])&& $supplier_id && $_POST['mode']){
	$delete=$supplier->detete_supplier($supplier_id);
	if($delete){
		$message="Supplier  $companyname  deleted from the Database!";
	}else{
		echo $delete;
	}

}


require_once('gui/gui_supplier_add.php');


?>


