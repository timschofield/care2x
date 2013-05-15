<?php
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');

	require($root_path.'include/inc_environment_global.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	$multi= new multi;

	extract($_GET);

	if (($dir=='district')&&($id!='')){
		$sql="SELECT DISTINCT district_id,district_name FROM `care_tz_district` INNER JOIN care_tz_ward ON `care_tz_district`.`district_id`=`care_tz_ward`.`is_additional` WHERE care_tz_district.is_additional=".$id." ORDER BY `district_name` ASC";
		$vh = $db->Execute($sql);

		print '<select name="district" size="1" id="district" onChange="getWards(this.value,\'wrd\')//redirect1(this.options.selectedIndex)">'.
			  '<option value="-1" selected>---select District--------</option>';
		while($rw = $vh->FetchRow()){
			print '<option value="'.$rw[0].'" id="-1">'.$rw[1].'</option>';
		}
		print '</select >';
	}


	if (($dir=='ward')&&($id!='')){
		$sql="SELECT DISTINCT ward_id,ward_name FROM `care_tz_ward`  WHERE care_tz_ward.is_additional=".$id." ORDER BY `ward_name` ASC";
		$vh = $db->Execute($sql);

		print '<select name="ward" size="1" onChange="//redirect1(this.options.selectedIndex)">'.
			  '<option value="-1" selected>---select ward--------</option>';
		while($rw = $vh->FetchRow()){
			print '<option value="'.$rw[0].'" id="-1">'.$rw[1].'</option>';
		}
		print '</select >';
	}
	?>