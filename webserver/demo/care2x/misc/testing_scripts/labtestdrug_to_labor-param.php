<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$sid='1'; # Dummy sid

if($_REQUEST['step']==1) {
	$sql="update care_tz_drugsandservices set item_number='' where purchasing_class='labtest'";
	$db->Execute($sql);

	//Delete params, reset the database table
	$sql="truncate care_tz_laboratory_param";
	$db->Execute($sql);
	$sql="truncate care_tz_laboratory_tests";
	$db->Execute($sql);

	// Clear up all pending lists and results
	$sql="truncate care_test_request_chemlabor";
	$db->Execute($sql);
	$sql="truncate care_test_findings_chemlab";
	$db->Execute($sql);


	$sql="INSERT INTO care_tz_laboratory_tests (
	`id` ,
	`parent` ,
	`name` ,
	`is_common` ,
	`is_comment_required` ,
	`comment` ,
	`price` ,
	`is_enabled`
	)
	VALUES (
	NULL , '-1', 'TESTS', '0', '0', '', '0', '1'
	)";
	$db->Execute($sql);



	//update
	$sql="SELECT * FROM care_tz_drugsandservices where purchasing_class='labtest'";
	$drugservices_labparams=$db->Execute($sql);
	while($drugservices_labparam=$drugservices_labparams->FetchRow())
	{
	$sql = "INSERT INTO `care_tz_laboratory_param` (
	`nr` ,
	`group_id` ,
	`name` ,
	`shortname` ,
	`id` ,
	`msr_unit` ,
	`median` ,
	`hi_bound` ,
	`lo_bound` ,
	`hi_critical` ,
	`lo_critical` ,
	`hi_toxic` ,
	`lo_toxic` ,
	`add_type` ,
	`add_label` ,
	`status` ,
	`history` ,
	`modify_id` ,
	`modify_time` ,
	`create_id` ,
	`create_time` ,
	`price` ,
	`price_3` ,
	`price_2` ,
	`price_1`
	)
	VALUES (
	NULL , '1', '".$drugservices_labparam[item_full_description]."', '".$drugservices_labparam[item_full_description]."', '', '', NULL , NULL , NULL , NULL , NULL , NULL , NULL , '', '', '', '', '', NOW( ) , '', '0000-00-00 00:00:00', '', NULL , NULL , NULL
	);";
	$db->Execute($sql);
	//
	$sql="INSERT INTO care_tz_laboratory_tests (
	`id` ,
	`parent` ,
	`name` ,
	`is_common` ,
	`is_comment_required` ,
	`comment` ,
	`price` ,
	`is_enabled`
	)
	VALUES (
	NULL , '1', '".$drugservices_labparam['item_full_description']."', '0', '0', '', '0', '1'
	)";
	$db->Execute($sql);
		}

	$sql="SELECT * FROM care_tz_laboratory_tests";
	$insert=$db->Execute($sql);

	while($row=$insert->FetchRow())
	{
				$sql="update care_tz_drugsandservices set item_number='LAB".$row['id']."' where item_description='".$row['name']."' ";
				$db->Execute($sql);
	}

	$sql="SELECT * FROM care_tz_drugsandservices where purchasing_class='labtest'";
	$drugservices_labparams=$db->Execute($sql);
	while($drugservices_labparam=$drugservices_labparams->FetchRow())
	{
		$sql="update care_tz_laboratory_param set id='".substr($drugservices_labparam['item_number'],3,strlen($drugservices_labparam['item_number']))."' where name='".$drugservices_labparam['item_full_description']."'";
		$db->Execute($sql);
	}


	echo "Transfered";
	}
	else
	{
		?>
		<form type="post">
		<input type="hidden" name="step" value="1">
			<input type="submit" name="submit" value="Update"/>
		</form>
		<?
}
?>
