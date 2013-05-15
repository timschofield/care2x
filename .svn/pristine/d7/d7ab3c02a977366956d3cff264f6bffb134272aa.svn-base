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

# This is a working script, to archive all bills from pending list
# to billing archive.
# *** DO NOT PLAY WITH THAT SCRIPT ****

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');

$bill_obj = new Bill;

// Get all pending bill number's

$arr_pending_bill_number = $bill_obj->GetAllPendingBillNumbers();
//print_r ($arr_pending_bill_number);
echo "start";
while(list($u,$v) = each($arr_pending_bill_number)) {
	$bill_number = $v['nr'];
	$bill_obj->ArchiveBill($bill_number);
} // end of while(list($u,$v) = each($arr_pending_bill_number))

echo "finished";

?>