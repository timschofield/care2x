<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/get_img.php,v 1.1 2006/01/13 13:39:03 irroal Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

session_register ('user', 'passwd');
require ('conf.php');

$pop = imap_open('{'.$servr.'}INBOX', $user, stripslashes($passwd));
$img = imap_fetchbody($pop, $mail, $num);
imap_close($pop);
if ($transfer == 'BASE64')
	$img = base64_decode($img);
elseif ($transfer == 'QUOTED-PRINTABLE')
	$img = imap_qprint($img);

header('Content-type: image/'.$mime);
echo $img;
?>