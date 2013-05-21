<?php /* Smarty version 2.6.22, created on 2013-05-19 13:52:43
         compiled from registration_admission/reg_search_list_row.tpl */ ?>

<tr  <?php if ($this->_tpl_vars['toggle']): ?> class="wardlistrow2" <?php else: ?> class="wardlistrow1" <?php endif; ?>>
	<td>&nbsp;<?php echo $this->_tpl_vars['sRegistryNr']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sSex']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sLastName']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sName2']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sFirstName']; ?>
 <?php echo $this->_tpl_vars['sCrossIcon']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sBday']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sZipCode']; ?>
</td>
	<td>&nbsp;<?php echo $this->_tpl_vars['sOptions']; ?>
 <?php echo $this->_tpl_vars['sHiddenBarcode']; ?>
</td>
</tr>