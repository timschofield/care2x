<?php $billing_tz->Display_Header($LDBillingArchive,'',''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onload="setBallon('BallonTip');" >

<script language="javascript" >
<!--
function archive()
    {
    document.form1.action="./billing_tz_archive.php?search=TRUE";
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
</script>
<?php $count=$bill_obj->CountArchivedBill(); ?>
<?php $billing_tz->Display_Headline($LDBillingArchive, '/ Total Billings:', ''.$count.'', 'billing_archive.php','Billing :: Archive'); ?>

<?php //echo '<iframe name="prescription" src="'.$root_path.'modules/registration_admission/aufnahme_daten_such.php'.URL_APPEND.'&target=search&task=newprescription&back_path='.$back_path.'&pharmacy=yes" width="100%" height="90%" align="left" marginheight="0" marginwidth="0" hspace="0" vspace="0" scrolling="auto" frameborder="0" noresize></iframe> '; ?>

<form name="form1" method="post" action="billing_tz_archive.php">
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
								include($root_path.'modules/billing_tz/include/inc_gui_timeframe.php');
							?>
						<input type="hidden" value="true" name="print">
						<input type="hidden" value="1" name="page">
								<br><br></td>
							</tr>
							<tr>
								<td align="center" bgcolor="#ffffaa" class=td_content>Search for e.g. Patientdetails like (Name, Last Name, PID), Billnumber, Cashier Name<br><br>
							<input type=search name="txtsearch" value="<?php echo $txtsearch; ?>" >					 		<input type="submit" name="search" value="search">
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
					  		if(($_REQUEST['sortby']=="pid" && $_REQUEST['sorttyp'] == 'asc'))
					  		{
					  			$img_pid="<img src=\"../../gui/img/common/default/arrow_red_up_sm.gif\">";
					  		}
					  		else
					  		{
					  			$img_pid="<img src=\"../../gui/img/common/default/arrow_red_dwn_sm.gif\">";
					  		}

					  		echo '<table width="65%" border="0" align="center" class="table_content" cellpadding=0 cellspacing=0  >';
					  		echo '<tr class="tr_content">';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=nr&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillNumber.'</a>'.$img_nr.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=date&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">'.$LDBillingdate.'</a>'.$img_date.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=price&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">Price</a>'.$img_price.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=pid&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">PID</a>'.$img_pid.'</div></td>';
					 		echo '<td class="headline"><div align="center"><a href="billing_tz_archive.php?print=true&page=1&sortby=user_id&sorttyp='.$sorttyp.'&month='.$month.'&year='.$year.'&txtsearch='.$_REQUEST['txtsearch'].'&searchtyp='.$_REQUEST['searchtyp'].'">CashierName</a>'.$img_user.'</div></td>';

							$bill_obj->DisplayAllArchivedBill($txtsearch,$searchtyp, $start_timeframe, $end_timeframe, 50,$month, $year, $sorttyp);

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

<?php $billing_tz->Display_Footer($LDBillingArchive, '/ Total Billings:', ''.$count.'', 'billing_archive.php','Billing :: Archive'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
