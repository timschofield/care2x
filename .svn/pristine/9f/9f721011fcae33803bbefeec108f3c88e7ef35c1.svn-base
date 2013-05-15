<?php
/**
* Change log: 2004-07-29
* Alternate menu tree selection system was integrated.
*
* Set the default menu tree directory name here.
* Version >= 2.0.2 only "default" or "dtree". If empty or non-existing path, defaults to "default".
*/
$DefaultMenuTreeDir = 'default';

//$cfg['mainmenu_tree'] = 'dtree';

#
# Load the menu tree. Make intelligent checks. Defaults to "default" directory if nothing works.
#
if(isset($cfg['mainmenu_tree']) && !empty($cfg['mainmenu_tree']) && file_exists('menu/'.$cfg['mainmenu_tree'] .'/mainmenu.inc.php')){
	$LocMenuTreeDir = $cfg['mainmenu_tree'];
}else{
	$GlobMenuTreeDir = $gc->getConfig('theme_mainmenu_tree');
	if(!empty($GlobMenuTreeDir) && file_exists('menu/'.$GlobMenuTreeDir .'/mainmenu.inc.php')){
		$LocMenuTreeDir = $GlobMenuTreeDir;
	}elseif(!empty($DefaultMenuTreeDir) && file_exists('menu/'.$DefaultMenuTreeDir .'/mainmenu.inc.php')){
		$LocMenuTreeDir = $DefaultMenuTreeDir;
	}else{
		$LocMenuTreeDir = 'default';
	}
}
?>

<?php html_rtl($lang);  ?>
<HEAD>
<?php echo $charset; ?>
<TITLE><?php echo $wintitle; ?></TITLE>
<?php
//set the css style for a links
//require($root_path.'include/inc_css_a_sublinker_d.php');
echo '<link href="'.$root_path.'/css/indexframe.css" rel="stylesheet" type="text/css">';
?>

<script language="javascript">
function changeLanguage(lang)
{
    <?php if(($cfg['mask']==1)||($cfg['mask']=="")||$mask==1||$mask=='')  echo "window.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1&_chg_lang_=1\");";
	 else echo "window.opener.top.location.replace(\"../index.php?lang=\"+lang+\"&mask=$cfg[mask]&sid=$sid&egal=1\");";
	 ?>

	return false;
}
function checkIfChanged(lang)
{
	if(lang=="<?php echo $lang; ?>") return false;
		else changeLanguage(lang);
}
</script>
</HEAD>

 <?php
 # Prepare values for body template
if($boot || $_chg_lang_){
	 $TP_js_onload= 'onLoad="if (window.focus) window.focus();window.parent.CONTENTS.location.replace(\'startframe.php?sid='.$sid.'&lang='.$lang.'&egal='.$egal.'&cookie='.$cookie.'\');"';
}else{
	$TP_js_onload='onLoad="if (window.focus) window.focus();"';
}

$TP_bgcolor='bgcolor="'.$cfg['idx_bgcolor'].'"';

if(!$cfg['dhtml']){
	 $TP_link='link="'.$cfg['idx_txtcolor'].'"';
	 $TP_vlink='vlink="'.$cfg['idx_txtcolor'].'"';
	 $TP_alink='alink="'.$cfg['idx_alink'].'"';
}else{
	 $TP_link='';
	 $TP_vlink='';
	 $TP_alink='';
}


$TP_logo=createLogo($root_path,'care_logo_'.$dbtype.'.gif','0');

$tp_body=&$TP_obj->load('tp_main_index_menu_body.htm');
eval("echo $tp_body;");

#
# Generate the menu tree
#
//require("menu/$LocMenuTreeDir/mainmenu.inc.php");
require("./menu/dtree/mainmenu.inc.php");


?>

<TABLE CELLPADDING=0 CELLSPACING=0 border=0>

<?php


//echo $_COOKIE['ck_config']; // used only in debugging related to user config data
//echo $GLOBALCONFIG['language_single']."<br>";
if($GLOBALCONFIG['language_single']<>1){

?>
<tr>
<td colspan=3>
<FONT SIZE="1" face="arial,verdana">
<form action="#" onSubmit="return checkIfChanged(this.lang.value)">
<hr>
<?php echo $LDLanguage ?><br>
 <select name="lang">
<?php

//require($root_path.'include/care_api_classes/class_language.php');
//$lang_obj=new Language;
//$langselect= $lang_obj->createSelectForm($lang);
//echo $langselect;
?>
</select>
<br>
<input type="submit" value="<?php echo $LDChange ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="mask" value="<?php echo $mask ?>">
<input type="hidden" name="egal" value="1">
<input type="hidden" name="_chg_lang_" value="1">
<hr>
</FONT>
</td>
</tr>
<?php
}
?>

<tr >
<td colspan=3>
<br>
<nobr><b><?php echo $LDUser ?>:</b></nobr>
<?php

$name = $_SESSION['sess_login_username'];

echo $name;


?><br><br><br>

<font size="-2">Ver.<?php echo $version;?></font><br>
<br>
</td>
</tr>
</form>
</TABLE>
<center>
<!--<a href="http://www.opensource.org/" target="_blank"><img src="<?php echo $root_path ?>gui/img/common/default/osilogo.gif" border=0></a>-->
</center>
</BODY>
</HTML>
