<?php
require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
echo setCharSet(); 

?>
 <TITLE></TITLE>
 

<?php 
require($root_path.'include/inc_js_barcode_wristband_popwin.php');
require('./include/js_poprecordhistorywindow.inc.php');
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?> 
</HEAD>

<BODY bgcolor="<?php echo $cfg['body_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>


<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientData.' ('.$encounter_nr.')'; ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('admission_show.php','<?php echo $from ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($_COOKIE['ck_login_logged'.$sid]) echo $root_path.'main/startframe.php?sid='.$sid.'&lang='.$lang; 
	else echo "aufnahme_pass.php?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<!-- Load tabs -->
<?php

//$target='entry';
include('./gui_bridge/default/gui_tabs_patadmit.php') 

?>

<tr>
<td colspan=3  bgcolor=<?php echo $cfg['body_bgcolor']; ?>>

<?php
/*
if(!$is_discharged){
	if(!empty($sem)){
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPatientCurrentlyAdmitted; ?></b></font></td>
<!--     <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_r.gif','0') ?>></td>
 -->  </tr>
</table>
<?php
	}
	else{
?>
	&nbsp;&nbsp;<font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPatientCurrentlyAdmitted; ?></b></font>
<?php
	}
}
*/
?>

<table border=0>
<?php
if($is_discharged){
?>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="red">&nbsp;<FONT    SIZE=2  FACE="verdana,Arial" color="#ffffff"><img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle'); ?>> 
	<b>
		<?php 
		if($current_encounter) echo $LDEncounterClosed;
			else echo $LDPatientIsDischarged; 
	?>
	</b></font></td>
    <td>&nbsp;</td>
  </tr>

<?php
}
?>

  <tr>
    <td>&nbsp;
  </td>

  <td valign="top">

	<table border=0 cellpadding=0 cellspacing=0 bgcolor="#999999">
   <tr>
	 <td>

<table border="0" cellspacing=1 cellpadding=0>
<tr bgcolor="white" >
<td valign="top" background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDCaseNr ?>:
</td>
<td bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" ><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $encounter_nr; ?></b><br>
<?php #
if(file_exists($root_path.'cache/barcodes/en_'.$encounter_nr.'.png')) echo '<img src="'.$root_path.'cache/barcodes/en_'.$encounter_nr.'.png" border=0 width=180 height=35>';
  else 
  {

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$encounter_nr."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";

    echo "<img src='".$root_path."classes/barcode/image.php?code=".$encounter_nr."&style=68&type=I25&width=180&height=40&xres=2&font=5' border=0>";
  }
?>
</td>
<td rowspan=7 align="center"><img <?php echo $img_source; ?> hspace=5>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAdmitDate ?>: 
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php    echo formatDate2Local($encounter_date,$date_format); ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAdmitTime ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php    echo formatDate2Local($encounter_date,$date_format,1,1); ?></td>
</tr>

<tr bgcolor="white">
<td colspan=2><FONT SIZE=-1  FACE="Arial">&nbsp;
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDTitle ?>:
</td>
<td bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $title ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDLastName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $name_last; ?></b>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDFirstName ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000">&nbsp;<b><?php echo $name_first; ?></b>
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00'&&$death_date!='0001-01-01') echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>';
?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDBday ?>:
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial" color="#800000"><FONT SIZE=-1  FACE="Arial">&nbsp;<b><?php echo formatDate2Local($date_birth,$date_format);?></b>
<?php
# If person is dead show a black cross
if($death_date&&$death_date!='0000-00-00'&&$death_date!='0001-01-01'){
	echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>&nbsp;<font color="#000000">'.formatDate2Local($death_date,$date_format).'</font>';
}
?>
</td>
<td bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDSex ?>: <?php if($sex=='m') echo $LDMale; elseif($sex=='f') echo $LDFemale; ?>
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

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAddress ?>:
</td>
<td bgcolor="#eeeeee" colspan=2><FONT SIZE=-1  FACE="Arial">
<?php 

/* Note: The address is displayed in german format. */

echo $addr_str.' '.$addr_str_nr.'<br>';
echo $addr_zip.' '.$addr_citytown_name.'<br>';
/*
if ($addr_province) echo $addr_province.'<br>';
if ($addr_region) echo $addr_region.'<br>';
if ($addr_country) echo $addr_country.'<br>';
*/
?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAdmitClass ?>:
</td>
<?php 
# Suggested by Dr. Sarat Nayak to emphasize the OUTPATIENT encounter type
if (isset($$encounter_class['LD_var'])&&!empty($$encounter_class['LD_var'])){
	$eclass=$$encounter_class['LD_var'];
	$fcolor='red';
}else{
	$eclass= $encounter_class['name'];
} 

if($encounter_class_nr==1){
	$fcolor='#000000';
}else{
	$fcolor='red';
	$eclass='<b>'.strtoupper($eclass).'</b>';
}
?>
<td colspan=2   bgcolor="#eeeeee">
<FONT SIZE=-1  FACE="Arial" color="<?php echo $fcolor ?>">&nbsp;<?php echo $eclass ?>
</td>
</tr>

<?php
if($encounter_class_nr==1){
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDWard ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;
<?php	
/*	if($in_ward){
		echo '<a href="'.$root_path.'modules/nursing/'.strtr('nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$current_ward_name.'&location_id='.$current_ward_name.'&ward_nr='.$current_ward_nr,' ',' ').'">'.$current_ward_name.'</a>';
	}else{
		echo $current_ward_name;
	}	
*/	
	echo '<a href="'.$root_path.'modules/nursing/'.strtr('nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$current_ward_name.'&location_id='.$current_ward_name.'&ward_nr='.$current_ward_nr,' ',' ').'">'.$current_ward_name.'</a>';
 ?>
</td>
</tr>
<?php
}elseif($encounter_class_nr==2){
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo "$LDClinic/$LDDepartment" ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php	
/*	if($in_dept){
		echo '<a href="'.$root_path.'modules/ambulatory/'.strtr('amb_clinic_patients_pass.php'.URL_APPEND.'&rt=pflege&edit=1&dept='.$$current_dept_LDvar.'&location_id='.$$current_dept_LDvar.'&dept_nr='.$current_dept_nr,' ',' ').'">'.$$current_dept_LDvar.'</a>';
	}else{
		echo $$current_dept_LDvar;
	}
*/echo '<a href="'.$root_path.'modules/ambulatory/'.strtr('amb_clinic_patients_pass.php'.URL_APPEND.'&rt=pflege&edit=1&dept='.$$current_dept_LDvar.'&location_id='.$$current_dept_LDvar.'&dept_nr='.$current_dept_nr,' ',' ').'">'.$current_dept_name.'</a>';
?>
</td>
</tr>
<?php
}
?>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDDiagnosis ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $referrer_diagnosis; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDRecBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $referrer_dr; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDTherapy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $referrer_recom_therapy; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDSpecials ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $referrer_notes; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDBillType ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php 
if (isset($$insurance_class['LD_var'])&&!empty($$insurance_class['LD_var'])) echo $$insurance_class['LD_var']; 
    else echo  $insurance_class['name']; 
?></td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDInsuranceNr ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $insurance_nr; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDInsuranceCo ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $insurance_firm_name; ?>
</td>
</tr>
<!-- 
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDInsuranceNr_2 ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $insurance_2_nr; ?>
</td>
</tr>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDInsuranceCo_2 ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $insurance_2_co_id; ?>
</td>
</tr> -->

<?php
/*if(!$GLOBAL_CONFIG['patient_guarantor_hide'])
{
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDGuarantor ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<?php echo $guarantor_pid ?>
</td>
</tr>
<?php
}*/
?>

<?php
if(!$GLOBAL_CONFIG['patient_service_care_hide'])
{
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDCareServiceClass ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<?php
while($buffer=$care_service->FetchRow())
{
	if($sc_care_class_nr==$buffer['class_nr']){
		if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	}
}
if($sc_care_start&&$sc_care_start!='0000-00-00') echo ' [ '.formatDate2Local($sc_care_start,$date_format).' ] '.$LDTo.' [ '.formatDate2Local($sc_care_end,$date_format).' ]';
?>
</td>
</tr>
<?php
}
?>

<?php
if(!$GLOBAL_CONFIG['patient_service_room_hide'])
{
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDRoomServiceClass ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<?php
while($buffer=$room_service->FetchRow())
{
	if($sc_room_class_nr==$buffer['class_nr']){
		if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	}
}
if($sc_room_start&&$sc_room_start!='0000-00-00') echo ' [ '.formatDate2Local($sc_room_start,$date_format).' ] '.$LDTo.' [ '.formatDate2Local($sc_room_end,$date_format).' ]';
?>
</td>
</tr>
<?php
}
?>

<?php
if(!$GLOBAL_CONFIG['patient_service_att_dr_hide'])
{
?>
<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAttDrServiceClass ?>:
</td>
<td colspan=2><FONT SIZE=-1  FACE="Arial">
<?php
while($buffer=$att_dr_service->FetchRow())
{
	if($sc_att_dr_class_nr==$buffer['class_nr']){
		if(empty($$buffer['LD_var'])) echo $buffer['name']; else echo $$buffer['LD_var'];
	}
}
if($sc_att_dr_start&&$sc_att_dr_start!='0000-00-00') echo ' [ '.formatDate2Local($sc_att_dr_start,$date_format).' ] '.$LDTo.' [ '.formatDate2Local($sc_att_dr_end,$date_format).' ]';
?> 
</td>
</tr>
<?php
}
?>

<tr bgcolor="white">
<td background="<?php echo createBgSkin($root_path,'tableHeaderbg3.gif'); ?>"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php echo $LDAdmitBy ?>:
</td>
<td colspan=2 bgcolor="#eeeeee"><FONT SIZE=-1  FACE="Arial">&nbsp;<?php if ($encoder!='') echo $encoder ; else echo $_COOKIE[$local_user.$sid] ?> 
</td>
</tr>
</table>
	 
	 </td>
   </tr>
 </table>

	</td>
    <td valign="top">
	<?php 
	    require('./gui_bridge/default/gui_patient_encounter_showdata_options.php');
	?>
	</td>
  </tr>
</table>



<p>
<?php 	if(!$is_discharged) include('./include/bottom_controls_admission.inc.php'); ?>
<!-- <a href="<?php echo $updatefile.URL_APPEND.'&encounter_nr='.$encounter_nr.'&update=1'; ?>"><img <?php echo createLDImgSrc($root_path,'update_data.gif','0','top') ?>></a>
<a href="javascript:makeBarcodeLabel('<?php echo $encounter_nr  ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_label.gif','0','top') ?>></a>
<a href="javascript:makeWristBands('<?php echo $encounter_nr ?>')"><img <?php echo createLDImgSrc($root_path,'barcode_wristband.gif','0','top') ?>></a>
 -->
 <a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

<p>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_start.php<?php echo URL_APPEND; ?>&mode=?"><?php echo $LDAdmWantEntry ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_daten_such.php<?php echo URL_APPEND; ?>"><?php echo $LDAdmWantSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="aufnahme_list.php<?php echo URL_APPEND; ?>&newdata=1"><?php echo $LDAdmWantArchive ?></a><br>

<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
