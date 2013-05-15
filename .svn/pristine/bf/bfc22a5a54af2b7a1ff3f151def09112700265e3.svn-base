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

$eyeclinic->setiprt1($_POST['iprt1']);
$iprt1=$eyeclinic->getiprt1();

$eyeclinic->setiplt1($_POST['iplt1']);
$iplt1=$eyeclinic->getiplt1();

$eyeclinic->setipt2($_POST['ipt2']);
$ipt2=$eyeclinic->getipt2();

$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest2']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest2($pid,$iprt1,$iplt1,$ipt2,$signature);
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


require ("gui/gui_eye_examination_test2.php");

?>



