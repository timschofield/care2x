<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@latorilla.com
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$breakfile='nursing.php?sid='.$sid.'&lang='.$lang;

if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$t_date=$pday.'.'.$pmonth.'.'.$pyear;

$dept_obj=new Department;

$deptarray=$dept_obj->getAll();
$depttypes=$dept_obj->getTypes();

$dept=$dept_obj->getDeptAllInfo($dept_nr);
while(list($x,$v)=each($dept)) $$x=$v;

$dept_info=$dept_obj->getTypeInfo($dept['type']);
?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="formstyle">
td.pblock{ font-family: verdana,arial; font-size: 12}

div.box { border: solid; border-width: thin; width: 100% }

div.pcont{ margin-left: 3; }

</style>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp; <?php echo "$LDCreate $LDDept" ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('nursing_ward_mng.php','new')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php if($rows) : ?>

<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"><font face="Verdana, Arial" size=3 color="#880000">
<b><?php echo str_replace("~station~",strtoupper($station),$LDStationExists) ?></b></font><p>
<?php endif; ?>
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<form action="dept_new.php" method="post" name="newstat">
<table border=0>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Formal name<?php echo $LDStation ?>: </td>
    <td class=pblock><?php echo $name_formal ?><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Internal ID code<?php echo $LDStation ?>: </td>
    <td class=pblock><?php echo $id ?><br>
</td>
  </tr> 

<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Type of <?php echo $LDDept ?>: </td>
    <td class=pblock>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Description<?php echo $LDDescription ?>: </td>
    <td class=pblock><textarea name="description" cols=40 rows=4 wrap="physical"><?php echo $description ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Is department a sub-department?<?php echo $LDStation ?>: </td>
    <td class=pblock>	<input type="radio" name="is_sub_dept" value="1"> Yes <input type="radio" name="is_sub_dept" value="0" checked> No
</td>
  </tr> 
<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Parent <?php echo $LDDept ?>: </td>
    <td class=pblock><select name="parent_dept_nr">
	<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$parent_dept_nr) echo 'selected';
			echo ' >'.$v['name_formal'].'</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Language variable ID<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="LD_var" size=40 maxlength=40 value="<?php echo $LD_var ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Short Name<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="name_short" size=40 maxlength=40 value="<?php echo $name_short ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Alternate Name<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="name_alternate" size=40 maxlength=40 value="<?php echo $name_alternate ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Admits inpatients ?<?php echo $LDStation ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_inpatient" value="1" checked> Yes <input type="radio" name="admit_inpatient" value="0"> No
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Admits outpatients ?<?php echo $LDStation ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_outpatient" value="1" checked> Yes <input type="radio" name="admit_outpatient" value="0"> No
</td>
  </tr> 

    <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font>Belongs to this institution ?<?php echo $LDStation ?>: </td>
    <td class=pblock>	<input type="radio" name="this_institution" value="1" checked> Yes <input type="radio" name="this_institution" value="0"> No
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Work hours<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="work_hours" size=40 maxlength=40 value="<?php echo $work_hours ?>"><br>
</td>
  </tr> 

  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Consultation hours<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="consult_hours" size=40 maxlength=40 value="<?php echo $consult_hours ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Signature line<?php echo $LDStation ?>: </td>
    <td class=pblock><input type="text" name="sig_line" size=40 maxlength=40 value="<?php echo $sig_line ?>"><br>
</td>
  </tr> 
 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Department Stamp Text<?php echo $LDDescription ?>: </td>
    <td class=pblock><textarea name="sig_stamp" cols=40 rows=4 wrap="physical"><?php echo $sig_stamp ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">Department Logo<?php echo $LDDeptLogo ?>: </td>
    <td class=pblock><input type="file" name="logo_file" ><br>
</td>
  </tr> 

 
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDCreate.' '.$LDDept; ?>">
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>
</FONT>

</ul>

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
