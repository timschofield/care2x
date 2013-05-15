<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/lang/en.php,v 1.1 2006/01/13 13:39:08 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the english language
 */

$charset = 'ISO-8859-1';

// Configuration for the days and months

// What language to use (Here, english US --> en_US)
// see '/usr/share/locale/' for more information
$lang_locale = 'en_US';

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

$err_user_empty = 'The login field is empty';
$err_passwd_empty = 'The password field is empty';


// html message

$alt_delete = 'Delete selected messages';
$alt_delete_one = 'Delete the message';
$alt_new_msg = 'New messages';
$alt_reply = 'Reply to the author';
$alt_reply_all = 'Reply all';
$alt_forward = 'Forward';
$alt_next = 'Next message';
$alt_prev = 'Previous message';
$html_on = 'on';
$html_theme = 'Theme';

// index.php

$html_lang = 'Language';
$html_welcome = 'Welcome to';
$html_login = 'Login';
$html_passwd = 'Password';
$html_submit = 'Login';
$html_help = 'Help';
$html_server = 'Server';
$html_wrong = 'The login or the password are incorrect';
$html_retry = 'Retry';

// Other pages

$html_view_header = 'View header';
$html_remove_header = 'Hide header';
$html_inbox = 'Inbox';
$html_new_msg = 'Write';
$html_reply = 'Reply';
$html_reply_short = 'Re';
$html_reply_all = 'Reply all';
$html_forward = 'Forward';
$html_forward_short = 'Fw';
$html_delete = 'Delete';
$html_new = 'New';
$html_mark = 'Delete';
$html_att = 'Attachment';
$html_atts = 'Attachments';
$html_att_unknown = '[unknown]';
$html_attach = 'Attach';
$html_attach_forget = 'You must attach your file before sending your message !';
$html_attach_delete = 'Remove Selected';
$html_from = 'From';
$html_subject = 'Subject';
$html_date = 'Date';
$html_sent = 'Send';
$html_size = 'Size';
$html_totalsize = 'Total Size';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'Filename';
$html_to = 'To';
$html_cc = 'Cc';
$html_bcc = 'Bcc';
$html_nosubject = 'No subject';
$html_send = 'Send';
$html_cancel = 'Cancel';
$html_no_mail = 'No message.';
$html_logout = 'Logout';
$html_msg = 'Message';
$html_msgs = 'Messages';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- Original Message --';
$to_empty = 'The \'To\' field must not be empty !';
?>