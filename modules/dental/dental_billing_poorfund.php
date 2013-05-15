<style type="text/css">
<!--
.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
body {
	margin-left: 0px;
	margin-top: 0px;
}
.billing{border:1px solid blue; background:maroon; padding: 5px 17px 5px 17px; color:white; font:bold 11px Tahoma, Monospace;}
a.billing{text-decoration:none;}
.billing:hover{border:1px solid black; background: white; color:black;}
-->
</style>
<form name="form1" method="get" action="../dental/dental_billing_.php">
  <table width="289"  border="0" cellspacing="1" cellpadding="4">
    <tr bgcolor="#999999">
      <td height="36" colspan="2"><div align="center"><span class="style5">SPECIAL BILLING </span></div></td>
    </tr>
    <tr>
      <td nowrap bgcolor="#BED0BB"><div align="right"><span class="style3">Case Type: </span></div></td>
      <td width="197" bgcolor="#E2EAE1">

      <select name="type" style="width:180px; border:0px; ">
          <option value="staff">Staff Member</option>
          <option value="other" selected>Poor Fund Program</option>
        </select></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#BED0BB" class="style3">Paid:</td>
      <td bgcolor="#E2EAE1">
      <input name="pay" type="text" id="pay">
      </td>
    </tr>
    <tr align="center" valign="top" bgcolor="#E2EAE1">
      <td colspan="2">

	  <input name="submit" title="Click here to Save" class="billing" type="submit" id="submit" value="Save Billing &raquo;">
	  <input name="Cancel" type="button" id="Cancel" value="Cancel" onClick="javascript:window.location.href='../dental/dental_billing_.php'">

    </tr>
  </table>

	<input type='hidden' name = 'encounter' id = 'encounter' value='<?php echo $_GET['encounter'] ?>' ?>
	<input type='hidden' name = 'total' id = 'encounter' value='<?php echo $_GET['total'] ?>' ?>
	<input type='hidden' name = 'bachno' id = 'encounter' value='<?php echo $_GET['bachno'] ?>' ?>
	<input type='hidden' name = 'billno' id = 'encounter' value='<?php echo $_GET['billno'] ?>' ?>
</form>

