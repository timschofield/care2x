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

function createTable(element) {
	parent.frames['leftFrame'].location.href='<?php echo $root_path?>modules/arv_2/arv_code_tables.php?table=' + element.name; 
	element.blur();
}

function selectAll() {
	for (var i = 0; i < document.forms[0].length; ++i) {	
  		if (document.forms[0].elements[i].options) {
  			if (document.forms[0].elements[i].multiple==true) {
	  			for (j = 0; j < document.forms[0].elements[i].length; ++j) {
					document.forms[0].elements[i].options[j].selected ="selected";
				}
			}
  		}
	}
}

function remove(element) {
	var destination_obj       = parent.frames['mainFrame'].document.forms[0].elements[element];

	if (destination_obj.type=="text") {
		destination_obj.value="";	
		destination_obj_hidden=parent.frames['mainFrame'].document.forms[0].elements[element.substring(0,element.indexOf("_txt"))];
		destination_obj_hidden.value="";
	}
	else {
		if (destination_obj.selectedIndex >= 0 ) {
			destination_obj.options[destination_obj.selectedIndex].text=null;
	    	destination_obj.options[destination_obj.selectedIndex]=null;
	    	return true;
		} 
		else {
			alert ("Please select one tiem on the right side if you have to remove it");
	    	return false;
		} 	
	}
	return true;  
}

//-->
</script>
<title>ART VISIT</title>
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
	width:644px;
}

.mainTable td {
	padding-left:5px;
}

-->
</style> 
<body>
<table cellspacing="0"  class="titlebar" border=0 >
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff">&nbsp;&nbsp;<font color="#330066">ART Visit Form </font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $error_messages ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="arv_visit">

<table width="644" border="0" class="mainTable">
  <tr>
    <td width="153" bgcolor="#F0F8FF"><strong>Unique CTC ID Number:</strong> <?php echo $art_info['ctc_id']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Health Facility File Number:</strong> <?php echo $art_info['facility_file_number']; ?></td>
    <td width="35" bgcolor="#F0F8FF"><strong>Sex: </strong><?php echo $art_info['sex']; ?></td>
    </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Name:</strong> <?php echo $art_info['name']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Date of birth:</strong> <?php echo $art_info['date_of_birth']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>PID:</strong> <?php echo $art_info['pid']; ?></td>
	</tr>
