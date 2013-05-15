<?php
# This is a script to insert an admin access in the care2x users table
# The password will be md5 encrypted.
#
#  IMPORTANT! Do not leave this script in your installation once you are finished in inserting an admin access.
# IMPORTANT! Do not use this script in creating user accesses.
#
# How to use it:
# 1) Copy this script in the active server root directory of care2x
# 2) Type http://your_host_address/create_admin.php in your browser
# 3) Enter the needed information
# 4) Press "Create" button
# 5) DELETE THIS SCRIPT after creating the admin access. Otherwise, another person could create an admin permission for himself.
#
# Care2x will also refuse to run if this script is not deleted.

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require("./roots.php");
$sid='1'; # Dummy sid
require($root_path.'include/inc_environment_global.php');
$lang_tables[]='intramail.php';
$lang_tables[]='create_admin.php';
define('LANG_FILE','edp.php');
define('NO_CHAIN',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if(empty($lang)) $lang='en';

if(isset($_POST['mode'])&&!empty($_POST['mode'])&&$_POST['mode']=='save'){
	$error_msg='';
	if($pw1==$pw2){
		$sql="INSERT INTO care_users (name, login_id, password, permission, lockflag, exc,status,history, modify_id, modify_time, create_id,create_time)
				VALUES ('".addslashes($name)."','$username','".md5($pw1)."','System_Admin',0,1,'normal','Created by script ".date('Y-m-d H:i:s')."',
								'script',".date('YmdHis').",'script',".date('YmdHis').")";
		$db->BeginTrans();
        $ok=$db->Execute($sql);
        if($ok) {
            $db->CommitTrans();
			$error_msg=$LDAdminOk;
        } else {
	        $db->RollbackTrans();
			$error_msg=$LDLoginExists;
			echo $sql;
	    }

	}else{
		$error_msg=$LDErrorPassword;
	}
}else{
	$error_msg='newcreate';

}

require_once($root_path.'include/inc_charset_fx.php');
?>
<html>
<head>
<?php echo setCharSet($lang) ?>
<title></title>

<script language="">
<!-- Script Begin
function chkForm(d) {
	if(d.name.value==""||d.username.value==""||d.pw1.value==""||d.pw2.value=="") return false
		else return true;

}
//  Script End -->
</script>
</head>
<body>
<?php
if($error_msg=='newcreate'){
?>
<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td><font size=5 color=#800000 face="verdana,arial,helvetica"><?php echo $LDCreateAdmin ?></font></td>
   </tr>
 </table>

	</td>
  </tr>
</table>

<font size=4 color=#ff0000 face="verdana,arial,helvetica"><?php echo $LDDeleteWarning ?></font>

<table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td><font face="verdana,arial,helvetica">
<form onSubmit="return chkForm(this)" method=post>
<?php echo $LDName ?><br>
<input type="text" name="name" size=40 maxlength=60><br>
<?php echo $LDUserId ?><br>
<input type="text" name="username" size=40 maxlength=35><br>
<?php echo $LDPassword ?><br>
<input type="password" name="pw1" size=40 maxlength=255><br>
<?php echo $LDPassword ?><br>
<input type="password" name="pw2" size=40 maxlength=255><br>
<input type="submit" value="<?php echo $LDCreate ?>">
<input type="hidden" name="mode" value="save">
</form>
	</font>
	</td>
   </tr>
 </table>

	</td>
  </tr>
</table>

<?php
}else{
?>
	 <table border=0 bgcolor="#006600" width=100%>
  <tr>
    <td>
	<table border=0 bgcolor="#ffffff" width=100%>
   <tr>
     <td><font size=5 color=#ff0000 face="verdana,arial,helvetica"><?php echo $error_msg ?></font></td>
   </tr>
 </table>

	</td>
  </tr>
</table>
<?php
}
?>


</body>
</html>
