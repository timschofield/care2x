<?php

if (eregi('pageheader1.php',$_SERVER['PHP_SELF'])){
	die('<meta http-equiv="refresh" content="0; url=../../../">');
}

#Get care logo
$imgsize=GetImageSize($logo);
$pdf->addPngFromFile($logo,20,780,$imgsize[0]);
# Attach logo
$pdf->selectFont($fontpath.'Helvetica.afm');
$pdf->ezStartPageNumbers(550,25,8);

# Get the main informations
if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob=& new GlobalConfig($GLOBAL_CONFIG);
# Get all config items starting with "main_"
$glob->getConfig('main_%');

$addr[]=array($GLOBAL_CONFIG['main_info_address'],
						"$LDPhone:\n$LDFax:\n$LDEmail:",
						$GLOBAL_CONFIG['main_info_phone']."\n".$GLOBAL_CONFIG['main_info_fax']."\n".$GLOBAL_CONFIG['main_info_email']."\n"
						);
$pdf->ezTable($addr,'','',array('xPos'=>165,'xOrientation'=>'right','showLines'=>0,'showHeadings'=>0,'shaded'=>0,'fontsize'=>6,'cols'=>array(1=>array('justification'=>'right'))));
?>
