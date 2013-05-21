<?php /* Smarty version 2.6.22, created on 2013-05-15 22:13:09
         compiled from registration_admission/reg_search_main.tpl */ ?>

<?php echo $this->_tpl_vars['sPretext']; ?>


<?php echo $this->_tpl_vars['sJSGetHelp']; ?>

<?php echo $this->_tpl_vars['LDTipsTricks']; ?>


<?php echo $this->_tpl_vars['sJSFormCheck']; ?>


<table class="reg_searchmask_border" border=0 cellpadding=10>
	<tr>
		<td>
			<table class="reg_searchmask" cellpadding="5" cellspacing="5">
			<tbody>
				<tr>
					<td>
						<form <?php echo $this->_tpl_vars['sFormParams']; ?>
>
							&nbsp;
							<br>
							<?php echo $this->_tpl_vars['searchprompt']; ?>

							<br>
														<input type="text" name="searchkey" size=40 maxlength=80>
							<p>
							<?php echo $this->_tpl_vars['sCheckBoxFirstName']; ?>
 <?php echo $this->_tpl_vars['LDIncludeFirstName']; ?>

							
														<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

						</form>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
</table>
<p>
<?php echo $this->_tpl_vars['sCancelButton']; ?>

<p>

<?php echo $this->_tpl_vars['LDSearchFound']; ?>


<?php if ($this->_tpl_vars['bShowResult']): ?>
	<p>
	<table border=0 cellpadding=2 cellspacing=1>
		
				<tr class="reg_list_titlebar">
			<td><?php echo $this->_tpl_vars['LDRegistryNr']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDSex']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDLastName']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDName2']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDFirstName']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDBday']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDZipCode']; ?>
</td>
			<td><?php echo $this->_tpl_vars['LDOptions']; ?>
</td>
		</tr>

				<?php echo $this->_tpl_vars['sResultListRows']; ?>


		<tr>
			<td colspan=6><?php echo $this->_tpl_vars['sPreviousPage']; ?>
</td>
			<td align=right><?php echo $this->_tpl_vars['sNextPage']; ?>
</td>
		</tr>
	</table>
<?php endif; ?>

<?php echo $this->_tpl_vars['sPostText']; ?>