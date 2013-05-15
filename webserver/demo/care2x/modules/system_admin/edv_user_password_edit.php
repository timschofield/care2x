<script type="text/javascript">

function chkFormular () {
  if (document.Form.pass1.value != document.Form.pass2.value) {
    	alert("Wrong Password!");
    return false;
  }
  if (document.Form.pass1.value =='' || document.Form.pass2.value =='' ) {
  		alert("Wrong Password");
  	return false;
  }

}

function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?lang=en&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">

<table width=100% border=0 cellspacing=0 height=100%>
	<tbody class="main">
		<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Change Password</font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="edv_user_access_edit.php?ntid=false&lang=en"><img src="../../gui/img/control/blue_aqua/en/en_back2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('edp.php','access','edit')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="edv-system-admi-welcome.php?ntid=false&lang=en" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
 </table>
<br><br>

 <?php
		$userid = $_GET["userid"];
		$append = 'mode=edit&userid='.$userid.'';
?>

<br><br>
<form name="Form" action="<?php echo 'edv_user_access_edit.php?'.$append.''; ?>" method="post" onsubmit="return chkFormular()">
  <table border=1 cellpadding="0" cellspacing="0" bgcolor="#dddddd">
  	<tr>
  		<td colspan=2 align=center>
 <?php
		echo 'User: '.$userid.'';
?>

  		</td>
  	</tr>
    <tr>
      <td>Password:</td><td><input type="password" size="30" name="pass1"><br></td>
    </tr>
    <tr>
      <td>Password Confirm:</td><td><input type="password" size="30" name="pass2"><br></td>
    </tr>
    <tr>
    <td colspan=2 align=center>
    	<input type="submit" value="Save"><input type="reset" value="Reset">
    	</td>
    </tr>
  </table>
</form>



