<?php $billing_tz->Display_Header($LDBilling,'',''); ?>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<script language="JavaScript">
<!--
function open_drug_services() {
	urlholder="<?php echo $root_path;?>/modules/pharmacy_tz/pharmacy_tz_pending_prescriptions.php<?php echo URL_APPEND; ?>&target=search&task=newprescription&back_path=billing";
	patientwin=window.open(urlholder,"Ziel","width=750,height=550,status=yes,menubar=no,resizable=yes,scrollbars=yes");
	patientwin.moveTo(0,0);
	patientwin.resizeTo(screen.availWidth,screen.availHeight);
}
function open_lab_request(){
	urlholder="<?php echo $root_path;?>modules/laboratory/labor_test_request_pass.php?<?php echo URL_APPEND; ?>&target=chemlabor&user_origin=bill";
	patientwin=window.open(urlholder,"Ziel","width=750,height=550,status=yes,menubar=no,resizable=yes,scrollbars=yes");
	patientwin.moveTo(0,0);
	patientwin.resizeTo(screen.availWidth,screen.availHeight);
}
// -->
</script>
<?php $billing_tz->Display_Headline($LDBilling,'','','billing_overview.php','Billing :: Main Menu'); ?>

 
			<TABLE cellSpacing=0 width=600 class="submenu_frame" cellpadding="0" valign="middle">
			<TBODY valign="middle">
			<TR valign="middle">
				<TD valign="middle">
					<TABLE cellSpacing=1 cellPadding=3 width=600 valign="middle">
                    <TBODY class="submenu" valign="middle">
                      <TR valign="middle">
                        <td align=center><img src="../../gui/img/common/default/showdata.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="billing_tz_quotation.php?patient=outpatient"><?php echo "Create Outpatient Quotation"?></a></nobr></TD>
                        <TD><?php echo $LDShowPendingQuot; ?></TD>
                      </tr>
                      <TR>
                        <td align=center><img src="../../gui/img/common/default/showdata.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="billing_tz_quotation.php?patient=inpatient"><?php echo "Create Inpatient Quotation"?></a></nobr></TD>
                        <TD><?php echo $LDShowPendingQuot; ?></TD>
                      </tr>
                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>
                      <TR>
                        <td align=center><img src="../../gui/img/common/default/comments.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="billing_tz_pending.php"><?php echo $LDPendingBills?></a></nobr></TD>
                        <TD><?php echo $LDShowPendingnewBill; ?></TD>
                      </tr>

                      <TR>
                        <td height="26" align=center><img src="../../gui/img/common/default/bestell.gif" border=0 width="16" height="16"></td>
                        <TD class="submenu_item"><nobr><a href="billing_tz_archive.php?page=1"><?php echo $LDBillingArchive ?></a></nobr></TD>
                        <TD><?php echo $LDShowsArchiveBills; ?></TD>
                      </tr>

                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>
                      <!--
                      <TR>
                        <td height="26" align=center><img src="../../gui/img/common/default/prescription.gif" border=0 width="16" height="16"></td>
                        <TD class="submenu_item"><nobr><a href="<?php echo $root_path;?>modules/radiology/radiolog.php?ntid=false&lang=en">Radiology</a></nobr></TD>
                        <TD>Radiology Test Request</TD>
                      </tr>
                      -->
<!--                    <TR>
                        <td height="26" align=center><img src="../../gui/img/common/default/prescription.gif" border=0 width="16" height="16"></td>
-->                        <!--<TD class="submenu_item"><nobr><a href="<?php echo $root_path;?>modules/laboratory/labor_test_request_pass.php?<?php echo URL_APPEND; ?>&target=chemlabor&user_origin=bill">'.$LDLabTestRequest.'</a></nobr></TD> -->
<!-- 					<TD class="submenu_item"><nobr><a href="javascript:open_lab_request()"><?php echo $LDLabTestRequest ?></a></nobr></TD>
                        <TD><?php echo $LDLaborTest;?></TD>
                      </tr>
                      <TR>
                        <td height="26" align=center><img src="../../gui/img/common/default/prescription.gif" border=0 width="16" height="16"></td>
-->                      <!-- <TD class="submenu_item"><nobr><a href="<?php echo $root_path;?>/modules/pharmacy_tz/pharmacy_tz_pending_prescriptions.php<?php echo URL_APPEND; ?>&target=search&task=newprescription&back_path=billing">Drug and other services request</a></nobr></TD> -->
<!--                     <TD class="submenu_item"><nobr><a href="javascript:open_drug_services()" ><?php echo $LDDrugandService ?></a></nobr></TD>

						<TD><?php echo $LDPrescription;?></TD>
                      </tr>-->


                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>
                      <TR>
                        <td height="26" align=center><img src="../../gui/img/common/default/pdata.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="insurance_tz.php"><?php echo $LDInsuranceManagement ?></a></nobr></TD>
                        <TD><?php echo $LDAddEditRemoveIns ;?></TD>
                      </tr>
                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>

                    </TBODY>
                  </TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
		

<?php $billing_tz->Display_Footer($LDBilling,'', '','billing_create_2.php','Billing :: Create Quotation'); ?>

<?php $billing_tz->Display_Credits(); ?>
