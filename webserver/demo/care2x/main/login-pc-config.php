<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_userconfig.php');
$user=new UserConfig;

//$db->debug=true;

if($user->getConfig($_COOKIE['ck_config'])){
	$config=&$user->getConfigData();
}else{
	$config=array();
}

/* Load the dept object */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept=new Department;
$depts=&$dept->getAllActive();

// Load the ward object and wards info 
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,ward_id,name'; // set the items to be fetched
$ward_info=&$ward_obj->getAllWardsItemsArray($items);


if(isset($mode)&&($mode=='save')){

	$config['thispc_dept_nr']=$_POST['thispc_dept_nr'];
	$config['thispc_ward_nr']=$_POST['thispc_ward_nr'];
	$config['thispc_room_nr']=$_POST['thispc_room_nr'];
	$config['thispc_phone']=$_POST['thispc_phone'];
	$config['thispc_intercom']=$_POST['thispc_intercom'];
	
	$user->saveConfig($_COOKIE['ck_config'],$config);
	
	header("location: login-pc-config.php?sid=$sid&lang=$lang&saved=1");
	exit;
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDLogin);

 # hide the return button
 $smarty->assign('pbBack',FALSE);

# href for the  help button
 $smarty->assign('pbHelp',"javascript:gethelp('login_config.php')");

 $smarty->assign('breakfile','startframe.php'.URL_APPEND);

 # Window bar title
 $smarty->assign('title',$LDLogin);

 # Body onLoad js code
 $smarty->assign('sOnLoadJs','onLoad="window.parent.STARTPAGE.location.href=\'indexframe.php'.URL_REDIRECT_APPEND.'\'"');

 #
 # Prepare the top message
 #
  $smarty->assign('gifMascot',createMascot($root_path,'mascot1_r.gif','0','bottom'));
  if ($saved){
  	$smarty->assign('sPromptText',$LDChangeSaved);
 }else{
 	$smarty->assign('sPromptText',$LDWelcome);
 	$smarty->assign('sUserName',$_SESSION['sess_login_username']);
 }

 #
 # Prepare the config form block
 #
 $smarty->assign('sFormParams','name="pcids"  method="post" action="login-pc-config.php"');
 $smarty->assign('LDPcID',$LDPcID);

 $smarty->assign('sDeptIcon','<img '.createComIcon($root_path,'home.gif').'>');
 $smarty->assign('LDDept',$LDDept);

 $smarty->assign('sWardIcon','<img '.createComIcon($root_path,'statbel2.gif').'>');
 $smarty->assign('LDWard',$LDWard);

 $smarty->assign('sWardORIcon','<img '.createComIcon($root_path,'button_info.gif').'>');
 $smarty->assign('sWardORValue',$config['thispc_room_nr']);
 $smarty->assign('LDWardOR',$LDWardOR);

 $smarty->assign('sPhoneNrIcon','<img '.createComIcon($root_path,'profile.gif').'>');
 $smarty->assign('sPhoneNrValue',$config['thispc_phone']);
 $smarty->assign('LDPhoneNr',$LDPhoneNr);

 $smarty->assign('sIntercomNrIcon','<img '.createComIcon($root_path,'listen-sm-legend.gif').'>');
 $smarty->assign('sIntercomNrValue',$config['thispc_intercom']);
 $smarty->assign('LDIntercomNr',$LDIntercomNr);

 $smarty->assign('sIPAddressIcon','<img '.createComIcon($root_path,'lightning.gif').'>');
 $smarty->assign('sIPAddress',$_SERVER['REMOTE_ADDR']);
 $smarty->assign('LDPcIP',$LDPcIP);

 #
 # Prepate the department selector element
 #
	$sTemp ='<select name="thispc_dept_nr"> <option value=""> </option>';

	if($depts&&is_array($depts)){
		while(list($x,$v)=each($depts)){
			$sTemp = $sTemp.'
				<option value="'.$v['nr'].'"';
			if($v['nr']==$config['thispc_dept_nr']) $sTemp = $sTemp.' selected';
			$sTemp = $sTemp.'>';
			if(isset($$v['LD_var'])&&$$v['LD_var']) $sTemp = $sTemp.$$v['LD_var'];
				else $sTemp = $sTemp.$v['name_formal'];
			$sTemp = $sTemp.'</option>';
		}
	}

 $sTemp = $sTemp.'</select>';
 $smarty->assign('sDeptSelect',$sTemp);
 
 #
 # Prepare the ward selector element
 #
 	$sTemp = '<select name="thispc_ward_nr"><option value=""> </option>';

	if($ward_info&&is_array($ward_info)){
		while(list($x,$v)=each($ward_info)){
			$sTemp = $sTemp.'
				<option value="'.$v['nr'].'"';
			if($v['nr']==$config['thispc_ward_nr']) $sTemp = $sTemp. ' selected';
			$sTemp = $sTemp.'>'.$v['name'].'</option>';
		}
	}
 $sTemp = $sTemp.'</select>';
 $smarty->assign('sWardSelect',$sTemp);

 #
 # Prepare the submit option buttons
 #

 $smarty->assign('sSubmitFormButton','<input type="submit" value="'.$LDSave.'">');
 $smarty->assign('sNoChangeButton','<input type="button" value="'.$LDNoChange.'" onClick="window.location.href=\'startframe.php'.URL_REDIRECT_APPEND.'\'">');
 $smarty->assign('sCancelButton','<a href="startframe.php'.URL_APPEND.'"><img '.createLDImgSrc($root_path,'close2.gif','0','top').'  alt="'.$LDClose.'"></a>');

 #
 # Prepare the hidden inputs
 #
 $smarty->assign('sHiddenInputs','<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="mode" value="save">');

 # Buffer page output
