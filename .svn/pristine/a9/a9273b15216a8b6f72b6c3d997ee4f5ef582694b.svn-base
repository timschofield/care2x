<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ARV Registration</title>
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
<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.mainTable {
	border: 2px ridge black;
	margin-top: 15px;
	width:764px;
	margin-left:auto;
	margin-right:auto;
}

textarea, input{
	font-family:verdana,arial,tahoma,sans-serif;
    font-size:14px;
}

.error {
	color:red;
	font-weight:bold;
}

.error2 {
	text-align:center;
	font-size:18px;
	color: red;
	font-weight: bold;
}

.leftTable {
	background-color:#99ccff;
	color: #330066;
	font-weight: bold;
}

tr {
	background-color:#F0F5FF;
	height:23px;
}

.blue {
	color: #330066;
	font-weight: bold;
}

.requiredNote {
	color: red;
}

td {
	padding-left:4px;
	padding-right:4px;
}
-->
</style>

</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >

    &nbsp;&nbsp;<font color="#330066">Patient ARV Registration</font>
       </td>

  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_registration.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile; ?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php 
	while (list($x,$v) = each($messages_err)){
		echo $v;	
	}
	
if($o_arv_case->isOk()) { 	 
?>
<table class="mainTable">
  <tr>
    <td><span class="blue">Facility Name: </span><?php echo $facility_data['main_info_facility_name']?></td>
    <td><span class="blue">Code: </span><?php echo $facility_data['main_info_facility_code']?></td>
    <td><span class="blue">District: </span><?php echo $facility_data['main_info_facility_district']?></td>
  </tr>
</table>
<form  action="arv_case.php" method="get" name="mainForm" id="mainForm">
<table class="mainTable">
		<tr>
			<td width="50%" class="leftTable" valign="top" align="right">date:</td>
			<td valign="top" align="left"><?php echo formatDate2Local(date('Y-m-d',$_GET['arv_patient_data']['create_time']),$date_format,null,null) ?></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Firstname:</td>
			<td valign="top" align="left"><?php echo $o_arv_case->getValue('name_first') ?></td>
		</tr>
		<tr >
			<td width="50%" valign="top" class="leftTable" align="right">Lastname:</td>
			<td valign="top" align="left"><?php echo $o_arv_case->getValue('name_last') ?></td>
		</tr>
		<tr >
			<td width="50%" valign="top" class="leftTable" align="right">Date of birth:</td>
			<td valign="top" align="left"><?php echo formatDate2Local($o_arv_case->getValue('date_birth'),$date_format,null,null) ?></td>

		</tr>
		<tr><td width="50%" valign="top" class="leftTable" align="right">Sex:</td>
			<td valign="top" align="left"><?php echo $o_arv_case->getValue('sex') ?></td>
		</tr>
		<tr >
			<td width="50%" valign="top" class="leftTable" align="right">Telephone/ Simu ya Mgonjwa:</td>
			<td valign="top" align="left"><?php echo $o_arv_case->getTelephoneCombined() ?></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right"><font color="red"><b>*</b></font>Patient_ID:</td>
			<td valign="top" align="left">
				<?php echo $messages['arv_pid']."\n" ?>
				<input size="12" maxlength="20" name="arv_patient_data[arv_pid]" type="text" value="<?php echo $_GET['arv_patient_data']['arv_pid']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">District/ Wilaya/ Tarafi/ Kata:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[district]" type="text" value="<?php echo $_GET['arv_patient_data']['district']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Village/ Kitongoji:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[village]" type="text" value="<?php echo $_GET['arv_patient_data']['village']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Street/ Mtaa:</td>
			<td valign="top" align="left">
				<input size="30" maxlength="80" name="arv_patient_data[street]" type="text" value="<?php echo $_GET['arv_patient_data']['street']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Mjumbe/Balozi:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[balozi]" type="text" value="<?php echo $_GET['arv_patient_data']['balozi']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Chairman of the village/ Mwenyekiti wa Mtaa/ Kitongolji:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[chairman_of_village]" type="text" value="<?php echo $_GET['arv_patient_data']['chairman_of_village']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Head of family/ Mkuu wa kaya:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[head_of_family]" type="text" value="<?php echo $_GET['arv_patient_data']['head_of_family']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Name of the secretary/ Jina la msaidizi wa karibu:</td>
			<td valign="top" align="left">
				<input size="20" maxlength="80" name="arv_patient_data[name_of_secretary]" type="text" value="<?php echo $_GET['arv_patient_data']['name_of_secretary']; ?>" />
				</td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Phone/ Simu:</td>
			<td valign="top" align="left">
				<?php echo $o_arv_case->get_Error_message('secretary_phone')."</br>" ?>
				<input size="15" maxlength="20" name="arv_patient_data[secretary_phone]" type="text" value="<?php echo $_GET['arv_patient_data']['secretary_phone']; ?>" /></td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Postal adress/ anuani:</td>
			<td valign="top" align="left">
				<input size="30" maxlength="100" name="arv_patient_data[secretary_adress]" type="text" value="<?php echo $_GET['arv_patient_data']['secretary_adress']; ?>" />
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Date of first pos HIV-test:</td>
			<td valign="top" align="left">
				<?php echo $messages['datetime_first_hivtest'] ?>
				<input size="10" maxlength="20" onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
				name="arv_patient_data[datetime_first_hivtest]" id="datetime_first_hivtest" type="text" value="<?php echo $_GET['arv_patient_data']['datetime_first_hivtest']; ?>" />
				<a href="javascript:show_calendar('mainForm.datetime_first_hivtest','<?php echo $date_format; ?>')">
					<img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22">
				</a>
				[ <?php echo $date_format; ?> ] 
			</td>
		</tr>
			<tr>
			<td width="50%" valign="top" class="leftTable" align="right">Start date ARV's:</td>
			<td valign="top" align="left">
				<?php echo $messages['datetime_start_arv']."\n" ?>
				<input size="10" maxlength="20" onfocus="this.select()" onkeyup="setDate(this,'<?php echo $date_format; ?>','<?php echo $lang; ?>')" 
				name="arv_patient_data[datetime_start_arv]" id="datetime_start_arv" type="text" value="<?php echo $_GET['arv_patient_data']['datetime_start_arv']; ?>" />
					<a href="javascript:show_calendar('mainForm.datetime_start_arv','<?php echo $date_format; ?>')"><img src="../../gui/img/common/default/show-calendar.gif" border=0 align="absmiddle" width="26" height="22"></a>
					[ <?php echo $date_format; ?> ] 
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right"></td>
			<td valign="top" align="left">
				<input name="submit" value="Save" type="submit" />
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top" class="leftTable" align="right"></td>
			<td valign="top" align="left">
				<input name="Reset" value="Reset" type="reset" />
			</td>
		</tr>
		<tr>
			<td class="leftTable"></td>
			<td align="left" valign="top"><div class="requiredNote">* required fields</div></td>
		</tr>
</table>
<input type="hidden" name="pid" value="<?php echo $_GET['pid'];?>"/>
<input type="hidden" name="mode" value="<?php echo $_GET['mode'];?>"/>
</form>
<?php 
}?>
</body>
</html>




