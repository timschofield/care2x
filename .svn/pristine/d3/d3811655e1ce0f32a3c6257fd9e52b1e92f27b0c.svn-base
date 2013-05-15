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

function toggle(element) {
	var image   = element.getElementsByTagName('img')[0];
	var content = element.parentNode.getElementsByTagName('table')[0];
	
	if (content.style.display == 'none') {
		// wenn es nicht sichtbar ist
		content.style.display = 'block'; // sichtbar machen
		image.src = '<?php echo $root_path ?>gui/img/common/default/minus_menu.gif';
	} else {
		// wenn es bereits sichtbar ist
		content.style.display = 'none'; // unsichtbar machen
		image.src = '<?php echo $root_path ?>gui/img/common/default/plus_menu.gif';
	}
}
//-------------------------
function gethelp(x,s,x1,x2,x3,x4) {
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
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

function insert() {
	var destination_obj       = document.forms[0].elements['allergies[]'];
	var source_obj            = document.forms[0].elements['insert_allergies'];
	
	var item_text=trim(source_obj.value);
	
	if (item_text=="") {
		alert("Please enter a value!");
		return false;
	}
	
	if(check_existance(destination_obj,item_text)) {
		alert("You have it in the list");
		return false;
	}
	else {
		new_item_obj = new Option (item_text);
		destination_obj.options[destination_obj.options.length]=new_item_obj;	
		source_obj.value="";
	}
	
	return true;
}

function trim(sString) {
	while (sString.substring(0,1) == ' ') {
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' ') {
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

	
function remove(element) {
	var destination_obj = document.forms[0].elements['allergies[]'];
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
	
function check_existance(destination_obj,item_text) {
	for (var i = 0; i <destination_obj.options.length ; i++) {
		if(destination_obj.options[i].text==item_text) {
			return true;
		}
	}
	return false; 
} 


//-->
</script>
<title>ART registration</title>
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
  <td bgcolor="#99ccff"><font color="#330066">&nbsp;&nbsp;ART Registration</font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $errorMessages ?>
<fieldset>
<legend onClick="toggle(this)"><img src="<?php echo $root_path ?>gui/img/common/default/plus_menu.gif" width="18" height="18" ><strong>Facility Information</strong></legend>
<table width="750" border="0">
  <tr>
  	<td bgcolor="#F0F8FF"><strong>Facility Name:</strong> <?php echo $facility_info['main_info_facility_name']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Facility Code:</strong> <?php echo $facility_info['main_info_facility_code']; ?></td>
    <td bgcolor="#F0F8FF"><strong>District:</strong> <?php echo $facility_info['main_info_facility_district']; ?></td>
  </tr>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18">Registration Data</strong></legend>
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
<legend onClick="toggle(this)"><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18"><strong>Patient Adress </strong></legend>
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

<form id="arv_registration" name="arv_registration" method="post" action="">
<fieldset>
<legend onClick="toggle(this)"><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18"><strong>Patient ART Registration</strong></legend>
<table width="750" border="0">
  
  <tr>
    <td width="206" bgcolor="#F0F8FF"><strong>Unique CTC ID Number: </strong></td>
    <td width="534" colspan="2" bgcolor="#F0F8FF"><?php echo $messages['ctc_id']."\n" ?>
      <input name="ctc_id" type="text" id="ctc_id" value="<?php echo $values['ctc_id']; ?>" size="10" maxlength="10" /></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF">&nbsp;</td>
    <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Patient Referred from:</strong></td>
    <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF">      
	<?php echo $messages['referred_from']."\n" ?>
	<input name="referred_from" type="radio"   <?php echo $values['referred_from'] == 1 ? 'checked="checked" ' : '' ?> value="1" />
    OPD </td>
    <td colspan="2" bgcolor="#F0F8FF">
	<input name="referred_from" type="radio" <?php echo $values['referred_from'] == 2 ? 'checked="checked" ' : '' ?> value="2" />
      STI </td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><input name="referred_from" type="radio" value="3" <?php echo $values['referred_from'] == 3 ? 'checked="checked" ' : '' ?> />
      MCH / PMTCT </td>
    <td colspan="2" bgcolor="#F0F8FF"><input name="referred_from" type="radio" <?php echo $values['referred_from'] == 4 ? 'checked="checked" ' : '' ?> value="4" />
      PLHA Group </td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><input name="referred_from" type="radio" value="5" <?php echo $values['referred_from'] == 5 ? 'checked="checked" ' : '' ?> />
      Self referral (includes vct) </td>
    <td colspan="2" bgcolor="#F0F8FF"><input name="referred_from" type="radio" value="7" <?php echo $values['referred_from'] == 7 ? 'checked="checked" ' : '' ?> />
      Inpatient </td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><input name="referred_from" type="radio" value="8" <?php echo $values['referred_from'] == 8 ? 'checked="checked" ' : '' ?> />
      TB /Dots </td>
    <td colspan="2" bgcolor="#F0F8FF"><input name="referred_from" type="radio" value="9" <?php echo $values['referred_from'] == 9 ? 'checked="checked" ' : '' ?> />
      HBC </td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#F0F8FF"><?php echo $messages['referred_from_other']."\n" ?>
      <input name="referred_from" type="radio" value="6" <?php echo $values['referred_from'] == 6 ? 'checked="checked" ' : '' ?> />
	
      Other (specify)
      <input name="referred_from_other" type="text" id="referred_from_other" value="<?php echo $values['referred_from_other']; ?>" maxlength="30" /></td></tr>
</table>
</fieldset>
    <fieldset>
    <legend onClick="toggle(this)"><strong><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18">Additional Adress Info </strong></legend>
      <table width="750" border="0">
      
      <tr>
        <td bgcolor="#F0F8FF"><strong>Chairman: </strong></td>
        <td bgcolor="#F0F8FF">
		  <?php echo $messages['chairman_vname']."\n" ?>
		  Firstname:          </td>
        <td bgcolor="#F0F8FF"><input name="chairman_vname" type="text" id="chairman_vname" value="<?php echo $values['chairman_vname']; ?>" size="20" maxlength="60" /></td>
        <td bgcolor="#F0F8FF"><?php echo $messages['chairman_nname']."\n" ?> Lastname:          </td>
        <td bgcolor="#F0F8FF"><input name="chairman_nname" type="text" id="chairman_nname" value="<?php echo $values['chairman_nname']; ?>" size="20" maxlength="60" /></td>
      </tr>
      <tr>
        <td bgcolor="#F0F8FF">&nbsp;</td>
        <td bgcolor="#F0F8FF">
		  <?php echo $messages['chairman_street']."\n" ?>
		  Street:          </td>
        <td bgcolor="#F0F8FF"><input name="chairman_street" type="text" id="chairman_street" value="<?php echo $values['chairman_street']; ?>" size="20" maxlength="60" /></td>
        <td bgcolor="#F0F8FF"><?php echo $messages['chairman_village']."\n" ?>Village:          </td>
        <td bgcolor="#F0F8FF"><input name="chairman_village" type="text" id="chairman_village" value="<?php echo $values['chairman_village']; ?>" size="20" maxlength="60" /></td>
      </tr>
      <tr>
        <td bgcolor="#F0F8FF">&nbsp;</td>
        <td bgcolor="#F0F8FF"><?php echo $messages['chairman_hamlet']."\n" ?> Hamlet:          </td>
        <td bgcolor="#F0F8FF"><input name="chairman_hamlet" type="text" id="chairman_hamlet" value="<?php echo $values['chairman_hamlet']; ?>" size="20" maxlength="60" /></td>
        <td bgcolor="#F0F8FF">&nbsp;</td>
        <td bgcolor="#F0F8FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F0F8FF">&nbsp;</td>
        <td colspan="4" bgcolor="#F0F8FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#F0F8FF"><strong>Ten Cell Leader: </strong></td>
        <td colspan="4" bgcolor="#F0F8FF">
		<?php echo $messages['ten_cell_leader']."\n" ?>
		<input name="ten_cell_leader" type="text" id="ten_cell_leader" value="<?php echo $values['ten_cell_leader']; ?>" size="20" maxlength="60" /></td>
      </tr>
      <tr>
        <td bgcolor="#F0F8FF"><strong>Head of Houselhold: </strong></td>
		<?php echo $messages['head_of_household']."\n" ?>
        <td colspan="4" bgcolor="#F0F8FF"><?php echo $messages['head_of_household']."\n" ?>
          <input name="head_of_household" type="text" id="head_of_household" value="<?php echo $values['head_of_household']; ?>" size="20" maxlength="60" /></td></tr>
    </table>
  </fieldset>
      <fieldset>
      <legend onClick="toggle(this)"><strong><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18">ARV Data </strong></legend>
        <table width="750" border="0">
        
        <tr>
          <td width="200" bgcolor="#F0F8FF"><strong>Prior ARV Exposure: </strong></td>
          <td colspan="3" bgcolor="#F0F8FF">
		  <?php echo $messages['exposure']."\n" ?>
		  <?php $selected[$values['exposure']]="selected"; ?>
		  <select name="exposure" size="1" id="exposure">
            <option value="" <?php echo $selected[""] ?> ></option>
			<option value="1" <?php echo $selected[1] ?> >None</option>
            <option value="2" <?php echo $selected[2] ?> >Prior Therapy (transfer in without records)</option>
            <option value="3" <?php echo $selected[3] ?> >PMTCT Monotherapy</option>
            <option value="4" <?php echo $selected[4] ?> >PMTCT Combination Therapy</option>
            <option value="5"<?php echo $selected[5] ?> >Transfer in (with records)</option>
          </select>          </td>
          </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date of first HIV+ Test: </strong></td>
          <td width="242" bgcolor="#F0F8FF">
		  <?php echo $messages['date_first_hiv_test']."\n" ?>
		  <input name="date_first_hiv_test" type="text" id="date_first_hiv_test" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		  value="<?php echo $values['date_first_hiv_test']; ?>" />
		  <a href="javascript:show_calendar('arv_registration.date_first_hiv_test','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
          (dd/mm/yyyy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date Confirmed HIV+:</strong></td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['date_confirmed_hiv']."\n" ?>
		  <input name="date_confirmed_hiv" type="text" id="date_confirmed_hiv" value="<?php echo $values['date_confirmed_hiv']; ?>" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		  />
		  <a href="javascript:show_calendar('arv_registration.date_confirmed_hiv','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
          (dd/mm/yyyy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date enrolled in care: </strong></td>
          <td bgcolor="#F0F8FF"><?php echo $messages['date_enrolled']."\n" ?>
            <input name="date_enrolled" type="text" id="date_enrolled" value="<?php echo $values['date_enrolled']; ?>" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
		  />
		  <a href="javascript:show_calendar('arv_registration.date_enrolled','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>(dd/mm/yyyy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date med. eligible: </strong></td>
          <td bgcolor="#F0F8FF"><?php echo $messages['date_eligible']."\n" ?>
            <input name="date_eligible" type="text" id="date_eligible" value="<?php echo $values['date_eligible']; ?>" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" />
		  <a href="javascript:show_calendar('arv_registration.date_eligible','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a> (dd/mm/yyyy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF"><strong>Why eligible: </strong></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td colspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['eligible_reason']."\n" ?>
		  <input name="eligible_reason" type="radio" value="1"  <?php echo $values['eligible_reason'] == 1 ? 'checked="checked" ' : '' ?> />
          Clinical only </td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td colspan="2" bgcolor="#F0F8FF"><?php echo $messages['eligible_reason_cd4']."\n" ?>
<input name="eligible_reason" type="radio"   <?php echo $values['eligible_reason'] == 2 ? 'checked="checked" ' : '' ?> value="2" />
          CD4 Count/% 
          <input name="eligible_reason_cd4" type="text" id="eligible_reason_cd4" value="<?php echo $values['eligible_reason_cd4']; ?>" size="8" maxlength="8" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td colspan="2" bgcolor="#F0F8FF"><?php echo $messages['eligible_reason_tlc']."\n" ?>
            <input name="eligible_reason" type="radio"  <?php echo $values['eligible_reason'] == 3 ? 'checked="checked" ' : '' ?> value="3" />
          
		  TLC 
          <input name="eligible_reason_tlc" type="text" id="eligible_reason_tlc" value="<?php echo $values['eligible_reason_tlc']; ?>" size="8" maxlength="8" /></td></tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date eligible &amp; ready:</strong> </td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['date_ready']."\n" ?>
		  <input name="date_ready" type="text" id="date_ready" value="<?php echo $values['date_ready']; ?>" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" />
		  <a href="javascript:show_calendar('arv_registration.date_ready','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>(dd/mm/yy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Date start ART </strong></td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['date_start_art']."\n" ?>
		  <input name="date_start_art" type="text" id="date_start_art" value="<?php echo $values['date_start_art']; ?>" size="10" maxlength="10" 
		  onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" />
		  <a href="javascript:show_calendar('arv_registration.date_start_art','<?php echo $date_format; ?>')">
		  <img src="<?php echo $root_path; ?>gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>(dd/mm/yy)		  </td>
          <td colspan="2" bgcolor="#F0F8FF"><strong>Status at start ART:</strong> </td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td width="155" bgcolor="#F0F8FF" >
		   <?php echo $messages['status_clinical_stage']."\n" ?>
		  Clinical Stage: 
		    <?php $selected[$values['status_clinical_stage']]="selected"; ?></td>
          <td width="135" bgcolor="#F0F8FF"><select name="status_clinical_stage" size="1" id="status_clinical_stage">
            <option <?php echo $selected[""] ?> ></option>
            <option <?php echo $selected[1] ?> >1</option>
            <option <?php echo $selected[2] ?> >2</option>
            <option <?php echo $selected[3] ?> >3</option>
            <option <?php echo $selected[4] ?> >4</option>
          </select></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['status_function']."\n" ?>
		  Function:
		   <?php $selected[$values['status_function']]="selected"; ?></td>
          <td bgcolor="#F0F8FF"><select name="status_function" size="1" id="status_function">
            <option value="" selected <?php echo $selected[''] ?>></option>
            <option <?php echo $selected[1] ?> value="1">Working</option>
            <option <?php echo $selected[2] ?> value="2">Ambulatory</option>
            <option <?php echo $selected[3] ?> value="3">Bedridden</option>
          </select></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['status_weight']."\n" ?>
		  Weight          </td>
          <td bgcolor="#F0F8FF"><input name="status_weight" type="text" id="status_weight" value="<?php echo $values['status_weight']; ?>" size="8" maxlength="8" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">&nbsp;</td>
          <td bgcolor="#F0F8FF">
		  <?php echo $messages['status_cd4']."\n" ?>
		  CD4:          </td>
          <td bgcolor="#F0F8FF"><input name="status_cd4" type="text" id="status_cd4" value="<?php echo $values['status_cd4']; ?>" size="8" maxlength="8" />
		  <input name="status_cd4_code" type="hidden" value="<?php echo $values['status_cd4_code']; ?>" />		  </td>
        </tr>
      </table>
      </fieldset>
 
      <fieldset>
      <legend onClick="toggle(this)"><strong><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18">Allergies</strong></legend>
        <table width="750" border="0" bgcolor="#F0F8FF">
        <tr>
          <td width="266" rowspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['insert_allergies']."\n" ?>
		  <input name="insert_allergies" type="text" id="insert_allergies" size="30" maxlength="60"></td>
          <td width="86" bgcolor="#F0F8FF"><input name="add" type="button" id="add" onclick="insert()" value="add"></td>
          <td width="384" colspan="2" rowspan="2">
		    <select name="allergies[]" size="4" multiple id="allergies[]" style="width:200px">
		  <?php echo $values['allergies']?>
            </select>		  </td>
        </tr>
        
        <tr>
          <td bgcolor="#F0F8FF"><input name="delete" type="button" onclick="javascript:remove(this)" "id="delete" value="del"></td>
        </tr>
      </table>
      </fieldset>
    
      <fieldset>
      <legend onClick="toggle(this)"><strong><img src="<?php echo $root_path; ?>gui/img/common/default/plus_menu.gif" width="18" height="18">Treatment Supporter Information </strong></legend>
        <table width="750" border="0">
        <tr>
          <td width="316" bgcolor="#F0F8FF"><strong>Firstname:</strong></td>
          <td width="424" colspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['supporter_vname']."\n" ?>
		  <input name="supporter_vname" type="text" id="supporter_vname" value="<?php echo $values['supporter_vname']; ?>" size="30" maxlength="60" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Name</strong></td>
          <td colspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['supporter_nname']."\n" ?>
		  <input name="supporter_nname" type="text" id="supporter_nname" value="<?php echo $values['supporter_nname']; ?>" size="30" maxlength="60" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Street:</strong></td>
          <td colspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['supporter_street']."\n" ?>
		  <input name="supporter_street" type="text" id="supporter_street" value="<?php echo $values['supporter_street']; ?>" size="30" maxlength="60" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Village:</strong></td>
          <td colspan="2" bgcolor="#F0F8FF">
		  <?php echo $messages['supporter_villae']."\n" ?>
		  <input name="supporter_village" type="text" id="supporter_village" value="<?php echo $values['supporter_village']; ?>" size="30" maxlength="60" /></td>
        </tr>
        <tr>
          <td bgcolor="#F0F8FF"><strong>Telephone:</strong></td>
          <td colspan="2" bgcolor="#F0F8FF">
		   <?php echo $messages['supporter_telephone']."\n" ?>
		  <input name="supporter_telephone" type="text" id="supporter_telephone" value="<?php echo $values['supporter_telephone']; ?>" size="10" maxlength="10" /></td>
        </tr>
        <tr>
          <td rowspan="2" bgcolor="#F0F8FF"><strong>Community Support Organisation/Group </strong></td>
          <td colspan="2" bgcolor="#F0F8FF">
		   <?php echo $messages['supporter_organisation']."\n" ?>
		  <input name="supporter_organisation" type="text" id="supporter_organisation" value="<?php echo $values['supporter_organisation']; ?>" size="30" maxlength="60" /></td>
        </tr>
        
        <tr>
          <td colspan="2"></td>
        </tr>
      </table>
      </fieldset>
	  <fieldset>
	   <table width="750">
         <tr>
           <td width="95" bgcolor="#F0F8FF"><?php echo $messages['signature']."\n" ?><strong>Signature:</strong></td>
           <td width="643" bgcolor="#F0F8FF"><input name="signature" type="text" id="signature" value="<?php echo $values['signature']; ?>" size="20" maxlength="60" /></td>
         </tr>
         <tr>
           <td colspan="2" bgcolor="#F0F8FF">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" bgcolor="#F0F8FF"><input name="registration_id" type="hidden" value="<?php echo $values['registration_id']?>" />
             <input name="mode" type="hidden" value="<?php echo $_REQUEST['mode']?>" />
             <input name="pid" type="hidden" value="<?php echo $_REQUEST['pid']?>" />
             <input name="encounter_nr" type="hidden" value="<?php echo $_REQUEST['encounter_nr']?>" />
             <input name="submit" type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> id="submit" value="Submit" onClick="javascript:selectAll()"/></td>
         </tr>
       </table>
	  </fieldset>
</form>
    </p>
  <p>&nbsp;</p></td>
</tr>
</body>
</html>
