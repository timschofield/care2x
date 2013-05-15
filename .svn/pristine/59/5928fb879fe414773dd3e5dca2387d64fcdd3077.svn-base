<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*
* 19.Oct.2003 Daniel Hinostroza: Switch language implemented, but... What is the translation of outstanding?
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

//$db->debug=1;

/*	include('includes/condb.php');
	error_reporting(0);
	connect_db();
*/
$breakfile='patient_bill_links.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

		$sql="SELECT bill_bill_no FROM care_billing_bill ORDER BY bill_bill_no DESC";
		$ergebnis=$db->SelectLimit($sql,1);
		if(is_object($ergebnis)) $cntergebnis=$ergebnis->RecordCount();

/*		$ergebnis=mysql_query($sql,$link);
		$cntergebnis=mysql_num_rows($ergebnis);
*/
		$actMil=2000;
		$ybb=date(Y)-$actMil;

		//check for empty set

		if($cntergebnis)
		{
			$result=$ergebnis->FetchRow();
			$bill_no=$result['bill_bill_no'];

			// add one to bill number for new bill
			$bill_no+=1;
		}
		else
		{
			//generate new bill number

			$ybb="5".$ybb."000000";

			$bill_no=(int)$ybb;

		}


		if($bill_no==10000000000) $bill_no="5".$ybb."000000";
		// limit to 10 digit, reset variables

	$billno=$bill_no;

	//$patqry="SELECT * FROM care_admission_patient WHERE encounter_nr=$patientno";
	$patqry="SELECT e.*,p.* FROM care_encounter AS e, care_person AS p WHERE e.encounter_nr=$patientno AND e.pid=p.pid";
	//$resultpatqry=mysql_query($patqry);
	$resultpatqry=$db->Execute($patqry);
	
	if(is_object($resultpatqry)) $patient=$resultpatqry->FetchRow();
		else $patient=array();
		
	$presdatetime=date("Y-m-d H:i:s");

	$labquery="SELECT * FROM care_billing_bill_item WHERE bill_item_encounter_nr=$patientno AND bill_item_status IN ('0','')";
	//$resultlabquery=mysql_query($labquery);
	//$itemcnt=mysql_num_rows($resultlabquery);
	
	$resultlabquery=$db->Execute($labquery);

	$cntLT=0;$cntHS=0;
	
	if(is_object($resultlabquery)){
		
		$itemcnt=$resultlabquery->RecordCount();
		while($labresult=$resultlabquery->FetchRow()){
		
			$lbqry="SELECT item_type FROM care_billing_item WHERE item_code='".$labresult['bill_item_code']."'";
			$resultlbqry=$db->Execute($lbqry);
			
			if(is_object($resultlbqry)){
			
				$buffer=$resultlbqry->FetchRow();
				if($buffer['item_type']=="LT")
				{
    		   		$cntLT=$cntLT+1;
				}
				if($buffer['item_type']=="HS")
				{
		   			$cntHS=$cntHS+1;
				}
			}
		}
	}
	/* Deactivated by EL 2003-05-01 */
/*	for($k=0;$k<$itemcnt;$k++)
	{
		$lbqry="SELECT item_type FROM care_billing_item WHERE item_code='".mysql_result($resultlabquery,$k,"bill_item_code")."'";
		$resultlbqry=mysql_query($lbqry);
		if(mysql_result($resultlbqry,0,"item_type")=="LT")
		{
		   $cntLT=$cntLT+1;
		}
		if(mysql_result($resultlbqry,0,"item_type")=="HS")
		{
		   $cntHS=$cntHS+1;
		}
	}
*/
	if($cntLT>$cntHS)
		$itemcnt=$cntLT;
	if($cntLT<=$cntHS)
		$itemcnt=$cntHS;

	$itemcnt1=$cntLT+$cntHS;

# Extract the language variable
extract($TXT);

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $PatientName ?></title>
<script language="javascript">
<!--
	function printsavebill()
	{
		window.print();
		document.patientbill.action="patientbill_printsave.php";
		document.patientbill.submit();
	}
	function savebill()
	{
		document.patientbill.action="patientbill_printsave.php";
		document.patientbill.submit();
	}
	function cancelbill()
	{
		history.back(1);
	}

//-->

</script>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill; ?> - <?php echo $Bill; ?></strong></font></td>
      </tr>
    </table>

<form name="patientbill" method="POST" action="">
  <div align="center">
    <center>
