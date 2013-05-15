<?php /* Smarty version 2.6.22, created on 2012-10-05 21:36:43
         compiled from registration_admission/basic_data_in_line.tpl */ ?>

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		<?php if ($this->_tpl_vars['is_discharged']): ?>
				<tr>
					<td bgcolor="red" colspan="3">
						&nbsp;
						<?php echo $this->_tpl_vars['sWarnIcon']; ?>

						<font color="#ffffff">
						<b>
						<?php echo $this->_tpl_vars['sDischarged']; ?>

						</b>
						</font>
					</td>
				</tr>
		<?php endif; ?>

				<tr>
					<td  <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDCaseNr']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
						<?php echo $this->_tpl_vars['sEncNrPID']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDLastName']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						<?php echo $this->_tpl_vars['name_last']; ?>
</b>
					</td>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDFirstName']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['name_first']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDBday']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['sBdayDate']; ?>
 &nbsp; <?php echo $this->_tpl_vars['sCrossImg']; ?>
 &nbsp; <font color="black"><?php echo $this->_tpl_vars['sDeathDate']; ?>
</font>
					</td>
				</tr>

		</table>