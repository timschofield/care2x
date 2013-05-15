<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/lang/sk.php,v 1.1 2006/01/13 13:42:52 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the Slovak language
 * Translation by Peter Sochna <sochna@telecom.sk>
 */

$charset = 'ISO-8859-2';

// Configuration for the days and months

// What language to use
// see '/usr/share/locale/' for more information
$lang_locale = 'sk_SK';

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

$err_user_empty = 'Nezadali ste prihlasovacie meno';
$err_passwd_empty = 'Nezadali ste heslo';


// html message

$alt_delete = 'Vymaza» oznaèené správy';
$alt_delete_one = 'Vymaza» správu';
$alt_new_msg = 'Nová správy';
$alt_reply = 'Odpoveda» autorovi';
$alt_reply_all = 'Odpoveda» v¹etkým';
$alt_forward = 'Preposla»';
$alt_next = 'Ïal¹ia správa';
$alt_prev = 'Predo¹lá správa';
$html_on = 'on';
$html_theme = 'Theme';

// index.php

$html_lang = 'Jazyk';
$html_welcome = 'Vitajte v ';
$html_login = 'Prihlasovacie meno';
$html_passwd = 'Heslo';
$html_submit = 'Prihlási»';
$html_help = 'Pomoc';
$html_server = 'Server';
$html_wrong = 'Bolo zadané zlé prihlasovacie meno alebo heslo';
$html_retry = 'Zopakova»';

// Other pages

$html_view_header = 'Zobrazi» hlavièku';
$html_remove_header = 'Skry» hlavièku';
$html_inbox = 'Prijaté správy';
$html_new_msg = 'Posla» správu';
$html_reply = 'Odpoveda»';
$html_reply_short = 'Re';
$html_reply_all = 'Odpoveda» v¹etkým';
$html_forward = 'Preposla»';
$html_forward_short = 'Fw';
$html_delete = 'Vymaza»';
$html_new = 'Nový';
$html_mark = 'Vymaza»';
$html_att = 'Attachment';
$html_atts = 'Attachmenty';
$html_att_unknown = '[neznámy]';
$html_attach = 'Pripoji» attachment';
$html_attach_forget = 'Pred odoslaním správy musíte pripoji» vá¹ attachment !';
$html_attach_delete = 'Odstráò oznaèené';
$html_from = 'Odosielateµ';
$html_subject = 'Nadpis';
$html_date = 'Dátum';
$html_sent = 'Poslané';
$html_size = 'Velkos»';
$html_totalsize = 'Celková velkos»';
$html_kb = 'Kb';
$html_bytes = 'bytov';
$html_filename = 'Súbor';
$html_to = 'Adresát';
$html_cc = 'Kópia';
$html_bcc = 'Tajná kópia';
$html_nosubject = '®iaden nadpis';
$html_send = 'Posla»';
$html_cancel = 'Zru¹i»';
$html_no_mail = '®iadne správy.';
$html_logout = 'Odhlásenie';
$html_msg = 'Správa';
$html_msgs = 'Správy';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- Original Message --';
$to_empty = 'Políèko \'Adresát\' nesmie by» prázdne !';
?>