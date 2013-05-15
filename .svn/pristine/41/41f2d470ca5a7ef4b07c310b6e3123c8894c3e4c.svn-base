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
$insurance_tz = new Insurance_tz;
$this_insurance = $insurance_tz->GetInsuranceAsArray($id);

if (is_array($insurance_tz->GetContractsForCompanyAsArray($id)))
	$SHOW_ADDMEMBER_BUTTON=TRUE;
else
	$SHOW_ADDMEMBER_BUTTON=FALSE;
/*
 *  NOTE: For this script is $id = company ID
 */

if($mode=="updateflags")
{
	//Error checking
	if(strlen(trim($name))<3) $error['name'] = true;
	if(strlen(trim($contact))<3) $error['contact'] = true;
	//if(!$insurance) $error['insurance'] = true;
	if(!$error)
	{
		$insurance_tz->UpdateInsuranceCompany($_POST);
		header("location: ./insurance_company_tz.php");
	}
	$this_insurance = $_POST;
	while(list($x,$v) = each($_POST))
	{
		if(strstr($x,"cancel_"))
		{
			$cancel_id = substr(strrchr($x,"_"),1);
			if($v=="yes")
				$insurance_tz->CancelContractForPID($cancel_id);
			else
				$insurance_tz->EnableContractForPID($cancel_id);
		}
		elseif(strstr($x,"paid_"))
		{
			$paid_id = substr(strrchr($x,"_"),1);
			if($v=="yes")
				$insurance_tz->EnablePaymentForContract($cancel_id);
			else
				$insurance_tz->CancelPaymentForContract($cancel_id);
		}
	}
	$updated = $LDLastUpdated.' '.strftime('%c').'<br>';

}
require ("gui/gui_insurance_company_tz_contracts.php");

?>
