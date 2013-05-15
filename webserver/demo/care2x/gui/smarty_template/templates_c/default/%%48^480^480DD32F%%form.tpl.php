<?php /* Smarty version 2.6.22, created on 2010-01-11 11:34:26
         compiled from medocs/form.tpl */ ?>

<?php if ($this->_tpl_vars['bSetAsForm']): ?>
	<?php echo $this->_tpl_vars['sDocsJavaScript']; ?>

	<form method="post" name="entryform" onSubmit="return chkForm(this)">
<?php endif; ?>

<table border=0 cellpadding=2 width=100%>
   <tr bgcolor='#f6f6f6'>
     <td><?php echo $this->_tpl_vars['LDExtraInfo']; ?>
<br>(<?php echo $this->_tpl_vars['LDInsurance']; ?>
)</td>
     <td>

	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
			<textarea name='aux_notes' cols=60 rows=2 wrap='physical'></textarea>
		<?php else: ?>
			<?php echo $this->_tpl_vars['sExtraInfo']; ?>

		<?php endif; ?>

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT color=red>*</font>  <?php echo $this->_tpl_vars['LDGotMedAdvice']; ?>
</td>
     <td>

	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
	 		<?php echo $this->_tpl_vars['sYesRadio']; ?>
 <?php echo $this->_tpl_vars['LDYes']; ?>

         	<?php echo $this->_tpl_vars['sNoRadio']; ?>
 <?php echo $this->_tpl_vars['LDNo']; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['sYesNo']; ?>

		<?php endif; ?>

         </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $this->_tpl_vars['LDDiagnosis']; ?>
</td>
     <td>

	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
			<textarea name='text_diagnosis' cols=60 rows=8 wrap='physical'></textarea>
		<?php else: ?>
			<?php echo $this->_tpl_vars['sDiagnosis']; ?>

		<?php endif; ?>


		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $this->_tpl_vars['LDTherapy']; ?>
</td>
		<td>
		
	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
			<textarea name='text_therapy' cols=60 rows=8 wrap='physical'></textarea>
		<?php else: ?>
			<?php echo $this->_tpl_vars['sTherapy']; ?>

		<?php endif; ?>

		</td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $this->_tpl_vars['LDDate']; ?>
</td>
     <td>
	 
	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
			 <input type='text' name='date' size=10 maxlength=10 <?php echo $this->_tpl_vars['sDateValidateJs']; ?>
>
			<?php echo $this->_tpl_vars['sDateMiniCalendar']; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['sDate']; ?>

		<?php endif; ?>

	 </td>
   </tr>
   <tr bgcolor='#f6f6f6'>
     <td><FONT  color='red'>*</font>  <?php echo $this->_tpl_vars['LDBy']; ?>
 </td>
     <td>

	 	<?php if ($this->_tpl_vars['bSetAsForm']): ?>
	 		<input type='text' name='personell_name' size=50 maxlength=60 value='<?php echo $this->_tpl_vars['TP_user_name']; ?>
' readonly>
		<?php else: ?>
			<?php echo $this->_tpl_vars['sAuthor']; ?>

		<?php endif; ?>

	 </td>
   </tr>
</table>

<?php if ($this->_tpl_vars['bSetAsForm']): ?>
	<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

	</form>
<?php endif; ?>