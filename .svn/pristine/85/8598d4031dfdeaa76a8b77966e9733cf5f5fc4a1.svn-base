<html>
<head>
<title><?php echo $LDMemberManagement; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
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
<script language="javascript" src="../../js/check_insurance_form.js"></script>

</head>

<body onSubmit="javascript:submit_form(this,'insurance_members_tz.php','<?php echo $sid ?>','Search');">
<table width="100%" border="0">
 <tr valign=top>
	<td bgcolor="#99ccff" >
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr  class="titlebar">
			<td>&nbsp;&nbsp;<font color="#330066"><?php echo $LDMemberManagement; ?></font></td>
			<td align="right"><a href="<?php echo $_SESSION['backpath_diag'];?>"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a><?php if($_SESSION['ispopup']=="true")
				$closelink='javascript:window.close();';
			else
				$closelink='insurance_tz.php';
			?>
				<a href="javascript:gethelp('insurance_members.php','Insurance Management :: Member Management')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
				<a href="<?php echo $closelink; ?>"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
			</td>
		</tr>
	</table>
		</td>
 </tr>
	<tr>
		<td><form name="insurance" method="post" action="insurance_members_tz.php<?php echo URL_APPEND; ?>">
		<input type="hidden" name="mode" value="update">
	<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
					<tr>
						<td width="100%" align="center">
						<?php echo $LDSelectInsurance; ?><br>
<?php $insurance_tz->ShowInsurancesDropDown('company_id',$company_id);

 ?><br>

									<br>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<?php echo $LDSearch; ?><br>
												<input type="text" size="31" name="keyword" value="<?php echo $keyword; ?>">
												<input type="button" value="<?php echo $LDSearch; ?>"  onClick="javascript:submit_form(this,'insurance_members_tz.php','<?php echo $sid ?>','search');">
											</td>
										</tr>
									</table>
							<select name="itemlist[]" size="15" style="width:435px;" onDblClick="javascript:item_add();">

									<!-- dynamically managed content -->
									<!-- Show here all hits what is found by the search field (search for registered patients)-->
									<?php

									if(strlen($keyword)>0)
									{
												$result = $person_obj->SearchSelect($keyword,100,0,'name_last','ASC',FALSE);
												if($result)
													while($row=$result->FetchRow())
													{
														echo '<option value="'.$row['pid'].'">'.$row['selian_pid'].' - '.$row['name_last'].', '.$row['name_first'].' ('.$row['date_birth'].')</option>';
													}

									}
									?>
													<!-- dynamically managed content -->

							</select>
						</td>
					</tr>
					<tr>
						<td align="center">
							<table border="0" cellpadding="0" cellspacing="0" align="center" width="435">
								<tr>
									<td width="33%"><a href="#" onClick="javascript:item_add();"><img  src="../../gui/img/control/default/en/en_add_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
									<td width="34%" align="center"><a href="#" onClick="javascript:submit_form(this,'insurance_members_tz_contracts.php','<?php echo $sid ?>','done')"><img  src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
									<td width="33%" align="right"><a href="#" onClick="javascript:item_delete();"><img  src="../../gui/img/control/default/en/en_delete_item.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></a></td>
								</tr>
							 </table>
						 </td>
					</tr>
					<tr>
						<td>
<div align="center">
								<select name="selected_item_list[]" size="10" style="width:435px;" onDblClick="javascript:item_delete();">
									<!-- dynamically managed content -->
									<!-- show here who will be added or those who are still assigned to the company -->
									<?php
										//$insurance_tz->Display_Selected_Elements($item_no,$company_id);
										$insurance_tz->ShowListOfContractedMembers($company_id);
									?>
									<!-- dynamically managed content -->

								</select><br>
						 </div>
						 </td>
					</tr>

				</table>
	 	</form>
	</td>
	</tr>
</table>
</body>
</html>
