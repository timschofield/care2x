<?php $bill_obj->Display_Header($LDNewQuotation,$enc_obj->ShowPID($batch_nr),''); ?>

<script language="JavaScript" src="<?php echo $root_path;?>js/check_insurance_form.js"></script>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip','','')" >

<script language="javascript">

function createNewContract(urlholder) {
contractwin=window.open(urlholder,"contract","width=600,height=400,status=yes,menubar=no,resizable=yes,scrollbars=yes,statusbar=yes,top=0,left=0");
contractwin.moveTo(0,0);
contractwin.resizeTo(1000,400);
}
</script>
<script language="javascript">

function toggle_tr(myelem,show,id) {
 if(show){
   document.getElementById(myelem).style.display = '';
   if(show)
   calc_article(id);
 }else{
   document.getElementById(myelem).style.display = 'none';
   sum_all();
 }
}
</script>

<script language="javascript">

function chkform(form) {

        var insurance;
	var user;
		var balance;
	var clearcheck;

        insurance = document.getElementById('insurance');
	user = document.getElementById('username');
		balance=document.getElementById('balance');
	clearcheck=document.getElementById('clear_bill');

        if (insurance.value == -2) {
                alert("Enter Insurance Company or Choose None(Cash) for Cash Payment!");
                return false;

        }
	 else

         if ((user.value == "") || (user.value == "default")) {
                alert("You are not logged in, logout and then log in again!");
                return false;


        }
		else
	if(clearcheck.checked)
	{
		if(isNaN(balance.value)) {
				alert("Enter only numbers in outstanding balance field");
				return false;
		}
		else
		if(balance.value=="") {
				alert("Enter balance amount or untick the check box");
				return false;
		}
	}

	else {

           return this.confSubmit(form);


        }
}

</script>

<script language="javascript">

function confSubmit(form) {

	if (confirm("Proceed and Process Bill?")) {
		form.submit();
		return true;
	}

else {
		alert("Bill Not Processed!");
		//document.discharge_form.reset();
		return false;
	}
}

</script>

<script language="javascript">

