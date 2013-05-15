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
$lang_tables[]='billing.php';
$lang_tables[]='aufnahme.php';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$enc_obj=new Encounter;
$bill_obj = new Bill;
$insurance_tz = new Insurance_tz;

$debug = FALSE;

if ($debug) {
  echo $batch_nr."<br>";
  echo $bill_number."<br>";
  echo "printout=$printout<br>";
}

require ("gui/gui_show_bill.php");

?>