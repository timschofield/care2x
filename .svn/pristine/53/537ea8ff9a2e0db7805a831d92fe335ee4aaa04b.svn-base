<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.8 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

//$db->debug = 1;

/*include('includes/condb.php');
error_reporting(0);
connect_db();
*/
$patqry="SELECT e.*,p.* FROM care_encounter AS e, care_person AS p WHERE e.encounter_nr=$patientno AND e.pid=p.pid";
//$resultpatqry=mysql_query($patqry);

if($resultpatqry=$db->Execute($patqry)){
	if($resultpatqry->RecordCount()){
		$patient=$resultpatqry->FetchRow();
	}
}

$presdatetime=date("Y-m-d H:i:s");

$actMil=2000;
$ybr=date(Y)-$actMil;

$sql="SELECT payment_receipt_no FROM care_billing_payment ORDER BY payment_receipt_no DESC";

if($ergebnis=$db->SelectLimit($sql,1)){
	$cntergebnis=$ergebnis->FetchRow();
	
	$receipt_no=$cntergebnis['payment_receipt_no'];
	// add one to receipt number for new bill

	$receipt_no++;

	//check for empty set
}else{
	//generate new bill number
	$ybr="6".$ybr."000000";
	$receipt_no=(int)$ybr;
}


if($receipt_no==10000000000) $receipt_no="6".$ybr."000000";
// limit to 10 digit, reset variables
	

$breakfile='patient_payment_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Extract the language variable
extract($TXT);

?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $BillPayment; ?></title>
<SCRIPT language="JavaScript">
<!--
	function submitform()
	{
		if(isNaN(document.payment.amtcash.value))
		{
			alert("<?php echo $alertEnterNumericValueforCashAmount; ?>");

		}
		else if(isNaN(document.payment.cdno.value))
		{
			alert("<?php echo $alertEnterNumericValueforCreditCardNo; ?>");

		}
		else if(isNaN(document.payment.amtcc.value))
		{
			alert("<?php echo $alertEnterNumericValueforCreditCardAmount; ?>");
		
		}
		else if(isNaN(document.payment.chkno.value))
		{
			alert("<?php echo $alertEnterNumericValueforChequeNo; ?>");
		
		}
		else if(isNaN(document.payment.amtcheque.value))
		{
			alert("<?php echo $alertEnterNumericValueforChequeAmount; ?>");
		
		}
		else
		{
			
		
		var sel = new Array(document.payment.elements.length);
		var temp;
		var tempstr;
		var counter;
		str=document.payment.hidden.value;
		querystr = "confirmpayment.php?";
	
		counter = 1;
		for(i=0;i<document.payment.elements.length;i++)
		{	
			temp = str.indexOf("#");
			if(document.payment.elements[i].type=="checkbox")
			{
				tempstr = str.substring(0,temp);
				str=str.substring(temp+1,str.length);					
				if(document.payment.elements[i].checked == true)
					querystr=querystr+"mode"+counter+"="+tempstr+"&";
				counter = counter + 1;					
			}		
		}
		if(querystr == "confirmpayment.php?")
		{
			alert("<?php echo $alertPleaseSelectatleastOneModeofPayment; ?>");
		}
		else
		{
			document.payment.action = querystr;
			document.payment.submit();
		}
	}
}
//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill; ?> -
          <?php echo $PaymentReceipt; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  
  <form name="payment" method="POST" action="">
  
  
  
 <table border="0" width="95%" bordercolor="#000000">
 	<tr>
         	<td colspan=5 valign="top" height=30 bordercolor="#FFFFFF"><b><?php echo $GeneralInfo; ?>:</b></td>
          </tr>         
           
          <tr>
               <td valign=top width="20%"><?php echo $PatientName; ?>:</td>
               <td valign=top width="20%"><?php echo $patient['title'].' '.$patient['name_first'].' '.$patient['name_last'];?> <?php echo mysql_result($resultpatqry,0,"name_last");?></td>
               <td valign=top width="20%">&nbsp;</td>
               <td valign=top width="10%"><?php echo $ReceiptNumber; ?>:</td>
               <td valign=top width="30%">
               <?php 
		       echo $receipt_no;
               ?>
               </td>
          </tr>
          
          <tr>
               <td valign=top width="20%"><?php echo $PatientAddress; ?>:</td>
               <td valign=top width="20%"><?php echo $patient['addr_str'].' '.$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].' '.$patient['addr_citytown_nr'];?></td>
               <td valign=top width="20%">&nbsp;</td>
               <td valign=top width="10%"><?php echo $BillDate; ?>:</td>
               <td valign=top width="30%">
               <?php 
                   if($receiptid=="")
                   {              
    					echo formatDate2Local($presdatetime,$date_format,1); 
                   }
                   else
                   {
    					$oldbillquery="SELECT payment_date from care_billing_payment WHERE receipt_no=$receipt_no";
        				if($oldbillqueryresult=$db->Execute($oldbillquery)){
							if($oldbillqueryresult->RecordCount()){
								$ob=$oldbillqueryresult->FetchRow();
								echo formatDate2Local($ob['payment_date'],$date_format,1);
							}
						}
                   }
