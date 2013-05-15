<?php

require('./roots.php');

 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }

$lang_tables[]='search.php';
define('LANG_FILE','dental.php');
require($root_path.'include/inc_environment_global.php');
include_once($root_path.'include/care_api_classes/class_mini_dental.php');
$notes_obj = new dental;

$url = explode('|',$_GET['url']);

if ($_GET['mode']=='edit'){
	$sq = "SELECT * FROM care_encounter_notes WHERE nr=".$_GET['id'];
	$d  = $db->Execute($sq);
	$yy = $d->FetchRow();
	#print_r($yy);
}


#print_r($_GET);



?>
<div id="mimix">
<form name="form1" method="get" action="dental_billing_.php">
  <table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="470"  border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#D2DFD0" class="style3">
        <tr align="center" bgcolor="#E7EEE6">
          <td height="38" colspan="3" bgcolor="#C0D2BD"><div align="center" class="style5" style="text-transform:uppercase;"><?php print ($_GET['mode']=='edit')?$mode:' Add'; ?> Patient notes</div></td>
        </tr>
        <tr bgcolor="#E7EEE6">
          <td width="111" height="30" align="right" bgcolor="#E7EEE6"><strong>Date:</strong></td>
          <td colspan="2" bgcolor="#FFFFFF"><input name="date" type="text" value="<?php echo ($_GET['mode']=='edit')?date('d/m/Y',strtotime($yy['date'])):date('d/m/Y'); ?>" size="25" readonly="true" />
          </td>
        </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong>Note Type: </strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7">

            <?php $notes_obj->GetTypesOfNotes();?>

            </td>
        </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong>Short Notes:</strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7">
          <input name="short" type="text" id="short" value="<?php print $yy[4]?>" size="35" maxlength="100">
          </td>
        </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="top" nowrap bgcolor="#E7EEE6"><strong>Full Description:</strong></td>
          <td width="265" align="left" nowrap bgcolor="#FFFFFF" class="style7">
          <textarea name="notes" cols="40" rows="5" id="notes"><?php print $yy[3];?></textarea>
          </td>
          <td width="66" align="left" nowrap bgcolor="#FFFFFF" class="style7">*Required</td>
        </tr>
        <tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong>By: </strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7">
          <input name="by" type="text" id="by" readonly="true" value="<?php echo $HTTP_SESSION_VARS['sess_user_name'];?>">
            <input name="encounter" type="hidden" id="encounter" value="<?php echo $_GET['encounter']; ?>"></td>
        </tr>
        <tr align="center" valign="top" bgcolor="#C0D2BD">
          <td colspan="3" align="right" valign="middle">

  			<input type="hidden" name="curUrl" value="<?php $ref=@$HTTP_REFERER;
															echo $ref; ?>" />
  			<input type="hidden" name="nr" value="<?php echo $yy['nr']; ?>" />
  			<input type="hidden" name="mode" value="<?php echo $_GET['mode']; ?>" />
  			<input name="Print2" type="submit" id="Print25" value="Save Note &raquo;" class="button" >
            <input name="Close2" type="button" id="Close25" value="Cancel" class="button2" onClick="$('#mimix').fadeOut();//eval(document.getElementById('specials').innerHTML='');" >
          </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div>
