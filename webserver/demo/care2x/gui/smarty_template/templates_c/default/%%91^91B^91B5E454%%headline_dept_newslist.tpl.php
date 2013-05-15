<?php /* Smarty version 2.6.22, created on 2012-10-25 19:44:19
         compiled from news/headline_dept_newslist.tpl */ ?>

<table width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%"><?php echo $this->_tpl_vars['sNews_1']; ?>
</td>
      <td valign="top" width="50%"><?php echo $this->_tpl_vars['sNews_2']; ?>
</td>
    </tr>
    <tr>
      <td valign="top" width="50%"><?php echo $this->_tpl_vars['sNews_3']; ?>
</td>
      <td valign="top" width="50%"><?php echo $this->_tpl_vars['sNews_4']; ?>
</td>
    </tr>
    <tr>
      <td colspan="2">
		
				
		<?php if ($this->_tpl_vars['bShowArchiveList']): ?>

			<?php echo $this->_tpl_vars['subtitle']; ?>

			<table border=0 cellspacing=0 cellpadding=0>
			<tr>
			<td bgcolor=#0>
				<table border=0 cellspacing=1 cellpadding=5>
					<tr bgcolor=#ffffff>
						<td><b><?php echo $this->_tpl_vars['LDArticle']; ?>
</b></td>
						<td>&nbsp;</td>
						<td><b><?php echo $this->_tpl_vars['LDWrittenBy']; ?>
:</b></td>
						<td><b><?php echo $this->_tpl_vars['LDWrittenOn']; ?>
:</b></td>
					</tr>
					<?php echo $this->_tpl_vars['sNewsArchiveList']; ?>

				</table>
			</td>
			</tr>
			</table>

		<?php endif; ?>
		
		
	  </td>
    </tr>
    <tr>
      <td colspan="2">
		<?php echo $this->_tpl_vars['sMainEditorLink']; ?>

	  </td>
    </tr>
  </tbody>
</table>