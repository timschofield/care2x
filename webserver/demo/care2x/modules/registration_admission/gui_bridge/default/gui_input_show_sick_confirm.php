<?php
if(!$is_discharged){
?>

<script language="javascript">
<!-- Script Begin
function chkSickForm(f) {
	v=document.newform.dept_nr.value;
	if(v==""){
		alert("<?php echo $LDPlsSelectDept; ?>");
		return false;
	}else if(f.date_end.value==""){
		alert("<?php echo $LDPlsEnterEndDate; ?>");
		f.date_end.focus();
		return false;
	}else if(f.date_start.value==""){
		alert("<?php echo $LDPlsEnterStartDate; ?>");
		f.date_start.focus();
		return false;
	}else if(f.date_confirm.value==""){
		alert("<?php echo $LDPlsEnterConfirmDate; ?>");
		f.date_confirm.focus();
		return false;
	}else if(f.diagnosis.value==""){
		alert("<?php echo $LDPlsEnterDiagnosis; ?>");
		f.diagnosis.focus();
		return false;
	}else{
		f.dept_nr.value=v;
		return true;
	}
}
function chkNewForm(v) {
	if(v==""||v=="<?php echo $dept_nr; ?>"){
		return false;
	}else{
		return true;
	}
}
//  Script End -->
</script>

<form name="sickform" onSubmit="return chkSickForm(this)" method="post">
<?php 
# Prepare some values for the template
$TP_insco_1='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$TP_insco_2='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$TP_insco_3='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$TP_insco_4='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$TP_insco_5='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$TP_insco_6='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

if($insurance){
	$TP_enc_insurance_name=$insurance['name']; 
	$TP_enc_insurance_nr=$insurance['insurance_nr']; 
	$TP_enc_insurance_subarea=$insurance['sub_area']; 
}

$TP_date_birth=formatDate2Local($date_birth,$date_format);
$TP_dept_sigstamp=nl2br($dept_sigstamp); 
$TP_care_logo=createLogo($root_path,'care_logo.gif','0','right');

$date_checker='onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')"';

$TP_date_end='<input type="text" name="date_end" size=10 maxlength=10 '.$date_checker.'>';
$TP_href_des='<a href="javascript:show_calendar(\'sickform.date_end\',\''.$date_format.'\')">';
$TP_date_start='<input type="text" name="date_start" size=10 maxlength=10 '.$date_checker.'>';
$TP_href_dss='<a href="javascript:show_calendar(\'sickform.date_start\',\''.$date_format.'\')">';
$TP_date_confirm='<input type="text" name="date_confirm" size=10 maxlength=10 '.$date_checker.'>';
$TP_href_dcs='<a href="javascript:show_calendar(\'sickform.date_confirm\',\''.$date_format.'\')">';
$TP_href_end='</a>';


$TP_img_calendar='<img '.createComIcon($root_path,'show-calendar.gif','0','absmiddle',TRUE).'>';

$dfbuffer="LD_".strtr($date_format,".-/","phs");
$TP_date_format=$$dfbuffer;


$TP_diagnosis='<textarea name="diagnosis" cols=40 rows=5 wrap="physical"></textarea>';

# Signature stamp of the department
$TP_dept_sigstamp=nl2br($dept['sig_stamp']); 

# Logo of the department
$logobuff=$root_path.'gui/img/logos_dept/dept_'.$dept_nr.'.'.$dept['logo_mime_type'];
if(file_exists($logobuff)){
	$TP_dept_logo=$logobuff; 
	# Check the logo dimensions
	$logosize=GetImageSize($logobuff);
	# If height > $logo_ht_limit, use limit
	if($logosize[1]>$logo_ht_limit) $TP_height='height='.$logo_ht_limit;
		else $TP_height='height='.$logosize[1];
}else{
	$TP_dept_logo=$root_path.'gui/img/common/default/pixel.gif'; # Else output a transparent pixel
}


# Get the address of the hospital from the global config table
$glob_obj->getConfig('main_info_address');
$TP_main_address=nl2br($GLOBAL_CONFIG['main_info_address']);

# Load the template
$TP_sickform=&$TP_obj->load('registration_admission/tp_show_sick_confirm.htm');
# Output template
eval("echo $TP_sickform;");
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
</form>
<p>

<form method="post" name="newform" onSubmit="return chkNewForm(this.dept_nr.value)">
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>> 
<?php echo $LDCreateNewForm; ?>
<select name="dept_nr">
	<option value=""></option>
	<?php
		while(list($x,$v)=each($dept_med)){
			echo '<option value="'.$v['nr'].'" ';
			if($v['nr']==$dept_nr) echo 'selected';
			echo '>';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>
			';
		}
	?></select>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<input type="hidden" name="mode" value="new">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<!-- <input type="submit" <?php echo createLDImgSrc($root_path,'ok.gif','0','absmiddle'); ?> >            
 -->
<input type="submit"  value="<?php echo $LDGo ?>"> 
</form>
<?php
}else{
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b>
	<?php 
		echo $norecordyet;
	?></b></font>
	</td>
  </tr>
</table>
<?php
}
?>
