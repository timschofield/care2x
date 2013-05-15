<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/functions.php,v 1.2 2009/01/31 20:07:05 andi Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

$attach_tab = Array();

/* ----------------------------------------------------- */

function inbox($servr, $user, $passwd, $folder, $sort, $sortdir, $lang, $theme)
{
	$mailhost = $servr;
	require('conf.php');

	$pop = @imap_open('{' . $mailhost . '}' . $folder, $user, $passwd);
	if ($pop == false)
		return (-1);
	else
	{ 
		if (($num_messages = @imap_num_msg($pop)) == 0)
		{
			imap_close($pop);
			return (0);
		}
		else
		{
			//if ($sort != '' && $sortdir != '')
			$sorted = imap_sort($pop, $sort, $sortdir, SE_UID); 
			for ($i = 0; $i < $num_messages; $i++)
			{
				$subject = $from = '';
				$msgnum = $sorted[$i];
				$ref_contenu_message = imap_header($pop, imap_msgno($pop, $msgnum));
				$struct_msg = imap_fetchstructure($pop, imap_msgno($pop, $msgnum));
				$subject_array = imap_mime_header_decode($ref_contenu_message->subject);
				for ($j = 0; $j < count($subject_array); $j++)
					$subject .= $subject_array[$j]->text;
				$from_array = imap_mime_header_decode($ref_contenu_message->fromaddress);
				for ($j = 0; $j < count($from_array); $j++)
					$from .= $from_array[$j]->text;
				if (is_Imap($mailhost))
					$msg_size = get_mail_size($struct_msg);
				else
					$msg_size = ($struct_msg->bytes > 1000) ? ceil($struct_msg->bytes / 1000) : 1;
				if ($struct_msg->type == 1)
				{
					if ($struct_msg->subtype == 'ALTERNATIVE' || $struct_msg->subtype == 'RELATED')
						$attach = '&nbsp;';
					else
						$attach = '<img src="themes/' . $theme . '/img/attach.gif" height="28" width="27" alt="" />';
				}
				else
					$attach = '&nbsp;';
				// Check Status Line with UCB POP Server to
				// see if this is a new message. This is a
				// non-RFC standard line header.
				// Set this in conf.php
				if ($have_ucb_pop_server)
				{
					$header_msg = imap_fetchheader($pop, imap_msgno($pop, $msgnum));
					$header_lines = explode("\r\n", $header_msg);
					while (list($k, $v) = each($header_lines))
					{
						list ($header_field, $header_value) = explode(':', $v);
						if ($header_field == 'Status') 
							$new_mail_from_header = $header_value;
					}
				}
				else
				{
				if (($ref_contenu_message->Unseen == 'U') || ($ref_contenu_message->Recent == 'N'))
					$new_mail_from_header = '';
				else
					$new_mail_from_header = '&nbsp;';
				}
				if ($new_mail_from_header == '')
					$newmail = '<img src="themes/' . $theme . '/img/new.gif" alt="" height="17" width="17" />';
				else
					$newmail = '&nbsp;';
				$msg_list[$i] =  Array(
						'new' => $newmail, 
						'number' => imap_msgno($pop, $msgnum),
						'next' => imap_msgno($pop, $sorted[$i + 1]),
						'prev' => imap_msgno($pop, $sorted[$i - 1]),
						'attach' => $attach, 
						'from' => htmlspecialchars($from), 
						'subject' => htmlspecialchars($subject), 
						'date' => change_date(chop($ref_contenu_message->udate), $lang),
						'size' => $msg_size,
						'sort' => $sort,
						'sortdir' => $sortdir);
			}
			imap_close($pop);
			return ($msg_list);
		}
	}
}

/* ----------------------------------------------------- */

