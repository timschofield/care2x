<?php /* Smarty version 2.6.22, created on 2012-10-05 21:37:10
         compiled from nursing/ward_occupancy.tpl */ ?>

<?php echo $this->_tpl_vars['sWarningPrompt']; ?>

<style type="text/css">
	.mimHover{
		border:1px solid blue; padding:2px 10px 2px 10px; font-weight:bold; text-transform:upper; background:#ccc;
	}

	.mimHover:hover{
		background:#fff;
	}
	.bold{font-weight:bold;}
</style>
<div style="width:100%; padding:3px; text-align:center; background:lime; border-bottom:5px solid white;" class="adm_item">
	<input type='button' value="Refresh Patient List" name = 'btn' class="mimHover" onclick="window.location.href='<?php echo $this->_tpl_vars['sReloadBtn']; ?>
'" >
</div>
<table cellspacing="0" cellpadding="0" width="100%">
  <tbody>
    <tr valign="top">
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "nursing/ward_occupancy_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
      <td align="right"><?php echo $this->_tpl_vars['sSubMenuBlock']; ?>
</td>
    </tr>
  </tbody>
</table>

<div style="width:100%; padding:3px; text-align:center; background:lime; border-top:5px solid white;" class="adm_item">
	<input type='button' value="Refresh Patient List" name = 'btn' class="mimHover" onclick="window.location.href='<?php echo $this->_tpl_vars['sReloadBtn']; ?>
'" >
</div>
 <p>
 <?php echo $this->_tpl_vars['pDiagnosis']; ?>

 <p>
 <?php echo $this->_tpl_vars['pLabs']; ?>

 <p>
 <?php echo $this->_tpl_vars['pPrescriptions']; ?>
 | <?php echo $this->_tpl_vars['pProcedures']; ?>
 | <?php echo $this->_tpl_vars['pConsumables']; ?>

 <p>
 <?php echo $this->_tpl_vars['pRadio']; ?>

 <p>
 <?php echo $this->_tpl_vars['pbClose']; ?>

<br>
<?php echo $this->_tpl_vars['sOpenWardMngmt']; ?>

</p>