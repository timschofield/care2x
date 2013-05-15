<?php

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


<table width=100% border=0 cellspacing="0"  cellpadding=0 >

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+1  FACE="Arial"><STRONG> &nbsp;<?php echo "$LDPersonnelManagement :: $LDPersonData" ?></STRONG> (<?php echo $pid ?>)</FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('employee_show.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
 echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_personell_reg.php');
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

<FONT    SIZE=-1  FACE="Arial">


<?php

	require_once($root_path.'include/care_api_classes/class_gui_person_show.php');
	$person = new GuiPersonShow;
	$person->setPID($pid);
	$person->display();

?>

<p>

<?php if (!$newdata) { ?>

<?php if($target=="search") $newsearchfile='personell_search.php'.URL_APPEND.'&target=personell_search';
    else $newsearchfile='personell_register_search.php'.URL_APPEND.'&target=person_reg';
?>
<a href="<?php echo $newsearchfile ?>"><img 
<?php echo createLDImgSrc($root_path,'new_search.gif','0','absmiddle') ?>></a>
<?php } ?>
<a href="person_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&update=1"><img 
<?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>></a>
<?php
if(isset($current_employ)&&$current_employ){
?>
<a href="personell_register_show.php<?php echo URL_APPEND ?>&personell_nr=<?php echo $current_employ ?>&target=personell_reg"><img <?php echo createLDImgSrc($root_path,'employment_data.gif','0','absmiddle') ?>></a>
<?php
}else{
?>
<a href="personell_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&target=personell_reg"><img <?php echo createLDImgSrc($root_path,'add_employ.gif','0','absmiddle') ?>></a>

<?php
}
?>
<form action="person_register.php" method=post>
<input type=submit value="<?php echo $LDNewForm ?>" >
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="target" value="person_reg">
</form>

<p>
</ul>

</FONT>
<p>
</td>
</tr>
</table>        
<p>
<ul>
<FONT    SIZE=2  FACE="Arial">
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="personell_search.php<?php echo URL_APPEND; ?>"><?php echo $LDSearchPersonell ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>
 
<p>
-->
<a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>

<p>
</ul>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
