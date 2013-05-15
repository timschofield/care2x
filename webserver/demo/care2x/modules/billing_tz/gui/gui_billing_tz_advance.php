
<?php $bill_obj->Display_Header($LDProcessAdvance,$enc_obj->ShowPID($batch_nr),''); ?>

<script language="JavaScript" src="<?php echo $root_path;?>js/check_insurance_form.js"></script>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip','','')" >

<script language="javascript">

function createNewContract(urlholder) {
contractwin=window.open(urlholder,"contract","width=600,height=400,status=yes,menubar=no,resizable=yes,scrollbars=yes,statusbar=yes,top=0,left=0");
contractwin.moveTo(0,0);
contractwin.resizeTo(1000,400);
}
</script>

<script language="javascript">

function chkform(form) {

        var advance;
	var user;
	
        advance = document.getElementById('advance');
	user = document.getElementById('username');	

        if (advance.value == "") {
				alert("Enter Advance Amount");
				advance.focus();
				return false;
		}
		else 
		if(isNaN(advance.value))  {
                alert("Wrong Value!Enter advance amount(numbers only) !");
				advance.focus();
                return false;
        }
	 else

         if ((user.value == "") || (user.value == "default")) {
                alert("You are not logged in, logout and then log in again!");
                return false;


        }

	else {

           return this.confSubmit(form);


        }
}

</script>

<script language="javascript">

function confSubmit(form) {

	if (confirm("Proceed and Process Advance?")) {
		form.submit();
		return true;
	}

else {
		alert("Advance Not Processed!");
		//document.discharge_form.reset();
		return false;
	}
}

</script>

<script language="javascript">


</script>

<?php $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>
<?php $bill_obj->Display_Headline($LDCreateQuotationfor, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Create Quotation'); ?>

<form method="POST" action="" onSubmit =" return chkform(this)">

<table width="100%" border="0" cellspacing="0" height="100%">
 	<tr valign=top>
    	<td colspan="2">
			<table width="100%" bgcolor="#ffffff" cellspacing="0" cellpadding="5" >
			   	<tr>
					<td>
			  			<input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">

			  			<table width="700" border="0" align="center" bgcolor="#FFFF88" class="table_content">
			  				<tr>
			  					<td><font class="submenu_item"><?php echo $LDCurrentQuotation; ?></font></td>
			  					<td align="right"><?php echo $namelast.', '.$namefirst.' (PID: '.$encoded_batch_number.')'; ?></td>
			  				</tr>
						</table>

					<table>
				
              				<tr>
					  <td bgcolor="#ffffdd" width="80" colspan="4">
					  <input type="hidden" value="<?php echo $_REQUEST['patient']; ?>" name="patient">
					  <input type="hidden" value="insert" name="task">
					  <input type="hidden" value="<?php echo $encounter_nr; ?>" name="encounter_nr">
					  <input type="hidden" value=<?php echo $createmode; ?> name="createmode">
					  <input type="hidden" value="<?php echo $pid; ?>" name="pid">
					  <input type="hidden" value="<?php echo $_GET['unit_price'];?>" name="unit_price">
					  <input type="hidden" value="<?php echo $_SESSION['sess_user_name'];?>" id="username" name="username">
					  </td>
					  <td bgcolor="#ffffdd" colspan="4" align="right"></td>
							</tr>
						</table>
					  	
						<table width="600" border="0" align="center">

							<tr>
				
							</tr>

							<tr>
								<td align="right">
								<?php echo $LDEnterAdvance; ?>
								</td>
								
								<td align="left">
							<input type="text" name="advance" id="advance" size=25>
								</td>
								
							</tr>
							
							<tr>
								<td align="right">
								<?php echo $LDEnterNotes; ?>
								</td>
								
								<td align="left">
								
							<input type ="text" name="notes" id="notes" size=60>
							
								</td>
							</tr>
							
							<tr>
								<td align="left" colspan=2>
							<input type="reset" size=25 value="<?php echo $LDResetFields; ?>">
								</td>
							</tr>
								
								<tr>
								<td>
								
								</td>
								</tr>
								
								<tr>
								<td colspan=2 align="right">
							<input type="submit" name="finish" value="<?php echo $LDFinished; ?>">
								</td>
							</tr>
						</table>
					</td>
				</tr>
				 
					<tr> 
						<td>
					
						<table width="600" align="center">
							<tr>
								<td><?php echo $LDDate; ?></td>
								<td><?php echo $LDDetails; ?></td>
								<td><?php echo $LDAmount; ?></td>
								<td><?php echo $LDBillNumber; ?></td>
								<td><?php echo $LDReceivedBy; ?></td>
							</tr>
					 
					 			<?php 
					 
								if($advancebills) 
						
								while($adv_row = $advancebills->FetchRow())
								{

									if ($color_change) {
									$BGCOLOR='bgcolor="#ffffdd"';
									$color_change=FALSE;
									} else {
									$BGCOLOR='bgcolor="#ffffaa"';
									$color_change=TRUE;
									}
									
									$date_issued = date("Y/m/d",$adv_row['date_change']);

							echo '<tr>
      				  				<td '.$BGCOLOR.' class="td_content"><div align="center">'.$date_issued.'</div></td>
					  				<td '.$BGCOLOR.' class="td_content"><div align="center">'.$adv_row['description'].'</div></td>
					 				<td '.$BGCOLOR.' class="td_content"><div align="center">'.$adv_row['price'].'</div></td>
									<td	'.$BGCOLOR.' class="td_content"><div align="centre">'.$adv_row['nr'].'</div></td>
					  				<td '.$BGCOLOR.' class="td_content"><div align="center">'.$adv_row['User_Id'].'</div></td>

								<tr>';
									
					
								}
							?>
					</table>
				</td>
			</tr>

</form>

<?php $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>
<?php $bill_obj->Display_Footer($LDProcessAdvance, '', '('.$encoded_batch_number.')','billing_create2.php','Billing :: Process Advance'); ?>

<?php $bill_obj->Display_Credits(); ?>
