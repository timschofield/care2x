<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');

$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/*	include('includes/condb.php');
	error_reporting(0);
	connect_db();*/

$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Check if final bill is available, if yes hide new  payment menu item

$chkfinalquery="SELECT * from care_billing_final WHERE final_encounter_nr='$full_en'";
/*$chkfinalresult=mysql_query($chkfinalquery);
$chkexists=mysql_num_rows($chkfinalresult);
*/
$chkfinalresult=$db->Execute($chkfinalquery);

if(is_object($chkfinalresult)) $chkexists=$chkfinalresult->RecordCount();

# Extract the language variable
extract($TXT);

?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<Script language=Javascript>
function show()
{	
	document.receiptlinks.action="patient_payment.php";
	document.receiptlinks.submit();
}
function showreceipt(receiptid)
{	
	document.receiptlinks.action="showpayment.php?receiptid="+receiptid;
	document.receiptlinks.submit();
}

</script>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill ?> - <?php echo $Payments ?></strong></font></td>
      </tr>
    </table>
    <p>&nbsp;</p>
      <div align="center">
        <center>
    <table border="0" width="585" height="11" bordercolor="#000000">
    	<tr><td colspan=2><b><?php echo $PatientNumber ?>:</b> <?php echo "<b>".$full_en."</b>"; ?></td></tr>
    	<tr><td colspan=2><hr></td></tr>
    	<tr><td width=60%><b><?php echo $ReceiptNumber ?></b></td><td><b><?php echo $ReceiptDateTime ?></b></td></tr>
    	<tr><td colspan=2><hr></td></tr>
    
    	<tr>
    	<td><a href=javascript:show()><?php if(!$chkexists) echo $MakeaNewPayment ?></a></td>
    	</tr>	
    	
    	<?php
    	$receiptquery="SELECT * from care_billing_payment WHERE payment_encounter_nr=$patientno ORDER BY payment_date DESC";
    	//$resultreceiptquery=mysql_query($receiptquery);
    	//$count=mysql_num_rows($resultreceiptquery);
    	if($resultreceiptquery=$db->Execute($receiptquery)){
    		if($resultreceiptquery->RecordCount()){
    			while ($payment=$resultreceiptquery->FetchRow()){    	
					echo "<tr>";
					echo "<td><a href=javascript:showreceipt('".$payment['payment_receipt_no']."')>".$payment['payment_receipt_no']."</a></td>";    
					echo "<td>".$payment['payment_date']."</td>";
					echo "</tr>";
    			}
			}
		}
/*    	for ($i=0;$i<=$count;$i++){    	
			$chkdup=mysql_result($resultreceiptquery,$i-1,'payment_receipt_no');
			if($chkdup != mysql_result($resultreceiptquery,$i,'payment_receipt_no')){    		
				echo "<tr>";
				echo "<td><a href=javascript:showreceipt("."'".mysql_result($resultreceiptquery,$i,'payment_receipt_no')."'".")>".mysql_result($resultreceiptquery,$i,'payment_receipt_no')."</a></td>";    
				echo "<td>".mysql_result($resultreceiptquery,$i,'payment_date')."</td>";
				echo "</tr>";
			}	    	
    	}
*/    	?>    	
    	
    </table>
		<p>&nbsp;<p>
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      

        </center>
      </div>
  <p>&nbsp;</p>
    
<form method="post" name="receiptlinks" action="patient_payment.php">
<input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
</form>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

<?php //disconnect_db(); ?>
