<html>
<head>
<title>Care2x - Stock</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript" src="../../js/check_stock_purchase_items_form.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">Purchase Items - Final Summary
</font></td>
	  	<td align="right" width="213"><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='../../main/startframe.php?ntid=false&lang=$lang';
	  	?><a href="<?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
	  	</td>
	  </tr>
  </table>
    </td>
 </tr>
  <tr>
    <td><form name="icd10" method="post" action="" onSubmit="javascript:submit_form(this,'purchase_items_step1.php','<?php echo $sid ?>','search'); return false;">
<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="100%" align="center"><table width="750" border="0">
                    <tr bgcolor="#ffffdd">
                      <td valign="top"><b>Following items are now in transfer (incoming):</b></td>
					</tr>
					<tr>
					  <td valign="top">
					  	<table border="0" width="750" bgcolor="#ffffdd" cellpadding="1" cellspacing="2">
					  <?php 
					  while(list($x,$v) = each($tempitems))
					  	echo '<tr bgcolor="#ffffaa"><td width="100">'.$x.'</td><td>'.$stock_obj->get_description($x).'</td><td width="90">'.$v.' Pcs.</td></tr>';
					  $druglist_no = false; 
					  ?> 
					  	</table>
					  	</td>
					  </tr>
                    <tr bgcolor="#ffffdd">
					  <td valign="top"><b>You should order these items from suppliers:</b></td>
					</tr>
					<tr>
					  <td valign="top">
					  	<table border="0" width="750" bgcolor="#ffffdd" cellpadding="1" cellspacing="2">
					  <?php 
					  while(list($x,$v) = each($temporders))
					  	echo '<tr bgcolor="#ffffaa"><td width="100">'.$x.'</td><td>'.$stock_obj->get_order_description($x).'</td></tr>';
					  $druglist_no = false;
					  ?> 
					  	</table>
					  	</td>
					  </tr>
                  </table>
                  
              <br>
              <a href="stock_tz_pass.php">Back to menu</a> </td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td>
<div align="center"><br>                
             </div>
            </td>
          </tr>

        </table>              
	 	</form>
	</td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
document.icd10.keyword.focus();
</script>