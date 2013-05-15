<?php $billing_tz->Display_Header($LDNewQuotation,$enc_obj->ShowPID($bat_nr),''); ?>
<STYLE TYPE="text/css">

	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}

</style>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="javascript:setBallon('BallonTip','','');" >

<?php $billing_tz->Display_Headline($LDCreatenewquotation,'','','billing_create_2.php','Billing :: Create Quotation'); ?>

<?php if(!isset($mode)) $mode=''; ?>
<table>
	<tr>
		<td>
			<center><?php echo $message; ?></center>
			<table width="80%" border="0" align="center" cellspacing=0  class="table_content">
              			<tr>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter_prescription.prescribe_date&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDDate; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_encounter_prescription.encounter_nr&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDAdmissionNr; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDPID; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.selian_pid&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDHospitalfileNR; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.name_first&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDPatientName; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=care_person.date_birth&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDBirth; ?></strong></u></a></div></td>
					  <td bgcolor=#ffffdd class="headline"><div align="center"><a href="billing_tz_quotation.php?patient=<?php echo $_REQUEST['patient'].'&sort=anzahl&sorttyp='; if(!$_REQUEST['sorttyp']) echo 'asc'; if($_REQUEST['sorttyp'] == 'asc') echo 'desc'; if($_REQUEST['sorttyp'] == 'desc') echo 'asc'; ?> "><u><strong><?php echo $LDCount; ?></strong></u></a></div></td>
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
