<?php $billing_tz->Display_Header($LDBillingArchive,'',''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="setBallon('BallonTip');" >

<script language="javascript" >
<!--
function archive()
    {
    document.form1.action="./billing_tz_archive_date.php?search=TRUE";
	document.form1.submit();
	}
function checkValue()
{
	if(document.form2.txtsearch.value=="")
	{
		alert("search term is missing!");
		return false;
	}
}
// -->

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<script src="<?php print $root_path; ?>/include/_jquery.js" language="javascript"></script>
 
<?php $count=$bill_obj->CountArchivedBill(); ?>
<?php $billing_tz->Display_Headline($LDBillingArchive, '/ Total Billings:', ''.$count.'', 'billing_archive_date.php','Billing :: Archive'); ?>

<?php //echo '<iframe name="prescription" src="'.$root_path.'modules/registration_admission/aufnahme_daten_such.php'.URL_APPEND.'&target=search&task=newprescription&back_path='.$back_path.'&pharmacy=yes" width="100%" height="90%" align="left" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="auto" frameborder="0" noresize></iframe> '; ?>

<form name="form1" method="post" action="<?php echo $thisfile; ?>">
<table width=100% border=0 cellspacing=0 height=100%>
  	<tr valign=top>
    		<td colspan="2">
			<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
			   	<tr>
					<td>
						<table width="65%" border="0" align="center" class="table_content" cellpadding=0 cellspacing=0 >
			  				<tr>
			  					<td colspan="6" align="center" bgcolor="#ffffaa" >
								<br><br>
								
							<?php
								include($root_path.'modules/billing_tz/include/inc_gui_timeframe_range.php');
							?>
						<input type="hidden" value="true" name="print">
						<input type="hidden" value="1" name="page">
								<br><br></td>
							</tr>
							<tr>
								<td align="center" bgcolor="#ffffaa" class=td_content>Search for e.g. Patientdetails like (Name, Last Name, PID), Billnumber, Cashier Name<br><br>

							 <input type=search name="txtsearch" value="<?php echo $txtsearch; ?>" > 

							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

							<?php echo $LDTransactionType; ?>
							 <?php echo '<SELECT name="trans_id">';

                                               		 echo '<OPTION selected value="" >All</OPTION>';
                                                	 echo '<OPTION value="0">Cash</OPTION>';
                                                	 echo '<OPTION value="1">Credit</OPTION>';

                                                	 echo '</SELECT>';
                                                	 ?>

							<input type="submit" name="search" value="search">

					 			<input type="hidden" value="true" name="print">
								<input type="hidden" value="1" name="page">
					 	<br>

								<input type="radio" name="searchtyp" value="month" checked> Selected Month
  								<input type="radio" name="searchtyp" value="all" >all archived Bills

								<br><br></td>
			 				</tr>
						</table>
			  			<br><br>


					  <?php
					  	if($_REQUEST['displaybill'] == true)
					  	{
					  		$bill_obj->DisplayArchivedBills($_REQUEST['batch_nr'],$_REQUEST['bill_nr'],0,TRUE);
					  		

					  	}
					  	else
					  	{

					  		if($_REQUEST['sorttyp'] == 'asc')
					  		{
					  			$sorttyp='desc';
					  		}
					  		if($_REQUEST['sorttyp'] == 'desc')
					  		{
					  			$sorttyp='asc';
					  		}
					  		if($_REQUEST['sorttyp'] == '')
					  		{
					  			$sorttyp='asc';
					  		}

					  		if($_REQUEST['sortby']=="nr" && $_REQUEST['sorttyp'] == 'asc')
					  		{
					  			$img_nr="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_nr="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="date" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_date="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_date="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="price" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_price="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_price="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
					  		if(($_REQUEST['sortby']=="user_id" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_user="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_user="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}
							if(($_REQUEST['sortby']=="selian_pid" && $_REQUEST['sorttyp'] == 'asc'))
                                                        {
                                                                $img_pid="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
                                                        }
                                                        else
                                                        {
                                                                $img_pid="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
                                                        }
					  		if(($_REQUEST['sortby']=="pid" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_pid="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_pid="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}

					  	echo '<table width="65%" border="0" align="center" class="table_content" cellpadding=0 cellspacing=0  >';
						$bill_obj->DisplayAllArchivedBillHeadlines($selected_date,$trans_id);

					  	echo '<tr class="tr_content">';
					 	echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=nr&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillNumber.'</a>'.$img_nr.'</div></td>';
					 	echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=date&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillingdate.'</a>'.$img_date.'</div></td>';
					 	echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=price&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">Price</a>'.$img_price.'</div></td>';
						echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=selian_pid&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">File No.</a>'.$img_pid.'</div></td>';
						
					 	echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=pid&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">PID</a>'.$img_pid.'</div></td>';
						
					 	echo '<td class="headline"><div align="center"><a href="billing_tz_archive_date.php?print=true&page=1&sortby=user_id&sorttyp='.$sorttyp.'&day='.$day.'&month='.$month.'&year='.$year.'&selected_date='.$selected_date.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">CashierName</a>'.$img_user.'</div></td>';
                           
							$total_sum = $bill_obj->DisplayAllArchivedBill($txtsearch,$searchtyp,$start_timeframe,$end_timeframe, $trans_id, 400,$day,$month, $year, $sorttyp, $view);	

							echo '</tr>';
							
							echo '<tr class="tr_content">';
                                                        echo '<td class="headline" colspan=6><div align="left">Summary</div></td>';
							echo '</tr>';

 							echo '<tr class="tr_content">';
                                                        echo '<td class="headline"><div align="center">Total Amount</div></td>';
							echo '<td class="headline"><div align="center"></div></td>';
							echo '<td class="headline"><div align="center">'.$total_sum.'</div></td>';
							echo '<td class="headline" colspan=3><div align="center"></div></td>';
                                                        echo '</tr>';

							echo'</table>';
							
					  	}
					  ?>


					</td>
				</tr>
			</table>
		</td>
  	</tr>
</table>
</form>

<?php $billing_tz->Display_Footer($LDBillingArchive, '/ Total Billings:', ''.$count.'', 'billing_archive_date.php','Billing :: Archive'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
