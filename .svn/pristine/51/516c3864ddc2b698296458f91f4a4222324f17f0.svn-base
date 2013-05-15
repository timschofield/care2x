<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/

//define('NO_2LEVEL_CHK',1);
$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = New Insurance_tz();
if($mode=='insert')
{
	//Error checking
	if(strlen(trim($name))<1) $error['name'] = true;
	if(strlen(trim($contact))<1) $error['contact'] = true;
	if(!$insurance && $invoice_flag!='on') $error['insurance'] = true;
	if(!$error)
	{
		$newid = $insurance_tz->InsertNewInsuranceCompany($_POST);
		if($newid)
			if($sitetarget=='contract')
				header("Location: insurance_company_tz_contracts_new.php?company_id=".$newid);
			else
				header("Location: insurance_company_tz.php");
	}
}

require ("gui/gui_insurance_company_tz_new.php");

?>