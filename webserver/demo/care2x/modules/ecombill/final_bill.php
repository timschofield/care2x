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

$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');
	
$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

//$db->debug=1;

    /* include('includes/condb.php');
    error_reporting(0);
    connect_db(); */   
	
	$presdate=date("Y-m-d");
    
    //-----------------------------------------------------------
    $chkpendbillqry="SELECT bill_item_status FROM care_billing_bill_item where bill_item_encounter_nr='$patientno' and bill_item_status='0'";
    if($chkpendbillres=$db->Execute($chkpendbillqry))
	    $chkcnt=$chkpendbillres->RecordCount();
           
    if($chkcnt>0)
    {
    	html_rtl($lang); 
    	echo "<table border=0 width=101% bgcolor=#99ccff>";
	echo "<tr>";
	echo "<td width=101%><font color=#330066 size=+3 face=Arial><strong>eComBill</strong></font></td>";
	echo "</tr>";
    	echo "</table>";
    	echo "<center><h4>You have Bills Pending.</center></h4>";
    	echo "<center><h4>Save the Current Bill before generating the Final Bill</center></h4>";
    	echo "<form>";
    	echo "<center><input type=button name=back value=Back onclick=javascript:history.back(1)></center>";
    	echo "</form>";
    	echo "</HTML>";    	
    	exit;
    }
    
    //-----------------------------------------------------------

    	$sql="SELECT final_bill_no FROM care_billing_final ORDER BY final_bill_no DESC LIMIT 1";
    	if($ergebnis=$db->Execute($sql))
			$cntergebnis=$ergebnis->RecordCount();

    	$actMil=2000;
    	$ybf=date(Y)-$actMil;

    	//check for empty set

    	if($cntergebnis){
			$result=$ergebnis->FetchRow();
    		$final_bill_no=$result['final_bill_no'];

    		// add one to receipt number for new bill
    		$final_bill_no+=1;
    	}else{
    		//generate new final bill number

    		$ybf="7".$ybf."000000";

    		$final_bill_no=(int)$ybf;

    	}


    	if($final_bill_no==10000000000) $final_bill_no="7".$ybf."000000";
    	// limit to 10 digit, reset variables

	$patqry="SELECT e.*,p.* FROM care_encounter AS e, care_person AS p WHERE e.encounter_nr=$patientno AND e.pid=p.pid";
    $resultpatqry=$db->Execute($patqry);
	if(is_object($resultpatqry)) $patient=$resultpatqry->FetchRow();

    $finalqry="SELECT SUM(bill_amount) AS total_amount, SUM(bill_outstanding) AS total_outstanding FROM care_billing_bill WHERE bill_encounter_nr=$patientno";
    $resultfinalqry=$db->Execute($finalqry);
    if(is_object($resultfinalqry)){
		$buffer=$resultfinalqry->FetchRow();
		$totalbill=$buffer['total_amount'];
	}else{
	    $totalbill=0;
	}
/*    $finalqry="SELECT bill_amount,bill_outstanding FROM care_billing_bill WHERE bill_encounter_nr=$patientno ORDER BY bill_bill_no";
    $resultfinalqry=$db->Execute($finalqry);
    if(is_object($resultfinalqry)) $cntbill=$resultfinalqry->RecordCount();

    $totalbill=0;
    for($i=0;$i<$cntbill;$i++)
    {
       $billamt=mysql_result($resultfinalqry,$i,"bill_amount");
       $totalbill= $totalbill+$billamt;
    }
*/
    //$outstding=mysql_result($resultfinalqry,$cntbill-1,"bill_outstanding");
    //$paidamt=$totalbill-$outstding;

    $totalpaymentamtqry="SELECT SUM(payment_amount_total) AS total_payment_amount FROM care_billing_payment WHERE payment_encounter_nr=$patientno";
    $totalpaymentresult=$db->Execute($totalpaymentamtqry);
    if(is_object($totalpaymentresult)){
		$buffer=$totalpaymentresult->FetchRow();
		$totpayment=$buffer['total_payment_amount'];
	}else{
	    $totpayment=0;
	}

