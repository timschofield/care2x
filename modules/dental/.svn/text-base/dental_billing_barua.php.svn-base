<?php

	$bachno = $_GET['bachno'];
	$paid =  $_GET['paid'];
	$totalpaid = $_GET['total'];
	$encounter_nr = $_GET['encounter'];

	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');

	require($root_path.'include/inc_environment_global.php');
	include_once($root_path.'include/care_api_classes/class_mini_dental.php');

	$person_obj= new dental;

	$names = $person_obj->GetNamesFromBatchNo($bachno);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Dental Department (Special Billing)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<style type="text/css">
<!--

#gentext{font:normal 12px Tahoma, Monospace; color:black;}

.mainheader{font:bold 14px Tahoma, Monospace; color:black; text-transform:uppercase; text-align:center; padding:10px 0px 5px 0px;}
.headtext{text-transform:uppercase; font-weight:bold; text-align:left; font:bold 12px Tahoma, Monospace;}
.headline{
	font:bold 12px Tahoma, Monospace;
	border-bottom:2px solid black;
	padding:8px 0px 3px 0px;
	text-transform:uppercase;
	text-align:center;
	}

.solidline{	border-bottom:1px solid black;}
.dottedline{border-bottom:1px dotted black;}

#linehheight{line-height:20px;}

.footer{border-top:3px double black; padding:5px 0px 9px 0px; text-align:center;}
body {
	margin: 0px;
}

.btn{border:1px solid blue; width:150px; padding:4px; font:normal 11px Tahoma,Monospace; background:#ffffcc; color:black;}
a.btn{text-decoration:none;}
.btn:hover{border:1px solid maroon; background:black; color:#ffffcc;}
-->
</style>

<script language="JavaScript" type="text/JavaScript">
<!--
function hideme() {
  	document.getElementById("prnt").innerHTML='&nbsp;';
	javascript:window.print();
}
//-->
</script>

<body>
<div id="prnt">
	<div id= "xb" style="width:100%; border:3px double black; margin-bottom:20px; padding:8px; background:silver; text-align:center;">

		<input class="btn" type="button" value="Print This &raquo;" name="button" onclick="hideme();">

	</div>
</div>

<table width="600" border="0" align="center" cellpadding="4" cellspacing="1" id="gentext">
  <tr>
    <td height="59" align="left" valign="top"><table width="590"  border="0" cellpadding="0" cellspacing="1">
      <tr align="left" valign="top">
        <td width="85" rowspan="2" align="center" valign="middle"><img name="" src="../../gui/img/common/default/selian.gif" alt="Hospital Logo"></td>
        <td colspan="2" valign="middle" class="mainheader">dodoma christian medical center, trust </td>
        </tr>
      <tr>
        <td width="307" align="left" valign="top">P.O BOX 658<br>
          DODOMA TANZANIA </td>
        <td width="194" align="right" valign="top">Phone: 026 232 1051<br>
          0757 204 466<br>
          Fax: 026 232 1048<br>
          Web: www.dcmc.or.tz</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" align="left" valign="middle" class="headline">dental department</td>
  </tr>
  <tr>
    <td height="27" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="34" align="left" valign="top" class="headtext">fomu ya msaada wa matibabu katika clinick ya meno dcmc </td>
  </tr>
  <tr>
    <td align="left" valign="top" id="linehheight"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2">Kutokana na kuwa na uwezo mdogo/sina fedha kwa ajili ya kufanyiwa matibabu</td>
        </tr>
      <tr>
        <td width="5%">mimi</td>
        <td width="95%" class="solidline" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;<?php echo $names ?>&nbsp;</td>
      </tr>
    </table>
      <table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="5%">&nbsp;</td>
          <td colspan="2">Ninaomba kutibiwa na fedha niliyonayo kiasi cha Tsh.</td>
          <td width="18%" class="solidline" style="font-weight:bold;"><?php echo intval($paid); ?>.00&nbsp;</td>
          <td width="28%">kulingana na gharama halisi ya</td>
        </tr>
        <tr>
          <td>Tsh:</td>
          <td width="20%" class="solidline" style="font-weight:bold;"><?php echo intval($total); ?>.00&nbsp;</td>
          <td colspan="3"> kama alivyonishauri Daktari. Hivyo basi, msaada wa matibabu ni</td>
        </tr>
        <tr>
          <td>Tsh:</td>
          <td class="solidline" style="font-weight:bold;"><?php $remain = intval($total-$paid); echo intval($remain); ?>.00&nbsp;</td>
          <td width="29%">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>      </td>
  </tr>
  <tr>
    <td height="40" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="89" align="left" valign="top">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="21%">Anuani yangu Halisi ni</td>
          <td width="79%" class="solidline" id="linehheight">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="solidline" id="linehheight">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td class="solidline" id="linehheight">&nbsp;</td>
        </tr>
      </table>    </td>
  </tr>
  <tr>
    <td height="41" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">Ninadhibitisha kuwa nimepatiwa matibabu hayo. </td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top"><table width="63%"  border="0" cellpadding="0" cellspacing="0" id="linehheight">
      <tr>
        <td width="23%" nowrap>Sahihi ya Mgonjwa: </td>
        <td width="77%" class="dottedline">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="63%"  border="0" cellpadding="0" cellspacing="0" id="linehheight">
      <tr>
        <td width="8%">Tarehe:</td>
        <td width="92%" class="dottedline" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;<?php echo date('D - d/m/Y'); ?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="63%"  border="0" cellpadding="0" cellspacing="0" id="linehheight">
      <tr>
        <td width="16%" nowrap>Sahihi ya Dactari: </td>
        <td width="84%" class="dottedline">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="63%"  border="0" cellpadding="0" cellspacing="0" id="linehheight">
      <tr>
        <td width="8%">Tarehe:</td>
        <td width="92%" class="dottedline" style="font-weight:bold;">&nbsp;&nbsp;&nbsp;<?php echo date('D-d/m/Y'); ?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="88" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="footer">All correspondences should be made to the Project Director


    <br /><br />

    &nbsp;</td>
  </tr>
</table>
</body>
</html>
