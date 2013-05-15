

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Care2x - Stock</TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script> 


</script> 
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>

  	
<style type="text/css">
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}
</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>

<script language="JavaScript">
function toggle_tr(myelem,show,id) {
 if(show){
   document.getElementById(myelem).style.display = '';
   if(show)
   calc_article(id);
 }else{
   document.getElementById(myelem).style.display = 'none';
 }
}
function calc_article(id)
{
	if(document.forms[0].elements['insurance_' + id])
	{
		if(isNaN(document.forms[0].elements['showprice_' + String(id)].value) || isNaN(document.forms[0].elements['dosage_' + id].value) || isNaN(document.forms[0].elements['insurance_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value;
			sum_total = sum - document.forms[0].elements['insurance_' + id].value;
			if (sum_total<0) sum_total=0;
			document.getElementById('div_' + id).innerHTML='<table width="100%" border="0"><tr><td>' + document.forms[0].elements['showprice_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align="right">' + sum + ' TSH</td></tr><tr><td>Insurance:</td><td align="right">- ' + document.forms[0].elements['insurance_' + id].value + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align="right"><b>' + sum_total + ' TSH</b></td></tr></table><input type="hidden" name="pressum_' + id + '" value="'+ sum_total + '">';
			
		}
	}
	else
	{
		if(isNaN(document.forms[0].elements['showprice_' + String(id)].value) || isNaN(document.forms[0].elements['dosage_' + id].value))
		{
			document.getElementById('div_' + id).innerHTML='n/a';
		}
		else
		{
			sum = document.forms[0].elements['showprice_' + id].value * document.forms[0].elements['dosage_' + id].value;
			sum_total = sum;
			if (sum_total<0) sum_total=0;
			document.getElementById('div_' + id).innerHTML='<table width="100%" border="0"><tr><td>' + document.forms[0].elements['showprice_' + id].value + ' x ' + document.forms[0].elements['dosage_' + id].value + ' = </td><td align="right">' + sum + ' TSH</td></tr><tr><td><b>Sum:</b></td><td align="right"><b>' + sum_total + ' TSH</b></td></tr></table><input type="hidden" name="pressum_' + id + '" value="'+ sum_total + '">';
			
		}
	}
}
</script>

 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Stock Inventory Details</font> 
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing.php','quotation','details')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a> 
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
			  <form method="POST" action="" name="step1">
			  
					  	<table border="0" cellpadding="2" cellspacing="2" width="600" align="center">
					  		<tr>
					  			<td colspan="4">
								  <table width="600" align="center" cellpadding="1" cellspacing="1" border="0">
								  	<tr>
								  		<td bgcolor="grey" align="center">
								  			<font color="white">No values given</font>
								  		</td>
								  		<td bgcolor="green" align="center">
								  			<font color="white">Above Reorder Level</font>
								  		</td>
								  		<td bgcolor="orange" align="center">
								  			<font color="white">Reorder Level reached</font>
								  		</td>
								  		<td bgcolor="red" align="center">
								  			<font color="white">Minimum level reached</font>
								  		</td>
								  	</tr>
								  </table>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffffdd">
					  			<td width="100">
					  				<div align="left"><b><?php echo 'Druglist-ID: '.$_GET['item_id']; ?></b></div>
					  			</td>
					  			<td width="475" colspan="3">
					  				<div align="left"><b><?php echo 'Description: '.$stockitems[0]['item_description']; ?></b></div>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffff88">
					  			<td width="150">
					  				<div align="center"><?php echo 'Stock-ID:'; ?></div>
					  			</td>
					  			<td width="150">
					  				<div align="center"><?php echo 'Ordered on:'; ?></div>
					  			</td>
					  			<td width="200">
					  				<div align="center"><?php echo 'Changed on:'; ?></div>
					  			</td>
					  			<td width="75">
					  				<div align="center"><?php echo 'Amount:'; ?></div>
					  			</td>
					  		</tr>
			<?php
			
			
		$color_change=FALSE;
	    while (list($x,$row) = each($stockitems))
	    {
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
	      if(empty($row['Drugamount'])) $row['Drugamount'] = 0;
	      if ($row['Drugamount'] <= $row['Minimumlevel'])
			   $color="red";
		  elseif ($row['Drugamount'] <= $row['Reorderlevel'])
			   $color="orange";
		  elseif ($row['Drugamount'] >$row['Reorderlevel'])
			   $color="green";
		  if(empty($row['Minimumlevel']) || empty($row['Reorderlevel'])) $color="grey";
	      echo '
					  		<tr '.$BGCOLOR.'>
					  			<td>
					  				<div align="center">'.$row['ID'].'</div>
					  			</td>
					  			<td>
					  				<div align="center">'.date("d.m.Y - h:m",$row['Timestamp']).'</div>
					  			</td>
					  			<td>';
								if($row['Timestamp_changed']>0) $changetime=$row['Timestamp_change']; else $changetime=$row['Timestamp']; echo '
					  				<div align="center">'.date("d.m.Y - h:m",$changetime).'</div>
					  			</td>
					  			<td>
					  				<div align="center"><input type="text" value="'.$row['Amount'].'" name="amount_'.$row['item_id'].'" size="5"></div>
					  			</td>
					  		</tr>
';
}
		?>
					  		<tr bgcolor="#ffffdd">
					  			<td width="100">
					  				<div align="left"><input type="reset" value="Reset fields"></div>
					  			</td>
					  			<td width="475" colspan="3">
					  				<div align="right"><input type="submit" value="Change values"></div>
					  			</td>
					  		</tr>
              <tr>
					  <td bgcolor=#ffffdd width="80" colspan="4">

					  <input type="hidden" value="pending" name="task">
					  </td>
					  <td bgcolor=#ffffdd colspan="4" align="right"></td>

					</tr>
				</table>

					  <script language="JavaScript">
					  var objectarray = new Array();
					  	
					  	function TriggerAllItems(trigger)
					  	{
						<?php
						reset($dummyarray);
						while(list($x,$v) = each($dummyarray))
						{
							echo "
							if(document.forms[0].elements['trigger_".$v['ID']."'])
							{
								document.forms[0].elements['trigger_".$v['ID']."'][trigger].checked = true;
							}
							";
							
						}
						?>
					  	}
					  </script>

				</td>
			</form>
			</tr>
		</table>	
	</td>
  </tr>
</table>		

</BODY>
</HTML>