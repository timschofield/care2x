<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/inc_front_chain_lang.php');

if(!isset($dept_nr)||!$dept_nr){
	if($cfg['thispc_dept_nr']){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		if($cfg['bname']=='mozilla'){
			#
			# Bug patch for Mozilla, I know its not automatic but Mozilla seems to have problems with two consecutive header redirects
			#
			require($root_path.'include/inc_mozillapatch_redirect.php');
		}else{
			header("location:select_dept.php".URL_REDIRECT_APPEND."&cat=$cat&target=entry&retpath=$retpath");
		}
		exit;
	}
}

//$db->debug=1;
/**
* if order nr is not available,   get the highest item number in the db and add 1
*/

if(!isset($order_nr) || !$order_nr)
{

    if($cat=='pharma') 
    {
 	    $dbtable='care_pharma_orderlist';
     }
    else
    {
 	    $dbtable='care_med_orderlist';
     }
 

	//$sql="SELECT order_nr FROM $dbtable ORDER BY order_nr DESC";
	$sql="SELECT MAX(order_nr) AS order_nr FROM $dbtable";
    // if($ergebnis=$db->SelectLimit($sql,1)){
     if($ergebnis=$db->Execute($sql)){
		//reset result
		if ($rows=$ergebnis->RecordCount())	{
			$content=$ergebnis->FetchRow();
			$order_nr=$content['order_nr'] + 1;
		}else{
			$order_nr=1;
		} 
	}else{
		echo "$sql<br>$LDDbNoRead<br>";
		exit;
	} 
}

/**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common',TRUE,FALSE,FALSE);

 # Window bar title
 $smarty->assign('sWindowTitle','');

# Assign frameset source file

$smarty->assign('sHeaderSource',"src=\"products-bestell-hf.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck\"");
$smarty->assign('sBasketSource',"src=\"products-bestellkorb.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&itwassent=$itwassent&cat=$cat&userck=$userck\"");
$smarty->assign('sCatalogSource',"src=\"products-bestellkatalog.php?sid=$sid&lang=$lang&dept_nr=$dept_nr&order_nr=$order_nr&cat=$cat&userck=$userck\"");

$smarty->assign('sBaseFramesetTemplate','products/ordering_frameset.tpl');

$smarty->display('common/baseframe.tpl');
?>

