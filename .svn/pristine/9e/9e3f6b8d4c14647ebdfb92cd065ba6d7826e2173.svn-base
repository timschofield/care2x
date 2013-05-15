<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
//$lang_tables[]='pharmacy.php';
define('LANG_FILE','pharmacy.php');
define('NO_2LEVEL_CHK',1);
require($root_path.'include/inc_front_chain_lang.php');
$breakfile=$root_path.'modules/news/start_page.php'.URL_APPEND;
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Module title in the toolbar

 $smarty->assign('sToolbarTitle',$LDPharmacy);

 # Help button href
 $smarty->assign('pbHelp',"javascript:gethelp('pharmacy_menu.php','Pharmacy :: Main Menu')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPharmacy);

//require ("gui/gui_pharmacy_tz.php");

?>
<html>
<head>
</head>
<body>
<?php
 # Pharmacy submenu block

 $smarty->assign('LDPrescription',$LDPrescription);

$smarty->assign('LDDrugPrescriptions',"<a href=\"pharmacy_tz_pending_prescriptions.php?sid=$sid&lang=$lang&prescrServ=prescr&comming_from=pharmacy\">$LDDrugPrescription</a>");
$smarty->assign('LDShowPrescriptionsofPatients',$LDShowPrescriptionsofPatients);

$smarty->assign('LDPendingOutpatientPrescriptions',"<a href=\"pharmacy_tz_pending_prescriptions.php?sid=$sid&lang=$lang&prescrServ=prescr&admission=outpatient&comming_from=pharmacy\">$LDDrugPrescriptionIPD</a>");
$smarty->assign('LDShowPrescriptionsofPatientsOPD',$LDShowPrescriptionsofPatientsOPD);

$smarty->assign('LDPendingInpatientPrescriptions',"<a href=\"pharmacy_tz_pending_prescriptions.php?sid=$sid&lang=$lang&prescrServ=prescr&admission=inpatient&comming_from=pharmacy\">$LDDrugPrescriptionOPD</a>");
$smarty->assign('LDShowPrescriptionsofPatientsIPD',$LDShowPrescriptionsofPatientsIPD);

 # Pharmacy submenu block

 $smarty->assign('LDOrderingProducts',$LDOrderingProducts);

$smarty->assign('LDOrderCat',"<a href=\"pharmacy_tz_product_catalog.php\">$LDMyProductCatalog</a>");
$smarty->assign('LDCreateEditUpdateRemove',$LDCreateEditUpdateRemove);

$smarty->assign('LDManagePrice',"<a href=\"magage_pricelist.php\">$LDManagePriceList</a>");
$smarty->assign('LDManagePriceList_description',$LDManagePriceList_description);

$smarty->assign('LDWardPrescriptions',"<a href=\"pharmacy_tz_show_prescr.php\">$LDPrescrWard</a>");
$smarty->assign('LDShowPrescrPerWardAndDay',$LDShowPrescrPerWardAndDay);


# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','pharmacy/submenu_pharmacy.tpl');

 /**
 * show  Mainframe Template
 */

 $smarty->display('common/mainframe.tpl');


?>
</BODY>
</HTML>
