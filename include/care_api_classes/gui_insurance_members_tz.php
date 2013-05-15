<?php $insurance_tz->Display_Header($LDMemberManagement); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip')" onSubmit="javascript:submit_form(this,'insurance_members_tz.php','<?php echo $sid ?>','Search')">

<?php $insurance_tz->Display_Headline($LDMemberManagement, 'insurance_members.php','Insurance Management :: Member Management'); ?>

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript" src="../../js/check_insurance_form.js"></script>

			<form name="insurance" method="post" action="insurance_members_tz.php<?php echo URL_APPEND; ?>">
			<input type="hidden" name="mode" value="update">
			<table width="100%" border="0" bgcolor="#CAD3EC" cellpadding="1" cellspacing="1">
				<tr>
					<td width="100%" align="center">
						<?php echo $LDSelectInsurance; ?><br>
						<?php $insurance_tz->ShowInsurancesDropDown('company_id',$company_id); ?>
						<br><br>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<?php echo $LDSearch; ?>
									<br>
									<input type="text" size="31" name="keyword" value="<?php echo $keyword; ?>">
									<input type="button" value="<?php echo $LDSearch; ?>"onClick="javascript:submit_form(this,'insurance_members_tz.php','<?php echo $sid ?>','search');">
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
					<td><div align="center">
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
	

<?php $insurance_tz->Display_Footer($LDMemberManagement, 'insurance_members.php','Insurance Management :: Member Management'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>
