<?php /* Smarty version 2.6.0, created on 2009-01-13 00:57:05
         compiled from registration_admission/admit_search_list_row.tpl */ ?>

<tr  <?php if ($this->_tpl_vars['toggle']): ?> class="wardlistrow2" <?php else: ?> class="wardlistrow1" <?php endif; ?>>
	<td>&nbsp;<?php echo $this->_tpl_vars['sCaseNr']; ?>
 <?php echo $this->_tpl_vars['sOutpatientIcon']; ?>
 <font size=1 color="red"><?php echo $this->_tpl_vars['LDAmbulant']; ?>
</font></td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sSex']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sLastName']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sFirstName']; ?>
 <?php echo $this->_tpl_vars['sCrossIcon']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sBday']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sZipCode']; ?>
</td>
	<td align="center">&nbsp;<?php echo $this->_tpl_vars['sOptions']; ?>
 <?php echo $this->_tpl_vars['sHiddenBarcode']; ?>
</td>
</tr>