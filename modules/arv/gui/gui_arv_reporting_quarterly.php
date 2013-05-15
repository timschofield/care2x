<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Quarterly Faciliy Based HIV CARE/ART Reporting Form</title>
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
	body {
		background-color:#ECF5FF;	
	}
	
	h1 {
		color:black;
		margin-bottom:50px;
		font-size:26px;
		margin-left:15px;
		font-family: Arial, Helvetica, sans-serif;
	}
	
	.mainTable {
		margin-top:15px;
		margin-bottom:15px;
		width:764px;
		font-size:0.9em;
		border-collapse: collapse;
        background-color:white;
        margin-left:15px;
		font-family: Arial, Helvetica, sans-serif;
	}
	
	.mainTable td {
		border:1px solid black;
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
	}
	
	.tableheading_center {
		font-weight: bold;
		font-size:12px;
		text-align:center;
	}
-->
</style>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >

    &nbsp;&nbsp;<font color="#330066">ART Reporting Form</font>
       </td>
   
  <td bgcolor="#99ccff" align=right>
   <a href="javascript:this.window.print();"><img src="../../gui/img/control/blue_aqua/en/en_printout.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="javascript:gethelp('arv_reporting_quarterly.php','Quarterly, Facility-Based HIV Care/ART Reporting Form')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND; ?>" >
   <img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<form method="get" action="" name="select_form">
	<h1>Quarterly, Facility-Based HIV Care/ART Reporting Form</h1>																
	<div class="timeframe">
		Quarter
		<select name="quarter" size="1">
			<option <?php if ($_GET['quarter']==1) echo "selected=\"selected\"";?> value="1">Jan-March</option>
			<option <?php if ($_GET['quarter']==4) echo "selected=\"selected\"";?> value="4">April-June</option>
			<option <?php if ($_GET['quarter']==7) echo "selected=\"selected\"";?> value="7">Jul-Sept</option>
			<option <?php if ($_GET['quarter']==10) echo "selected=\"selected\"";?> value="10">Oct-Dec</option>
		</select>
		Year
		<select name="year" size="1"/>
			<option <?php if ($_GET['year']==$curr_year) echo "selected=\"selected\"";?> value="<?php echo $curr_year?>"> <?php echo $curr_year;?></option>
			<option <?php if ($_GET['year']==$curr_year-1) echo "selected=\"selected\"";?> value="<?php echo $curr_year-1;?>"> <?php echo $curr_year-1;?></option>
			<option <?php if ($_GET['year']==$curr_year-2) echo "selected=\"selected\"";?> value="<?php echo $curr_year-2;?>"> <?php echo $curr_year-2;?></option>
		</select>
		<input type="submit" name="submit" value="show" />
	</div>
<?php if($arv_report->ok) : ?>
<table class="mainTable">
  <tr>
    <td width="484">Date    facility began receiving support from PEPFAR (mm/dd/yy):&nbsp;</td>
    <td width="344"></td>
  </tr>
  <tr>
    <td>Quarter    beginning (mm/dd/yy): <?php echo date("Y-m-d",$start_month_timestamp); ?></td>
    <td>Quarter ending (mm/dd/yy): <?php echo date("Y-m-d",$end_month_timestamp); ?></td>
  </tr>
  <tr>
    <td>Grantee:</td>
    <td>Facility: <?php echo $arr_facility['main_info_facility_name']?></td>
  </tr>
</table>
<table border="0" class="mainTable" cellspacing="0">
  <td colspan="9" class="tableheading"><span class="Stil6">1. HIV Palliative Care (non-ART and ART care)</span></td>
  </tr>
  <tr>
    <td></td>
    <td width="12.5%" colspan="2"><span class="Stil6">Cumulative number enrolled in HIV care by the    beginning of quarter</span></td>
    <td width="12.5%" colspan="2"><span class="Stil6">NEW enrollees in HIV care during the quarter</span></td>
    <td width="12.5%" colspan="2"><span class="Stil6">Cumulative    number enrolled in HIV care by the end of the quarter</span></td>
    <td rowspan="6" bgcolor="#CCCCCC"></td>
    <td><span class="Stil6">Total number who received HIV care during the    quarter</span></td>
  </tr>
  <tr>
    <td width="20%"><span class="Stil6">1. Males (0-14 years)</span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[1][1] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[2][1]?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[3][1]?></span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][1] ?></span></td>
  </tr>
  <tr>
    <td><span class="Stil6">2. Males (15+    years)</span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[1][2] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[2][2] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[3][2] ?></span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][2] ?></span></td>
  </tr>
  <tr>
    <td><span class="Stil6">3. Females    (0-14 years)</span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[1][3] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[2][3] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[3][3] ?></span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][3] ?></span></td>
  </tr>
  <tr>
    <td><span class="Stil6">4. Females    (15+ years)</span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[1][4] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[2][4] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[3][4] ?></span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][4] ?></span></td>
  </tr>
  <tr>
    <td><span class="Stil6">Total</span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[1][5] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[2][5] ?></span></td>
    <td colspan="2"><span class="Stil6"><?php echo $arr_r1[3][5] ?></span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][5] ?></span></td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
    <td bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td colspan="7"><span class="Stil7"></span></td>
    <td><span class="Stil6">Number in HIV care    during the quarter &amp; eligible for ART, but NOT started ART by the end of    the quarter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (subset of    1uu.)</span></td>
    <td><span class="Stil6"><?php echo $arr_r1[4][6] ?></span></td>
  </tr>
