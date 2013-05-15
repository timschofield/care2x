<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
	<head><title>NOCC - Webmail</title>
		<link href="themes/<?php echo $theme ?>/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function OpenHelpWindow(theURL,winName,features)
			{
				window.open(theURL,winName,features);
			}
		</script>
	</head>
	<body dir="<?php echo $lang_dir ?>" alink="<?php echo $glob_theme->alink_color?>" bgcolor="<?php echo $glob_theme->bgcolor ?>" link="<?php echo $glob_theme->link_color ?>" text="<?php echo $glob_theme->text_color ?>" vlink="<?php echo $glob_theme->vlink_color ?>">
		<table border="0" width="100%">
			<tr>
				<td align="left" valign="middle" colspan="2">
					<img src="themes/<?php echo $theme ?>/img/logo.gif" width="153" height="47" alt="Logo" />
					<?php
					if (!empty($domain) && !empty($user))
					{ ?>
						&nbsp;&nbsp;<font class="login"><b><?php echo $user.'@'.$domain ?></b></font>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="top">
