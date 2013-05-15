<?php
$arrow = ($sortdir == 0) ? 'up' : 'down';
$new_sortdir = ($sortdir == 0) ? 1 : 0;
$is_Imap = is_Imap($servr);
?>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
<tr><td bgcolor="<?php echo $glob_theme->inside_color ?>">
<form method="post" action="delete.php" name="delete_form">
<input type="hidden" name="lang" value="<?php echo $lang ?>" />

<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="<?php echo $glob_theme->inside_color ?>">
	<tr bgcolor="<?php echo $glob_theme->tr_color ?>">
		<td <?php if (($is_Imap) || ($have_ucb_pop_server)) echo 'colspan="4"'; else echo 'colspan="3"'; ?>align="left" class="titlew">
			<b><?php echo $folder ?></b>
		</td>
		<td align="right" nowrap="nowrap" class="titlew">
			<?php echo $current_date ?>
		</td>
		<td colspan="2" align="right" class="titlew" nowrap="nowrap">
			<?php echo $num_msg ?> <?php if ($num_msg == 1) {echo $html_msg;} else {echo $html_msgs;}?>
		</td>
	</tr>
	<tr bgcolor="<?php echo $glob_theme->inbox_text_color ?>">
		<td align="center" class="inbox">
			<?php echo $html_mark ?>
		</td>
		<?php if (($is_Imap) || ($have_ucb_pop_server)) { ?>
		<td align="center" class="inbox">
			<?php echo $html_new ?>
		</td>
		<?php } ?>
		<td align="center" class="inbox">
			&nbsp; <?php //echo $html_att ?>
		</td>
		<td nowrap="nowrap" align="center" class="inbox" <?php if ($sort == 2) echo 'bgcolor="'.$glob_theme->sort_color.'"' ?>>
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=2&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<img src="themes/<?php echo $theme ?>/img/<?php echo $arrow ?>.gif" border="0" width="12" height="12" alt="" /></a>
			&nbsp;
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=2&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<?php echo $html_from ?></a>
		</td>
		<td nowrap="nowrap" align="center" class="inbox" <?php if ($sort == 3) echo 'bgcolor="'.$glob_theme->sort_color.'"' ?>>
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=3&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<img src="themes/<?php echo $theme ?>/img/<?php echo $arrow ?>.gif" border="0" width="12" height="12" alt="" /></a>
			&nbsp;
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=3&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<?php echo $html_subject ?></a>
		</td>
		<td nowrap="nowrap" align="center" class="inbox" <?php if ($sort == 1) echo 'bgcolor="'.$glob_theme->sort_color.'"' ?>>
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=1&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<img src="themes/<?php echo $theme ?>/img/<?php echo $arrow ?>.gif" border="0" width="12" height="12" alt="" /></a>
			&nbsp;
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=1&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<?php echo $html_date ?></a>
		</td>
		<td nowrap="nowrap" align="right" class="inbox" <?php if ($sort == 6) echo 'bgcolor="'.$glob_theme->sort_color.'"' ?>>
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=6&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<img src="themes/<?php echo $theme ?>/img/<?php echo $arrow ?>.gif" border="0" width="12" height="12" alt="" /></a>
			&nbsp;
			<a href="<?php echo $_SERVER['PHP_SELF'] ?>?sort=6&amp;sortdir=<?php echo $new_sortdir ?>&amp;lang=<?php echo $lang ?>">
			<?php echo $html_size ?></a>
		</td>
	</tr>
