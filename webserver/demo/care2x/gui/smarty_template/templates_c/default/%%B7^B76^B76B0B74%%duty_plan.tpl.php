<?php /* Smarty version 2.6.22, created on 2012-10-16 19:09:47
         compiled from common/duty_plan.tpl */ ?>

<ul>
<table border="0" width="80%">
  <tbody>
    <tr style="font-size:18px">
      <td><?php echo $this->_tpl_vars['sPrevMonth']; ?>
</td>
      <td><?php echo $this->_tpl_vars['sThisMonth']; ?>
</td>
      <td><?php echo $this->_tpl_vars['sNextMonth']; ?>
</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo $this->_tpl_vars['LDStandbyPerson']; ?>
</td>
            <td><?php echo $this->_tpl_vars['LDOnCall']; ?>
</td>
          </tr>
		  
		  <?php echo $this->_tpl_vars['sDutyRows']; ?>


        </tbody>
        </table>

	  </td>
      <td valign="top">
        <?php echo $this->_tpl_vars['sNewPlan']; ?>

		<p>
		<?php echo $this->_tpl_vars['sCancel']; ?>

      </td>
    </tr>
    <tr>
      <td colspan="3"><?php echo $this->_tpl_vars['sNewPlan']; ?>
&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['sCancel']; ?>
</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>