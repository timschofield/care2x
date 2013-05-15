<?php /* Smarty version 2.6.22, created on 2012-10-16 19:14:05
         compiled from laboratory/test_params.tpl */ ?>

<ul>
<table cellspacing=0 cellpadding=0 class="frame">
  <tbody>
    <tr>
      <td style="color:white; background-color: red; font-weight:bold;">
		&nbsp;
		<?php echo $this->_tpl_vars['sParamGroup']; ?>

	  </td>
      <td style="color:white; background-color: red; font-weight:bold;" align="right">
		&nbsp;
		<?php echo $this->_tpl_vars['sParamNew']; ?>

	  </td>
    </tr>
    <tr>
      <td colspan=2>
	     <table border="0" cellpadding=2 cellspacing=1>
			<tbody>
				<tr bgcolor="white">
					<td><?php echo $this->_tpl_vars['LDParameter']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDMsrUnit']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDMedian']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDLowerBound']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDUpperBound']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDLowerCritical']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDUpperCritical']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDLowerToxic']; ?>
</td>
					<td><?php echo $this->_tpl_vars['LDUpperToxic']; ?>
</td>
					<td>&nbsp;</td>
				</tr>
				
				<?php echo $this->_tpl_vars['sTestParamsRows']; ?>

			</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>
<?php echo $this->_tpl_vars['sShortHelp']; ?>

<form <?php echo $this->_tpl_vars['sFormAction']; ?>
 method=post onSubmit="return chkselect(this)" name="paramselect">
<table>
  <tbody>
    <tr>
      <td colspan="3" class="prompt"><?php echo $this->_tpl_vars['LDSelectParamGroup']; ?>
</td>
    </tr>
    <tr>
      <td><?php echo $this->_tpl_vars['LDParamGroup']; ?>
</td>
      <td><?php echo $this->_tpl_vars['sParamGroupSelect']; ?>
</td>
      <td>&nbsp;<?php echo $this->_tpl_vars['sSubmitSelect']; ?>
</td>
    </tr>
  </tbody>
</table>
</form>
</ul>