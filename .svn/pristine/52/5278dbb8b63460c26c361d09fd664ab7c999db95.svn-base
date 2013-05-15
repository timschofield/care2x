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

    /* include('includes/condb.php');
    error_reporting(0);
    connect_db(); */   
    while (list($cle, $val) = each($_POST))
    {
	if (substr($cle,0,7) == "nounits")
	{
		$no =$no."#".$val;
	}
     }
    $no=explode("#",$no);
	
$breakfile='select_services.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en.'&service='.$service;

# Extract the language variable
extract($TXT);

 ?> 
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo $LaboratoryTests; ?></title>
<script language="javascript">
<!--
	function confirmlabtest()
	{
		document.confirmlab.action="postconfirmlab.php";
		document.confirmlab.submit();
	}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+3" face="Arial"><strong><?php echo $eComBill; ?> -
          <?php if($service=='LT')echo $ConfirmLaboratoryTests;if($service=='HS')echo $ConfirmHospitalServices; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </p>
  <form name="confirmlab" id="selectlab" method="POST" action="">
    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <div align="center">
      <center>
      <table cellSpacing="1" cellPadding="3" width="90%" bgColor="#999999" border="0" height="25">
	<tr bgColor="#eeeeee">
		<th align="center" height="1" width="25%" bgcolor="#CCCCCC" valign="middle"><?php echo $TestName ?></th>
		<th align="center" height="1" width="25%" bgcolor="#CCCCCC" valign="middle"><?php echo $TestCode ?></th>
		<th align="center" height="1" width="20%" bgcolor="#CCCCCC" valign="middle"><?php echo $Costperunit ?></th>
		<th align="center" height="1" width="20%" bgcolor="#CCCCCC" valign="middle"><?php echo $NumberofUnits ?></th>
    
    <?php
	   
	    $qrystr=$_SERVER['QUERY_STRING'];
	    $qrystr="&".$qrystr;
	    while(strlen($qrystr)!=1)
	    {
	       	$selectunit=substr($qrystr,9,1);//to find out the no with the word 'itemcode' like for itemcode4 it is 4,so that we can get the value for the combobox(noofunits)
	       	$qrystr = strstr($qrystr,'=');
		$itmcd = substr($qrystr,1,strpos($qrystr,"&"));		
		$qrystr1=$qrystr;	
		$qrystr=substr($qrystr,strpos($qrystr,"&"));
		
		$itmcd = substr($qrystr1,1,strlen($itmcd)-1);		
		$lbqry="SELECT * FROM care_billing_item WHERE item_code='$itmcd'";
		$resultlbqry=$db->Execute($lbqry);	
		if(is_object($resultlbqry)) $item=$resultlbqry->FetchRow();
    	    	echo "</tr><tr bgColor=\"#eeeeee\">";
	        echo "<td align=\"center\" height=\"1\" width=\"1\" valign=\"middle\">".$item['item_description'];
	        echo "</td><td height=\"1\" width=\"60\" align=\"center\">".$item['item_code'];
	        echo "</td>";
	        echo "<td height=\"1\" width=\"43\" align=\"center\">".$item['item_unit_cost'];
	        echo "</td>";
	        echo "<td height=\"1\" width=\"36\" align=\"center\" valign=\"middle\">".$no[$selectunit];
	        echo "</td>";
	        echo "</tr>";
	        $noOfunits=$noOfunits.$no[$selectunit]."#";
	        $labcode=$labcode."#".$item['item_code'];
	    }
     ?>	     
	      </table>
		&nbsp;<p>
		<a href="javascript:confirmlabtest();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0'); ?>></a>      </center>
	      </center>
	      </div>
	      <p>&nbsp;&nbsp;&nbsp;</p>
	      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	   	
<!--         <input type="button" onclick="javascript:confirmlabtest();" value="Confirm" name="B1">
        <input type="button" onclick="javascript:history.go(-1);" value="GoBack" name="B2">
 -->      
        <input type="hidden" name="labcod" value="<?php echo $labcode; ?>">
        <input type="hidden" name="noOfunits" value="<?php echo $noOfunits; ?>">
        <input type="hidden" name="patientno" value=<?php echo $patientno; ?>>
		<input type="hidden" name="lang" value="<?php echo $lang ?>">
		<input type="hidden" name="sid" value="<?php echo $sid ?>">
		<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
        </p>
    <p>&nbsp;</p>
  </form>
</blockquote>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

