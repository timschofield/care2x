<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE> <?php echo $LDBillingInsurance; ?> </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Robert Meggle">
<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
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

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang; ?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

  	<script language="javascript">
<!--
function closewin()
{
	location.href='startframe.php?sid=<?php echo $sid."&lang=".$lang; ?>';
}
// -->
</script>



</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >
<form method="post">
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="titlebar" >
            <td bgcolor="#99ccff" >
                &nbsp;&nbsp;<font color="#330066"><?php echo $LDInsuranceCompaniesSetup; ?></font>

       </td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('insurance_companies_edit.php','Administrative Companies :: Setup')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="insurance_tz.php?ntid=false&lang=$lang" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>
 </tr>
 </table></td>
	</tr>
	<tr>
		<td height="20"> <?php echo $updated; ?><img src="<?php echo $root_path; ?>gui/img/common/default/common_infoicon.gif" align="absmiddle"> <b><?php echo $LDMasterFileData; ?></b></td>
	</tr>
	<tr>
		<td height=75>
			<input type="hidden" name="id" value="<?php echo $this_insurance['id']; ?>"
			<table border="0" cellpadding="2" cellspacing="0" width="788">
				<tr bgcolor=ffffaa>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDCompanyName.'',$error['name']);?></td>
					<td><input type="text" name="name" size=30 value="<?php echo $this_insurance['name']; ?>"></td>
					<td><?php echo $LDPOBOX; ?></td>
					<td><input type="text" name="po_box" size=30 value="<?php echo $this_insurance['po_box']; ?>"></td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDContractPerson.'',$error['contact']);?></td>
					<td><input type="text" name="contact" size=30 value="<?php echo $this_insurance['contact']; ?>"></td>
					<td><?php echo $LDCity; ?></td>
					<td><input type="text" name="city" size=30 value="<?php echo $this_insurance['city']; ?>"></td>
				</tr>
				<tr bgcolor=ffffaa>
					<td><?php $insurance_tz->ShowRedIfError('Insurance preselection',$error['insurance']);?>:</td>
					<td><?php  if (!$insurance_tz->is_company_just_invoiced($this_insurance['id'] || empty($invoice_flag)))
									$insurance_tz->ShowInsuranceTypesDropDown('insurance',$this_insurance['insurance'],'WITH_EMPTY_FIRST_FIELD'); ?></td>
					<td><input type="checkbox" name="invoice_flag" <?php if($this_insurance['invoice_flag']) echo 'checked'; ?>><?php echo $LDPaybyInvoice; ?> </td>
					<td><input type="checkbox" name="credit_preselection_flag" <?php if($this_insurance['credit_preselection_flag']) echo 'checked'; ?>><?php echo $LDGetsCompanyCredit; ?> </td>
				</tr>
				<tr bgcolor=ffffee>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDPrepaid_Amount.'',$error['hide_prepaid_amount']);?>:</td>
					<td><input type="text" name="prepaid_amount" size=25 value="<?php echo $this_insurance['prepaid_amount']; ?>">&nbsp; <?php echo $LDTSH;?></td>
					<td><?php $insurance_tz->ShowRedIfError(''.$LDHideCompany.'',$error['hide_company_flag']);?>:</td>
					<td><input type="checkbox" name="hide_company_flag" <?php if($this_insurance['hide_company_flag']) echo 'checked'; ?>><?php echo $LDYes; ?> </td>
				</tr>
				<tr bgcolor=ffffaa>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td height="30"><img src="<?php echo $root_path; ?>gui/img/common/default/documents.gif" align="absmiddle"> <b><?php echo $LDContracts; ?></b></td>
	</tr>
	<tr>
		<td bgcolor=#ffffff valign=top>
				<?php
				$insurance_tz->ShowContractsOfCompany($id); ?>
		<table border="0" width="788" cellpadding="0" cellspacing="0">
  		<tr>
  			<td>
  				<input type="image" src="<?php echo $root_path; ?>gui/img/control/default/en/en_update.gif" onClick="">
  				<a href="insurance_company_tz_contracts_new.php?company_id=<?php echo $id ?>">
  					<img border="0" src="<?php echo $root_path; ?>gui/img/control/default/en/en_create_new_contract.gif"></a>
  				<?php if ($SHOW_ADDMEMBER_BUTTON) { ?>
					<a href="insurance_members_tz.php?company_id=<?php echo  $id;?>">	<img border="0" src="<?php echo $root_path; ?>gui/img/control/default/en/en_members.gif"></a>
				<?php } ?>


  			</td>
  			<td align="right">
				<table border="1" cellpadding="2" cellspacing="0">
			    	<tr>
			    		<td width="83"><b><?php echo $LDColorLegend; ?></b></td><td bgcolor=#DBDBDB width="80" align="center"><?php echo $LDdeactivatedcontract; ?></td><td bgcolor=#FFBD72 width="80" align="center"><?php echo $LDActualcontract; ?></td>
			    		<td bgcolor=#ffffaa width="80" align="center"><?php echo $LDOldFutureContracts; ?></td>
			    	</tr>
			    </table>
  			</td>
  		</tr>
  	</table>
			<p>
			</blockquote>
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

	urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
	creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
//  Script End -->
</script>


 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
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
</form>
</BODY>
</HTML>