/*               if($receiptid=="")
               {              
			echo $presdatetime; 
               }
               else
               {
			$oldbillquery="SELECT payment_date from care_billing_payment WHERE receipt_no=$receipt_no";
			$oldbillqueryresult=mysql_query($oldbillquery);
			$oldbilldate=mysql_result($oldbillqueryresult,0,'bill_item_date');
			echo $oldbilldate;
               }*/
               ?>
               </td>
          </tr>
             
 	 <tr>
               <td valign=top width="20%"><?php echo $PatientType; ?>:</td>
               <td valign=top width="20%"><?php echo $patient['encounter_class_nr'];?></td>
               <td valign=top width="20%">&nbsp;</td>
               <td valign=top width="10%">&nbsp;</td>
               <td valign=top width="30%">&nbsp;</td>
          </tr>
             
          <tr>
               <td valign=top width="20%"><?php echo $DateofBirth; ?>:</td>
               <td valign=top width="20%"><?php echo formatDate2Local($patient['date_birth'],$date_format);?></td>
               <td valign=top width="20%">&nbsp;</td>
 	      <td valign=top width="10%">&nbsp;</td>
               <td valign=top width="30%">&nbsp;</td>
          </tr>
             
          <tr>
               <td valign=top width="20%"><?php echo $Sex; ?>:</td>
               <td valign=top width="20%"><?php echo $patient['sex'];?></td>
               <td valign=top width="20%">&nbsp;</td>
 	      <td valign=top width="10%">&nbsp;</td>
               <td valign=top width="30%">&nbsp;</td>
          </tr>
             
          <tr>
               <td valign=top width="20%"><?php echo $PatientNumber; ?>:</td>
               <td valign=top width="20%"><?php echo $full_en;?></td>
               <td valign=top width="20%">&nbsp;</td>
 	      <td valign=top width="10%">&nbsp;</td>
               <td valign=top width="30%">&nbsp;</td>              
          </tr>
             
          <tr>
 	     <td valign=top width="20%"><?php echo $DateofAdmission; ?>:</td>
 	     <td valign=top width="20%"><?php echo formatDate2Local($patient['encounter_date'],$date_format);?></td>
 	     <td valign=top width="20%">&nbsp;</td>
 	     <td valign=top width="10%">&nbsp;</td>
              <td valign=top width="30%">&nbsp;</td>
          </tr>
             
          <tr>
 	     <td colspan="5" height="1" width="641" bordercolor="#FFFFFF">&nbsp;</td>
          </tr>
          
          <tr>
              <td colspan="5" height="30" width="641" bordercolor="#FFFFFF"><p><b><?php echo $PaymentInformation; ?>:</b></p></td>
          </tr>
             
          </table> 
  
    
    <div align="center">
      
        
		  <table cellSpacing="1" cellPadding="3" width="522" bgColor="#999999" border="0" height="138">
<tr bgColor="#eeeeee"><td align="left" height="37" width="7738"><font size="4" color="#FF0000">&nbsp;<?php echo $SelecttheModeofCurrentPayment; ?>:</font></td><tr bgColor="#eeeeee"><td align="center" height="7" width="3182">
    <p align="left">
                <input type="checkbox" name="C6" value="ON"><i>
                <b><?php echo $Cash; ?></b></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <p align="left"><?php echo $Amount; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="amtcash" size="7">
  </td></tr><tr bgColor="#dddddd" height="1"><td height="5" width="7738"><img height="1" src="pics/hor_bar.bmp" width="5"></td></tr>
		<tr bgColor="#eeeeee"><td align="center" height="7" width="3182">
                <p style="line-height: 150%" align="left"><i><input type="checkbox" name="C7" value="ON"><b><?php echo $CreditCard; ?></b></i>
		    <p style="line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0" align="left"><?php echo $CardNumber; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cdno" size="12">&nbsp;</p>
                <p style="line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0" align="left"><?php echo $Amount; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="amtcc" size="7"></p>
<!-- Credit Card Types were invisible with <comment></comment> instead of <p></p> -->
                <p>
		    <p style="line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0" align="left"><?php echo $CCType; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" value="V5" checked name="R1">Mastercard&nbsp;
                <input type="radio" name="R1" value="V6">Visa&nbsp;
                <input type="radio" name="R1" value="V7">American Express</p>
		    </p>
<!-- End of Credit Card Types -->

  </td></tr><tr bgColor="#dddddd" height="1">
			<td height="5" width="7738"><img height="1" src="pics/hor_bar.bmp" width="5"></td></tr>
		<tr bgColor="#eeeeee"><td align="center" height="7" width="3182">
                <p style="line-height: 150%; word-spacing: 0; margin: 0" align="left">
			<i><input type="checkbox" name="C8" value="ON"><b><?php echo $Check; ?></b>&nbsp;</i>
		    <p style="line-height: 100%; word-spacing: 0; margin: 0" align="left">
			<?php echo $CheckNumber; ?>
                <input type="text" name="chkno" size="12"><p style="line-height: 100%; word-spacing: 0; margin: 0" align="left">
			<?php echo $Amount; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="amtcheque" size="7"></td></tr>
    <input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
    <input type="hidden" name="hidden" value="C6#C7#C8#">
    <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>"> 
 	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
   
    </table>		
    <p>&nbsp;
	<a href="javascript:submitform();"><img <?php echo createLDImgSrc($root_path,'continue.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      
    </div>
<!--     <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="Continue" name="B1" Onclick="javascript:submitform();"></p>
 -->  </form>
</blockquote>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
 
</body>
</html>


