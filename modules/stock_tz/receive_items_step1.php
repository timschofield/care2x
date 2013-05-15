<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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
require_once($root_path.'include/care_api_classes/class_tz_diagnostics.php');
require_once($root_path.'include/care_api_classes/class_tz_stock.php');
$debug=FALSE;
$diagnostic_obj = new Diagnostics;

if ($debug) echo $mode."<br>";
if ($debug) echo $keyword."<br>";
if ($debug) echo $show."<br>";
if ($debug) echo $search_mode."<br>";

$stock_obj = new Stock_tz();
if ($task=="pending") {
	while(list($x,$v) = each($_POST))
	{
		if(strstr($x,"trigger"))
		{
			
			$itemid = substr(strrchr($x,"_"),1);
			if($_POST['trigger_'.$itemid]=='receive')
			{
				$stock_obj->transfer_insert_into_stock($itemid);
			}
			elseif($_POST['trigger_'.$itemid]=='cancel')
			{
				$stock_obj->transfer_cancel($itemid);
			}
		}
	}
	header('Location: stock_tz_pass.php');
}

$debug = false;
($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  		
  require ("gui/gui_receive_items_step1.php");

?>