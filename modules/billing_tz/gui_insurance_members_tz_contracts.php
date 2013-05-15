<?php $insurance_tz->Display_Header('Insurance Company - Member Management'); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >


<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript">
function show_contract_popup(company,pid)
{
	urlholder="show_contract.php?company=" + company + "&pid=" + pid;
	//alert(urlholder);
	helpwin=window.open(urlholder,"helpwin","width=620,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
</script>
<script language="javascript" src="../../js/check_insurance_form.js"></script>

<?php $insurance_tz->Display_Headline('Insurance Company - Member Management', 'insurance_members.php','Insurance Management :: Member Management'); ?>

			<form name="insurance" method="post" >
    			<input type="hidden" name="mode" value="update">
    			<input type="hidden" name="insurance" value="<?php echo $company_id; ?>">
			<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          			<tr>
            				<td width="100%" align="center">
						<?php
						$insurance_tz->ShowInsuranceHeadline($company_id);
						$insurance_tz->ShowMemberForms($contract_array);
						?>
            				</td>
          			</tr>
          			<tr>
            				<td align="center">
            					<table border="0" cellpadding="0" cellspacing="0" align="center" width="435">
            						<tr>
								<td align="center"><input type="image" name="todo" value="finish" src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></td>
                					</tr>
               					</table>
			       		</td>
          			</tr>

        		</table>
	 		</form>
	
<?php $insurance_tz->Display_Footer('Insurance Companys - Member Management', 'insurance_members.php','Insurance Management :: Member Management'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>
