<?php /* Smarty version 2.6.22, created on 2013-06-09 16:15:59
         compiled from registration_admission/admit_show.tpl */ ?>

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
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/admit_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
					<td><?php echo $this->_tpl_vars['sAdmitOptions']; ?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	<?php echo $this->_tpl_vars['sAdmitBottomControls']; ?>

		<?php echo $this->_tpl_vars['pbBottomClose']; ?>

	</td>
    </tr>

    <tr>
      <td>
	  	&nbsp;
		<br>
	  	<?php echo $this->_tpl_vars['sAdmitLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sSearchLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sArchiveLink']; ?>

	</td>
    </tr>

  </tbody>
</table>