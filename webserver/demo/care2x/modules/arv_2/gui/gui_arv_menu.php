<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<TITLE>ARV menu</TITLE>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<script language="javascript" >
<!-- 
if (parent.frames.length>=1) {
	window.top.location.href=document.location;
}

function openCreditsWindow() {

	urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

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
<?php
	if ($o_arv_patient->is_arv_admitted()) 
	{$mode="registered";}
	else {$mode="not_registered";}
?>
</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >
<table width=100% border=0 cellspacing=0 height=100%>
	<tbody class="main">
		<tr>
			<td  valign="top" align="middle" height="35">
				<table cellspacing="0"  class="titlebar" border=0>
 					<tr valign=top  class="titlebar" >
  						<td bgcolor="#99ccff" >&nbsp;&nbsp;<font color="#330066">NATIONAL CARE AND TREATMENT PROGRAM</font>
       					</td>
  						<td bgcolor="#99ccff" align=right><a
  							 href="javascript:gethelp('arv_menu.php','ARV Menu','<?php echo $mode; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
  							 href="<?php echo $root_path.$filename.URL_APPEND.$add_breakfile; ?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 					</tr>
 				</table>				
 			</td>
		</tr>
		<tr>
		<td bgcolor=#ffffff valign=top>
			<blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
				<TBODY>
					<TR>
						<TD>
							<TABLE cellSpacing=1 cellPadding=3 width=600>
                   				<?php
									if ($mode=="registered") {
								?>
				    			<TBODY class="submenu">
				      				<TR> 
				        				<td align=center><img src="../../gui/img/common/default/showdata.gif" border=0></td>
				       					<TD class="submenu_item"><nobr><a href="arv_registration.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $_GET['encounter_nr']; ?>&pid=<?php echo $_GET['pid']?>&mode=edit" target="_parent">Edit ARV Patient</a></nobr></TD>
				        				<TD>Edit Patient's ARV Registration data</TD>
				      				</tr>
				      				<TR> 
				        				<td align=center><img src="../../gui/img/common/default/new_group.gif" border=0></td>
				        				<TD class="submenu_item"><nobr><a href="<?php echo $root_path ?>modules/arv_2/arv_visit_frameset.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $_GET['encounter_nr']; ?>&pid=<?php echo $_GET['pid']?>&mode=new" target="_parent">New Visit</a></nobr></TD>
				        				<TD>Insert data of a new arv visit</TD>
				     				</tr>
				      				<TR> 
				        				<td height="26" align=center><img src="../../gui/img/common/default/pdata.gif" border=0 width="16" height="16"></td>
				        				<TD class="submenu_item"><nobr><a href="arv_overview.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $_GET['encounter_nr']; ?>&pid=<?php echo $_GET['pid']?>" target="_parent">Show ARV Data</a></nobr></TD>
				        				<TD>Get an overview over patient's ARV data</TD>
				      				</tr>
				      				<TR> 
				        				<td height="26" align=center><img src="../../gui/img/common/default/yellowlist.gif" border=0 width="16" height="17"></td>
				        				<TD class="submenu_item"><nobr><a href="arv_education_menu.php<?php echo URL_APPEND ?>&encounter_nr=<?php echo $_GET['encounter_nr']; ?>&pid=<?php echo $_GET['pid']?>" target="_parent">Follup-up education</a></nobr></TD>
				        				<TD>Get an overview over patient's ARV data</TD>
				      				</tr>
				      				<TR  height=1> 
				        				<TD colSpan=3 class="vspace"><IMG height=1 src="../../gui/img/common/default/pixel.gif" width=5></TD>
				      				</TR>
				    			</TBODY>
								<?php
								}
								else {
								?>
    							<TBODY class="submenu">
      								<TR> 
						        		<td align=center><img src="../../gui/img/common/default/showdata.gif" border=0></td>
						        		<TD class="submenu_item"><nobr><a href="arv_registration.php<?php echo URL_APPEND ?>&pid=<?php echo $_GET['pid']?>&encounter_nr=<?php echo $_GET['encounter_nr']; ?>&mode=new" target="_parent">New ARV Patient</a></nobr></TD>
						        		<TD>Admit a new patient to the arv programme</TD>
      								</tr>
   	 							</TBODY>
								<?php
								}
								?>
                  			</TABLE>
						</TD>
					</TR>
				</TBODY>
			</TABLE>
			<p>
			<p>
			</blockquote>									
		</td>
	</tr>
		<tr valign=top >
			<td bgcolor=#cccccc>
				<?php require($root_path.'include/inc_load_copyrite.php');?>
			</td>
		</tr>
	</tbody>
</table>
</BODY>
</HTML>
