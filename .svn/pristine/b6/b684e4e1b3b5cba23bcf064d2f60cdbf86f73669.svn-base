<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_date_format_functions.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_patient.php');
require_once($root_path.'include/care_api_classes/class_eye_clinic.php');

//-------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------

$o_arv_patient=new ART_patient($_REQUEST['pid'],$_REQUEST['registration_id']);

$registration_data=$o_arv_patient->getRegistrationData();




global $vart1,$vart2,$vart3,$valt1,$valt2,$valt3,$signature;

$eyeclinic=new eyeclinic();


require ("gui/gui_eye_examination_report.php");

?>



