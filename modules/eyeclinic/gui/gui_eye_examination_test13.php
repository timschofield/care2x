<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php
echo '<script language="JavaScript">';
	require($root_path.'include/inc_checkdate_lang.php');
echo '</script>';
echo '<script language="javascript" src="'.$root_path.'js/setdatetime.js"></script>';
echo '<script language="javascript" src="'.$root_path.'js/checkdate.js"></script>';
echo '<script language="javascript" src="'.$root_path.'js/dtpick_care2x.js"></script>';
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm()
  {
    action="eye_examination_test13.php"
  submit();

  return true;
  }

//-->
</script>
<title>EYE Patient Examination</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--

.error {
	color: red;
	font-weight: bold;
}

fieldset {
	width:775px;
	margin-top:15px;
	margin-left:20px;
	background-color:#E8F2FF;
}


-->
</style>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff"><font color="#330066">&nbsp;&nbsp;Eye Examination</font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $errorMessages ?>


</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Registration Data</strong></legend>
<table width="750" border="0">
  <tr>
    <td bgcolor="#F0F8FF"><strong>Health Facility File Number: </strong><?php echo $registration_data['facility_file_number']; ?></td>
    <td bgcolor="#F0F8FF"><strong>PID: </strong><?php echo $registration_data['pid']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Sex: </strong><?php echo $registration_data['sex']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Date of Birth: </strong><?php echo formatDate2Local($registration_data['date_of_birth'],$date_format,null,null); ?></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Name:</strong> <?php echo $registration_data['name']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Marital Status: </strong> <?php echo $registration_data['marital_status']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Age:</strong> <?php echo $registration_data['age']; ?></td>
  </tr>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Patient Adress </strong></legend>
<table width="750" border="0">
  <tr>
    <td bgcolor="#F0F8FF"><strong>District: <?php echo $registration_data['district']; ?></strong></td>
    <td bgcolor="#F0F8FF"><strong>Division: <?php echo $registration_data['division']; ?></strong></td>
    <td bgcolor="#F0F8FF"><strong>Ward: </strong> <?php echo $registration_data['ward']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Street: </strong>  <?php echo $registration_data['street']; ?></td>
    <td bgcolor="#EAF4FF"><strong>Village: </strong>  <?php echo $registration_data['village']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Telephone:</strong>  <?php echo $registration_data['telephone']; ?></td>
  </tr>
</table>
</fieldset>

<form  method="post" action="">

<fieldset>
<legend onClick="toggle(this)"><strong>Optic disc</strong></legend>
<table width="750" border="0">

  <tr>
    <td bgcolor="#F0F8FF">
    Right Eye</td>

    <td bgcolor="#F0F8FF">
	</td>

    <td colspan="2" bgcolor="#F0F8FF">
      Left Eye </td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr1' value='Normal'></td>
<td bgcolor="#F0F8FF" align='center'>normal</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl1' value='Normal'></td>
  </tr>

</tr>
  <tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr2' value='there is cupping up to half of the disc diameter (0.5)'></td>
<td bgcolor="#F0F8FF" align='center'>there is cupping up to half of the disc diameter (0.5)</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl2' value='there is cupping up to half of the disc diameter (0.5)'></td>
  </tr>

</tr>
  <tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr3' value='Almost all the disc is cupped (0.9)'></td>
<td bgcolor="#F0F8FF" align='center'>Almost all the disc is cupped (0.9)</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl3' value='Almost all the disc is cupped (0.9)'></td>
  </tr>

</tr>
  <tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr4' value='There is optic atrophy'></td>
<td bgcolor="#F0F8FF" align='center'>There is optic atrophy</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl4' value='There is optic atrophy'></td>
  </tr>

</tr>
  <tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr5' value='There is swelling of the disc (papilloedema/papillitis)'></td>
<td bgcolor="#F0F8FF" align='center'>There is swelling of the disc (papilloedema/papillitis)</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl5' value='There is swelling of the disc (papilloedema/papillitis)'></td>
  </tr>

<tr>
    <td bgcolor="#F0F8FF"><input type='checkbox' name='odr6' value='There is another abnormality of the optic disc'></td>
<td bgcolor="#F0F8FF" align='center'>There is another abnormality of the optic disc</td>
<td bgcolor="#F0F8FF"><input type='checkbox' name='odl6' value='There is another abnormality of the optic disc'></td>
  </tr>

</table>
</fieldset>






<fieldset>
<legend onClick="toggle(this)"><strong>Other comments (type)</strong></legend>
<table width="750" border="0">

  <tr>
    <td bgcolor="#F0F8FF">

  <textarea name="comments" rows="10" cols="90" wrap="off">

  </textarea>

  </td>

  </tr>

</table>
</fieldset>

	  <fieldset>
	   <table width="750">
         <tr>
           <td width="95" bgcolor="#F0F8FF"><?php echo $messages['signature']."\n" ?><strong>Signature:</strong></td>
           <td width="643" bgcolor="#F0F8FF"><input  type="text" name="signature"  size="20" maxlength="60" /></td>
         </tr>
         <tr>
           <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
         </tr>
         <tr>

           <td colspan="2" bgcolor="#F0F8FF"><input name="registration_id" type="hidden" value="<?php echo $values['registration_id']?>" />
               <!--<input type="hidden" value="asdf"  name="pid"/>-->
             <input name="mode" type="hidden" value="<?php echo $_REQUEST['mode']?>" />
             <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']?>" />
             <input name="encounter_nr" type="hidden" value="<?php echo $_REQUEST['encounter_nr']?>" />
             <!--<input name="addtest" type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> id="submit" value="Submit" onClick="javascript:return submitForm()"/></td>-->
			<input type="submit" value="ADD" name="addtest13" onclick="return submitForm();"/> &nbsp;<input type="reset" value="Reset"> </td>
         </tr>

         <td  bgcolor="#F0F8FF">&nbsp;</td>
         <td width="643"><a href="eye_examination_test12.php<?php echo URL_APPEND ?>&pid=<?php echo $_GET['pid']?>&mode=new" >Go to previous page</a></td>
         </tr>
       </table>
	  </fieldset>
</form>
    </p>
  <p>&nbsp;</p></td>
</tr>
</body>
</html>
