<?php /* Smarty version 2.6.0, created on 2009-03-03 19:19:01
         compiled from registration_admission/reg_show.tpl */ ?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/reg_tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td><?php echo $this->_tpl_vars['sRegForm']; ?>
</td>
					<td><?php echo $this->_tpl_vars['sRegOptions']; ?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  <?php echo $this->_tpl_vars['pbNewSearch']; ?>
 <?php echo $this->_tpl_vars['pbUpdateData']; ?>
 <?php echo $this->_tpl_vars['pbShowAdmData']; ?>
 <?php echo $this->_tpl_vars['pbAdmitInpatient']; ?>
 <?php echo $this->_tpl_vars['pbAdmitOutpatient']; ?>
 <?php echo $this->_tpl_vars['pbRegNewPerson']; ?>

	</td>
    </tr>

    <tr>
      <td>
		<?php echo $this->_tpl_vars['sSearchLink']; ?>

		<br>
		<?php echo $this->_tpl_vars['sArchiveLink']; ?>

		<p>
		<?php echo $this->_tpl_vars['pbCancel']; ?>

	</td>
    </tr>

  </tbody>
</table>