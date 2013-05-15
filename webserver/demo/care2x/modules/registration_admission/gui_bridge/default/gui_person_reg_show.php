<?php
# Loads the standard gui tags for the registration display page
require('./gui_bridge/default/gui_std_tags.php');

echo StdHeader();
echo setCharSet(); 
?>
 <TITLE><?php echo $LDPatientRegister ?></TITLE>

<script  language="javascript">
<!-- 

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>

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
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo $LDPatientRegister ?></STRONG> <font size=+2>(<?php echo ($pid) ?>)</font></FONT>
</td>

<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('person_admit.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php 
if($_COOKIE["ck_login_logged".$sid]) echo "startframe.php?sid=".$sid."&lang=".$lang; 
	else echo $breakfile."?sid=$sid&target=entry&lang=$lang"; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
</td>
</tr>

<?php
/* Create the tabs */
$tab_bot_line='#66ee66';
require('./gui_bridge/default/gui_tabs_patreg.php');
?>

<tr>
<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

	<!-- table container for the data display block -->
	<table cellspacing=0 cellpadding="0">
	<tbody>
	<tr valign="top">
		<td>
		<?php
		
		# Display the data
		$person->display();

		?>
		</td>
		<td>
		<?php

		# Load and display the options table
		require('./gui_bridge/default/gui_patient_reg_options.php');

		?>
		</td>
	</tr>
	</tbody>
	</table>

<p>

<?php if (!$newdata) { ?>

<?php
	 if($target=="search") $newsearchfile='patient_register_search.php'.URL_APPEND;
    	else $newsearchfile='patient_register_archive.php'.URL_APPEND;
?>
<a href="<?php echo $newsearchfile ?>"><img
<?php echo createLDImgSrc($root_path,'new_search.gif','0','absmiddle') ?>></a>
<?php 
} 
?>
<a href="patient_register.php<?php echo URL_APPEND ?>&pid=<?php echo $pid ?>&update=1"><img
<?php echo createLDImgSrc($root_path,'update_data.gif','0','absmiddle') ?>></a>
<?php
# If currently admitted show button link to admission data display
if($current_encounter){
?>
<a href="aufnahme_daten_zeigen.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $current_encounter ?>&origin=patreg_reg"><img <?php echo createLDImgSrc($root_path,'admission_data.gif','0','absmiddle') ?>></a>
<?php
# Else if person still living, show button links to admission
}elseif(!$death_date||$death_date==$dbf_nodate){
?>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=1"><img <?php echo createLDImgSrc($root_path,'admit_inpatient.gif','0','absmiddle') ?>></a>
<a href="<?php echo $admissionfile ?>&pid=<?php echo $pid ?>&origin=patreg_reg&encounter_class_nr=2"><img <?php echo createLDImgSrc($root_path,'admit_outpatient.gif','0','absmiddle') ?>></a>
<?php
}
?>

<form action="patient_register.php" method=post>
<input type=submit value="<?php echo $LDRegisterNewPerson ?>" >
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
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
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_search.php<?php echo URL_APPEND; ?>"><?php echo $LDPersonSearch ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="patient_register_archive.php<?php echo URL_APPEND; ?>&newdata=1&from=entry"><?php echo $LDArchive ?></a><br>

<p>
<a href="
<?php if($_COOKIE['ck_login_logged'.$sid]) echo $root_path.'main/startframe.php'.URL_APPEND;
	else echo $breakfile.URL_APPEND;
	
?>
"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
<?php
StdFooter();
?>