/*
 ob_start();

 $smarty->display('main/login_config.tpl');

?>

<ul>



<form name="pcids"  method="post" action="login-pc-config.php">
<TABLE cellSpacing=0 cellPadding=0  border=0  class="submenu_frame">
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=3  border=0>
              <TBODY class="submenu">
              <TR class="submenu_title">
                <TD colSpan=3><?php echo $LDPcID ?></TD></TR>
              <TR class="submenu"><td align=center><img <?php echo createComIcon($root_path,'home.gif') ?>></td>
                <TD vAlign=top ><B><nobr>

				<select name="thispc_dept_nr">
				<option value=""> </option>';
				<?php
					if($depts&&is_array($depts)){
						while(list($x,$v)=each($depts)){
							echo '
								<option value="'.$v['nr'].'"';
							if($v['nr']==$config['thispc_dept_nr']) echo ' selected';
							echo '>';
							if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
								else echo $v['name_formal'];
							echo '</option>';
						}
					}
				?>
				</select>
				  
				  </nobr></B></TD>
                <TD><nobr><?php echo $LDDept ?></nobr></TD>
              <TR class="vspace" height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR class="submenu"><td align=center><img <?php echo createComIcon($root_path,'statbel2.gif') ?>></td>
                <TD vAlign=top ><B><nobr>

				<select name="thispc_ward_nr">
				<option value=""> </option>';
				<?php
					if($ward_info&&is_array($ward_info)){
						while(list($x,$v)=each($ward_info)){
							echo '
								<option value="'.$v['nr'].'"';
							if($v['nr']==$config['thispc_ward_nr']) echo ' selected';
							echo '>'.$v['name'].'</option>';
						}
					}
				?>
				</select>

     			  </nobr></B></TD>
                <TD><nobr><?php echo $LDWard ?></nobr></TD>
              <TR class="vspace" height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
                <TR class="submenu"><td align=center><img <?php echo createComIcon($root_path,'button_info.gif') ?>></td>
                <TD vAlign=top ><B>
				 <input type="text" name="thispc_room_nr" size=20 maxlength=25 value="<?php echo $config['thispc_room_nr'] ?>">
				  </B></TD>
                <TD><?php echo $LDWardOR ?></TD></TR>
              <TR class="vspace" height=1>
                <TD colSpan=3><IMG height=1
                  src="../../gui/img/common/default/pixel.gif"
                  width=5></TD></TR>
              <TR class="submenu">  <td align=center><img <?php echo createComIcon($root_path,'profile.gif') ?>></td>
                <TD vAlign=top ><B>
				 <input type="text" name="thispc_phone" size=20 maxlength=25 value="<?php echo $config['thispc_phone'] ?>">
				  </B></TD>
                <TD><?php echo $LDPhoneNr ?></TD></TR>
              <TR class="vspace" height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR class="submenu">  <td align=center><img <?php echo createComIcon($root_path,'listen-sm-legend.gif') ?>></td>
                <TD vAlign=top ><B>
				 <input type="text" name="thispc_intercom" size=20 maxlength=25 value="<?php echo $config['thispc_intercom'] ?>">
				  </B></TD>
                <TD><?php echo $LDIntercomNr ?></TD></TR>
              <TR class="vspace" height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
              <TR class="submenu">  <td align=center><img <?php echo createComIcon($root_path,'lightning.gif') ?>></td>
                <TD vAlign=top ><B>
			 <?php echo $_SERVER['REMOTE_ADDR']; ?>
				  </B></TD>
                <TD><?php echo $LDPcIP ?></TD>
			</TR>
		</TBODY>
		</TABLE>
	</TD>
	</TR>
</TBODY>
</TABLE>
		<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="mode" value="save">
<input type="submit" value="<?php echo $LDSave ?>">
<input type="button" value="<?php echo $LDNoChange ?>" onClick="window.location.href='startframe.php?sid=<?php echo "$sid&lang=$lang" ?>'">&nbsp;<a href="startframe.php?sid=<?php echo "$sid&lang=$lang" ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','top') ?>  alt="<?php echo $LDClose ?>" ></a>
</form>
<p>
</ul>

<p>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sMainFrameBlockData',$sTemp);
*/
$smarty->assign('sMainBlockIncludeFile','main/login_config.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>