<table border="0" width="95%" bordercolor="#000000" cellpadding=5 style="border-style:solid">
<tr>
<td>



    <table border="0" width="95%" bordercolor="#000000">
	<tr>
        	<td colspan=5 valign="top" height=30 bordercolor="#FFFFFF"><b><?php echo $GeneralInfo ?></b></td>
         </tr>

         <tr>
              <td valign=top width="20%"><?php echo $PatientName ?>:</td>
			  <td valign=top width="20%"><?php echo $patient['title'].' '.$patient['name_first'].' '.$patient['name_last'];?></td>
              <td valign=top width="20%">&nbsp;</td>
              <td valign=top width="10%"><?php echo $BillNo ?>:</td>
              <td valign=top width="30%">
              <?php
              if($billid=="currentbill")
              {
              	echo $billno;
              }
              else
              {
              	echo $billid;
              }
              ?>
              </td>
         </tr>

         <tr>
              <td valign=top width="20%"><?php echo $PatientAddress ?>:</td>
				<td valign=top width="20%"><?php echo $patient['addr_str'].$patient['addr_str_nr'].'<br>'.$patient['addr_zip'].$patient['addr_citytown_nr'];?></td>
              <td valign=top width="20%">&nbsp;</td>
              <td valign=top width="10%"><?php echo $BillDate ?>:</td>
              <td valign=top width="30%">
              <?php
              if($billid=="currentbill")
              {
              	echo  formatDate2Local($presdatetime,$date_format,1);
              }
              else
              {
              	$oldbillquery="SELECT bill_item_date from care_billing_bill_item WHERE bill_item_bill_no='$billid' and bill_item_status='1'";
              	$oldbillqueryresult=$db->Execute($oldbillquery);
				$buffer=$oldbillqueryresult->FetchRow();
              	$oldbilldate=$buffer['bill_item_date'];

/*              	$oldbillqueryresult=mysql_query($oldbillquery);
              	$oldbilldate=mysql_result($oldbillqueryresult,0,'bill_item_date');
*/
              	echo formatDate2Local($oldbilldate,$date_format,1);
              }
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
             <td colspan="5" height="30" width="641" bordercolor="#FFFFFF"><p><b><?php echo $BillingInformation ?>:</b></p></td>
         </tr>

          </table>
          <table border="0" width="100%" bordercolor="#000000" bgcolor=#999999 height="139" cellspacing="1" cellpadding="3">
	              <tr>
	                <th width="30%" valign="middle" align="left" height="38" bgcolor="#CCCCCC"><?php echo $Description ?></th>
	                <th width="15%" valign="middle" align="center" height="38" bgcolor="#CCCCCC"><?php echo $CostperUnit ?></th>
	                <th width="3%" valign="middle" align="center" height="38" bgcolor="#CCCCCC"><?php echo $Units ?></th>
	                <th width="20%" valign="middle" align="center" height="38" bgcolor="#CCCCCC"><?php echo $TotalCost ?></th>
	                <th width="25%" valign="middle" align="center" height="38" bgcolor="#CCCCCC"><?php echo $ItemType ?></th>

	              </tr>

	      <?php
	       if($billid=="currentbill")
           {
				$resultlabquery->MoveFirst();
				   	
              	      $HStotal=0;$LTtotal=0;
	  	      for($i=0;$i<$itemcnt1;$i++)
	          {
			  	$labres=$resultlabquery->FetchRow();
	  		   $lbqry1="SELECT item_type,item_description FROM care_billing_item WHERE item_code='".$labres['bill_item_code']."'";
	  	   	   //$resultlbqry1=mysql_query($lbqry1);
	  	   	   $resultlbqry1=$db->Execute($lbqry1);
			   if(is_object($resultlbqry1)) $lb1=$resultlbqry1->FetchRow();

	  		  echo "<tr>";
	  		      echo "<td width=\"11%\" valign=\"middle\" align=\"left\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
	  		      echo $lb1['item_description'];
	  		      echo "</td>";

	  		      echo "<td width=\"11%\" valign=\"middle\" align=\"right\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
	  		      echo $labres['bill_item_unit_cost'];
	  		      $cpu=$labres['bill_item_unit_cost'];
	  		      echo "</td>";

	  		      echo "<td width=\"11%\" valign=\"middle\" align=\"center\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
	  		      echo $labres['bill_item_units'];
	  		      $nounits=$labres['bill_item_units'];
	  		      echo "</td>";

	  		      echo "<td width=\"11%\" valign=\"middle\" align=\"right\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
	  		      $totcost=$cpu*$nounits;
	  		      echo $totcost;
	  		      echo "</td>";

	  		      echo "<td width=\"11%\" valign=\"middle\" align=\"center\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
	  		      $type=$lb1['item_type'];
	  			if($type=="HS")
	  			{
	  				echo $MedicalServices;
	  			}
	  			else if($type=="LT")
	  			{
	  				echo $LaboratoryTests;
	  			}
	  		      echo "</td>";
	  		   echo "</tr>";

	  		    if($lb1['item_type']=="HS")
	  		    {
	  		       $HStotal=$HStotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']);
	              	    }
	              	    if($lb1['item_type']=="LT")
	  		    {
	  		       $LTtotal=$LTtotal+($labres['bill_item_unit_cost'])*($labres['bill_item_units']);
	              	    }

	              }

	              $total=$HStotal+$LTtotal;
	        }
	        else
	        {
	        	//echo "OLDBILL";
	        	//echo "<BR>";

	        	$oldbilltotal=0;
	        	$oldbdquery="SELECT bill_item_code,bill_item_unit_cost,bill_item_units,bill_item_amount from care_billing_bill_item WHERE bill_item_bill_no='$billid' and bill_item_status='1'";
	        	
				$oldbdqueryresult=$db->Execute($oldbdquery);
	        	if(is_object($oldbdqueryresult)) $billitemcount=$oldbdqueryresult->RecordCount();
/*				$oldbdqueryresult=mysql_query($oldbdquery);
	        	$billitemcount=mysql_num_rows($oldbdqueryresult);
*/
	        	for ($obc=0;$obc<$billitemcount;$obc++)
	        	{
					$oldbd=$oldbdqueryresult->FetchRow();
	        		$bitcode=$oldbd['bill_item_code'];

	        		$itemdescquery="SELECT item_description,item_type from care_billing_item where item_code='$bitcode'";
	        		$itemdescresult=$db->Execute($itemdescquery);
	        		if(is_object($itemdescresult)) $it=$itemdescresult->FetchRow();
					//$itdesc=mysql_result($itemdescresult,0,'item_description');
					$itdesc=$it['item_description'];
/*	        		$itemdescresult=mysql_query($itemdescquery);
	        		$itdesc=mysql_result($itemdescresult,0,'item_description');
*/
	        		$itemtyp=$it['item_type'];
	        		if($itemtyp=="HS")
	        		{
	        			$itemtyp=$MedicalServices;
	        		}
	        		else if($itemtyp=="LT")
	        		{
	        			$itemtyp=$LaboratoryTests;
	        		}

	        		echo "<tr>";

				echo "<td width=\"11%\" valign=\"middle\" align=\"left\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
				echo $it['item_description'];
	  		      	echo "</td>";

	        		echo "<td width=\"11%\" valign=\"middle\" align=\"right\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
				echo $oldbd['bill_item_unit_cost'];
	  		      	echo "</td>";

	        		echo "<td width=\"11%\" valign=\"middle\" align=\"center\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
				echo $oldbd['bill_item_units'];
	  		      	echo "</td>";

	  		      	echo "<td width=\"11%\" valign=\"middle\" align=\"right\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
				echo $oldbd['bill_item_amount'];
	  		      	echo "</td>";

	  		      	echo "<td width=\"11%\" valign=\"middle\" align=\"center\" height=\"17\" bgcolor=\"#EEEEEE\">&nbsp;";
				echo $itemtyp;
	  		      	echo "</td>";

	        		echo "</tr>";

	        		$oldbilltotal=$oldbilltotal+$oldbd['bill_item_amount'];
	        	}
	       }


	      ?>


	              <tr bgColor="#dddddd" height="1">
	            <td height="5" width="3833" colspan="5"><img height="1" src="pics/hor_bar.bmp" width="5"></td>
	          </tr>

	              <tr>
	                <th colspan=3 width="11%" valign="middle" align="left" height="19" bgcolor="#EEEEEE"><?php echo $Total ?></th>
	                <th width="11%" valign="middle" align="right" height="19" bgcolor="#EEEEEE">
	                <?php
	                if($billid=="currentbill")
              		{
              			echo $total;
              		}
              		else
              		{
              			echo $oldbilltotal;
              		}
	                ?>
	                </th>
	                <th width="11%" valign="middle" align="left" height="19" bgcolor="#EEEEEE">&nbsp;</th>

	              </tr>
	      </table>

            </center>
          </div>

        <?php

	  	//$billqry="SELECT bill_item_amount FROM care_billing_bill WHERE bill_item_encounter_nr=$patientno";
