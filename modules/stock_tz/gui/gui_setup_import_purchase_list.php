<html>
<head>
<title>Care2x - Stock</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../js/check_stock_purchase_items_form.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">IMPORT (MEMS) druglist </font></td>
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
    <td>

    <!-- File name -->
    <form action="" method="post" enctype="multipart/form-data" name="evaluate">
    <fieldset class="options">
        <legend>Select drug list for import (csv-table)</legend>

        <div>
	        <label for="input_import_file">File</label>
	        <input style="margin: 5px" size="100" type="file" value="druglist" name="import_file" id="input_import_file" />
        </div>
 	</fieldset>
 	<input type="submit" value="evaluate" id="evaluate" name="evaluate" />
  	</form>

	</td>
  </tr>
</table>
</body>
</html>
