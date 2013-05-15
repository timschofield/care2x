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

$eyeclinic->seter1($_POST['er1']);
$er1=$eyeclinic->geter1();

$eyeclinic->setel1($_POST['el1']);
$el1=$eyeclinic->getel1();

$eyeclinic->seter2($_POST['er2']);
$er2=$eyeclinic->geter2();

$eyeclinic->setel2($_POST['el2']);
$el2=$eyeclinic->getel2();

$eyeclinic->seter3($_POST['er3']);
$er3=$eyeclinic->geter3();

$eyeclinic->setel3($_POST['el3']);
$el3=$eyeclinic->getel3();

$eyeclinic->seter4($_POST['er4']);
$er4=$eyeclinic->geter4();

$eyeclinic->setel4($_POST['el4']);
$el4=$eyeclinic->getel4();

$eyeclinic->seter5($_POST['er5']);
$er5=$eyeclinic->geter5();

$eyeclinic->setel5($_POST['el5']);
$el5=$eyeclinic->getel5();

$eyeclinic->seter6($_POST['er6']);
$er6=$eyeclinic->geter6();

$eyeclinic->setel6($_POST['el6']);
$el6=$eyeclinic->getel6();

$eyeclinic->seter7($_POST['er7']);
$er7=$eyeclinic->geter7();

$eyeclinic->setel7($_POST['el7']);
$el7=$eyeclinic->getel7();

$eyeclinic->seter8($_POST['er8']);
$er8=$eyeclinic->geter8();

$eyeclinic->setel8($_POST['el8']);
$el8=$eyeclinic->getel8();

$eyeclinic->seter9($_POST['er9']);
$er9=$eyeclinic->geter9();

$eyeclinic->setel9($_POST['el9']);
$el9=$eyeclinic->getel9();


$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest7']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest7($pid,$er1,$el1,$er2,$el2,$er3,$el3,$er4,$el4,$er5,$el5,$er6,$el6,$er7,$el7,$er8,$el8,$er9,$el9,$comments,$signature);
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


require ("gui/gui_eye_examination_test7.php");

?>



