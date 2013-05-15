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


 
</HEAD>
<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" >

<table width=100% border=0 cellspacing=0 height=100%>
  <tr valign=top  class="titlebar" > 
    <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Stock setup</font> 
    </td>
    <td bgcolor="#99ccff" align=left> <a href="javascript:gethelp('billing.php','quotation','details')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)"></a> 
      <a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a> 
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
			  <center><font class="submenu_item">Available stocks</font></center>
				<table width="600" border="0" align="center">
          			<tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="700">
					  		<tr bgcolor="#ffff88">
					  			<td width="100">	
					  				<div align="center">ID</div>
					  			</td>
					  			<td width="200">
					  				<div align="center">Stock Name</div>
					  			</td>
					  			<td width="250">
					  				<div align="center">Stock Type</div>
					  			</td>
					  			<td>
					  				<div align="center">
					  					Stock is disabled
					  				</div>
					  			</td>
					  		</tr>

					  	</table>
					  </td>
					</tr>
			<?php
			
			$stocks = $stock_obj->get_all_stocks();
			$types = $stock_obj->get_all_stocktypes();
			
		$color_change=FALSE;
		if(is_array($stocks))
	    while (list($x,$row) = each($stocks))
	    {
	      if ($color_change) {
	        $BGCOLOR='bgcolor="#ffffdd"';
	        $color_change=FALSE;
	      } else {
	        $BGCOLOR='bgcolor="#ffffaa"';
	        $color_change=TRUE;
	      }
	      $id_array['pressum_'.$row['nr']]= true;
	      
	      echo '
          <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="700">
					  		<tr bgcolor="#ffffaa">
					  			<td width="100">
					  				<div align="center">'.$row['ID'].'</div>
					  			</td>
					  			<td width="200">
					  				<div align="center"><input type="text" name="description_'.$row['ID'].'" size="29" value="'.$row['Stockname'].'"></div>
					  			</td>
					  			<td width="250">
					  				<div align="center"><select name="type_'.$row['ID'].'">';
					  				reset($types);
					  				while(list($types_x,$types_v)=each($types))
					  				{
					  					if($row['Stocktype']==$types_v['ID'])
					  						echo '<option selected value="'.$types_v['ID'].'">'.$types_v['Description'].'</option>';
					  					else
					  						echo '<option value="'.$types_v['ID'].'">'.$types_v['Description'].'</option>';
					  				} 
					  				echo '</select></div>
					  			</td>
					  			<td>
					  				<div align="center">';
										if($row['flag_disabled']==0) $checked = false;
										else $checked = "checked";
										echo 
					  					'<input type="checkbox" value="delete" name="trigger_'.$row['ID'].'" '.$checked.'>	
					  				</div>
					  			</td>
					  		</tr>

					  	</table>
					  </td>
					</tr>';
}
else
{
	echo '			<tr>
						<td bgcolor=#ffffdd width="80" colspan="7" align="center">
							Nothing to do :)
						</td>
					</tr>';
}
		?>
              <tr>
					  <td bgcolor=#ffffdd width="80" colspan="4">

					  <input type="hidden" value="update" name="task">
					  </td>
					  <td bgcolor=#ffffdd colspan="4" align="right"></td>

					</tr>
				</table>

				<table width="700" border="0" align="center">
					<tr>
						<td>
							<input type="reset" value="Reset fields">
						</td>
						<td align="right">
							<input type="submit" value="I'm finished">
						</td>
					</tr>
				</table>
				</td>
			</form>
			</tr>
		</table>	
	</td>
  </tr>
</table>		

</BODY>
</HTML>