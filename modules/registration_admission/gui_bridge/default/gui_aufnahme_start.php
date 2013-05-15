<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $headframe_title ?></TITLE>

<?php

# If  pid exists, output the form checker javascript
if(isset($pid) && $pid){

?>

<script  language="javascript">
<!--

function chkform(d) {
	encr=<?php if ($encounter_class_nr) {echo $encounter_class_nr; } else {echo '0';} ?>;
	if(d.encounter_class_nr[0]&&d.encounter_class_nr[1]&&!d.encounter_class_nr[0].checked&&!d.encounter_class_nr[1].checked){
		alert("<?php echo $LDPlsSelectAdmissionType; ?>");
		return false;
	}else if(d.encounter_class_nr[0]&&d.encounter_class_nr[0].checked&&!d.current_ward_nr.value){
		alert("<?php echo $LDPlsSelectWard; ?>");
		d.current_ward_nr.focus();
		return false;
	}else if(d.encounter_class_nr[1]&&d.encounter_class_nr[1].checked&&!d.current_dept_nr.value){
		alert("<?php echo $LDPlsSelectDept; ?>");
		d.current_dept_nr.focus();
		return false;
	}else if(!d.encounter_class_nr[0]&&encr==1&&!d.current_ward_nr.value){
		alert("<?php echo $LDPlsSelectWard; ?>");
		d.current_ward_nr.focus();
		return false;
	}else if(!d.encounter_class_nr[1]&&encr==2&&!d.current_dept_nr.value){
		alert("<?php echo $LDPlsSelectDept; ?>");
		d.current_dept_nr.focus();
		return false;
	}else if(d.referrer_diagnosis.value==""){
		alert("<?php echo $LDPlsEnterRefererDiagnosis; ?>");
		d.referrer_diagnosis.focus();
		return false;
	}else if(d.referrer_dr.value==""){
		alert("<?php echo $LDPlsEnterReferer; ?>");
		d.referrer_dr.focus();
		return false;
	}else if(d.referrer_recom_therapy.value==""){
		alert("<?php echo $LDPlsEnterRefererTherapy; ?>");
		d.referrer_recom_therapy.focus();
		return false;
	}else if(d.referrer_notes.value==""){
		alert("<?php echo $LDPlsEnterRefererNotes; ?>");
		d.referrer_notes.focus();
		return false;
	}else if(d.encoder.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.encoder.focus();
		return false;
	}else{
		return true;
	}
}
function resolveLoc(){
	d=document.aufnahmeform;
	if(d.encounter_class_nr[0].checked==true) d.current_dept_nr.selectedIndex=0;
		else d.current_ward_nr.selectedIndex=0;
}
-->
</script>

<?php
# End of if(isset(pid))
}

require('./include/js_popsearchwindow.inc.php');
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>


<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php
if(!$encounter_nr && !$pid)
{
?>
onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();"
<?php
}
if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; }
?>>


<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo $headframe_title; if($encounter_nr) echo $headframe_append; ?></STRONG></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_how2new.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
# Load tabs
$target='entry';
include('./gui_bridge/default/gui_tabs_patadmit.php')
?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>
<ul>

<?php
# If the origin is admission link, show the search prompt
if(!isset($pid) || !$pid){

	# Set color values for the search mask
	$searchmask_bgcolor="#f3f3f3";
	$searchprompt=$LDEntryPrompt;
	$entry_block_bgcolor='#fff3f3';
	$entry_border_bgcolor='#6666ee';
	$entry_body_bgcolor='#ffffff';
?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>

 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	        /* set the script for searching */
	       $search_script='patient_register_search.php';
		   $user_origin='admit';

            include($root_path.'include/inc_patient_searchmask.php');

	   ?>
</td>
     </tr>
   </table>

   <FONT    SIZE=3  FACE="Arial" color="#990000"><br>
   <img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle'); ?>>
<?php

   echo $LDRedirectToRegistry;
}
else
{
?>

<FONT    SIZE=-1  FACE="Arial">

<form method="post" action="<?php echo $thisfile; ?>" name="aufnahmeform" onSubmit="return chkform(this)">

<table border="0" cellspacing=1 cellpadding=0>


<?php
if($error)
{
?>
<tr>
<td colspan=4><center>
<font face=arial color=#7700ff size=4>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle">
	<?php if ($errornum>1) echo $LDErrorS; else echo $LDError; ?>
</center>
</td>
</tr>
<?php
}
 ?>


<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDCaseNr ?>:
</td>
<td bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" ><?php if(isset($encounter_nr)&&$encounter_nr) echo $encounter_nr; else echo '<font color="red">'.$LDNotYetAdmitted.'</font>'; ?>
</td>
<td rowspan=7 align="center"><img <?php echo $img_source ?>>
</td>
</tr>

<tr>
<td  background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitDate ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php
    if(isset($encounter_nr)&&$encounter_nr) echo @formatDate2Local(date('Y-m-d'),$date_format);
?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDAdmitTime ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial" color="#800000">
<?php if(isset($encounter_nr)&&$encounter_nr) echo @convertTimeToLocal(date('H:i:s')); ?>
</td>
</tr>
<tr>
<td colspan=2><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDTitle ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><?php echo $title ?>
</td>

</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_last; ?></b>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_first; ?></b>
</td>
</tr>

<?php if($GLOBAL_CONFIG['patient_name_2_show']&&$name_2)
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDName2 ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_2; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_3_show']&&$name_3)
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDName3 ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_3; ?></b>
</td>
</tr>
<?php
}

