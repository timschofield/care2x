<?php
$diagnostic_obj->loadEncounterData($_SESSION['sess_en']);
$encounter_arr = $diagnostic_obj->getLoadedEncounterData();?>
<html>
<head>
<title><?php echo $LDDiagnoses; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../js/check_diagnostics_form.js"></script>
<script language="javascript">
function openpopup(URL, target,content,id)
{
	URL += "<?php echo URL_APPEND; ?>&"+content+"="+id;
	popupwindow=window.open(URL,target,"width=500,height=285,menubar=no,resizable=no,scrollbars=auto");
}
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066"><?php echo $LDICD10Description; ?>
(<?php echo $_SESSION['sess_en']; ?>)</font></td>
	  	<td align="right"><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
	  		$closelink='javascript:window.close();';
	  	else
	  		$closelink='../../main/startframe.php?ntid=false&lang=$lang';
	  	?><!--<a href=" <?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>-->
	  <a href="javascript:gethelp('diagnoses.php','Patient&acute;s chart folder :: Diagnoses')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
	  <a href=" javascript:alert('<?php echo $LDYouHaveNotSavedDiagosis; ?>')"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
		</td>
	  </tr>
  </table>
    </td>
 </tr>
  <tr>
    <td>

	    <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr>
            <td width="100%" bgcolor="#CAD3EC"><table width="300" border="0">
              <tr>
                <td><?php echo $LDPID; ?></td>
                <td><?php echo $diagnostic_obj->ShowPid($encounter_arr['pid']); ?></td>
              </tr>
              <tr>
                <td><?php echo $LDHospitalFileNr; ?></td>
                <td><?php echo $encounter_arr['selian_pid']; ?></td>
              </tr>
              <tr>
                <td><?php echo $LDLastName; ?></td>
                <td><?php echo $encounter_arr['name_last']; ?></td>
              </tr>
              <tr>
                <td><?php echo $LDFirstName; ?></td>
                <td><?php echo $encounter_arr['name_first']; ?></td>
              </tr>
              <tr>
                <td><?php echo $LDBirth; ?></td>
                <td><?php echo $encounter_arr['date_birth']; ?></td>
              </tr>
            </table></td>
          </tr>
        </table>

<?php $userName=$_SESSION['sess_user_name'];
$diagnostic_obj->Display_Selected_Diagnoses($_SESSION['sess_en'], $item_no, $encounter_arr['pid']);
?>
	</td>
  </tr>
</table>
</body>
</html>