</table>

<table border="1" class="mainTable" cellspacing="0">
  <tr>
    <td colspan="12" class="tableheading">2. ART Care&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="12.5%" colspan="2">Cumulative number started on ART by the    beginning of the quarter</td>
    <td width="12.5%" colspan="2">Number started on ART in program during the    quarter (includes NEW and TRANSFERS)</td>
    <td width="12.5%" colspan="2">Cumulative    number started on ART by the end of the quarter</td>
    <td rowspan="6" bgcolor="#CCCCCC"></td>
    <td width="12.5%">Number NEW on ART during the quarter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (subset of 2g-2k)</td>
    <td width="12.5%">Number    on ART who TRANSFERRED in&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    during the quarter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    (subset of 2g-2k)</td>
    <td rowspan="6" bgcolor="#CCCCCC"></td>
    <td width="12.5%">Total number on ART at the end of the quarter (CURRENT)</td>
  </tr>
  <tr>
    <td width="25%">1. Males (0-14 years)</td>
    <td colspan="2"><?php echo $arr_r2[1][1] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][1] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][1] ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo $arr_r2[4][1] ?></td>
  </tr>
  <tr>
    <td>2. Males (15+    years)</td>
    <td colspan="2"><?php echo $arr_r2[1][2] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][2] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][2] ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo $arr_r2[4][2] ?></td>
  </tr>
  <tr>
    <td>3. Females    (0-14 years)</td>
    <td colspan="2"><?php echo $arr_r2[1][3] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][3] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][3] ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo $arr_r2[4][3] ?></td>
  </tr>
  <tr>
    <td>4. Females    (15+ years)</td>
    <td colspan="2"><?php echo $arr_r2[1][4] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][4] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][4] ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo $arr_r2[4][4] ?></td>
  </tr>
  <tr>
    <td>Total</td>
    <td colspan="2"><?php echo $arr_r2[1][5] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][5] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][5] ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td><?php echo $arr_r2[4][5] ?></td>
  </tr>
  <tr>
    <td colspan="12" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td>5. Pregnant    females (subset of total)</td>
    <td colspan="2"><?php echo $arr_r2[1][6] ?></td>
    <td colspan="2"><?php echo $arr_r2[2][6] ?></td>
    <td colspan="2"><?php echo $arr_r2[3][6] ?></td>
    <td bgcolor="#CCCCCC"></td>
    <td><?php echo "" ?></td>
    <td><?php echo "" ?></td>
    <td bgcolor="#CCCCCC"></td>
    <td><?php echo $arr_r2[4][6] ?></td>
  </tr>
  <tr>
    <td colspan="12" bgcolor="#CCCCCC"></td>
  </tr>
  <tr>
    <td colspan="7"></td>
    <td bgcolor="#CCCCCC"></td>
    <td colspan="2">No. of persons on ART at the end of the quarter who were treated    with USG-funded ART (subset of 2qq.)</td>
    <td bgcolor="#CCCCCC"></td>
    <td></td>
  </tr>
</table>

