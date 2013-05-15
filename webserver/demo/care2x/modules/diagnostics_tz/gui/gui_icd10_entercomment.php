<html>
<head>
<title><?php echo $LDEnterComment; ?></title>
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
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDComment; ?> <?php echo $headline; ?></font></td>
 </tr>
  <tr>
    <td>
	    <table width="100%" border="0" cellpadding="0" cellspacing="1">
          <tr> 
            <td width="100%" bgcolor="#CAD3EC"><table width="300" border="0">
              <tr>
                <td><?php echo $LDPID; ?></td>
                <td>12/34/56/78</td>
              </tr>
              <tr>
                <td><?php echo $LDHospitalFileNr; ?></td>
                <td>123456</td>
              </tr>
              <tr>
                <td><?php echo $LDLastName; ?></td>
                <td>Shiyanda</td>
              </tr>
              <tr>
                <td><?php echo $LDFirstName; ?></td>
                <td>Yanda</td>
              </tr>
              <tr>
                <td><?php echo $LDBirt; ?></td>
                <td>24.12.1970</td>
              </tr>
            </table></td>
          </tr>
        </table>
        
<form action="" method="post" name="comment_form">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr bgcolor="#99ccff">
            <td width="100%" colspan="2"><?php echo $LDPleaseEnterCommen; ?></td>
          </tr>
          <tr bgcolor="#CAD3EC">
            <td colspan="2"><textarea name="comment" cols="56" rows="5"></textarea>
			     <script>
       displaylimit('document.comment_form.comment',255)
      </script></td>
          </tr>	 
		  <tr bgcolor="#CAD3EC">
		  	<td><input type="reset" value="Reset textarea"></td>
			<td align="right"><input type="submit" value="Submit comment"></td>
		  </tr> 
        </table>                
 	  </form>
	</td>
  </tr>
</table>
</body>
</html>
