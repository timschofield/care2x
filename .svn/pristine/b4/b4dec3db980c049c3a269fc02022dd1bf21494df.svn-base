<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* Dilip Bharatee
* Abrar Hazarika
* Prantar Deka
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','billing.php');
define('NO_CHAIN',1);

require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path.'main/spediens.php'.URL_APPEND;

# Extract the language variable
extract($TXT);
?>
<?php html_rtl($lang); ?>

<head>
<?php echo setCharSet(); ?>
<title>Patient Name</title>
</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<?php
   
$TP_href_1="enter_hospital_services.php".URL_APPEND;
$TP_href_2="enter_laboratory_tests.php".URL_APPEND;
$TP_href_3="edit_hospital_services.php".URL_APPEND."&service=HS";
$TP_href_4="edit_hospital_services.php".URL_APPEND."&service=LT";
$TP_href_5="search.php".URL_APPEND;
$TP_img=createLDImgSrc($root_path,'close2.gif','0');

$TP_menu=$TP_obj->load('ecombill/tp_menu_main.htm');
eval("echo $TP_menu;");

# Copyrite notice
require($root_path.'include/inc_load_copyrite.php');
?>

</body>
</html>

