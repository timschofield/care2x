<?php

	/**
	  *
	  * for BILLING
	  *
	  **/

	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');

	if (($_GET['type']) &&
				($_GET['encounter']) &&
						($_GET['total'])){

		require($root_path.'include/inc_environment_global.php');
		include_once($root_path.'include/care_api_classes/class_mini_dental.php');

		if ((intval($_GET['total']))<(intval($_GET['pay']))) { $paid = $_GET['total']; } else {$paid=$_GET['pay'];}

		$fder = $_GET['encounter'] . '|'.
				  	$paid . '|'.
				  		$_GET['type'] . '|'.
				  			$_GET['total'] . '|'.
				  				intval( intval($_GET['total'])- intval($_GET['pay']));

		$pobj= new dental;

		$fder .= '|' . $pobj->GetNamesFromBatchNo($_GET['bachno']) . '|';

		$fder .=$_GET['billno'];

		//echo $fder;

		$pobj->dentalPoorFundInsert($fder);

		include_once($root_path.'include/care_api_classes/class_multi.php');
		$multi= new multi;

		$multi->doctorSTAT($HTTP_SESSION_VARS['sess_login_userid'],$encounter);

		//	echo 'saved';

	}


	/**
	  *
	  * for PATIENT NOTES
	  *
	  **/


	if (($_GET['types']) &&
		   ($_GET['notes']) &&
				($_GET['by'])&&
					($_GET['remove']=='')
					){

		require($root_path.'include/inc_environment_global.php');
		include_once($root_path.'include/care_api_classes/class_mini_dental.php');

		$getall = $_GET['encounter'] . '+'.
						  $_GET['types'] . '+'.
							  $_GET['short'] . '+'.
								  $_GET['notes'] . '+'.
									     $_GET['by'] . '+'.
										   $_GET['mode']. '+'.
										  	   $_GET['nr'];

		$note_obj = new dental;

		$note_obj->SaveNewPatientNote($getall);

		include_once($root_path.'include/care_api_classes/class_multi.php');
		$multi= new multi;

		$multi->doctorSTAT($HTTP_SESSION_VARS['sess_login_userid'],$encounter);

	}


$ref=@$HTTP_REFERER;

(strlen($ref) != 0) ? header('location:'.$ref): print '<meta http-equiv="refresh" content="0;URL=javascript:window.history.back();">';

?>