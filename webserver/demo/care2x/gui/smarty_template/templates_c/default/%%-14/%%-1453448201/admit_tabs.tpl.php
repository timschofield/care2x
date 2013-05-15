<?php /* Smarty version 2.6.0, created on 2009-01-13 00:57:01
         compiled from registration_admission/admit_tabs.tpl */ ?>

<table width="100%" cellspacing="0" cellpadding="0">
  <tbody>
  <?php if ($this->_tpl_vars['bShowTabs']): ?>
    <tr>
      <td height=24><?php echo $this->_tpl_vars['pbNew'];  echo $this->_tpl_vars['pbSearch'];  echo $this->_tpl_vars['pbAdvSearch'];  echo $this->_tpl_vars['sHSpacer'];  echo $this->_tpl_vars['pbSwitchMode']; ?>
</td>
    </tr>
  <?php endif; ?>
    <tr>
      <td <?php echo $this->_tpl_vars['sRegDividerClass']; ?>
><img src="p.gif" border=0 width=1 height=5><?php echo $this->_tpl_vars['sSubTitle'];  echo $this->_tpl_vars['sWarnText']; ?>
</td>
    </tr>
  </tbody>
</table>