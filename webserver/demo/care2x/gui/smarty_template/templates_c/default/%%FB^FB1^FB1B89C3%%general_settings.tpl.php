<?php /* Smarty version 2.6.22, created on 2010-11-23 13:28:51
         compiled from system_admin/general_settings.tpl */ ?>

<ul>
<FONT class="prompt"><p>
<?php echo $this->_tpl_vars['sMascotImg']; ?>
 <?php echo $this->_tpl_vars['LDDataSaved']; ?>
 <?php echo $this->_tpl_vars['ergebnis']; ?>

<p>
<?php echo $this->_tpl_vars['LDGeneralSettingsHeading']; ?>

</font>
<p>

<br>

<form <?php echo $this->_tpl_vars['sFormAction']; ?>
 method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>

<tr>
		<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDGeneralSettingsPID']; ?>
</b> </FONT></td>
		<td><input name="identificationNr" type="radio" value="PID" <?php echo $this->_tpl_vars['checkPID']; ?>
 /></td>

</tr>
<tr>
		<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDGeneralSettingsHospFileNr']; ?>
</b>
		<td><input name="identificationNr" type="radio" value="HospFileNr" <?php echo $this->_tpl_vars['checkHospFileNr']; ?>
 /></td>
</tr>

</table>
<br>
<p>
<?php echo $this->_tpl_vars['sSave']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sCancel']; ?>

</form>