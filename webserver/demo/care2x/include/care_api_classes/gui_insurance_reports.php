<?php $insurance_tz->Display_Header($LDInsuranceReports); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<?php $insurance_tz->Display_Headline($LDInsuranceReports, 'insurance_reports_companies.php', 'Insurance Reports :: Company Overview'); ?>

												 
	<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
	<TBODY>
		<TR>
			<TD>
				<TABLE cellSpacing=1 cellPadding=3 width=600>
                		<TBODY class="submenu">
<!--
                      <TR>
                        <td align=center><img src="../../gui/img/common/default/pdata.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="insurance_reports_company.php"><i><?php echo $LDCompaniesContracts; ?></i></a></nobr></TD>
                        <TD><i><?php echo $LDShowCompaniescontractsmembers; ?></i></TD>
                      </tr>
                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>
-->
                      			<TR>
                        			<td align=center><img src="../../gui/img/common/default/pdata.gif" border=0></td>
                        			<TD class="submenu_item"><nobr><a href="insurance_report_prepaid.php"><?php echo $LDReportPrepaidAmount; ?></a></nobr></TD>
                        			<TD><?php echo $LDReportPrepaidAmountContent; ?></TD>
                      			</tr>
                      			<TR  height=1>
                        			<TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      			</TR>

                      			<TR>
                        			<td align=center><img src="../../gui/img/common/default/pdata.gif" border=0></td>
                        			<TD class="submenu_item"><nobr><a href="insurance_reports_ceiling.php"><?php echo $LDReportsCeiling; ?></a></nobr></TD>
                       				<TD><?php echo $LDReportsCeilingContent; ?></TD>
                      			</tr>
                      			<TR  height=1>
                        			<TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      			</TR>
<!--
                      <TR>
                        <td align=center><img src="../../gui/img/common/default/pdata.gif" border=0></td>
                        <TD class="submenu_item"><nobr><a href="insurance_reports_paybyinvoice.php"><?php echo $LDRepoortsInvoicedCompanies; ?></a></nobr></TD>
                        <TD><?php echo $LDRepoortsInvoicedCompaniesContent; ?></TD>
                      </tr>
                      <TR  height=1>
                        <TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
                      </TR>
-->
				
                    		</TBODY>
	                  	</TABLE>
			</TD>
		</TR>
	</TBODY>
	</TABLE>

		

<?php $insurance_tz->Display_Footer($LDInsuranceReports, 'insurance_reports_companies.php', 'Insurance Reports :: Company Overview'); ?>

<?php $insurance_tz->Display_Credits(); ?>
