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

$eyeclinic->setlr1($_POST['lr1']);
$lr1=$eyeclinic->getlr1();

$eyeclinic->setll1($_POST['ll1']);
$ll1=$eyeclinic->getll1();

$eyeclinic->setlr2($_POST['lr2']);
$lr2=$eyeclinic->getlr2();

$eyeclinic->setll2($_POST['ll2']);
$ll2=$eyeclinic->getll2();

$eyeclinic->setlr3($_POST['lr3']);
$lr3=$eyeclinic->getlr3();

$eyeclinic->setll3($_POST['ll3']);
$ll3=$eyeclinic->getll3();

$eyeclinic->setlr4($_POST['lr4']);
$lr4=$eyeclinic->getlr4();

$eyeclinic->setll4($_POST['ll4']);
$ll4=$eyeclinic->getll4();

$eyeclinic->setlr5($_POST['lr5']);
$lr5=$eyeclinic->getlr5();

$eyeclinic->setll5($_POST['ll5']);
$ll5=$eyeclinic->getll5();

$eyeclinic->setlr6($_POST['lr6']);
$lr6=$eyeclinic->getlr6();

$eyeclinic->setll6($_POST['ll6']);
$ll6=$eyeclinic->getll6();

$eyeclinic->setlr7($_POST['lr7']);
$lr7=$eyeclinic->getlr7();

$eyeclinic->setll7($_POST['ll7']);
$ll7=$eyeclinic->getll7();

$eyeclinic->setlr8($_POST['lr8']);
$lr8=$eyeclinic->getlr8();

$eyeclinic->setll8($_POST['ll8']);
$ll8=$eyeclinic->getll8();


$eyeclinic->setlr9($_POST['lr9']);
$lr9=$eyeclinic->getlr9();

$eyeclinic->setll9($_POST['ll9']);
$ll9=$eyeclinic->getll9();

$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest11']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest11($pid,$lr1,$ll1,$lr2,$ll2,$lr3,$ll3,$lr4,$ll4,$lr5,$ll5,$lr6,$ll6,$lr7,$ll7,$lr8,$ll8,$lr9,$ll9,$comments,$signature);
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


require ("gui/gui_eye_examination_test11.php");

?>



