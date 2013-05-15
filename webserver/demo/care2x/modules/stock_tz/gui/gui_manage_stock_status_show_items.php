

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
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066"  >

<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Show all stock items</font> 
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
								  			<!--<font color="white">No values given</font>-->
								  			<div align="center"><a href="?orderby=Drugamount"><?php if($orderby=="Drugamount") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">all items<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'all items'; ?></a></font></div>
								  		</td>
								  		<td bgcolor="green" align="center">
								  			<!--<font color="white">Above Reorder Level</font>-->
								  			<div align="center"><a href="?orderby=AboveReorderlevel"><?php if($orderby=="AboveReorderlevel") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Above Reorder Level<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Above Reorder Level'; ?></a></font></div>
								  		</td>
								  		<td bgcolor="orange" align="center">
								  			<!--<font color="white">Reorder Level reached</font>-->
								  			<div align="center"><a href="?orderby=ReorderlevelReached"><?php if($orderby=="ReorderlevelReached") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Reorder Level reached<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Reorder Level reached'; ?></a></font></div>
								  		</td>
								  		<td bgcolor="red" align="center">
								  			<!--<font color="white">Minimum level reached</font>-->
								  			<div align="center"><a href="?orderby=MinimumlevelReached"><?php if($orderby=="MinimumlevelReached") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Minimum level reached<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Minimum level reached'; ?></a></font></div>
								  		</td>
								  	</tr>
								  </table>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffff88">
					  			<td width="100">
					  				<div align="center"><a href="?orderby=ID"><?php if($orderby=="ID") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Druglist-ID<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Druglist-ID'; ?></a></div>
					  			</td>
					  			<td width="400">
					  				<div align="center"><a href="?orderby=Description"><?php if($orderby=="Description") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Description<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Description'; ?></a></div>
					  			</td>
					  			<td width="75">
					  				<div align="center"><a href="?orderby=Drugamount"><?php if($orderby=="Drugamount") echo '<b><img border="0" src="'.$root_path.'gui/img/common/default/redpfeil.gif">Amount<img border="0" src="'.$root_path.'gui/img/common/default/redpfeil_l.gif"></b>'; else echo 'Amount'; ?></a></font></div>
					  			</td>
					  			<td width="25">
					  				<div align="center">&nbsp;</font></div>
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
					  				<div align="center">'.$row['item_id'].'</div>
					  			</td>
					  			<td>
					  				<div align="left">'.$row['item_description'].'</div>
					  			</td>
					  			<td>
					  				<div align="center"><font color="'.$color.'">'.$row['Drugamount'].' Pcs.</font></div>
					  			</td>
					  				<td>
					  				<div align="center"><a href="stock_inventory_details.php?item_id='.$row['item_id'].'">&gt;&gt;</a></div>
					  			</td>
					  		</tr>
';
}
		?>
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