if($GLOBAL_CONFIG['patient_name_middle_show']&&$name_middle)
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDNameMid ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial" color="#800000"><b><?php echo $name_middle; ?></b>
</td>
</tr>
<?php
}
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><FONT SIZE=-1  FACE="Arial"><b><?php echo @formatDate2Local($date_birth,$date_format);?></b>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial"><?php echo $LDSex ?>: <?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDBloodGroup ?>:
</td>
<td bgcolor="#ffffee" colspan=2><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php
if($blood_group){
	$buf='LD'.$blood_group;
	echo $$buf;
}
?>
</td>
</tr>


<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDAddress ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php

/* Note: The address is displayed in german format.
*   STREET_NAME STREET_NUMBER
*   ZIP_CODE  TOWN_OR_CITY
*  Edit the code to display it in other formats
*/
echo $addr_str.' '.$addr_str_nr.'<br>';
echo $addr_zip.' '.$addr_citytown_name.'<br>';

?>
</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial" color=red><?php echo $LDAdmitClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php
if(is_object($encounter_classes)){
	while($result=$encounter_classes->FetchRow()) {
       	$LD=$result['LD_var'];
		//if($in_ward && ($encounter_class_nr==$result['class_nr'])){ # If in ward, freeze encounter class
		if($encounter_nr ){ # If admitted, freeze encounter class
           if ($encounter_class_nr==$result['class_nr']){
		   		if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
				echo '<input name="encounter_class_nr" type="hidden"  value="'.$encounter_class_nr.'">';
				break;
			}
		}else{
?>
	<input name="encounter_class_nr" onClick="resolveLoc()" type="radio"  value="<?php echo $result['class_nr']; ?>" <?php if($encounter_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php
            if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        	echo '&nbsp;';
		}
	}
}
?>
</td>
</tr>

<?php
# If no encounter nr or inpatient, show ward/station info, 1 = inpatient
if(!$encounter_nr||$encounter_class_nr==1){
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorward||$encounter_class_nr==1) echo "<font color=red>"; ?><?php echo $LDWard ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php
if($in_ward){
    while($station=$ward_info->FetchRow()){
	    if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])){
			echo $station['name'];
			echo '<input name="current_ward_nr" type="hidden"  value="'.$current_ward_nr.'">';
			break;
		}
    }
}else{
?>
<select name="current_ward_nr">
	<option value=""></option>
<?php
if(!empty($ward_info)&&$ward_info->RecordCount()){
    while($station=$ward_info->FetchRow()){
	    echo '
	    <option value="'.$station['nr'].'" ';
	    if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) echo 'selected';
		echo '>'.$station['name'].'</option>';
    }
}
?>
</select>
<font size=1><?php
//echo '<img '.createComIcon($root_path,'redpfeil_l.gif','0').'> '.$LDForInpatient.' <a href="javascript:gethelp(\'admission_why_ward.php\')" title="'.$LDHelp.'">[ ? ]</a>';
echo '<img '.createComIcon($root_path,'redpfeil_l.gif','0').'> '.$LDForInpatient;
}
?></font>
</td>
</tr>
<?php
# End of if no encounter nr
}

