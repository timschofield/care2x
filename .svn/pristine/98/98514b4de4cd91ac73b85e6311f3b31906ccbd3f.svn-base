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
//require($root_path.'include/inc_front_chain_lang.php');

$lang_tables[]='diagnoses_ICD10.php';
require($root_path.'include/inc_front_chain_lang.php');

//Load the diagnstics-class:
require_once($root_path.'include/care_api_classes/class_tz_diagnostics.php');

$diagnostic_obj = new Diagnostics;
/*

 print_r ( $_SESSION );
echo "<br>";
echo "das will ich sehen: ".$_SESSION['sess_full_en'];
*/
if($todo=='submit')
{
	// Load the visual signalling functions
	include_once($root_path.'include/inc_visual_signalling_fx.php');
	// Set the visual signal
	setEventSignalColor( $_SESSION['sess_en'],SIGNAL_COLOR_QUERY_DOCTOR);


	$diagnostic_obj->EnterNewCase($_POST);
}

require ("gui/gui_icd10_diagnose.php");
?>