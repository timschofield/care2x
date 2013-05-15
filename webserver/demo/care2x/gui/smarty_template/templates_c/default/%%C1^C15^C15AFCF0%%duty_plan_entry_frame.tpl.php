<?php /* Smarty version 2.6.22, created on 2010-10-07 13:49:08
         compiled from common/duty_plan_entry_frame.tpl */ ?>

<form name="dienstplan" <?php echo $this->_tpl_vars['sFormAction']; ?>
 method="post">

<ul>

<font size=4>
<?php echo $this->_tpl_vars['LDMonth']; ?>
 <?php echo $this->_tpl_vars['sMonthSelect']; ?>
 &nbsp; <?php echo $this->_tpl_vars['LDYear']; ?>
 <?php echo $this->_tpl_vars['sYearSelect']; ?>

</font>

<table border="0">
  <tbody>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2"><?php echo $this->_tpl_vars['LDStandbyPerson']; ?>
</td>
			 <td colspan="2"><?php echo $this->_tpl_vars['LDOnCall']; ?>
</td>
          </tr>
		  
		  <?php echo $this->_tpl_vars['sDutyRows']; ?>


        </tbody>
        </table>

	  </td>
      <td valign="top">
        <?php echo $this->_tpl_vars['sSave']; ?>

		<p>
		<?php echo $this->_tpl_vars['sClose']; ?>

      </td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $this->_tpl_vars['sSave']; ?>
&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sClose']; ?>
</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>

<?php echo $this->_tpl_vars['sHiddenInputs']; ?>


</form>