<?php /* Smarty version 2.6.22, created on 2010-01-11 11:34:22
         compiled from medocs/main.tpl */ ?>

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "medocs/tabs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>

    <tr>
      <td>

		<table width="700" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/basic_data.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</td>
			</tr>

			<tr>
				<td>
					<?php if ($this->_tpl_vars['bShowNoRecord']): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/common_norecord.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sDocsBlockIncludeFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
	  			</td>
    		</tr>
		</tbody>
		</table>

	  </td>
    </tr>

	<tr>
      <td>
			<?php echo $this->_tpl_vars['sNewLinkIcon']; ?>
 <?php echo $this->_tpl_vars['sNewRecLink']; ?>
<br>
			<?php echo $this->_tpl_vars['sPdfLinkIcon']; ?>
 <?php echo $this->_tpl_vars['sMakePdfLink']; ?>
<br>
			<?php echo $this->_tpl_vars['sListLinkIcon']; ?>
 <?php echo $this->_tpl_vars['sListRecLink']; ?>
<p>
			<?php echo $this->_tpl_vars['pbBottomClose']; ?>

	  </td>
    </tr>

  </tbody>
</table>