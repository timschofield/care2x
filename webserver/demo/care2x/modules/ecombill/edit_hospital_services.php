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

    if($service=='HS')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='HS'";
    if($service=='LT')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='LT'";
		
    $resultqryLT=$db->Execute($qryLT);
	
    if(is_object($resultqryLT)){
		$cntLT=$resultqryLT->RecordCount();
	}

$breakfile='billingmenu.php'.URL_APPEND;
# Extract the language variable
extract($TXT);
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php if($service=='LT')echo "$EditLaboratoryTests"; ?><?php if($service=='HS')echo "$EditHospitalServices"; ?></title>
<SCRIPT language="JavaScript">
<!--
function submitform()
{
	document.editservice.action ="posteditservice.php";
	document.editservice.submit();
}

//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill; ?> -
          <?php if($service=='LT')echo "$EditLaboratoryTestItems";if($service=='HS')echo "$EditHospitalServiceItems"; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>
  <form name="editservice" id="editservice" method="POST" action="">
    <p>
	 <div align="center">
      <center>
      <table cellSpacing="1" cellPadding="3" width="450" bgColor="#999999" border="0" height="138">
<?php

	if($service=='LT') $TP_title= $LabTestItems;
		elseif($service=='HS') $TP_title=$HospitalServiceItems;
	
	$TP_head=&$TP_obj->load('ecombill/tp_edit_head.htm');
	eval("echo $TP_head;");
	# Load the template for items
	$TP_item=&$TP_obj->load('ecombill/tp_edit_item.htm');
	# Load the template for spacer
	$TP_spacer=&$TP_obj->load('ecombill/tp_edit_spacer.htm');

	for($cnt=0;$cnt<$cntLT;$cnt++)
	{
		$itemdetails="";
		$result=$resultqryLT->FetchRow();
		$TP_code=$result['item_code'];
		$TP_description=$result['item_description'];
		$TP_unit_cost=$result['item_unit_cost'];
		$TP_discount_max=$result['item_discount_max_allowed'];
		
		eval("echo $TP_item;");
		
		if($cnt != ($cntLT-1))
		{
			eval("echo $TP_spacer;");
		}
		$itemcd=$result['item_code'];
		$itemcd1=$itemcd1.$itemcd;
		$itemcd1=$itemcd1."#";		
		
        }
      $itemcd=$itemcd1;
?>
<input type="hidden" name="itemcd" value="<?php echo $itemcd; ?>"> 
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
      </table>
    	<p>&nbsp;&nbsp;&nbsp;</p>
   		<!--  <input type="button" onclick="javascript:submitform();" value="Save" name="B1"> --></p>
		<a href="javascript:submitform();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0'); ?>></a>      </center>
    </div>
    
    <p>&nbsp;</p>
  </form>
</blockquote>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

