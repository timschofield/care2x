<?php
require_once($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
$app_types=$pres_obj->getAppTypes();
$pres_types=$pres_obj->getPrescriptionTypes();


if (empty($externalcall))
  $externalcall="FALSE";

$debug = FALSE;
if ($debug) echo "External_call:".$externalcall;



$mode = 'edit';
require_once($root_path."/include/inc_js_edit_prescription.php");




if (empty($change)) {
  echo '<br><br><br>
        <table width="70%" border="0" bgcolor=#ffffdd align="center">
        <tr> 
          <td width="20%">date</td>
          <td width="40%">item description</td>
          <td width="10%">dosage</td>
          <td width="10%">&nbsp;</td>
          <td width="10%">edit</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>';  
  $pres_obj->DisplayPrescriptionList($_SESSION['sess_en']);
  echo '</table>';
} else {
  if ($saveit) {
    if ($pres_obj->ChangeEntryOfPrescriptedItem($encounter_nr, $itemcode,$dosage,$notes)) {
    echo ' <br><br><br>
           <form name="confirmation_change" method="POST" action"show_prescription.php">
           <table border="0" cellpadding="2" width="100%">
            <tr>  
              <td><b>'.$pres_obj->GetNameOfPrescriptedItem($encounter_nr, $itemcode).'</b></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#ffffdd">
              <td>notes:'.$pres_obj->GetNotesOfPrescriptedItem($encounter_nr, $itemcode).'</td>
              <td>dosage:'.$pres_obj->GetDosageOfPrescriptedItem($encounter_nr, $itemcode).'</td>
              <td>history:'.$pres_obj->GetHistoryOfPrescriptedItem($encounter_nr, $itemcode).'</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>
                    <input type="hidden" name="externalcall" value="'.$externalcall.'">
                    <input type="hidden" name="mode" value="edit">
                    <input type="submit" value="back">
              </td>
            </tr>
            
           </table>
           </form>
        ';
     } else {
      echo "wwwooopsss... sorry, there is something happened. Nothing has been changed!";
     } // end of if 
  } else {
    echo ' <br><br><br>
           <form name="change_prescr_item" method="POST" action="show_prescription.php">
           <table border=0 cellpadding=2 width=100%>
             <tr>
              <td><font class="adm_div">'.$pres_obj->GetNameOfPrescriptedItem($encounter_nr, $itemcode).'</font></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
             </tr>
             <tr bgcolor="#f6f6f6">
               <td><FONT SIZE=-1  FACE="Arial" color="#000066">Dosage</td>
               <td><input type="text" name="dosage" size=50 maxlength=60 value="'.$pres_obj->GetDosageOfPrescriptedItem($encounter_nr, $itemcode).'"></td>
             </tr>
             <tr bgcolor="#f6f6f6">
          
               <td><FONT SIZE=-1  FACE="Arial" color="#000066"> Notes</td>
               <td><textarea name="notes" cols=40 rows=3 wrap="physical">'.$pres_obj->GetNotesOfPrescriptedItem($encounter_nr, $itemcode).'</textarea></td>
             </tr>
          
          
             <tr bgcolor="#f6f6f6">
               <td><FONT SIZE=-1  FACE="Arial" color="#000066">Prescribed by</td>
               <td>
                    <input type="text" name="prescriber" size=50 maxlength=60 value="default" readonly>
                    <input type="hidden" name="externalcall" value="'.$externalcall.'">
                    <input type="hidden" name="mode" value="edit">
                    <input type="hidden" name="saveit" value="TRUE">
                    <input type="hidden" name="change" value="TRUE">
                    <input type="hidden" name="encounter_nr" value="'.$encounter_nr.'">
                    <input type="hidden" name="itemcode" value="'.$itemcode.'">
               </td>
               
             </tr>
             <tr>
              <td><input type="submit" value="change"></td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
             </tr>
              
           </table>  
          </form>
          ';
  }
}

?>