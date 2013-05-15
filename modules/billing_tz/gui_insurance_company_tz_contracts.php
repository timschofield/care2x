<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<?php $insurance_tz->Display_Headline($LDInsuranceCompaniesSetup,'insurance_companies_edit.php','Administrative Companies :: Setup'); ?>


<form method="post">
  
<table>
	<tr>
		<td height="20"> <?php echo $updated; ?><img src="<?php echo $root_path; ?>gui/img/common/default/common_infoicon.gif" align="absmiddle"> <b><?php echo $LDMasterFileData; ?></b></td>
	</tr>
	<tr>
		<td><?php $insurance_tz->ShowRedIfError(''.$LDHideCompany.'',$error['hide_company_flag']);?>:
		<input type="checkbox" name="hide_company_flag" value="<?php if($this_insurance['hide_company_flag']) echo 'checked'; ?>"><?php echo $LDYes; ?> </td>
	</tr>
	<tr>
		<td height=75>
			<input type="hidden" name="id" value="<?php echo $this_insurance['id']; ?>">
			<table border="2" cellpadding="2" cellspacing="0" width="550" align="center">
				<tr bgcolor=ffffaa>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDCompanyName.'',$error['name']);?></td>
					<td><input type="text" name="name" size=30 value="<?php echo $this_insurance['name']; ?>"></td>
				</tr>
<!--				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDInsurancePreselection.'',$error['insurance']);?>:</td>
					<td><?php $insurance_tz->ShowInsuranceTypesDropDown('insurance',$this_insurance['insurance'],''); ?></td>
				</tr>-->
				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDContractPerson.'',$error['contact']);?></td>
					<td><input type="text" name="contact" size=30 value="<?php echo $this_insurance['contact']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDPOBOX; ?></td>
					<td><input type="text" name="po_box" size=30 value="<?php echo $this_insurance['po_box']; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDCity; ?></td>
					<td><input type="text" name="city" size=30 value="<?php echo $this_insurance['city']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php echo $LDContractPhone; ?></td>
					<td><input type="text" name="phone_code" size=5 value="<?php echo $this_insurance['phone_code']; ?>"><input type="text" name="phone_nr" size=30 value="<?php echo $this_insurance['phone_nr']; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php echo $LDContractEmail; ?></td>
					<td><input type="text" name="email" size=30 value="<?php echo $this_insurance['email']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDPrepaid_Amount.'',$error['hide_prepaid_amount']);?>:</td>
					<td><input type="text" name="prepaid_amount" size=25 value="<?php echo $this_insurance['prepaid_amount']; ?>">&nbsp; <?php echo $LDTSH;?></td>
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
	<tr>
		<td height="30"><img src="<?php echo $root_path; ?>gui/img/common/default/documents.gif" align="absmiddle"> <b><?php echo $LDContracts; ?></b></td>
	</tr>
	<tr>
		<td bgcolor=#ffffff valign=top>
				<?php $insurance_tz->ShowContractsOfCompany($id); ?>
			<table border="0" width="788" cellpadding="0" cellspacing="0">
  				<tr>
  					<td>
  				<input type="image" src="<?php echo $root_path; ?>gui/img/control/default/en/en_update.gif" onClick="">
  				<a href="insurance_company_tz_contracts_new.php?company_id=<?php echo $id ?>">
  					<img border="0" src="<?php echo $root_path; ?>gui/img/control/default/en/en_create_new_contract.gif"></a>
  				<?php if ($SHOW_ADDMEMBER_BUTTON) { ?>
					<a href="insurance_members_tz.php?company_id=<?php echo  $id;?>">	<img border="0" src="<?php echo $root_path; ?>gui/img/control/default/en/en_members.gif"></a>
				<?php } ?>


  					</td>
  					<td align="right">
						<table border="1" cellpadding="2" cellspacing="0">
			    				<tr>
			    					<td width="83"><b><?php echo $LDColorLegend; ?></b></td><td bgcolor=#DBDBDB width="80" align="center"><?php echo $LDdeactivatedcontract; ?></td><td bgcolor=#FFBD72 width="80" align="center"><?php echo $LDActualcontract; ?></td>
			    					<td bgcolor=#ffffaa width="80" align="center"><?php echo $LDOldFutureContracts; ?></td>
			    				</tr>
			    			</table>
  					</td>
  				</tr>
  			</table>
		</td>
	</tr>
</table>
</form>	
	
<?php $insurance_tz->Display_Footer($LDInsuranceCompaniesSetup, 'insurance_companies_edit.php','Administrative Companies :: Setup'); ?>

<?php $insurance_tz->Display_Credits(); ?>