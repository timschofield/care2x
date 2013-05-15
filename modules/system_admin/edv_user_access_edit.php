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
$lang_tables[] = 'access.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_personell.php');
/**
* The following require loads the access areas that can be assigned for
* user permissions.
*/
require($root_path.'include/inc_accessplan_areas_functions.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

$edit=0;
$error=0;

if(!isset($mode)) $mode='';
if(!isset($errorname)) $errorname='';
if(!isset($erroruser)) $erroruser='';
if(!isset($username)) $username='';
if(!isset($userid)) $userid='';
if(!isset($errorpass)) $errorpass='';
if(!isset($pass)) $pass='';
if(!isset($errorbereich)) $errorbereich='';

$pers_obj = new Personell;


if($pass != '' && $mode == 'edit' )
{
	$pass = $_REQUEST['pass1'];
	$userid = $_REQUEST['userid'];
	$pers_obj->ResetPassword($userid,$pass);
}


if($mode!= ''){
    if($mode!='edit' && $mode!='update' && $mode!='data_saved'){
             /* Trim white spaces off */
         $username=trim($username);
         $userid=trim($userid);
         $pass=trim($pass);

         if($username=='') { $errorname=1; $error=1; }
         if($userid=='') { $erroruser=1; $error=1; }
         if($pass=='') { $errorpass=1; $error=1; }
    }


      if(($mode=='save' && !$error ) || ($mode=='update' && !$erroruser))
	  {

       /* Prepare the permission codes */
	     $p_areas='';

	     $sql="SELECT * FROM care_menu_main";
	     $result=$db->Execute($sql);

	     while(list($x,$v)=each($_POST))
	     {
           if(!ereg('_a_',$x)) continue;
           if($_POST[$x] != '') $p_areas.=$v.' ';
	     }

	     /* If permission area is available, save it */
	      if($p_areas != '')
	      {
	           if($mode=='save')
	           {

                   $sql="INSERT INTO care_users
						(
						   name,
						   login_id,
						   password,
						   permission,
						   personell_nr,
						   s_date,
						   s_time,
						   status,
						   modify_id,
						   create_id,
						   create_time
						 )
						 VALUES
						 (
						   '".addslashes($username)."',
						   '".addslashes($userid)."',
						   '".md5($pass)."',
						   '".$p_areas."',
						   '".$personell_nr."',
						   '".date('Y-m-d')."',
						   '".date('H:i:s')."',
						   'normal',
						   '',
						   '".$_SESSION['sess_user_name']."',
						   '".date('YmdHis')."'
						 )";

		       } else {
		            $sql="UPDATE care_users SET permission='$p_areas', modify_id='".$_COOKIE[$local_user.$sid]."'  WHERE login_id='$userid'";
		       }

			   /* Do the query */
			    $db->BeginTrans();
				$ok=$db->Execute($sql);
				//$ok=$db->Execute($sql2);
				if($ok&&$db->CommitTrans())
				{
					//echo $sql;
				      header('Location:edv_user_access_edit.php'.URL_REDIRECT_APPEND.'&userid='.strtr($userid,' ','+').'&mode=data_saved');
				      exit;
				}
				else
				{
				       $db->RollbackTrans();
			           if($mode!='save') $edit=1;
				       $mode='error_double';
				   	   //echo "$sql $LDDbNoSave";
				}
			}
			else
			{
			  if($mode!='save') $edit=1;
			  $mode='error_noareas';
			} // end if ($p_areas!="")


	    }// end of if($mode=="save"

	    if($mode=='edit' || $mode=='data_saved' || $edit) {

		    $sql1="SELECT name, login_id, permission FROM care_users WHERE login_id='$userid'";

		    if($ergebnis1=$db->Execute($sql1)) {

			    if($ergebnis1->RecordCount()) {

			        $user=$ergebnis1->FetchRow();
			        $edit=1;
			    }

            }



	    }
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDManageAccess);

 # href for return button
 $smarty->assign('pbBack',$returnfile);

# href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('edp.php','access','$mode')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDManageAccess);

 # Buffer page output

 ob_start();

?>

<ul>

<?php
 //if ($mode=='data_saved' || $error ||  $mode=='error_noareas' || $mode=='data_nosave' )

if (($mode!='' || $error ) && $mode!='edit' ){

?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>
    <td class="warnprompt">
	<?php
	          if ($error) echo  $LDInputError;
			     elseif ($mode=='data_saved') echo $LDUserInfoSaved;
				   elseif($mode=='error_save') echo $LDUserInfoNoSave;
				     elseif($mode=='error_noareas') echo $LDNoAreas;
				       elseif($mode=='error_double') echo $LDUserDouble;
	 ?></td>
  </tr>
</table>
<?php
}
?>

<FONT class="prompt">

<?php

if(($mode=="")and($remark!='fromlist'))
{
$gtime=date('H.i');
if ($gtime<'9.00') echo $LDGoodMorning;
if (($gtime>'9.00')and($gtime<'18.00')) echo $LDGoodDay;
if ($gtime>'18.00') echo $LDGoodEvening;
echo ' '.$_COOKIE[$local_user.$sid];
}
?>

<p>
<FORM action="edv_user_access_list.php" name="all">

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="submit" name=message value="<?php echo $LDListActual ?>">

</FORM>
<p>
</FONT>

<form method="post" action="edv_user_access_edit.php" name="user">

<input type="image"  <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>>

<?php
if($mode=='data_saved' || $edit)
{
 echo '<input type="button" value="'.$LDEnterNewUser.'" onClick="javascript:window.location.href=\'edv_user_access_edit.php'.URL_REDIRECT_APPEND.'&remark=fromlist\'">';
 echo '<input type="button" value="Change Password" onClick="javascript:window.location.href=\'edv_user_password_edit.php'.URL_REDIRECT_APPEND.'&userid='.$userid.'\'">';
}
?>
<input type="button" value="<?php echo $LDFindEmployee; ?>" onClick="javascript:window.location.href='edv_user_search_employee.php<?php echo URL_REDIRECT_APPEND; ?>&remark=fromlist'">

<table border=0 bgcolor="#000000" cellpadding=0 cellspacing=0>
  <tr>
    <td>

	<table border="0" cellpadding="5" cellspacing="1">

<tr bgcolor="#dddddd">
<td colspan="3">
<?php echo $LDNewAccess ?>:
</td>
</tr>

<tr bgcolor="#dddddd">
<td>
<input type=hidden name=route value=validroute>


<?php if ($errorname) {echo "<font color=red > <b>$LDName</b>";}
else { echo $LDName;} ?>

<?php

 if($edit)
 {
    echo '<input type="hidden" name="username" value="'.$user['name'].'">'.'<b>'.$user['name'].'</b>';
 }
  elseif(isset($is_employee)&&$is_employee)
  {
 ?>
<input name="username" type="hidden"
<?php
	if ($username!="") echo ' value="'.$username.'"><br><b>'.$username.'</b>';
		else ?> > <?php ;

}else{
?>

<input name="username" type="text" <?php if ($username!="") echo ' value="'.$username.'"'; ?>>
<?php
}
?>

<br>
</td>
<td>
<?php if ($erroruser) {echo "<font color=red > <b>$LDUserId</b>";}
else { echo $LDUserId;} ?>

<?php

 if($edit) echo '<input type="hidden" name="userid" value="'.$user['login_id'].'">'.'<b>'.$user['login_id'].'</b>';
  else
  {
 ?>
<input type=text name="userid"
<?php if ($userid!="") echo 'value="'.$userid.'"'; ?>>
<?php
}
?>

<br>
</td>
<td>
<?php if ($errorpass) {echo "<font color=red > <b>$LDPassword</b>";}
else { echo $LDPassword;} ?>

<?php

 if($edit) echo '<input type="hidden" name="pass" value="*">****';
 else
  {
 ?>
<input type="password" name="pass" <?php if ($pass!="") echo "value=".$pass ; ?>>

<?php
}
?>

<br>
</td>
</tr>

<tr bgcolor="#dddddd">
<td  colspan=3>
<?php if ($errorbereich) {echo "<font color=red > <b>$LDAllowedArea</b> </font>";}
else { echo $LDAllowedArea;} ?>
</td>
</tr>


<tr bgcolor="#dddddd">
<td  colspan=3>

<table border=0 cellspacing=0 width=100%>

<!--  The list of the permissible areas are displayed here  -->

<?php


/* Loop through the elements of the access area tags */
while (list($x,$v)=each($area_opt))
{

   echo '<tr  bgcolor="white">';

   if (eregi('title',$x))  // If title print it out
   {
      echo ' <td  valign=top bgcolor="#81eff5" colspan=5><FONT  SIZE=2  FACE="Arial">'.$v.'</td>';
   }
   else
   {
	   // get the colum index
	   $cindex=substr($x,3,1);

	   // extract the actual index name

	   //$x_name=substr($x,strpos($x,'x')+1);


	   switch($cindex)
	   {
	      case 0: echo '
		                      <td  valign=top colspan=5><img  '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '>';
							  echo $v.'</td>';

			          break;
	      case 1: echo '
		                      <td><img src="p.gif" width=15></td><td  valign=top colspan=4><img src="tl2-blue.gif" border=0 width=20 height=21 align="absmiddle"><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '>';
							  echo $v.'</td>';

			          break;
	      case 2: echo '
		                      <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=3><img src="tl2-blue.gif" border=0 width=20 height=21 align="absmiddle"><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '>';
							  echo $v.'</td>';

			          break;
	      case 3: echo '
		                       <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=2><img src="tl2-blue.gif" border=0 width=20 height=21 align="absmiddle"><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '>';
							  echo $v.'</td>';

			          break;
	      case 4: echo '
		                       <td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td><img src="p.gif" width=15><td  valign=top colspan=1><img src="tl2-blue.gif" border=0 width=20 height=21 align="absmiddle"><input type="checkbox" name="'.$x.'" value="'.$x.'" ';
							  if($edit && strstr($user['permission'],$x)) echo 'checked ><FONT    SIZE=2  FACE="Arial" color="#ff0000">';
							     else echo '>';
							  echo $v.'</td>';

			          break;
	   }
	 }

  echo '
  </tr>';
}

?>

</table>

</td>
</tr>

<tr bgcolor="#dddddd">
<td colspan=3>
<p>
<input type="hidden" name="personell_nr" value="<?php echo $personell_nr; ?>">
<input type="hidden" name="itemname" value="<?php echo $itemname ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="<?php if($edit || $mode=='data_saved' || $mode=='edit') echo 'update'; else echo 'save'; ?>">
<input type="image"  <?php echo createLDImgSrc($root_path,'savedisc.gif','0','absmiddle') ?>>
<!-- <input type="reset"  value="<?php echo $LDReset ?>"> -->
</td>
</tr>
</table>

	</td>
  </tr>
</table>

</form>

<p>
<a href="<?php echo $breakfile ?>" ><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancel ?>" align="middle"></a>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