function aff_mail($servr, $user, $passwd, $folder, $mail, $verbose, $lang, $sort, $sortdir)
{
	$mailhost = $servr;
	require ('conf.php');
	require ('check_lang.php');
	GLOBAL $attach_tab;
//	GLOBAL $PHP_SELF;
	$glob_body = '';
	$subject = $from = $to = $cc = '';

	if (setlocale (LC_TIME, $lang_locale) != $lang_locale)
		$default_date_format = $no_locale_date_format;
	$current_date = strftime($default_date_format, time());
	$pop = @imap_open('{' . $mailhost . '}' . $folder, $user, $passwd);
	// Finding the next and previous message number
	$sorted = imap_sort($pop, $sort, $sortdir);
	for ($i = 0; $i < sizeof($sorted); $i++)
	{
		if ($mail == $sorted[$i])
		{
			$prev_msg = $sorted[$i - 1];
			$next_msg = $sorted[$i + 1];
			break;
		}
	}
	// END finding the next and previous message number
	$num_messages = @imap_num_msg($pop);
	$ref_contenu_message = @imap_header($pop, $mail);
	$struct_msg = @imap_fetchstructure($pop, $mail);
	if (sizeof($struct_msg->parts) > 0)
		GetPart($struct_msg, NULL, $display_rfc822);
	else
		GetSinglePart($struct_msg, htmlspecialchars(imap_fetchheader($pop, $mail)), @imap_body($pop, $mail));
	if ($verbose == 1 && $use_verbose == 1)
		$header = htmlspecialchars(imap_fetchheader($pop, $mail));
	else
		$header = '';
	$tmp = array_pop($attach_tab);
	if (eregi('text/html', $tmp['mime']) || eregi('text/plain', $tmp['mime']))
	{	
		if ($tmp['transfer'] == 'QUOTED-PRINTABLE')
			$glob_body = imap_qprint(imap_fetchbody($pop, $mail, $tmp['number']));
		elseif ($tmp['transfer'] == 'BASE64')
			$glob_body = base64_decode(imap_fetchbody($pop, $mail, $tmp['number']));
		else
			$glob_body = imap_fetchbody($pop, $mail, $tmp['number']);
		$glob_body = remove_stuff($glob_body, $lang, $tmp['mime']);
	}
	else
		array_push($attach_tab, $tmp);
	@imap_close($pop);
	if ($struct_msg->subtype != 'ALTERNATIVE' && $struct_msg->subtype != 'RELATED')
	{
		switch (sizeof($attach_tab))
		{
			case 0:
				$link_att = '';
				break;
			case 1:
				$link_att = '<tr><td align="right" valign="top" class="mail">' . $html_att . '</td><td bgcolor="' . $glob_theme->mail_properties . '" class="mail">' . link_att($mailhost, $mail, $attach_tab, $display_part_no) . '</td></tr>';
				break;
			default:
				$link_att = '<tr><td align="right" valign="top" class="mail">' . $html_atts . '</td><td bgcolor="' . $glob_theme->mail_properties . '" class="mail">' . link_att($mailhost, $mail, $attach_tab, $display_part_no) . '</td></tr>';
				break;
		}
	}
	$subject_array = imap_mime_header_decode($ref_contenu_message->subject);
	for ($j = 0; $j < count($subject_array); $j++)
		$subject .= $subject_array[$j]->text;
	$from_array = imap_mime_header_decode($ref_contenu_message->fromaddress);
	for ($j = 0; $j < count($from_array); $j++)
		$from .= $from_array[$j]->text;
	$to_array = imap_mime_header_decode($ref_contenu_message->toaddress);
	for ($j = 0; $j < count($to_array); $j++)
		$to .= $to_array[$j]->text;
	$cc_array = imap_mime_header_decode($ref_contenu_message->ccaddress);
	for ($j = 0; $j < count($cc_array); $j++)
		$cc .= $cc_array[$j]->text;
	$content = Array(
				'from' => htmlspecialchars($from),
				'to' => htmlspecialchars($to),
				'cc' => htmlspecialchars($cc),
				'subject' => htmlspecialchars($subject),
				'date' => change_date(chop($ref_contenu_message->udate), $lang),
				'att' => $link_att,
				'body' => $glob_body,
				'body_mime' => $tmp['mime'],
				'body_transfer' => $tmp['transfer'],
				'header' => $header,
				'verbose' => $verbose,
				'prev' => $prev_msg,
				'next' => $next_msg);
	return ($content);
}

