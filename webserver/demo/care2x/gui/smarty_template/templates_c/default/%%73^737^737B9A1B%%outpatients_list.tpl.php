<?php /* Smarty version 2.6.22, created on 2012-10-16 19:08:17
         compiled from ambulatory/outpatients_list.tpl */ ?>

<table cellspacing="0" width="100%">
<tbody>
	<tr>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item">Sex</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDFamilyName']; ?>
, <?php echo $this->_tpl_vars['LDName']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDBirthDate']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDPatNr']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDAdmissionDate']; ?>
</td>
		<td class="adm_item"><?php echo $this->_tpl_vars['LDInsuranceType']; ?>
</td>
		<td class="adm_item" colspan=2><?php echo $this->_tpl_vars['LDOptions']; ?>
</td>
	</tr>

	<?php echo $this->_tpl_vars['sOccListRows']; ?>


 </tbody>
</table>