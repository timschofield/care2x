<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* 
* 
* 
* 
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('NO_CHAIN',1);
$lang_tables[]='billing.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

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

$breakfile='patient_payment.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;
	
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $LDBillPayment; ?></title>
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
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $LDeComBill; ?> -
          <?php echo $LDPaymentPreview; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  
  <form name="confirmpayment" method="POST" action="">
    
    <div align="center">
    
    
    <table border="0" width="95%" bordercolor="#000000">
     	<tr>
             	<td colspan=5 valign="top" height=30 bordercolor="#FFFFFF"><b><?php echo $LDGeneralInfo; ?>:</b></td>
              </tr>         
               
              <tr>
                   <td valign=top width="20%"><?php echo $LDPatientName; ?>:</td>
    	           <td valign=top width="20%"><?php echo $patient['title'].' '.$patient['name_first'].' '.$patient['name_last'];?></td>
	               <td valign=top width="20%">&nbsp;</td>
                   <td valign=top width="10%"><?php echo $LDReceiptNumber; ?>:</td>
                   <td valign=top width="30%">
                   <?php 
    		       echo $receipt_no;
                   ?>
                   </td>
              </tr>
              
              <tr>
                   <td valign=top width="20%"><?php echo $LDPatientAddress; ?>:</td>
               <td valign=top width="20%"><?php echo $patient['addr_str'].' '.$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].' '.$patient['addr_citytown_nr'];?></td>
                   <td valign=top width="20%">&nbsp;</td>
                   <td valign=top width="10%"><?php echo $LDBillDate; ?>:</td>
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
/*    			$oldbillqueryresult=mysql_query($oldbillquery);
    			$oldbilldate=mysql_result($oldbillqueryresult,0,'bill_item_date');
    			echo $oldbilldate;
                   }
*/                   ?>
                   </td>
              </tr>
                 
     	 <tr>
                   <td valign=top width="20%"><?php echo $LDPatientType; ?>:</td>
                   <td valign=top width="20%"><?php echo $patient['encounter_class_nr'];?></td>
                   <td valign=top width="20%">&nbsp;</td>
                   <td valign=top width="10%">&nbsp;</td>
                   <td valign=top width="30%">&nbsp;</td>
              </tr>
                 
              <tr>
                   <td valign=top width="20%"><?php echo $LDDateofBirth; ?>:</td>
                   <td valign=top width="20%"><?php echo $patient['date_birth'];?></td>
                   <td valign=top width="20%">&nbsp;</td>
     	      <td valign=top width="10%">&nbsp;</td>
                   <td valign=top width="30%">&nbsp;</td>
              </tr>
                 
              <tr>
                   <td valign=top width="20%"><?php echo $LDSex; ?>:</td>
                   <td valign=top width="20%"><?php echo $patient['sex'];?></td>
                   <td valign=top width="20%">&nbsp;</td>
     	      <td valign=top width="10%">&nbsp;</td>
                   <td valign=top width="30%">&nbsp;</td>
              </tr>
                 
              <tr>
                   <td valign=top width="20%"><?php echo $LDPatientNumber; ?>:</td>
                   <td valign=top width="20%"><?php echo $full_en;?></td>
                   <td valign=top width="20%">&nbsp;</td>
     	      <td valign=top width="10%">&nbsp;</td>
                   <td valign=top width="30%">&nbsp;</td>              
              </tr>
                 
              <tr>
     	     <td valign=top width="20%"><?php echo $LDDateofAdmission; ?>:</td>
     	     <td valign=top width="20%"><?php echo formatDate2Local($patient['encounter_date'],$date_format);?></td>
     	     <td valign=top width="20%">&nbsp;</td>
     	     <td valign=top width="10%">&nbsp;</td>
                  <td valign=top width="30%">&nbsp;</td>
              </tr>
                 
              <tr>
     	     <td colspan="5" height="1" width="641" bordercolor="#FFFFFF">&nbsp;</td>
              </tr>
              
              <tr>
                  <td colspan="5" height="30" width="641" bordercolor="#FFFFFF"><p><b><?php echo $LDPaymentInformation; ?>:</b></p></td>
              </tr>
                 
          </table>
    
    
    
      
        
  <table cellSpacing="1" cellPadding="3" width="522" bgColor="#999999" border="0" height="138">
 	<tr bgColor="#eeeeee">
	   <td align="left" height="37" width="7738"><font size="4" color="#FF0000">&nbsp;<?php echo $LDModeofPayment; ?>:</font></td>
	   <?php
	      if(strstr($_SERVER['QUERY_STRING'],"mode1")!="")
	      {
		  echo "<tr bgColor=\"#eeeeee\">";
		  echo "<td align=\"center\" height=\"7\" width=\"3182\">";
		  echo "<p align=\"left\">";
		  echo "<i><b>$LDCash</b></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
		  echo "<p align=\"left\">$LDAmount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  echo $amtcash;
		  echo "<input type=\"hidden\" name=\"amtcash\" value=\"".$amtcash."\">";
	      }
	  ?>
  </td></tr>
  <?php
  	if(strstr($_SERVER['QUERY_STRING'],"mode2")!="")
  	{
		echo "<tr bgColor=\"#dddddd\" height=\"1\">";
		  echo "<td height=\"5\" width=\"7738\">";
		  echo "<img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\"></td></tr><tr bgColor=\"#eeeeee\"><td align=\"center\" height=\"7\" width=\"3182\">";
		  echo "<p style=\"line-height: 150%\" align=\"left\">";
		  echo "<i><b>$LDCreditCard</b></i>";
		  echo "<p style=\"line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0\" align=\"left\">";
		  echo "$LDCardNumber&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$cdno."&nbsp;</p>";
		  echo "<p style=\"line-height: 100%; word-spacing: 0; text-indent: 0; margin: 0\" align=\"left\">
			$LDAmount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$amtcc."</p>";
		  
		echo "</td></tr>";
		echo "<input type=\"hidden\" name=\"cdno\" value=\"".$cdno."\">";
    		echo "<input type=\"hidden\" name=\"amtcc\" value=\"".$amtcc."\">";
	}	
  ?>
  <?php
	if(strstr($_SERVER['QUERY_STRING'],"mode3")!="")
	{
	  echo "<tr bgColor=\"#dddddd\" height=\"1\"><td height=\"5\" width=\"7738\">";
	    echo "<img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\">";
	    echo "</td></tr>";
	    echo "<tr bgColor=\"#eeeeee\"><td align=\"center\" height=\"7\" width=\"3182\">";
	    echo "<p style=\"line-height: 150%; word-spacing: 0; margin: 0\" align=\"left\"><i><b>$LDCheck</b>&nbsp;</i>";
	    echo "<p style=\"line-height: 100%; word-spacing: 0; margin: 0\" align=\"left\">$LDCheckNumber";
	    echo $chkno;
	    echo "<p style=\"line-height: 100%; word-spacing: 0; margin: 0\" align=\"left\">$LDAmount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	    echo $amtcheque;
	    echo "</td></tr>";
	    echo "<input type=\"hidden\" name=\"chkno\" value=\"".$chkno."\">";
	    echo "<input type=\"hidden\" name=\"amtcheque\" value=\"".$amtcheque."\">";
    	}	
  ?>
    
    <input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
    <input type="hidden" name="hidden" value="C6#C7#C8#">
    <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>">   
    <input type="hidden" name="lang" value="<?php echo $lang ?>">
    <input type="hidden" name="sid" value="<?php echo $sid ?>">
    <input type="hidden" name="full_en" value="<?php echo $full_en ?>">
    </table>		
    <p>&nbsp;
	<a href="javascript:submitform();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      </center>

    </div>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--     <input type="button" value="Save" name="B1" Onclick="javascript:submitform();">
    <input type="button" value="Goback" name="B2" Onclick="javascript:history.go(-1);">
 -->    </p>
   </form>
</blockquote>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
 
</body>
</html>

