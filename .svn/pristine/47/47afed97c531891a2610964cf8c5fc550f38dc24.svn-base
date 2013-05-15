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

$o_arv_patient=new ART_patient($_REQUEST['pid'],$_REQUEST['registration_id']);

$registration_data=$o_arv_patient->getRegistrationData();




global $vart1,$vart2,$vart3,$valt1,$valt2,$valt3,$signature;

$eyeclinic=new eyeclinic();

$eyeclinic->setacr1($_POST['acr1']);
$acr1=$eyeclinic->getacr1();

$eyeclinic->setacl1($_POST['acl1']);
$acl1=$eyeclinic->getacl1();

$eyeclinic->setacr2($_POST['acr2']);
$acr2=$eyeclinic->getacr2();

$eyeclinic->setacl2($_POST['acl2']);
$acl2=$eyeclinic->getacl2();

$eyeclinic->setacr3($_POST['acr3']);
$acr3=$eyeclinic->getacr3();

$eyeclinic->setacl3($_POST['acl3']);
$acl3=$eyeclinic->getacl3();

$eyeclinic->setacr4($_POST['acr4']);
$acr4=$eyeclinic->getacr4();

$eyeclinic->setacl4($_POST['acl4']);
$acl4=$eyeclinic->getacl4();

$eyeclinic->setacr5($_POST['acr5']);
$acr5=$eyeclinic->getacr5();

$eyeclinic->setacl5($_POST['acl5']);
$acl5=$eyeclinic->getacl5();

$eyeclinic->setacr6($_POST['acr6']);
$acr6=$eyeclinic->getacr6();

$eyeclinic->setacl6($_POST['acl6']);
$acl6=$eyeclinic->getacl6();

$eyeclinic->setacr7($_POST['acr7']);
$acr7=$eyeclinic->getacr7();

$eyeclinic->setacl7($_POST['acl7']);
$acl7=$eyeclinic->getacl7();




$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest10']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest10($pid,$acr1,$acl1,$acr2,$acl2,$acr3,$acl3,$acr4,$acl4,$acr5,$acl5,$acr6,$acl6,$acr7,$acl7,$comments,$signature);
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


require ("gui/gui_eye_examination_test10.php");

?>



