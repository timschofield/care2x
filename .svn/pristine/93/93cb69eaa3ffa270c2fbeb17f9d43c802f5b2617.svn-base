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

$eyeclinic->setpsr1($_POST['psr1']);
$psr1=$eyeclinic->getpsr1();

$eyeclinic->setpsl1($_POST['psl1']);
$psl1=$eyeclinic->getpsl1();

$eyeclinic->setpsr2($_POST['psr2']);
$psr2=$eyeclinic->getpsr2();

$eyeclinic->setpsl2($_POST['psl2']);
$psl2=$eyeclinic->getpsl2();

$eyeclinic->setpsr3($_POST['psr3']);
$psr3=$eyeclinic->getpsr3();

$eyeclinic->setpsl3($_POST['psl3']);
$psl3=$eyeclinic->getpsl3();

$eyeclinic->setpsr4($_POST['psr4']);
$psr4=$eyeclinic->getpsr4();

$eyeclinic->setpsl4($_POST['psl4']);
$psl4=$eyeclinic->getpsl4();

$eyeclinic->setpsr5($_POST['psr5']);
$psr5=$eyeclinic->getpsr5();

$eyeclinic->setpsl5($_POST['psl5']);
$psl5=$eyeclinic->getpsl5();

$eyeclinic->setpsr6($_POST['psr6']);
$psr6=$eyeclinic->getpsr6();

$eyeclinic->setpsl6($_POST['psl6']);
$psl6=$eyeclinic->getpsl6();

$eyeclinic->setpsr7($_POST['psr7']);
$psr7=$eyeclinic->getpsr7();

$eyeclinic->setpsl7($_POST['psl7']);
$psl7=$eyeclinic->getpsl7();

$eyeclinic->setpsr8($_POST['psr8']);
$psr8=$eyeclinic->getpsr8();

$eyeclinic->setpsl8($_POST['psl8']);
$psl8=$eyeclinic->getpsl8();


$eyeclinic->setpsr9($_POST['psr9']);
$psr9=$eyeclinic->getpsr9();

$eyeclinic->setpsl9($_POST['psl9']);
$psl9=$eyeclinic->getpsl9();

$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest12']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest12($pid,$psr1,$psl1,$psr2,$psl2,$psr3,$psl3,$psr4,$psl4,$psr5,$psl5,$psr6,$psl6,$psr7,$psl7,$psr8,$psl8,$psr9,$psl9,$comments,$signature);
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


require ("gui/gui_eye_examination_test12.php");

?>