/* ----------------------------------------------------- */

// based on a function from matt@bonneau.net
function GetPart($this_part, $part_no, $display_rfc822)
{
	GLOBAL $attach_tab;

	$att_name = '[unknown]';
	if ($this_part->ifdescription == TRUE)
		$att_name = $this_part->description;
	for ($lcv = 0; $lcv < count($this_part->parameters); $lcv++)
	{ 
		$param = $this_part->parameters[$lcv];
			if (($param->attribute == 'NAME') || ($param->attribute == 'name'))
			{
				$att_name = $param->value;
	        	break;
	    		}
	}
	switch ($this_part->type)
	{
		case TYPETEXT:
			$mime_type = 'text';
			break;
		case TYPEMULTIPART:
			$mime_type = 'multipart';
			for ($i = 0; $i < count($this_part->parts); $i++)
			{
				if ($part_no != '')
					$part_no = $part_no . '.';
				for ($i = 0; $i < count($this_part->parts); $i++)
				{
					// if it's an alternative, we skip the text part to only keep the HTML part
					if ($this_part->subtype == ALTERNATIVE)// && $read == true)
						GetPart($this_part->parts[++$i], $part_no . ($i + 1), $display_rfc822);
					else 
						GetPart($this_part->parts[$i], $part_no . ($i + 1), $display_rfc822);
				}
			}
			break;
		case TYPEMESSAGE:
			$mime_type = 'message';
			// well it's a message we have to parse it to find attachments or text message
			$num_parts = count($this_part->parts[0]->parts);
			if ($num_parts > 0)
				for ($i = 0; $i < $num_parts; $i++)
					GetPart($this_part->parts[0]->parts[$i], $part_no . '.' . ($i + 1), $display_rfc822);
			else
				GetPart($this_part->parts[0], $part_no . '.1', $display_rfc822);
			break;
		// Maybe we can do something with the mime types later ??
		case TYPEAPPLICATION:
			$mime_type = 'application';
			break;
		case TYPEAUDIO:
			$mime_type = 'audio';
			break;
		case TYPEIMAGE:
			$mime_type = 'image';
			break;
		case TYPEVIDEO:
			$mime_type = 'video';
			break;
		case TYPEMODEL:
			$mime_type = 'model';
			break;
		default:
			$mime_type = 'unknown';
	}
	$full_mime_type = $mime_type . '/' . $this_part->subtype;
	switch ($this_part->encoding)
	{
		case ENC7BIT:
			$encoding = '7BIT';
			break;
		case ENC8BIT:
			$encoding = '8BIT';
			break;
		case ENCBINARY:
			$encoding = 'BINARY';
			break;
		case ENCBASE64:
			$encoding = 'BASE64';
			break;
		case ENCQUOTEDPRINTABLE:
			$encoding = 'QUOTED-PRINTABLE';
			break;
		default:
			$encoding = 'none';
			break;
	}
	if (($full_mime_type == 'message/RFC822' && $display_rfc822 == true) || ($mime_type != 'multipart' && $full_mime_type != 'message/RFC822'))
	{
		if ($this_part->ifparameters)
			while ($obj = array_pop($this_part->parameters))
				if ($obj->attribute == 'CHARSET')
					$charset = $obj->value;
		$tmp = Array(
				'number' => ($part_no != '' ? $part_no : 1),
				'id' => $this_part->id,
				'name' => $att_name,
				'mime' => $full_mime_type,
				'transfer' => $encoding,
				'charset' => $this_part->charset,
				'size' => ($this_part->bytes > 1000) ? ceil($this_part->bytes / 1000) : 1);
		
		array_unshift($attach_tab, $tmp);
	}
}

