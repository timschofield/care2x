<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<TITLE>ARV Facility Information</TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Dorothea Reichert">
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
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

 
</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">ARV Facility Information</font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   <a
   href=""><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href=<?php echo $breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>

 </table>		</td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>
		
										
<ul>
<FONT class="prompt"><p>
 
<p>
Please edit or enter the information. Then click "Save".
</font>

<p>

<form  method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>Facility Name</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_facility_name" size=40 maxlength=40 value="<?php echo $GLOBAL_CONFIG['main_info_facility_name'] ?>">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>Code</b> </FONT></td>

	<td class="adm_input"><input type="text" name="main_info_facility_code" size=40 maxlength=40 value="<?php echo $GLOBAL_CONFIG['main_info_facility_code'] ?>">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>District</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_facility_district" size=40 maxlength=40 value="<?php echo $GLOBAL_CONFIG['main_info_facility_district'] ?>">
      </td>
</tr>
</table>
<p>
<input type="image" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif" border=0 width="76" height="21">
	<input type="hidden" name="sid" value="e1e9c2d4637a3ec6425f4784bb31c925">
	<input type="hidden" name="lang" value="en">

	<input type="hidden" name="mode" value="save">&nbsp;&nbsp;&nbsp;&nbsp;<a href="edv-system-admi-welcome.php?sid=<?php echo $sid."&lang=".$lang;?>&ntid=false"><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21"></a>
</form>									
		</td>
	</tr>
	
		<tr valign=top >
		<td bgcolor=#cccccc>
							<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">
  <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   <tr>

   	<td>
	    <div class="copyright">
<script language="JavaScript">
<!-- Script Begin
function openCreditsWindow() {

	urlholder="../../language/en/en_credits.php?lang=en";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>

	
 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 <a href="../../docs/show_legal.php?lang=en" target="lgl"> Legal </a> ::
 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

</div>

    </td>
   <tr>
  </table>
</td>
</tr>
</table>
					</td>

	</tr>
	
	</tbody>
 </table>

<!--   -->
</BODY>
</HTML>