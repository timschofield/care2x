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
/*
	include('includes/condb.php');
	error_reporting(0);
	connect_db();*/
$breakfile='billingmenu.php'.URL_APPEND;
# Extract the language variable
extract($TXT);
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<Script language=JavaScript>

function check()
{
	var LTN,TC,LP;
	LTN=document.lab.LabTestName.value;
	TC=document.lab.TestCode.value;
	LP=document.lab.LabPrice.value;
	DC=document.lab.Discount.value;
	if(LTN=="")
	{
		alert("Enter Name of laboratory Test");
	}
	else if(TC=="")
	{
		alert("Enter Test Code/no.");
	}
	else if(LP=="")
	{
		alert("Enter Price per Unit");
	}
	else if(DC=="")
	{
		alert("Enter Discount allowed on this item");
	}
	else if(isNaN(LP))
	{
		alert("Enter Numeric Value for Price");

	}
	else if(isNaN(DC))
	{
		alert("Enter Numeric Value for Discount");

	}
	else
	{
		document.lab.action="post_service_entry.php?type=LT";
		document.lab.submit();
	}

}

</Script>
<title>Laboratory Tests</title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo "$Billing - $CreateLabTestItem"; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </p>
  <form name="lab" method="POST" action="">
<?php
$TP_form_name='lab';
$TP_js='javascript:check()';
$TP_img_1=createLDImgSrc($root_path,'savedisc.gif','0'); 
$TP_img_2=createLDImgSrc($root_path,'cancel.gif','0');

$TP_item_name=$NameLT;

$TP_title=$LabTestItem;
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

