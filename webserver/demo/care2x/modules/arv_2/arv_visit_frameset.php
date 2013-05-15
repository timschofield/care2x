<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
#error_reporting(E_ALL);
//-------------------------------------------------------------------------------------------------------
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//-------------------------------------------------------------------------------------------------------
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2007 Dorothea Reichert based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
$add=URL_APPEND."&pid=".$_GET['pid']."&encounter_nr=".$_GET['encounter_nr']."&visit_id=".$_GET['visit_id']; 
//-------------------------------------------------------------------------------------------------------------------------------------
require ("gui/gui_arv_visit_frameset.php");
?>

