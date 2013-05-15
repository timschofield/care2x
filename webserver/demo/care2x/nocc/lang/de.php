<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/lang/de.php,v 1.1 2006/01/13 13:42:52 irroal Exp $ 
 *
 * Copyright 2000 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2000 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the german language
 * Translation by David Ferch <dferch@tk-online.net>
 */

$charset = 'ISO-8859-1';

// Configuration for the days and months

// What language to use (Here, english US --> en_US)
// see '/usr/share/locale/' for more information
$lang_locale = 'de_DE';

// Text Alignment
// Can be right-to-left (rtl) which is needed for proper Arabic, Hebrew
// Or left-to-right (ltr) which is default for most languages
$lang_dir = 'ltr';

// What format string should we pass to strftime() for messages sent on
// days other than today?
$default_date_format = '%d.%m.%Y'; 

// If the local is not implemented on the host, how we display the date
$no_locale_date_format = '%d.%m.%Y';

// What format string should we pass to strftime() for messages sent
// today?
$default_time_format = '%I:%M %p';


// Here is the configuration for the HTML

$err_user_empty = 'Kein Nutzername eingegeben';
$err_passwd_empty = 'Kein Passwort eingegeben';


// html message

$alt_delete = 'Markierte Nachrichten l&ouml;schen';
$alt_delete_one = 'Nachricht l&ouml;schen';
$alt_new_msg = 'Neue Nachrichten';
$alt_reply = 'Antwort an Absender';
$alt_reply_all = 'Antwort an alle';
$alt_forward = 'Weiterleitung';
$alt_next = 'N&auml;chste';
$alt_prev = 'Vorige';


// index.php

$html_lang = 'Lang';
$html_welcome = 'Willkommen bei';
$html_login = 'Login';
$html_passwd = 'Passwort';
$html_submit = 'Ok';
$html_help = 'Hilfe';
$html_server = 'Server';
$html_wrong = 'Der Nutzername oder das Passwort sind falsch';
$html_retry = 'Nochmal';
$html_on = 'on';
$html_theme = 'Theme';

// Other pages

$html_view_header = 'Kopf anzeigen';
$html_remove_header = 'Kopf verbergen';
$html_inbox = 'Inbox';
$html_new_msg = 'Schreiben';
$html_reply = 'Antworten';
$html_reply_short = 'AW';
$html_reply_all = 'Antwort an alle';
$html_forward = 'Weiterleitung';
$html_forward_short = 'WL';
$html_delete = 'L&ouml;schen';
$html_new = 'Neu';
$html_mark = 'L&ouml;schen';
$html_att = 'Anhang';
$html_atts = 'Anh&auml;nge';
$html_att_unknown = '[unbekannt]';
$html_attach = 'Attach';
$html_attach_forget = 'You must attach your file before sending your message !';
$html_attach_delete = 'Remove selected';
$html_from = 'Von';
$html_subject = 'Betreff';
$html_date = 'Datum';
$html_sent = 'Senden';
$html_size = 'Gr&ouml;sse';
$html_totalsize = 'Total Size';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'Filename';
$html_to = 'An';
$html_cc = 'Kopie';
$html_bcc = 'Blinde Kopie';
$html_nosubject = 'Kein Betreff';
$html_send = 'Senden';
$html_cancel = 'Abbrechen';
$html_no_mail = 'Keine neue Nachrichten.';
$html_logout = 'Abmelden';
$html_msg = 'Nachricht';
$html_msgs = 'Nachrichten';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- Original Nachricht--';
$to_empty = 'Das \'An\' Feld darf nicht leer sein !';
?>