# If no encounter nr or outpatient, show clinic/department info, 2 = outpatient
if(!$encounter_nr||$encounter_class_nr==2){
?>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorward||$encounter_class_nr==2) echo "<font color=red>"; ?><?php echo "$LDClinic/$LDDepartment"; ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<?php
if($in_dept){
    while($deptrow=$all_meds->FetchRow()){
	    if(isset($current_dept_nr)&&($current_dept_nr==$deptrow['nr'])){
			echo $deptrow['name_formal'];
			echo '<input name="current_dept_nr" type="hidden"  value="'.$current_dept_nr.'">';
			break;
		}
    }
}else{
?>
<select name="current_dept_nr">
	<option value=""></option>
<?php
if(is_object($all_meds)){
    while($deptrow=$all_meds->FetchRow()){
	    echo '
	    <option value="'.$deptrow['nr'].'" ';
	    if(isset($current_dept_nr)&&($current_dept_nr==$deptrow['nr'])) echo 'selected';
		echo '>';
		if($$deptrow['LD_var']!='') echo $$deptrow['LD_var'];
			else echo $deptrow['name_formal'];
		echo '</option>';
    }
}
?>
</select>
<font size=1><?php
//echo '<img '.createComIcon($root_path,'redpfeil_l.gif','0').'> '.$LDForOutpatient.' <a href="javascript:gethelp(\'admission_why_clinic.php\')" title="'.$LDHelp.'">[ ? ]</a>';
echo '<img '.createComIcon($root_path,'redpfeil_l.gif','0').'> '.$LDForOutpatient;
}
?></font>
</td>
</tr>
<?php
# End of if no encounter nr
}
?>


<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php //if ($errordiagnose) echo "<font color=red>"; ?><font color=red><?php echo $LDDiagnosis ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_diagnosis" type="text" size="60" value="<?php echo $referrer_diagnosis; ?>">
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php //if ($errorreferrer) echo "<font color=red>"; ?><font color=red><?php echo $LDRecBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_dr" type="text" size="60" value="<?php echo $referrer_dr; ?>"><!-- <a href="#"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a> -->
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php //if ($errortherapie) echo "<font color=red>"; ?><font color=red><?php echo $LDTherapy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_recom_therapy" type="text" size="60" value="<?php echo $referrer_recom_therapy; ?>">
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php //if ($errorbesonder) echo "<font color=red>"; ?><font color=red><?php echo $LDSpecials ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="referrer_notes" type="text" size="60" value="<?php echo $referrer_notes; ?>">
</td>
</tr>

<!-- The insurance class  -->
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($errorinsclass) echo "<font color=red>"; ?><?php echo $LDBillType ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">

