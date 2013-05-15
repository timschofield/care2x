<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066">

<?php $insurance_tz->Display_Headline($LDInsertNewInsuranceType, 'insurance_type_insert.php','Administrative Insurance types :: Insert new insurance type'); ?>


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
					<tr bgcolor=ffffee>
						<td><?php echo $LDFinisch; ?></td>
						<td><input type="hidden" name="id" value="<?php echo $id; ?>"><input type="hidden" name="mode" value="insert"><input type="submit" value="Submit"></td>
					</tr>
				</table>
				</form>
	
<?php $insurance_tz->Display_Footer($LDInsertNewInsuranceType, 'insurance_type_insert.php','Administrative Insurance types :: Insert new insurance type');?>
		
<?php $insurance_tz->Display_Credits(); ?>