<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org,
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='startframe.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$thisfile=basename($_SERVER['PHP_SELF']);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
# Create object linking our global config array to the object
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode)&&$mode=='save'){

	$filter='identification'; # The index filter
	$numeric=FALSE; # Values are not strictly numeric
	$addslash=FALSE; # Slashes should be added to the stored values


	# Save the configuration
	$glob_obj->saveConfigArray($_POST,$filter,$numeric,'',$addslash);

	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;

# Else get current global data
}else{
	$glob_obj->getConfig('main_info%');
}





# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDGeneralSettings);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('quickinfo.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDGeneralSettings);

 # Assign prompt if saved
 if(isset($save_ok)&&$save_ok){
	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>');
	$smarty->assign('LDDataSaved',$LDDataSaved);

  }
  else{

 # Assign prompt

$smarty->assign('LDGeneralSettingsHeading',$LDGeneralSettingsHeading);
  }


  #Radiobuttons

  $einstellung = $glob_obj->getConfigValue('identificationNr');

  if ($einstellung == 'PID')
  {
  	$smarty->assign('checkPID', 'checked');
  	$smarty->assign('checkHospFileNr', '');

  }
  else{
  		$smarty->assign('checkPID', '');
  		$smarty->assign('checkHospFileNr', 'checked');
  }

 # Assign form elements
$smarty->assign('LDGeneralSettingsHospFileNr',$LDGeneralSettingsHospFileNr);
$smarty->assign('LDGeneralSettingsPID',$LDGeneralSettingsPID);


# Create and assign save button
$smarty->assign('sSave','<input type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').'>
	<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="mode" value="save">');

# Cancel button
$smarty->assign('sCancel','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').'></a>');

# Assign template as include file to the mainframe template

$smarty->assign('sMainBlockIncludeFile','system_admin/general_settings.tpl');


 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');



?>
