<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_case.php');
require_once($root_path.'include/care_api_classes/class_tz_arv_visit.php');
//-------------------------------------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//-------------------------------------------------------------------------------------------------------------------------------------
$breakfile="modules/arv/arv_visit.php";
$add_breakfile="&pid=".$_GET['pid'];
$o_arv_case=new ARV_case($_GET['pid']);
$o_arv_visit=new ARV_visit($o_arv_case->CurrentEncounter($_GET['pid']),$o_arv_case->getARVcaseID());
//-------------------------------------------------------------------------------------------------------------------------------------
$a_item_no=$_GET['a_item_no'];

$querystring=$o_arv_visit->querystring('arv_data').$o_arv_visit->querystring('r_item_no');

require ("gui/gui_arv_events.php");

?>