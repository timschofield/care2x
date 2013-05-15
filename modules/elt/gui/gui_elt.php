<?php
include('../../../classes/adodb/adodb.inc.php');	 # load code common to ADOdb
session_start();
$tabs['Step1'] = "./form/gui_elt_form_step1.php";
$tabs['Step2'] = "./form/gui_elt_form_step2.php";
$tabs['Step3'] = "./form/gui_elt_form_step3.php";
$tabs['Step4'] = "./form/gui_elt_form_step4.php";
$tabs['Step5'] = "./form/gui_elt_form_step5.php";
$tabs['Step6'] = "./form/gui_elt_form_step6.php";

if(!$_REQUEST['activeTab'])
{
	$activeTab='Step1';
}
else
{
	$activeTab=$_REQUEST['activeTab'];
}

   echo  '<style>';
   echo '.tab_seleted';
   echo '{';
   echo 'font-family:Arial,Veranda;';
   echo 'font-size:9pt;';
   echo 'padding-left:10px;';
   echo 'padding-right:10px;';
   echo 'padding-top:0px;';
   echo 'padding-bottom:0px;';
   echo 'background-color:orange;';
   echo '}';

   echo '.tab_normal';
   echo '{';
   echo 'font-family:Arial,Veranda;';
   echo 'font-size:9pt;';
   echo 'padding-left:10px;';
   echo 'padding-right:10px;';
   echo 'padding-top:0px;';
   echo 'padding-bottom:0px;';
   echo 'background-color:#c0bbb2;';
   echo '}';

   echo '.space';
   echo '{';
   echo 'background-color:withe;';
   echo '}';



   echo '</style>';
/*
   echo '<table width="100%" height="22" border="0" cellpadding="0" cellspacing="0">';


   echo ' </tr>';
   echo '  <tr>';

   foreach ( $tabs as $key => $tab ) {
      $class = ($key==$activeTab) ? "tab_seleted" : "tab_normal";
      $link = $key;
      echo '   <td height="20" align="center" class="'.$class.'">'.$link.'</td>';
      echo '   <td width="3" class="space"></td>';

   }
   echo '</table>';
   echo '<br>';

*/
   if($_REQUEST['activeTab'])
   {
		include($tabs[$activeTab]);

   }
   if(!$_REQUEST['activeTab'])
   {
		include($tabs[$activeTab]);
   }

?>