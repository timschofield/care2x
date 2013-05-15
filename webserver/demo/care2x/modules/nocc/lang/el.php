<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/lang/el.php,v 1.1 2006/01/13 13:39:07 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the Greek language
 * Translation by Spyros Ioakim <sioakim@ace-hellas.gr>
 */

$charset = 'ISO-8859-7';

// Configuration for the days and months

// What language to use
// see '/usr/share/locale/' for more information
$lang_locale = 'el_GR';

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

$err_user_empty = 'Το πεδίο όνομα λογαριασμού είναι άδειο';
$err_passwd_empty = 'Το πεδίο κωδικός είναι άδειο';


// html message

$alt_delete = 'Διαγραφή επιλεγμένων μηνυμάτων';
$alt_delete_one = 'Διαγραφή μηνύματος';
$alt_new_msg = 'Νέα μηνύματα';
$alt_reply = 'Απάντηση στον αποστολέα';
$alt_reply_all = 'Απάντηση σε όλους';
$alt_forward = 'Προώθηση';
$alt_next = 'Επόμενο μήνυμα';
$alt_prev = 'Προηγούμενο μήνυμα';
$html_on = 'on';
$html_theme = 'Θέμα';

// index.php

$html_lang = 'Γλώσσα';
$html_welcome = 'Καλώς ήρθατε στο';
$html_login = 'Ονομα λογαριασμού';
$html_passwd = 'Κωδικός';
$html_submit = 'Login';
$html_help = 'Βοήθεια';
$html_server = 'Διακομιστής';
$html_wrong = 'Το όνομα λογαριασμού ή ο κωδικός είναι λάθος';
$html_retry = 'Επανάληψη';

// Other pages

$html_view_header = 'Προβολή λεπτομερειών';
$html_remove_header = 'Απόκρυψη λεπτομερειών';
$html_inbox = 'Inbox';
$html_new_msg = 'Σύνθεση';
$html_reply = 'Απάντηση';
$html_reply_short = 'Re';
$html_reply_all = 'Απάντηση σε όλους';
$html_forward = 'Προώθηση';
$html_forward_short = 'Fw';
$html_delete = 'Διαγραφή';
$html_new = 'Νέο';
$html_mark = 'Διαγραφή';
$html_att = 'Συνημμένο';
$html_atts = 'Συνημμένα';
$html_att_unknown = '[άγνωστο]';
$html_attach = 'Επισύναψη';
$html_attach_forget = 'Πρέπει να συννάψετε το αρχείο πρίν στείλετε το μήνυμα !';
$html_attach_delete = 'Διαγραφή μαρκαρισμένων συνημμένων';
$html_from = 'Από';
$html_subject = 'Θέμα';
$html_date = 'Ημ/νία';
$html_sent = 'Αποστολή';
$html_size = 'Μέγεθος';
$html_totalsize = 'Συνολικό μέγεθος';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'Ονομα αρχείου';
$html_to = 'Πρός';
$html_cc = 'Αντίγραφο προς';
$html_bcc = 'Κρυφό Αντίγραφο προς';
$html_nosubject = 'Χωρίς Θέμα';
$html_send = 'Αποστολή';
$html_cancel = 'Ακυρο';
$html_no_mail = 'Δεν υπάρχουν μηνύματα.';
$html_logout = 'Εξοδος';
$html_msg = 'Μήνυμα';
$html_msgs = 'Μηνύματα';

$original_msg = '-- Πρωτότυπο Μήνυμα --';
$to_empty = 'Το πεδίο \'Πρός\' δεν πρέπει να είναι άδειο !';
?>