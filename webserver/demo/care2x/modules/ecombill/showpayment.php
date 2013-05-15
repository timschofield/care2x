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
define('NO_CHAIN',1);
define('LANG_FILE','billing.php');
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

	/*include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
	
	$patient=array();
	
	//$patqry="SELECT * FROM care_admission_patient WHERE encounter_nr=$patientno";
	$patqry="SELECT e.*,p.* FROM care_encounter AS e, care_person AS p WHERE e.encounter_nr=$patientno AND e.pid=p.pid";
	//$resultpatqry=mysql_query($patqry);
	
	if($resultpatqry=$db->Execute($patqry)){
		if($resultpatqry->RecordCount()){
			$patient=$resultpatqry->FetchRow();
		}
	}
	
	$payment=array();
	
	$showqry="SELECT * FROM care_billing_payment WHERE payment_receipt_no=$receiptid";
	//$resultshowqry=mysql_query($showqry);
	if($resultshowqry=$db->Execute($showqry)){
		if($resultshowqry->RecordCount()){
			$payment=$resultshowqry->FetchRow();
		}
	}
	
$breakfile='patient_payment_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
	
	
/*	$amtcash=mysql_result($resultshowqry,0,payment_cash_amount);
	$chkno=mysql_result($resultshowqry,0,payment_cheque_no);
	$amtcheque=mysql_result($resultshowqry,0,payment_cheque_amount);
	$cdno=mysql_result($resultshowqry,0,payment_creditcard_no);
	$amtcc=mysql_result($resultshowqry,0,payment_creditcard_amount);
	$amttotal=mysql_result($resultshowqry,0,payment_amount_total);
*/

# Extract the language variable
extract($TXT);

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $BillPayment ?></title>
<SCRIPT language="JavaScript">
<!--
	function submitform()
	{		
		document.confirmpayment.action = "postpayment.php";
		document.confirmpayment.submit();
	}
//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill ?> -
          <?php echo $PaymentReceipt ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  
  <form name="confirmpayment" method="POST" action="">   
    <div align="center"> 
    
    <table border="0" width="95%" bordercolor="#000000">
         	<tr>
                 	<td colspan=5 valign="top" height=30 bordercolor="#FFFFFF"><b><?php echo $GeneralInfo ?>:</b></td>
                  </tr>         
                   
                  <tr>
                       <td valign=top width="20%"><?php echo $PatientName ?>:</td>
    	           		<td valign=top width="20%"><?php echo $patient['title'].' '.$patient['name_first'].' '.$patient['name_last'];?></td>
                       <td valign=top width="20%">&nbsp;</td>
                       <td valign=top width="10%"><?php echo $ReceiptNumber ?>:</td>
                       <td valign=top width="30%">
                       <?php 
        		       echo $receiptid;
                       ?>
                       </td>
                  </tr>
                  
                  <tr>
                       <td valign=top width="20%"><?php echo $PatientAddress ?>:</td>
               			<td valign=top width="20%"><?php echo $patient['addr_str'].' '.$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].' '.$patient['addr_citytown_nr'];?></td>
                       <td valign=top width="20%">&nbsp;</td>
                       <td valign=top width="10%"><?php echo $PaymentDate ?>:</td>
                       <td valign=top width="30%">
                       <?php 
        			$oldbillquery="SELECT payment_date from care_billing_payment WHERE payment_receipt_no=$receiptid";
        			if($oldbillqueryresult=$db->Execute($oldbillquery)){
						if($oldbillqueryresult->RecordCount()){
							$ob=$oldbillqueryresult->FetchRow();
							echo formatDate2Local($ob['payment_date'],$date_format,1);
						}
					}
