<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
/*
* We do not need the entire environment here so we just load the variable globalizer routine
*/
//require($root_path.'include/inc_vars_resolve.php');

define('PIE_CHART_BASE_COLOR','greenyellow'); 	// define the base color of the pie chart
define('PIE_CHART_RADIUS',25); 						// define the radius of the pie chart

if(!extension_loaded('gd')) dl('php_gd.dll');

//pull out params from URL string
$qouta = 1;
$used = 0;
$uc = PIE_CHART_BASE_COLOR;
if (isset($_GET['qouta']) && isset($_GET['used']) && isset($_GET['uc'])) {
	$qouta = $_GET['qouta'];
	$used = $_GET['used'];
	$uc = $_GET['uc'];
}

/* Load the pie chart generator */
require($root_path.'classes/pie_chart/piechart.class.php');

$chart=new piechart(
					PIE_CHART_RADIUS,
					array('',''),
					array($qouta,$used),
					array(PIE_CHART_BASE_COLOR,$uc)
					); 
header ('Content-type: image/png');
$chart->draw();
?>
