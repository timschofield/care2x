<?php /* Smarty version 2.6.22, created on 2010-06-02 11:58:48
         compiled from registration_admission/report_frame.tpl */ ?>

<table border=0 cellpadding=4 cellspacing=1 width=100%>
	<tr class="adm_item">
		<td><?php echo $this->_tpl_vars['LDDate']; ?>
</td>
		<td><?php echo $this->_tpl_vars['subtitle']; ?>
</td>
		<td><?php echo $this->_tpl_vars['LDDetails']; ?>
</td>
		<td><?php echo $this->_tpl_vars['LDBy']; ?>
</td>
	<?php if ($this->_tpl_vars['parent_admit']): ?>
		<td><?php echo $this->_tpl_vars['LDEncounterNr']; ?>
</td>
	<?php endif; ?>
	</tr>

	<?php echo $this->_tpl_vars['sReportRows']; ?>


</table>