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
$thisfile=basename($_SERVER['PHP_SELF']);
$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_person.php');
$person_obj = New Person();
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = New Insurance_tz();

//echo "todo is $todo <br>"; //if dodo==finish, let the user go out of that screen!
//echo "mode is set to $mode <br>"; //if mode==update, make the updates to the datasets and let the user see what he has done/changed

if($mode=='update')
{
	if($insurance) 	{
		$insurance_tz->UpdateContractsArray($_POST);
		header("location: insurance_members_tz.php?company_id=".$insurance);
	}
}
if(is_array($item_no))
{
	$counter=0;
	while(list($x,$v) = each($item_no))
	{
		echo $counter;
		$contract = $insurance_tz->CheckForValidContract($v,0,$company_id);
		$contract_array[$counter]['PID'] = $v;
		$contract_array[$counter]['Contract'] = $contract;
		$counter++;
	}
}
require ("gui/gui_insurance_members_tz_contracts.php");

?>