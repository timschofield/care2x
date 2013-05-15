<?php /* Smarty version 2.6.22, created on 2012-10-25 19:43:43
         compiled from common/opentimes_table.tpl */ ?>

<ul>
	<table border=0 cellspacing=0 cellpadding=0>
	<tr>
		<td bgcolor=#999999>
			<table border=0 cellspacing=1 cellpadding=5>
			<tr bgcolor=#ffffff>
				<td><b><?php echo $this->_tpl_vars['LDDayTxt']; ?>
</b></font></td>
				<td><b><?php echo $this->_tpl_vars['LDOpenHrsTxt']; ?>
</b></font></td>
				<td><b><?php echo $this->_tpl_vars['LDChkHrsTxt']; ?>
</b></font></td>
			</tr>
			
						<?php echo $this->_tpl_vars['sOpenTimesRows']; ?>


			</table>
		</td>
	</tr>
	</table>

	<p>
	<?php echo $this->_tpl_vars['sBreakFile']; ?>

	<p>
</ul>