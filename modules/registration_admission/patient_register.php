<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);

require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
#error reporting
error_reporting(-1); //Respect whatever is set in php.ini (sysadmin knows better??)
#Don't display errors
ini_set('display_errors',0);

$lang_tables[]='emr.php';
$lang_tables[]='person.php';
$lang_tables[]='date_time.php';
define('LANG_FILE','aufnahme.php');

$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
$db->debug=false;

$thisfile=basename($_SERVER['PHP_SELF']);
$default_filebreak=$root_path.'modules/news/start_page.php'.URL_APPEND;

if(empty($_SESSION['sess_path_referer']) || !file_exists($root_path.$_SESSION['sess_path_referer'])) {
    $breakfile=$default_filebreak;
} else {
    $breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
}

$_SESSION['sess_pid']=0;
if(!isset($insurance_show)) $insurance_show=true;

$newdata=1;
$target='entry';

# Start buffering the text above  the search block

ob_start();
require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
echo setCharSet();
?>

<TITLE><?php echo $LDPatientRegister ?></TITLE>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY bgcolor="<?php echo $cfg['bot_bgcolor'];?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="if (window.focus) window.focus();"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>
  <tr>
    <td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
      <FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG></FONT>
    </td>
    <td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
      <a href="javascript:gethelp('registration_overview.php','Person Registration :: Overview','<?php echo $error_person_exists; ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php
      echo $breakfile;  ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';?>></a>
    </td>
  </tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tz_tabs_patreg.php');
?>

  <tr>
    <td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor'];?>">
    <ul>

<?php

 $sTemp = ob_get_contents();
 ob_end_clean();

 chdir(dirname($_SERVER['SCRIPT_FILENAME']));

//require_once($root_path.'include/care_api_classes/class_gui_input_person.php');
require($root_path.'include/care_api_classes/class_gui_input_person.php');

$inperson = & new GuiInputPerson;

$inperson->setPID($pid);

$inperson->pretext = $sTemp;
$inperson->setDisplayFile('tz_patient_register_show.php');
$inperson->Display();

?>

</ul>

</FONT>
<p>
</td>
</tr>
</table>
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPatientSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
<a href="
<?php if($_COOKIE['ck_login_logged'.$sid]) echo $breakfile;
	else echo 'aufnahme_pass.php';
	echo URL_APPEND;
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
echo StdFooter();
?>