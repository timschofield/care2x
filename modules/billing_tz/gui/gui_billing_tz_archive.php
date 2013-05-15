

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE> </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid;?>&lang=en&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>


</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
<!--
	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	height:25px;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}

// -->

</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
	<script language="javascript" >
<!--
function archive()
    {
    document.form1.action="./billing_tz_archive.php?search=TRUE";
	document.form1.submit();
	}
function checkValue()
{
	if(document.form2.txtsearch.value=="")
	{
		alert("search term is missing!");
		return false;
	}
}

// -->

</script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>



</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip');" >
<?php //echo '<iframe name="prescription" src="'.$root_path.'modules/registration_admission/aufnahme_daten_such.php'.URL_APPEND.'&target=search&task=newprescription&back_path='.$back_path.'&pharmacy=yes" width="100%" height="90%" align="left" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="auto" frameborder="0" noresize></iframe> '; ?>
<form name="form1" method="post" action="billing_tz_archive.php">
<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" >
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDBillingArchive; ?>
      </font><font color="#330066"> / Total Billings: <?php echo $bill_obj->CountArchivedBill(); ?></font>
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing_archive.php','Billing :: Archive')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
    </td>
  </tr>
  <tr valign=top>
    <td colspan="2">
		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
			   <tr>
			<td>
			<tr>
			  <td>
				<table width="65%" border="0" align="center" class="table_content" cellpadding=0 cellspacing=0 >
			  <tr>
			  	<td colspan="6" align="center" bgcolor="#ffffaa" >
				<br><br>
							<?php
								include($root_path.'modules/billing_tz/include/inc_gui_timeframe.php');
							?>
						<input type="hidden" value="true" name="print">
						<input type="hidden" value="1" name="page">
							<br><br>
						<tr>

						<td align="center" bgcolor="#ffffaa" class=td_content>




							Search for e.g. Patientdetails like (Name, Last Name, PID), Billnumber, Cashier Name<br><br>
							<input type=search name="txtsearch" value="<?php echo $txtsearch; ?>" >					 		<input type="submit" name="search" value="search">
					 			<input type="hidden" value="true" name="print">
								<input type="hidden" value="1" name="page">
					 	<br>

								<input type="radio" name="searchtyp" value="month" checked> Selected Month
  								<input type="radio" name="searchtyp" value="all" >all archived Bills

					<br><br>
			 			</td>
			 			</tr>
				</td>

			  </tr>
			  </table>
			  <br><br>


					  <?php
					  	if($_REQUEST['displaybill'] == true)
					  	{
					  		$bill_obj->DisplayArchivedBills($_REQUEST['batch_nr'],$_REQUEST['bill_nr'],0,TRUE);
					  		?>
					  		<td align=center>
					  			<a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" ></a>
					  		</td>
					  		<?php

					  	}
					  	else
					  	{

					  		if($_REQUEST['sorttyp'] == 'asc')
					  		{
					  			$sorttyp='desc';
					  		}
					  		if($_REQUEST['sorttyp'] == 'desc')
					  		{
					  			$sorttyp='asc';
					  		}
					  		if($_REQUEST['sorttyp'] == '')
					  		{
					  			$sorttyp='asc';
					  		}

					  		if($_REQUEST['sortby']=="nr" && $_REQUEST['sorttyp'] == 'asc')
					  		{
					  			$img_nr="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_nr="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="date" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_date="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_date="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="price" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_price="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_price="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="user_id" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_user="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_user="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="pid" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_pid="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_s_pid="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
							if(($_REQUEST['sortby']=="selian_pid" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_s_pid="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_s_pid="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}

					  		echo '<table width="65%" border="0" align="center" class="table_content" cellpadding=0 cellspacing=0  >';
					  		echo '<tr class="tr_content">';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=nr&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillNumber.'</a>'.$img_nr.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=date&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillingdate.'</a>'.$img_date.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=price&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">Price</a>'.$img_price.'</div></td>';
							echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=selian_pid&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">File No.</a>'.$img_s_pid.'</div></td>';
							
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=pid&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">PID</a>'.$img_pid.'</div></td>';
							
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=user_id&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">CashierName</a>'.$img_user.'</div></td>';

					$bill_obj->DisplayAllArchivedBill($txtsearch,$searchtyp, $start_timeframe, $end_timeframe, $trans_id,50, $day, $month, $year, $sorttyp,$view);

							echo '</tr>';
							echo'</table>';
					  	}
					  ?>


				</td>
			<tr>
			  <td></td>
			</tr>
		</table>
	</td>
  </tr>
</table>
</form>
</BODY>
</HTML>