<table class="mainTable" >
  <tr>
    <td width="183" class="tableheading">4.1    Change in CD4+    count and adherence to ART for 6-month cohort (&gt;6 years old)</td>
    <td colspan="2">&nbsp;</td>
    <td rowspan="7" bgcolor="#CCCCCC">&nbsp;</td>
    <td colspan="3" class="tableheading">4.2 Change in CD4+ count and adherence to ART for 12-month cohort (&gt;6 years    old)</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;Baseline</td>
    <td>6 months</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>&nbsp;Baseline</td>
    <td>12 months</td>
  </tr>
  <tr>
    <td>Months when    cohort started ART</td>
    <td>
    	<select name="month">
			<option <?php if ($_GET['month_6']==1) echo "selected=\"selected\"";?> value=1><?php echo date('M',mktime(0,0,0,$_GET['quarter']-7+1,1,$_GET['year'])); ?></option>
            <option <?php if ($_GET['month_6']==2) echo "selected=\"selected\"";?> value=2><?php echo date('M',mktime(0,0,0,$_GET['quarter']-7+2,1,$_GET['year'])); ?></option>
			<option <?php if ($_GET['month_6']==3) echo "selected=\"selected\"";?> value=3><?php echo date('M',mktime(0,0,0,$_GET['quarter']-7+3,1,$_GET['year'])); ?></option>
		</select>
		&nbsp;
    </td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>Months when    cohort started ART</td>
    <td>
    	<select name="month">
			<option <?php if ($_GET['month_12']==1) echo "selected=\"selected\"";?> value=1><?php echo date('M',mktime(0,0,0,$_GET['quarter']-13+1,1,$_GET['year'])); ?></option>
            <option <?php if ($_GET['month_12']==2) echo "selected=\"selected\"";?> value=2><?php echo date('M',mktime(0,0,0,$_GET['quarter']-13+2,1,$_GET['year'])); ?></option>
			<option <?php if ($_GET['month_12']==3) echo "selected=\"selected\"";?> value=3><?php echo date('M',mktime(0,0,0,$_GET['quarter']-13+3,1,$_GET['year'])); ?></option>
		</select>
    </td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>Number of    persons in cohort</td>
    <td><?php echo $arr_c6['b']?></td>
    <td><?php echo $arr_c6['e']?></td>
    <td>Number of    persons in cohort</td>
    <td><?php echo $arr_c12['b']?></td>
    <td><?php echo $arr_c12['e']?></td>
  </tr>
  <tr>
    <td>No. in cohort    who have CD4+    counts&nbsp;</td>
    <td><?php echo $arr_c6['c']?></td>
    <td><?php echo $arr_c6['f']?></td>
    <td>No. in cohort who have CD4+    counts&nbsp;</td>
    <td><?php echo $arr_c12['c']?></td>
    <td><?php echo $arr_c12['f']?></td>
  </tr>
  <tr>
    <td>Median CD4+ count for cohort</td>
    <td><?php echo $arr_c6['d']?></td>
    <td><?php echo $arr_c6['g']?></td>
    <td>Median CD4+ count for cohort</td>
    <td><?php echo $arr_c12['d']?></td>
    <td><?php echo $arr_c12['g']?></td>
  </tr>
  <tr>
    <td width="183">No. in cohort who received ARVs for 6 out of 6 months</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td><?php echo $arr_c6['h']?></td>
    <td>No.of persons in cohort who received ARVs for 12 out of 12    months</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td><?php echo $arr_c12['h']?></td>
  </tr>
</table>
<table class="mainTable">
    <td colspan="4" class="tableheading" align="center">LEGEND for Table 4</td>
  </tr>
  <tr>
    <td align="center"><span class="tableheading">Reporting Period </span></br> patients being reported during the time quarter:</td>
    <td align="center"><span class="tableheading">6-month cohorts</span><br>
    patients    who started on ART in the preceding months of:</td>
    <td colspan="2" align="center"><span class="tableheading">12-month cohorts</span> <br>
    patients who    started on ART in the previous year, during the months of:</td>
  </tr>
  <tr>
    <td>January 1 -    March 31</td>
    <td>July, Aug, Sept</td>
    <td colspan="2">Jan,Feb,March</td>
  </tr>
  <tr>
    <td>April 1 -    June 30</td>
    <td>Oct, Nov, Dec</td>
    <td colspan="2">April, May, June</td>
  </tr>
  <tr>
    <td>July 1 -    September 30</td>
    <td>Jan, Feb, March</td>
    <td colspan="2">July, Aug, Sept</td>
  </tr>
  <tr>
    <td>October 1 -    December 31</td>
    <td>April, May, June</td>
    <td colspan="2">Oct, Nov, Dec</td>
  </tr>
</table>
<table class="mainTable" >
  <tr>
    <td rowspan="2"  width="368" class="tableheading">6.1&nbsp; Number    of persons who started on ART at the facility in the EP program who were NOT on ART at the end of the quarter</td>
    <td>Male</td>
    <td>Female</td>
    <td>Total</td>
  </tr>
  <tr>
    <td><?php echo $arr_r6['all']['m']?></td>
    <td><?php echo $arr_r6['all']['f']?></td>
    <td><?php echo $arr_r6['all']['all']?></td>
  </tr>
  <tr>
    <td>6.2 Reason</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>1. Stopped    ART</td>
    <td><?php echo $arr_r6[142]['m']?></td>
    <td><?php echo $arr_r6[142]['f']?></td>
    <td><?php echo $arr_r6[142]['all']?></td>
  </tr>
  <tr>
    <td>2. Transferred    out</td>
    <td><?php echo $arr_r6[145]['m'] ?></td>
    <td><?php echo $arr_r6[145]['f']?></td>
    <td><?php echo $arr_r6[145]['all']?></td>
  </tr>
  <tr>
    <td>3. Death</td>
    <td><?php echo $arr_r6[147]['m']?></td>
    <td><?php echo $arr_r6[147]['f']?></td>
    <td><?php echo $arr_r6[147]['all']?></td>
  </tr>
  <tr>
    <td>4. Lost to    follow-up</td>
    <td><?php echo $arr_r6[146]['m']?></td>
    <td><?php echo $arr_r6[146]['f']?></td>
    <td><?php echo $arr_r6[146]['all']?></td>
  </tr>
  <tr>
    <td>5. Unknown</td>
    <td><?php echo $arr_r6[-1]['m']?></td>
    <td><?php echo $arr_r6[-1]['f']?></td>
    <td><?php echo $arr_r6[-1]['all']?></td>
  </tr>
</table>
<?php else :
$arv_report->getMessages();
endif;?>
</form>
</body>
</html>