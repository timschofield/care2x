<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<?php $insurance_tz->Display_Headline($LDInsertNewInsurance, 'insurance_companies_insert.php','Administrative Companies :: Insert new insurance'); ?>



				<form method="POST">
			<table border="2" cellpadding="10" cellspacing="0" width="550">
				<tr bgcolor=ffffaa border=2>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDCompanyName.'',$error['name']);?></td>
					<td><input type="text" name="name" size=30 value="<?php echo $_POST['name']; ?>"></td>
				</tr>
<!--				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDInsurancePreselection.'',$error['insurance']);?>:</td>
					<td><?php $insurance_tz->ShowInsuranceTypesDropDown('insurance',$_POST['insurance'],'WITH_EMPTY_FIRST_FIELD'); ?></td>
				</tr>-->
				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDContractPerson.'',$error['contact']);?></td>
					<td><input type="text" name="contact" size=30 value="<?php echo $_POST['contact']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDPOBOX; ?></td>
					<td><input type="text" name="po_box" size=30 value="<?php echo $_POST['po_box']; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDCity; ?></td>
					<td><input type="text" name="city" size=30 value="<?php echo $_POST['city']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDContractPhone; ?></td>
					<td><input type="text" name="phone_code" size=5 value="<?php echo $_POST['phone_code'];?>"><input type="text" name="phone_nr" size=30 value="<?php echo $_POST['phone_nr']; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDContractEmail; ?></td>
					<td><input type="text" name="email" size=30 value="<?php echo $_POST['email']; ?>"></td>
				</tr>
			</table>
			<table border="0" cellpadding="10" cellspacing="0" width="">
				<tr bgcolor=ffffee>
					<td><input type="checkbox" name="invoice_flag" value="<?php if($_POST['invoice_flag']) echo 'checked';?>"><?php echo $LDPaybyInvoice; ?></td>
					<td><input type="hidden" name="sitetarget" value="menu"><input type="hidden" name="mode" value="insert"><input type="checkbox" name="credit_preselection_flag" value="<?php if($_POST['credit_preselection_flag']) echo 'checked';?>"><?php echo $LDGetsCompanyCredit; ?></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><input type="button" onClick="document.forms[0].sitetarget.value='menu'; document.forms[0].submit();" value="<?php echo $LDCreateCompanyGoBack; ?>"></td>
					<td><input type="button" onClick="document.forms[0].sitetarget.value='contract'; document.forms[0].submit();" value="<?php echo $LDCreateCompanyInsertContract; ?>"></td>
				</tr>
			</table>
		</form>
		
<?php $insurance_tz->Display_Footer($LDInsertNewInsurance, 'insurance_companies_insert.php','Administrative Companies :: Insert new insurance'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>