/* ----------------------------------------------------- */

function GetSinglePart($this_part, $header, $body)
{
	GLOBAL $attach_tab;

	if (eregi('text/html', $header))
		$full_mime_type = 'text/html';
	else
		$full_mime_type = 'text/plain';
	switch ($this_part->encoding)
	{
		case ENC7BIT:
			$encoding = '7BIT';
			break;
		case ENC8BIT:
			$encoding = '8BIT';
			break;
		case ENCBINARY:
			$encoding = 'BINARY';
			break;
		case ENCBASE64:
			$encoding = 'BASE64';
			break;
		case ENCQUOTEDPRINTABLE:
			$encoding = 'QUOTED-PRINTABLE';
			break;
		default:
			$encoding = 'none';
			break;
	}
	if ($this_part->ifparameters)
		while ($obj = array_pop($this_part->parameters))
			if ($obj->attribute == 'CHARSET')
				$charset = $obj->value;
	$tmp = Array(
					'number' => 1,
					'id' => $this_part->id,
					'name' => '',
					'mime' => $full_mime_type,
					'transfer' => $encoding,
					'charset' => $this_part->charset,
					'size' => ($this_part->bytes > 1000) ? ceil($this_part->bytes / 1000) : 1);
	array_unshift($attach_tab, $tmp);
}

/* ----------------------------------------------------- */

function remove_stuff($body, $lang, $mime)
{
	// GLOBAL $PHP_SELF;

	if (eregi('html', $mime))
	{
		$to_removed_array = array (
						"'<html>'si",
						"'</html>'si",
						"'<body[^>]*>'si",
						"'</body>'si",
						"'<head[^>]*>.*?</head>'si",
						"'<style[^>]*>.*?</style>'si",
						"'<script[^>]*>.*?</script>'si",
						"'<object[^>]*>.*?</object>'si",
						"'<embed[^>]*>.*?</embed>'si",
						"'<applet[^>]*>.*?</applet>'si",
						"'<mocha[^>]*>.*?</mocha>'si");
		$body = preg_replace($to_removed_array, '', $body);
		$body = preg_replace("|href=\"(.*)script:|i", 'href="nocc_removed_script:', $body);
		$body = preg_replace("|<([^>]*)java|i", '<nocc_removed_java_tag', $body);
		$body = preg_replace("|<([^>]*)&{.*}([^>]*)>|i", "<&{;}\\3>", $body);
		//$body = preg_replace("|<([^>]*)mocha:([^>]*)>|i", "<nocc_removed_mocha:\\2>",$body);
		$body = eregi_replace("href=\"mailto:([[:alnum:]+-=%&:_.~?@]+[#[:alnum:]+]*)\"","<A HREF=\"".$_SERVER['PHP_SELF']."?action=write&amp;mail_to=\\1&amp;lang=$lang\"", $body);
		$body = eregi_replace("href=mailto:([[:alnum:]+-=%&:_.~?@]+[#[:alnum:]+]*)","<A HREF=\"".$_SERVER['PHP_SELF']."?action=write&amp;mail_to=\\1&amp;lang=$lang\"", $body);
		$body = eregi_replace("target=\"([[:alnum:]+-=%&:_.~?]+[#[:alnum:]+]*)\"", "", $body);
		$body = eregi_replace("target=([[:alnum:]+-=%&:_.~?]+[#[:alnum:]+]*)", "", $body);
		$body = eregi_replace("href=\"([[:alnum:]+-=%&:_.~?]+[#[:alnum:]+]*)\"","<a href=\"\\1\" target=\"_blank\"", $body);
		$body = eregi_replace("href=([[:alnum:]+-=%&:_.~?]+[#[:alnum:]+]*)","<a href=\"\\1\" target=\"_blank\"", $body);
	}
	elseif (eregi('plain', $mime))
	{
		$body = htmlspecialchars($body);
		$body = eregi_replace("(http|https|ftp)://([[:alnum:]+-=%&:_.~?]+[#[:alnum:]+]*)","<a href=\"\\1://\\2\" target=\"_blank\">\\1://\\2</a>", $body);
		$body = eregi_replace("([#[:alnum:]+-._]*)@([#[:alnum:]+-_]*)\.([[:alnum:]+-_.]+[#[:alnum:]+]*)","<a href=\"".$_SERVER['PHP_SELF']."?action=write&amp;mail_to=\\1@\\2.\\3&amp;lang=$lang\">\\1@\\2.\\3</a>", $body);
		$body = nl2br($body);
		if (function_exists('wordwrap'))
			$body = wordwrap($body, 80, "\n");
	}	
	return ($body);
}

