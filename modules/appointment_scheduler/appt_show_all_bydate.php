<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.05 - 2003-06-22
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php');
define('LANG_FILE','aufnahme.php');
//define('NO_2LEVEL_CHK',1);
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');

if(!isset($currDay)||!$currDay) $currDay=date('d');
if(!isset($currMonth)||!$currMonth) $currMonth=date('m');
if(!isset($currYear)||!$currYear) $currYear=date('Y');
if(isset($_SESSION['sess_parent_mod'])) $_SESSION['sess_parent_mod']='';

$thisfile=basename($_SERVER['PHP_SELF']);
$editorfile=$root_path.'modules/registration_admission/show_appointment.php';
require_once($root_path.'include/care_api_classes/class_appointment.php');
$appt_obj=new Appointment();

if(!isset($mode)){
	$mode='show';
}elseif($mode=='appt_cancel'&&!empty($nr)){
	if($appt_obj->cancelAppointment($nr,$reason,$_SESSION['sess_user_name'])){
		header("location:$thisfile".URL_REDIRECT_APPEND."&currYear=$currYear&currMonth=$currMonth&currDay=$currDay");
		exit;
	}else{
		echo "$appt_obj->sql<br>$LDDbNoUpdate";
	}
}
if($mode=='show'){
	$result=&$appt_obj->getAllByDateObj($currYear,$currMonth,$currDay);
}
$_SESSION['sess_parent_mod']='';
/* Load departments */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$deptarray=$dept_obj->getAllMedical('name_formal');
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: none; }
	A:active {text-decoration: none;}
	A:visited {text-decoration: none;}
</style>

<script language="javascript">
<!--
  var urlholder;
function popinfo(l,d)
{
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;

	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}

-->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
</HEAD>
<BODY  bgcolor="silver" alink="navy" vlink="navy" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDAppointments"; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr>
<td bgcolor="<?php echo $cfg['body_bgcolor']; ?>" colspan=2>

<?php
/*generate the calendar */
include($root_path.'classes/calendar_jl/class.calendar.php');
/** CREATE CALENDAR OBJECT **/
$Calendar = new Calendar;
/** WRITE CALENDAR **/
$Calendar -> mkCalendar ($currYear, $currMonth, $currDay);

/* show the appointments */
if($appt_obj->count){
	include('./gui_bridge/default/gui_show_appointment.php');
}else{
?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','absmiddle') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo ((date('Y-m-d'))==$currYear.'-'.$currMonth.'-'.$currDay) ? $LDNoPendingApptToday : $LDNoPendingApptThisDay; ?></b></font></td>
  </tr>
</table>
<?php
}
?>

<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>">
</a></FONT>
<p>
</td>
</tr>
</table>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</BODY>
</HTML>
