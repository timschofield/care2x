<?php
/**
* This is the default menu tree file.
* This file is included by the /main/gui_bridge/gui_indexframe.php script. This will not run alone.
* Revision for version > 2.0.1 to accomodate the alternative menu tree system
* Elpidio Latorilla 2004-07-29
*/

#
# Get the menu items
#

$sql="SELECT nr,sort_nr,name,LD_var AS \"LD_var\",url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$result=$db->Execute($sql);


if($result){
	echo '<table CELLPADDING=0 CELLSPACING=0 border=0>';
	$gui='';
	$TP_img1= '<img '.createComIcon($root_path,'blue_bullet.gif','0','middle').'>';
	$TP_com_img_path=$root_path.'gui/img/common';
	$buf='';
	# Load the menu item template
	$tp =&$TP_obj->load('tp_main_index_menu_item.htm');
	while($menu=$result->FetchRow()){
		/* Deactivated because of laggy login-detection
		if (eregi('LDLogin',$menu['LD_var'])){
			if ($_COOKIE['ck_login_logged'.$sid]=='true'){
				$menu['url']='main/logout_confirm.php';
				$menu['LD_var']='LDLogout';
			}
		}
		*/
		$TP_menu_item='<a href="'.$root_path.$menu['url'].URL_APPEND.'" TARGET="CONTENTS" REL="child">';
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) $TP_menu_item.=$$menu['LD_var'];
			else $TP_menu_item.=$menu['name'];
		$TP_menu_item.='</A>';
		eval("echo $tp;");
	}
	echo $gui ;

	echo '</table>';
}
?>