/*        			$oldbillqueryresult=mysql_query($oldbillquery);
        			$oldbilldate=mysql_result($oldbillqueryresult,0,'payment_date');
       			echo $oldbilldate;
*/                        
                       ?>
                       </td>
                  </tr>
                     
         	 <tr>
                       <td valign=top width="20%"><?php echo $PatientType ?>:</td>
                       <td valign=top width="20%"><?php echo $patient['encounter_class_nr'];?></td>
                       <td valign=top width="20%">&nbsp;</td>
                       <td valign=top width="10%">&nbsp;</td>
                       <td valign=top width="30%">&nbsp;</td>
                  </tr>
                     
                  <tr>
                       <td valign=top width="20%"><?php echo $DateofBirth ?>:</td>
                   		<td valign=top width="20%"><?php echo formatDate2Local($patient['date_birth'],$date_format);?></td>
                       <td valign=top width="20%">&nbsp;</td>
         	      <td valign=top width="10%">&nbsp;</td>
                       <td valign=top width="30%">&nbsp;</td>
                  </tr>
                     
                  <tr>
                       <td valign=top width="20%"><?php echo $Sex ?>:</td>
                       <td valign=top width="20%"><?php echo $patient['sex'];?></td>
                       <td valign=top width="20%">&nbsp;</td>
         	      <td valign=top width="10%">&nbsp;</td>
                       <td valign=top width="30%">&nbsp;</td>
                  </tr>
                     
                  <tr>
                       <td valign=top width="20%"><?php echo $PatientNumber ?>:</td>
                       <td valign=top width="20%"><?php echo $full_en;?></td>
                       <td valign=top width="20%">&nbsp;</td>
         	      <td valign=top width="10%">&nbsp;</td>
                       <td valign=top width="30%">&nbsp;</td>              
                  </tr>
                     
                  <tr>
         	     <td valign=top width="20%"><?php echo $DateofAdmission ?>:</td>
         	     <td valign=top width="20%"><?php echo formatDate2Local($patient['encounter_date'],$date_format);?></td>
         	     <td valign=top width="20%">&nbsp;</td>
         	     <td valign=top width="10%">&nbsp;</td>
                      <td valign=top width="30%">&nbsp;</td>
                  </tr>
                     
                  <tr>
         	     <td colspan="5" height="1" width="641" bordercolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  
                  <tr>
                      <td colspan="5" height="30" width="641" bordercolor="#FFFFFF"><p><b><?php echo $PaymentInformation ?>:</b></p></td>
                  </tr>
                     
          </table>
    
    
  <table cellSpacing="1" cellPadding="3" width="522" bgColor="#999999" border="0" height="138">
 	<tr bgColor="#eeeeee">
	   <td align="left" height="37" width="7738"><font size="4" color="#FF0000">&nbsp;<?php echo $ModeofPayment ?>:</font></td>
	   <?php
	      if($payment['payment_cash_amount']!=0)
	      {
		  echo "<tr bgColor=\"#eeeeee\">";
		  echo "<td align=\"center\" height=\"7\" width=\"3182\">";
		  echo "<p align=\"left\">";
		  echo "<i><b>$Cash</b></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
		  echo "<p align=\"left\">$Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  echo $payment['payment_cash_amount'];
		  //echo "<input type=\"hidden\" name=\"amtcash\" value=\"".$amtcash."\">";
		  echo "<input type=\"hidden\" name=\"amtcash\" value=\"".$payment['payment_cash_amount']."\">";
	      }
	  ?>
  </td></tr>
  <?php
  	if($payment['payment_creditcard_amount'] !=0)
  	{
		echo "<tr bgColor=\"#dddddd\" height=\"1\">";
		  echo "<td height=\"5\" width=\"7738\">";
		  echo "<img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\"></td></tr>
			<tr bgColor=\"#eeeeee\"><td align=\"center\" height=\"7\" width=\"3182\">";
		  echo "<p style=\"line-height: 150%\" align=\"left\">";
		  echo "<i><b>$CreditCard</b></i> ";
		  echo "<p style=\"line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0\" align=\"left\">";
		  echo "$CardNumber&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$payment['payment_creditcard_no']."&nbsp;</p>";
		  echo "<p style=\"line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0\" align=\"left\">$Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$payment['payment_creditcard_amount']."</p>";
		  
		echo "</td></tr>";
		echo "<input type=\"hidden\" name=\"cdno\" value=\"".$payment['payment_creditcard_no']."\">";
    		echo "<input type=\"hidden\" name=\"amtcc\" value=\"".$payment['payment_creditcard_amount']."\">";
	}	
  ?>
  <?php
	if($payment['payment_cheque_amount']!=0)
	{
	  echo "<tr bgColor=\"#dddddd\" height=\"1\"><td height=\"5\" width=\"7738\">";
	    echo "<img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\">";
	    echo "</td></tr>";
	    echo "<tr bgColor=\"#eeeeee\"><td align=\"center\" height=\"7\" width=\"3182\">";
	     echo "<p style=\"line-height: 150%; word-spacing: 0; margin: 0\" align=\"left\"><i><b>$Check</b>&nbsp;</i>";
	    echo "<p style=\"line-height: 100%; word-spacing: 0; margin: 0\" align=\"left\">$CheckNumber ";
	      echo $payment['payment_cheque_no'];
	      echo "<p style=\"line-height: 100%; word-spacing: 0; margin: 0\" align=\"left\">$Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	      echo $payment['payment_cheque_amount'];
	    echo "</td></tr>";
	    echo "<input type=\"hidden\" name=\"chkno\" value=\"".$payment['payment_cheque_no']."\">";
	    echo "<input type=\"hidden\" name=\"amtcheque\" value=\"".$payment['payment_cheque_amount']."\">";
    	}	
  ?>
    
    <input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
    <input type="hidden" name="hidden" value="C6#C7#C8#">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
    </table>		
		<p>&nbsp;<p>
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      
	
    </div>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--     <input type="button" value="Print" name="B1" Onclick="javascript:submitform();">
    <input type="button" value="Goback" name="B2" Onclick="javascript:history.go(-1);">
 -->    </p>
   </form>
</blockquote>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

