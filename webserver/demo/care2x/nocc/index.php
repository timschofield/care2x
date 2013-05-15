<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/index.php,v 1.1 2006/01/13 13:42:51 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

require ('conf.php');
require ('check_lang.php');
session_start();
session_destroy();
Header("Content-type: text/html; Charset=$charset");

if (floor(phpversion()) != 4)
{
	echo '<font color="red"><b>You don\'t seem to be running PHP 4, you need at least PHP 4 to run NOCC.</b></font><br /><br /><div align="center"><img src="themes/standard/img/button.png" width="88" height="31" alt="Powered by NOCC" /></div>';
	exit;
}
if (!extension_loaded('imap'))
{
	echo '<font color="red"><b>The IMAP module does not seem to be installed on this PHP setup, please see NOCC\'s documentation.</b></font><br /><br /><div align="center"><img src="themes/standard/img/button.png" width="88" height="31" alt="Powered by NOCC" /></div>';
	exit;
}
if (empty($tmpdir))
{
	echo '<font color="red"><b>"$tmpdir" is not set in "conf.php". NOCC cannot run.</b></font><br /><br /><div align="center"><img src="themes/standard/img/button.png" width="88" height="31" alt="Powered by NOCC" /></div>';
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>NOCC - Webmail</title>
<link href="themes/<?php echo $theme ?>/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function updatePort () 
{
	if (document.nocc_webmail_login.servtype.options[document.nocc_webmail_login.servtype.selectedIndex].value == 'imap') 
	{
		document.nocc_webmail_login.port.value = 143;
	}
	else if (document.nocc_webmail_login.servtype.options[document.nocc_webmail_login.servtype.selectedIndex].value == 'pop3')
	{
		document.nocc_webmail_login.port.value = 110;
	}
}

function updateLang() 
{
	if (document.nocc_webmail_login.user.value == "" && document.nocc_webmail_login.passwd.value == "")
	{
		var lang_page = "index.php?lang=" + document.nocc_webmail_login.lang[document.nocc_webmail_login.lang.selectedIndex].value + "&theme=<?php echo $theme ?>";
		self.location = lang_page;
	}
}

function updateTheme() 
{
	if (document.nocc_webmail_login.user.value == "" && document.nocc_webmail_login.passwd.value == "")
	{
		var lang_page = "index.php?lang=<? echo $lang ?>&theme=" + document.nocc_webmail_login.theme[document.nocc_webmail_login.theme.selectedIndex].value;
		self.location = lang_page;
	}
}
// -->
</script>
</head>
<body dir="<?php echo $lang_dir ?>" bgcolor="<?php echo $glob_theme->bgcolor ?>" link="<?php echo $glob_theme->link_color ?>" text="<?php echo $glob_theme->text_color ?>" vlink="<?php echo $glob_theme->vlink_color ?>" alink="<?php echo $glob_theme->alink_color ?>">
<table border="0" width="100%">
	<tr>
		<td align="center" valign="middle">
			<form action="action.php" method="post" name="nocc_webmail_login">
			<table bgcolor="<?php echo $glob_theme->login_border ?>" border="0" cellpadding="1" cellspacing="0" width="428" align="center">
				<tr> 
					<td valign="bottom"> 
						<table bgcolor="<?php echo $glob_theme->login_box_bgcolor ?>" border="0" cellpadding="0" cellspacing="0" width="428">
							<tr> 
								<td colspan="3" height="18"><font size="-3">&nbsp;</font></td>
							</tr>
							<tr> 
								<td colspan="3" height="18"><font size="-3">&nbsp;</font></td>
							</tr>
							<tr valign="top"> 
				               <td align="center" colspan="3" class="f"><b><?php echo $html_welcome.' '.$nocc_name.' v'.$nocc_version; ?></b></td>
							</tr>
							<tr> 
								<td colspan="3" height="12"><font size="-3">&nbsp;</font></td>
							</tr>
							<tr>
								<td align="right" class="f"><?php echo $html_login ?></td>
								<td><font size="-3">&nbsp;</font></td>
								<td class="f"> 
									<input type="text" name="user" size="15" />
									<?php
									if ($domains[0]->in != '')
									{
										echo '@ <select name="domainnum">';
										$i = 0; 
										while ($domains[$i]->in != '')
										{
											echo "<option value=\"$i\">".$domains[$i]->domain.'</option>';
											$i++;
										}
										echo '</select>';
									}
									?>
								</td>
							</tr>
							<tr> 
								<td colspan="3" height="12"><font size="-3">&nbsp;</font></td>
							</tr>
							<tr> 
								<td align="right" class="f"><?php echo $html_passwd ?></td>
								<td><font size="-3">&nbsp;</font></td>
								<td class="f"> 
									<input type="password" name="passwd" size="15" />
								</td>
							</tr>
							<tr> 
								<td colspan="3" height="12"><font size="-3">&nbsp;</font></td>
							</tr>
							<?php
							if ($domains[0]->in == '')
							{
								echo '<tr><td align="right" class="f">'.$html_server.'</td>';
								echo '<td><font size="-3">&nbsp;</font></td>';
								echo '<td class="f"><input type="text" name="server" value="mail.example.com" size="15" /><br /><input type="text" size="4" name="port" value="143" /><select name="servtype" onchange="updatePort()"><option value="imap">IMAP</option><option value="pop3">POP3</option></select></td>';
								echo '</tr><tr><td colspan="3" height="12"><font size="-3">&nbsp;</font></td></tr>';
							}
							?>
							<tr>
								<td align="right" class="f"><?php echo $html_lang ?></td>
								<td><font size="-3">&nbsp;</font></td>
								<td class="f">
									<?php
										echo '<select name="lang" onchange="updateLang()">';
										for ($i = 0; $i < sizeof($lang_array); $i++)
											if (file_exists('lang/'.$lang_array[$i]->filename.'.php'))
											{
												echo '<option value="'.$lang_array[$i]->filename.'"';
												if ($lang == $lang_array[$i]->filename)
													echo ' selected="selected"';
												echo '>'.$lang_array[$i]->label.'</option>';
											}
										echo '</select>';
									?>
								</td>
							</tr>
							<tr> 
								<td colspan="3" height="12"><font size="-3">&nbsp;</font></td>
							</tr>
							<?php if ($use_theme == true) 
							{
								echo '<tr><td align="right" class="f">'.$html_theme.'</td><td><font size="-3">&nbsp;</font></td><td class="f">';
								echo '<select name="theme" onchange="updateTheme()">';
								$handle = opendir('./themes');
								while (($file = readdir($handle)) != false) 
								{
									if (($file != '.') && ($file != '..'))
									{
										echo '<option value="'.$file.'"';
										if ($file == $theme)
												echo ' selected="selected"';
										echo '>'.$file.'</option>';
									}
								}
								closedir($handle); 
								echo '</select></td></tr><tr><td colspan="3">&nbsp;</td></tr>';
							}
							?>
							<tr>
								<td colspan="3" align="center" class="f">
									<input name="enter" class="button" type="submit" value="<?php echo $html_submit ?>" />
								</td>
							</tr>
							<tr> 
								<td colspan="3" height="12"><font size="-3">&nbsp;</font></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<script type="text/javascript">
			<!--
				document.nocc_webmail_login.user.focus();
				document.nocc_webmail_login.passwd.value='';
			// -->
			</script>
<?php require ('html/footer.php'); ?>
