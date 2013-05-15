<tr bgcolor="<?php echo $glob_theme->inbox_color ?>">
	<td align="center">
		<input type="checkbox" name="<?php echo $tmp['number'] ?>" value="<?php echo $tmp['number'] ?>" />
	</td>
	<?php if (($is_Imap) || ($have_ucb_pop_server)) { ?>
	<td align="center">
		<?php echo $tmp['new'] ?>
	</td>
	<?php } ?>
	<td align="center">
		<?php echo $tmp['attach'] ?>
	</td>
	<td nowrap="nowrap" class="inbox">
		<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=aff_mail&amp;mail=<?php echo $tmp['number'] ?>&amp;sort=<?php echo $sort ?>&amp;sortdir=<?php echo $sortdir?>&amp;lang=<?php echo $lang ?>"><?php echo ($tmp['from']? $tmp['from'] : $html_att_unknown) ?></a>
	</td>
	<td class="inbox">
		<a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=aff_mail&amp;mail=<?php echo $tmp['number'] ?>&amp;sort=<?php echo $sort ?>&amp;sortdir=<?php echo $sortdir?>&amp;lang=<?php echo $lang ?>"><?php echo $tmp['subject']? $tmp['subject'] : $html_nosubject; ?></a>
	</td>
	<td class="inbox">
		<?php echo $tmp['date'] ?>
	</td>
	<td align="right" nowrap="nowrap" class="inbox">
		<?php echo $tmp['size'] ?> <?php echo $html_kb ?>
	</td>
</tr>
