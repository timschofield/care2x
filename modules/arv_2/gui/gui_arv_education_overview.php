<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Follow-up education</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--

.mainTable {
	margin-top:15px;
	margin-bottom:15px;
	width:764px;
	font-size:0.9em;
    margin-left:15px;
	font-family: Arial, Helvetica, sans-serif;
	border: 2px ridge black;
}
	
.mainTable td {
	padding-left:2px;
	background-color:#F0F8FF;
}

h1 {
	margin-left:15px;
	font-size:18px;
}

.mainTable th {
	font-size:14px;
	background-color:#99ccff;
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
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" > <img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> <img src="../../../gui/img/control/blue_aqua/en/en_printout.gif" alt="print" width="76" height="21" onClick="javascript:printOut('arv_education_overview.php<?php echo URL_APPEND.$add_breakfile ?>&mode=print')"> </td>
 </tr>
</table>


<h1>Follow-up education, Support and Preparation for ARV Therapy</h1>
<table width="588" class="mainTable" >
  
  <tr>
    <th bgcolor="#99ccff"><div align="center"><strong>Education on basics, prvention, disclosure </strong></div></th>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<th><div align=\"center\"><strong>Date /<br>comments &nbsp;</strong></div></th>";
	}
    ?>
  </tr>
  <tr>
    <td width="488"><strong>Basic HIV education, <br />
    transmission</strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Prevention: abstinence, safer sex, condoms </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Prevention: household precautions, what is safe </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Post-test counselling: implications of results </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Positive living </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Testing partners </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Disclosure</strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>To whom disclosed (list) </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Familiy/living sitution </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Shared confidentially </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Reproductive choices, prevention MTCT </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Child's blood test </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <th bgcolor="#99ccff"><div align="center"><strong>Progression, Rx </strong></div></th>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<th>&nbsp;</th>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td width="488"><strong>Progession of disease </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Available treatment/prophylaxis </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Follow-up appointments, care and treatment team </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>CTX, INH prophylaxis </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <th><div align="center"><strong>ARV preparation, initiation, support, monitor </strong></div></th>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<th>&nbsp;</th>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td width="488"><strong>ART - educate on essentials (locally adapted) </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>  
  <tr>
    <td><strong>Adherance preparation, indicate visits </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Indicate when READY for ART, DATE/ result<br />
    Care and treatment-team 
      discussion </strong></td>
	  <?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Explain dose, when to take </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>What can occur, how to manage side effects </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>What to do if one forgets dose </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>What to do when travelling </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Adherance plan (schedule, aids, explain diary) </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Treatment-supporter preparation </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Which doses, why missed </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <th><div align="center"><strong>Home-based care, support </strong></div></th>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<th>&nbsp;</th>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>ARV support group</strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td width="488"><strong>How to contact clinic </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Symptom management/palliative care at home </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Caregiver Booklet </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Home-based care-specify </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Support groups </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
  <tr>
    <td><strong>Community support </strong></td>
	<?php
	for($i=0; $i<$max_comments; $i++) {
		echo "<td>".$comments[$count][$i]."&nbsp;</td>";
	}
	$count++;
    ?>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
