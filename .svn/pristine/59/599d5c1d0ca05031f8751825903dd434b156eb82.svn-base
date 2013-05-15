<?php
require_once($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
$app_types=$pres_obj->getAppTypes();
$pres_types=$pres_obj->getPrescriptionTypes();

$debug = FALSE;

if ($debug) echo "External_call:".$externalcall;

$mode = 'edit';

echo '<br><br><br>
      <table width="70%" border="0" bgcolor=#ffffdd align="center">
      <tr> 
        <td width="20%">date</td>
        <td width="40%">item description</td>
        <td width="10%">dosage</td>
        <td width="10%">&nbsp;</td>
        <td width="10%">edit</td>
        <td width="10%">delete</td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>';
                      


$pres_obj->DisplayPrescriptionList($_SESSION['sess_en']);

echo '</table>';


?>