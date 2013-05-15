<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Patients Overview</title>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<script language="JavaScript" type="text/JavaScript">
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
	
	h1 {
		color:black;
		margin-bottom:50px;
		font-size:26px;
	}
	
	.maintable {
		margin-top:15px;
		margin-left:15px;
		margin-bottom:15px;
		width:764px;
		border-collapse: collapse;
	}
	
	.error {
		color:black;
		font-weight:bold;
		font-size:18px;
		border: 3px solid red;
		width:370px;
		padding:5px;
		margin:15px;
	}
	
	.timeframe {
		margin-top:20px;
		margin-left:15px;
		color:black;
		font-weight: bold;
		margin-bottom:15px;
	}
	
	.tableheading {
		font-weight: bold;
		font-size:12px;
		background-color:#99ccff;
	}
	
	.tableheading_center {
		font-weight: bold;
		font-size:12px;
		text-align:center;
	}
	
	th {
		border: 1px solid #535353;
		background-color:#99ccff;
		padding-left:7px;
		padding-right:7px;
	}
	
	.maintable td {
		border: 1px solid #535353;
		padding-left:10px;
		padding-right:10px;
	}
	
	.mainTable td {
		padding-left:10px;
		padding-right:10px;
		border: 1px solid #535353;
		text-align:center;
	}
	
-->
</style>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >

    &nbsp;&nbsp;<font color="#330066">Patients Overview</font>
       </td>
   
  <td bgcolor="#99ccff" align=right>
   <a href="javascript:this.window.print();"><img src="../../gui/img/control/blue_aqua/en/en_printout.gif" border=0 width="76" height="21" alt=""></a>
   <a href="javascript:gethelp('arv_reporting_overview.php','Patients Overview')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND; ?>" >
   <img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>

<form method="get" action="" name="select_form">
	<div class="timeframe">
	Month
	<select name="month" size="1">
		<option <?php if ($_GET['month']==1) echo "selected=\"selected\"";?> value="1">Jan</option>
		<option <?php if ($_GET['month']==2) echo "selected=\"selected\"";?> value="2">Feb</option>
		<option <?php if ($_GET['month']==3) echo "selected=\"selected\"";?> value="3">March</option>
		<option <?php if ($_GET['month']==4) echo "selected=\"selected\"";?> value="4">April</option>
		<option <?php if ($_GET['month']==5) echo "selected=\"selected\"";?> value="5">May</option>
		<option <?php if ($_GET['month']==6) echo "selected=\"selected\"";?> value="6">Jun</option>
		<option <?php if ($_GET['month']==7) echo "selected=\"selected\"";?> value="7">Jul</option>
		<option <?php if ($_GET['month']==8) echo "selected=\"selected\"";?> value="8">Aug</option>
		<option <?php if ($_GET['month']==9) echo "selected=\"selected\"";?> value="9">Sept</option>
		<option <?php if ($_GET['month']==10) echo "selected=\"selected\"";?> value="10">Oct</option>
		<option <?php if ($_GET['month']==11) echo "selected=\"selected\"";?> value="11">Nov</option>
		<option <?php if ($_GET['month']==12) echo "selected=\"selected\"";?> value="12">Dez</option>
	</select>
	Year
	<select name="year" size="1"/>
		<option <?php if ($_GET['year']==$curr_year) echo "selected=\"selected\"";?> value="<?php echo $curr_year?>"> <?php echo $curr_year;?></option>
		<option <?php if ($_GET['year']==$curr_year-1) echo "selected=\"selected\"";?> value="<?php echo $curr_year-1;?>"> <?php echo $curr_year-1;?></option>
		<option <?php if ($_GET['year']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-2;?>"> <?php echo $curr_year-2;?></option>
	</select>
	<input type="submit" name="submit" value="show" />
	</div>
</form>
<?php if($arv_report->ok) : 
	echo $arv_report->display_list();
	else :$arv_report->getMessages();
endif;
?>
</body>
</html