/*		$billqry="SELECT bill_amount FROM care_billing_bill WHERE bill_encounter_nr=$patientno";
		
		$resultbillqry=$db->Execute($billqry);

		if(is_object($resultbillqry)) $cntrs=$resultbillqry->RecordCount();
		$resultbillqry=mysql_query($billqry);

		$cntrs=mysql_num_rows($resultbillqry);
		$billedamt=0;
		for($i=0;$i<$cntrs;$i++)
		{
		   $billedamt=$billedamt+mysql_result($resultbillqry,$i,"bill_amount");
		}
*/
		$billedamit=0;
		$billqry="SELECT SUM(bill_amount) FROM care_billing_bill WHERE bill_encounter_nr=$patientno";
		
		$resultbillqry=$db->Execute($billqry);
		 if(is_object($resultbillqry)){
		 	//$cntrs=$resultbillqry->RecordCount();
			$buffer=$resultbillqry->FetchRow();
			$billedamt=$buffer['bill_amount'];
		}
		
/*		$paymentqry="SELECT payment_amount_total FROM care_billing_payment WHERE payment_encounter_nr=$patientno";
		$resultpaymentqry=mysql_query($paymentqry);

		$cntpy=mysql_num_rows($resultpaymentqry);
		$paidamt=0;
		for($i=0;$i<$cntpy;$i++)
		{
		   $paidamt=$paidamt+mysql_result($resultpaymentqry,$i,"payment_amount_total");
		}
*/		//echo $billedamt;echo "<br>";echo $paidamt;
		$paidamt=0;
		$paymentqry="SELECT SUM(payment_amount_total) FROM care_billing_payment WHERE payment_encounter_nr=$patientno";
		
		$resultpaymentqry=$db->Execute($paymentqry);
		 if(is_object($resultpaymentqry)){
		 	//$cntrs=$resultbillqry->RecordCount();
			$buffer=$resultpaymentqry->FetchRow();
			$paidamt=$buffer['payment_amount_total'];
		}

		$outstanding= $billedamt-$paidamt;
		$totaldue=$total+$outstanding;


		$oldbillotherqry="SELECT bill_outstanding FROM care_billing_bill where bill_bill_no='$billid'";
		$oldbillotherqryresult=$db->Execute($oldbillotherqry);
		if(is_object($oldbillotherqryresult)){
			$obo=$oldbillotherqryresult->FetchRow();
			$oldbilloutstanding=$obo['bill_outstanding'];
		}
