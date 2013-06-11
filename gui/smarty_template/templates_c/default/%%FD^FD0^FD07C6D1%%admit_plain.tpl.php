<?php /* Smarty version 2.6.22, created on 2013-06-09 16:16:04
         compiled from registration_admission/admit_plain.tpl */ ?>
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

				<?php echo $this->_tpl_vars['sMainDataBlock']; ?>


				<?php if ($this->_tpl_vars['sMainIncludeFile']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sMainIncludeFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>

			</td>
    </tr>
  </tbody>
</table>