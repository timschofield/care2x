<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/lang/cs.php,v 1.1 2006/01/13 13:39:04 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the Czech language
 * Translation by Vaclav Habr <habr@fonet.cz>
 */

$charset = 'ISO-8859-2';

// Configuration for the days and months

// What language to use (Here, english US --> en_US)
// see '/usr/share/locale/' for more information
$lang_locale = 'cs_CZ';

// Text Alignment
// Can be right-to-left (rtl) which is needed for proper Arabic, Hebrew
// Or left-to-right (ltr) which is default for most languages
$lang_dir = 'ltr';

// What format string should we pass to strftime() for messages sent on
// days other than today?
$default_date_format = '%d-%m-%Y'; 

// If the local is not implemented on the host, how we display the date
$no_locale_date_format = '%d-%m-%Y';

// What format string should we pass to strftime() for messages sent
// today?
$default_time_format = '%I:%M %p';


// Here is the configuration for the HTML

$err_user_empty = 'Není vyplnìno pøihla¹ovací jméno ';
$err_passwd_empty = 'Není vyplnìno heslo';

// html message

$alt_delete = 'Vymazat vybrané zprávy';
$alt_delete_one = 'Vymazat zprávu';
$alt_new_msg = 'Nové zprávy';
$alt_reply = 'Odpovìdìt autorovi';
$alt_reply_all = 'Odpovìdìt v¹em';
$alt_forward = 'Pøedat dál';
$alt_next = 'Dal¹í zpráva';
$alt_prev = 'Pøedchozí zpráva';
$html_on = 'na';
$html_theme = 'Téma';


// index.php

$html_lang = 'Jazyk';
$html_welcome = 'Vítejte v';
$html_login = 'Jméno';
$html_passwd = 'Heslo';
$html_submit = 'Pøihlásit';
$html_help = 'Pomoc';
$html_server = 'Server';
$html_wrong = 'Prihla¹ovací jméno a heslo nesouhlasí';
$html_retry = 'Opakuj';

// Other pages

$html_view_header = 'Zobraz hlavièku';
$html_remove_header = 'Skryj hlavièku';
$html_inbox = 'Inbox';
$html_new_msg = 'Nová zpráva';
$html_reply = 'Odpovìdìt';
$html_reply_short = 'Re';
$html_reply_all = 'Odpovìdìt v¹em';
$html_forward = 'Pøedat dál';
$html_forward_short = 'Fw';
$html_delete = 'Vymazat';
$html_new = 'Nová';
$html_mark = 'Vymazat';
$html_att = 'Pøíloha';
$html_atts = 'Pøílohy';
$html_att_unknown = '[neznámý]';
$html_attach = 'Pøíloha';
$html_attach_forget = 'Soubor musí být pøipojen pøed odesláním mailu';
$html_attach_delete = 'Vyma¾ vybrané';
$html_from = 'Od';
$html_subject = 'Pøedmìt';
$html_date = 'Datum';
$html_sent = 'Poslat';
$html_size = 'Velikost';
$html_totalsize = 'Celková velikost';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'Název souboru';
$html_to = 'Komu';
$html_cc = 'Kopie';
$html_bcc = 'Skrytá';
$html_nosubject = 'Bez názvu';
$html_send = 'Po¹li';
$html_cancel = 'Storno';
$html_no_mail = '®ádná zpráva';
$html_logout = 'Odhlá¹ení';
$html_msg = 'Zpráva';
$html_msgs = 'Zprávy';

$original_msg = '-- Pùvodní zpráva --';
$to_empty = 'Musíte vyplnit polo¾ku Komu:';
?>