/*    $totalpaymentamtqry="SELECT payment_amount_total FROM care_billing_payment WHERE payment_encounter_nr=$patientno";
    $totalpaymentresult=mysql_query($totalpaymentamtqry);
    $cnttotpayment=mysql_num_rows($totalpaymentresult);
    $totpayment=0;

    for($j=0;$j<$cnttotpayment;$j++)
    {
    	$totpayment=$totpayment+mysql_result($totalpaymentresult,$j,"payment_amount_total");
    }
*/
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title>Patient Name</title>
<SCRIPT language="JavaScript">
<!--
	function submitform()
	{
		document.frmfinal.action = "confirmfinalbill.php";
		document.frmfinal.submit();
	}
//-->
</SCRIPT>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong>eComBill - Final bill</strong></font></td>
      </tr>
    </table>

<form name=frmfinal method="POST" action="">
  <p>&nbsp;</p>
  <div align="center">
    <center>
    <table border="1" width="585" height="233" bordercolor="#000000" style="border-style: solid">
      <tr>
        <td width="348" height="155" valign="top" bordercolor="#FFFFFF">
          <b>General Information:</b>
          <table border="0" width="721%" height="155" cellpadding="0">
            <tr>
              <td width="100%" height="19">Patient Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $patient['title'].' '.$patient['name_last'].' '.$patient['name_first'];?></td>
            </tr>
            <tr>
               <td valign=top width="20%">Patient's Address:   <?php echo $patient['addr_str'].' '.$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].'  '.$patient['addr_citytown_nr'];?></td>
            </tr>
            <tr>
              <td width="100%" height="25">Patient Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $patient['title'];?></td>
            </tr>
            <tr>
              <td width="100%" height="25">Date of Birth:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo formatDate2Local($patient['date_birth'],$date_format);?></td>
            </tr>
            <tr>
              <td width="100%" height="19">Sex :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo $patient['sex'];?></td>
            </tr>
            <tr>
              <td width="100%" height="12">Patient No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $full_en;?></td>
            </tr>
          </table>
        </td>
        <td width="287" height="155" valign="top" bordercolor="#FFFFFF">
          &nbsp;
          <table border="0" width="100%" height="150">
            <tr>
              <td width="100%" height="19">Bill No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $final_bill_no; ?></td>
            </tr>
            <tr>
	                  <td width="100%" height="19">Bill
	                    Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                    :&nbsp; <?php echo formatDate2Local($presdate,$date_format); ?></td>
            </tr>
            <tr>
              <td width="100%" height="19">Date of Admission: <?php echo formatDate2Local($patient['encounter_date'],$date_format);?></td>
            </tr>
            <tr>
              <td width="100%" height="19"></td>
            </tr>
            <tr>
              <td width="100%" height="19"></td>
            </tr>
            <tr>
              <td width="100%" height="19"></td>
            </tr>

            <tr>
              <td width="100%" height="19"></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr><td colspan="2" height="1" width="641" bordercolor="#FFFFFF">&nbsp;
          <p><b>Billing Information:</b></p>
        </td></tr>

      <tr><td height="107" width="414" bordercolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <table border="0" width="107%" height="127">
            <tr>
              <td width="75%" valign="middle" align="left" height="18">Total
                bill amount</td>
              <td width="28%" valign="middle" align="center" height="18"><?php echo $totalbill; ?></td>
            </tr>
            <tr>
              <td width="75%" valign="middle" align="left" height="19" bordercolor="#FFFFFF">Discount on total amount
                (in percentage)</td>
              <td width="28%" valign="middle" align="center" height="19">
              <input type="text" name="discount" size=5>
              </td>
            </tr>

            <tr>
              <td width="75%" valign="middle" align="left" height="19">Amount
                previously received</td>
              <td width="28%" valign="middle" align="center" height="19"><?php echo $totpayment; ?></td>
            </tr>
            </table>
        </td></tr>

    </table>
    </center>
  <p>&nbsp;</p>
    <input type="hidden" name="totalbill" value=<?php echo $totalbill; ?>>
    <input type="hidden" name="outstding" value=<?php echo $outstding; ?>>
    <input type="hidden" name="paidamt" value=<?php echo $totpayment; ?>>
    <input type="hidden" name="patientno" value=<?php echo $patientno; ?>>
    <input type="hidden" name="final_bill_no" value=<?php echo $final_bill_no; ?>>
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">

	<a href="javascript:submitform();"><img <?php echo createLDImgSrc($root_path,'continue.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      </center>
  </div>
  <p>&nbsp;&nbsp;
<!--   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Continue" name="B1" Onclick="javascript:submitform();">&nbsp;&nbsp;&nbsp;&nbsp;
 -->  </p>
  <p>&nbsp;</p>
</form>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