/*		$oldbillotherqryresult=mysql_query($oldbillotherqry);
		$oldbilloutstanding=mysql_result($oldbillotherqryresult,0,"bill_outstanding");
*/        ?>



          <table border="0" width="100%" height="127">
            <tr>
              <td width="56%" valign="middle" align="left" height="18"><?php echo $TotalBillAmount ?></td>
              <td width="44" valign="middle" align="left" height="18"> <b>
              <?php
              if($billid=="currentbill")
              {
              	echo $total;
              }
              else
              {
              	echo $oldbilltotal;
              }
              ?>
              </b></td>
            </tr>

            <tr>
              <td width="56%" valign="middle" align="left" height="18"><?php echo $OutstandingAmount ?>:&nbsp;</td>
              <td width="44%" valign="middle" align="left" height="18"><?php if($billid=="currentbill") $outstanding; else $outstanding=$oldbilloutstanding; if($outstanding<0) echo "0"; else echo $outstanding;?>&nbsp;</td>
            </tr>
            <tr>
              <td width="56%" valign="middle" align="left" height="19"><b><?php echo $AmountDue ?></b></td>
              <td width="44%" valign="middle" align="left" height="19"><b><?php if($billid=="currentbill") echo $totaldue; else echo $oldbilltotal+$oldbilloutstanding; ?></b>&nbsp;</td>
            </tr>
          </table>

        </td></tr>

    </table>

    </td>
    </tr>
  </table>

  <p>&nbsp;


  <?php
  if($billid=="currentbill")
  {
  ?>
	<a href="javascript:savebill();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
  <?php
/*  	echo "<input type=button value=Print name=print onclick=javascript:printsavebill();>&nbsp;&nbsp;&nbsp;&nbsp; ";
  	echo "<input type=button value=Save name=save onclick=javascript:savebill();>&nbsp;&nbsp;&nbsp;&nbsp;";
  	echo "<input type=button value=Cancel name=cancel onclick=javascript:cancelbill();></p>";
*/  }
  else
  {
  ?>
	<a href="javascript:window.print();"><img <?php echo createLDImgSrc($root_path,'printout.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?php
/*  	echo "<input type=button value=Print name=print onclick=javascript:window.print();>&nbsp;&nbsp;&nbsp;&nbsp; ";
  	echo "<input type=button value=Cancel name=cancel onclick=javascript:cancelbill();></p>";
*/  }

  ?>
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      

    </center>
  </div>





  <p>&nbsp;</p>

  	<input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
  	<input type="hidden" name="billno" value="<?php echo $billno; ?>">
  	<input type="hidden" name="total" value="<?php echo $total; ?>">
  	<input type="hidden" name="outstanding" value="<?php echo $outstanding; ?>">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="full_en" value="<?php echo $full_en ?>">

</form>

<FONT SIZE=1  FACE="Arial" color=gray>
 <table border="0" width="100%" height="101" bgcolor=#cccccc cellspacing="1">
  <tr>
    <td width="100%" valign="top" height="97">
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
 </body>
</html>

