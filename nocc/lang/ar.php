<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/lang/ar.php,v 1.1 2006/01/13 13:42:52 irroal Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Configuration file for the arabic language
 * Translation by Mohamed Hadrouj <mohamed.hadrouj@wanadoo.co.ma>
 */

$charset = 'UTF-8';

// Configuration for the days and months


// What language to use
// see '/usr/share/locale/' for more information
$lang_locale = 'ar_AR';

// Text Alignment
// Can be right-to-left (rtl) which is needed for proper Arabic, Hebrew
// Or left-to-right (ltr) which is default for most languages
$lang_dir = 'rtl';

// What format string should we pass to strftime() for messages sent on
// days other than today?
$default_date_format = '%A %d %B %Y';

// If the local is not implemented on the host, how we display the date
$no_locale_date_format = '%d-%m-%Y';

// What format string should we pass to strftime() for messages sent
// today?
$default_time_format = '%H:%M';


// Here is the configuration for the HTML

$err_user_empty = 'ءاسم المستخدم غير صحيح  ';
$err_passwd_empty = ' كلمة السر غير صحيحة. أعد المحاولة';


// html message

$alt_delete = 'ءازالة  الرسا ئل المختارة ';
$alt_delete_one = 'ءازالة الرسالة' ;
$alt_new_msg = 'رسالة جديدة';
$alt_reply = 'ءاجاابة المرسل ';
$alt_reply_all = 'ءاجاابة للجميع';
$alt_forward = 'تحويل ';
$alt_next = 'التالية';
$alt_prev = 'السابقة';


// index.php

$html_lang = 'اللغة';
$html_welcome = ' مرحبا بكم في ';
$html_login = 'المستخدم';
$html_passwd = 'كلمة السر';
$html_submit = 'ءارسال';
$html_help = 'مساعدة';
$html_server = 'Server';
$html_wrong = 'ءأسم المستخدم أو كلمة السر غير صحيحة ';
$html_retry = 'أعد المحاولة';
$html_on = 'on';
$html_theme = 'Theme';

// Other pages

$html_view_header = 'المقدمة';
$html_remove_header = 'ءاخفاء المقدمة';
$html_inbox = 'صندوق الرسائل';
$html_new_msg = 'رسالة جديدة';
$html_reply = 'ءاجابة';
$html_reply_short = 'رد';
$html_reply_all = 'ءاجابة للكل';
$html_forward = 'تحويل الرسالة ءالى';
$html_forward_short = 'Tr';
$html_delete = 'ءازالة';
$html_new = 'جديد';
$html_mark = 'محو';
$html_att = 'ملف مرفق';
$html_atts = 'ملفات مرفقة';
$html_att_unknown = '[غير معروف]';
$html_attach = 'ءاضافة';
$html_attach_forget = '!يجب ءاضافة الملف قبل ءارسال الرسالة ';
$html_attach_delete = 'ءازالة الملفات المختارة';
$html_from = 'من';
$html_subject = 'الموضوع';
$html_date = 'التاريخ';
$html_sent = 'مرسل';
$html_size = 'الحجم';
$html_totalsize = 'الحجم الكلي';
$html_kb = 'Ko';
$html_bytes = 'octets';
$html_filename = 'ملف';
$html_to = 'ءالى';
$html_cc = 'نسخة';
$html_bcc = 'نسخة مختبأة';
$html_nosubject = 'بدون موضوع';
$html_send = 'أرسل';
$html_cancel = 'ءالغاء';
$html_no_mail = 'ليست هناك أية رسالة';
$html_logout = 'ءانهاء الاءرتباط';
$html_msg = 'رسالة';
$html_msgs = 'رسائل';
$html_configuration = 'This server is not well set up !';

$original_msg = '--  الرسالة الأصلية  --';
$to_empty = 'يجب ءاعطاء عنوان المرسل ءاليه !';
?>