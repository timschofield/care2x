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
<script language="javascript" src="../../js/check_stock_purchase_items_form_step2.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">Purchase Items - Step 2
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
    <td><form name="step2" method="post" action="" onSubmit="javascript:submit_form(this,'purchase_items_step2.php','<?php echo $sid ?>','search'); return false;">
<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="100%" align="center"><table width="600" border="0">
                    <tr>
                      <td width="265" valign="top">Selected druglist Items:<br>

                        <select name="selected_item_list[]" size="24" style="width:335px;" ondblclick="javascript:document.step2.keyword.value=this.options[selectedIndex].text;">
                  <!-- dynamically managed content -->
                  <?php while(list($x,$v) = each($item_no))
                  			echo '<option value='.$v.'>'.$stock_obj->get_description($v).'</option>'; 
                  ?>
                  <!-- dynamically managed content -->
                        </select> 
                      Double click to transfer item to search field. </td>
                      <td><table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td colspan="2"> Search for:<br>
                              <input type="text" size="20" name="keyword" value="<?php echo $keyword; ?>">
                              <select name="supplier" style="width: 117px">
                              <?php
                              	$suppliers = $stock_obj->get_stock_suppliers();
                              	while(list($x,$v,) = each($suppliers))
                              	{
                              		if($supplier==$x) $selected = " selected ";
                              		else $selected = false;
                              		echo '<option value="'.$x.'" '.$selected.'>'.$v.'</option>';
                              	}
                              ?>
                              </select>
                              <input name="button" type="button"  onClick="javascript:submit_form(this,'purchase_items_step2.php','<?php echo $sid ?>','search');" value="search">                          </td>
                        </tr>
                      </table>
                        Results:
                        <select name="itemlist[]" size="14" style="width:335px;" ondblclick="javascript:item_add();">
  				<?php 
  				if($search_results)
              while($row=$search_results->FetchRow())
              {
              	echo '<option value="'.$row['Supplier_item_id1'].'">'.$row['Supplier_item_name'].' ('.$row['Supplier_item_packsize'].' Pcs.)</option>';
              }
              ?>
                        </select>
                        <table border="0" cellpadding="0" cellspacing="0" align="center" width="335">
                          <tr>
                            <td width="33%"><a href="#" onClick="javascript:item_add();"><img  src="../../gui/img/control/default/en/en_add_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                            <td width="34%" align="center"><a href="#" onClick="javascript:submit_form(this,'purchase_items_step3.php','<?php echo $sid ?>','done')"><img  src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                            <td width="33%" align="right"><a href="#" onClick="javascript:item_delete();"><img  src="../../gui/img/control/default/en/en_delete_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                          </tr>
                        </table>
                        <br>
                        Order list:
                        <select name="selected_order_list[]" size="5" style="width:335px;" ondblclick="javascript:item_delete();">
                  <!-- dynamically managed content -->
                  <?php while(list($x,$v) = each($order_no))
                  			echo '<option value='.$v.'>'.$stock_obj->get_order_description($v).'</option>'; 
                  ?>
                  <!-- dynamically managed content -->
                        </select></td>
                    </tr>
                  </table>
            <br></td>
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