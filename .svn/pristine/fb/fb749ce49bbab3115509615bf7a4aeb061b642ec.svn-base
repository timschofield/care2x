<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('roots.php');
require($root_path.'include/inc_environment_global.php');

/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/

define('LANG_FILE','doctor_rooms.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer']="";
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
$HTTP_SESSION_VARS['sess_user_origin']='amb';
$HTTP_SESSION_VARS['sess_parent_mod']='';

require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,name';
$ward_info=&$ward_obj->getAllWardsItemsObject($items);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<style type="text/css">
<!--
.botline {border-bottom:3px solid #66FF66;}
-->
</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
	<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
		<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
			<STRONG>
			&nbsp;&nbsp;&nbsp;<?php echo $LDRooms; ?>
			</STRONG>
		</FONT>
	</td>
	<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align='right' style='padding-top:5px;'>
		<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dental.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr align="left" valign=bottom>
    <td height="10" colspan="2" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" class="botline">
      &nbsp; </td>
</tr>

<tr  valign=top>
    <td colspan="5">
      <!--    here is the forms are start   -->

      <!--    here is the form ends   -->
    </td>
  </tr>
<tr>

<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>
</table>
</body>
</html>
