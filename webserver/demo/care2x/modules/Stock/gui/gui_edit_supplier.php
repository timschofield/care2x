<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDPharmacyDBNewProduct; ?> - </TITLE>
  <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">

  <meta name="Author" content="Magohe Iddy>
  <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
require_once('./index.php');
?>
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
 function submitForm()
  {
  var save;
  save=false;
  with(document.supplier){
  if(companyName.value==''){
  alert("Enter Company Name please");
  companyName.focus();
  return save;
  }
  if(contactPerson.value==''){
  alert("Enter Contact person`s Name please");
  contactPerson.focus();
  return save;
  }
  if(address1.value==''){
  alert("Enter Permanent Adderss please");
  address1.focus();
  return save;
  }
  if(address2.value==''){
  alert("Enter  Adderss wich should appear on order/purchase please");
  address2.focus();
  return save;
  }
  if(phone1.value==''){
  alert("Enter  Telephone number please");
  phone1.focus();
  return save;
  }
  if(cell1.value==''){
  alert("Enter  Mobile number please");
  cell1.focus();
  return save;
  }else{
  action="add_supplier.php"
  submit();

  return true;
  }
  }
  }
</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">



<STYLE TYPE="text/css">
<!--
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.product_table {
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
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}

// .class_classification {
}
.classification {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: dotted;
	border-bottom-style: none;
	border-left-style: none;
}
.product_price {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: dotted;
	border-right-style: none;
	border-bottom-style: dotted;
	border-left-style: none;
}
-->
</style>

</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo "$company  Edit"; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right>
   <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>

 <a  href="javascript:gethelp('<?php echo $help_file ?>','<?php echo $src ?>')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="../../modules/pharmacy_tz/pharmacy_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>
 </table>		</td>
	</tr>

	<tr>
		<td bgcolor=#ffffff valign=top>


<form  action="" method="post" name="supplier">


	      <table border=0 cellspacing=1 cellpadding=3 class="product_table">
            <tbody class="submenu">
              <tr>

                <td align=right width=145 >Company Name


                                                          </td>
                <td width="550"><input type="text" name="companyName" value="<?php echo $company; ?>" size=40 maxlength=60></td>
                <td width="7" rowspan=16 valign=top> <br></td>
              </tr>
              <tr>


                <td align=right width=145>Contact Person</td>
                <td><input type="text" name="contactPerson" value="<?php echo $person; ?>"  size=40 maxlength=40>
                  </td>
              </tr>

              <tr>


                <td width=145 align=right class="product_price"><p>Permanent</p>
                <p>Address</p></td>
                <td class="product_price"><textarea name="address1" cols=35 rows=4 ><?php echo $address1; ?></textarea></td>
              </tr>
              <tr>


                <td width=145 align=right class="product_price"><p>Address to appear</p>
                <p>on order or Purchase</p></td>
                <td class="product_price"><textarea name="address2" cols=35 rows=4 ><?php echo $address2; ?></textarea></td>
              </tr>



                <td align=right width=145>Telephone Number                  </td>
                <td><input type="text" name="phone1" value="<?php echo $phone1; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Telephone Number 2                  </td>
                <td><input type="text" name="phone2" value="<?php echo $phone2; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
                  <tr>


                <td align=right width=145>Mobile phone Number                 </td>
                <td><input type="text" name="cell1" value="<?php echo $cell1; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Mobile phone Number 2                   </td>
                <td><input type="text" name="cell2" value="<?php echo $cell2; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145><p>Email Address</p>                 </td>
                <td><input type="text" name="emailAddress" value="<?php echo $mail; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>
              <tr>


                <td align=right width=145>Fax Number                  </td>
                <td><input type="text" name="fax" value="<?php echo $fax;?>" size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Banker                  </td>
                <td><input type="text" name="banker" value="<?php echo $banker; ?>" size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Bank Details                  </td>
                <td><input type="text" name="bankDetail" value="<?php echo $bankdetails; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Account Number                 </td>
                <td><input type="text" name="accountNumber" value="<?php echo $account; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Credit Limit                </td>
                <td><input type="text" name="creditLimit" value="<?php echo $creditlimit; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right width=145>Credit Period               </td>
                <td><input type="text" name="creditPeriod" value="<?php echo $creditperiod; ?>"  size=40 maxlength=40>
                  </td>
              </tr>
              <tr>


                <td align=right>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

<!--goes here -->
              <tr>


                <td align=right width=145>&nbsp;</td>
                <td align=right>




				        <input type="hidden" name="id" value="<?php echo $id ?>">

                <input type="submit" value="Save" name="addsupplier" onclick="return submitForm();"/> &nbsp;
  <input type="reset" value="Discard"/>

   </td>
              </tr>
            </tbody>
          </table>
  </form>


		</td>
	</tr>



	</tbody>
 </table>

</BODY>
</HTML>