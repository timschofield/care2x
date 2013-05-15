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

$eyeclinic->settrt1($_POST['trt1']);
$trt1=$eyeclinic->gettrt1();

$eyeclinic->settl1($_POST['tl1']);
$tl1=$eyeclinic->gettl1();

$eyeclinic->settrt2($_POST['trt2']);
$trt2=$eyeclinic->gettrt2();

$eyeclinic->settl2($_POST['tl2']);
$tl2=$eyeclinic->gettl2();

$eyeclinic->settrt3($_POST['trt3']);
$trt3=$eyeclinic->gettrt3();

$eyeclinic->settl3($_POST['tl3']);
$tl3=$eyeclinic->gettl3();

$eyeclinic->settrt4($_POST['trt4']);
$trt4=$eyeclinic->gettrt4();

$eyeclinic->settl4($_POST['tl4']);
$tl4=$eyeclinic->gettl4();

$eyeclinic->settrt5($_POST['trt5']);
$trt5=$eyeclinic->gettrt5();

$eyeclinic->settl5($_POST['tl5']);
$tl5=$eyeclinic->gettl5();

$eyeclinic->settrt6($_POST['trt6']);
$trt6=$eyeclinic->gettrt6();

$eyeclinic->settl6($_POST['tl6']);
$tl6=$eyeclinic->gettl6();

$eyeclinic->settrt7($_POST['trt7']);
$trt7=$eyeclinic->gettrt7();

$eyeclinic->settl7($_POST['tl7']);
$tl7=$eyeclinic->gettl7();

$eyeclinic->settrt8($_POST['trt8']);
$trt8=$eyeclinic->gettrt8();

$eyeclinic->settl8($_POST['tl8']);
$tl8=$eyeclinic->gettl8();

$eyeclinic->settrt9($_POST['trt9']);
$trt9=$eyeclinic->gettrt9();

$eyeclinic->settl9($_POST['tl9']);
$tl9=$eyeclinic->gettl9();

$eyeclinic->settr10($_POST['tr10']);
$tr10=$eyeclinic->gettr10();

$eyeclinic->settl10($_POST['tl10']);
$tl10=$eyeclinic->gettl10();

$eyeclinic->settr11($_POST['tr11']);
$tr11=$eyeclinic->gettr11();

$eyeclinic->settl11($_POST['tl11']);
$tl11=$eyeclinic->gettl11();

$eyeclinic->settr12($_POST['tr12']);
$tr12=$eyeclinic->gettr12();

$eyeclinic->settl12($_POST['tl12']);
$tl12=$eyeclinic->gettl12();


$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest6']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest6($pid,$trt1,$tl1,$trt2,$tl2,$trt3,$tl3,$trt4,$tl4,$trt5,$tl5,$trt6,$tl6,$trt7,$tl7,$trt8,$tl8,$trt9,$tl9,$tr10,$tl10,$tr11,$tl11,$tr12,$tl12,$comments,$signature);
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


require ("gui/gui_eye_examination_test6.php");

?>



