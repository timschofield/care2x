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
require($root_path.'include/inc_front_chain_lang.php');
require($root_path.'include/care_api_classes/class_person.php');
$person_obj = New Person();
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = New Insurance_tz();
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj = New Encounter;

$hosp_address=$enc_obj->GetHospitalAddress();
$address_line = explode(",",$hosp_address);

                $hosp_name = $address_line[0];
				$hosp_address = $address_line[1];
                $hosp_address_city = $address_line[2];
				
if($mode=='update')
{
	
}

require ("gui/gui_show_contract.php");

?>