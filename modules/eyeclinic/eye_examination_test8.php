<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_patient.php');
require_once($root_path.'include/care_api_classes/class_eye_clinic.php');

//-------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------

$o_arv_patient=&new ART_patient($_REQUEST['pid'],$_REQUEST['registration_id']);

$registration_data=$o_arv_patient->getRegistrationData();




global $vart1,$vart2,$vart3,$valt1,$valt2,$valt3,$signature;

$eyeclinic=new eyeclinic();

$eyeclinic->setcr1($_POST['cr1']);
$cr1=$eyeclinic->getcr1();

$eyeclinic->setcl1($_POST['cl1']);
$cl1=$eyeclinic->getcl1();

$eyeclinic->setcr2($_POST['cr2']);
$cr2=$eyeclinic->getcr2();

$eyeclinic->setcl2($_POST['cl2']);
$cl2=$eyeclinic->getcl2();

$eyeclinic->setcr3($_POST['cr3']);
$cr3=$eyeclinic->getcr3();

$eyeclinic->setcl3($_POST['cl3']);
$cl3=$eyeclinic->getcl3();

$eyeclinic->setcr4($_POST['cr4']);
$cr4=$eyeclinic->getcr4();

$eyeclinic->setcl4($_POST['cl4']);
$cl4=$eyeclinic->getcl4();

$eyeclinic->setcr5($_POST['cr5']);
$cr5=$eyeclinic->getcr5();

$eyeclinic->setcl5($_POST['cl5']);
$cl5=$eyeclinic->getcl5();

$eyeclinic->setcr6($_POST['cr6']);
$cr6=$eyeclinic->getcr6();

$eyeclinic->setcl6($_POST['cl6']);
$cl6=$eyeclinic->getcl6();

$eyeclinic->setcr7($_POST['cr7']);
$cr7=$eyeclinic->getcr7();

$eyeclinic->setcl7($_POST['cl7']);
$cl7=$eyeclinic->getcl7();

$eyeclinic->setcr8($_POST['cr8']);
$cr8=$eyeclinic->getcr8();

$eyeclinic->setcl8($_POST['cl8']);
$cl8=$eyeclinic->getcl8();



$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest8']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest8($pid,$cr1,$cl1,$cr2,$cl2,$cr3,$cl3,$cr4,$cl4,$cr5,$cl5,$cr6,$cl6,$cr7,$cl7,$cr8,$cl8,$comments,$signature);
if($add==true){
	$message="eyeclinic $companyname is Saved in the Database!";
}else{
	echo 'check your query';
}

}else if(isset($_POST['addeyeclinic'])&& $eyeclinic_id && !$_POST['mode']){
	//here is where updation goes
	$edit=$eyeclinic->update_eyeclinic($eyeclinic_id,$companyname, $contactperson,$address1,$address2,$phone1,$phone2,$cell1,$cell2, $email,$fax,$banker,$bankdetail,$accountno,$creditlimit,$creditperiod );
	if($edit==true){
		$message="eyeclinic $companyname `s informations modified succesful";
	}else{
		echo "Check query";
	}
}else if(isset($_POST['addeyeclinic'])&& $eyeclinic_id && $_POST['mode']){
	$delete=$eyeclinic->detete_eyeclinic($eyeclinic_id);
	if($delete){
		$message="eyeclinic  $companyname  deleted from the Database!";
	}else{
		echo $delete;
	}

}


require ("gui/gui_eye_examination_test8.php");

?>



