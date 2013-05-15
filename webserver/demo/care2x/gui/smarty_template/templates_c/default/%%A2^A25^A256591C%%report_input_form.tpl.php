<?php /* Smarty version 2.6.22, created on 2010-11-10 21:30:17
         compiled from registration_admission/report_input_form.tpl */ ?>

<?php if ($this->_tpl_vars['bSetAsForm']): ?>
<form method="post" name="notes_form" onSubmit="return chkform(this)">
<?php endif; ?>

<table border=0 cellpadding=2 width=100%>
	<tr>
     <td><?php echo $this->_tpl_vars['LDDate']; ?>
</td>
     <td>
	 	<?php echo $this->_tpl_vars['sDateInput']; ?>
 <?php echo $this->_tpl_vars['sDateMiniCalendar']; ?>

	 </td>
   </tr>

   <tr>
     <td><?php echo $this->_tpl_vars['LDNotes']; ?>
</td>
     <td><?php echo $this->_tpl_vars['sNotesInput']; ?>
</td>
   </tr>
   <tr>
     <td><?php echo $this->_tpl_vars['LDShortNotes']; ?>
</td>
     <td><?php echo $this->_tpl_vars['sShortNotesInput']; ?>
</td>
   </tr>
   <tr>
     <td><?php echo $this->_tpl_vars['LDSendCopyTo']; ?>
</td>
     <td><?php echo $this->_tpl_vars['sSendCopyInput']; ?>
</td>
   </tr>
   <tr>
     <td><?php echo $this->_tpl_vars['LDBy']; ?>
</td>
     <td><?php echo $this->_tpl_vars['sAuthorInput']; ?>
</td>
   </tr>
 </table>

<?php if ($this->_tpl_vars['bSetAsForm']): ?>
	<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

	<?php echo $this->_tpl_vars['pbSubmit']; ?>

</form>
<?php endif; ?>