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

$eyeclinic->setcor1($_POST['cor1']);
$cor1=$eyeclinic->getcor1();

$eyeclinic->setcol1($_POST['col1']);
$col1=$eyeclinic->getcol1();

$eyeclinic->setcor2($_POST['cor2']);
$cor2=$eyeclinic->getcor2();

$eyeclinic->setcol2($_POST['col2']);
$col2=$eyeclinic->getcol2();

$eyeclinic->setcor3($_POST['cor3']);
$cor3=$eyeclinic->getcor3();

$eyeclinic->setcol3($_POST['col3']);
$col3=$eyeclinic->getcol3();

$eyeclinic->setcor4($_POST['cor4']);
$cor4=$eyeclinic->getcor4();

$eyeclinic->setcol4($_POST['col4']);
$col4=$eyeclinic->getcol4();

$eyeclinic->setcor5($_POST['cor5']);
$cor5=$eyeclinic->getcor5();

$eyeclinic->setcol5($_POST['col5']);
$col5=$eyeclinic->getcol5();

$eyeclinic->setcor6($_POST['cor6']);
$cor6=$eyeclinic->getcor6();

$eyeclinic->setcol6($_POST['col6']);
$col6=$eyeclinic->getcol6();

$eyeclinic->setcor7($_POST['cor7']);
$cor7=$eyeclinic->getcor7();

$eyeclinic->setcol7($_POST['col7']);
$col7=$eyeclinic->getcol7();




$eyeclinic->setsignature($_POST['signature']);
$signature=$eyeclinic->getsignature();

$eyeclinic->setpid($_POST['pid']);
$pid=$eyeclinic->getpid();

$connection=$eyeclinic->dbconnect();
$eyeclinic->dbselect();



if(isset($_POST['addtest9']) ){
//echo 'add eyeclinic information to the database';
$add=$eyeclinic->addTest9($pid,$cor1,$col1,$cor2,$col2,$cor3,$col3,$cor4,$col4,$cor5,$col5,$cor6,$col6,$cor7,$col7,$comments,$signature);
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


require ("gui/gui_eye_examination_test9.php");

?>



