<script src="../dental/JQ.js" language="javascript"></script>
<script src="../dental/dental_filling_.js" language="javascript"></script>
<script language="javascript">
<!-- Script Begin
function validateTime(m){
	var zt  = $('#time').val();
	var dt  = $('#date').val();
	var dpt = $('#to_dept_nr').val();
	var tm = 0;
	var u  = 0;

	if (dt.length<10){
		alert('Date Entered is invalid');
		$('#date').focus();
		return false;
	}else {
		if (zt.length<1) {
			alert('Wrong time entered');
			$('#time').select();
			return false;
		} else {
			var o = zt.split('');

			// validate each item in array [max=5]
			if ((o[1]==':')||(o.length==1)){
				o[1] = o[0];
				o[0] = 0;
			}

			o[0] = ((o[0]>0))?o[0]:0;
			o[1] = ((o[1]>0)||(o[1]==':'))?o[1]:0;
			o[2] = ((o[2]>0)||(o[2]==':'))?o[2]:0;
			o[3] = ((o[3]>0))?o[3]:0;
			o[4] = ((o[4]>0))?o[4]:0;

			// get first two digits
			tm = o[0]+''+o[1];

			if ((tm*1)>24) {
				alert('Wrong time entered');
				$('#time').focus();
				return false;
			} else {
				// join o[] to form valid time
				u = tm+':';
				if (o[2]!=':') u = u+''+o[2]+o[3];
				else  u = u+''+o[3]+o[4];

				$('#time').val(u); // give it a new value

				if ((m=='t')||(m=='d')){ // use only under time validations
					xtarget='special';
				    navigate('&tm='+u+'&dt='+dt+'&dpt='+dpt,'./input_show_appointment_validator.php')
			    } else return true;
		    }
		}
	}
}


function chkForm(d) {
	var r = false;

	if(d.date.value==''){
		alert("<?php echo $LDPlsEnterDate; ?>");
		d.date.focus();
		return false;
	}else if(d.time.value==''){
		alert("<?php echo $LDPlsEnterTime; ?>");
		d.time.focus();
		return false;
	}else if(d.to_dept_nr.value==''){
		alert("<?php echo $LDPlsSelectDept; ?>");
		d.to_dept_nr.focus();
		return false;
	}else if(d.to_personell_name.value==''){
		alert("<?php echo $LDPlsEnterDoctor; ?>");
		d.to_personell_name.focus();
		return false;
	}else if(d.purpose.value==''){
		alert("<?php echo $LDPlsEnterPurpose; ?>");
		d.purpose.focus();
		return false;
	}else if(d.hd.value=='1'){
		alert("There is another appointment on this date.");
		d.time.focus();
		return false;
	}else{
		r = validateTime('submit');
		if (r) return true;
		else return false;
	}
}
//  Script End -->
</script>
<?php
#
# If date was in the past, show error message
#
if($bPastDateError) echo '<font class="warnprompt">'.$LDInvalidDate.' '.$LDNoPastDate.'</font>';

?>
<form method="post" name="appt_form" onSubmit="return chkForm(this)">
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><font color="red"><b>*</b><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td><input type="text" name="date" id="date" size=10 maxlength=10  readonly="readonly"
     	  value="<?php
         if(!empty($date)&&($date!=$dbf_nodate)){
             if($error) echo $date;
					elseif($mode!='update') echo @formatDate2Local($date,$date_format);
         }
          ?>"
	 	onBlur="validateTime('d'); IsValidDate(this,'<?php echo $date_format ?>')" onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
		<a href="javascript:show_calendar('appt_form.date','<?php echo $date_format ?>')">
 		<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle',TRUE); ?>></a>
 		<font size=1>[ <?php
 		$dfbuffer="LD_".strtr($date_format,".-/","phs");
  		echo $$dfbuffer;
 		?> ] </font>
		</td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td></font><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
     <td>
     <input type="text" name="time" id="time" onblur="
     	validateTime('t');
     	" size=10 maxlength=10 value="<?php if(!empty($time)) echo convertTimeToLocal($time); ?>">

	 <div id="special" style="width:87%; float:right; font:bold 14px Tahoma; color:#FF0000;">
			<input type="hidden" id="hd" name="hd" value="0">
	 </div>

     </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><font color="red"><b>*</b><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDepartment; ?></td>
     <td>
	    <select name="to_dept_nr" id="to_dept_nr" onchange="validateTime('d');">
		<option value="">===Select a Department===</option>
	<?php
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$to_dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
				else  echo $v['name_formal'];
			echo '</option>';
		}
	?>
        </select>
	 </td>
   </tr>

   <tr bgcolor="#f6f6f6">
     <td><font color="red"><b>*</b><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo "$LDPhysician/$LDClinician"; ?></td>
     <td><select name="to_personell_name"><option>===Select a Doctor===</option>
