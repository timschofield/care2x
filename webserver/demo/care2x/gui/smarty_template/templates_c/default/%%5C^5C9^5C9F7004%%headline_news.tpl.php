<?php /* Smarty version 2.6.22, created on 2010-11-08 15:16:23
         compiled from news/headline_news.tpl */ ?>

<?php if ($this->_tpl_vars['bShowPrompt']): ?>
<table>
	<tr>
		<td><?php echo $this->_tpl_vars['sMascotImg']; ?>
</td>
		<td  class="prompt">
			<?php echo $this->_tpl_vars['LDArticleSaved']; ?>

			<hr>
		</td>
	</tr>
</table>
<?php endif; ?>

<TABLE CELLSPACING=3 cellpadding=0 border="0" width="<?php echo $this->_tpl_vars['news_normal_display_width']; ?>
">

	<tr>
		<td VALIGN="top" width="100%">

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "news/headline_titleblock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sNewsBodyTemplate'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p>
			<?php echo $this->_tpl_vars['sBackLink']; ?>


		</td>

		<!--      Vertical spacer column      -->
		<TD   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</TD>

		<TD VALIGN="top">

			<?php echo $this->_tpl_vars['sSubMenuBlock']; ?>


		</TD>
	</tr>
</table>