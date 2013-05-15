<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','help.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>

<head>
<?php echo setCharSet(); ?>
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo $root_path; ?>/css/themes/default/help.css">
</head>
<body onLoad="if (window.focus) window.focus()">

<?php
$lang="en";
# Resolve the help file to include


if($helpidx=='') {
	if(file_exists('../help/'.$lang.'/help_'.$lang.'_main.php')){
		include('../help/'.$lang.'/help_'.$lang.'_main.php');
	}else{
		include('../help/en/help_en_main.php');
	}  
}else{
	if(file_exists('../help/'.$lang.'/help_'.$lang.'_'.$helpidx)){
		include('../help/'.$lang.'/help_'.$lang.'_'.$helpidx);
	}else{
	     if(file_exists('../help/en/help_en_'.$helpidx)) include('../help/en/help_en_'.$helpidx);
             else include('../help/en/help_en_main.php');  
	}
}
?>
<hr>

<ul>

<img src="<?php echo $root_path?>gui/img/control/default/en/en_close2.gif" alt="<?php echo $LDCloseHelpWin ?>" onclick="javascript:window.parent.close()">

</ul>

</body>
</html>
