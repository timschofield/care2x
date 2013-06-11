<?php /* Smarty version 2.6.22, created on 2013-06-09 13:51:32
         compiled from common/mainframe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'common/mainframe.tpl', 4, false),)), $this); ?>

<?php echo smarty_function_config_load(array('file' => "test.conf",'section' => 'setup'), $this);?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
<?php if (! $this->_tpl_vars['bHideTitleBar']): ?>
	<tr>
		<td  valign="top" align="middle" height="35">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header_topblock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
<?php endif; ?>

	<tr>
		<td bgcolor=<?php echo $this->_tpl_vars['body_bgcolor']; ?>
 valign=top>

						<?php if ($this->_tpl_vars['sMainBlockIncludeFile'] != ""): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sMainBlockIncludeFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['sMainFrameBlockData'] != ""): ?>
				<?php echo $this->_tpl_vars['sMainFrameBlockData']; ?>

			<?php endif; ?>
			
		</td>
	</tr>

	<?php if ($this->_tpl_vars['sCopyright']): ?>
	<tr valign=top >
		<td bgcolor=<?php echo $this->_tpl_vars['bot_bgcolor']; ?>
>
			<?php if (! $this->_tpl_vars['bHideCopyright']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/copyright.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	</tbody>
 </table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>