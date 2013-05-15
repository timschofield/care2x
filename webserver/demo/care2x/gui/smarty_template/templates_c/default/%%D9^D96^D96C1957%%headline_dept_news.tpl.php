<?php /* Smarty version 2.6.22, created on 2010-10-20 09:06:48
         compiled from news/headline_dept_news.tpl */ ?>

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
		<td VALIGN="top">

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "news/headline_newslist_item.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p>
			<?php echo $this->_tpl_vars['sBackLink']; ?>


		</td>
	</tr>
</table>