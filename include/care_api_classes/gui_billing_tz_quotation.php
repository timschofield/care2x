<?php $billing_tz->Display_Header($LDNewQuotation,$enc_obj->ShowPID($bat_nr),''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="javascript:setBallon('BallonTip','','');" >

<?php $billing_tz->Display_Headline($LDCreatenewquotation,'','','billing_create_2.php','Billing :: Create Quotation'); ?>

<?php if(!isset($mode)) $mode=''; ?>

	<tr>
		<td>
			<center><?php echo $message; ?></center>
			<table width="80%" border="0" align="center" cellspacing=0  class="table_content">
              			<tr>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter_prescription.prescribe_date&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDDate; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter_prescription.encounter_nr&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDAdmissionNr; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDPID; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.selian_pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDHospitalfileNR; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.name_first&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDPatientName; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.date_birth&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDBirth; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=anzahl&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><strong><u><?php echo $LDCount; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><strong><?php echo $LDOK; ?></strong></div></td>
				</tr>
					<?php $bill_obj->ShowNewQuotations($in_outpatient,$sid);

					?>
			</table>
		</td>
	</tr>
</table>

<?php $billing_tz->Display_Footer($LDCreatenewquotation,'','','billing_create_2.php','Billing :: Create Quotation'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
