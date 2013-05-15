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

$eyeclinic->setodr1($_POST['odr1']);
$odr1=$eyeclinic->getodr1();

$eyeclinic->setodl1($_POST['odl1']);
$odl1=$eyeclinic->getodl1();

$eyeclinic->setodr2($_POST['odr2']);
$odr2=$eyeclinic->getodr2();

$eyeclinic->setodl2($_POST['odl2']);
$odl2=$eyeclinic->getodl2();

$eyeclinic->setodr3($_POST['odr3']);
$odr3=$eyeclinic->getodr3();

$eyeclinic->setodl3($_POST['odl3']);
$odl3=$eyeclinic->getodl3();

$eyeclinic->setodr4($_POST['odr4']);
$odr4=$eyeclinic->getodr4();

$eyeclinic->setodl4($_POST['odl4']);
$odl4=$eyeclinic->getodl4();

$eyeclinic->setodr5($_POST['odr5']);
$odr5=$eyeclinic->getodr5();

$eyeclinic->setodl5($_POST['odl5']);
$odl5=$eyeclinic->getodl5();

$eyeclinic->setodr6($_POST['odr6']);
$odr6=$eyeclinic->getodr6();

$eyeclinic->setodl6($_POST['odl6']);
$odl6=$eyeclinic->getodl6();


$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest13']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest13($pid,$odr1,$odl1,$odr2,$odl2,$odr3,$odl3,$odr4,$odl4,$odr5,$odl5,$odr6,$odl6,$comments,$signature);
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


require ("gui/gui_eye_examination_test13.php");

?>