function calc_article(id)
{
	if(document.forms[0].elements['modepres_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + id].value) || isNaN(document.forms[0].elements['total_dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			<?php
			$result = $bill_obj->GetNewQuotation_Prescriptions($_REQUEST['encounter_nr'],'');
		 	echo 'for(var i=0;i<=3;i++){ ';
		 	if ($result)
		 	while($row=$result->FetchRow())
		 	{
				echo "if(id==".$row['nr'].") { ";
				echo "if(document.forms[0].elements['insurance_' + id]) {";
 				echo "sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['total_dosage_' + id].value; \n";
				echo "sum_total = sum - document.forms[0].elements['insurance_' + id].value; \n";
				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['total_dosage_' + id].value  + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align=\"right\">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo '  } else {';
				echo "sum = document.forms[0].unit_price_".$row['nr'].".value * document.forms[0].elements['total_dosage_' + id].value; \n";
 				echo "sum_total = sum; \n";
 				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['total_dosage_' + id].value  + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo "}";
		 		echo "}";
		 		$id_array['pressum_'.$row['nr']]=0;
		 	}
		 	echo "} ";
	 		?>
		}
	}
	else if(document.forms[0].elements['modelab_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + id].value) || isNaN(document.forms[0].elements['dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			<?php
			$result = $bill_obj->GetNewQuotation_Laboratory($_REQUEST['encounter_nr'],'');
		 	echo 'for(var i=0;i<=3;i++){ ';
		 	if ($result)
		 	while($row=$result->FetchRow())
		 	{
				echo "if(id==".$row['sub_id'].") { ";
				echo "if(document.forms[0].elements['insurance_' + id]) {";
		 		echo "sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value; \n";
				echo "sum_total = sum - document.forms[0].elements['insurance_' + id].value; \n";
				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align=\"right\">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
				echo '  } else {';
				echo "sum=document.forms[0].elements['unit_price_' + id].value * document.forms[0].elements['dosage_' + id].value; \n";
 				echo "sum_total = sum; \n";
	 			echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' +id].value + ' TSH </td><td align=\"right\"></td><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo "}";
		 		echo "}";
		 		$id_array['pressum_'.$row['sub_id']]=0;
		 	}
		 	echo "} ";
	 		?>
		}
	}
	else if(document.forms[0].elements['moderad_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + id].value) || isNaN(document.forms[0].elements['dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			<?php
			$result = $bill_obj->GetNewQuotation_Radiology($_REQUEST['encounter_nr'],'');
			echo 'for(var i=0;i<=3;i++){ ';
		 	if ($result)
			while($row=$result->FetchRow())
		 	{
				echo "if(id==".$row['batch_nr'].") { ";
				echo "if(document.forms[0].elements['insurance_' + id]) {";
		 		echo "sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value; \n";
				echo "sum_total = sum - document.forms[0].elements['insurance_' + id].value; \n";
				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align=\"right\">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
				echo '  } else {';
				echo "sum=document.forms[0].elements['unit_price_' + id].value * document.forms[0].elements['dosage_' + id].value; \n";
 				echo "sum_total = sum; \n";
	 			echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' +id].value + ' TSH </td><td align=\"right\"></td><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo "}";
		 		echo "}";
		 		$id_array['pressum_'.$row['batch_nr']]=0;
		 	}
		 	echo "} ";
	 		?>
		}
	}
	sum_all();
}
</script>
<?php $encoded_batch_number=$enc_obj->ShowPID($pid); ?>
<?php $bill_obj->Display_Headline($LDCreateQuotationfor, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Create Quotation'); ?>

<form method="POST" action="" onSubmit =" return chkform(this)">
<table width="100%" border="0" cellspacing="0" height="100%">
 	<tr valign=top>
    	<td colspan="2">
			<table width="100%" bgcolor="#ffffff" cellspacing="0" cellpadding="5" >
			   	<tr>
					<td>
			  			<input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">

			  			<table width="700" border="0" align="center" bgcolor="#FFFF88" class="table_content">
			  				<tr>
			  					<td><font class="submenu_item"><?php echo $LDCurrentQuotation; ?></font></td>
			  					<td align="right"><?php echo $namelast.', '.$namefirst.' (PID: '.$encoded_batch_number.')'; ?></td>
			  				</tr>
						</table>



			  <?php

			  if($countpres>0 OR $countlab>0 OR $countrad>0)
			  {
			  ?>

				<table width="600" border="0" align="center" class="table_content">
					<?php

						$bill_obj->ShowNewQuotationEncounter_Prescriptions($encounter_nr, $IS_PATIENT_INSURED);
							//additional: show Laboratory-Items
						$bill_obj->ShowNewQuotationEncounter_Laboratory($encounter_nr, $IS_PATIENT_INSURED);

						$bill_obj->ShowNewQuotationEncounter_Radiology($encounter_nr, $IS_PATIENT_INSURED);
					?>
              				<tr>
					  <td bgcolor="#ffffdd" width="80" colspan="4">
					  <input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value=<?php echo $createmode; ?> name="createmode">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
					  <input type="hidden" value="<?php echo $_GET['unit_price'];?>" name="unit_price">
					  <input type="hidden" value="<?php echo $_SESSION['sess_user_name'];?>" id="username" name="username">
					  </td>
					  <td bgcolor="#ffffdd" colspan="4" align="right"></td>
							</tr>
						</table>

					<?php
					}
					?>
					  <script language="javascript">

					  var objectarray = new Array();
					  	function sum_all()
					  	{
					  		var totalsum=0;
					  		var insurancebalance=0;
					  		<?php
					  		$arraycount=0;
					  		while(list($x,$v) = each($id_array))
					  		{
					  			$objectarray[$arraycount++] = substr(strstr($x,'_'),1);
					  			echo 'if(document.forms[0].elements[\''.$x.'\'])
					  				  {
					  						if(!isNaN(document.forms[0].elements[\''.$x.'\'].value))
					  						{
					  							if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'])
					  							{
					  								if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'][0].checked)
					  								{
					  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);
					  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])
					  									{
					  										if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <= (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'total_dosage_'.substr(strstr($x,'_'),1).'\'].value)))
					  										   	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);
					  										else insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'total_dosage_'.substr(strstr($x,'_'),1).'\'].value));
					  									}
					  								}
					  							}
					  							else if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'])
					  							{
					  								if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'][0].checked)
					  								{
					  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);
					  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])
					  									{
					  										if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <=parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value))
					  											insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);
					  										else insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));
					  								    }
					  								}
					  							}
					  							else if(document.forms[0].elements[\'moderad_'.substr(strstr($x,'_'),1).'\'])
					  							{
					  								if(document.forms[0].elements[\'moderad_'.substr(strstr($x,'_'),1).'\'][0].checked)
					  								{
					  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);
					  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])
					  									{
					  										if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <= (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value)))
					  										  	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);
					  										else insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));
					  		    			  			}
					  								}
					  							}
					  						}
					  					}';
									$y = $x;
					  				} //end while
					  			$x = $y;
					  			echo 'if(document.getElementById(\'modepres_'.substr(strstr($x,'_'),1).'\'))
					  				alert(document.getElementById(\'modepres_'.substr(strstr($x,'_'),1).'\').value);
					  			if(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\'))
					  				alert(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\').value);
					  			if(document.getElementById(\'moderad_'.substr(strstr($x,'_'),1).'\'))
					  				alert(document.getElementById(\'moderad_'.substr(strstr($x,'_'),1).'\').value);';
					  			echo 'balance='.$insurancebudget.'-insurancebalance;';
								echo 'if(balance<0) balance = \'<font color="#FF0000">\' + balance + \'</font>\';';
					  			echo 'document.getElementById(\'totalsum\').innerHTML=\'<td> '.$LDTotalSum.' <b>\' + totalsum + \' TSH</b></td><td> Your insurance balance will be:<br> <b>'.$insurancebudget.' - \' + insurancebalance + \' = \' + balance + \' TSH</b></td>\';';
					  			?>
					  	}
					  	function TriggerAllItems(trigger)
					  	{
					  	var showtr;
					  	if(trigger==0)
					  		showtr = true;
						else showtr = false; // end of if(trigger==0)
						<?php
					  	$this_arraycount=0;
						while(list($x,$v) = each($objectarray))
						{
							$objectarray[$this_arraycount++] = $v;
							echo 'if(document.forms[0].elements[\'modepres_'.$v.'\'])
								 {
								 	document.forms[0].elements[\'modepres_'.$v.'\'][trigger].checked = true;
								 	toggle_tr(\'tr_'.$v.'\',showtr,\''.$v.'\');
								 }
								 if(document.forms[0].elements[\'modelab_'.$v.'\'])
								 {
								 	document.forms[0].elements[\'modelab_'.$v.'\'][trigger].checked = true;
								 	toggle_tr(\'tr_'.$v.'\',showtr,\''.$v.'\');
						    	 }
						    	 if(document.forms[0].elements[\'moderad_'.$v.'\'])
						    	 {
						    	 	document.forms[0].elements[\'moderad_'.$v.'\'][trigger].checked = true;
						    	 	toggle_tr(\'tr_'.$v.'\',showtr,\''.$v.'\');
								 }';
							$y = $v;
						} // end of while(list($x,$v) = each($objectarray))
						$v = $y;
						?>
					  	} // end of function TriggerAllItems(trigger)

						</script>

						<table width="600" border="0" align="center">
							<tr>
								<td>
							<?php echo $LDMarkallitems; ?>
								</td>
								<td align="right">
							<input type="button" value="<?php echo $LDSelect; ?>" onClick="javascript:TriggerAllItems(0);">
							<input type="button" value="<?php echo $LDTodo; ?>" onClick="javascript:TriggerAllItems(1);">
							<input type="button" value="<?php echo $LDDelete; ?>" onClick="javascript:TriggerAllItems(2);">
								</td>
							</tr>

<tr>
								<td colspan="2">

						<input type="button" value ="<?php print $LDProcessAdvance; ?>" onclick="window.location.href='<?php print $root_path.'modules/billing_tz/billing_tz_advance.php'.URL_APPEND.'&batch_nr='.$pid.'&encounter_nr='.$_REQUEST['encounter_nr'].'&patient='.$patient;?>';">

								</td>
						  </tr>

						</table>

						<table width="600" border="0" align="center" id='totalsum'>

							<tr align="left">


										<?php
										echo '<td colspan=2>'.$LDTotalSumnotcalculated.'</td>';
										?>


							</tr>
						</table>
						</table>

						<table width="600" border="0" align="center">

							<tr align="left">
								<td>
								TOTAL ADVANCE
								</td>

								<td colspan="4">
									<b><?php  echo $bill_obj->GetAdvanceTotalAmount($_REQUEST['encounter_nr']); ?></b>
								</td>
							</tr>

							<tr>
								<td>
								OUTSTANDING BALANCE
								</td>

								<td>

								<script language="javascript">
								var total_sum;
								total_sum = sum_all();
								document.write(total_sum);
								</script>
								</td>
							</tr>

							<tr>

									<?php if($insurance_obj->is_patient_insured($pid)) {
												echo '<td>'. $namelast.', '.$namefirst.' is insured by: '.$insurance_obj->GetName_insurance_from_pid($pid).'</td>';
												echo '<td>'. $LDRemainingInsurancebudget .'<b>'.$insurancebudget.' TSH </b></td>';
									 } else {
									 			$_SESSION['pid']=$pid;
												if ($per_obj->Insurance($pid) !== false) {
													echo '<td>'. $LDNoValidContract.'('.$insurance_obj->GetName_insurance_from_id($insurance_obj->GetCompanyFromPID($pid)).')</td>';
													echo '<td>';
													echo '<input type="button" value="'.$LDClickCreateContract.'" onClick="javascript:createNewContract("'.$root_path.'insurance_company_tz_contracts_new.php?&pid='.$pid.'&company_id='.$insurance_obj->GetCompanyFromPID($pid).'&reference=billing_tz_quotation_create.php&session='.$sid.'")">';
													echo '</td>';
												} else { // need if !company_contract

										 			$company_id = 0;
										 			$thisfile="insurance_members_tz.php?&pid=".$pid;
													$insurance_list = $insurance_obj->ShowAllInsurancesForQuotatuion();

									echo '<td>'. $LDThereisnovalidinsurance.'</td>';

								    echo '<td> Assign bill to insurance/Company<br><p>'.$insurance_list.'</td>';

												// if ($company_id !== 0) {
												 	//echo '<td>';
													//echo '<input type="button" value="'.$LDClickCreateContract.'" onClick="javascript:create_new_contract("'.$root_path.'insurance_company_tz_contracts_new.php?&pid='.$pid.'&company_id='.$company_id.'&reference=billing_tz_quotation_create.php&session='.$sid.'");">';
												//} else {
													echo '<td>&nbsp;</td>';
												// }
												}
										}
									?>

							</tr>

							<tr>

							  <td align="left">

							<input type="button" class="billing" name="button" value="Clear Outstanding Balance"
							onClick="<?php  echo 'javascript:TriggerAllItems(0)';  ?>"  ></td>

							<td>

<table width="289"  border="0" cellspacing="1" cellpadding="4">
    <tr bgcolor="#999999">

      <td height="36" colspan="2"><div align="center">CLEAR OUTSTANDING BALANCE </div></td>
    </tr>

    <tr>
      <td align="right" bgcolor="#BED0BB" class="style3">Balance Paid:</td>
      <td bgcolor="#E2EAE1">
      <input type="text" name="balance"  id="balance">
      </td>
    </tr>

	<tr>
		<td colspan=2 align="right" bgcolor="#FFFFCC" class="style3">Yes Clear Balance and Save Bill
		<input type ="checkbox" name="clear_bill" id="clear_bill" value="1"></td>
	</tr>

    <tr align="right" valign="top" bgcolor="#E2EAE1">
      <td colspan="2">
	  <input name="cancel" class="billing" type="reset" id="cancel" value="Cancel">
	  </td>
    </tr>
  </table>

							</td>

						</tr>

							<tr>
								<td>
							<input type="reset" value="<?php echo $LDResetFields; ?>">
								</td>
								<td align="right">
							<input type="submit" name="finish" value="<?php echo $LDFinished; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</td>
			</tr>
			</table>

</form>

<?php $encoded_batch_number=$enc_obj->ShowPID($pid); ?>
<?php $bill_obj->Display_Footer($LDCreateQuotationfor, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Create Quotation'); ?>

<?php $bill_obj->Display_Credits(); ?>
