<?php
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');

	require($root_path.'include/inc_environment_global.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	$multi= new multi;

	extract($_GET);

	if (($mode=='remove')&&($nr!='')){
		$db->Execute('DELETE FROM care_encounter_notes WHERE nr='.$nr);
	}


	?>