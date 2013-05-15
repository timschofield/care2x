<?php $billing_tz->Display_Header($LDPendingBills,'$enc_obj->ShowPID($batch_nr)',''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip');" >

<?php $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>
<?php $billing_tz->Display_Headline($LDPendingBills, '', ''.$encoded_batch_number.'','billing_pendingbills.php','Billing :: Pending Bills'); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >


<table border="0">
	<tr valign="top">
		<!-- Left block for the request list  -->
		    <td> <br><br>



		          <?php
                if ($mode=="edit_elem") {
                  $bill_obj->EditBillElement($billing_item);
                } else {
                	$bill_obj->DisplayBills($batch_nr,$billnr,1);
                }

               ?>
     

		</td>
	</tr>
</table>
<?php $billing_tz->Display_Footer($LDPendingBills, '', ''.$encoded_batch_number.'','billing_pendingbills.php','Billing :: Pending Bills'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
