<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/lang/pt.php,v 1.1 2006/01/13 13:39:10 irroal Exp $ 
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the portuguese language
 * Translation by sena <sena@smux.net>
 */

$charset = 'ISO-8859-1';

// Configuration for the days and months

// What language to use
// see '/usr/share/locale/' for more information
$lang_locale = 'pt_PT';

// Text Alignment
// Can be right-to-left (rtl) which is needed for proper Arabic, Hebrew
// Or left-to-right (ltr) which is default for most languages
$lang_dir = 'ltr';

// What format string should we pass to strftime() for messages sent on
// days other than today?
$default_date_format = '%d/%m/%Y'; 

// If the local is not implemented on the host, how we display the date
$no_locale_date_format = '%d/%m/%Y';

// What format string should we pass to strftime() for messages sent
// today?
$default_time_format = '%I:%M %p';


// Here is the configuration for the HTML

$err_user_empty = 'O login n&atilde;o foi preenchido';
$err_passwd_empty = 'A password n&atilde;o foi preenchida';


// html message

$alt_delete = 'Apagar as mensagens seleccionadas';
$alt_delete_one = 'Apagar a mensagem';
$alt_new_msg = 'Mensagens novas';
$alt_reply = 'Responder ao autor';
$alt_reply_all = 'Responder a todos';
$alt_forward = 'Forward';
$alt_next = 'Pr&oacute;xima';
$alt_prev = 'Anterior';


// index.php

$html_lang = 'L&iacute;ngua';
$html_welcome = 'Benvindo ao';
$html_login = 'Login';
$html_passwd = 'Password';
$html_submit = 'Entrar';
$html_help = 'Ajuda';
$html_server = 'Servidor';
$html_wrong = 'Login ou password incorrecto';
$html_retry = 'Tentar de novo';
$html_on = 'em';
$html_theme = 'Tema';

// Other pages

$html_view_header = 'Ver cabe&ccedil;alhos';
$html_remove_header = 'Esconder cabe&ccedil;alhos';
$html_inbox = 'Inbox';
$html_new_msg = 'Escrever';
$html_reply = 'Responder';
$html_reply_short = 'Re';
$html_reply_all = 'Responder a todos';
$html_forward = 'Forward';
$html_forward_short = 'Fw';
$html_delete = 'Apagar';
$html_new = 'Nova';
$html_mark = 'Apagar';
$html_att = 'Attachment';
$html_atts = 'Attachments';
$html_att_unknown = '[desconhecido]';
$html_attach = 'Attach';
$html_attach_forget = 'Tem de fazer o attach antes de enviar a mensagem !';
$html_attach_delete = 'Retirar Ficheiros Seleccionados';
$html_from = 'De';
$html_subject = 'Assunto';
$html_date = 'Data';
$html_sent = 'Enviar';
$html_size = 'Tamanho';
$html_totalsize = 'Tamanho Total';
$html_kb = 'Kb';
$html_bytes = 'bytes';
$html_filename = 'Ficheiro';
$html_to = 'Para';
$html_cc = 'Cc';
$html_bcc = 'Bcc';
$html_nosubject = 'Sem assunto';
$html_send = 'Enviar';
$html_cancel = 'Cancelar';
$html_no_mail = 'N&atilde;o h&aacute; mensagens novas.';
$html_logout = 'Sa&iacute;r';
$html_msg = 'Mensagem';
$html_msgs = 'Mensagens';
$html_configuration = 'This server is not well set up !';

$original_msg = '-- Mensagem Original --';
$to_empty = 'O campo \'Para\' tem de ser preenchido !';
?>