<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<title>ARV Overview</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.mainTable {
	border: 2px ridge black;
	margin-top: 15px;
	width:764px;
	margin-left:auto;
	margin-right:auto;
}

tr {
	height:23px;
}

td {
	padding-left:3px;
	padding-right:3px;
}

.blue {
	color: #330066;
	font-weight: bold;
}

.tablebackground {
	background-color:#F0F5FF;
}


-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
	function printOut(urlholder) {
		testprintout=window.open(urlholder,"printout","width=600px,height=800px,menubar=no,resizable=yes,scrollbars=yes");
	}
	
	function gethelp(x,s,x1,x2,x3,x4)
	{
		if (!x) x="";
		urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
		helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
		window.helpwin.moveTo(0,0);
	}

//-->
</script>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Patient ARV Data Overview</font>
       </td>

  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_overview.php','ARV :: Overview')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $o_arv_case->displayARVData();?>
<?php echo $o_arv_case->displayARVData2()?>
<?php
echo $o_arv_case->displayAllARVvisits();
?>

<p>&nbsp;</p>
</body>
</html>
