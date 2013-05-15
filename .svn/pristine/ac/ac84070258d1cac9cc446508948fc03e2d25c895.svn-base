<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
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
function gethelp(x,s,x1,x2,x3,x4) {
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

//-->
</script>
<title>Follow-up education</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.error {
	color: red;
	font-weight: bold;
}

.mainTable {
	margin-top:15px;
	margin-bottom:15px;
	margin-left:20px;
	border: 2px ridge black;
	width:770px;
}

input[type="image"] {
	margin-left:20px;
}
-->
</style> 
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff">&nbsp;&nbsp;<font color="#330066">Home-bases care, support</font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $error_messages ?>
<form method="post" name="form_support" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="460" border="0" bgcolor="#F0F8FF" class="mainTable">
    <tr>
      <td width="7">&nbsp;</td>
      <td width="746"><?php echo $messages['comment_date']."\n" ?> <strong>Date: </strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="comment_date" type="text" id="comment_date" 
   onFocus="this.select()" onKeyUp="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" value="<?php echo $values['comment_date']  ?>" size="10" maxlength="10" />
        <a href="javascript:show_calendar('form_support.comment_date','<?php echo $date_format; ?>')"> <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>(dd/mm/yyyy) </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php echo $messages['comment']."\n" ?> <strong>Comment: </strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><textarea name="comment" id="comment"><?php echo $values['comment'] ?></textarea></td>
    </tr>
  </table>
  <table width="580" border="0" class="mainTable">
  <tr bgcolor="#EAF5FF">
    <td width="35">
      <?php echo $messages['comment_id']."\n" ?>
      <input name="comment_id" type="radio" value="29" <?php echo $values['comment_id'] == 29 ? 'checked="checked" ' : '' ?>/>    </td>
    <td width="721">How to contact clinic </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[29][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
  <tr bgcolor="#F0F8FF">
    <td><input name="comment_id" type="radio" value="30" <?php echo $values['comment_id'] == 30 ? 'checked="checked" ' : '' ?>/></td>
    <td>Symptom management/palliative care at home </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[30][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
  <tr bgcolor="#EAF5FF">
    <td><input name="comment_id" type="radio" value="31" <?php echo $values['comment_id'] == 31 ? 'checked="checked" ' : '' ?>/></td>
    <td>Caregiver Booklet </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[31][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
  <tr bgcolor="#F0F8FF">
    <td><input name="comment_id" type="radio" value="32" <?php echo $values['comment_id'] == 32 ? 'checked="checked" ' : '' ?>/></td>
    <td>Home-based care-specify </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[32][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
  <tr bgcolor="#EAF5FF">
    <td><input name="comment_id" type="radio" value="33" <?php echo $values['comment_id'] == 33 ? 'checked="checked" ' : '' ?>/></td>
    <td>Support groups </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[33][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
  <tr bgcolor="#F0F8FF">
    <td><input name="comment_id" type="radio" value="34" <?php echo $values['comment_id'] == 34 ? 'checked="checked" ' : '' ?>/></td>
    <td>Community support </td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[34][$i]."&nbsp;</td>";
	}
    ?>  
  </tr>
</table>
<p>
  <input name="submit" value="Submit" type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>/>
  <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']?>" />
  <input name="encounter_nr" type="hidden" value="<?php echo $_REQUEST['encounter_nr']?>" />
  <input name="registration_id" type="hidden" value="<?php echo $values['registration_id']?>" />
</p>
</form>
</body>
</html>



