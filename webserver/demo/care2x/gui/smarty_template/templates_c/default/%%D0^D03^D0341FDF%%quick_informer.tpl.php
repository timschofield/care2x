<?php /* Smarty version 2.6.22, created on 2012-10-17 12:48:57
         compiled from system_admin/quick_informer.tpl */ ?>

<ul>
<FONT class="prompt"><p>
<?php echo $this->_tpl_vars['sMascotImg']; ?>
 <?php echo $this->_tpl_vars['LDDataSaved']; ?>

<p>
<?php echo $this->_tpl_vars['LDEnterInfo']; ?>

</font>
<p>

<form <?php echo $this->_tpl_vars['sFormAction']; ?>
 method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDPhonePolice']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_police_nr" size=40 maxlength=40 value="<?php echo $this->_tpl_vars['main_info_police_nr']; ?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDPhoneFire']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fire_dept_nr" size=40 maxlength=40 value="<?php echo $this->_tpl_vars['main_info_fire_dept_nr']; ?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDAmbulance']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_emgcy_nr" size=40 maxlength=40 value="<?php echo $this->_tpl_vars['main_info_emgcy_nr']; ?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDPhone']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_phone" size=40 maxlength=40 value="<?php echo $this->_tpl_vars['main_info_phone']; ?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDFax']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fax" size=40 maxlength=40 value="<?php echo $this->_tpl_vars['main_info_fax']; ?>
">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDName']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_name" size=40 maxlength=100 value="<?php echo $this->_tpl_vars['main_info_name']; ?>
">

      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDLogo']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_logo" size=40 maxlength=100 value="<?php echo $this->_tpl_vars['main_info_logo']; ?>
">

      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDAddress']; ?>
</b> </FONT></td>
	<td class="adm_input"><textarea name="main_info_address" cols=33 rows=5 wrap="physical"><?php echo $this->_tpl_vars['main_info_address']; ?>
</textarea>

      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $this->_tpl_vars['LDEmail']; ?>
</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_email" size=40 maxlength=60 value="<?php echo $this->_tpl_vars['main_info_email']; ?>
">
      </td>
	</tr>
</table>
<p>
<?php echo $this->_tpl_vars['sSave']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sCancel']; ?>

</form>