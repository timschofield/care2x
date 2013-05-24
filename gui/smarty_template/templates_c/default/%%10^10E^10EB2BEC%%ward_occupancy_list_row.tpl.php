<?php /* Smarty version 2.6.22, created on 2013-05-20 16:11:28
         compiled from nursing/ward_occupancy_list_row.tpl */ ?>

 <?php if ($this->_tpl_vars['bToggleRowClass']): ?>
	<tr class="wardlistrow1" <?php echo $this->_tpl_vars['sFlagDiag']; ?>
>
 <?php else: ?>
	<tr class="wardlistrow2" <?php echo $this->_tpl_vars['sFlagDiag2']; ?>
>
 <?php endif; ?>
		<td><?php echo $this->_tpl_vars['sMiniColorBars']; ?>
 </td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sRoom']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sBed']; ?>
 <?php echo $this->_tpl_vars['sBedIcon']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sFamilyName']; ?>
<?php echo $this->_tpl_vars['cComma']; ?>
 <?php echo $this->_tpl_vars['sName']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sBirthDate']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sPatNr']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sAdmDate']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sInsuranceType']; ?>
</td>
		<td>&nbsp;<?php echo $this->_tpl_vars['sAdmitDataIcon']; ?>
 <?php echo $this->_tpl_vars['sChartFolderIcon']; ?>
 <?php echo $this->_tpl_vars['sNotesIcon']; ?>
 <?php echo $this->_tpl_vars['sTransferIcon']; ?>
 <?php echo $this->_tpl_vars['sDischargeInfoIcon']; ?>
 <?php echo $this->_tpl_vars['sDischargeIcon']; ?>
 <?php echo $this->_tpl_vars['sNoDiag']; ?>
 </td>
		</tr>
		<tr>
		<td colspan="9" class="thinrow_vspacer"><?php echo $this->_tpl_vars['sOnePixel']; ?>
</td>
	</tr>