<?php
$sql='select name_first, name_last from care_person left join care_personell on care_person.pid=care_personell.pid where care_personell.job_function_title=17';
$doctors=$db->Execute($sql);
while ($doctor_list=$doctors->FetchRow()) {
	if (($doctor_list[0].' '.$doctor_list[1])==$to_personell_name) {
		echo '<option selected value="'.$doctor_list[0].' '.$doctor_list[1].'">'.$doctor_list[0].' '.$doctor_list[1].'</option>';
	} else {
		echo '<option value="'.$doctor_list[0].' '.$doctor_list[1].'">'.$doctor_list[0].' '.$doctor_list[1].'</option>';
	}
}
?>
</select></td>
   </tr>

   <tr bgcolor="#f6f6f6">
     <td><font color="red"><b>*</b><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPurpose; ?></td>
     <td><textarea name="purpose" cols=40 rows=6 wrap="physical"><?php if(isset($purpose)) echo $purpose; ?></textarea>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDUrgency; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 		<input type="radio" name="urgency" value="0" <?php if($urgency==0) echo 'checked'; ?>><?php echo $LDNormal; ?>
			<input type="radio" name="urgency" value="3" <?php if($urgency==3) echo 'checked'; ?>><?php echo $LDPriority; ?>
	 		<input type="radio" name="urgency" value="5" <?php if($urgency==5) echo 'checked'; ?>><?php echo $LDUrgent; ?>
			<input type="radio" name="urgency" value="7" <?php if($urgency==7) echo 'checked'; ?>><?php echo $LDEmergency; ?>
     </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDRemindPatient; ?> ?</td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 		<input type="radio" name="remind" value="1"  <?php if($remind) echo 'checked'; ?>> <?php echo $LDYes; ?>	<input type="radio" name="remind" value="0"   <?php if(!$remind) echo 'checked'; ?>> <?php echo $LDNo; ?>
     </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDRemindBy; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
	 	<input type="checkbox" name="remind_email" value="1"   <?php if($remind_email) echo 'checked'; ?>><?php echo $LDEmail; ?>
	 	<input type="checkbox" name="remind_phone" value="1"  <?php if($remind_phone) echo 'checked'; ?>><?php echo $LDPhone; ?>
	 	<input type="checkbox" name="remind_mail" value="1"  <?php if($remind_mail) echo 'checked'; ?>><?php echo $LDMail; ?>
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPlannedEncType; ?></td>
     <td><FONT SIZE=-1  FACE="Arial" color="#000066">
<?php
if(is_object($encounter_classes)){
    while($result=$encounter_classes->FetchRow()) {
?>
		<input name="encounter_class_nr" type="radio"  value="<?php echo $result['class_nr']; ?>" <?php if($encounter_class_nr==$result['class_nr']) echo 'checked'; ?>>
<?php
        $LD=$result['LD_var'];
        if(isset($$LD)&&!empty($$LD)) echo $$LD; else echo $result['name'];
        echo '&nbsp;';
	}
}
?>
     </td>
   </tr>

 </table>
<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<?php
if($mode=='select'){
?>
<input type="hidden" name="nr" value="<?php echo $nr; ?>">
<?php
}
?>

<input type="hidden" name="mode" value="<?php if($mode=='select') echo 'update'; else echo 'create';?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
