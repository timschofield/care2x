<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066">

<?php $insurance_tz->Display_Headline('Manage Insurance Companies', 'insurance_type_overview.php','Administrative Insurance types :: Overview'); ?>


<script language="javascript">
<!--
function saveData()
{
    document.forms["inputform"].submit();
}
function reset()
{
    document.forms["inputform"].submit();
}
-->
</script>


<form method="post" name="inputform" action="insurance_types_tz.php?mode=insert">
  
<table>
	<tr>
		<td height="20"> <?php echo $updated; ?><img src="<?php echo $root_path; ?>gui/img/common/default/common_infoicon.gif"> <b><?php echo $LDMasterFileData; ?></b></td>
	</tr>
	<tr>
		<td height=75>
			<input type="hidden" name="id" value="<?php echo $this_insurance['id']; ?>">
			<table border="2" cellpadding="2" cellspacing="0" width="550" align="center">
				<tr bgcolor=ffffaa>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDCompanyName.'',$error['name']);?></td>
					<td><input type="text" name="name" size=30 value="<?php echo $name; ?>"></td>
				</tr>
<!--				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDInsurancePreselection.'',$error['insurance']);?>:</td>
					<td><?php $insurance_tz->ShowInsuranceTypesDropDown('insurance',$insurance,''); ?></td>
				</tr>-->
				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDContractPerson.'',$error['contact']);?></td>
					<td><input type="text" name="contact" size=30 value="<?php echo $contact; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDPOBOX; ?></td>
					<td><input type="text" name="po_box" size=30 value="<?php echo $po_box; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDCity; ?></td>
					<td><input type="text" name="city" size=30 value="<?php echo $city; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDContractPhone; ?></td>
					<td><input type="text" name="phone_code" size=5 value="<?php echo $phone_code; ?>"><input type="text" name="phone_nr" size=30 value="<?php echo $phone_nr; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDContractEmail; ?></td>
					<td><input type="text" name="email" size=30 value="<?php echo $email; ?>"></td>
				</tr>
			</table>
			<table border=0 align="center">
				<tr>
					<td><input type="checkbox" name="invoice_flag" value="" <?php if($this_insurance['invoice_flag']) echo 'checked'; ?>><?php echo $LDPaybyInvoice; ?> </td>
					<td><input type="checkbox" name="credit_preselection_flag" value="" <?php if($this_insurance['credit_preselection_flag']) echo 'checked'; ?>"><?php echo $LDGetsCompanyCredit; ?> </td>
				<tr bgcolor=ffffee>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>

			</table>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
  			<input height="21" border="0"  width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>
		</td>
	</tr>
</table>
</form>	
				
<?php $insurance_tz->Display_Footer('Manage Insurance Companies', 'insurance_type_overview.php','Administrative Insurance types :: Overview'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>