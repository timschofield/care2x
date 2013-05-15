<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
//----------------------------------------------------------------------------------------------------
$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
//----------------------------------------------------------------------------------------------------

$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$thisfile=basename($_SERVER['PHP_SELF']);

if(isset($_POST['mode'])&&$_POST['mode']=='save'){

	$filter='main_info_facility'; # The index filter
	$numeric=FALSE; # Values are not strictly numeric
	$addslash=TRUE; # Slashes should be added to the stored values

	# Save the configuration
  
	$glob_obj->saveConfigArray($_POST,$filter,$numeric,'',$addslash);

	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;

# Else get current global data
}else{ 
	$glob_obj->getConfig('main_info_facility%');
}
//----------------------------------------------------------------------------------------------------
require ("gui_edv_arv_information.php");
?>