/* ----------------------------------------------------- */

function link_att($servr, $mail, $tab, $display_part_no)
{
	sort($tab);
	$link = '<table border="0">';
	while ($tmp = array_shift($tab))
		if ($tmp['id'] == '')
		{
			$mime = str_replace('/', '-', $tmp['mime']);
			$link .= '<tr>';
			if ($display_part_no == true)
				$link .= '<td class="inbox">' . $tmp['number'] . '</td>';
			$att_name = imap_mime_header_decode($tmp['name']);
			$link .= '<td class="inbox"><a href="download.php?mail=' . $mail . '&amp;part=' . $tmp['number'] . '&amp;transfer=' . $tmp['transfer'] . '&amp;filename=' . urlencode($att_name[0]->text) . '&amp;mime=' . $mime . '">' . htmlentities($att_name[0]->text) . '</a></td><td class="inbox">' . $tmp['mime'] . '</td><td class="inbox">' . $tmp['size'] . ' kb</td></tr>';
		}
	$link .= '</table>';
	return ($link);
}

/* ----------------------------------------------------- */

function change_date($date, $lang)
{
	require ('check_lang.php');
	if (empty($date))
		$msg_date = '';
	else
	{
		if (setlocale (LC_TIME, $lang_locale) != $lang_locale)
			$default_date_format = $no_locale_date_format;
		if ((date('Y', $date) != date('Y')) || (date('M') != date('M', $date)) || (date('d') != date('d', $date)))
			// not today, use the date
			$msg_date = strftime($default_date_format, $date);
		else
			// else it's today, use the time
			$msg_date = strftime($default_time_format, $date);
	}
	return ($msg_date);
}


/* ----------------------------------------------------- */

// We have to figure out the entire mail size
function get_mail_size($this_part)
{
	$size = $this_part->bytes;
	for ($i = 0; $i < count($this_part->parts); $i++)
		$size += $this_part->parts[$i]->bytes;
	$size = ($size > 1000) ? ceil($size / 1000) : 1;
	return ($size);
}

/* ----------------------------------------------------- */

// this function build an array with all the recipients of the message for later reply or reply all 
function get_reply_all($user, $domain, $from, $to, $cc)
{
	if (!eregi($user.'@'.$domain, $from))
		$rcpt = $from.'; ';
	$tab = explode(',', $to);
	while ($tmp = array_shift($tab))
		if (!eregi($user.'@'.$domain, $tmp))
			$rcpt .= $tmp.'; ';
	$tab = explode(',', $cc);
	while ($tmp = array_shift($tab))
		if (!eregi($user.'@'.$domain, $tmp))
			$rcpt .= $tmp.'; ';
	return (substr($rcpt, 0, strlen($rcpt) - 2));
}

/* ----------------------------------------------------- */

// We need that to build a correct list of all the recipient when we send a message
function cut_address($addr, $charset)
{
	$name = '';

	$addr = str_replace(',', ';', $addr);
	$array = explode(';', $addr);
	for ($i = 0; $i < sizeof($array); $i++)
	{
		$pos = strrpos($array[$i], '<');
		if (is_int($pos))
		{
			if ($pos != 0)
				$name = '"'.encode_mime(substr($array[$i], 0, $pos - 1), $charset).'"';
			$addr = substr($array[$i], $pos);
			$array[$i] = $name.$addr;
		}
		elseif ($array[$i] != '')
			$array[$i] = '<'.$array[$i].'>';
	}
	return ($array);
}

