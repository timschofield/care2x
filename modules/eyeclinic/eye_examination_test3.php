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

$eyeclinic->setfoosrt1($_POST['foosrt1']);
$foosrt1=$eyeclinic->getfoosrt1();

$eyeclinic->setfooslt1($_POST['fooslt1']);
$fooslt1=$eyeclinic->getfooslt1();

$eyeclinic->setfoosrt2($_POST['foosrt2']);
$foosrt2=$eyeclinic->getfoosrt2();

$eyeclinic->setfooslt2($_POST['fooslt2']);
$fooslt2=$eyeclinic->getfooslt2();

$eyeclinic->setfoosrt3($_POST['foosrt3']);
$foosrt3=$eyeclinic->getfoosrt3();

$eyeclinic->setfooslt3($_POST['fooslt3']);
$fooslt3=$eyeclinic->getfooslt3();

$eyeclinic->setfoosrt4($_POST['foosrt4']);
$foosrt4=$eyeclinic->getfoosrt4();

$eyeclinic->setfooslt4($_POST['fooslt4']);
$fooslt4=$eyeclinic->getfooslt4();

$eyeclinic->setfoosrt5($_POST['foosrt5']);
$foosrt5=$eyeclinic->getfoosrt5();

$eyeclinic->setfooslt5($_POST['fooslt5']);
$fooslt5=$eyeclinic->getfooslt5();

$eyeclinic->setfoosrt6($_POST['foosrt6']);
$foosrt6=$eyeclinic->getfoosrt6();

$eyeclinic->setfooslt6($_POST['fooslt6']);
$fooslt6=$eyeclinic->getfooslt6();

$eyeclinic->setfoosrt7($_POST['foosrt7']);
$foosrt7=$eyeclinic->getfoosrt7();

$eyeclinic->setfooslt7($_POST['fooslt7']);
$fooslt7=$eyeclinic->getfooslt7();


$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest3']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest3($pid,$foosrt1,$fooslt1,$foosrt2,$fooslt2,$foosrt3,$fooslt3,$foosrt4,$fooslt4,$foosrt5,$fooslt5,$foosrt6,$fooslt6,$foosrt7,$fooslt7,$comments,$signature);
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


require ("gui/gui_eye_examination_test3.php");

?>



