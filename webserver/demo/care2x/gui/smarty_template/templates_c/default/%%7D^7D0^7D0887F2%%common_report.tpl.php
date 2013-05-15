<?php /* Smarty version 2.6.22, created on 2012-10-18 10:08:55
         compiled from registration_admission/common_report.tpl */ ?>

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>

    <tr>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sTabsFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>

    <tr>
      <td>
			<table cellspacing="0" cellpadding="0" width=800>
			<tbody>
				<tr valign="top">
					<td>
						
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/basic_data.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
						<?php if ($this->_tpl_vars['bShowNoRecord']): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/common_norecord.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php elseif ($this->_tpl_vars['bShowEntryForm']): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/report_input_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/report_frame.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>

						<p>
						<?php echo $this->_tpl_vars['sBackIcon']; ?>
 <?php echo $this->_tpl_vars['sBackLink']; ?>
 &nbsp; <?php echo $this->_tpl_vars['sNewRecIcon']; ?>
 <?php echo $this->_tpl_vars['sNewRecLink']; ?>

					</td>
					<td><?php echo $this->_tpl_vars['sOptionsMenu']; ?>
</td>
				</tr>
			</tbody>
			</table>
	  </td>
    </tr>

	<tr>
      <td valign="top">
	  	<?php echo $this->_tpl_vars['sBottomControls']; ?>
 <?php echo $this->_tpl_vars['pbPersonData']; ?>
 <?php echo $this->_tpl_vars['pbAdmitData']; ?>
 <?php echo $this->_tpl_vars['pbMakeBarcode']; ?>
 <?php echo $this->_tpl_vars['pbMakeWristBands']; ?>
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