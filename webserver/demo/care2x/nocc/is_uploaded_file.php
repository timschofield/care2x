<?php 
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/is_uploaded_file.php,v 1.1 2006/01/13 13:42:51 irroal Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Function is_uploaded_file in case PHP < 4.0.2 is used
 */

function is_uploaded_file($filename)
{
	if (!$tmp_file = ini_get('upload_tmp_dir'))
		$tmp_file = dirname(tempnam('', ''));
    $tmp_file .= '/' . basename($filename);
    return (ereg_replace('/+', '/', $tmp_file) == $filename);
}
?>