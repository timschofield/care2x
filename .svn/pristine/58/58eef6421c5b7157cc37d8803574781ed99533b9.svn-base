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

$lang_tables[]='nursing.php';
define('LANG_FILE','inpatient.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer']="";
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);
$_SESSION['sess_user_origin']='amb';
$_SESSION['sess_parent_mod']='';

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

<script language="javascript">
<!-- Script Begin
function goWard(t) {
	d=document.dept_select;
	if(d.current_ward_nr.value!=""){
		d.ward_nr.value=d.current_ward_nr.value;
		d.action=t;
		d.submit();
	}
}
//  Script End -->
</script>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG><?php echo $LDInpatient ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('ambulatory.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<ul>

<?php
# Prepare select options
$TP_SELECT_BLOCK.='<select name="current_ward_nr">';
					if(!empty($ward_info)&&$ward_info->RecordCount()){
						while($station=$ward_info->FetchRow()){
							$TP_SELECT_BLOCK.='
								<option value="'.$station['nr'].'" ';
							if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) $TP_SELECT_BLOCK.='selected';
							$TP_SELECT_BLOCK.='>'.$station['name'].'</option>';
						}
					}
					$TP_SELECT_BLOCK.='</select>';

# hidden
$TP_HINPUTS='<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="ntid" value="'.$ntid.'">
   			<input type="hidden" name="rt" value="pflege">
   			<input type="hidden" name="edit" value="1">
   			<input type="hidden" name="station" value="">
   			<input type="hidden" name="location_id" value="">
   			<input type="hidden" name="ward_nr" value="">';




$TP_CANCEL_BUT='<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').'  alt="'.$LDCloseAlt.'" align="middle"></a>';

# Start GUI Output
echo '

<table border=0 cellpadding=10>
  <tr>
    <td colspan=2>
	<TABLE cellSpacing=0 cellPadding=0 width=600 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3 width=600 bgColor=#999999
            border=0>
              <TBODY>
			 <!-- Be careful in moving the form tag -->
  			<form name="dept_select" method="post" action="">
              <TR bgColor=#dddddd>
                <TD colSpan=3 bgColor=#dddddd >
				'.$TP_SELECT_BLOCK.'
				<img src="'.$TP_ROOT_PATH.'/gui/img/common/default/l-arrowgrnlrg.gif" border=0 width=16 height=16>
				<FONT face="Verdana,Helvetica,Arial" size=2><b>
				'.$LDSelectWard.'
				</b>
				'.$TP_HIDDENS	.'
				</TD>
				</TR>

              <TR bgColor=#eeeeee><td align=center><img src="'.$TP_ROOT_PATH.'/gui/img/common/default/icon-date-hour.gif"></td>
                <TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
			 	<a href="javascript:goWard(\'../nursing/nursing-station-pass.php\')">'.$LDOccupancy.'</a>
				  </B></FONT>
				  </TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2>
				  '.$LDOccupancyTxt.'
				  </FONT>
				  </TD>
				  </TR>

		';

 /* 05-02-25: Not necessary for Selian

              <TR bgColor=#eeeeee><td align=center><img src="$TP_ROOT_PATH/gui/img/common/default/forums.gif"></td>
                <TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
			 	$TP_HREF_PWL1
				  </B></FONT></TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2>
				  $LDPWListTxt
				  </FONT>
				  </TD>
				  </TR>

echo '
             <TR bgColor=#eeeeee><td align=center><img src="'.$TP_ROOT_PATH.'/gui/img/common/default/waiting.gif"></td>
                <TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
				'.$LDPendingRequest.'
				  </B></FONT>
				  </TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2>
				  '.$LDPendingRequestTxt.'
				  </FONT>
				  </TD>
				  </TR>

';
 /* 05-02-25: Not necessary for Selian

             <TR bgColor=#eeeeee><td align=center><img src="$TP_ROOT_PATH/gui/img/common/default/bubble2.gif"></td>
                <TD vAlign=top ><FONT face="Verdana,Helvetica,Arial" size=2><B>
			 	$TP_HREF_NEWS1
				  </B></FONT>
				  </TD>
                <TD><FONT face="Verdana,Helvetica,Arial" size=2>
				  $LDNewsTxt
				  </FONT>
				  </TD>
				  </TR>

*/

echo			$TP_HINPUTS.'
			</form>
		</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
	</td>
  </tr>


</table>'.
$TP_CANCEL_BUT;
?>



</ul>
</FONT>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>
&nbsp;
</FONT>
</BODY>
</HTML>
