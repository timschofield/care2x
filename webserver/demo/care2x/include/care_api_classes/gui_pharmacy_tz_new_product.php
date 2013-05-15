<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE>Pharmacy::Databank::New product - </TITLE>
  <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
  <meta name="Author" content="Robert Meggle">
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

</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066 onLoad="document.inputform.bestellnum.focus()" >

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Pharmacy::My product catalog</font>
       </td>

  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('products_db.php','input','','pharma')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="../../modules/pharmacy_tz/pharmacy_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>
 </table>		</td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>


<font class="prompt">&nbsp;</font>

<font class="warnprompt">  <br> </font>

<form ENCTYPE="multipart/form-data" action="pharmacy_tz_new_product.php" method="post" name="inputform">


	      <table border=0 cellspacing=1 cellpadding=3>
            <tbody class="submenu">
              <tr>
                <td align=right width=103> Pediatric</td>
                <td align=right width=27 class="prompt">
                <input type="checkbox" name="is_peadric" <?php if (isset($is_peadric)) echo "checked";?>></td>
                <td align=right width=206 >Selian Item Number</td>
                <td width="349"><input type="text" name="bestellnum" value="" size=20 maxlength=20></td>
                <td width="12" rowspan=15 valign=top> <br>
                </td>
              </tr>
              <tr>
                <td align=right width=103>Adult List</td>
                <td align=right width=27><input type="checkbox" name="is_adult" <?php if (isset($is_adult)) echo "checked";?>></td>
                <td align=right width=206>Pack size</td>
                <td><input type="text" name="artname" value="" size=40 maxlength=40>
                  (for add. information)</td>
              </tr>
              <tr>
                <td align=right>Other</td>
                <td align=right><input type="checkbox" name="is_other" <?php if (isset($is_other)) echo "checked";?>></td>
                <td align=right>Hospital&acute;s item description:</td>
                <td><input type="text" name="generic" value="" size=40 maxlength=60>
                  (will be shown)</td>
              </tr>
              <tr>
                <td align=right width=103>Consumable</td>
                <td align=right width=27><input type="checkbox" name="is_consumable" <?php if (isset($is_consumable)) echo "checked";?>></td>
                <td align=right width=206> Hospital&acute;s Price of this item:</td>
                <td><input type="text" name="medgroup" value="" size=20 maxlength=40>
                  TSH (e.g. 1200,00 or 1200 )</td>
              </tr>
              <tr>
                <td align=right width=103>&nbsp;</td>
                <td align=right width=27>&nbsp;</td>
                <td align=right width=206><p>Full description of this item </p>
                  <p>( just for internal use) </p></td>
                <td><textarea name="besc" cols=35 rows=4></textarea></td>
              </tr>

              <tr>
                <td align=right width=103>&nbsp;</td>
                <td align=right width=27>&nbsp;</td>
                <td align=right width=206>item classificatoion </td>
                <td><select name="select">
                    <option value="drug_list" selected>drug</option>
                    <option value="supplies">supplies</option>
                    <option value="supplies_laboratory">supplies Laboratory</option>
                    <option value="special_others_list">special others</option>
                  </select></td>
              </tr>
              <tr>
                <td align=right width=103>&nbsp;</td>
                <td align=right width=27>&nbsp;</td>
                <td align=right width=206><input type="reset" value="Reset" onClick="document.inputform.bestellnum.focus()" ></td>
                <td align=right><input type="hidden" name="picref" value=""> <input type="submit" value="Save">
                </td>
              </tr>
            </tbody>
          </table>

          <input type="hidden" name="mode" value="insert">
          <input type="hidden" name="lang" value="en">

  </form>

<a href="../../modules/pharmacy_tz/pharmacy_tz.php"><img src="../../gui/img/control/default/en/en_cancel.gif" border=0 align="left" width="103" height="24" alt="Go back to databank menu"></a>
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
	    <div class="copyright"></div>
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

</BODY>
</HTML>