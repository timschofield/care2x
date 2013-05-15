<?php /* Smarty version 2.6.22, created on 2011-02-02 20:49:03
         compiled from C:%5Cxampp%5Chtdocs%5Ccare2x_elct%5Cinstaller/templates/footer.tpl */ ?>
</table>
		<?php if ($this->_tpl_vars['FINISHED']): ?>
			<div id="install_block">
				<a href="<?php echo $this->_tpl_vars['APP_URL']; ?>
">Start using Care2x</a>
			</div>
		<?php else: ?>
			<table id="install_block">
			<tr>
								<?php if ($this->_tpl_vars['CAN_CONTINUE']): ?>
				<td align="right"><a href="<?php echo $_SERVER['PHP_SELF']; ?>
?next_step=true">Continue...</a></td>
				<?php endif; ?>
			</tr>
			</table>
		<?php endif; ?>
	</div>

	<div class="footer">
		<table width="100%" border=0 cellpadding=0 cellspacing=0>
			<tr>
				<td>
					<a href="http://www.care2x.org/">Care2x Home</a> ::
					<a href="http://www.care2x.org/wiki/">Wiki</a> ::
					<a href="http://sourceforge.net/mailarchive/forum.php?forum_id=11772">Mailing List</a> ::
					<a href="http://sourceforge.net/projects/care2002/">SF.net Project</a>
					<br>
					Copyright 2002-2006 Elpidio Latorilla
				</td>
				<td align="right" valign="bottom">
					Based on <a href="http://www.mirrormed.org">MirrorMed</a> installer
				</td>
			</tr>
		</table>
	</div>
</table>
</html>