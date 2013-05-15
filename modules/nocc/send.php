<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/send.php,v 1.2 2009/01/31 20:06:45 andi Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

require ('conf.php');
require ('check_lang.php');
require ('functions.php');

if (!session_is_registered('loggedin') && $loggedin)
	header("location: logout.php?lang=$lang");

if (!function_exists('is_uploaded_file'))
	include ('is_uploaded_file.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST')
	go_back_index($attach_array, $tmpdir, $php_session, $sort, $sortdir, $lang);
else
{
	require ($root_path.'include/care_api_classes/class_send.php');
	require ($root_path.'include/care_api_classes/class_smtp.php');

	switch ($sendaction)
	{
		case 'add':
			// Counting the attachments number in the array
			if (!is_array($attach_tab))
				$num_attach = 1;
			else
				$num_attach++;
			$tmp_name = basename($mail_att.'.att');
			// Adding the new file to the array
			if (is_uploaded_file($mail_att))
			{
				copy($mail_att, $tmpdir.'/'.$tmp_name);
				$attach_array[$num_attach]->file_name = basename($mail_att_name);
				$attach_array[$num_attach]->tmp_file = $tmp_name;
				$attach_array[$num_attach]->file_size = $mail_att_size;
				$attach_array[$num_attach]->file_mime = $mail_att_type;
			}
			// Registering the attachments array into the session
			session_register('num_attach', 'attach_array');
			// Displaying the sending form with the new attachments array
			header("Content-type: text/html; Charset=$charset");
			require ('html/header.php');
			require ('html/menu_inbox.php');
			require ('html/send.php');
			require ('html/menu_inbox.php');
			break;
		case 'send':
			$ip = ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
			$mail = new mime_mail();
			$mail->crlf = get_crlf($smtp_server);
			$mail->smtp_server = $smtp_server;
			$mail->smtp_port = $smtp_port;
			$mail->charset = $charset;
			$mail->from = cut_address($mail_from, $charset);
			$mail->from = $mail->from[0];
			$mail->headers = 'X-Originating-Ip: [' . $ip . ']' . $mail->crlf . 'X-Mailer: ' . $nocc_name . ' v' . $nocc_version;
			$mail->to = cut_address($mail_to, $charset);
			$mail->cc = cut_address($mail_cc, $charset);
			$mail->bcc = cut_address($mail_bcc, $charset);
			if ($mail_subject != '')
				$mail->subject = stripcslashes($mail_subject);
			if ($mail_body != '')
				$mail->body = stripcslashes($mail_body) . $mail->crlf . $mail->crlf . $ad;
			else
				$mail->body = $ad;
			// Getting the attachments
			for ($i = 1; $i <= $num_attach; $i++)
			{
				// If the temporary file exists, attach it
				if (file_exists($tmpdir.'/'.$attach_array[$i]->tmp_file))
				{
					$fp = fopen($tmpdir.'/'.$attach_array[$i]->tmp_file, "rb");
					$file = fread($fp, $attach_array[$i]->file_size);
					fclose($fp);
					// add it to the message, by default it is encoded in base64
					$mail->add_attachment($file, imap_qprint($attach_array[$i]->file_name), $attach_array[$i]->file_mime, 'base64', '');
					// then we delete the temporary file
					unlink($tmpdir.'/'.$attach_array[$i]->tmp_file);
				}
			}
			// We need to unregister the attachments array and num_attach
			session_unregister('num_attach');
			session_unregister('attach_array');
			if (!$mail->send())
				$error = true; // an error occured while sending the message
			header ("Location: action.php?sort=$sort&sortdir=$sortdir&lang=$lang&$php_session=".$$php_session);
			break;
		case 'delete':
			// Rebuilding the attachments array with only the files the user wants to keep
			$tmp_array = array();
			for ($i = $j = 1; $i <= $num_attach; $i++)
			{
				$thefile = 'file'.$i;
				if (empty($$thefile))
				{
					$tmp_array[$j]->file_name = $attach_array[$i]->file_name;
					$tmp_array[$j]->tmp_file = $attach_array[$i]->tmp_file;
					$tmp_array[$j]->file_size = $attach_array[$i]->file_size;
					$tmp_array[$j]->file_mime = $attach_array[$i]->file_mime;
					$j++;
				}
				else
					@unlink($tmpdir.'/'.$attach_array[$i]->tmp_file);
			}
			$num_attach = ($j > 1 ? $j - 1 : 0);
			// Removing the attachments array from the current session
			session_unregister('num_attach');
			session_unregister('attach_array');
			$attach_array = $tmp_array;
			// Registering the attachments array into the session
			session_register('num_attach', 'attach_array');
			// Displaying the sending form with the new attachment array
			header("Content-type: text/html; Charset=$charset");
			require ('html/header.php');
			require ('html/menu_inbox.php');
			require ('html/send.php');
			require ('html/menu_inbox.php');
			break;
		default:
			go_back_index($attach_array, $tmpdir, $php_session, $sort, $sortdir, $lang);
			break;
	}
	require ('html/footer.php');
}
?>