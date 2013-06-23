<?php $insurance_tz->Display_Header($LDMemberManagement); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

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

<?php $insurance_tz->Display_Headline($LDMemberManagement, 'insurance_companies_insert.php','Administrative Companies :: Insert new insurance'); ?>



 <table>
  <tr>
    <td><form name="insurance" method="post">
    <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
    <input type="hidden" name="mode" value="new">
	<table width="" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
          <tr>
            <td width="" align="center">
						<?php
						if(isset($error)) echo '<font color="red"><center>'.$error.'</center></font>';
						$insurance_tz->ShowInsuranceHeadline($company_id);
						$insurance_tz->NewContractForm($company_id);
						?>
	 	</td>
          </tr>
          <tr>
            <td align="center">
            	<table border="0" cellpadding="0" cellspacing="0" align="center" width="">
            		<tr>
				<td align="center"><input type="image" src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)"></td>
                	</tr>
               </table>
	     </td>
          </tr>
        </table>
     </form>
   </td>
  </tr>
</table>

<?php $insurance_tz->Display_Footer($LDMemberManagement, 'insurance_companies_insert.php','Administrative Companies :: Insert new insurance'); ?>

<?php $insurance_tz->Display_Credits(); ?>
