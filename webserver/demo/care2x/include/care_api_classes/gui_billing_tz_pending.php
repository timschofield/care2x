<?php $billing_tz->Display_Header($LDPendingTestRequest,$enc_obj->ShowPID($batch_nr),''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip');" >

<?php $encoded_batch_number=$enc_obj->ShowPID($batch_nr); ?>

<?php $billing_tz->Display_Headline($LDPendingBills, '', '('.$encoded_batch_number.')','billing_pendingbills.php','Billing :: Pending Bills'); ?>

<table border="0">
	<tr valign="top">
		<td>
			<table border="0">
				<tr>
					<!-- Left block for the request list  -->
		    			<td> <br><br><a href="billing_tz_quotation.php"><?php echo $LDGotoQuotations; ?></a></td>
				</tr>
				<tr>
					<td><?php require($root_path.'include/inc_billing_pending_lister_fx.php');?></td>
				</tr>
			</table>
		</td>
		<td rowspan="2">
		<?php
               		if ($NO_PENDING_PRESCRIPTIONS) {
               			echo '<br><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;no pending prescriptions...<br>';
               		} else {
              			//Content-Frame. Here we go!
               			$bill_obj->DisplayBills($pid,0,0);
               			if ($DISPLAY_MSG)
               	  		echo $DISPLAY_MSG;
               		}
       		?>
        	</td>
	</tr>
</tbody>
</table>

<?php $billing_tz->Display_Footer($LDPendingBills, '', '('.$encoded_batch_number.')','pending.php','Billing :: Pending'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
