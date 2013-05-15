<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>cStatistics</title>
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
	.timeframe {
		margin-top:20px;
		margin-left:15px;
		color:black;
		font-weight: bold;
		margin-bottom:15px;
	}
	
	legend {
		font-weight: bold;
		font-size:17px;
		color:black;
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
	
	fieldset {
		border:2px dotted blue;
		margin-bottom:15px;
		margin-top:20px;
		margin-left:15px;
		margin-right:15px;
		background-color:#ECF5FF;
	}
	
	.mainTable {
		border-collapse: collapse;
		margin-top:20px;
		background-color:white;
		margin-left:5px;
		
	}
	
	.mainTable td {
		padding-left:10px;
		padding-right:10px;
		border: 1px solid #535353;
		text-align:center;
	}
	
	th {
		border: 1px solid #535353;
		background-color:#99ccff;
		padding-left:10px;
		padding-right:10px;
	}
-->
</style>
</head>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >

    &nbsp;&nbsp;<font color="#330066">C-Statistics-Patients</font>
       </td>

  <td bgcolor="#99ccff" align=right>
   <a href="javascript:this.window.print();"> <img src="../../gui/img/control/blue_aqua/en/en_printout.gif" border=0 width="76" height="21" alt=""></a>
   <a href="javascript:gethelp('arv_reporting_cstatistics.php','C-Statistics-Patients')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt=""></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND; ?>" >
   <img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<body>
<form method="get" action="" name="select_form">
	<div class="timeframe">
		Year
		<select name="year_start" size="1"/>
			<option <?php if ($_GET['year_start']==$curr_year) echo "selected=\"selected\"";?> value="<?php echo $curr_year?>"> <?php echo $curr_year;?></option>
			<option <?php if ($_GET['year_start']==$curr_year-1) echo "selected=\"selected\"";?> value="<?php echo $curr_year-1;?>"> <?php echo $curr_year-1;?></option>
			<option <?php if ($_GET['year_start']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-2;?>"> <?php echo $curr_year-2;?></option>
			<option <?php if ($_GET['year_start']==$curr_year-3) echo "selected=\"selected\"";?> value="<?php echo $curr_year-3;?>"> <?php echo $curr_year-3;?></option>
		</select>
		Year
		<select name="year_end" size="1"/>
			<option <?php if ($_GET['year_end']==$curr_year) echo "selected=\"selected\"";?> value="<?php echo $curr_year?>"> <?php echo $curr_year;?></option>
			<option <?php if ($_GET['year_end']==$curr_year-1) echo "selected=\"selected\"";?> value="<?php echo $curr_year-1;?>"> <?php echo $curr_year-1;?></option>
			<option <?php if ($_GET['year_end']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-2;?>"> <?php echo $curr_year-2;?></option>
			<option <?php if ($_GET['year_end']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-3;?>"> <?php echo $curr_year-3;?></option>
		</select>
		<input type="submit" name="submit" value="show" />
	</div>
</form>
<?php if($arv_report->ok) : ?>
 <fieldset>
    <legend><b>1. All Patients ever enrolled</b></legend>
  	<?php 
  			echo $arv_report->display_a(1); 
  			echo $arv_report->display_b(1);
  			echo $arv_report->display_c(1);
  	?>
  </fieldset>
  <fieldset>
    <legend><b>2. Ever enrolled on ART</b></legend>
  	<?php 
  			echo $arv_report->display_a(2); 
  			echo $arv_report->display_b(2);
  			echo $arv_report->display_c(2);
  	?>
  </fieldset>
  <fieldset>
    <legend><b>3. Currently Active(remaining) on ART Patients</b></legend>
  	<?php 
  			echo $arv_report->display_a(3); 
  			echo $arv_report->display_b(3);
  			echo $arv_report->display_c(3);
  	?>
  </fieldset>
  </fieldset>
  <fieldset>
    <legend><b>4. All active ARV patient-Currently Active on ARVs by regimen minus EXITED</b></legend>
    <?php 
  			echo $arv_report->display_d(4); 
  			echo $arv_report->display_e(4);
  	?>
  </fieldset>
   <fieldset>
    <legend><b>5. Total of those  enroll who EXIT</b></legend>
  	<?php 
  			echo $arv_report->display_d(5); 
  			echo $arv_report->display_e(5);
  	?>
  </fieldset>
<?php else :
$arv_report->getMessages();
endif;?>
</body>
</html>