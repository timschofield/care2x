<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<?php $insurance_tz->Display_Headline($LDEditInsuranceTypes, 'insurance_type_edit.php','Insurance types :: Edit insurance type'); ?>


				<form method="POST">
				<table border="0" cellpadding="2" cellspacing="0">
					<tr bgcolor=ffffaa>
						<td><?php $insurance_tz->ShowRedIfError($LDName,$error['name']);?>:</td>
						<td><input type="text" name="name" size=30 value="<?php echo $this_insurance['name']; ?>"></td>
					</tr>
					<tr bgcolor=ffffee>
						<td><?php $insurance_tz->ShowRedIfError($LDCeiling,$error['ceiling']);?>:</td>
						<td><input type="text" name="ceiling" size=30 value="<?php echo $this_insurance['ceiling']; ?>"></td>
					</tr>
					<tr bgcolor=ffffaa>
						<td><?php $insurance_tz->ShowRedIfError($LDDisable,false);?>:</td>
						<td><input type="checkbox" name="is_disabled" size=30 value="1" <?php if($this_insurance['is_disabled']>0) echo 'checked'; ?>> <?php echo $LDDisableThisPlan; ?></td>
					</tr>
					<tr bgcolor=ffffee>
						<td><?php echo $LDFinisch; ?></td>
						<td><input type="hidden" name="id" value="<?php echo $id; ?>"><input type="hidden" name="mode" value="update"><input type="submit" value="Submit"></td>
					</tr>
				</table>
				</form>
	
<?php $insurance_tz->Display_Footer($LDInsertNewInsurance, 'insurance_type_edit.php','Insurance types :: Edit insurance type'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>