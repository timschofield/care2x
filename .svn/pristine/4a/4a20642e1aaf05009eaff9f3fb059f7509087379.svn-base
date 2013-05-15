<?php $case_arr=$diagnostic_obj->GetCase($id);
$diagnostic_obj->loadEncounterData($_SESSION['sess_en']);
$encounter_arr = $diagnostic_obj->getLoadedEncounterData();?>

<html>
<head>
<title><?php echo $LDDiagnosisDetails; ?> <?php echo $case_arr['ICD_10_code']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../js/check_diagnostics_form.js"></script>
<script language="javascript" src="../../js/textareacounter.js"></script>
<script language="javascript">
function openpopup(URL,target,content,id)
{
	URL += "<?php echo URL_APPEND; ?>&"+content+"="+id;
	popupwindow=window.open(URL,target,"width=500,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>
</head>

<body>
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $case_arr['ICD_10_code'].': '.$case_arr['ICD_10_description']; ?></font></td>
 </tr>
  <tr>
    <td>
	    <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td width="100%" bgcolor="#CAD3EC"><table width="300" border="0">
              <tr>
                <td>PID</td>
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
              <tr>
                <td><?php echo $LDDiagnoseDate; ?></td>
                <td><?php echo date("Y-m-d - H:i:s",$case_arr['timestamp']); ?></td>
              </tr>
            </table></td>
          </tr>
        </table>
      
<table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr bgcolor="#99ccff">
            <td width="100%"><?php echo $LDComment; ?></td>
          </tr>
          <tr bgcolor="#CAD3EC">
            <td height="104">&nbsp;
            <?php 
            	if($case_arr['comment'])
            		echo $case_arr['comment'];
            	else
            		echo $LDNoCommen;
            	
            	?></td>
          </tr>	 
		  <tr bgcolor="#CAD3EC">
		  	<td align="center"><input type="button" value="<?php echo $LDCloseThisWindow; ?>" onClick="javascript: window.close();"></td>
		  </tr> 
        </table>                
 	  </form>
	</td>
  </tr>
</table>
</body>
</html>
