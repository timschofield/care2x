<?php 

$page_funct->Display_Header(); 

function Display_Bill_Header($Title,$Append_Tag){
	global $URL_APPEND, $LDBilling;
   echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <TITLE>'.$Title.'&nbsp; '.$Append_Tag.'</TITLE>
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php'.$URL_APPEND.'&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">

	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
	}

A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.lab {font-family: arial; font-size: 9; color:purple;}
.lmargin {margin-left: 5;}
.billing_topic {font-family: arial; font-size: 12; color:black;}
</style>

<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX: 100"></div>
</head>';
    return true;
    }
$page_funct->Display_Headline($LDBilling);
  function Display_Bill_Headline($Headline, $Append_Tag){
        echo '<table cellspacing="0" class="titlebar" border=0 height="35" width="100%">
	          <tr valign=top  class="titlebar">
	            <td bgcolor="#99ccff" >
	                &nbsp;&nbsp;<font color="#330066">'.$Headline.'&nbsp; '.$Append_Tag.'</font>

	       </td>
	  <td bgcolor="#99ccff" align=right><a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a href="javascript:gethelp(\'insurance_reports_companies.php\',\'Insurance Reports :: Company Overview\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
	 </tr>
    </table>
    <table width=100% border=0 cellspacing=0 height=80%>
	<tbody class="main">
		<tr valign="middle" align="center">
			<td>';
    return true;
    }

    $page_funct->Display_Footer($LDBilling);
  function Display_Bill_Footer($Headline, $Append_Tag){
        echo '</td></tr></table><table cellspacing="0" class="titlebar" border=0 height="35">
	          <tr valign=top  class="titlebar">
	            <td bgcolor="#99ccff">
	                &nbsp;&nbsp;<font color="#330066">'.$Headline.'&nbsp; '.$Append_Tag.'</font>

	       </td>
	  <td bgcolor="#99ccff" align=right><a
	   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
	   href="javascript:gethelp(\'insurance_reports_companies.php\',\'Insurance Reports :: Company Overview\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
	   href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
	 </tr>
	 </table>';
    return true;
    }

    function Display_Bill_Credits(){
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
			<tr valign=bottom>
				<td align="center">
 		 			<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
						<tr>
   							<td><div class="copyright">
	<script language="JavaScript">
	<!--
	function openCreditsWindow() {

		urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
		creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

	}
	// -->
	</script>


 	<a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 	<a href=mailto:info@care2x.org>Contact</???a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 	<a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
 	<a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

							</div>
							</td>
   						<tr>
  					</table>
				</td>
			</tr>
		</table>
	</BODY>
	</html>';
	return true;
  }
