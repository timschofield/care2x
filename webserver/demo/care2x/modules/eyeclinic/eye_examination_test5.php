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

$eyeclinic->setssrt1($_POST['ssrt1']);
$ssrt1=$eyeclinic->getssrt1();

$eyeclinic->setsslt1($_POST['sslt1']);
$sslt1=$eyeclinic->getsslt1();

$eyeclinic->setssrt2($_POST['ssrt2']);
$ssrt2=$eyeclinic->getssrt2();

$eyeclinic->setsslt2($_POST['sslt2']);
$sslt2=$eyeclinic->getsslt2();

$eyeclinic->setssrt3($_POST['ssrt3']);
$ssrt3=$eyeclinic->getssrt3();

$eyeclinic->setsslt3($_POST['sslt3']);
$sslt3=$eyeclinic->getsslt3();

$eyeclinic->setssrt4($_POST['ssrt4']);
$ssrt4=$eyeclinic->getssrt4();

$eyeclinic->setsslt4($_POST['sslt4']);
$sslt4=$eyeclinic->getsslt4();

$eyeclinic->setssrt5($_POST['ssrt5']);
$ssrt5=$eyeclinic->getssrt5();

$eyeclinic->setsslt5($_POST['sslt5']);
$sslt5=$eyeclinic->getsslt5();



$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest5']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest5($pid,$ssrt1,$sslt1,$ssrt2,$sslt2,$ssrt3,$sslt3,$ssrt4,$sslt4,$ssrt5,$sslt5,$comments,$signature);
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


require ("gui/gui_eye_examination_test5.php");

?>



