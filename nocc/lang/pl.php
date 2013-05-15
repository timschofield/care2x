<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/lang/pl.php,v 1.1 2006/01/13 13:42:52 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the Polish language
 * Translation by Rafal <arat@alpha.net.pl>
 */

$charset = 'windows-1250';

// Configuration for the days and months

// What language to use (Here, english US --> en_US)
// see '/usr/share/locale/' for more information
$lang_locale = 'pl';

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

$err_user_empty = 'Nazwa u¿ytkownika jest pusta';
$err_passwd_empty = 'Has³o jest puste';


// html message

$alt_delete = 'Usuñ zaznaczone wiadomoœci';
$alt_delete_one = 'Usuñ wiadomoœæ';
$alt_new_msg = 'Nowa wiadomoœæ';
$alt_reply = 'Odpowiedz autorowi';
$alt_reply_all = 'Odpowiedz wszystkim';
$alt_forward = 'Przeœlij dalej';
$alt_next = 'Dalej';
$alt_prev = 'Poprzednia';
$html_on = 'wlaczone';
$html_theme = 'Temat';

// index.php

$html_lang = 'Jêzyk';
$html_welcome = 'Witaj w';
$html_login = 'Nazwa';
$html_passwd = 'Has³o';
$html_submit = 'Zaloguj siê';
$html_help = 'Pomoc';
$html_server = 'Serwer';
$html_wrong = 'Nazwa albo has³o s¹ nieprawid³owe';
$html_retry = 'Ponów próbê';

// Other pages

$html_view_header = 'Zobacz nag³ówek';
$html_remove_header = 'Ukryj nag³ówek';
$html_inbox = 'Skrzynka odbiorcza';
$html_new_msg = 'Nowa wiadomoœæ';
$html_reply = 'Odpowiedz';
$html_reply_short = 'Odp';
$html_reply_all = 'Odpowiedz wszystkim';
$html_forward = 'Przeœlij dalej';
$html_forward_short = 'Fw';
$html_delete = 'Usuñ';
$html_new = 'Nowa';
$html_mark = 'Usuñ';
$html_att = 'Za³¹cznik';
$html_atts = 'Za³¹czniki';
$html_att_unknown = '[nieznany typ]';
$html_attach = 'Do³¹cz';
$html_attach_forget = 'Musisz za³¹czyc plik przed wys³aniem wiadomoœci !';
$html_attach_delete = 'Usuñ zaznaczone';
$html_from = 'Od';
$html_subject = 'Temat';
$html_date = 'Data';
$html_sent = 'Wyœlij';
$html_size = 'Wielkoœæ';
$html_totalsize = 'Rozmiar ca³kowity';
$html_kb = 'Kb';
$html_bytes = 'bajtów';
$html_filename = 'Nazwa pliku';
$html_to = 'Do';
$html_cc = 'Cc';
$html_bcc = 'Bcc';
$html_nosubject = 'Bez tematu';
$html_send = 'Wyœlij';
$html_cancel = 'Anuluj';
$html_no_mail = 'Brak wiadomoœci.';
$html_logout = 'Wyloguj œiê';
$html_msg = 'Wiadomoœæ';
$html_msgs = 'Wiadomoœci';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- Oryginalna wiadomoœæ --';
$to_empty = 'Pole \'Do\' nie mo¿e byæ puste !';
?>