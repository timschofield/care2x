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

$eyeclinic->setprt1($_POST['prt1']);
$prt1=$eyeclinic->getprt1();

$eyeclinic->setplt1($_POST['plt1']);
$plt1=$eyeclinic->getplt1();

$eyeclinic->setprt2($_POST['prt2']);
$prt2=$eyeclinic->getprt2();

$eyeclinic->setplt2($_POST['plt2']);
$plt2=$eyeclinic->getplt2();

$eyeclinic->setprt3($_POST['prt3']);
$prt3=$eyeclinic->getprt3();

$eyeclinic->setplt3($_POST['plt3']);
$plt3=$eyeclinic->getplt3();

$eyeclinic->setprt4($_POST['prt4']);
$prt4=$eyeclinic->getprt4();

$eyeclinic->setplt4($_POST['plt4']);
$plt4=$eyeclinic->getplt4();

$eyeclinic->setprt5($_POST['prt5']);
$prt5=$eyeclinic->getprt5();

$eyeclinic->setplt5($_POST['plt5']);
$plt5=$eyeclinic->getplt5();

$eyeclinic->setprt6($_POST['prt6']);
$prt6=$eyeclinic->getprt6();

$eyeclinic->setplt6($_POST['plt6']);
$plt6=$eyeclinic->getplt6();

$eyeclinic->setprt7($_POST['prt7']);
$prt7=$eyeclinic->getprt7();

$eyeclinic->setplt7($_POST['plt7']);
$plt7=$eyeclinic->getplt7();


$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest4']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest4($pid,$prt1,$plt1,$prt2,$plt2,$prt3,$plt3,$prt4,$plt4,$prt5,$plt5,$prt6,$plt6,$prt7,$plt7,$comments,$signature);
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


require ("gui/gui_eye_examination_test4.php");

?>



