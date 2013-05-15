<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/lang/zh-tw.php,v 1.1 2006/01/13 13:42:52 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the chinese (Taiwan) big5 language
 * Translation by Cary Leung <cary@cary.net>
 */

$charset = 'Big5';

// Configuration for the days and months

// What language to use (Here, english US --> en_US)
// see '/usr/share/locale/' for more information
$lang_locale = 'zh_TW.BIG5';

// Text Alignment
// Can be right-to-left (rtl) which is needed for proper Arabic, Hebrew
// Or left-to-right (ltr) which is default for most languages
$lang_dir = 'ltr';

// What format string should we pass to strftime() for messages sent on
// days other than today?
$default_date_format = '%Y-%m-%d';

// If the local is not implemented on the host, how we display the date
$no_locale_date_format = '%Y-%m-%d';

// What format string should we pass to strftime() for messages sent
// today?
$default_time_format = '%I:%M %p';


// Here is the configuration for the HTML

$err_user_empty = 'µn¤J¦W¦r¤§¦ì¸mªÅ¥Õ';
$err_passwd_empty = '±K½X¤§¦ì¸mªÅ¥Õ';


// html message

$alt_delete = ' ç°£¤w¿ï¾Ü¤§«H¥ó';
$alt_delete_one = ' ç°£¦¹«H¥ó';
$alt_new_msg = '·s«H¥ó';
$alt_reply = '¦^ÂÐ«H¥ó';
$alt_reply_all = '¦^ÂÐ©Ò¦³¤H';
$alt_forward = 'Âà±H';
$alt_next = '¤U¤@«Ê';
$alt_prev = '¤W¤@«Ê';
$html_on = '&#22312;';
$html_theme = '&#32972;&#26223;&#20027;&#38988;';

// index.php

$html_lang = '»y¨¥';
$html_welcome = 'Åwªï¨ì';
$html_login = 'µn¤J';
$html_passwd = '±K½X';
$html_submit = '´£¥æ';
$html_help = 'À°§U';
$html_server = '¦øªA¾¹';
$html_wrong = 'µn¤J¦W¦r©Î±K½X¤£¥¿½T';
$html_retry = '¦A¹Á¸Õ';

// Other pages

$html_view_header = 'Åã¥Ü¼ÐÃD';
$html_remove_header = '¤£Åã¥Ü¼ÐÃD';
$html_inbox = '«H½c';
$html_new_msg = '¼g«H¥ó';
$html_reply = '¦^ÂÐ';
$html_reply_short = '¦^ÂÐ';
$html_reply_all = '¦^ÂÐ©Ò¦³¤H';
$html_forward = 'Âà±H';
$html_forward_short = 'Âà±H';
$html_delete = ' ç°£';
$html_new = '·s';
$html_mark = ' ç°£';
$html_att = 'ªþ¥ó';
$html_atts = 'ªþ¥ó';
$html_att_unknown = '[¤£©ú]';
$html_attach = 'ªþ¥ó';
$html_attach_forget = '§A§Ñ°O¥[¤Jªþ¥ó !';
$html_attach_delete = ' ç°£¤w¿ï¾Üªº';
$html_from = '¥Ñ';
$html_subject = 'ÃD¥Ø';
$html_date = '¤é´Á';
$html_sent = '¶Ç°e';
$html_size = 'Åé¿n';
$html_totalsize = 'Á`Åé¿n';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'ÀÉ¦W';
$html_to = '¦¬¥ó¤H';
$html_cc = '½Æ»s¦Ü';
$html_bcc = 'Bcc';
$html_nosubject = 'µLÃD¥Ø';
$html_send = '¶Ç°e';
$html_cancel = '¨ú®ø';
$html_no_mail = 'µL¤º®e.';
$html_logout = 'µn¥X';
$html_msg = '«H¥ó';
$html_msgs = '«H¥ó';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- ­ì©l¤º®e --';
$to_empty = '¦¹ \'¦¬¥ó¤H\' ¤§¦ì¸m¤£¯à¨S¦³ !';
?>