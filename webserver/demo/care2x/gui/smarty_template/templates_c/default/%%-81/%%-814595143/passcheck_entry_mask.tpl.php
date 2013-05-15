<?php /* Smarty version 2.6.0, created on 2009-01-13 00:55:55
         compiled from main/passcheck_entry_mask.tpl */ ?>

<!--<table width=100% border=0 cellpadding="0" cellspacing="0">-->

		<?php echo $this->_tpl_vars['sTopDisplayRow']; ?>


	<tr>
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

	<tr>
		<td class="passborder" width=1%></td>
		<td class="passbody">
			<p><br>
			<center>

			<?php if ($this->_tpl_vars['bShowErrorPrompt']): ?>
				<table border=0>
					<tr>
						<td><?php echo $this->_tpl_vars['sMascotImg']; ?>
</td>
						<td align="center"><?php echo $this->_tpl_vars['sErrorMsg']; ?>
</td>
					</tr>
				</table>
			<?php endif; ?>

			<table border=0 cellpadding=0  cellspacing=0>
				<tr>
					<?php echo $this->_tpl_vars['sMascotColumn']; ?>

					<td valign=top>
						<table cellspacing=0 class="passmaskframe">
							<tr>
								<td>
									<table cellpadding=20 cellspacing=0 class="passmask">
										<tr>
											<td>

												<p>
												<FORM <?php echo $this->_tpl_vars['sPassFormParams']; ?>
>
													<div class="prompt">
														<?php echo $this->_tpl_vars['LDPwNeeded']; ?>
!<p>
													</div>
													<nobr><?php echo $this->_tpl_vars['LDUserPrompt']; ?>
:</nobr>
													<br>
													<INPUT type="text" name="userid" size="14" maxlength="25"> <?php echo $this->_tpl_vars['sDemoLoginInfo']; ?>
<p>
													<nobr><?php echo $this->_tpl_vars['LDPwPrompt']; ?>
:<br>
													<INPUT type="password" name="keyword" size="14" maxlength="25"> <?php echo $this->_tpl_vars['sDemoPasswordInfo']; ?>


																										<?php echo $this->_tpl_vars['sPassHiddenInputs']; ?>


													</nobr><p>
													<?php echo $this->_tpl_vars['sPassSubmitButton']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sCancelButton']; ?>

												</form>

											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<p><br>
			</center>

		</td>
		<td class="passborder">
			&nbsp;
			</td>
	</tr>

	<tr >
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

</table>