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
require_once($root_path.'include/inc_date_format_functions.php');

//$db->debug=1;

$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

/*	include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
	$presdate=date("Y-m-d");
	$presdatetime=date("Y-m-d H:i:s");

# Extract the language variable
extract($TXT);

?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<Script language=Javascript>
function showbill(billid)
{	
	document.billlinks.action="patient_due_first.php?billid="+billid;
	document.billlinks.submit();
}
function showfinalbill()
{	
	document.billlinks.action="showfinalbill.php";
	document.billlinks.submit();
}
</script>

</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+3" face="Arial"><strong><?php echo $eComBill; ?></strong></font></td>
      </tr>
    </table>
    <p>&nbsp;</p>
      <div align="center">
        <center>
    <table border="0" width="585" height="11" bordercolor="#000000">

<!-- 19.oct.2003 Daniel Hinostroza: Split the following line into two echoes to allow translation  -->
    	<tr><td colspan=2><b><?php echo $PatientNumber ?>: </b> <?php echo "<b>".$full_en."</b>"; ?></td></tr>
    	<tr><td colspan=2><hr></td></tr>
    	<tr><td width=60%><b><?php echo $BillNo ?></b></td><td><b><?php echo $BillDate ?></b></td></tr>
    	<tr><td colspan=2><hr></td></tr>
    
    	
    	
    	<?php
    	$billsquery="SELECT bill_bill_no,bill_date_time FROM care_billing_bill WHERE bill_encounter_nr='$patientno'";
    	$billqueryresult=$db->Execute($billsquery);
    	while ($result=$billqueryresult->FetchRow())
    	{
    		echo "<tr>";
    		echo "<td><a href=javascript:showbill('".$result['bill_bill_no']."')>".$result['bill_bill_no']."</a></td>";    
    		echo "<td>".formatDate2Local($result['bill_date_time'],$date_format)."</td>";
    		echo "</tr>";
    	}
/*    	$billqueryresult=mysql_query($billsquery);
    	$count=mysql_num_rows($billqueryresult);
    	for ($i=0;$i<=$count;$i++)
    	{
    		echo "<tr>";
    		echo "<td><a href=javascript:showbill("."'".mysql_result($billqueryresult,$i,'bill_bill_no')."'".")>".mysql_result($billqueryresult,$i,'bill_bill_no')."</a></td>";    
    		echo "<td>".mysql_result($billqueryresult,$i,'bill_date_time')."</td>";
    		echo "</tr>";
    	}
*/    	
    	?>
    	
    	<tr>
    	
    	<?php
    	$chkfinalquery="SELECT * from care_billing_final WHERE final_encounter_nr='$patientno'";
    	$chkfinalresult=$db->Execute($chkfinalquery);
    	$chkexists=$chkfinalresult->RecordCount();    	
    	if($chkexists>0)
    	{
			$result=$chkfinalresult->FetchRow();
    		$finaldate=$result['final_date'];
    		$finalno=$result['final_bill_no'];
    		echo "<td><b><a href=javascript:showfinalbill()>$FinalBill</a></b></td>";  
    		echo "<td>".formatDate2Local($finaldate,$date_format)."</td>";    		
    	}
    	else
    	{
	    	echo "<td><a href=javascript:showbill('currentbill')>$CurrentBill</a></td>";    
	    	echo "<td>".formatDate2Local($presdate,$date_format)."</td>";
		}
	    	
/*    	$chkfinalresult=mysql_query($chkfinalquery);
    	$chkexists=mysql_num_rows($chkfinalresult);    	
    	if($chkexists>0)
    	{
    		$finaldate=mysql_result($chkfinalresult,0,'final_date');
    		$finalno=mysql_result($chkfinalresult,0,'final_bill_no');
    		echo "<td><b><a href=javascript:showfinalbill()>$FinalBill</a></b></td>";  
    		echo "<td>$finaldate</td>";    		
    	}
    	else
    	{
	    	echo "<td><a href=javascript:showbill('currentbill')>$CurrentBill</a></td>";    
	    	echo "<td>$presdate</td>";
		}
*/	 ?>   	
	    	
    	</tr>
    	
    	<?php
    	/*
    	$billsquery="SELECT bill_item_bill_no,bill_item_date from care_billing_bill_item WHERE bill_item_encounter_nr=$patientno and bill_item_status='1'";
    	$billqueryresult=mysql_query($billsquery);
    	
    	$count=mysql_num_rows($billqueryresult);
    	    	
    	for ($i=0;$i<=$count;$i++)
    	{    	
    		$chkdup=mysql_result($billqueryresult,$i-1,'bill_item_bill_no');
    		
    		if($chkdup != mysql_result($billqueryresult,$i,'bill_item_bill_no'))
    		{    		
    		echo "<tr>";
		    	echo "<td><a href=javascript:showbill("."'".mysql_result($billqueryresult,$i,'bill_item_bill_no')."'".")>".mysql_result($billqueryresult,$i,'bill_item_bill_no')."</a></td>";    
		    	echo "<td>".mysql_result($billqueryresult,$i,'bill_item_date')."</td>";
    		echo "</tr>";
    		}    	
    	}
    	*/
    	?>    	

       <tr>
         <td colspan=2><hr></td>
       </tr>

     
    </table>
		&nbsp;<br>
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      

        </center>
      </div>
  <p>&nbsp;</p>
    
<form method=post name=billlinks action="">

<input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
<input type="hidden" name="finalbilldate" value="<?php echo $finaldate; ?>">
<input type="hidden" name="finalbillno" value="<?php echo $finalno; ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">

</form>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

<?php //disconnect_db(); ?>
