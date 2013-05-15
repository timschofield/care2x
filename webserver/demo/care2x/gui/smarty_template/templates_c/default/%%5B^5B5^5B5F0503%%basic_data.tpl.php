<?php /* Smarty version 2.6.22, created on 2012-10-18 10:08:55
         compiled from registration_admission/basic_data.tpl */ ?>

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
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['sEncNrPID']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sRowSpan']; ?>
 align="center" class="photo_id">
						<?php echo $this->_tpl_vars['img_source']; ?>

					</td>
				</tr>
				<?php if ($this->_tpl_vars['LDTitle']): ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDTitle']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['title']; ?>

					</td>
				</tr>
				<?php endif; ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDLastName']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						<?php echo $this->_tpl_vars['name_last']; ?>
</b>
					</td>
				</tr>

				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDFirstName']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['name_first']; ?>

					</td>
				</tr>

			<?php if ($this->_tpl_vars['name_2']): ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDName2']; ?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $this->_tpl_vars['name_2']; ?>

					</td>
				</tr>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['name_3']): ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDName3']; ?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $this->_tpl_vars['name_3']; ?>

					</td>
				</tr>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['name_middle']): ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDNameMid']; ?>
:
					</td>
					<td bgcolor="#ffffee">
						<?php echo $this->_tpl_vars['name_middle']; ?>

					</td>
				</tr>
			<?php endif; ?>

				<tr>
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

				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDSex']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						<?php echo $this->_tpl_vars['sSexType']; ?>

					</td>
				</tr>

			<?php if ($this->_tpl_vars['LDBloodGroup']): ?>
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDBloodGroup']; ?>
:
					</td>
					<td bgcolor="#ffffee" class="vi_data">&nbsp;
						<?php echo $this->_tpl_vars['blood_group']; ?>

					</td>
				</tr>
			<?php endif; ?>

		</table>