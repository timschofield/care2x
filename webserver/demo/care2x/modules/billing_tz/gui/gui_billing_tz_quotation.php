<?php $bill_obj->Display_Header($LDNewQuotation,$enc_obj->ShowPID($bat_nr),''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="javascript:setBallon('BallonTip','','');">

<?php $bill_obj->Display_Headline($LDCreatenewquotation,'','','billing_create_2.php','Billing :: Create Quotation'); ?>

<?php if(!isset($mode)) $mode=''; ?>
<table width="80%">
	<tr>
		<td>
			<center><?php echo $message; ?></center>
			<table width="100%" border="0" align="center" cellspacing=0  class="table_content">
              			<tr>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter.modify_time&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDDate; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter.encounter_nr&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDAdmissionNr; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDPID; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.selian_pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDHospitalfileNR; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.name_first&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDPatientName; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.date_birth&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDBirth; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=insurance&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDBillType; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=count&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDCount; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=location&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php if ($in_outpatient=='outpatient') {echo 'Clinic/Department';} else {echo 'Ward/Station';} ?></strong></u></a></div></td>

					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDInfo; ?></strong></div></td>

					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDOK; ?></strong></div></td>
				</tr>
				<tr>
					<?php $bill_obj->ShowNewQuotations($in_outpatient,$sid); ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
					

<?php $bill_obj->Display_Footer($LDCreatenewquotation,'','','billing_create_2.php','Billing :: Create Quotation'); ?>
		
<?php $bill_obj->Display_Credits(); ?>
