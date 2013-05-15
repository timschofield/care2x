<?php /* Smarty version 2.6.0, created on 2009-01-13 00:57:55
         compiled from registration_admission/admit_input.tpl */ ?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/admit_tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
	<tr>
      <td>
		<?php if ($this->_tpl_vars['LDPlsSelectPatientFirst']): ?>

			<table border=0>
				<tr>
					<td valign="bottom"><?php echo $this->_tpl_vars['sSearchPromptImg']; ?>
</td>
					<td class="prompt"><?php echo $this->_tpl_vars['LDPlsSelectPatientFirst']; ?>
</td>
					<td><?php echo $this->_tpl_vars['sMascotImg']; ?>
</td>
				</tr>
			</table>

			<table border=0 cellpadding=10 bgcolor="<?php echo $this->_tpl_vars['entry_border_bgcolor']; ?>
">
				<tr>
					<td><?php echo $this->_tpl_vars['sSearchMask']; ?>
</td>
				</tr>
			</table>

			<div class="prompt"><br>
				<?php echo $this->_tpl_vars['sWarnIcon']; ?>


				<?php echo $this->_tpl_vars['LDRedirectToRegistry']; ?>

			</div>

		<?php else: ?>
			<table border=0 width="650" cellspacing="0" cellpadding="0">
				<tr>
					<td valign="bottom">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/admit_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 					</td>
				</tr>
			</table>
		<?php endif; ?>

	  </td>
    </tr>
    <tr>
      <td>
	  	&nbsp;
		<p>
		<?php echo $this->_tpl_vars['sSearchLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sArchiveLink']; ?>

		<p>
		<?php echo $this->_tpl_vars['pbCancel']; ?>

	</td>
    </tr>
  </tbody>
</table>