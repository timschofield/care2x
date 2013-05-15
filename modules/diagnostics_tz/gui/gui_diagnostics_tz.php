<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDDiagnosticsICD10DBSearch; ?> - </TITLE>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Robert Meggle">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
  <!-- 
  function gethelp(x,s,x1,x2,x3,x4)
  {
  	if (!x) x="";
  	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
  	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
  	window.helpwin.moveTo(0,0);
  }
  
  function popPic(pid,nm){
  
   if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");
  
  }

  // -->

</script> 
<script language="javascript" src="../../js/hilitebu.js"></script>

<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>




 
</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066 onLoad="document.suchform.keyword.select()" >
<table width=102% border=0 cellspacing=0 height=10%>
  <tbody class="main">

	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDDiagnosticsICD10DBSearch; ?></font> </td>
            <td bgcolor="#99ccff" align=right>
              <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
              <a href="javascript:gethelp('diagnoses.php','Patient&acute;s chart folder :: Diagnoses','','pharma')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
              <a href="pharmacy_tz_product_catalog.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
            </td>
          </tr>
      </table>
    </td>
	</tr>
	<tr>
    <td height="321" valign="top"> 
    <ul><p><br>
    
          <form action="diagnostics_tz.php" method="POST" name="suchform">
            <table border=0 cellspacing=2 cellpadding=3>
              <tr bgcolor=#ffffdd> 
                <td colspan=2> 
                  <FONT color="#800000"><?php echo $LDEnterSearchKeyword; ?></font> <br> <p> 
                </td>
              </tr>
              <tr bgcolor=#ffffdd> 
                <td width="146" align=right><?php echo $LDSearchKeyword; ?></td>
                <td width="500"> <input type="text" name="keyword" value="<?php echo $keyword;?>" size=40 maxlength=40> 
                </td>
              </tr>
              <tr> 
                <td>&nbsp; </td>
                <td align=right> 
                  <input type="submit" value="Search" > 
                  <input type="hidden" name="mode" value="search">
                </td>
              </tr>
            </table>
          </form>
          
          <?php if ($number_of_search_results>0) { ?>
          <p><?php echo $LDIfound; ?> <?php echo $number_of_search_results;?> <?php echo $LDRecordsThatCouldFit; ?></p>
          <table width="70%" border="0" bgcolor=#ffffdd align="center">
            <tr> 
              <td width="13%"><?php echo $LDICD10; ?></td>
              <td width="38%"><?php echo $LDdiagnosisdesc; ?></td>
              <td width="7%"><?php echo $LDselect; ?></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?php
              echo $http_buffer;
            ?>
          </table>
          <?php } else { ?>
          <p> <?php echo $LDSorryNoItems; ?> <?php echo $keyword;?>. 
          </p>
          <?php } ?>
          <hr>
          
          
          <!--
          <form action="pharmacy_tz_product_catalog.php" method="post">
            <input type="hidden" name="sid" value="<?php echo $sid;?>">
            <input type="image" src="../../gui/img/control/default/en/en_cancel.gif" >
          </form>
          -->
          
          
        </ul>


						
		</td>
	</tr>
	
		<tr valign=top >
		
      <td bgcolor=#ffffff>
<hr> </td>

	</tr>
	
	</tbody>
 </table>

<p>&nbsp;</p>
</BODY>
</HTML>