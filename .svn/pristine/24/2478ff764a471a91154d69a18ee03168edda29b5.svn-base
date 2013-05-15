<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org --- */
if (preg_match('/inc_passcheck_internchk.php/i',$_SERVER['PHP_SELF'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
if(isset($_COOKIE['ck_login_logged'.$sid])&&isset($_SESSION['sess_login_userid']))
{
    if(!empty($_COOKIE['ck_login_logged'.$sid])&&!empty($_SESSION['sess_login_userid'])&&(!isset($nointern)||!$nointern))
    {
        $userid=$_SESSION['sess_login_userid'];
        $checkintern=1;
        $lognote='Direct access '.$lognote;
        $pass='check';
    }
}
?>
