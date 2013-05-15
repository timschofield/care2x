<?php $billing_tz->Display_Header($LDNewQuotation,$enc_obj->ShowPID($batch_nr),''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip','','')" >

<script language="javascript">

function toggle_tr(myelem,show,id) {
 if(show){
   document.getElementById(myelem).style.display = '';
   if(show)
   calc_article(id);
 }else{
   document.getElementById(myelem).style.display = 'none';
 }
}
</script>
<script language="javascript">

function calc_article(id)
{
	if(document.forms[0].elements['modepres_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + id].value) || isNaN(document.forms[0].elements['dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			<?php
			$result = $bill_obj->GetNewQuotation_Prescriptions($_REQUEST['encounter_nr'],'');
		 	echo 'for(var i=0;i<=3;i++){ ';
		 	while($row=$result->FetchRow())
		 	{
				echo "if(id==".$row['nr'].") { ";
				echo "if(document.forms[0].elements['insurance_' + id]) {";
 				echo "sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value * document.forms[0].elements['times_per_day_' + id].value * document.forms[0].elements['days_' + id].value; \n";
				echo "sum_total = sum - document.forms[0].elements['insurance_' + id].value; \n";
				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' x ' + document.forms[0].elements['times_per_day_' + id].value + ' x ' + document.forms[0].elements['days_' + id].value + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align=\"right\">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo '  } else {';
				echo "sum = document.forms[0].unit_price_".$row['nr'].".value * document.forms[0].elements['dosage_' + id].value * document.forms[0].elements['times_per_day_' + id].value * document.forms[0].elements['days_' + id].value; \n";
 				echo "sum_total = sum; \n";
 				echo "document.getElementById('div_' + id).innerHTML='<table width=\"100%\" border=\"0\"><tr><td>' + document.forms[0].elements['unit_price_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' x ' + document.forms[0].elements['times_per_day_' + id].value + ' x ' + document.forms[0].elements['days_' + id].value + ' = </td><td align=\"right\">' + sum + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align=\"right\"><b>' + sum_total + ' TSH</b></td></tr></table><input type=\"hidden\" name=\"pressum_' + id + '\" value=\"'+ sum_total + '\">'; \n";
		 		echo "}";
		 		echo "}";
		 	}
		 	echo "} ";
	 		?>
		}
	}
	else
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
		 	}
		 	echo "} ";
	 		?>
		}
	}
}
</script>
<?php $encoded_batch_number=$enc_obj->ShowPID($pid); ?>
<?php $billing_tz->Display_Headline($LDCreateQuotationfor, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Create Quotation'); ?>

<table width="100%" border="0" cellspacing="0" height="100%">
 	<tr valign=top>
    		<td colspan="2">
			<table width="100%" bgcolor="#ffffff" cellspacing="0" cellpadding="5" >
			   	<tr>
					<td><form method="POST" action="">
			  			<input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">

			  			<table width="700" border="0" align="center" bgcolor="#FFFF88" class="table_content">
			  				<tr>
			  					<td><font class="submenu_item"><?php echo $LDCurrentQuotation; ?></font></td>
			  					<td align="right"><?php echo $namelast.', '.$namefirst.' (PID: '.$encoded_batch_number.')'; ?></td>
			  				</tr>
						</table><br><br>
			  <?php if($countlab>0)
			  {

			  ?>
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value="<?php echo $createmode; ?>" name="createmode">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
			  <?php
				}
			  if($countpres>0)
			  {
			  ?><br>

				<table width="600" border="0" align="center" class="table_content">
					<?php

						$bill_obj->ShowNewQuotationEncounter_Prescriptions($encounter_nr,$id_array, $IS_PATIENT_INSURED);
							//additional: show Laboratory-Items
						//$bill_obj->ShowNewQuotationEncounter_Laboratory($encounter_nr, &$id_array, $IS_PATIENT_INSURED);

					?>
              				<tr>
					  <td bgcolor="#ffffdd" width="80" colspan="4">
					  <input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
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
					  			echo 'if(document.forms[0].elements[\''.$x.'\'])					  							if(!isNaN(document.forms[0].elements[\''.$x.'\'].value))					  							{					  								if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'])					  								{					  									if(document.forms[0].elements[\'modepres_'.substr(strstr($x,'_'),1).'\'][0].checked)					  									{						  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);						  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])						  									{																if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <= (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value)))							  									{							  								    	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);							  								    }else							  								    {
							  								    insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));							  								    }							  								}						  								}					  								}					  								else					  								{														if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'])														{						  									if(document.forms[0].elements[\'modelab_'.substr(strstr($x,'_'),1).'\'][0].checked)						  									{							  									totalsum = totalsum + parseInt(document.forms[0].elements[\''.$x.'\'].value);							  									if(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'])							  									{																	if(parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value) <=parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value))								  								    	insurancebalance=insurancebalance + parseInt(document.forms[0].elements[\'insurance_'.substr(strstr($x,'_'),1).'\'].value);								  								    else								  								    insurancebalance=insurancebalance + (parseInt(document.forms[0].elements[\'showprice_'.substr(strstr($x,'_'),1).'\'].value) * parseInt(document.forms[0].elements[\'dosage_'.substr(strstr($x,'_'),1).'\'].value));							  								    }							  								}						  								}													}						  						}					  			';
								$y = $x;
					  		}
					  		$x = $y;
					  			echo 'if(document.getElementById(\'modepres_'.substr(strstr($x,'_'),1).'\'))	 				  				alert(document.getElementById(\'modepres_'.substr(strstr($x,'_'),1).'\').value);				  		if(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\'))	 				  				alert(document.getElementById(\'modelab_'.substr(strstr($x,'_'),1).'\').value);';

							echo 'balance='.$insurancebudget.'-insurancebalance;';
							echo 'if(balance<0) balance = \'<font color="#FF0000">\' + balance + \'</font>\';';
					  		echo 'document.getElementById(\'totalsum\').innerHTML=\' '.$LDTotalSum.' <b>\' + totalsum + \' TSH</b>';
					  		echo '<br>Your insurance balance is: <b>'.$insurancebudget.' - \' + insurancebalance + \' = \' + balance + \' TSH</b>\';';
					  		?>
					  	}
					  	function TriggerAllItems(trigger)
					  	{
					  	var showtr;
					  	if(trigger==0) {
					  		showtr = true;
						} else {
					  		showtr = false;
					  	} // end of if(trigger==0)
						<?php
					  	$this_arraycount=0;
						while(list($x,$v) = each($objectarray))
						{
							$objectarray[$this_arraycount++] = $v;
							echo 'if(document.forms[0].elements[\'modepres_'.$v.'\']) {					document.forms[0].elements[\'modepres_'.$v.'\'][trigger].checked = true;			toggle_tr(\'tr_'.$v.'\',showtr,\''.$v.'\');	}	if(document.forms[0].elements[\'modelab_'.$v.'\']){			document.forms[0].elements[\'modelab_'.$v.'\'][trigger].checked = true;   							toggle_tr(\'tr_'.$v.'\',showtr,\''.$v.'\');	 						}';
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
								<td>
							<input type="button" value="<?php echo $LDCalculateTotalSum; ?>" onClick="javascript:sum_all();">
								</td>
								<td>
							<div id="totalsum" width="400">
								<?php echo $LDTotalSumnotcalculated; ?>
								<?php
											if($insurance_obj->is_patient_insured($pid)) {
												echo '<br>'. $namelast.', '.$namefirst.'  is insured by: '.$insurance_obj->GetName_insurance_from_pid($pid);
												echo '<br>'.$LDRemainingInsurancebudget .'<b>'.$insurancebudget.' TSH</b>';
											} else
												echo '<br>'.$LDThereisnovalidinsurance;
								?></div>
								</td>
							</tr>
							<tr>
								<td>&nbsp;
								</td>
								<td>
							<?php if(!$insurancebudget) echo 'Assign here to a insurance:'?>

							<?php echo $insurance_obj->ShowAllInsurancesForQuotatuion(); ?>
								</td>
							</tr>
							<tr>
								<td>
							<input type="reset" value="<?php echo $LDResetFields; ?>">
								</td>
								<td align="right">
							<input type="submit" value="<?php echo $LDFinished; ?>">
								</td>
							</tr>
						</table>
					</td>
					</form>
				</tr>
			</table>
		</td>
  	</tr>
</table>
<?php $encoded_batch_number=$enc_obj->ShowPID($pid); ?>
<?php $billing_tz->Display_Footer($LDCreateQuotationfor, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Create Quotation'); ?>

<?php $billing_tz->Display_Credits(); ?>
