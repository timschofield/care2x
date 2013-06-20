<?php /* Smarty version 2.6.22, created on 2013-06-17 08:12:19
         compiled from appointment/appt_list.tpl */ ?>

<table width=100% border=0 cellpadding="0" cellspacing=0>
	<tbody>
	<tr>
		<td>
			<?php echo $this->_tpl_vars['sMiniCalendar']; ?>

		</td>
		<td>

			<form name="bydept">
				<?php echo $this->_tpl_vars['LDListApptByDept']; ?>
<br>
				<nobr>
				<?php echo $this->_tpl_vars['sByDeptSelect']; ?>
 <?php echo $this->_tpl_vars['pbByDeptGo']; ?>

				</nobr>
								<?php echo $this->_tpl_vars['sByDeptHiddenInputs']; ?>

			</form>
			<br>
			<form name="bydoc">
				<?php echo $this->_tpl_vars['LDListApptByDoc']; ?>
<br>
				<nobr>
				<?php echo $this->_tpl_vars['sByDocSelect']; ?>
 <?php echo $this->_tpl_vars['pbByDocGo']; ?>

				</nobr>
								<?php echo $this->_tpl_vars['sByDocHiddenInputs']; ?>

			</form>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			<?php if ($this->_tpl_vars['bShowPrompt']): ?>
				<table>
				<tbody>
					<tr>
						<td><?php echo $this->_tpl_vars['sMascotImg']; ?>
</td>
						<td class="warnprompt"><?php echo $this->_tpl_vars['sPrompt']; ?>
</td>
					</tr>
				</tbody>
				</table>
			<?php endif; ?>
			<?php echo $this->_tpl_vars['sApptList']; ?>
<p>
			<?php echo $this->_tpl_vars['sButton']; ?>
 <?php echo $this->_tpl_vars['sNewApptLink']; ?>
<p>
			<?php echo $this->_tpl_vars['pbClose']; ?>

		</td>
	</tr>
	</tbody>
</table>