<?php
if(is_object($insurance_classes)){
    while($result=$insurance_classes->FetchRow()) {
?>
<input name="insurance_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>" <?php if($insurance_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
}
?>

</td>
</tr>

<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($error_ins_nr) echo "<font color=red>"; ?><?php echo $LDInsuranceNr ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="insurance_nr" type="text" size="60" value="<?php if(isset($insurance_nr)) echo $insurance_nr; ?>">
</td>
</tr>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php if ($error_ins_co) echo "<font color=red>"; ?><?php echo $LDInsuranceCo ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input name="insurance_firm_name" type="text" size="60" value="<?php  if(isset($insurance_firm_name))echo $insurance_firm_name; ?>"><a href="javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>></a>
</td>
</tr>

<?php

//if (!$GLOBAL_CONFIG['patient_care_service_hide'] && $care_ok)
if (!$GLOBAL_CONFIG['patient_service_care_hide']&& is_object($care_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDCareServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial"><nobr>
<select name="sc_care_class_nr" >
<?php
while($buffer=$care_service->FetchRow())
{
  echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_care_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_care_start"  value="<?php if(!empty($sc_care_start))  echo @formatDate2Local($sc_care_start,$date_format); ?>" size=9 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<?php echo $LDTo ?> <input type="text" name="sc_care_end"  value="<?php if(!empty($sc_care_end))  echo @formatDate2Local($sc_care_end,$date_format); ?>" size=9 maxlength=10   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<input type="hidden" name="sc_care_nr" value="<?php echo $sc_care_nr; ?>">
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_room_hide'] && $room_ok)
if (!$GLOBAL_CONFIG['patient_service_room_hide']&&is_object($room_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDRoomServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_room_class_nr" >
<?php
while($buffer=$room_service->FetchRow())
{
  echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_room_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_room_start"  value="<?php if(!empty($sc_room_start))  echo @formatDate2Local($sc_room_start,$date_format); ?>" size=9 maxlength=10    onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<?php echo $LDTo ?> <input type="text" name="sc_room_end"  value="<?php if(!empty($sc_room_end))  echo @formatDate2Local($sc_room_end,$date_format); ?>" size=9 maxlength=10    onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<input type="hidden" name="sc_room_nr" value="<?php echo $sc_room_nr; ?>">
</td>
</tr>
<?php
}

//if (!$GLOBAL_CONFIG['patient_service_att_dr_hide'] && $att_dr_ok)
if (!$GLOBAL_CONFIG['patient_service_att_dr_hide']&&is_object($att_dr_service))
{
?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial"><?php echo $LDAttDrServiceClass ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">
<select name="sc_att_dr_class_nr" >
<?php
while($buffer=$att_dr_service->FetchRow())
{
   echo '
	<option value="'.$buffer['class_nr'].'" ';
	if($sc_att_dr_class_nr==$buffer['class_nr']) echo 'selected';
	echo '>';
	if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	echo '</option>';
}
?>
</select>

<?php echo $LDFrom ?> <input type="text" name="sc_att_dr_start" size=9 maxlength=10  value="<?php if(!empty($sc_att_dr_start)) echo  @formatDate2Local($sc_att_dr_start,$date_format); ?>"   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<?php echo $LDTo ?> <input type="text" name="sc_att_dr_end" size=9 maxlength=10 value="<?php if(!empty($sc_att_dr_end)) echo  @formatDate2Local($sc_att_dr_end,$date_format); ?>"   onBlur="IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
<input type="hidden" name="sc_att_dr_nr" value="<?php echo $sc_att_dr_nr; ?>">
</td>
</tr>
<?php
}

?>
<tr>
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>">&nbsp;<FONT SIZE=-1  FACE="Arial" color=red><?php echo $LDAdmitBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><input  name="encoder" type="text" value=<?php if ($encoder!='') echo '"'.$encoder.'"' ; else echo '"'.$_COOKIE[$local_user.$sid].'"' ?> size="28" readonly>
</nobr>
</td>
</tr>

<input type="hidden" name="pid" value="<?php echo $pid; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr; ?>">
<input type="hidden" name="appt_nr" value="<?php echo $appt_nr; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="insurance_firm_id" value="<?php echo $insurance_firm_id; ?>">
<input type="hidden" name="insurance_show" value="<?php echo $insurance_show; ?>">

<tr>
<td colspan="3">
</td>&nbsp;
</tr>
<tr>
<td>
<?php if($update) echo '<input type="hidden" name=update value=1>'; ?>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> title="<?php echo $LDSaveData ?>" align="absmiddle">
</td>
<td align="right">

<a href="<?php echo 'patient_register_show.php'.URL_APPEND.'&pid='.$pid ?>"><img <?php echo createLDImgSrc($root_path,'reg_data.gif','0') ?> title="<?php echo $LDRegistration ?>"  align="absmiddle"></a>
</td>
<td align="right">
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> title="<?php echo $LDCancel ?>"  align="absmiddle"></a>
<!-- Note: uncomment the ff: line if you want to have a reset button  -->
<!--
<a href="javascript:document.aufnahmeform.reset()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDResetData ?>"  align="absmiddle"></a>
-->

</td>
</tr>

</table>
<?php if($error==1)
echo '<input type="hidden" name="forcesave" value="1">
								<input  type="submit" value="'.$LDForceSave.'">';
 ?>
<?php if($update)
/*	{
		echo '<input type="button" value="'.$LDCancel.'" onClick="location.replace(\'';
		if($from=="such") echo 'aufnahme_daten_such.php?sid='.$sid.'&lang='.$lang;
			else echo 'aufnahme_list.php?sid='.$sid.'&newdata=1&lang='.$lang;
		echo '\')"> ';

	}*/
?>
</form>

<?php if (!($newdata)) : ?>

<form action=<?php echo $thisfile; ?> method=post>
<input type="hidden" name=sid value=<?php echo $sid; ?>>
<input type="hidden" name=patnum value="">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type=submit value="<?php echo $LDNewForm ?>">
</form>
<?php endif; ?>
<p>

<?php
}  // end of if !isset($pid...
?>
</ul>

</FONT>
<p>
</td>
</tr>
</table>
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_daten_such.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_list.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<?php  /* If defined, create the mascot */

if(defined('MASCOT_SHOW') && MASCOT_SHOW==1)
{
?>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#" ><?php echo $LDCatPls ?><br>
<?php
}
?>

<p>

<!--<a href="
<?php
	/*
	if($_COOKIE['ck_login_logged'.$sid]) echo 'patient.php';
	else echo 'patient.php';
	echo URL_APPEND;
	*/
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>

<p>
-->
</ul>
<hr>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
