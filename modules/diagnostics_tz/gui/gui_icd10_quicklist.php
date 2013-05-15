<html>
<head>
<title><?php echo $LDDiagnoses; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<script language="javascript" src="../../js/check_diagnostics_form.js"></script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066"><?php echo $LDICD10Description; ?>
(<?php echo $_SESSION['sess_pid']; ?>)</font></td>
	  	<td align="right"><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='../../main/startframe.php?ntid=false&lang=$lang';
	  	?>
	  	<a href="javascript:gethelp('diagnoses.php','Patient&acute;s chart folder :: Diagnoses')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
	  	<a href="<?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
	  	</td>
	  </tr>
  </table>
    </td>
 </tr>
  <tr>
    <td><form name="icd10" method="post" action="icd10_diagnose.php<?php echo URL_APPEND; ?>">
	<table width="100%" border="0">
	  <tr>
		<td width="25%" bgcolor="#CAD3EC"><div align="center"><input type="button" name="show" value="<?php echo $LDQuicklist; ?>" onClick="javascript:submit_form(this,'icd10_quicklist.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="17%" class="adm_input"><div align="center"><input type="button" name="show" value="<?php echo $LDSearch; ?>" onClick="javascript:submit_form(this,'icd10_search.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="20%" class="adm_input"><div align="center"><input type="button" name="show" value="<?php echo $LDHistory; ?>" onClick="javascript:submit_form(this,'icd10_history.php','<?php echo $sid ?>','')">
		</div></td>
		<td width="38%" class="adm_input"><div align="center"><input type="button" name="show" value="<?php echo $LDManageQuicklist; ?>" onClick="javascript:submit_form(this,'icd10_manage.php','<?php echo $sid ?>','')">
		</div></td>
	  </tr>
	</table>
	<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="100%" align="center">
                  <select name="quicklist" onChange="submit_form(this,'<?php echo $thisfile;?>','<?php echo session_id();?>','quicklist');">
                  <option selected value="-1"> <?php echo $LDPleaseSelectItem; ?></option>
					<?php $diagnostic_obj->Display_Quicklist_Elements($quicklist); ?>
                  </select>
                  <br>
              <select name="itemlist[]" size="20" style="width:600px;" onDblClick="javascript:item_add();">
                  <!-- dynamically managed content -->
					<?php $diagnostic_obj->Display_Quicklist_Elements_Items($quicklist); ?>
				  <!-- dynamically managed content -->
              </select>
            </td>
          </tr>
          <tr>
            <td align="center">
            	<table border="0" cellpadding="0" cellspacing="0" align="center" width="500">
            		<tr>
            			<td width="33%"><a href="#" onClick="javascript:item_add();"><img  src="../../gui/img/control/default/en/en_add_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
						<td width="34%" align="center"><a href="#" onClick="javascript:submit_form(this,'icd10_diagnose.php','<?php echo $sid ?>','done')"><img  src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                		<td width="33%" align="right"><a href="#" onClick="javascript:item_delete();"><img  src="../../gui/img/control/default/en/en_delete_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
                	</tr>
               	</table>
			</td>
          </tr>
          <tr>
            <td>
             <div align="center">
                <select name="selected_item_list[]" size="5" style="width:600px;" onDblClick="javascript:item_delete();">
                  <!-- dynamically managed content -->
                  <?php $diagnostic_obj->Display_Selected_Elements($item_no); ?>
                  <!-- dynamically managed content -->
                </select><br>
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