</table>
<table width="644" border="0" class="mainTable">
  <tr>
    <td width="272" bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Visit Date: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
		<?php echo $messages['visit_date']."\n" ?>
    <input name="visit_date" type="text" size="10" maxlength="10"  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		   id="visit_date" type="text" value="<?php echo $values['visit_date']; ?>" />
		   <a href="javascript:show_calendar('arv_visit.visit_date','<?php echo $date_format; ?>')">
		   <img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
      (dd/mm/yyyy)    </td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Weight:</strong></div></td>
    <td width="186" bgcolor="#F0F8FF">
		<?php echo $messages['weight']."\n" ?>
		<input name="weight" type="text" size="6" maxlength="6" value="<?php echo $values['weight']; ?>"/>
      kg	</td>
    <td width="164" bgcolor="#F0F8FF"><?php echo $messages['height']."\n" ?>Height
	  
      <input name="height" type="text" size="3" maxlength="3" value="<?php echo $values['height']; ?>"/>
      cm</td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>WHO Clinical Stage:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['clinical_stage']."\n" ?>
	<?php $selected[$values['clinical_stage']]="selected"; ?>
	<select name="clinical_stage" size="1">
	  <option <?php echo $selected[""] ?> value=""></option>
      <option <?php echo $selected[1] ?> value="1">1</option>
      <option <?php echo $selected[2] ?> value="2">2</option>
      <option <?php echo $selected[3] ?> value="3">3</option>
      <option <?php echo $selected[4] ?> value="4">4</option>
    </select>	</td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Aids defining illnesses, new symptoms, side effects, hospitalized: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['illness_code']."\n" ?>
	<select name="illness_code[]" multiple="multiple" onFocus="javascript:createTable(this)" size="4" style="width:100px">
	<?php 
		echo $values['illness_code'];
	?>
	</select>
	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('illness_code[]')"></td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Pregnant:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF"> yes
	  <?php echo $messages['pregnant']."\n" ?>
      <input name="pregnant" type="radio" value="1" <?php echo $values['pregnant'] == 1 ? 'checked="checked" ' : '' ?>/>
      no
      <input name="pregnant" type="radio" value="2" <?php echo $values['pregnant'] == 2 ? 'checked="checked" ' : '' ?> />
      Date of Delivery:
	  <?php echo $messages['date_of_delivery']."\n" ?>
      <input name="date_of_delivery" type="text" size="10" maxlength="10" onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		   id="date_of_delivery" type="text" value="<?php echo $values['date_of_delivery']?>" />
		   <a href="javascript:show_calendar('arv_visit.date_of_delivery','<?php echo $date_format; ?>')">
		   <img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
      (dd/mm/yyyy) </td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Functional Status: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	    <?php echo $messages['functional_status']."\n" ?>
		<input name="functional_status_txt" type="text" value="<?php echo $values['functional_status_txt'] ?>" onFocus="javascript:createTable(this)" size="1" maxlength        ="1"/>
      <input name="functional_status" type="hidden" value="<?php echo $values['functional_status'] ?>"/ >	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('functional_status_txt')"></td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>TB Status: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['tb_status']."\n" ?>
	<input name="tb_status_txt" value="<?php echo $values['tb_status_txt'] ?>" type="text" onFocus="javascript:createTable(this)" size="10" maxlength="7" />
	<input name="tb_status" type="hidden"/  value="<?php echo $values['tb_status'] ?>">	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('tb_status_txt')"></td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Cotrim:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF"> 
	  <?php echo $messages['cotrim']."\n" ?>
	  yes  
      <input name="cotrim" type="radio" value="1" <?php echo $values['cotrim'] == 1 ? 'checked="checked" ' : '' ?>/>
      no
      <input name="cotrim" type="radio" value="2" <?php echo $values['cotrim'] == 2 ? 'checked="checked" ' : '' ?> />    </td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>Diflucan:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF"> 
	  <?php echo $messages['difflucan']."\n" ?>
	  yes
      <input name="diflucan" type="radio" value="1" <?php echo $values['diflucan'] == 1 ? 'checked="checked" ' : '' ?>/>
      no
      <input name="diflucan" type="radio" value="2" <?php echo $values['diflucan'] == 2 ? 'checked="checked" ' : '' ?>/>    </td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>ARV Status: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['status']."\n" ?>
	<input name="status_txt" type="text" value="<?php echo $values['status_txt'] ?>" size="1" onFocus="javascript:createTable(this)" maxlength="1" />
	<input type="hidden" name="status" value="<?php echo $values['status'] ?>"/>	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('status_txt')"></td>
  </tr>
  <tr>
    <td bordercolor="#999900" bgcolor="#99ccff"><div align="right"><strong>ARV Reason: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['status_txt_code']."\n" ?>
	<select name="status_txt_code[]"  multiple onFocus="javascript:createTable(this)" size="4" style="width:200px">
	<?php 
		echo $values['status_txt_code'];
	?>
    </select>
	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('status_txt_code[]')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>ARV Combin Regimen:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['regimen_code']."\n" ?>
	<input name="regimen_code_txt" type="text" size="30" value="<?php echo $values['regimen_code_txt'] ?>" onFocus="javascript:createTable(this)" maxlength="30" />
	<input type="hidden" name="regimen_code" value="<?php echo $values['regimen_code'] ?>"/>
     No. of Days dispensed:
	 <?php echo $messages['regimen_days']."\n" ?>
    <input name="regimen_days" value="<?php echo $values['regimen_days'] ?>" type="text" size="3" maxlength="3" /></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>ARV Adherance: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['adher_code']."\n" ?>
	<input name="adher_code_txt" type="text" value="<?php echo $values['adher_code_txt'] ?>" onFocus="javascript:createTable(this)" size="1" maxlength="1" />
	<input type="hidden" name="adher_code"" value="<?php echo $values['adher_code'] ?>"/>	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('adher_code_txt')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>ARV Poor Adherance Reasons </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
		<?php echo $messages['adher_reas_code']."\n" ?>
		<select name="adher_reas_code[]" multiple onFocus="javascript:createTable(this)" size="4" style="width:100px">
		<?php 
			echo $values['adher_reas_code'];
		?>
    	</select>
	    <img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('adher_reas_code[]')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Relevant Co-Meds: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
		<?php echo $messages['drugsandservices']."\n" ?>
		<select name="drugsandservices[]"  multiple onFocus="javascript:createTable(this)" size="4" style="width:200px">
		<?php 
			echo $values['drugsandservices'];
		?>
    	</select>
	    <img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('drugsandservices[]')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>CD 4 Count /%: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['cd4']."\n" ?>
	<input name="cd4" type="text" value="<?php echo $values['cd4'] ?>" size="6" maxlength="6" /></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>HB:</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['hb']."\n" ?>
	<input name="hb" type="text" value="<?php echo $values['hb'] ?>" size="6" maxlength="6" /></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>ALT</strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['alt']."\n" ?>
	<input name="alt" value="<?php echo $values['alt'] ?>" type="text" size="6" maxlength="6" /></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Abnormal Lab Results / Other: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['laboratory_param']."\n" ?>
	<select name="laboratory_param[]" multiple onFocus="javascript:createTable(this)" size="4" style="width:250px">
	<?php 
		echo $values['laboratory_param'];
	?>
    </select>
	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('laboratory_param[]')"></td>
  </tr> 
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Nutrition Support needed: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF"> 
	  <?php echo $messages['nutrition_support']."\n" ?>
	  yes
      <input name="nutrition_support" type="radio" value="1" <?php echo $values['nutrition_support'] == 1 ? 'checked="checked" ' : '' ?>/>
      no
      <input name="nutrition_support" type="radio" value="2" <?php echo $values['nutrition_support'] == 2 ? 'checked="checked" ' : '' ?>/>    </td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Referred to: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['referred_code']."\n" ?>
	<input name="referred_code_txt" value="<?php echo $values['referred_code_txt'] ?>" onFocus="javascript:createTable(this)" type="text" size="20" maxlength="60" />
	<input type="hidden" name="referred_code" />
	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('referred_code_txt')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Next Visit Date: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['next_visit_date']."\n" ?>
	<input name="next_visit_date" value="<?php echo $values['next_visit_date'] ?>" type="text" size="10" maxlength="10" onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		   id="next_visit_date" type="text" value="" />
		   <a href="javascript:show_calendar('arv_visit.next_visit_date','<?php echo $date_format; ?>')">
		   <img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
      (dd/mm/yyyy) </td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Follow Up Status </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['follow_status_code']."\n" ?>
	<input name="follow_status_code_txt" value="<?php echo $values['follow_status_code_txt'] ?>" onFocus="javascript:createTable(this)" type="text" size="30" maxlength="60" />
	<input type="hidden" name="follow_status_code" value="<?php echo $values['follow_status_code'] ?>"/>
	<img src="../../../gui/img/common/default/delete.gif" onClick="javascript:remove('follow_status_code_txt')"></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"></div></td>
    <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"><strong>Signature of clinician: </strong></div></td>
    <td colspan="2" bgcolor="#F0F8FF">
	<?php echo $messages['signature']."\n" ?>
	<input name="signature" type="text" size="30" maxlength="60" value="<?php echo $values['signature'] ?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#99ccff"><div align="right"></div></td>
    <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#99ccff">&nbsp;</td>
    <td colspan="2" bgcolor="#F0F8FF"><input name="submit" type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> id="submit" value="submit" onClick="javascript:selectAll()">
      <input name="mode" type="hidden" value="<?php echo $_REQUEST['mode']?>" />
      <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']?>" />
      <input name="visit_id" type="hidden" value="<?php echo $_REQUEST['visit_id']?>" />
      <input name="encounter_nr" type="hidden" value="<?php echo $_REQUEST['encounter_nr']?>" /></td>
  </tr>
</table>


</form>
</body>
</html>



