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
$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core= new Core;

//$db->debug=1;

	/*include('includes/condb.php');
	connect_db();*/

	$presdatetime=date("Y-m-d G:i:s");
	$labcod=$labcod."#";	
	$noOfunits="#".$noOfunits;
	
	$j=$j+1;
	while(strlen($noOfunits) !=1)
	{
		$noOfunits=substr($noOfunits,1);
		$noOfunits1 = substr($noOfunits,0,strpos($noOfunits,"#"));
		$noOfunits=substr($noOfunits,strpos($noOfunits,"#"));
		$no_units[$j]=$noOfunits1;
		$j=$j+1;	
	}
	$cnt=1;
	
	$chkpatqry="SELECT bill_item_code,bill_item_units FROM care_billing_bill_item WHERE bill_item_encounter_nr=$patientno";
	$resultchkpatqry=$db->Execute($chkpatqry);
	if(is_object($resultchkpatqry)) $chkcnt=$resultchkpatqry->RecordCount();	
/*	$resultchkpatqry=mysql_query($chkpatqry);
	$chkcnt=mysql_num_rows($resultchkpatqry);	
*/	
	
	while(strlen($labcod) !=1)
	{
		$flag=0;
		$labcod=substr($labcod,1);
		$labcod1 = substr($labcod,0,strpos($labcod,"#"));
		
		$labitemqry="SELECT * FROM care_billing_item WHERE item_code='$labcod1'";
		//$resultlabitemqry=mysql_query($labitemqry);
		$resultlabitemqry=$db->Execute($labitemqry);
		if(is_object($resultlabitemqry)){
			$labitem=$resultlabitemqry->FetchRow();
			$unitcost=$labitem['item_unit_cost'];
			$discount=$labitem['item_discount_max_allowed'];
		}
/*		$unitcost=mysql_result($resultlabitemqry,0,"item_unit_cost");
		$discount=mysql_result($resultlabitemqry,0,"item_discount_max_allowed");
*/
		$unitcost=($unitcost-($discount*$unitcost/100));
		
		$totalamt=$unitcost*$no_units[$cnt];
		$labcod=substr($labcod,strpos($labcod,"#"));		
		
		for($i=0;$i<$chkcnt;$i++)
		{		  
		  //$newno=$no_units[$cnt]+(mysql_result($resultchkpatqry,$i,"bill_item_units"));
		  //if($labcod1==mysql_result($resultchkpatqry,$i,"bill_item_code"))
		  //{		 
		  	//echo $labtestqry="UPDATE care_billing_bill_item SET bill_item_units=$newno WHERE bill_item_encounter_nr=$patientno and bill_item_code='".mysql_result($resultchkpatqry,$i,"bill_item_code")."'";
		  	//$flag=1;
		  	//break;
		  //}
		  $labtestqry="INSERT INTO care_billing_bill_item (bill_item_encounter_nr,bill_item_code,bill_item_unit_cost,bill_item_units,bill_item_amount,bill_item_date) VALUES ($patientno,'$labcod1',$unitcost,$no_units[$cnt],$totalamt,'$presdatetime')";
		}	
		
		//if($flag !=1)
			$labtestqry="INSERT INTO care_billing_bill_item (bill_item_encounter_nr,bill_item_code,bill_item_unit_cost,bill_item_units,bill_item_amount,bill_item_date) VALUES ($patientno,'$labcod1',$unitcost,$no_units[$cnt],$totalamt,'$presdatetime')";
		
		if(!$core->Transact($labtestqry)) echo $core->getLastQuery();
		//$resultlabtestqry=mysql_query($labtestqry);
		$cnt=$cnt+1;
	}

	//disconnect_db();
	$patmenu="patientbill.php".URL_REDIRECT_APPEND."&patnum=$patientno&full_en=$full_en&service=$service";
	//echo("<META http-equiv='refresh' content='0;url=$patmenu'>");
header('Location:'.$patmenu);
exit;
?>
