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
require_once($root_path.'include/care_api_classes/class_tz_diagnostics.php');
require_once($root_path.'include/care_api_classes/class_tz_stock.php');
$debug=FALSE;
$diagnostic_obj = new Diagnostics;

if ($debug) echo $mode."<br>";
if ($debug) echo $keyword."<br>";
if ($debug) echo $show."<br>";
if ($debug) echo $search_mode."<br>";


if($todo=="proceed")
{
	while(list($x,$v)=each($_POST))
	{
		if(strstr($x,'amount_'))
			$_SESSION['items'][substr($x,7)] = $v;
	}
	header("location: purchase_items_step4.php");
}
else
{
	if(is_array($item_no))
	{
		while(list($x,$v) = each($item_no))
	 		$_SESSION['items'][$v] = 1;
	 	reset($item_no);	
	}
	if(is_array($order_no))
	{
		while(list($x,$v) = each($order_no))
	 		$_SESSION['orders'][$v] = 1;
	 	reset($order_no);	
	}	
}
$stock_obj = new Stock_tz();

$debug = TRUE;
($debug) ? $db->debug=TRUE : $db->debug=FALSE;
  		
  require ("gui/gui_purchase_items_step3.php");

?>