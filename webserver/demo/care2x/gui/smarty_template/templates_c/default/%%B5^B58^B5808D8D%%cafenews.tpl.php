<?php /* Smarty version 2.6.22, created on 2010-06-09 12:39:09
         compiled from cafeteria/cafenews.tpl */ ?>

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
		<td VALIGN="top" width="100%" colspan="3">
			<a href="javascript:editcafe()"><?php echo $this->_tpl_vars['sBasketImg']; ?>
</a> <FONT  SIZE=8 COLOR="#cc6600"><?php echo $this->_tpl_vars['sTitle']; ?>
</FONT>
		</td>
	</tr>

	<tr>
		<td VALIGN="top" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['sCafeNewsIncludeFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<p>
			<?php echo $this->_tpl_vars['sBackLink']; ?>

			</p>
		</td>

		<!--      Vertical spacer column      -->
		<td   width=1  background="../../gui/img/common/biju/vert_reuna_20b.gif">&nbsp;</td>

		<td VALIGN="top">

			<table cellspacing=0 cellpadding=1 border=0 align=right width=100%>
				<tr>
					<td>
						<table  cellspacing=1 cellpadding=2 align=right width=100% class="frame">
							<tr>
								<td align=center colspan=2 class="submenu3_titlebar">
									<b><?php echo $this->_tpl_vars['LDMenuToday']; ?>
</b>
								</td>
							</tr>
							<tr>
								<td class="submenu3_body">
									<nobr><?php echo $this->_tpl_vars['sTodaysMenu']; ?>
</nobr>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr >
					<td>
						<p><br>
						<?php echo $this->_tpl_vars['sAskIcon']; ?>
 <nobr><?php echo $this->_tpl_vars['sMenuAllLink']; ?>
</nobr><br><br>
						<?php echo $this->_tpl_vars['sAskIcon']; ?>
 <nobr><?php echo $this->_tpl_vars['sPricesLink']; ?>
</nobr>
						<hr>
						<nobr><?php echo $this->_tpl_vars['sCafeEditorialLink']; ?>
</nobr>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>