<?php /* Smarty version 2.6.22, created on 2011-04-05 12:52:42
         compiled from laboratory/chemlab_data_results.tpl */ ?>
<table width="100%" border="0">
  <tbody>
    <tr valign="top">
      <td>
								<form method="post" <?php echo $this->_tpl_vars['sFormAction']; ?>
 onSubmit="return pruf(this)" name="datain">
					<table>
					<tbody>
						<tr>
							<td class="adm_item"><?php echo $this->_tpl_vars['LDCaseNr']; ?>
:</td>
							<td class="adm_input"><?php echo $this->_tpl_vars['sPID']; ?>
</td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $this->_tpl_vars['LDLastName']; ?>
, <?php echo $this->_tpl_vars['LDName']; ?>
, <?php echo $this->_tpl_vars['LDBday']; ?>
:</td>
							<td class="adm_input"><b><?php echo $this->_tpl_vars['sLastName']; ?>
, <?php echo $this->_tpl_vars['sName']; ?>
 <?php echo $this->_tpl_vars['sBday']; ?>
</b></td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $this->_tpl_vars['LDJobIdNr']; ?>
:</td>
							<td class="adm_input"><?php echo $this->_tpl_vars['sJobIdNr']; ?>
</td>
						</tr>
						<tr>
							<td class="adm_item"><?php echo $this->_tpl_vars['LDExamDate']; ?>
:</td>
							<td class="adm_input"><?php echo $this->_tpl_vars['sExamDate']; ?>
 <?php echo $this->_tpl_vars['sMiniCalendar']; ?>
 &nbsp;<?php echo $this->_tpl_vars['LDExamTime']; ?>
: <?php echo $this->_tpl_vars['sExamTime']; ?>
</td>
						</tr>	
					</tbody>
					</table>

					<table cellspacing=1 cellpadding=1 width="100%"  bgcolor=#ffdddd >
					<tbody>
						<tr>
							<td colspan="2" style="color: white; background-color: red; font-weight: bold;"><?php echo $this->_tpl_vars['sParamGroup']; ?>
</td>
						</tr>
						<tr>
							<td colspan="2">

																<table cellpadding=0 cellspacing=1>
								<tbody>
																		<?php echo $this->_tpl_vars['sParameters']; ?>

								</tbody>
								</table>

							</td>
						</tr>
						<tr>
							<td><?php echo $this->_tpl_vars['pbSave']; ?>
</td>
							<td align="right"><?php echo $this->_tpl_vars['pbShowReport']; ?>
 <?php echo $this->_tpl_vars['pbCancel']; ?>
</td>
						</tr>
					</tbody>
					</table>
					<?php echo $this->_tpl_vars['sSaveParamHiddenInputs']; ?>

				</form>

								<form <?php echo $this->_tpl_vars['sFormAction']; ?>
 method=post onSubmit="return chkselect(this)" name="paramselect">
					<table>
					<tbody>
						<tr>
							<td colspan="3"><b><?php echo $this->_tpl_vars['LDSelectParamGroup']; ?>
</b></td>
						</tr>
						<tr>
							<td><?php echo $this->_tpl_vars['LDParamGroup']; ?>
</td>
							<td><?php echo $this->_tpl_vars['sParamGroupSelect']; ?>
</td>
							<td><?php echo $this->_tpl_vars['sSubmitSelect']; ?>
</td>
						</tr>
					</tbody>
					</table>
					<?php echo $this->_tpl_vars['sSelectGroupHiddenInputs']; ?>

				</form>

	  </td>
      <td width="20%">
								<table class="submenu3_body">
				<tbody>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDParamNoSee']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDOnlyPair']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDHow2Save']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDWrongValueHow']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDVal2Note']; ?>
</td>
					</tr>
					<tr>
						<td><?php echo $this->_tpl_vars['sAskIcon']; ?>
</td>
						<td><?php echo $this->_tpl_vars['LDImDone']; ?>
</td>
					</tr>
				</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>