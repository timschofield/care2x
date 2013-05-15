<?php /* Smarty version 2.6.0, created on 2009-03-03 19:22:56
         compiled from nursing/basic_data_admit.tpl */ ?>

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

				<tr>
					<td  <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDCaseNr']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
						<?php echo $this->_tpl_vars['sEncNrPID']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sRowSpan']; ?>
 align="center" class="photo_id">
						<?php echo $this->_tpl_vars['img_source']; ?>

					</td>
				</tr>

				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDTitle']; ?>
 <?php echo $this->_tpl_vars['LDLastName']; ?>
, <?php echo $this->_tpl_vars['LDFirstName']; ?>
:
					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
						<?php echo $this->_tpl_vars['title']; ?>
 <font  class="vi_data"><?php echo $this->_tpl_vars['name_last']; ?>
, <?php echo $this->_tpl_vars['name_first']; ?>
</font>
					</td>
				</tr>

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
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
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
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
						<?php echo $this->_tpl_vars['blood_group']; ?>

					</td>
				</tr>
			<?php endif; ?>

				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDBillType']; ?>
:
					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
>
						<?php echo $this->_tpl_vars['billing_type']; ?>

					</td>
				</tr>

				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDDiagnosis']; ?>
:
					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
 colspan="2">
						<?php echo $this->_tpl_vars['referrer_diagnosis']; ?>

					</td>
				</tr>
				
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDTherapy']; ?>
:
					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
 colspan="2">
						<?php echo $this->_tpl_vars['referrer_recom_therapy']; ?>

					</td>
				</tr>
				
				<tr>
					<td <?php echo $this->_tpl_vars['sClassItem']; ?>
>
						<?php echo $this->_tpl_vars['LDSpecials']; ?>
:
					</td>
					<td <?php echo $this->_tpl_vars['sClassInput']; ?>
 colspan="2">
						<?php echo $this->_tpl_vars['referrer_notes']; ?>

					</td>
				</tr>

		</table>