/* ----------------------------------------------------- */

// Function that save the attachment locally for reply, transfer...
// This function returns an array of all the attachment
function save_attachment($servr, $user, $passwd, $folder, $mail, $tmpdir)
{
	GLOBAL $attach_tab;
	$i = 0;
	$attach_array = array();

	$pop = imap_open('{'.$servr.'}'.$folder, $user, $passwd);
	while ($tmp = array_shift($attach_tab))
	{
		$i++;
		$file = imap_fetchbody($pop, $mail, $tmp['number']);
		if ($tmp['transfer'] == 'QUOTED-PRINTABLE')
			$file = imap_qprint($file);
		elseif ($tmp['transfer'] == 'BASE64')
			$file = base64_decode($file);
		$filename = 'NOCC_TMP'.md5(uniqid(time()));
		$fp = fopen($tmpdir . '/' . $filename, 'w');
		fwrite($fp, $file);
		fclose($fp);
		$attach_array[$i]->file_name = $tmp['name'];
		$attach_array[$i]->tmp_file = $filename;
		$attach_array[$i]->file_size = strlen($file);
		$attach_array[$i]->file_mime = $tmp['mime'];
	} 
	imap_close($pop);
	return(array($i, $attach_array));
}

/* ----------------------------------------------------- */

function view_part($servr, $user, $passwd, $folder, $mail, $part_no, $transfer, $msg_charset, $charset)
{
	$pop = imap_open('{' . $servr . '}' . $folder, $user, $passwd);
	$text = imap_fetchbody($pop, $mail, $part_no);
	if ($transfer == 'BASE64')
		$str = nl2br(imap_base64($text));
	elseif($transfer == 'QUOTED-PRINTABLE')
		$str = nl2br(quoted_printable_decode($text));
	else
		$str = nl2br($text);
	//if (eregi('koi', $transfer) || eregi('windows-1251', $transfer))
	//	$str = @convert_cyr_string($str, $msg_charset, $charset);
	return ($str);
}

/* ----------------------------------------------------- */

function encode_mime($string, $charset)
{ 
	$text = '=?' . $charset . '?Q?'; 
	for($i = 0; $i < strlen($string); $i++ )
	{ 
		$val = ord($string[$i]); 
		$val = dechex($val); 
		$text .= '=' . $val; 
	} 
	$text .= '?='; 
	return ($text); 
} 

/* ----------------------------------------------------- */

// This function is used when accessing a page without being logged in
// or accessing send.php via GET method
function go_back_index($attach_array, $tmpdir, $php_session, $sort, $sortdir, $lang)
{
	if (is_array($attach_array))
		while ($tmp = array_shift($attach_array))
			unlink($tmpdir.'/'.$tmp->tmp_file);
	session_unregister('num_attach');
	session_unregister('attach_array');
	header("location: action.php?sort=$sort&sortdir=$sortdir&lang=$lang&$php_session=".$$php_session);
}

/* ----------------------------------------------------- */

// This function returns TRUE if the mail server is an IMAP one
// and it returns FALSE otherwise
function is_Imap($servr)
{
	if (stristr($servr, '/pop3:'))
		return (false);
	if (stristr($servr, '/nntp:'))
		return (false);
	return (true);
}

/* ----------------------------------------------------- */

// This function returns the CRLF depending on the OS and
// the way to send messages
function get_crlf($smtp)
{
	$crlf = stristr($OS, 'Windows') ? "\r\n" : "\n";
	$crlf = $smtp ? "\r\n" : $crlf;
	return ($crlf);
}

/* ----------------------------------------------------- */
?>
