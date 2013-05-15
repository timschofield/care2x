<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
error_reporting(E_ALL);
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
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
//require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
//$insurance_tz = New Insurance_tz;
$enc_obj = new Encounter;
$bill_obj = new Bill;

require_once($root_path.'include/care_api_classes/class_tz_drugsandservices.php');
$drg_obj = new DrugsAndServices;

$lang_tables[] = 'billing.php';
$lang_tables[] = 'aufnahme.php';

require($root_path.'include/inc_front_chain_lang.php');


			//$encounter_nr = $_REQUEST['encounter_nr'];
			$comment = $_POST['notes'];
			$user = $_SESSION['sess_user_name'];
			$date = date('Y-m-d',time());
			$advance_payment = $_POST['advance'];

		if($advance_payment)
		{

			if(!isset($new_bill_number))
				{
					$new_bill_number = $bill_obj->CreateNewBill($encounter_nr);
				}

	
				$bill_obj->StoreAdvancePaymentToBill($pid,$new_bill_number,0, $advance_payment);		

		//$sql='select pid FROM care_encounter where encounter_nr='.$encounter_nr;
		//$result=$db->Execute($sql);
		//$row=$result->FetchRow();
		//$batch_nr=$row['pid'];
		header("location: billing_tz_edit.php".URL_APPEND."&batch_nr=".$batch_nr."&bill_number=".$new_bill_number."&user_origin=quotation&patient=".$_REQUEST['patient']);
	
		}
		
	$advancebills = $bill_obj->GetAllAdvancesForEncounter($encounter_nr);
		
require ('gui/gui_billing_tz_advance.php');



?>