<?php /* Smarty version 2.6.0, created on 2009-03-03 18:52:08
         compiled from ambulatory/submenu_generic.tpl */ ?>
		<form name="dept_select" method="post" action="">
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

						<TR>
							<td colspan="3" class="submenu_title"  align=left><?php echo $this->_tpl_vars['TP_SELECT_BLOCK']; ?>
 <?php echo $this->_tpl_vars['sTitleIcon']; ?>
 <?php echo $this->_tpl_vars['LDSelectDept']; ?>
 </td>
						</tr>

						<TR>
							<td align=center><?php echo $this->_tpl_vars['sApptIcon']; ?>
</td>
							<TD class="submenu_item"><nobr><?php echo $this->_tpl_vars['TP_HREF_APPT1']; ?>
</nobr></TD>
							<TD><?php echo $this->_tpl_vars['LDAppointmentsTxt']; ?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $this->_tpl_vars['sOutPatientIcon']; ?>
</td>
							<TD class="submenu_item"><nobr><?php echo $this->_tpl_vars['TP_HREF_PWL1']; ?>
</nobr></TD>
							<TD><?php echo $this->_tpl_vars['LDPWListTxt']; ?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $this->_tpl_vars['sPendReqIcon']; ?>
</td>
							<TD class="submenu_item"><nobr><?php echo $this->_tpl_vars['TP_HREF_PREQ1']; ?>
</nobr></TD>
							<TD><?php echo $this->_tpl_vars['LDPendingRequestTxt']; ?>
</TD>
						</tr>
						
						<TR>
							<td align=center><?php echo $this->_tpl_vars['sNewsIcon']; ?>
</td>
							<TD class="submenu_item"><nobr><?php echo $this->_tpl_vars['TP_HREF_NEWS1']; ?>
</nobr></TD>
							<TD><?php echo $this->_tpl_vars['LDNewsTxt']; ?>
</TD>
						</tr>

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			<!--do not omit  $TP _HINPUTS , must be inside the form tags -->
			<?php echo $this->_tpl_vars['TP_HINPUTS']; ?>

			<?php echo $this->_tpl_vars['TP_HIDDENS']; ?>

		</form>