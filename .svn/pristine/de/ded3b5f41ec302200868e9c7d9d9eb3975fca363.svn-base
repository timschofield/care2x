<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*
*  Daniel Hinostroza: originally was: $TP_item_name=$NameLT; changed to: $TP_item_name=$NameHS;
*  Changed alert functions for language recognition
*  Almost irrelevant changes to the tables at tp_enter_hs.htm
*  Shouldn't all references to LabTest change to HospitalService in this page?
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');

$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='billingmenu.php'.URL_APPEND;
# Extract the language variable
extract($TXT);
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<Script language=JavaScript>

<!--
function check()
{
	var LTN,TC,LP;
	LTN=document.hos.LabTestName.value;
	TC=document.hos.TestCode.value;
	LP=document.hos.LabPrice.value;
	DC=document.hos.Discount.value;
	if(LTN=="")
	{
		alert("<?php echo "$alertNameHospitalService"; ?>"); 
	}
	else if(TC=="")
	{
		alert("<?php echo "$alertEnterServiceCodeNo"; ?>"); 
	}
	else if(LP=="")
	{
		alert("<?php echo "$alertEnterPriceperUnit"; ?>"); 
	}
	else if(DC=="")
	{
		alert("<?php echo "$alertEnterDiscountallowed"; ?>"); 
	}
	else if(isNaN(LP))
	{
		alert("<?php echo "$alertEnterNumericValueforPrice"; ?>"); 

	}
	else if(isNaN(DC))
	{
		alert("<?php echo "$alertEnterNumericValueforDiscount"; ?>"); 

	}
	else
	{
		document.hos.action="post_service_entry.php?type=HS";
		document.hos.submit();
	}

}

//-->
</Script>




<title><?php echo "$HospitalService"; ?></title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo "$Billing - $CreateHospitalServiceItem"; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </p>
  <form name="hos" method="POST" action="">
  
<?php
$TP_form_name='hos';
$TP_js='javascript:check()';
$TP_img_1=createLDImgSrc($root_path,'savedisc.gif','0'); 
$TP_img_2=createLDImgSrc($root_path,'cancel.gif','0');

$TP_item_name=$NameHS;
$TP_title=$HospitalServiceItem;
$TP_input_1='LabTestName';
$TP_input_2='TestCode';
$TP_input_3='LabPrice';
$TP_input_4='Discount';

$TP_form=$TP_obj->load('ecombill/tp_enter_hs.htm');
eval("echo $TP_form;");
?>

<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">

  </form>
</blockquote>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

