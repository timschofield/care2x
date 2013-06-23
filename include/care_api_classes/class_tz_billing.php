<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
//
/**
 *  Billing methods for tanzania (the product-module is completely rewritten by Robert Meggle.
 *
 * Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
 * @author Robert Meggle
 * @version beta 1.0.0
 * @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
 * @package care_api from Elpidio Latirilla
 */

/*
 * Updated by: Dennis Mollel - info@cybertechstudios.com  || nov-2010
 *
 */

/*
 Class Structure:

 Class Core
 |
 `---> Class Notes
 |
 `--->Class Encounter
 |
 `----> Class Bill
 */

class Bill extends Encounter {

	// Properties

	var $fields_tbl_bill=array(
                  'encounter_nr',
                  'first_date',
                  'create_id');

	var $tbl='';
	var $tbl_bill='care_tz_billing';
	var $tbl_bill_elements='care_tz_billing_elem';

	var $tbl_bill_archive='care_tz_billing_archive';
	var $tbl_bill_archive_elements='care_tz_billing_archive_elem';


	var $tbl_lab_param='care_tz_laboratory_param';
	var $tb_drugsandservices='care_tz_drugsandservices';
	var $tbl_prescriptions='care_encounter_prescription';
	var $tbl_lab_requests='care_test_request_chemlabor';
	var $tbl_lab_requests_sub='care_test_request_chemlabor_sub';
	var $tbl_rad_requests='care_test_request_radio';

	var $fields_tbl_bill_elements=array (
                  'nr',
                  'date_change',
                  'is_labtest',
                  'is_medicine',
				  'is_radio_test',
                  'is_comment',
                  'is_paid',
                  'amount',
                  'description');
	var $used_budget=array('');

	var $result;
	var $sql;
	var $debug;
	var $records;
	var $parameter_array;
	var $index;
	var $value;
	var $chemlab_testindex;
	var $chemlab_testname;
	var $radio_testname;
	var $chemlab_amount;
	var $radio_amount;
	var $price;
	var $medical_item_name;
	var $medical_item_amount;
	var $item_number;
	var $user_id;


	//------------------------------------------------------------------------------

	// Constructor
	function Bill() {
		return true;
	}

	// Methods:

	/******************************************************************************
	 *  PRIVATE
	 **/


	function _check_tbl_exists($tbl_name) {
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE :  $db->debug=FALSE;
		$this->sql="SELECT * FROM $tbl_name LIMIT 0";
		return ($db->Execute($this->sql)) ? true : false;
	}

	function _delete_tbl($tbl_name) {
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql="DROP TABLE $tbl_name";
		return ($db->Execute($this->sql)) ? true : false;
	}


	//------------------------------------------------------------------------------


	function _GetPendingResults($encounter_nr=FALSE) {
		/*
		 * This private method goes through the main tables and returns an
		 * result array (adodb) with hits or FALSE
		 *
		 * Definition of a pending bill:
		 *   ************************************************************************
		 *   ** A pending bill is a record that is not given by the billing table  **
		 *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
		 *   ** care_test_request_chemlabor (encounter_nr) and                     **
		 *   ** care_encounter_prescription (encounter_nr)                         **
		 *   ************************************************************************
		 *  if $encounter_nr is set, then this private function just returns the
		 *  records for this encounter. Default is FALSE for this value and this
		 *  method returns a list of all
		 */

		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
	}

	/******************************************************************************
	 *  PUBLIC
	 **/

	function GetFirstPid() {
		global $db, $root_path;
		/*
		 * Definition of a pending bill:
		 *   ************************************************************************
		 *   ** A pending bill is a record that is not given by the billing table  **
		 *   ** care_tz_billing (encounter_nr) but there are entries in the tables **
		 *   ** care_test_request_chemlabor (encounter_nr) and                     **
		 *   ** care_encounter_prescription (encounter_nr)                         **
		 *   ************************************************************************
		 */

		/*
		 * Note: 10.June 2005 by RM: This is an old function out of an billing experiment,
		 * there is the possibility that this function is not working correctely but I haven't
		 * fond an error right now. Never touch a running and working routine... But:
		 * If there is a need for it, please replace this function and note that there are
		 * now flags in the pending encounter and laboratory table to determine this result.
		 * This function should return the first pid what could have pending bills.
		 */


		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$this->sql="SELECT
							care_person.selian_pid,
							care_person.pid,
              name_first,
              name_last,
              bi.encounter_nr,
              bi.first_date,
              care_person.pid as batch_nr
      FROM care_encounter, care_person, care_tz_billing bi, care_tz_billing_elem biel
      WHERE care_encounter.pid = care_person.pid
            AND bi.encounter_nr = care_encounter.encounter_nr
            AND biel.nr = bi.nr

      group by batch_nr
      ORDER BY batch_nr ASC LIMIT 1";
		$this->results = $db->Execute($this->sql);
		if($this->first_pn=$this->results->FetchRow()) {
			return $this->first_pn['pid'];
		} else {
			return FALSE;
		}
	}

	//------------------------------------------------------------------------------
	function getAllEncounters() {
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>statement from Method: class_tz_billing::GetAllEncounters:</b><br>";
		$this->sql="SELECT
            encounter_nr
    FROM care_encounter

    ORDER BY encounter_nr DESC";

		$this->result=$db->Execute($this->sql);
		$i=0;
		while($encounters=$this->result->FetchRow()) {
			$enc_array[$i] = $encounters['encounter_nr'];
			$i++;
		}
		return $enc_array;
	}
	//------------------------------------------------------------------------------

	function getPrice($item_id, $pricelist_no) {
		global $db;
		$this->debug=FALSE;
		if ($this->debug) echo "<b>getPrice($item_id, $pricelist_no=1)</b>";
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		switch ($pricelist_no) {
			case 1:
				$this->sql="select unit_price from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 2:
				$this->sql="select unit_price_1 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 3:
				$this->sql="select unit_price_2 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 4:
				$this->sql="select unit_price_3 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 5:
				$this->sql="select unit_price_4 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 6:
				$this->sql="select unit_price_5 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
			case 7:
				$this->sql="select unit_price_6 from care_tz_drugsandservices WHERE item_id=".$item_id;
				break;
		}
			// execute the sql statement:
		$this->result=$db->Execute($this->sql);
		// check if there is any result:
		if ($this->result->RecordCount()>0) {
			$row=$this->result->FetchRow();
			return $row[0];
		} else {
			// no result, no price:
			return 1;
		}
	}

	//------------------------------------------------------------------------------

	function CheckForPendingBill($encounter_nr) {
		/**
		 * returns TRUE if there is a pending Bill existing for this encounter
		 */
		global $db;
		$this->debug=FALSE;
		if ($this->debug) echo "<br><b>class_tz_billing::CheckForExistingBill($encounter_nr)</b><br>";
		$this->sql="select encounter_nr FROM care_tz_billing where encounter_nr=$encounter_nr LIMIT 0,1";
		$this->result=$db->Execute($this->sql);

		return ($this->result->RecordCount())? TRUE : FALSE;
	}


	//------------------------------------------------------------------------------

	function PendingBillObjects($encounter_nr) {
		/**
		 * returns TRUE if at least one item in the billing table are missing...
		 */
		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$PRESCRIPTION_GIVEN=FALSE;
		$LABORTORY_GIVEN=FALSE;
		$RADIOLOGY_GIVEN=FALSE;
		if ($this->debug) echo "<br><b>class_tz_billing::GetPendingObjects($encounter_nr)</b><br>";
		// prescription:
		// read all items out of the prescription table where no bill_number is given for this encounter
		$this->sql = "select
		article_item_number
		from $this->tbl_prescriptions
		where bill_number = 0 AND encounter_nr=".$encounter_nr;
		$this->result=$db->Execute($this->sql);
		if ($this->result->RecordCount()>0)
		$PRESCRIPTION_GIVEN=TRUE;

		//radiology:
		// read all items out of the radiology table where no bill_number is given for this encounter
		$this->sql="select
		encounter_nr
		FROM
		$this->tbl_rad_requests
		where bill_number = 0 AND encounter_nr=".$encounter_nr;
		// echo $this->sql;
		$this->result=$db->Execute($this->sql);
		if ($this->result->RecordCount()>0)
		$RADIOLOGY_GIVEN = TRUE;

		//laboratory:
		// read all items out of the laboratory table where no bill_number is given for this encounter
		$this->sql="select
		encounter_nr
		FROM
		$this->tbl_lab_requests
		where bill_number = 0 AND encounter_nr=".$encounter_nr;
		// echo $this->sql;
		$this->result=$db->Execute($this->sql);
		if ($this->result->RecordCount()>0)
		$LABORTORY_GIVEN = TRUE;

		if ($LABORTORY_GIVEN===TRUE && $PRESCRIPTION_GIVEN ===TRUE && $RADIOLOGY_GIVEN ===TRUE)
		return TRUE;
		else
		return FALSE; // We have nothing to do... no pending issues in the tables!

	}


	//------------------------------------------------------------------------------

        function DisplayAllArchivedBillHeadlines($selected_date,$trans_id) {

	if($trans_id==""){
		$trans_label = "All";
	}
	else
	if($trans_id==0){
        	$trans_label = "Cash";
        }
	if($trans_id==1){
        	$trans_label = "Credit";
        }


	 echo '<tr class="tr_content">';
         echo '<td  bgcolor=\"#CC9933\" class="headline" colspan=6><div align="center">'.$trans_label.' Bill Summary for '.$selected_date.'</div></td>';
	 echo '</tr>';

	}


	//------------------------------------------------------------------------------

	function DisplayArchivedBillHeadlines($no) {
		global $db;
		$enc_obj = New Encounter;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>class_tz_billing::DisplayArchivedBillHeadlines</b><br>";
	 $this->sql_pid="SELECT `pid` FROM care_person where selian_pid like '.%$no%.' OR name_first like '.%$no%.' OR name_last like '.%$no%.' ";
	 $this->request_pid=$db->Execute($this->sql_pid);
	 $color_change=FALSE;
	 while ($this->res_pid=$this->request_pid->FetchRow()){
	  $pid=$this->res_pid['pid'];

	  $this->sql_enr="SELECT `encounter_nr` FROM care_encounter where pid= ".$pid;
	  $this->request_enr=$db->Execute($this->sql_enr);
	  $color_change=FALSE;
	  while ($this->res_enr=$this->request_enr->FetchRow()){
	  	$enr=$this->res_enr['encounter_nr'];

	  	$this->sql="SELECT `nr`, `encounter_nr`, `first_date` FROM care_tz_billing_archive where encounter_nr='.$enr.'   order by nr DESC";
	  	$this->request=$db->Execute($this->sql);
	  	$color_change=FALSE;
	  	while ($this->res=$this->request->FetchRow()) {

	  		if ($color_change) {
	  			$BGCOLOR='bgcolor="#ffffdd"';
	  			$color_change=FALSE;
	  		} else {
	  			$BGCOLOR='bgcolor="#ffffaa"';
	  			$color_change=TRUE;
	  		}
	  		//$encoded_batch_number = $enc_obj->ShowPID($batch_nr);
	  		$enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);

	  		$this->bill_number=$this->res['nr'];
	  		$this->encounter_number=$this->res['encounter_nr'];
	  		$this->batch_number=$enc_obj->GetBatchFromEncounterNumber($this->encounter_number);
	  		$this->date=$this->res['first_date'];
	  		$enc_data = $enc_obj->loadEncounterData($this->encounter_number);
	  		echo '<script language="javascript" >
            <!--
            function printOut_'.$this->bill_number.'()
            {
            	urlholder="show_bill.php?bill_number='.$this->bill_number.'&batch_nr='.$this->batch_number.'&printout=TRUE&show_archived_bill=TRUE";
            	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

            }
            // -->
            </script>
            ';

	  		echo '<tr>
  					  <td '.$BGCOLOR.'><div align="center"><a href="javascript:printOut_'.$this->bill_number.'()">'.$this->bill_number.'</a></div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.date("d.m.Y",$this->date).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->ShowPID($this->batch_number).'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$this->encounter_number.'</div></td>
  					  <td '.$BGCOLOR.'><div align="center">'.$enc_obj->FirstName($enc_data).' '.$enc_obj->LastName($enc_data).'
</div></td>
  					</tr> ';
	  	}
	  }//
	 }//
	}

//------------------------------------------------------------------------------

function DisplayArchivedBillAmount($bill_nr){

	global $db, $root_path;
	$this->debug=FALSE;;
	if ($this->debug) echo "<b>class_tz_billing:: DisplayArchivedBillAmount($bill_nr)</b><br>";
	$total_bill = 0;

	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$this->sql="SELECT * FROM care_tz_billing_archive_elem WHERE nr = ".$bill_nr;

	if ($this->debug) echo $this->sql."<br>";
	$this->result=$db->Execute($this->sql);

	while($bill_elems_row=$this->result->FetchRow()) {

	$part_amount =	$bill_elems_row['price']*$bill_elems_row['amount'];
	$total_bill += $part_amount ;


	}

    return $total_bill;

}


	//------------------------------------------------------------------------------

	function GetBill($encounter_nr) {
		global $db;
		/**
		 * Returns the ident bill number
		 */
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetBill()</b><br>";
		$this->sql = "SELECT nr FROM $this->tbl_bill WHERE encounter_nr=".$encounter_nr." limit 0,1 ";
		$this->request = $db->Execute($this->sql);
//		echo $this->sql;
		if ($this->result=$this->request->FetchRow())
		return $this->result[0];

	}

	//------------------------------------------------------------------------------

	function GetAllPendingBillNumbers() {
		global $db;
		/**
		 * Returns array of all pending bill numbers
		 */
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetAllPendingBillNumbers()</b><br>";
		$this->sql = "SELECT nr FROM $this->tbl_bill";
		$this->request = $db->Execute($this->sql);
		if ($this->result=$this->request->GetArray()) {
			return $this->result;
		} else {
			return FALSE;
		} // end of


	}


	//------------------------------------------------------------------------------

	function CreateNewBill($encounter_nr) {
		global $db;
		/**
		 * Returns the ident bill number
		 */
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::CreateNewBill($encounter_nr)</b><br>";
		$this->sql = "INSERT INTO care_tz_billing (encounter_nr, first_date, create_id, creation_date) VALUES ('".$encounter_nr."','".time()."','','".time()."')";
		//echo $this->sql;
		$this->request = $db->Execute($this->sql);
		//echo $db->Insert_ID();
		return $db->Insert_ID();
	}

	function StoreToBill($encounter_nr, $bill_number){
		global $db;
		$this->debug=FALSE;
		if ($this->debug) echo "<b>class_tz_billing::StoreToBill(encounter_nr: $encounter_nr, bill_number: $bill_number)</b><br>";
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		// do we have pending issues of prescriptions?
		// read all items out of the prescription table
		$this->sql = "select
		article_item_number,
		article,
		notes,
		dosage,
		price
		from $this->tbl_prescriptions
		where bill_number = 0 AND encounter_nr=".$encounter_nr;
		$this->result=$db->Execute($this->sql);
		while ($this->records=$this->result->FetchRow()) {
			$this->item_number=$this->records['article_item_number'];
			$this->medical_item_name  =$this->records['article'];
			$this->medical_item_name  .= "(".$this->records['notes'].")";
			$this->medical_item_amount=$this->records['dosage'];
			$this->price              =$this->records['price'];
			// The amount of this medical item could be translated into the real amount...
			$this->medical_item_amount = $this->ConvertMedicalItemAmount($this->medical_item_amount);
			$this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, amount_doc, price, description)
			VALUES (".$bill_number.",".time().",0,1,'".$this->medical_item_amount."','".$this->medical_item_amount."','".$this->price."','".$this->medical_item_name."')";
			$db->Execute($this->sql);

			if ($this->debug) echo $this->sql;

			// Mark these lines in the table prescription as "still billed". We can do this
			// in that way: Insert the billing number where we can find this article again...
			$this->sql="UPDATE $this->tbl_prescriptions SET bill_number='".$bill_number."', bill_status='pending' WHERE bill_number = 0 AND encounter_nr=".$encounter_nr;
			$db->Execute($this->sql);
		}

		// And now the laboratory...
		$this->sql = "select
		encounter_nr,
		parameters
		FROM $this->tbl_lab_requests
		WHERE encounter_nr=".$encounter_nr." AND bill_number = 0";
		$this->parameters = $db->Execute($this->sql);
		while ($this->records=$this->parameters->FetchRow()) {
			if ($this->debug) echo $this->records['parameters']."<br>";
			parse_str($this->records['parameters'],$this->parameter_array);
			while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
				//Strip the string baggage off to get the task id
				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
				$this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
				$this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
				if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount."<br>";
				// we have it all... now we store it into the billing-elements-table
				$this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, description)
				VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$this->chemlab_testname."')";
				$db->Execute($this->sql);

			}
		}
		// Mark these lines in the table prescription as "still billed". We can do this
		// in that way: Insert the billing number where we can find this article again...
		$this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."' , bill_status='pending' WHERE bill_number = 0 AND encounter_nr=".$encounter_nr;
		$db->Execute($this->sql);

	}



	function StorePrescriptionItemToBill($pid, $prescriptions_nr, $bill_number, $insurance, $pricelist_no){
		global $db, $root_path;
		global $user_id,$sid,$local_user;
		$this->debug=FALSE;
		if ($this->debug) echo "<b>class_tz_billing::StorePrescriptionItemToBill($pid, $prescriptions_nr, $bill_number, $price, $dosage, $notes, $insurance, $timesPerDay, $days)</b><br>";
		if ($this->debug) echo "prescriptions_nr: $prescriptions_nr, bill_number: $bill_number<br>";
		if ($this->debug) echo "times_per_day: $timesPerDay, days: $days<br>";
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
		$insurance_tz = new Insurance_tz;
		$contract = $insurance_tz->CheckForValidContract($pid);
		// do we have pending issues of prescriptions?
		// read all items out of the prescription table
		if (empty($contract['id']) or $contract['id']='') {
			$contract['id']=0;
		}

		$user_id=$_SESSION['sess_user_name'];

		$this->sql="SELECT * FROM $this->tbl_prescriptions WHERE nr = ".$prescriptions_nr;

		if ($this->debug) echo $this->sql."<br>";
		$this->result=$db->Execute($this->sql);
		$row=$this->result->FetchRow();
		//RM: The price cannot get from this table. When the prescription is been done, there is no
		// pricelist been selected. I transfered this to an own method in that class now.
		// Should be later recognize if there is another price valid that it would be given to
		// this pricelist of care2x (when e.g. the price is set by webERP)

		//$price=$row['price'];
		//if (empty($price)) {
		//	$price=0;
		//}

		// --- end of RM comment

		// get the price of this element:
		$price = $this->getPrice($row['article_item_number'], $pricelist_no);

		$this->sql = "
		INSERT INTO $this->tbl_bill_elements " .
				"	(" .
				"		nr, " .
				"		date_change, " .
				"		is_labtest, " .
				"		is_medicine, " .
				"		is_radio_test, " .
				"		is_comment, " .
				"		is_paid, " .
				"		amount, " .
				"		amount_doc, " .
				"		times_per_day, " .
				"		days, " .
				"		price, " .
				"		description, " .
				"		notes, " .
				"		item_number, " .
				"		balanced_insurance, " .
				"		insurance_id, " .
				"               prescriptions_nr, " .
				"		User_Id)" .
				"
		VALUES (".$bill_number.", '".time()."', 0, 1, 0, 0, 0, '".$row['total_dosage']."', '".$row['total_dosage']."', ".$row['times_per_day'].",". $row['days'].", ".$price.", '".$row['article']."', '".$row['notes']."', ".$row['article_item_number'].", '".$insurance."', '".$contract['id']."', '".$row['nr']."','".$user_id."')";

		if ($this->debug) echo $this->sql."<br>";
		$this->result=$db->Execute($this->sql);

		$this->sql = "UPDATE $this->tbl_prescriptions SET bill_number=".$bill_number.", bill_status='pending' WHERE nr= ".$prescriptions_nr;
		if ($this->debug) echo $this->sql;
			if ($this->debug) echo $this->sql;
		$db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------

	function StoreLaboratoryItemToBill($pid, $labtest_nr, $batch_nr, $bill_number, $insurance, $pricelist_no){
		global $db, $root_path;
		global $user_id,$sid,$local_user;
		$this->debug=false;;
		if ($this->debug) echo "<b>class_tz_billing::StoreLaboratoryItemToBill(pid: $pid, batch_nr: $batch_nr, bill_number: $bill_number)</b><br>";
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;


		require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
		$insurance_tz = new Insurance_tz;
		$contract = $insurance_tz->CheckForValidContract($pid);

		// do we have pending issues of prescriptions?
		// read all items out of the prescription table
		if (empty($contract['id']) or $contract['id']='') {
			$contract['id']=0;
		}

		$user_id=$_SESSION['sess_user_name'];

		// old code
		//    $this->sql = "select
		//                          encounter_nr,
		//                          parameters
		//                  FROM $this->tbl_lab_requests
		//                  WHERE batch_nr=".$batch_nr;

		$this->sql = "select care_test_request_chemlabor.*, care_test_request_chemlabor_sub.sub_id AS prescrip_nr,
		care_test_request_chemlabor_sub.item_id AS p_item_id,
		care_tz_drugsandservices.item_description

		FROM care_test_request_chemlabor_sub
		INNER JOIN care_test_request_chemlabor
		ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr
		INNER JOIN care_tz_drugsandservices
		ON care_test_request_chemlabor_sub.item_id = care_tz_drugsandservices.item_id
		WHERE care_test_request_chemlabor_sub.sub_id=".$labtest_nr;

		if ($this->debug) echo $this->sql;
		$result = $db->Execute($this->sql);
		//echo $result;
		//echo $batch_nr;

		require_once($root_path.'include/care_api_classes/class_prescription.php');
                $drg_obj = New Prescription;


		while ($row=$result->FetchRow()) {

			//echo $this->records['paramater_name'];

			//$this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->records['item_number']);

			//$this->price = $this->GetPriceOfLAboratoryItemFromID($this->records['id']);

			$price = $this->getPrice($row['p_item_id'], $pricelist_no);
			$name = $drg_obj->GetNameOfItem($row['p_item_id']);

			if ($this->debug) echo 'Testname: '.$row['item_description'].'<br>';
			if ($this->debug) echo 'Encounter_nr:    '.$row['encounter_nr'].'<br>';
			if ($this->debug) echo 'Prescription_nr:    '.$row['prescrip_nr'].'<br>';
			if ($this->debug) echo 'labtest_nr:    '.$row['sub_id'].'='.$batch_nr.'<br>';
		 	if ($this->debug) echo 'contract id : '.$contract['id'].'<br>';



          	$this->chemlab_amount = 1;

           $this->sql ="
			INSERT INTO $this->tbl_bill_elements  " .
			"	(" .
				"		nr, " .
				"		date_change, " .
				"		is_labtest, " .
				"		is_medicine, " .
				"		is_radio_test, " .
				"		is_comment, " .
				"		is_paid, " .
				"		amount, " .
				"		amount_doc, " .
				"		times_per_day, " .
				"		days, " .
				"		price, " .
				"		description, " .
				"		notes, " .
				"		item_number, " .
				"		balanced_insurance, " .
				"		insurance_id, " .
				"               prescriptions_nr, " .
				"		User_Id)" .
				"
			VALUES (".$bill_number.", '".time()."', 1, 0, 0, 0, 1, 1, 1, 0, 0, ".$price.", '".$row['item_description']."', 0, ".$row['p_item_id'].", '".$insurance."', '".$contract['id']."', '".$row['prescrip_nr']."','".$user_id."')";

			if ($this->debug) echo $this->sql;
			$db->Execute($this->sql);



			$this->sql = "UPDATE $this->tbl_lab_requests_sub SET bill_number=".$bill_number."
		 	WHERE batch_nr= $batch_nr
		 	AND item_id=".$row[p_item_id];

			if ($this->debug) echo $this->sql;
			$db->Execute($this->sql);



		// Mark these lines in the table prescription as "still billed". We can do this
		// in that way: Insert the billing number where we can find this article again...

		//herausfinden, was geändert wird, damit Rechnung als billed gekennzeichnet wird
		//$this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."', bill_status='pending' WHERE batch_nr=".$pid;
		//if ($this->debug) echo $this->sql;
		//$db->Execute($this->sql);

		}// end while



		//    $this->parameters = $db->Execute($this->sql);
		//    while ($this->records=$this->parameters->FetchRow()) {
		//      if ($this->debug) echo $this->records['parameters']."<br>";
		//      parse_str($this->records['parameters'],$this->parameter_array);
		//      while(list($this->index,$this->chemlab_amount) = each($this->parameter_array)) {
		//  				//Strip the string baggage off to get the task id
		//  				$this->chemlab_testindex = substr($this->index,5,strlen($this->index)-6);
		//
		//          $this->chemlab_testname = $this->GetNameOfLAboratoryFromID($this->chemlab_testindex);
		//
		//          $this->price = $this->GetPriceOfLAboratoryItemFromID($this->chemlab_testindex);
		//          if ($this->debug) echo "the name of chemlab is:".$this->chemlab_testname." with a amount of ".$this->chemlab_amount." and a price of ".$this->price."<br>";
		//          require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
		//		  $insurance_tz = New Insurance_tz();
		//		  $contract = $insurance_tz->CheckForValidContract($pid);
		//          // we have it all... now we store it into the billing-elements-table
		//          $this->sql ="INSERT INTO $this->tbl_bill_elements (nr, date_change, is_labtest, is_medicine, amount, price, balanced_insurance, insurance_id, description)
		//								 			VALUES (".$bill_number.",".time().",1,0,".$this->chemlab_amount.",'".$this->price."','".$insurance."','".$contract['id']."','".$this->chemlab_testname."')";
		//				  if ($this->debug) echo $this->sql;
		//				  $db->Execute($this->sql);
		//				  $insurance=0;
		//			  }
		//    }
		//    // Mark these lines in the table prescription as "still billed". We can do this
		//    // in that way: Insert the billing number where we can find this article again...
		//    $this->sql="UPDATE $this->tbl_lab_requests SET bill_number='".$bill_number."' , bill_status='pending' WHERE batch_nr=".$batch_nr;
		//    $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------

	function StoreRadiologyItemToBill($pid, $batch_nr, $bill_number, $insurance, $pricelist_no){
		global $db, $root_path;
		global $user_id,$sid,$local_user;
		$this->debug=false;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<b>class_tz_billing::StoreRadiologyItemToBill(pid: $pid, batch_nr: $batch_nr, bill_number: $bill_number, insurance: $insurance)</b><br>";

		// do we have pending issues of prescriptions?
		// read all items out of the prescription table

		// old code
		//    $this->sql = "select
		//                          encounter_nr,
		//                          parameters
		//                  FROM $this->tbl_lab_requests
		//                  WHERE batch_nr=".$batch_nr;


		require_once($root_path.'include/care_api_classes/class_prescription.php');
                $drg_obj = New Prescription;

		$user_id=$_SESSION['sess_user_name'];

		$this->sql = "select care_test_request_radio.*,
		care_tz_drugsandservices.item_id,care_tz_drugsandservices.item_description

		FROM $this->tbl_rad_requests
		INNER JOIN care_tz_drugsandservices
		ON care_tz_drugsandservices.item_id = care_test_request_radio.test_request

		WHERE batch_nr=".$batch_nr;

		$result = $db->Execute($this->sql);
		if ($this->debug) echo $result;
		//echo $result;
		//echo $batch_nr;
		while ($row=$result->FetchRow()) {

			$price = $this->getPrice($row['item_id'], $pricelist_no);


			if ($this->debug) echo 'Testname: '.$row['test_request'].'<br>';
			if ($this->debug) echo 'Encounter_nr:    '.$row['encounter_nr'].'<br>';
			if ($this->debug) echo 'radtest_nr:    '.$row['batch_nr'].'='.$batch_nr.'<br>';

	require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
          $insurance_tz = New Insurance_tz;
	$contract = $insurance_tz->CheckForValidContract($pid);

		   if ($this->debug) echo 'contract id : '.$contract['id'].'<br>';

          //$contract['id'] = 12;

        $radio_amount = $row[number_of_tests];

	$this->sql ="
                        INSERT INTO $this->tbl_bill_elements  " .
                        "       (" .
                                "               nr, " .
                                "               date_change, " .
                                "               is_labtest, " .
                                "               is_medicine, " .
                                "               is_radio_test, " .
                                "               is_comment, " .
                                "               is_paid, " .
                                "               amount, " .
                                "               amount_doc, " .
                                "               times_per_day, " .
                                "               days, " .
                                "               price, " .
                                "               description, " .
                                "               item_number, " .
                                "               balanced_insurance, " .
                                "               insurance_id, " .
				"               prescriptions_nr, " .
                                "               User_Id)" .
                                "
                        VALUES (".$bill_number.", '".time()."', 0, 0, 1, 0, 1, ".$radio_amount.", ".$radio_amount.", 0, 0, ".$price.",
 '".$row['item_description']."', ".$row['item_id'].", '".$insurance."', '".$contract['id']."', ".$row['batch_nr'].",'".$user_id."')";



			if ($this->debug) echo $this->sql;
			$db->Execute($this->sql);


			$this->sql = "UPDATE $this->tbl_rad_requests SET bill_number=".$bill_number.", bill_status='pending'
			WHERE batch_nr= ".$row['batch_nr'];

			if ($this->debug) echo $this->sql;
			$db->Execute($this->sql);
		}// end while
	}

	//------------------------------------------------------------------------------

function StoreAdvancePaymentToBill($pid,$bill_number, $insurance, $advance_payment,$notes){
		global $db, $root_path;
		global $user_id,$sid,$local_user;
		$this->debug=false;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<b>class_tz_billing::StoreAdvancePaymentToBill(pid: $pid, bill_number: $bill_number, insurance: $insurance,advance_payment:$advance_payment)</b><br>";

$user_id=$_SESSION['sess_user_name'];

$this->sql ="
			INSERT INTO $this->tbl_bill_elements  " .
			"	(" .
				"		nr, " .
				"		date_change, " .
				"		is_labtest, " .
				"		is_medicine, " .
				"		is_radio_test, " .
				"		is_comment, " .
				"		is_paid, " .
				"		amount, " .
				"		amount_doc, " .
				"		times_per_day, " .
				"		days, " .
				"		price, " .
				"		description, " .
				"		notes, " .
				"		item_number, " .
				"		balanced_insurance, " .
				"		insurance_id, " .
				"       prescriptions_nr, " .
				"		User_Id)" .
				"
			VALUES (".$bill_number.", '".time()."', 0, 0, 0, 0, 1, 1, 1, 0, 0, ".$advance_payment.", 'Advance', '".$notes."',0 , '".$insurance."', 0, 0,'".$user_id."')";

			if ($this->debug) echo $this->sql;
			$db->Execute($this->sql);


}

	//------------------------------------------------------------------------------

	function GetAdvanceTotalAmount($encounter_nr)
	{

	global $db, $root_path;
	$this->debug=FALSE;;
	if ($this->debug) echo "<b>class_tz_billing:: GetTotalAdvanceAmount($encounter_nr)</b><br>";
	$total_advance = 0;

	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$this->sql="SELECT * FROM care_tz_billing_archive_elem
			INNER JOIN care_tz_billing_archive
			ON
			care_tz_billing_archive.nr = care_tz_billing_archive_elem.nr

	WHERE description like 'Advance%' AND care_tz_billing_archive.encounter_nr = ".$encounter_nr ;

	if ($this->debug) echo $this->sql."<br>";
	$this->result=$db->Execute($this->sql);

	while($bill_elems_row=$this->result->FetchRow()) {

	$part_advance =	$bill_elems_row['price'];
	$total_advance += $part_advance ;

	}

return $total_advance;

}

//------------------------------------------------------------------------------

	function GetAllAdvancesForEncounter($encounter_nr)
	{

	global $db, $root_path;
	$this->debug=FALSE;;
	if ($this->debug) echo "<b>class_tz_billing:: GetAllAdvancesForEncounter($encounter_nr)</b><br>";
	$total_advance = 0;

	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$this->sql="SELECT * FROM care_tz_billing_archive_elem
			INNER JOIN care_tz_billing_archive
			ON
			care_tz_billing_archive.nr = care_tz_billing_archive_elem.nr

	WHERE description like 'Advance%' AND care_tz_billing_archive.encounter_nr = ".$encounter_nr ;

	$db->Execute($this->sql);
		$this->request = $db->Execute($this->sql);
		return $this->request;

}


	//------------------------------------------------------------------------------

	function ConvertMedicalItemAmount ( $amount ) {
		return $amount;
	}

	//------------------------------------------------------------------------------

	function GetPriceOfItem($item_number) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql="SELECT unit_price as price FROM $this->tb_drugsandservices WHERE item_id = '$item_number' ";
		if ($this->result=$db->Execute($this->sql)) {
			if ($this->result->RecordCount()) {
				$this->item_array = $this->result->GetArray();
				while (list($x,$v)=each($this->item_array)) {
					$db->debug=FALSE;
					return $v['price'];
				}
			} else {
				$db->debug=FALSE;
				return false;
			}
		}
	} // end of function GetPriceOfItem($item_number)




	//------------------------------------------------------------------------------

	function GetNameOfItem($item_number) {
		global $db;
		$debug=FALSE;
		($debug)?$db->debug=FALSE:$db->debug=FALSE;
		$this->sql="SELECT item_description as description FROM $this->tb_drugsandservices WHERE item_id = ".$item_number;
		if ($this->result=$db->Execute($this->sql)) {
			if ($this->result->RecordCount()) {
				$this->item_array = $this->result->GetArray();
				while (list($x,$v)=each($this->item_array)) {
					$db->debug=FALSE;
					return $v['description'];
				}
			} else {
				$db->debug=FALSE;
				return false;
			}
		}
	} // end of function GetNameOfDrug($item_number)


	//------------------------------------------------------------------------------


	function CreateBalanceBill($insurance_id, $value) {
		global $db;
		$debug=FALSE;
		($debug)?$db->debug=FALSE:$db->debug=FALSE;
		$this->sql="SELECT b.nr, b.encounter_nr FROM care_tz_billing_archive b, care_tz_billing_archive_elem be WHERE be.nr = b.nr AND be.insurance_id=".$insurance_id." ORDER by b.id DESC Limit 0,1";
		$this->result = $db->Execute($this->sql);
		if($this->row = $this->result->FetchRow())
		{
			$this->sql="INSERT INTO care_tz_billing_archive SET nr='balanced".$this->row['nr']."', encounter_nr=".$this->row['encounter_nr'].", first_date=".time().", creation_date=".time();
			$this->result = $db->Execute($this->sql);
			$this->sql="INSERT INTO care_tz_billing_archive_elem SET nr='balanced".$this->row['nr']."', date_change=".time().", is_labtest=0, is_medicine=0, is_comment=0, is_paid=1, amount=1, price=0, balanced_insurance=".$value.", insurance_id=".$insurance_id.", item_number=0, prescriptions_nr=0";
			$this->result = $db->Execute($this->sql);
			return true;
		}
		return false;
	}

	//------------------------------------------------------------------------------

	function GetBillNumbersFromPID($pid) {
		global $db;
		$debug=FALSE;
		($debug)?$db->debug=FALSE:$db->debug=FALSE;
		$this->sql="SELECT cb.nr FROM $this->tbl_bill cb, $this->tbl_bill_elements cbe, care_encounter ce, care_person cp
		WHERE cb.encounter_nr = ce.encounter_nr
		AND ce.pid = cp.pid
		AND cbe.nr = cb.nr
		AND cp.pid = $pid
		GROUP BY cb.nr";
		return $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------

	function GetArchivedBill($bill_nr) {
		global $db;
		$this->sql="SELECT nr FROM care_tz_billing_archive WHERE nr=".$bill_nr;
		return $db->Execute($this->sql);
	}


	//------------------------------------------------------------------------------

	function VerifyBill($bill_nr) {
		global $db;
		$this->sql="SELECT nr FROM $this->tbl_bill WHERE nr=".$bill_nr;
		//echo $this->sql;
		return $db->Execute($this->sql);
	}


	//------------------------------------------------------------------------------

	//------------------------------------------------------------------------------

	function GetArchivedBillEncounter($bill_nr) {
		global $db;
		$this->sql="SELECT id, encounter_nr FROM care_tz_billing_archive WHERE nr=".$bill_nr." order by id desc limit 1";
		while ($row = $db->Execute($this->sql)->FetchRow() )
		{
			return $db->Execute($this->sql)->FetchRow();
		}
	}

	//------------------------------------------------------------------------------

	function setBillIsTransmit2ERP($bill_number,$transmit) {
		global $db;
		$db->debug=false;
		$this->sql="update care_tz_billing_archive_elem SET is_transmit2ERP='".$transmit."' where nr=".$bill_number;
		$db->Execute($this->sql);
	}

	function GetElemsOfArchivedBill($nr,$what_kind_of) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
/*
		if ($what_kind_of=="prescriptions")
		$sql_where = " AND is_medicine=1 ";

		if ($what_kind_of=="laboratory")
		$sql_where = " AND is_labtest=1 ";

		if ($what_kind_of=="radiology")
		$sql_where = " AND is_radio_test=1 ";


		$this->sql="SELECT * FROM care_tz_billing_archive_elem
					 WHERE nr = ".$nr." $sql_where
					 ORDER BY date_change ASC";
		return $db->Execute($this->sql);
*/
		if ($what_kind_of=="prescriptions")
                $sql_where = "AND (purchasing_class = 'drug_list' OR purchasing_class = 'supplies')";

                if ($what_kind_of=="laboratory")
                $sql_where = "AND purchasing_class = 'labtest'";

                if ($what_kind_of=="radiology")
                $sql_where = "AND purchasing_class = 'xray'";

		if ($what_kind_of=="service")
                $sql_where = "AND purchasing_class = 'service'";

		if ($what_kind_of=="other")
                $sql_where = "AND (purchasing_class != 'drug_list'
			      AND purchasing_class!='supplies'
                              AND purchasing_class!='labtest'
                              AND purchasing_class!='service'
                              AND purchasing_class!='xray') ";

                $this->sql="SELECT $this->tbl_bill_archive_elements.*, care_tz_drugsandservices.purchasing_class FROM $this->tbl_bill_archive_elements
                                INNER JOIN care_tz_drugsandservices ON $this->tbl_bill_archive_elements.item_number=care_tz_drugsandservices.item_id
                                         WHERE nr = ".$nr." $sql_where
                                         ORDER BY date_change ASC";

		 return $db->Execute($this->sql);


	}


	function GetElemsOfArchivedBillForERP($nr)
	{
		global $db;
		$debug=false;
		($debug) ? $db->debug=FALSE : $db->debug=false;

		$this->sql="SELECT a.*, b.item_number FROM care_tz_billing_archive_elem a
		inner join care_tz_drugsandservices b on a.item_number = b.item_id where nr=".$nr;

		return $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------


	function GetElemsOfBill($nr,$what_kind_of) {
		global $db;
		$debug=false;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

/*		$sql='select purchasing_class from care_tz_drugsandservices left join care_tz_billing_elem
		on care_tz_drugsandservices.item_id=care_tz_billing_elem.item_number where care_tz_billing_elem.nr='.$nr;
		$result=$db->Execute($sql);
		$row=$result->FetchRow();
		$what_kind_of=$row[0];*/

		if ($what_kind_of=="drug_list" || $what_kind_of=="prescriptions")
		{
		 $sql_where = "AND (purchasing_class='drug_list' OR purchasing_class='supplies')";
		}
		else
		if ($what_kind_of=="labtest")
		{
		$sql_where =  "AND purchasing_class='".$what_kind_of."'";
		}
		else
		if ($what_kind_of=="xray")
		{
		$sql_where = "AND purchasing_class='".$what_kind_of."'";
		}
		else
		if ($what_kind_of=="service")
		{
		$sql_where = "AND purchasing_class='".$what_kind_of."'";
		}
		else
		if ($what_kind_of=="other")
		{
                $sql_where =  "AND (purchasing_class!='drug_list'
				AND  purchasing_class!='supplies'
				AND  purchasing_class!='labtest'
				AND  purchasing_class!='xray'
				AND  purchasing_class!='service')";

		}

		$this->sql="SELECT $this->tbl_bill_elements.*, care_tz_drugsandservices.purchasing_class FROM $this->tbl_bill_elements
				INNER JOIN care_tz_drugsandservices ON $this->tbl_bill_elements.item_number=care_tz_drugsandservices.item_id
					 WHERE nr = ".$nr." $sql_where
					 ORDER BY date_change ASC";
//		echo $this->sql;
		return $db->Execute($this->sql);
	}



//------------------------------------------------------------------------------

    function GetAdvanceBillElem($nr)
	{
		global $db;
		$debug=false;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$this->sql="SELECT * from $this->tbl_bill_elements
	WHERE nr = ".$nr." AND description ='Advance'
					 ORDER BY date_change ASC";

	return $db->Execute($this->sql);


	}

//------------------------------------------------------------------------------

	 function GetArchivedAdvanceBillElem($nr)
	{
		global $db;
		$debug=false;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	$this->sql="SELECT * from $this->tbl_bill_archive_elements
	WHERE nr = ".$nr." AND description ='Advance'
					 ORDER BY date_change ASC";

	return $db->Execute($this->sql);


	}

	function GetElemsOfBillByPrescriptionNr($nr) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;


		$this->sql="SELECT * FROM $this->tbl_bill_elements
					 WHERE prescriptions_nr = ".$nr;
		return $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------

	function GetElemsOfBillByPrescriptionNrArchive($nr) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;


		$this->sql="SELECT * FROM $this->tbl_bill_archive_elements
					 WHERE prescriptions_nr = ".$nr;
		//echo $this->sql;
		return $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------

	function GetBillByBatchNr($nr) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;


		$this->sql="SELECT bill_number FROM $this->tbl_lab_requests WHERE batch_nr=".$nr;
		$this->result= $db->Execute($this->sql);
		return $this->result->FetchRow();
	}

	//------------------------------------------------------------------------------


	function GetNameOfLAboratoryFromID($id)	{
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql="SELECT name FROM $this->tbl_lab_param
					 WHERE id = '".$id."'";
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
		return $this->records['name'];
	}

	//------------------------------------------------------------------------------

	function GetPriceOfLAboratoryItemFromID($id)	{
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql="SELECT price FROM ".$this->tbl_lab_param."
						 WHERE id = '".$id."'";
		//echo $this->sql;
		$this->result = $db->Execute($this->sql);
		if ($this->records=$this->result->FetchRow())
		return $this->records['price'];
	}

	// -----------------------------------------------------------------------------

	function GetBillTimestamp($bill_nr) {
		global $db;
		$debug=false;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$bill_nr) return false;
		$this->sql="SELECT first_date FROM care_tz_billing WHERE nr=".$bill_nr;
		$this->result = $db->Execute($this->sql);
		if($this->row = $this->result->FetchRow())
		{
			return $this->row['first_date'];
		}
		$this->sql="SELECT first_date FROM care_tz_billing_archive WHERE nr=".$bill_nr;
		$this->result = $db->Execute($this->sql);
		if($this->row = $this->result->FetchRow())
		{
			return $this->row['first_date'];
		}
		return false;
	}

	//------------------------------------------------------------------------------

	function GetBillCostSummaryInTimeframe($PID, $start, $end) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($debug) echo 'PID: '.$PID.' - Start: '.$start.' - End: '.$end.'<br>';
		/*
		 $this->sql="SELECT nr FROM care_tz_billing b, care_encounter e WHERE first_date>".$start." AND first_date <=".$end." AND e.encounter_nr = b.encounter_nr AND e.pid=".$PID;
		 if($this->result = $db->Execute($this->sql))
			while($this->row = $this->result->FetchRow())
			{
			$balanced_insurance = false;
			$this->elemsofbill = $this->GetElemsOfBill($this->row['nr'], false);
			while($this->elems = $this->elemsofbill->FetchRow())
			{
			$balanced_insurance += $this->elems['balanced_insurance'];
			}
			$return[$this->row['nr']] = $balanced_insurance;
			}
			*/

		$this->sql="SELECT nr FROM care_tz_billing_archive b, care_encounter e WHERE first_date>".$start." AND first_date <=".$end." AND e.encounter_nr = b.encounter_nr AND e.pid=".$PID;
		if($this->result = $db->Execute($this->sql))
		while($this->row = $this->result->FetchRow())
		{
			$balanced_insurance = false;
			$this->elemsofbill = $this->GetElemsOfArchivedBill($this->row['nr'], false);
			while($this->elems = $this->elemsofbill->FetchRow())
			{
				$balanced_insurance += $this->elems['balanced_insurance'];
			}
			$return[$this->row['nr']] = $balanced_insurance;
		}
		return $return;
	}

	//------------------------------------------------------------------------------

	function DisplayBillHeadline($bill_nr, $batch_nr) {
		global $LDBatchFileNr,$LDFileNo,$LDEncounterNr,$LDLastName,$LDFirstName,$LDBday,$LDSex,$LDBillNumber,$LDWard, $LDdepartment;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);


		$enc_obj = New Encounter;
		$encoded_batch_number = $enc_obj->ShowPID($batch_nr);
		$enc_number = $enc_obj->GetEncounterFromBatchNumber($batch_nr);


		$bill_address=$enc_obj->GetHospitalAddress();
		$bill_logo=$enc_obj->GetHospitalLogo();
		$bill_name=$enc_obj->GetHospitalName();

		$address_line = explode(",",$bill_address);

                $hosp_name = $address_line[0];
                $hosp_address = $address_line[1];
                $hosp_address_city = $address_line[2];


		if ($enc_obj->EncounterExists($enc_number)) {
			// Load the encounter data:
			$enc_data = $enc_obj->loadEncounterData($enc_number);

			$file_no = $enc_obj->SelianPID($enc_number);

			echo ($printout) ? '<table width="100%"  border="0" cellspacing=0 cellpadding=0 align="center" >' : '<table width="100%" border="0" cellspacing=1 cellpadding=0 >';
			echo '<tr><td align="center">'.$hosp_name.'<br>'.$hosp_address.'<br>'.$hosp_address_city.'</td></tr>
<tr><td align="right"><img src="../../'.$bill_logo.'" border=0 align="absmiddle" alt=""></td></tr></table>' ;

			echo ($printout) ? '<table width="100%"  border="0" cellspacing=0 cellpadding=0 >' : '<table width="100%"  border="0" cellspacing=1 cellpadding=0 >';

			echo '
  	  		<tr><td></td></tr>

  				<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3"><b>'.$LDBatchFileNr.'</b></font></span></span></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$encoded_batch_number.'</font></span></span></b></td>

  				</tr>


  				 <tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">Admission-Nr.:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$enc_number.'</font></span></span></b></td>
  					</tr>

				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">File No.:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$file_no.'</font></span></span></b></td>
  					</tr>

  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">Names:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$enc_obj->LastName($enc_number).', '.$enc_obj->FirstName($enc_number).'</font></span></span></b></td>
  					</tr>';
				/*
			  	if ($enc_data['in_dept']==0)
  				echo '<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDWard.'</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->CurrentWardName($enc_number).'</font></span></span></b></td>
  					</tr>';
				 else
				 echo '<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDdepartment.'</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->CurrentDeptName($enc_number).'</font></span></span></b></td>
  					</tr>';

				*/

  				/*
  				<tr>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">First name:</font></span></span></td>
  					<td bgcolor="#ffffee" class="vi_data"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$enc_obj->FirstName($enc_number).'</font></span></span></td>
  					</tr>
				*/


  				echo '<tr>

  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">Bill Date</font></span></span></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.date('d-m-Y').'</font></span></span></td>
  				</tr>
  				<tr>
  					<td class="headline"><b><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$LDBillNumber.'</font></span></span></b></td>
  					<td class="headline"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$bill_nr.'</font></span></span></b></td>
  				</tr>
		<tr>

  				</table>';
      return TRUE;
		}
		return FALSE;
	}

	//------------------------------------------------------------------------------





	function DisplayArchivedLaboratoryBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory;
		$sum_price=0;

		echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  				<!--<td  valign="top" >
					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDLaboratory.'</font></span></span></p>
				</td>-->
				<td>';

		$billelems=$this->GetElemsOfArchivedBill($bill_nr,"laboratory");
		//echo "edit fields is set to:".$edit_fields;
		echo '
      			<table width="100%" height="100%" class="table_content">
	      			<tr>
	      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">Position Nr.</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></td>' .
	      				'<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></td>
	      			</tr>';

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_labtest']==1)
			{

				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc=$bill_elems_row['description'];
				$price=$bill_elems_row['price'];

			}
			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;
			echo '
      				<tr>
      				  <td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$pos_nr.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$desc.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$price.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$bill_elems_row['amount'].'</font></span></span></td>' .
        				'<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">';
			if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
			else echo '0,00';
			echo '</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
        			</tr>';

		}

		echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>----------</td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.$LDtotalamount.'</font></span></span></i></td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
				</tr>
			</table>
			</td>
		</tr>
  	</table>';
		return $sum;

	}

	//------------------------------------------------------------------------------
	function DisplayArchivedRadiologyBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDRadiology;
		$sum_price=0;

		echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  				<!--<td  valign="top" >
					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDRadiology.'</font></span></span></p>
				</td>-->
				<td>';

		$billelems=$this->GetElemsOfArchivedBill($bill_nr,"radiology");
		//echo "edit fields is set to:".$edit_fields;
		echo '
      			<table width="100%" height="100%" class="table_content">
	      			<tr>
	      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">Position Nr.</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></td>' .
	      				'<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></td>
	      			</tr>';

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_radio_test']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$this->radio_testname=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			}
			$part_sum = ($this->price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;
			echo '
      				<tr>
      				  <td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$pos_nr.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$this->radio_testname.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$this->price.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$bill_elems_row['amount'].'</font></span></span></td>' .
        				'<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">';
			if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
			else echo '0,00';
			echo '</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
        			</tr>';

		}

		echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>----------</td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.$LDtotalamount.'</font></span></span></i></td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
				</tr>
			</table>
			</td>
		</tr>
  	</table>';
		return $sum;

	}

	function DisplayLaboratoryBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory,$insurance_used;
		$sum_price=0;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);

		$billelems=$this->GetElemsOfBill($bill_nr,"labtest");

		// **********************************************************************************************************
		// Start of the integrated table for this section
		echo ($printout) ? '<table border="0" width="100%">': '<table border="0" width="600" class="table_content">';

		while($bill_elems_row=$billelems->FetchRow()) {

			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_labtest']==1)
			{
		  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
		  $desc=$bill_elems_row['description'];
		  $price=$bill_elems_row['price'];

			}

			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];

			$sum += $part_sum;

			// headline
			echo '<tr>';
			echo '<td colspan="2"><b>'.$desc.'</b></td>';
			echo '</tr>';

			// price
			echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td>'.$price.'</td>';
			echo '</tr>';

			// Quantitiy
			echo '<tr>';
			echo '<td>Quantity</td>';
			echo '<td>'.$bill_elems_row['amount'].'</td>';
			echo '</tr>';


			// SUBTOTAL:
			echo '<tr>';
			echo '<td>subtotal:</td>';
			echo '<td>'.number_format(($price*$bill_elems_row['amount']),0,'.',',').'</td>';
			echo '</tr>';

			// How much is covered by insurance
			echo '<tr>';
			 echo '<td>'.'- '.$LDPaidbyInsurance.'</td>';
                        if($bill_elems_row['balanced_insurance']>0)
                        echo '<td>'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';
                        else
                        echo '<td>0,00</td>';
			echo '</tr>';

			//$mySum = $sum - $insurance_used;


			// The total of this price (current price - covered by insurance)
			echo '<tr>';
			echo '<td>'.$LDpartSum.'</td>';
			echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
			echo '</tr>';

			//$sum = $sum + $mySum;

			// End of details for this lab-test
			echo '<tr>';
			echo '<td colspan="2"><hr></td>';
			echo '</tr>';



		} // end of while($bill_elems_row=$billelems->FetchRow()) {

		echo '</table>';
		// end of the integrated table of this section
		// **********************************************************************************************************

		return $sum;
	}

	//------------------------------------------------------------------------------



	function DisplayRadiologyBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDRadiology;

		$sum_price=0;
		$sum = 0;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);

		$billelems=$this->GetElemsOfBill($bill_nr,"xray");



		// **********************************************************************************************************
		// Start of the integrated table for this section
		echo ($printout) ? '<table border="0" width="100%">': '<table border="0" width="100%" class="table_content">';

		while($bill_elems_row=$billelems->FetchRow()) {
			$mySum = 0; // this is the tota sum to pay for each rad-test
			$insurance_used = 0;
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_radio_test']==1)
			{
		  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
		  $desc=$bill_elems_row['description'];
		  $price=$bill_elems_row['price'];

		  if (empty($price)) $price="0,00";

			}

			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
		//	if($this->debug) echo '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;

			// headline
			echo '<tr>';
			echo '<td colspan="2"><b>'.$desc.'</b></td>';
			echo '</tr>';

			// price
			echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td>'.$price.'</td>';
			echo '</tr>';

			// Quantitiy
			echo '<tr>';
			echo '<td>Quantity</td>';
			echo '<td>'.$bill_elems_row['amount'].'</td>';
			echo '</tr>';


			// SUBTOTAL:
			echo '<tr>';
			echo '<td>subtotal:</td>';
			echo '<td>'.number_format(($price*$bill_elems_row['amount']),0,'.',',').'</td>';
			echo '</tr>';

			//$mySum = $this->price * $bill_elems_row['amount'];

			// How much is covered by insurance
			echo '<tr>';
			echo '<td>'.$LDPaidbyInsurance.'</td>';
			if($bill_elems_row['balanced_insurance']>0)
			echo '<td>'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';
			else
			echo '<td>0,00</td>';

			echo '</tr>';

			//$mySum = $mySum - $insurance_used;


			// The total of this price (current price - covered by insurance)
			echo '<tr>';
			echo '<td>'.$LDpartSum.'</td>';
			echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
			echo '</tr>';

			//$sum = $sum + $mySum;

			// End of details for this rad-test
			echo '<tr>';
			echo '<td colspan="2"><hr></td>';
			echo '</tr>';



		} // end of while($bill_elems_row=$billelems->FetchRow()) {

		echo "</table>";
		// end of the integrated table of this section
		// **********************************************************************************************************

		return $sum;
	}

	//------------------------------------------------------------------------------

	function DisplayServicesBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDRadiology;

		$sum_price=0;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);

		$billelems=$this->GetElemsOfBill($bill_nr,"service");

		// **********************************************************************************************************
		// Start of the integrated table for this section
		echo ($printout) ? '<table border="0" width="100%">': '<table border="0" width="600" class="table_content">';

		while($bill_elems_row=$billelems->FetchRow()) {
			$mySum = 0; // this is the tota sum to pay for each rad-test
			$insurance_used = 0;
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_medicine']==1)
			{
		  $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
		  $desc=$bill_elems_row['description'];
		  $price=$bill_elems_row['price'];
		  if (empty($price)) $price="0,00";

			}

			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];

			$sum += $part_sum;

			// headline
			echo '<tr>';
			echo '<td colspan="2"><b>'.$desc.'</b></td>';
			echo '</tr>';

			// price
			echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td style="text-align: right;">'.number_format($price,0,'.',',').'</td>';
			echo '</tr>';

			// Quantitiy
			echo '<tr>';
			echo '<td>Quantity</td>';
			echo '<td style="text-align: right;">'.$bill_elems_row['amount'].'</td>';
			echo '</tr>';


			//$mySum = $this->price * $bill_elems_row['amount'];

			// How much is covered by insurance
			echo '<tr>';
			echo '<td>'.'- '.$LDPaidbyInsurance.'</td>';
                        if($bill_elems_row['balanced_insurance']>0)
                        echo '<td style="text-align: right;">'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';
                        else
                        echo '<td>0,00</td>';
			echo '</tr>';

			//$mySum = $mySum - $insurance_used;


			// The total of this price (current price - covered by insurance)
			echo '<tr>';
			echo '<td>'.$LDpartSum.'</td>';
			echo '<td style="text-align: right;"><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
			echo '</tr>';

			//$sum = $sum + $mySum;

			// End of details for this rad-test
			echo '<tr>';
			echo '<td colspan="2"><hr></td>';
			echo '</tr>';



		} // end of while($bill_elems_row=$billelems->FetchRow()) {

		echo "</table>";
		// end of the integrated table of this section
		// **********************************************************************************************************

		return $sum;
	}

	//------------------------------------------------------------------------------

	function DisplayArchivedServicesBill($bill_nr, $edit_fields){

                global $root_path, $billnr, $batch_nr;
                global $LDItemNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,$LDtotalamount,
                $LDPrescriptionOther,$LDTimesPerDay,$LDDays;

                echo '
        <table width="100%" border="0" class="table_content">
                        <tr>
                        <!--    <td valign="top" >
                                        <p class="billing_topic"><br>'.$LDPrescriptionOther.'</p>
                                </td>-->
                                <td>';

                $billelems=$this->GetElemsOfArchivedBill($bill_nr,"service");

                echo '
                        <table border="0" width="100%" class="table_content">
                        <tr>
                          <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDItemNr.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></b></td>
                                </tr>';

                while($bill_elems_row=$billelems->FetchRow())
                {
                        $insurance_used += $bill_elems_row['balanced_insurance'];
                        $pos_nr+=1;
                        if($bill_elems_row['is_medicine']==1)
                        {
                                $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
                                $desc = $bill_elems_row['description'];
                                $price = $bill_elems_row['price'];
                        }
                        $part_sum = ($price*$bill_elems_row['amount']-$bill_elems_row['balanced_insurance']);
                        $sum += $part_sum;

			 echo '
                                <tr>
                                  <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$pos_nr.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$desc.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$price.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['amount'].'</font></span></span></td>' .

                                        '<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
                        if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
                        else echo '0,00';
                        echo '</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
                                        </tr>';

                }
                echo '
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>' .
                                '<td>&nbsp;</td>
                                <td>----------</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>' .
                          '<td>&nbsp;</td>
                                <td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDtotalamount.'</font></span></span></i></td>
				 <td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                  <td>----------</td>
                </tr>
            </table>
                </td>
        </tr>
        </table>';

                return $sum;
        }

        //------------------------------------------------------------------------------


	function DisplayCompanyLaboratoryBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDLaboratory;
		$sum_price=0;


		$billelems=$this->GetElemsOfBill($bill_nr,"labtest");
		//echo "edit fields is set to:".$edit_fields;

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_labtest']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$this->chemlab_testname=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			}
			$part_sum = ($this->price*$bill_elems_row['amount']);
			$sum += $part_sum;

			$insurance_amt +=$bill_elems_row['balanced_insurance'];
		}
		//$sum -= $insurance_used;
		if($insurance_used) {
			echo "Insurance is used";

			$pos_nr += 1;

		}
		//if($sum==0)$sum=$insurance_amt;
		return $sum;
	}

	//------------------------------------------------------------------------------

	function DisplayCompanyRadiologyBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDRadiology;
		$sum_price=0;


		$billelems=$this->GetElemsOfBill($bill_nr,"xray");
		//echo "edit fields is set to:".$edit_fields;

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_radio_test']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$this->radio_testname=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			}
			$part_sum = ($this->price*$bill_elems_row['amount']);
			$sum += $part_sum;

			$insurance_amt +=$bill_elems_row['balanced_insurance'];
		}
		//$sum -= $insurance_used;
		if($insurance_used) {
			echo "Insurance is used";

			$pos_nr += 1;

		}
		//if($sum==0)$sum=$insurance_amt;
		return $sum;
	}

	//------------------------------------------------------------------------------



	function DisplayArchivedPrescriptionBill($bill_nr, $edit_fields){

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,$LDtotalamount,
		$LDPrescriptionOther,$LDTimesPerDay,$LDDays;

		echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  			<!--	<td valign="top" >
  					<p class="billing_topic"><br>'.$LDPrescriptionOther.'</p>
  				</td>-->
  				<td>';

		$billelems=$this->GetElemsOfArchivedBill($bill_nr,"prescriptions");

		echo '
      			<table border="0" width="100%" class="table_content">
      			<tr>
      			  <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPositionNr.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDTimesPerDay.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDDays.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></b></td>
      				<td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></b></td>
				</tr>';

		while($bill_elems_row=$billelems->FetchRow())
		{
			$insurance_used += $bill_elems_row['balanced_insurance'];
			$pos_nr+=1;
			if($bill_elems_row['is_medicine']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc = $bill_elems_row['description'];
				$price = $bill_elems_row['price'];
			}
			$part_sum = ($price*$bill_elems_row['amount']-$bill_elems_row['balanced_insurance']);
			$sum += $part_sum;
			echo '
      				<tr>
      				  <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$pos_nr.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$desc.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$price.'</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['amount'].'</font></span></span></td>

        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['times_per_day'].'</font></span></span></td>

        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['days'].'</font></span></span></td>' .
        				'<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
			if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
			else echo '0,00';
			echo '</font></span></span></td>
        				<td ><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
					</tr>';

		}
		echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  	'<td>&nbsp;</td>
      				<td>----------</td>
      			</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>' .
      			  '<td>&nbsp;</td>
      				<td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDtotalamount.'</font></span></span></i></td>
      				<td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
      			</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
            	</tr>
            </table>
		</td>
	</tr>
  	</table>';

		return $sum;
	}

	//------------------------------------------------------------------------------

	function DisplayPrescriptionBill($bill_nr, $edit_fields){

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance, $insurance_used,
		$LDPrescriptionOther;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);

		$this->debug = true;
		echo ($printout) ? '<table width="100%" border="0">':'<table width="600" border="0" class="table_content">';
		/*
		echo '
  			<tr>
  				<!--<td valign="top" >
  					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDPrescriptionOther.'</font></span></span></p>
  				</td>-->
  				<td>';
*/
		$billelems=$this->GetElemsOfBill($bill_nr,"drug_list");

		//echo '<table border="0" width="100%">';

		while($bill_elems_row=$billelems->FetchRow()) {
			$insurance_used += $bill_elems_row['balanced_insurance'];
			$pos_nr+=1;
			if($bill_elems_row['is_medicine']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc = $bill_elems_row['description'];
				$price = $bill_elems_row['price'];
			}
			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
		//	if($this->debug) echo '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;

			// description of the item
			echo '<tr>';
			echo '<td colspan="2"><b>'.$desc.'</b></td>';
			echo '</tr>';
			// price out of the list:
			echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td>'.$price.'</td>';
			echo '</tr>';
			// Quantity...
			echo '<tr>';
			echo '<td>Quantity</td>';
			echo '<td>'.$bill_elems_row['amount'].'</td>';
			echo '</tr>';
			// Times per day:
			echo '<tr>';
			echo '<td>Times per day</td>';
			echo '<td>'.$bill_elems_row['times_per_day'].'</td>';
			echo '</tr>';
			// days:
			echo '<tr>';
			echo '<td>Days</td>';
			echo '<td>'.$bill_elems_row['days'].'</td>';
			echo '</tr>';
			// SUBTOTAL:
			echo '<tr>';
			echo '<td>subtotal:</td>';
			echo '<td>'.number_format(($price*$bill_elems_row['amount']),0,'.',',').'</td>';
			echo '</tr>';
			// How much is covered by insurance
			echo '<tr>';
			echo '<td>'.'- '.$LDPaidbyInsurance.'</td>';
			if($bill_elems_row['balanced_insurance']>0)
			echo '<td>'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';
			else
			echo '<td>0,00</td>';

			echo '</tr>';
			// Show the calculated sum of it now
			echo '<tr>';
			echo '<td><b>'.$LDpartSum.'</b></td>';
			echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
			echo '</tr>';
			// an emtpy row
			echo '<tr>';
			echo '<td colspan="2"><hr>&nbsp;</td>';
			echo '</tr>';


		} // end of while($bill_elems_row=$billelems->FetchRow())

		//$sum -= $bill_elems_row['balanced_insurance'];
		echo '</table>';

		return $sum;
	}


	//------------------------------------------------------------------------------

	function DisplayCompanyPrescriptionBill($bill_nr, $edit_fields){

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,
		$LDPrescriptionOther,$insurance_used;
		global $db;
		$this->debug = TRUE;

		$billelems=$this->GetElemsOfBill($bill_nr,"drug_list");

		while($bill_elems_row=$billelems->FetchRow())
		{
			$insurance_used += $bill_elems_row['balanced_insurance'];
			$pos_nr+=1;
			if($bill_elems_row['is_medicine']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc = $bill_elems_row['description'];
				$price = $bill_elems_row['price'];
				$sql="select distinct(purchasing_class) from care_tz_drugsandservices where item_description='$desc'";
				$result=$db->Execute($sql);
				$purchasing_class_row=$result->FetchRow();
				$purchasing_class=$purchasing_class_row['purchasing_class'];
				switch($purchasing_class)
				{
					case "xray":
						$xray_amt += $price*$bill_elems_row['amount'];
						break;
					case "smallop":
						$dress_amt += $price*$bill_elems_row['amount'];
						break;
					case "bigop":
						$surgery_amt += $price*$bill_elems_row['amount'];
						break;
					case "dental":
						$dental_amt += $price*$bill_elems_row['amount'];
						break;
					case "drug_list":
						$drug_amt1 += $price*$bill_elems_row['amount'];
						break;
					case "special_others_list":
						$drug_amt2 += $price*$bill_elems_row['amount'];
						break;
					case "supplies":
						$drug_amt3 += $price*$bill_elems_row['amount'];
						break;
					case "service":
						$service_amt += $price*$bill_elems_row['amount'];
						break;
					default:
						$others_amt += $price*$bill_elems_row['amount'];
						//return FALSE;
				}

			}
			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
			if($this->debug) '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;

			//$insurance_amt +=$bill_elems_row['balanced_insurance'];

		}
		//$sum -= $bill_elems_row['balanced_insurance'];
		//$total_laboratory = $this->DisplayCompanyLaboratoryBill($bills['nr'],$edit_fields);
		//echo $insurance_amt;
		$drug_amt=$drug_amt1+$drug_amt2+$drug_amt3;



		$billelems=$this->GetElemsOfBill($bill_nr,"labtest");
		//echo "edit fields is set to:".$edit_fields;

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used_lab +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_labtest']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$this->chemlab_testname=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			}
			$part_sum = ($this->price*$bill_elems_row['amount']);
			$sum_lab += $part_sum;

			$insurance_amt +=$bill_elems_row['balanced_insurance'];
		}
		$sum_lab -= $insurance_used_lab;

		if($sum_lab==0)$sum_lab=$insurance_amt;


		$sum=$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;
		$total_amt=$sum_lab+$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;

		$billelems=$this->GetElemsOfBill($bill_nr,"xray");
		//echo "edit fields is set to:".$edit_fields;

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_id=$bill_elems_row['insurance_id']; // could be used later to display name of company
			$insurance_used_radio +=$bill_elems_row['balanced_insurance'];
			if($bill_elems_row['is_radio_test']==1)
			{
				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$this->radio_testname=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			}
			$part_sum = ($this->price*$bill_elems_row['amount']);
			$sum_radio += $part_sum;

			$insurance_amt +=$bill_elems_row['balanced_insurance'];
		}
		$sum_radio -= $insurance_used_radio;

		if($sum_radio==0)$sum_radio=$insurance_amt;


		$sum=$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;
		$total_amt=$sum_lab+$sum_radio+$drug_amt+$others_amt+$service_amt+$dental_amt+$surgery_amt+$dress_amt+$xray_amt;

		echo '<table border="2" width="100%">

  		<tr>
  				<tr><td>Service(TSH)</td><td>'.number_format(($service_amt),2,'.',',').'</td></tr>
		  		<tr><td>Labs(TSH)</td><td>'.number_format(($sum_lab),2,'.',',').'</td></tr>
		  		<tr><td>Radiology(TSH)</td><td>'.number_format(($sum_radio),2,'.',',').'</td></tr>
		  		<tr><td>X-Ray(TSH)</td><td>'.number_format(($xray_amt),2,'.',',').'</td></tr>
		  		<tr><td>Dawa(TSH)</td><td>'.number_format(($drug_amt),2,'.',',').'</td></tr>
		  		<tr><td>Proc/Surg(TSH)</td><td>'.number_format(($surgery_amt),2,'.',',').'</td></tr>
		  		<tr><td>Dress(TSH)</td><td>'.number_format(($dress_amt),2,'.',',').'</td></tr>
		  		<tr><td>Dental(TSH)</td><td>'.number_format(($dental_amt),2,'.',',').'</td></tr>
		  		<tr><td>Others(TSH)</td><td>'.number_format(($others_amt),2,'.',',').'</td></tr>
		  		<tr><td>Total(TSH)</td><td>'.number_format(($total_amt),2,'.',',').'</td></tr>

		</tr>


  	  				</table>';



		return $sum;
	}


	 //------------------------------------------------------------------------------

        function DisplayOtherBill($bill_nr, $edit_fields){



                global $db,$root_path, $billnr, $batch_nr;
                global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance, $insurance_used,
                $LDPrescriptionOther;

		$debug=false;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

                // Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
                if (func_num_args()>2)
                $printout=func_get_arg (2);

               // $this->debug = true;
                echo ($printout) ? '<table width="100%" border="0">':'<table width="600" border="0" class="table_content">';
				/*
                echo '
                        <tr>
                                <!--<td valign="top" >
                                        <p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDPrescriptionOther.'</font></span></span></p>
                                </td>-->
                                <td>';
*/

                $billelems=$this->GetElemsOfBill($bill_nr,"other");

                //echo '<table border="0" width="100%">';
                while($bill_elems_row=$billelems->FetchRow()) {
                        $insurance_used += $bill_elems_row['balanced_insurance'];
                        $pos_nr+=1;
                        if($bill_elems_row['is_medicine']==1)
                        {
                                $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
                                $desc = $bill_elems_row['description'];
                                $price = $bill_elems_row['price'];
                        }

                        $part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];

	//	if($this->debug) echo '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
                        $sum += $part_sum;

                        // description of the item
                        echo '<tr>';
                        echo '<td colspan="2"><b>'.$desc.'</b></td>';
                        echo '</tr>';
                        // price out of the list:
                        echo '<tr>';
                        echo '<td>'.$LDPrice.'</td>';
                        echo '<td>'.$price.'</td>';
                        echo '</tr>';
                        // Quantity...
                        echo '<tr>';
                        echo '<td>Quantity</td>';
                        echo '<td>'.$bill_elems_row['amount'].'</td>';
                        echo '</tr>';

                        // SUBTOTAL:
                        echo '<tr>';
                        echo '<td>subtotal:</td>';
                        echo '<td>'.number_format(($price*$bill_elems_row['amount']),0,'.',',').'</td>';
                        echo '</tr>';
                        // How much is covered by insurance
                        echo '<tr>';
                        echo '<td>'.'- '.$LDPaidbyInsurance.'</td>';
                        if($bill_elems_row['balanced_insurance']>0)
                        echo '<td>'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';

			 else
                        echo '<td>0,00</td>';

                        echo '</tr>';
                        // Show the calculated sum of it now
                        echo '<tr>';
                        echo '<td><b>'.$LDpartSum.'</b></td>';
                        echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
                        echo '</tr>';
                        // an emtpy row
                        echo '<tr>';
                        echo '<td colspan="2"><hr>&nbsp;</td>';
                        echo '</tr>';


                } // end of while($bill_elems_row=$billelems->FetchRow())

                //$sum -= $bill_elems_row['balanced_insurance'];
                echo '</table>';

                return $sum;
        }


	//------------------------------------------------------------------------------

	function DisplayArchivedOtherBill($bill_nr, $edit_fields){

                global $root_path, $billnr, $batch_nr;
                global $LDItemNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance,$LDtotalamount,
                $LDPrescriptionOther,$LDTimesPerDay,$LDDays;

                echo '
        <table width="100%" border="0" class="table_content">
                        <tr>
                        <!--    <td valign="top" >
                                        <p class="billing_topic"><br>'.$LDPrescriptionOther.'</p>
                                </td>-->
                                <td>';

                $billelems=$this->GetElemsOfArchivedBill($bill_nr,"other");

                echo '
                        <table border="0" width="100%" class="table_content">
                        <tr>
                          <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPositionNr.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></b></td>
                                <td><b><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></b></td>
                                </tr>';

                while($bill_elems_row=$billelems->FetchRow())
                {
                        $insurance_used += $bill_elems_row['balanced_insurance'];
                        $pos_nr+=1;
                        if($bill_elems_row['is_medicine']==1)
                        {
                                $this->tbl_bill_elem_ID=$bill_elems_row['ID'];
                                $desc = $bill_elems_row['description'];
                                $price = $bill_elems_row['price'];
                        }
                        $part_sum = ($price*$bill_elems_row['amount']-$bill_elems_row['balanced_insurance']);
                        $sum += $part_sum;

			 echo '
                                <tr>
                                  <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$pos_nr.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$desc.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$price.'</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$bill_elems_row['amount'].'</font></span></span></td>' .

                                        '<td ><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
                        if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
                        else echo '0,00';
                        echo '</font></span></span></td>
                                        <td ><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
                                        </tr>';

                }
                echo '
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>' .
                                '<td>&nbsp;</td>
                                <td>----------</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>' .
                          '<td>&nbsp;</td>
                                <td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDtotalamount.'</font></span></span></i></td>
				 <td><i><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                  <td>----------</td>
                </tr>
            </table>
                </td>
        </tr>
        </table>';

                return $sum;
        }



//------------------------------------------------------------------------------

	function DisplayAdvanceBillItem($bill_nr,$edit_fields){

		global $root_path, $billnr, $batch_nr;
		global $LDPositionNr,$LDArticle,$LDPrice,$LDAmount,$LDpartSum,$LDPaidbyInsurance, $insurance_used,
		$LDPrescriptionOther;

		// Maybe optional parameter given to this funciton: Is it a print-out-page or not (For table resize)
		if (func_num_args()>2)
		$printout=func_get_arg (2);

		$this->debug = true;

		echo ($printout) ? '<table width="100%" border="0">':'<table width="600" border="0" class="table_content">';

		$billelems=$this->GetAdvanceBillElem($bill_nr);

		while($bill_elems_row=$billelems->FetchRow()) {
			$insurance_used += $bill_elems_row['balanced_insurance'];
			$pos_nr+=1;
							$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc = $bill_elems_row['description'];
				$price = $bill_elems_row['price'];

			$part_sum = ($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
		//	if($this->debug) echo '+'.$price.'*'.$bill_elems_row['amount'].'-'.$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;

			// description of the item
			echo '<tr>';
			echo '<td colspan="2"><b>'.$desc.'</b></td>';
			echo '</tr>';
			// price out of the list:
			echo '<tr>';
			echo '<td>'.$LDPrice.'</td>';
			echo '<td>'.$price.'</td>';
			echo '</tr>';
			// Quantity...
			echo '<tr>';
			echo '<td>Quantity</td>';
			echo '<td>'.$bill_elems_row['amount'].'</td>';
			echo '</tr>';
			// SUBTOTAL:
			echo '<tr>';
			echo '<td>subtotal:</td>';
			echo '<td>'.number_format(($price*$bill_elems_row['amount']),0,'.',',').'</td>';
			echo '</tr>';
			// How much is covered by insurance
			echo '<tr>';
			echo '<td>'.'- '.$LDPaidbyInsurance.'</td>';
			if($bill_elems_row['balanced_insurance']>0)
			echo '<td>'.number_format($bill_elems_row['balanced_insurance'],0,'.',',').'</td>';
			else
			echo '<td>0,00</td>';

			echo '</tr>';
			// Show the calculated sum of it now
			echo '<tr>';
			echo '<td><b>'.$LDpartSum.'</b></td>';
			echo '<td><b>'.number_format(($price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'],0,'.',',').'</b></td>';
			echo '</tr>';
			// an emtpy row
			echo '<tr>';
			echo '<td colspan="2"><hr>&nbsp;</td>';
			echo '</tr>';


		} // end of while($bill_elems_row=$billelems->FetchRow())

		//$sum -= $bill_elems_row['balanced_insurance'];
		echo '</table>';

		return $sum;
	}


        //------------------------------------------------------------------------------

function DisplayArchivedAdvanceBill($bill_nr,$edit_fields) {

		global $root_path, $billnr, $batch_nr;
		global $LDArticle,$LDPrice,$LDAmount,$LDPaidbyInsurance,$LDpartSum,$LDtotalamount,$LDAdvance;
		$sum_price=0;

		echo '
  	<table width="100%" border="0" class="table_content">
  			<tr>
  				<!--<td  valign="top" >
					<p class="billing_topic"><br><span style="font-family:&quot;20 cpi&quot;"><font size="-2">'.$LDAdvance.'</font></span></span></p>
				</td>-->
				<td>';

		$billelems=$this->GetArchivedAdvanceBillElem($bill_nr);
		//echo "edit fields is set to:".$edit_fields;
		echo '
      			<table width="100%" height="100%" class="table_content">
	      			<tr>
	      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">Position Nr.</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDArticle.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPrice.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDAmount.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDPaidbyInsurance.'</font></span></span></td>
	      				<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$LDpartSum.'</font></span></span></td>
	      			</tr>';

		while($bill_elems_row=$billelems->FetchRow())
		{
			$pos_nr+=1;
			$insurance_used +=$bill_elems_row['balanced_insurance'];

				$this->tbl_bill_elem_ID=$bill_elems_row['ID'];
				$desc=$bill_elems_row['description'];
				$this->price=$bill_elems_row['price'];
				if (empty($this->price)) $this->price="0,00";

			$part_sum = ($this->price*$bill_elems_row['amount'])-$bill_elems_row['balanced_insurance'];
			$sum += $part_sum;
			echo '
      				<tr>
      				  <td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$pos_nr.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$desc.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$this->price.'</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.$bill_elems_row['amount'].'</font></span></span></td>' .
        				'<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">';
			if($bill_elems_row['balanced_insurance']>0) echo number_format($bill_elems_row['balanced_insurance'],2,'.',',');
			else echo '0,00';
			echo '</font></span></span></td>
        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1">'.number_format($part_sum,2,'.',',').'</font></span></span></td>
        			</tr>';

		}

		echo '
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>----------</td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.$LDtotalamount.'</font></span></span></i></td>
      			  <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="1"><i>'.number_format($sum,2,'.',',').'</font></span></span></i> </td>
				</tr>
      			<tr>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
      			  <td>&nbsp;</td>
              	  <td>----------</td>
				</tr>
			</table>
			</td>
		</tr>
  	</table>';
		return $sum;

	}


  //---------------------------------------------------------------------------------------

	function EditBillElement($id) {
		global $root_path, $db;
		// get the elements out of this billing-table:
		$this->sql = "SELECT
                      care_tz_billing_elem.nr,
                      care_tz_billing.encounter_nr,
                      care_tz_billing_elem.description,
                      care_tz_billing_elem.price,
                      care_tz_billing_elem.amount,
                      care_tz_billing_elem.amount_doc,
                      care_tz_billing_elem.is_paid
                FROM
                  care_tz_billing_elem
                    INNER JOIN care_tz_billing
                      ON care_tz_billing.nr=care_tz_billing_elem.nr
                WHERE care_tz_billing_elem.ID=".$id;

		$this->result = $db->Execute($this->sql);
		if ($this->row=$this->result->FetchRow()) {
	  $enc_obj = New Encounter;

	  $this->bill_number=$this->row['nr'];

	  $this->encounter_nr=$this->row['encounter_nr'];
	  $this->batch_nr=$enc_obj->GetBatchFromEncounterNumber($this->encounter_nr);

	  $this->description=$this->row['description'];
	  $this->price=$this->row['price'];
	  $this->amount=$this->row['amount'];
	  $this->amount_doc=$this->row['amount_doc'];

	  $this->payed_status_checked = '';
	  $this->outstanding_checked  = '';
	  if ($this->is_paid=$this->row['is_paid'])
	  $this->payed_status_checked = 'checked';
	  else
	  $this->outstanding_checked = 'checked';
		}

		//echo $this->batch_nr;
		$this->DisplayBillHeadline($this->bill_number, $this->batch_nr);

		echo '<table width="800" border="1">';
		echo '
<link rel="stylesheet" href="'.$root_path.'css/themes/default/default.css" type="text/css">
<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>
		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
          <tr valign=top  class="warnprompt" >
            <td bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066">Billing: modification item</font> </td>
            <td bgcolor="#99ccff" align=right>&nbsp; </td>
          </tr>
       </table>
 		</td>
	</tr>
	<tr>
    <td bgcolor=#ffffff valign=top>
      <font class="warnprompt"><br></font>
      <form ENCTYPE="multipart/form-data" action="billing_tz_edit.php" method="post" name="inputform">
	      <table border=0 cellspacing=1 cellpadding=3>
            <tbody class="submenu">
              <tr>
                <td align=right width=339 >description</td>
                <td width="339"><input type="text" name="description" value="'.$this->description.'"  size=50 maxlength=50></td>
                <td width="37" rowspan=14 valign=top> <br> </td>
              </tr>
              <tr>
                <td align=right width=339>price</td>
                <td><input name="price" type="text" value="'.$this->price.'"  size=10 maxlength=10>
                </td>
              </tr>
              <tr>
                <td align=right> Amount</td>
                <td><input type="text" name="amount" value="'.$this->amount.'"  size=10 maxlength=10>
                ';

		if($this->amount_doc!=$this->amount)
		echo '(Prescribed amount: '.$this->amount_doc.')';

		echo '
                </td>
              </tr>
              <tr>
                <td align=right width=339> payment status of this billing item</td>
                <td>
                    <input type="radio" name="payment_status" value="paid" '.$this->payed_status_checked.'> paid
                    <input name="payment_status" type="radio" value="outstanding" '.$this->outstanding_checked.'> outstanding
                </td>
              </tr>
              <tr>
                <td colspan="2" align=right>&nbsp;</td>
              </tr>
              <tr>
                <td align=right width=339>&nbsp;</td>
                <td align=right>
                    Prepare this dataset for
                    <select name="specific_mode">
                      <option value="delete">Delete</option>
                      <option value="update" selected>Update</option>
                    </select>
                    <input type="hidden" name="mode" value="modfication">
                    <input type="hidden" name="bill_elem_number" value="'.$id.'">
                    <input type="hidden" name="encounter_nr" value="'.$this->encounter_nr.'">
                    <input type="hidden" name="batch_nr" value="'.$this->batch_nr.'">
                    <input type="submit" value="OK">
                  </td>
              </tr>
            </tbody>
          </table>
        </form>
      <a href="'.$root_path.'modules/billing_tz/billing_tz_pending.php"><img src="'.$root_path.'gui/img/control/default/en/en_cancel.gif" border=0 align="left" width="103" height="24" alt="Cancel and go back"></a>
		  </td>
  	</tr>
		<tr valign=top >
		  <td bgcolor=#cccccc>
  		  <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
        <tr>
          <td align="center">
            <table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
              <tr>
   	            <td>
	                <div class="copyright"></div>
	              </td>
              <tr>
            </table>
          </td>
        </tr>
        </table>
		  </td>
  	</tr>
	</tbody>
 </table>';
		echo '</table>';
		return TRUE;
	}
	//------------------------------------------------------------------------------

	function update_bill_element($bill_elem_number, $is_paid, $amount, $price, $description) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$this->sql="UPDATE care_tz_billing_elem SET
                `is_paid` = '".$is_paid."',
                `amount` = '".$amount."',
                `price` = '".$price."',
                `description` = '".$description."'
             WHERE `ID` = '".$bill_elem_number."'";
		$db->Execute($this->sql);
		return TRUE;
	}

	function update_bill_element_allpaid($billnr, $is_paid) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$this->sql="UPDATE care_tz_billing_elem SET
                `is_paid` = '".$is_paid."'
             WHERE `nr` = ".$billnr;
		$db->Execute($this->sql);
		return TRUE;
	}

	//------------------------------------------------------------------------------


	//------------------------------------------------------------------------------

	function delete_bill_element($bill_elem_number) {
		global $db;
		$debug=false;
		($debug) ? $db->debug=truE : $db->debug=FALSE;

		$this->sql="DELETE FROM care_tz_billing_elem
             WHERE `ID` = ".$bill_elem_number;
		$db->Execute($this->sql);
		return TRUE;
	}


	//------------------------------------------------------------------------------

	function DisplayArchivedBills($batch_nr, $specific_bill, $edit_fields)
	{
		global $db, $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj;
		global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
		$LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDRadTotal,$LDPrescTotal,$LDAdvanceTotal,$LDSumtopay,
		$LDInsuranceTotal,$LDSummary;

		if (func_num_args()>3)
		$printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
			*/
		global $db, $user_origin;

		echo '
	  	<table width="200"  border="0" align="center" class="table_content">';
		$billnumbers=$this->GetArchivedBill($specific_bill);
		if ($billnumbers)
		while($bills=$billnumbers->FetchRow())
		{

			$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);

			$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
			$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
			$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
			$used_budget = array_sum($matchingBills);
			$insurancebudget = $ceiling-$used_budget;

			if ($printout==FALSE) {
				//Java script for print out the bill
				// We have to place it here, because here is one place where we have the bill number what is
				// definetly displayed on the user-screen
				/*	echo '<script language="javascript" >
				<!--
				function printOut_'.$bills['nr'].'()
				{
				urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

				}
				// -->
				</script>
				';*/
			}
			echo '
  					<tr>
  						<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
			$this->DisplayBillHeadline($bills['nr'], $batch_nr);
			echo '
  						</font></span></span></td>
  					</tr>';
			$sum_to_pay =0;
			$sum = 0;

			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"laboratory");
			if($bill_elems_row=$billelems->FetchRow())
			{
				echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$total_laboratory = $this->DisplayArchivedLaboratoryBill($bills['nr'],$edit_fields);
				echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
			}
			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"radiology");
			if($bill_elems_row=$billelems->FetchRow())
			{
				echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$total_radiology = $this->DisplayArchivedRadiologyBill($bills['nr'],$edit_fields);
				echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
			}
			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"prescriptions");
                        if($bill_elems_row=$billelems->FetchRow())
                        {
                                echo '
                                        <tr>
                                                <td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
                                $total_prescription = $this->DisplayArchivedPrescriptionBill($bills['nr'],$edit_fields);
                                echo '
                                        </font></span></span></td>
                                </tr>';
                        }
			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"service");
                        if($bill_elems_row=$billelems->FetchRow())
                        {
                                echo '
                                        <tr>
                                                <td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
                                $total_service = $this->DisplayArchivedServicesBill($bills['nr'],$edit_fields);
                                echo '
                                        </font></span></span></td>
                                </tr>';
                        }
			$billelems=$this->GetElemsOfArchivedBill($bills['nr'],"other");
			if($bill_elems_row=$billelems->FetchRow())
			{
				echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$total_other = $this->DisplayArchivedOtherBill($bills['nr'],$edit_fields);
				echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
			}

			$billelems=$this->GetArchivedAdvanceBillElem($bills['nr']);
			if($bill_elems_row=$billelems->FetchRow())
			{
				echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$total_advance = $this->DisplayArchivedAdvanceBill($bills['nr'],$edit_fields);
				echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
			}

			if($insurancebudget<0)
			{
				echo '<tr><td><table border="0" ><tr><td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDInsurance.'</font></span></span></td><td><table  border="0" align="right"><tr>
	        				<td align="right" ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget+$used_budget),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDUsedBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($used_budget),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnBudget.'</font></span></span></td>
	        				<td colspan="2">
	        					<font color="FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget),2,'.',',').'</font></span></span></font>
	        				</td>
	        			  </tr>';
				$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
				if($contract['gets_company_credit'])
				{
					echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDCompanyCredit.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget*-1),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>';
				}
				else
				{
					echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnPayment.'</font></span></span></td>
	        				<td width="150"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDNoCompanyCredit.'</font></span></span></td><td>
	        					<i>'.number_format(($insurancebudget*-1),2,'.',',').'</font></span></span><br>
	        					----------</i>
	        				</td>
	        			  </tr><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
					$sum_to_pay += $insurancebudget*-1;

				}
				echo '</font></span></span></table></td></tr></td></tr></table>';
				echo '
	  	      		</td>
	  	      		</tr>';
			}
			$sum_to_pay += $total_laboratory;
			$sum_to_pay += $total_radiology;
			$sum_to_pay += $total_prescription;
			$sum_to_pay += $total_service;
            $sum_to_pay += $total_other;
			$sum_to_pay += $total_advance;

			echo '
				<tr>
					<td>
						<table  border="0" class="headline" align="right">
							<tr>
								<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$LDSummary.'</font></span></span></td>
								<td>
									<table border="0">
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDLabTotal.'
											</font></span></span></td>
											<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_laboratory),2,',',',').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDRadTotal.'
											</font></span></span></td>
											<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_radiology),2,',',',').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDPrescTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_prescription),2,',',',').'
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												Services Total
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_service),2,',',',').'
											</font></span></span></td>
										</tr>
										 <tr>
                                                                                        <td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
                                                                                                Others Total
                                                                                        </font></span></span></td>
                                                                                        <td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
                                                                                                '.number_format(($total_other),2,',',',').'
                                                                                        </font></span></span></td>
                                                                                </tr>

										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDAdvanceTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
												'.number_format(($total_advance),2,',',',').'
											</font></span></span></td>
										</tr>

										<tr>
											<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDInsuranceTotal.'
											</font></span></span></td>
											<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												';
			if($insurancebudget<0) echo number_format(($insurancebudget*-1),2,',',',');
			else echo '0,00';
			echo '
											</font></span></span></td>
										</tr>
										<tr>
											<td align="right">
												<b><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">'.$LDSumtopay.'</font></span></span></b>
											</td>
											<td><b><font color="#FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($sum_to_pay),2,',',',').'</font><br>
												=======</b>
											</font></span></span></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>';
		}
	}


	//------------------------------------------------------------------------------

	function DisplayBills($batch_nr, $specific_bill, $edit_fields) {
		global $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj, $sid; // $HTTP_SESSION_VARS;
		global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
		$LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDRadTotal,$LDPrescTotal,$LDRadTotal,$LDAdvanceTotal,$LDSumtopay,$insurance_used,
		$LDInsuranceTotal,$LDSummary,$LDNoPendingBills,$LDTranferPendingBillArchive,$LDDone;
	 $this->debug=false;
	 if (func_num_args()>3)
	 $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
			*/
		global $db,$user_origin;

		echo ($printout) ? '<table width="100%"  border="0">' : '<table width="600"  border="0" class="table_content">';
		if($specific_bill>0)
		{
			$billnumbers=$this->VerifyBill($specific_bill);
		}
		else
		{
			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
		}
		if ($billnumbers) {
			while($bills=$billnumbers->FetchRow())
			{

				$ALL_PAID_BY_INSURANCE=FALSE;
				$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);
				$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
				$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
				$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
				$used_budget = array_sum($matchingBills);
				$insurancebudget = $ceiling-$used_budget;
				$this->debug=FALSE;

				if ($this->debug) {
					echo "ceiling = $ceiling<br> ";
					echo "used_budget = $used_budget<br> ";
					echo "insurancebudget = $insurancebudget<br> ";
					print_r  ($matchingContract);
				}
				if (!is_array($matchingContract['Member']) && $matchingContract['company_id']>0) {
					if ($this->debug) echo "<br><b>there is no ceiling but insured</b><br>";
					$used_budget=0;
					$insurancebudget=1; // must be greater than 0 (workaround, see below)
					$ALL_PAID_BY_INSURANCE=TRUE;
				}

				if ($printout==FALSE) {
					//Java script for print out the bill
					// We have to place it here, because here is one place where we have the bill number what is
					// definetly displayed on the user-screen
					echo '<script language="javascript" >
				      <!--
				      function printOut_'.$bills['nr'].'()
				      {
				      	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=380,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }
				      function printOut1_'.$bills['nr'].'()
				      {
				      	urlholder="show_company_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=380,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }

				      // -->
				      </script>
				      ';
				}
				echo '
  					<tr>
  						<td><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$this->DisplayBillHeadline($bills['nr'], $batch_nr, $printout);
				echo '
  						</font></span></span></td>
  					</tr>';
				$sum_to_pay = 0;
				$sum = 0;

				$billelems=$this->GetElemsOfBill($bills['nr'],"labtest");
				if($billelems)
				{
					$bill_elems_row=$billelems->FetchRow();
					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
					$total_laboratory = $this->DisplayLaboratoryBill($bills['nr'],$edit_fields, $printout);
					echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
				}

				$billelems=$this->GetElemsOfBill($bills['nr'],"xray");
				if($billelems)
				{
					$bill_elems_row=$billelems->FetchRow();
					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
					$total_radiology = $this->DisplayRadiologyBill($bills['nr'],$edit_fields, $printout);
					echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
				}
				$billelems=$this->GetElemsOfBill($bills['nr'],"drug_list");
				if($billelems)
				{
					$bill_elems_row=$billelems->FetchRow();
					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
					$total_prescription = $this->DisplayPrescriptionBill($bills['nr'],$edit_fields, $printout);
					echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
				}
				$billelems=$this->GetElemsOfBill($bills['nr'],"service");
				if($billelems)
				{
					$bill_elems_row=$billelems->FetchRow();
					echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
					$total_services = $this->DisplayServicesBill($bills['nr'],$edit_fields, $printout);
					echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
				}

				$billelems=$this->GetElemsOfBill($bills['nr'],"other");
				if($bill_elems_row=$billelems->FetchRow())
				{
				echo '
	  	  			<tr>
	  	  				<td valign="top"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">';
				$total_other = $this->DisplayOtherBill($bills['nr'],$edit_fields, $printout);
				echo '
		  	      		</font></span></span></td>
		  	      	</tr>';
				}

				$billelems=$this->GetAdvanceBillElem($bills['nr']);
				if($billelems)
				{

				$bill_elems_row=$billelems->FetchRow();
				echo '
					<tr>
						<td valign="top"><span class=SpellE><span style="font-family;&quot;20 cpi&quot;"<font size=-1>';
				$total_advance = $this->DisplayAdvanceBillItem($bills['nr'],$edit_fields, $printout);
				echo '
						</font></span></span></td>
					</tr>';
				}

				if($insurancebudget<0) 	{
					echo '<tr><td><table border="1" ><tr><td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDInsurance.'</font></span></span></td>
	        				<td align="right" ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget+$used_budget),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>

	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOldBudget.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($used_budget),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>
	        			  <tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnBudget.'</font></span></span></td>
	        				<td colspan="2">
	        					<font color="FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget),2,'.',',').'</font></span></span></font>
	        				</td>
	        			  </tr>';
					$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
					if($contract['gets_company_credit'])
					{
						echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDCompanyCredit.'</font></span></span></td>
	        				<td colspan="2"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">
	        					'.number_format(($insurancebudget*-1),2,'.',',').'
	        				</font></span></span></td>
	        			  </tr>';
					}
					else
					{
						echo '<tr>
	        				<td align="right"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDOverdrawnPayment.'</font></span></span></td>
	        				<td ><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.$LDNoCompanyCredit.'</font></span></span></td><td>
	        					<i><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="-1">'.number_format(($insurancebudget*-1),2,'.',',').'<br>
	        					----------</i>
	        				</font></span></span></td>
	        			  </tr>';
						$sum_to_pay += $insurancebudget*-1;

					}
					//echo '</table></td></tr></td></tr></table>';

					echo '</table></td></tr>';
				}


				$sum_to_pay += $total_laboratory;
				$sum_to_pay += $total_prescription;
				$sum_to_pay += $total_radiology;
				$sum_to_pay += $total_services;
				$sum_to_pay += $total_other;
				$sum_to_pay += $total_advance;

				echo '
				<tr>
					<td>';

				echo ($printout) ? '<table  width="100%" border="0">' : '<table width="600" border="0" class="table_content">';

						echo '<tr>
								<td colspan="2"><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDSummary.'</font></span></span>
								</td>
							  </tr>

										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDLabTotal.'
											</font></span></span></td>

											<td  style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($total_laboratory),2,'.',',').'
											</font></span></span></td>
										</tr>

										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDRadTotal.'
											</font></span></span></td>
											<td  style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($total_radiology),2,'.',',').'
											</font></span></span></td>
										</tr>

										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDPrescTotal.'
											</font></span></span></td>
											<td style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($total_prescription),2,'.',',').'
											</font></span></span></td>
										</tr>

										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												Services Total
											</font></span></span></td>
											<td style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($total_services),2,'.',',').'
											</font></span></span></td>
										</tr>

										 <tr>
                                                                                        <td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
                                                                                                Others
                                                                                        </font></span></span></td>
                                                                                        <td style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
                                                                                                '.number_format(($total_other),2,'.',',').'
                                                                                        </font></span></span></td>
                                                                                </tr>
										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDAdvanceTotal.'
											</font></span></span></td>
											<td style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.number_format(($total_advance),2,'.',',').'
											</font></span></span><br>------------</td>

										</tr>

										<tr>
											<td align="left"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												'.$LDInsuranceTotal.'
											</font></span></span></td>
											<td style="text-align:right;"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="3">
												';
				if($insurancebudget<0)
				echo number_format(($insurancebudget*-1),2,'.',',');
				elseif ($ALL_PAID_BY_INSURANCE)
				echo number_format((($total_laboratory+$total_prescription+$total_radiology+$total_services+$total_other+$total_advance)*-1),2,'.',',');
				else echo '0,00';
					echo '
											</font></span></span></td>
										</tr>

										<tr>
											<td align="left">
												<span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">'.$LDSumtopay.'</b>
											</font></span></span></td>
											<td style="text-align:right;"><font color="#FF0000"><span class=SpellE><span style="font-family:&quot;20 cpi&quot;"><font size="4">
												'.number_format(($sum_to_pay),2,'.',',').'</font></span></span></font><br>
												=======</b>
											</td>
										</tr>

									</table>

								</td>
							</tr>';

				// is there the edit_fields flag set, then there should be finished the formular with the submit button.
				// If not, then show the three kinds of the main folder.
				echo '
	  			    <tr>
	  			  		<td>';
				$show_printout_button = TRUE;
				$show_done_button=TRUE;
				$show_edit_button=TRUE;
				$enc_obj = New Encounter;
				$encounter_nr = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
				if ($printout==FALSE)
				{
					if ($show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()" align=""><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="" alt="Print this form"></a> ';
					if ($show_printout_button) echo '<a href="javascript:printOut1_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_companybill.gif" border=0 align="" ></a> ';
				}
				echo '</td>
	  			  	</tr>';
				if ($printout==FALSE)
				{
					echo '<tr><td align="right">';
					if ($edit_fields) echo '<img src="../../gui/img/common/default/achtung.gif"><font size="4">'.$LDTranferPendingBillArchive.'</font><a href="billing_tz_pending.php?&mode=done&user_origin='.$user_origin.'&patient='.$_REQUEST['patient'].'&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 width="75" height="24" alt="'.$LDDone.'"></a><img src="../../gui/img/common/default/achtung.gif">';
					if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="" width="120" height="24"></a>';
	 					echo '</td></tr>';

				}
			}
		}
		else
		{
			echo '<br><br><tr><td><div align="center"><h1>'.$LDNoPendingBills.'</h1><div></td></tr>';
		}
		echo'

	  	</table>';

		//if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}

	//------------------------------------------------------------------------------


	function DisplayCompanyBills($batch_nr, $specific_bill, $edit_fields) {
		global $insurancebudget, $used_budget, $ceiling, $insurance_tz, $bill_obj;
		global $LDInsurance,$LDOldBudget,$LDUsedBudget,$LDOverdrawnBudget,$LDOverdrawnPayment,
		$LDNoCompanyCredit,$LDCompanyCredit,$LDLabTotal,$LDRadTotal,$LDPrescTotal,$LDSumtopay,
		$LDInsuranceTotal,$LDSummary,$LDNoPendingBills,$LDTranferPendingBillArchive,$LDDone;
	 $this->debug=FALSE;
	 if (func_num_args()>3)
	 $printout=func_get_arg (3);
		/*
			This function displays a complete table containing the bill(s) of a batch_nr
			$specific_bill = 0 -> Show all bills for this batch_nr
			$specifig_bill != 0 -> Shows only bill[specific_bill]
			$edif_fields = 0 -> (default)
			$edit_fields != 0 -> All values editable
			*/
		global $db, $user_origin;

		echo '
	  	<table width="325" border="1">';
		if($specific_bill>0)
		{
			$billnumbers=$this->VerifyBill($specific_bill);
		}
		else
		{
			$billnumbers=$this->GetBillNumbersFromPID($batch_nr);
		}
		if ($billnumbers) {
			while($bills=$billnumbers->FetchRow())
			{

				$ALL_PAID_BY_INSURANCE=FALSE;
				$bill_timestamp = $bill_obj->GetBillTimestamp($bills['nr']);
				$matchingContract = $insurance_tz->GetContractMemberFromTimestamp($batch_nr,$bill_timestamp);
				$matchingBills = $bill_obj->GetBillCostSummaryInTimeframe($batch_nr, $matchingContract['start_date'], $bill_timestamp);
				$ceiling = $matchingContract['Member']['ceiling']-$matchingContract['Member']['ceiling_startup_subtraction'];
				$used_budget = array_sum($matchingBills);
				$insurancebudget = $ceiling-$used_budget;
				$this->debug=FALSE;

				if ($this->debug) {
					echo "ceiling = $ceuling<br> ";
					echo "used_budget = $used_budget<br> ";
					echo "insurancebudget = $insurancebudget<br> ";
					print_r  ($matchingContract);
				}
				if (!is_array($matchingContract['Member']) && $matchingContract['company_id']>0) {
					if ($this->debug) echo "<br><b>there is no ceiling but insured</b><br>";
					$used_budget=0;
					$insurancebudget=1; // must be greater than 0 (workaround, see below)
					$ALL_PAID_BY_INSURANCE=TRUE;
				}

				if ($printout==FALSE) {
					//Java script for print out the bill
					// We have to place it here, because here is one place where we have the bill number what is
					// definetly displayed on the user-screen
					echo '<script language="javascript" >
				      <!--
				      function printOut_'.$bills['nr'].'()
				      {
				      	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }
				      function printOut1_'.$bills['nr'].'()
				      {
				      	urlholder="show_bill.php?bill_number='.$bills['nr'].'&batch_nr='.$batch_nr.'&printout=TRUE";
				      	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");

				      }

				      // -->
				      </script>
				      ';
				}
				echo '
  					<tr>
  						<td>';
				$this->DisplayBillHeadline($bills['nr'], $batch_nr);
				echo '
  						</td>
  					</tr>';
				$sum_to_pay =0;
				$sum = 0;

				$billelems=$this->GetElemsOfBill($bills['nr'],"labtest");
				if($bill_elems_row=$billelems->FetchRow())
				{

					echo '
	  	  			<tr>
	  	  				<td valign="top">';
					$total_laboratory = $this->DisplayCompanyLaboratoryBill($bills['nr'],$edit_fields);
					echo '
		  	      		</td>
		  	      	</tr>';
				}
				$billelems=$this->GetElemsOfBill($bills['nr'],"drug_list");
				if($bill_elems_row=$billelems->FetchRow())
				{
					echo '
	  	  			<tr>
	  	  				<td valign="top">';
					$total_prescription = $this->DisplayCompanyPrescriptionBill($bills['nr'],$edit_fields);
					echo '
		  	      		</td>
		  	      	</tr>';
				}
			$billelems=$this->GetElemsOfBill($bills['nr'],"xray");
				if($bill_elems_row=$billelems->FetchRow())
				{
					echo '
	  	  			<tr>
	  	  				<td valign="top">';
					$total_radiology = $this->DisplayCompanyRadiologyBill($bills['nr'],$edit_fields);
					echo '
		  	      		</td>
		  	      	</tr>';
				}
				if($insurancebudget<0) 	{
					echo '<tr><td><table border="1" width="200"><tr><td width="105">#'.$LDInsurance.'</td><td><table width="200" border="0" align="right"><tr>
	        				<td align="right" width="408">'.$LDOldBudget.'</td>
	        				<td colspan="2">
	        					'.number_format(($insurancebudget+$used_budget),2,'.',',').'
	        				</td>
	        			  </tr>
	        			  <tr>
	        				<td align="right">'.$LDOldBudget.'</td>
	        				<td colspan="2">
	        					'.number_format(($used_budget),2,'.',',').'
	        				</td>
	        			  </tr>
	        			  <tr>
	        				<td align="right">'.$LDOverdrawnBudget.'</td>
	        				<td colspan="2">
	        					<font color="FF0000">'.number_format(($insurancebudget),2,'.',',').'</font>
	        				</td>
	        			  </tr>';
					$contract = $insurance_tz->CheckForValidContract($batch_nr,0,$insurance_tz->GetCompanyFromPID($batch_nr));
					if($contract['gets_company_credit'])
					{
						echo '<tr>
	        				<td align="right">'.$LDCompanyCredit.'</td>
	        				<td colspan="2">
	        					'.number_format(($insurancebudget*-1),2,'.',',').'
	        				</td>
	        			  </tr>';
					}
					else
					{
						echo '<tr>
	        				<td align="right">'.$LDOverdrawnPayment.'</td>
	        				<td width="150">'.$LDNoCompanyCredit.'</td><td>
	        					<i>'.number_format(($insurancebudget*-1),2,'.',',').'<br>
	        					----------</i>
	        				</td>
	        			  </tr>';
						$sum_to_pay += $insurancebudget*-1;

					}
					echo '</table></td></tr></td></tr></table>';
					echo '
	  	      		</td>
	  	      		</tr>';
				}


				$sum_to_pay += $total_laboratory;
				$sum_to_pay += $total_prescription;
				$sum_to_pay += $total_radiology;
				$sum_to_pay += $total_service;
				$sum_to_pay += $total_other;

				/*if($total_prescription==0)
				 {
				 echo '<table border="2">

				 <tr><td>Service(TSH)</td><td>'.number_format(($service_amt),2,'.',',').'</td></tr>
				 <tr><td>Labs(TSH)</td><td>'.number_format(($total_laboratory),2,'.',',').'</td></tr>
				 <tr><td>X-Ray(TSH)</td><td>'.number_format(($xray_amt),2,'.',',').'</td></tr>
				 <tr><td>Dawa(TSH)</td><td>'.number_format(($drug_amt),2,'.',',').'</td></tr>
				 <tr><td>Proc/Surg(TSH)</td><td>'.number_format(($surgery_amt),2,'.',',').'</td></tr>
				 <tr><td>Dress(TSH)</td><td>'.number_format(($dress_amt),2,'.',',').'</td></tr>
				 <tr><td>Dental(TSH)</td><td>'.number_format(($dental_amt),2,'.',',').'</td></tr>
				 <tr><td>Others(TSH)</td><td>'.number_format(($others_amt),2,'.',',').'</td></tr>
				 <tr><td>Total(TSH)</td><td>'.number_format(($total_laboratory),2,'.',',').'</td></tr>

				 <tr>

				 </tr>

				 </table>';
				 } */

				echo '
				<tr>
					<td>
						<!--<table width="200" border="1">
							<tr>
								<td width="100">'.$LDSummary.'</td>
								<td>
									<table border="0" width="200">
										<tr>
											<td align="right">
												'.$LDLabTotal.'
											</td>
											<td width="105">
												'.number_format(($total_laboratory),2,',',',').'
											</td>
										</tr>
										<tr>
											<td align="right">
												'.$LDRadTotal.'
											</td>
											<td width="105">
												'.number_format(($total_radiology),2,',',',').'
											</td>
										</tr>
										<tr>
											<td align="right">
												'.$LDPrescTotal.'
											</td>
											<td>
												'.number_format(($total_prescription),2,'.',',').'
											</td>
										</tr>
										<tr>
											<td align="right">
												'.$LDInsuranceTotal.'
											</td>
											<td>
												';
				if($insurancebudget<0)
				echo number_format(($insurancebudget*-1),2,'.',',');
				elseif ($ALL_PAID_BY_INSURANCE)
				echo number_format((($total_laboratory+$total_prescription+$total_radiology)*-1),2,'.',',');
				else echo '0,00';
				echo '
											</td>
										</tr>
										<tr>
											<td align="right">
												<b>'.$LDSumtopay.'</b>
											</td>
											<td><b><font color="#FF0000">
												'.number_format(($sum_to_pay),2,'.',',').'</font><br>
												=======</b>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>-->
					</td>
						<tr><td><font size="4">Patient Sign:.........................</font></td></tr>
				</tr>';
				// is there the edit_fields flag set, then there should be finished the formular with the submit button.
				// If not, then show the three kinds of the main folder.
				echo '
	  			    <tr>
	  			  		<td>';
				$show_printout_button = FALSE;
				$show_done_button=FALSE;
				$show_edit_button=FALSE;
				$enc_obj = New Encounter;
				$encounter_nr = $enc_obj->GetEncounterFromBatchNumber($batch_nr);
				if ($printout==FALSE)
				{
					if (!$show_printout_button) echo '<a href="javascript:printOut_'.$bills['nr'].'()"><img src="../../gui/img/control/default/en/en_printout.gif" border=0 align="absmiddle" width="99" height="24" alt="Print this form"></a> ';
					if (!$show_printout_button) echo '<input type="button" value="CompanyBill" onclick="javascript:printOut1_'.$bills['nr'].'()">';
					if ($edit_fields) echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif"> &nbsp;&nbsp;&nbsp; '.$LDTranferPendingBillArchive.' <a href="billing_tz_pending.php?&mode=done&user_origin='.$user_origin.'&bill_number='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_done.gif" border=0 align="absmiddle" width="75" height="24" alt="'.$LDDone.'"></a>&nbsp;&nbsp;&nbsp;<img src="../../gui/img/common/default/achtung.gif">';
					if (!$edit_fields) echo '<a href="billing_tz_edit.php?batch_nr='.$batch_nr.'&billnr='.$bills['nr'].'"><img src="../../gui/img/control/default/en/en_auswahl2.gif" border=0 align="absmiddle" width="120" height="24"></a>';
				}
				echo '</td>
	  			  	</tr>';
			}
		}
		else
		{
			echo '<br><br><tr><td><div align="center"><h1>'.$LDNoPendingBills.'</h1><div></td></tr>';
		}
		echo'

	  	</table>';
		//if($edit_fields) echo '<form method=post action="#" name="edit_bill">';
	}

	//------------------------------------------------------------------------------






	function ArchiveBill($bill_number) {
		global $db;
		global $user_id,$sid,$local_user;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::ArchiveBill($bill_number)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$this->sql = "INSERT INTO care_tz_billing_archive
                      (`nr`,`encounter_nr`, `first_date`, `create_id`)
                  SELECT `nr`, `encounter_nr`, `first_date`, `create_id` FROM care_tz_billing WHERE `nr`=".$bill_number;
		$this->result=$db->Execute($this->sql);

		if ($db->Insert_ID())
		$CARE_TZ_BILLING_ARCHIVED=TRUE;

		$this->sql = "INSERT INTO care_tz_billing_archive_elem
                      (`nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `days`, `times_per_day`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr`, `User_Id`)
                  SELECT `nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, 1, `amount`, `days`, `times_per_day`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr`,`User_Id` FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
		$this->result=$db->Execute($this->sql);

		if ($db->Insert_ID())
		$CARE_TZ_BILLING_ELEM_ARCHIVED=TRUE;


		//$user_id=$_SESSION['sess_user_name'];


		//$this->sql = "UPDATE care_tz_billing_archive_elem SET user_id='$user_id' WHERE nr=".$bill_number;
		//$db->Execute($this->sql);


		if ($CARE_TZ_BILLING_ARCHIVED && $CARE_TZ_BILLING_ELEM_ARCHIVED) {
			$this->sql = "UPDATE care_encounter_prescription SET bill_status='archived' WHERE bill_number=".$bill_number;
			$db->Execute($this->sql);
			$this->sql = "UPDATE $this->tbl_lab_requests SET bill_status='archived' WHERE bill_number=".$bill_number;
			$db->Execute($this->sql);
			$this->DeleteBillFromPendingList($bill_number);
			return TRUE;
		}
		return FALSE;
	}

	function DeleteBillFromPendingList($bill_number) {
		global $db;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::DeleteBillFromPendingList($bill_number)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql = "DELETE FROM care_tz_billing WHERE `nr`=".$bill_number;
		$db->Execute($this->sql);
		$this->sql = "DELETE FROM care_tz_billing_elem WHERE `nr`=".$bill_number;
		$db->Execute($this->sql);
		return TRUE;
	}

	function DeleteBillAdvanceItemsFromPendingList($bill_number) {
		global $db;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::DeleteBillAdvanceItemsFromPendingList($bill_number)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql = "DELETE FROM care_tz_billing_elem WHERE `description`!='Advance' AND `nr`=".$bill_number;
		$db->Execute($this->sql);
		return TRUE;
	}


function TransferBillItemsWithAdvance($bill_number) {
		global $db;
		global $user_id,$sid,$local_user;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::TransferBillItemsWithAdvance($bill_number)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;


		$this->sql = "INSERT INTO care_tz_billing_elem_advance
                      (`nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, `is_paid`, `amount`, `days`, `times_per_day`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr`, `User_Id`)
                  SELECT `nr`,`date_change`, `is_labtest`, `is_medicine`, `is_comment`, 1, `amount`, `days`, `times_per_day`, `price`, `balanced_insurance`, `insurance_id`, `description`, `item_number`, `prescriptions_nr`,`User_Id` FROM care_tz_billing_elem WHERE `description`!='Advance' AND `nr`=".$bill_number;
		$this->result=$db->Execute($this->sql);

		if ($db->Insert_ID())
		$CARE_TZ_BILLING_ELEM_ADVANCE=TRUE;


		if ($CARE_TZ_BILLING_ELEM_ADVANCE) {
	$this->DeleteBillAdvanceItemsFromPendingList($bill_number);
			return TRUE;
		}
		return FALSE;
	}

	function GetQuotationStatus($in_outpatient)
	{
		if($in_outpatient == 'inpatient')
		{
			return "AND care_encounter.encounter_class_nr = 1";
		}
		else if($in_outpatient == 'outpatient' )
		{
			return "AND care_encounter.encounter_class_nr = 2 AND care_encounter.current_dept_nr !=42 AND care_encounter.current_dept_nr !=43";
		}
		else if($in_outpatient == 'artndental' )
                {
                        return "AND care_encounter.encounter_class_nr = 2 AND (care_encounter.current_dept_nr = 42 OR care_encounter.current_dept_nr = 43)";
                }
		else
		{
			return "";
		}
	}

		//------------------------------------------------------------------------------


	function GetWhereQuotationStatus($in_outpatient)
	{
		if($in_outpatient == 'inpatient')
		{
			return "WHERE  quotation_temporary.encounter_class_nr = 1";
		}
		else if($in_outpatient == 'outpatient' )
		{
			return "WHERE quotation_temporary.encounter_class_nr = 2";
		}
		else if($in_outpatient == 'art' )
                {
                        return "WHERE quotation_temporary.current_dept_nr = 42";
                }
		else
		{
			return "";
		}
	}



		//------------------------------------------------------------------------------

	function getTables ()
	{

		Global $db;

	$this->sql = "SELECT   	care_encounter_prescription.*, " .
				"				care_test_request_chemlabor.*, " .
				"				care_test_request_chemlabor_sub.*, " .
				"				care_test_request_radio.*, " .
				"				WHERE $this->$tbl_prescriptions.encounter_nr=$encounter_nr
								OR $this->$tbl_lab_requests.encounter_nr=$encounter_nr
								OR $this->$tbl_rad_requests.encounter_nr=$encounter_nr";

		if ($this->debug) echo $this->sql;
		$this->result = $db->Execute($this->sql);
		if ($this->debug) echo $this->result;
		if ($result) $row=$result->FetchRow();

		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotations()</b><br>";

		if ($row['prescribe_date']) {
			$tbl = $tbl_prescriptions;
			$which_number = $row['article_item_number'];
			$which_date = $row['prescribe_date'];
		}
		if ($row['test_date']) {
			$tbl = $tbl_lab_requests;
			$which_number = $this->$getItemIdByParamName($this->$getNameOfLAboratoryByID(care_test_request_chemlabor_sub.sub_id));
			$which_date = $row['test_date'];
		}
		if ($row['send_date']) {
			$tbl = $tbl_rad_requests;
			$which_number = $row['test_request'];
			$which_date = $row['send_date'];
		}

		Return true;
	}

	//------------------------------------------------------------------------------

	function getBillables($encounter_nr,$in_outpatient) {

		Global $db;

		$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

		$this->debug=TRUE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::getBillables()</b><br>";

		if($encounter_nr>0)
		$where_encounter='encounter_nr= '.$encounter_nr;
		else
		{
			$where_encounter='GROUP BY $encounter_nr, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
			$anzahl= 'count(*) AS anzahl,';

		}
		if(!$_REQUEST['sort'])
		{
		$this->sql = "SELECT COUNT(*), encounter_nr, modify_time, status, care_encounter.pid, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
								FROM care_encounter_prescription, " .
				"				care_test_request_chemlabor, " .
				"				care_encounter_op, " .
				"				care_encounter_services, " .
				"				care_test_request_radio, " .
				"				care_encounter " .
				"				INNER JOIN care_person On care_person.pid=care_encounter.pid
								WHERE encounter_nr=$encounter_nr
								AND bill_number= 0 $and_in_outpatient
								AND isnull(is_disabled)
								OR is_disabled=''
								$where_encounter
								ORDER BY modify_date DESC , $encounter_nr ASC";

		}
		else
		{
			$this->sql = "SELECT COUNT(*), encounter_nr, modify_time, status, care_encounter.pid, care_encounter.pid, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
								FROM care_encounter_prescription, " .
				"				care_test_request_chemlabor, " .
				"				care_encounter_op, " .
				"				care_encounter_services, " .
				"				care_test_request_radio, " .
				"				care_encounter " .
				"				INNER JOIN care_person On care_person.pid=care_encounter.pid
								WHERE encounter_nr=$encounter_nr
								AND bill_number= 0 $and_in_outpatient
								AND isnull(is_disabled)
								OR is_disabled=''
								$where_encounter
								order by $_REQUEST[sort] $_REQUEST[sorttyp]";
		}
		if ($this->debug) echo $this->sql;
		$this->request = $db->Execute($this->sql);
		if ($this->debug) echo $this->request;
		return $this->request;
	}

/*
		$Billables = New array_billables();
		$Billables = $all_lab_rad_services=$dia_obj->bles();
		$Billables .= $all_meds=$prescription_obj->getBillables();
		//$Billables .= $all_procedures=$proced_obj->getBillables();
		$Billables .= $all_ops=$op_obj->getBillables();
		$Billables .= $all_obstetric=$OB_obj->getBillables();
		$Billables .= $all_services=$svc_obj->getBillables();
*/

	//------------------------------------------------------------------------------

	function CreateTmpTableOfElementsToQuote($encounter_nr,$in_outpatient) {
		global $db, $tbl;
		/**
		 * Returns all new prescriptions in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */

		$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);
/*		$all_lab_rad_services=$dia_obj->getBillables();
		$all_meds=$prescription_obj->getBillables();
		$all_procedures=$proced_obj->getBillables();
		$all_ops=$op_obj->getBillables();
		$all_obstetric=$OB_obj->getBillables();
		$all_services=$svc_obj->getBillables();
		$quotations=$this->getBillables();
*/
		$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::CreateTmpTableOfElementsToQuote()</b><br>";

		if($encounter_nr>0) {
			$where_encounter='(CASE encounter_nr= '.$encounter_nr.'; encounter_nr= '.$encounter_nr.'; encounter_nr= '.$encounter_nr.' END)';
		} else {
			$where_encounter='GROUP BY pid, selian_pid, name_first, name_last, date_birth';
		}
		//todo: change it to the sort mechanism again!
		//if(!$_REQUEST['sort'])
		//{

		$this->sql="DROP TEMPORARY TABLE IF EXISTS quotation_temporary ";
		$db->execute($this->sql);

		$this->sql = "CREATE TEMPORARY TABLE quotation_temporary SELECT
				care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_person.insurance_ID
				, 	care_encounter.encounter_date
				,       care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				, 	CASE WHEN isnull(care_tz_drugsandservices.item_description)=1 THEN 'not available' ELSE care_tz_drugsandservices.item_description END as article
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price END as unit_price
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_1)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_1 END as unit_price_1
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_2)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_2 END as unit_price_2
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_3)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_3 END as unit_price_3
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_4)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_3 END as unit_price_4
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_5)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_3 END as unit_price_5
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_6)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_3 END as unit_price_6
				, 	CASE WHEN isnull(care_tz_drugsandservices.purchasing_class)=1 THEN 'not available' ELSE care_tz_drugsandservices.purchasing_class END as purchasing_class
				,	care_encounter.encounter_nr
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_test_request_chemlabor
				ON care_test_request_chemlabor.encounter_nr=care_encounter.encounter_nr
			INNER JOIN care_test_request_chemlabor_sub
				ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_chemlabor_sub.item_id=care_tz_drugsandservices.item_id

			WHERE care_test_request_chemlabor_sub.bill_number = 0 $and_in_outpatient
				 AND     (isnull(care_test_request_chemlabor_sub.is_disabled) OR care_test_request_chemlabor_sub.is_disabled='')

			UNION

			SELECT
                                care_person.pid
                                ,       care_person.selian_pid
                                ,       care_person.name_first
                                ,       care_person.name_last
                                ,       care_person.date_birth
				, 	care_person.insurance_ID
                                ,       care_encounter.encounter_date
				,       care_encounter.encounter_class_nr
                                ,       care_encounter.current_dept_nr
                                ,       care_encounter.current_ward_nr
 				,       care_tz_drugsandservices.item_description
                                ,       care_tz_drugsandservices.unit_price
                                ,       care_tz_drugsandservices.unit_price_1
                                ,       care_tz_drugsandservices.unit_price_2
                                ,       care_tz_drugsandservices.unit_price_3
                                ,       care_tz_drugsandservices.unit_price_4
                                ,       care_tz_drugsandservices.unit_price_5
                                ,       care_tz_drugsandservices.unit_price_6
                                ,       care_tz_drugsandservices.purchasing_class
                                ,       care_encounter.encounter_nr
		 FROM care_person

                        INNER JOIN care_encounter
                                ON care_encounter.pid=care_person.pid
                        INNER JOIN care_test_request_radio
 				ON care_test_request_radio.encounter_nr = care_encounter.encounter_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_radio.test_request = care_tz_drugsandservices.item_id


			WHERE care_test_request_radio.bill_number = 0 $and_in_outpatient
				 AND     (isnull(care_test_request_radio.is_disabled) OR care_test_request_radio.is_disabled='')

			UNION

			SELECT
					care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_person.insurance_ID
				, 	care_encounter.encounter_date
				,       care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				, 	care_encounter_prescription.article
				, 	care_tz_drugsandservices.unit_price
				, 	care_tz_drugsandservices.unit_price_1
				, 	care_tz_drugsandservices.unit_price_2
				, 	care_tz_drugsandservices.unit_price_3
				, 	care_tz_drugsandservices.unit_price_4
				, 	care_tz_drugsandservices.unit_price_5
				, 	care_tz_drugsandservices.unit_price_6
				, 	care_tz_drugsandservices.purchasing_class
				,	care_encounter.encounter_nr
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_encounter_prescription
				ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
			INNER JOIN care_tz_drugsandservices
			ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id

			WHERE
					care_encounter_prescription.bill_number = 0 $and_in_outpatient

				AND	care_tz_drugsandservices.purchasing_class != 'labtest'

				AND     care_tz_drugsandservices.purchasing_class != 'xray'

				AND 	(isnull(care_encounter_prescription.is_disabled) OR care_encounter_prescription.is_disabled='')
			";

		if ($this->request = $db->Execute($this->sql))
			return TRUE;
		else
			return FALSE;

	}

	function GetNewQuotationOverview () {
		global $db, $tbl;

		 $this->debug=FALSE;
                ($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
                if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotationOverview()</b><br>";


		$this->sql="SELECT
						count(*) as anzahl, encounter_nr,current_dept_nr, current_ward_nr, pid, selian_pid, name_first, name_last,
date_birth, encounter_date , encounter_class_nr, insurance_ID

					FROM quotation_temporary

					GROUP BY pid, selian_pid, name_first, name_last, date_birth, encounter_date order by encounter_date DESC";

		if ($this->debug) echo $this->sql;

                $this->request = $db->Execute($this->sql);
                if ($this->debug) echo $this->request;
                return $this->request;

	}

	//------------------------------------------------------------------------------

	function GetNewQuotations($encounter_nr, $in_outpatients) {
		echo "lets do it";
		global $db, $tbl;
		$db->debug=FALSE;
		$this->sql="SELECT
						count(*) as anzahl, encounter_nr,pid, selian_pid, name_first, name_last, date_birth, encounter_date
					FROM quotation_temporary
					GROUP BY pid, selian_pid, name_first, name_last, date_birth, encounter_date ";
		$db->Execute($this->sql);
		$this->request = $db->Execute($this->sql);
		return $this->request;
	}

	//------------------------------------------------------------------------------

	function GetNewQuotation_Prescriptions($encounter_nr,$in_outpatient, $id_array) {
		global $db;
		/**
		 * Returns all new prescriptions in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */

		$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

		$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Prescriptions()</b><br>";

		if($encounter_nr>0)
		$where_encounter='AND care_encounter_prescription.encounter_nr = '.$encounter_nr;
		else
		{
			$where_encounter='GROUP BY care_encounter_prescription.encounter_nr, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
			$anzahl= 'count(*) AS anzahl,';
		}

		if(!$_REQUEST['sort'])
		{
			$this->sql = "SELECT $anzahl  	care_encounter_prescription.*, " .
	    		"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
				"							care_encounter.encounter_date," .
				"							care_encounter.current_dept_nr," .
				"							care_encounter.current_ward_nr," .
				"							care_encounter_prescription.article," .
				"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
	    		"							care_tz_drugsandservices.unit_price_4," .
	    		"							care_tz_drugsandservices.unit_price_5," .
	    		"							care_tz_drugsandservices.unit_price_6," .
				"							care_tz_drugsandservices.purchasing_class" .
	    		"							from care_encounter_prescription
			INNER JOIN care_encounter ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
			INNER JOIN care_person On care_person.pid=care_encounter.pid
			INNER JOIN care_tz_drugsandservices ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id
			WHERE care_encounter_prescription.bill_number = 0
			AND care_tz_drugsandservices.purchasing_class != 'labtest'
			AND care_tz_drugsandservices.purchasing_class != 'xray' 	$and_in_outpatient
			AND (isnull(care_encounter_prescription.is_disabled)
			OR care_encounter_prescription.is_disabled='')
			$where_encounter
			ORDER BY care_encounter_prescription.prescribe_date DESC , care_encounter_prescription.encounter_nr ASC";

			//echo $this->sql;
		}
		else
		{
			$this->sql = "SELECT $anzahl  		care_encounter_prescription.*, " .
	    		"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
				"							care_encounter.encounter_date," .
				"							care_encounter.current_dept_nr," .
				"							care_encounter.current_ward_nr," .
				"							care_encounter_prescription.article," .
				"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
				"							care_tz_drugsandservices.purchasing_class" .
	    		"							from care_encounter_prescription
			INNER JOIN care_encounter_prescription ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
			INNER JOIN care_person On care_person.pid=care_encounter.pid
			INNER JOIN care_tz_drugsandservices ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id
			WHERE care_encounter_prescription.bill_number = 0
			AND care_tz_drugsandservices.purchasing_class != 'labtest'
			AND care_tz_drugsandservices.purchasing_class != 'xray'         $and_in_outpatient
			AND (isnull(care_encounter_prescription.is_disabled)
			OR care_encounter_prescription.is_disabled='')
			$where_encounter
			order by $_REQUEST[sort] $_REQUEST[sorttyp]";
		}

//echo $this->sql;

		//if ($this->debug) echo $this->sql;

		$this->request = $db->Execute($this->sql);
		if ($this->debug) echo $this->request;
		return $this->request;

	}

	//------------------------------------------------------------------------------
	function GetNewQuotation_Radiology($encounter_nr, $in_outpatient, &$id_array) {
		global $db;
		/**
		 * Returns all new prescriptions in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */

		$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

		$this->debug=false;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Radiology()</b><br>";


		if($encounter_nr>0)
		$where_encounter='AND care_test_request_radio.encounter_nr = '.$encounter_nr;
		else
		{
			$where_encounter='GROUP BY care_test_request_radio.encounter_nr, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
			$anzahl= 'count(*) AS anzahl_rad,';
		}


		if(!$_REQUEST['sort'])
		{
			$this->sql = "SELECT $anzahl  	care_test_request_radio.*, " .
			"                                                       care_test_request_radio.number_of_tests as dosage, " .
	    		"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
			"							care_encounter.encounter_date," .
			"                                                       care_tz_drugsandservices.item_id," .
			"                                                       care_tz_drugsandservices.item_description," .
	    		"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
			"							care_tz_drugsandservices.purchasing_class" .
	    		"							from care_test_request_radio

			INNER JOIN care_encounter
			ON care_encounter.encounter_nr=care_test_request_radio.encounter_nr
			INNER JOIN care_person
			ON care_person.pid=care_encounter.pid
			INNER JOIN care_tz_drugsandservices
			ON care_test_request_radio.test_request=care_tz_drugsandservices.item_id
			WHERE care_test_request_radio.bill_number = 0	$and_in_outpatient
			AND (isnull(care_test_request_radio.is_disabled)
			OR care_test_request_radio.is_disabled='')
			$where_encounter

			ORDER BY care_test_request_radio.send_date DESC , care_test_request_radio.encounter_nr ASC";


		}
		else
		{
			$this->sql = "SELECT $anzahl  		care_test_request_radio.*, " .
			"							care_test_request_radio.number_of_tests as dosage, " .
	    		"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
			"							care_encounter.encounter_date," .
			"                                                       care_tz_drugsandservices.item_id," .
			"                                                       care_tz_drugsandservices.item_description," .
			"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
			"							care_tz_drugsandservices.purchasing_class" .
	    		"							from care_test_request_radio
			INNER JOIN care_encounter
			ON care_encounter.encounter_nr=care_test_request_radio.encounter_nr
			INNER JOIN care_person
			ON care_person.pid=care_encounter.pid
			INNER JOIN care_tz_drugsandservices
			ON care_test_request_radio.test_request=care_tz_drugsandservices.item_id
			WHERE care_test_request_radio.bill_number = 0 $and_in_outpatient
			AND (isnull(care_test_request_radio.is_disabled)
			OR care_test_request_radio.is_disabled='')
			$where_encounter

			ORDER by $_REQUEST[sort] $_REQUEST[sorttyp]";

		}



		//if ($this->debug) echo $this->sql;

		$this->request = $db->Execute($this->sql);
		if ($this->debug) echo $this->request;
		return $this->request;


	}

	//------------------------------------------------------------------------------

	function GetNewQuotation_Laboratory($encounter_nr, $in_outpatient, &$id_array) {

		$and_in_outpatient=$this->GetQuotationStatus($in_outpatient);

		global $db;
		/**
		 * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */
		$this->debug=FALSE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetNewQuotation_Laboratory()</b><br>";
		if($encounter_nr>0)
		$where_encounter='AND care_test_request_chemlabor.encounter_nr = '.$encounter_nr.' GROUP BY care_test_request_chemlabor_sub.sub_id';
		else
		{
			$where_encounter='GROUP BY care_test_request_chemlabor_sub.sub_id, care_person.pid, care_person.selian_pid, care_person.name_first, care_person.name_last, care_person.date_birth';
			$anzahl= 'count(*) AS anzahl_lab,';
		}

		if(!$_REQUEST['sort'])
		{
		$this->sql = "SELECT $anzahl  		care_test_request_chemlabor.*, " .
				"							care_test_request_chemlabor_sub.paramater_name, " .
				"							care_test_request_chemlabor_sub.parameter_value, " .
				"							care_test_request_chemlabor_sub.sub_id, " .
				"							care_test_request_chemlabor_sub.item_id, " .
	    		"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
			"							care_encounter.encounter_date," .
	    		"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
			"							care_tz_drugsandservices.item_description" .
	    		"							from care_test_request_chemlabor_sub" .
			"	INNER JOIN care_test_request_chemlabor
				ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr" .
	    		" 	INNER JOIN care_encounter
				ON care_encounter.encounter_nr=care_test_request_chemlabor.encounter_nr" .
	    		"	INNER JOIN care_person
				ON care_person.pid=care_encounter.pid" .
	    		"	INNER JOIN care_tz_drugsandservices
				ON care_test_request_chemlabor_sub.item_id=care_tz_drugsandservices.item_id" .
	    		"		WHERE care_test_request_chemlabor_sub.bill_number = 0 $and_in_outpatient" .
	    		"		AND (isnull(care_test_request_chemlabor_sub.is_disabled)" .
	    		"			OR care_test_request_chemlabor_sub.is_disabled='')" .
	    		"			$where_encounter" .
	    		"			ORDER BY care_encounter.encounter_date DESC , care_test_request_chemlabor.encounter_nr ASC";
		}
		else
		{
			$this->sql = "SELECT $anzahl  	care_test_request_chemlabor.*, " .
				"							care_test_request_chemlabor_sub.paramater_name, " .
				"							care_test_request_chemlabor_sub.parameter_value, " .
				"							care_test_request_chemlabor_sub.sub_id, " .
				"							care_test_request_chemlabor_sub.item_id, " .
				"							care_person.pid, " .
	    		"							care_person.selian_pid, " .
	    		"							care_person.name_first, " .
	    		"							care_person.name_last, " .
	    		"							care_person.date_birth," .
				"							care_encounter.encounter_date," .
				"							care_tz_drugsandservices.unit_price," .
	    		"							care_tz_drugsandservices.unit_price_1," .
	    		"							care_tz_drugsandservices.unit_price_2," .
	    		"							care_tz_drugsandservices.unit_price_3," .
				"							care_tz_drugsandservices.item_description" .
	    		"							from care_test_request_chemlabor_sub

			INNER JOIN care_test_request_chemlabor
                        ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr
			INNER JOIN care_encounter
			ON care_encounter.encounter_nr=care_test_request_chemlabor.encounter_nr
			INNER JOIN care_person
			ON care_person.pid=care_encounter.pid
			INNER JOIN care_tz_drugsandservices
			ON care_test_request_chemlabor.item_id=care_tz_drugsandservices.item_id

			WHERE care_test_request_chemlabor_sub.bill_number = 0 $and_in_outpatient
			AND (isnull(care_test_request_chemlabor_sub.is_disabled)
			OR care_test_request_chemlabor_sub.is_disabled='')
			$where_encounter
			order by $_REQUEST[sort] $_REQUEST[sorttyp]";
		}


/*		SELECT $anzahl ctr.*, ctrsub.sub_id, ctrsub.parameter_value, ce.encounter_nr, cparam.name, cparam.price, cparam.price_1, cparam.price_2, cparam.price_3, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth
		FROM `care_test_request_chemlabor` ctr, `care_test_request_chemlabor_sub` ctrsub, `care_encounter` ce, `care_person` cp, `care_tz_laboratory_param` cparam
		WHERE ctr.encounter_nr = ce.encounter_nr
		AND cp.pid = ce.pid
		AND ctrsub.batch_nr = ctr.batch_nr
		AND ctrsub.paramater_name=cparam.id
		AND ctr.bill_number = 0
		AND (isnull(ctr.is_disabled) OR ctr.is_disabled='')
		$where_encounter
		ORDER BY ctr.test_date DESC , ctr.encounter_nr ASC";
*/
		$this->request = $db->Execute($this->sql);
		if ($this->debug) echo $this->request;
		return $this->request;

	}

	//------------------------------------------------------------------------------

	function GetLaboratoryCount($encounter_nr) {
		global $db;
		/**
		 * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */
		$this->debug=FALSE;;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetLaboratoryCount()</b><br>";
		$where_encounter='AND ctr.encounter_nr = '.$encounter_nr;
		$where_encounter = $where_encounter.' GROUP BY ctr.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
		$anzahl_lab= 'count(*) AS anzahl_lab,';

		$this->sql = "SELECT $anzahl_lab ctr.*, ctr_sub.encounter_nr, cp.pid, cp.selian_pid, cp.name_first,
		cp.name_last FROM care_test_request_chemlabor` ctr, care_test_request_chemlabor_sub ctr_sub, care_encounter ce, care_person cp
		WHERE ctr_sub.encounter_nr = ce.encounter_nr
		ctr.batch_nr=ctr_sub.batch_nr
		AND ce.pid = cp.pid
		AND ctr.bill_number = 0
		AND (isnull(ctr.is_disabled) OR ctr.is_disabled='')
		$where_encounter
		ORDER BY ctr.modify_time DESC , ctr.encounter_nr ASC";
		$this->request = $db->Execute($this->sql);
		return $this->request;

	}

//------------------------------------------------------------------------------

	function GetRadiologyCount($encounter_nr) {
		global $db;
		/**
		 * Returns all new laboratory requests in a recordset. If no Encounter-Nr is given
		 * the result-list is grouped by encounters
		 */
		$this->debug=FALSE;;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::GetLaboratoryCount()</b><br>";
		$where_encounter='AND care_test_request_radio.encounter_nr = '.$encounter_nr;
		$where_encounter = $where_encounter.' GROUP BY care_test_request_radio.encounter_nr, cp.pid, cp.selian_pid, cp.name_first, cp.name_last, cp.date_birth';
		$anzahl_lab= 'count(*) AS anzahl_rad,';

		$this->sql = "SELECT $anzahl_lab care_test_request_radio.*, cp.pid, cp.selian_pid, cp.name_first,
		cp.name_last FROM care_test_request_radio, care_encounter ce, care_person cp
		WHERE care_test_request_radio.encounter_nr = ce.encounter_nr
		AND ce.pid = cp.pid
		AND care_test_request_radio.bill_number = 0
		AND (isnull(care_test_request_radio.is_disabled) OR care_test_request_radio.is_disabled='')
		$where_encounter
		ORDER BY care_test_request_radio.xray_date DESC , care_test_request_radio.encounter_nr ASC";
		$this->request = $db->Execute($this->sql);
		return $this->request;

	}

	//------------------------------------------------------------------------------

	function DeleteNewPrescription($nr,$reason) {
		global $db;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::DeleteNewPrescription($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;
		$this->sql = "UPDATE $this->tbl_prescriptions SET
		is_disabled = 1, bill_status = 'dropped', disable_id='".$_SESSION['sess_user_name']."',disable_date='".date('Y-m-d')."',history = CONCAT(history, '$reason')
		WHERE `nr`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}

	//------------------------------------------------------------------------------

	function DeleteNewLaboratory($nr,$reason) {
		global $db;
		$debug=false;
		if ($debug) echo "<b>class_tz_billing::DeleteNewLaboratory($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;
		$this->sql = "UPDATE $this->tbl_lab_requests_sub SET
		is_disabled = 1, bill_status = 'dropped', disable_id='".$_SESSION['sess_user_name']."',disable_date='".date('Y-m-d')."',history = CONCAT(history, '$reason')
		WHERE `sub_id`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}


	//------------------------------------------------------------------------------
	function DeleteNewRadiology($nr,$reason) {
		global $db;
		$debug=FALSE;
		if ($debug) echo "<b>class_tz_billing::DeleteNewRadiology($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;
		$this->sql = "UPDATE $this->tbl_rad_requests SET
		is_disabled = 1, bill_status = 'dropped', disable_id='".$_SESSION['sess_user_name']."',disable_date='".date('Y-m-d')."',history = CONCAT(history, '$reason')
		WHERE `batch_nr`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}

	//------------------------------------------------------------------------------

	function UpdateBillNumberNewPrescription($nr,$bill_number) {
		global $db;
		$debug=FALSE;;
		if ($debug) echo "<b>class_tz_billing::UpdateNewPrescription($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;
		$this->sql = "UPDATE $this->tbl_prescriptions SET
		bill_number = '.$bill_number
		WHERE `nr`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}

//------------------------------------------------------------------------------

	function UpdateBillNumberNewLaboratory($nr,$bill_number) {
		global $db;
		$debug=FALSE;;
		if ($debug) echo "<b>class_tz_billing::UpdateNewLaboratory($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;
		$this->sql = "UPDATE $this->tbl_lab_requests_sub SET
		bill_number = '.$bill_number
		WHERE `item_id`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}

//------------------------------------------------------------------------------

	function UpdateBillNumberNewRadiology($nr,$bill_number) {
		global $db;
		$debug=FALSE;;
		if ($debug) echo "<b>class_tz_billing::UpdateNewRadiology($nr)</b><br>";
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if(!$nr) return false;

		$this->sql = "UPDATE $this->tbl_rad_requests SET
		bill_number = ".$bill_number."
		WHERE `batch_nr`=".$nr;
		$db->Execute($this->sql);
		return TRUE;
	}

	//------------------------------------------------------------------------------

	function ShowNewQuotations($in_outpatient,$sid)
	{

		global $db;
		$counter=0;
		$color_change=FALSE;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=true : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotations()</b><br>";

		if ($this->CreateTmpTableOfElementsToQuote(0,$in_outpatient))
			$result=$this->GetNewQuotationOverview();

		$ins_obj = new Insurance_tz;

//		$result=$this->getNewQuotation_Prescriptions(0,$in_outpatient,$id_array);
//		$this->getNewQuotation_Laboratory(0,$in_outpatient,$id_array);
//		$this->getNewQuotation_Radiology(0,$in_outpatient,&$id_array);

		if ($result)
		while ($row=$result->FetchRow())
			{
				$counter++;
				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				if ($row['purchasing_class'] == 'xray') $createmode = 'radiology';
				if ($row['purchasing_class'] == 'labtest') $createmode = 'laboratory';

				$total_count=0;
				$row['anzahl']+=$row['anzahl'];
				if(empty($row['anzahl'])) $row['anzahl'] = 0;
				//$labinfo = $this->GetLaboratoryCount($row['encounter_nr']);
				$row['anzahl_lab']+=$row['anzahl_lab'];
				if(empty($row['anzahl_lab'])) $row['anzahl_lab'] = 0;
				//$radinfo = $this->GetRadiologyCount($row['encounter_nr']);
				$row['anzahl_rad']+=$row['anzahl_rad'];
				if(empty($row['anzahl_rad'])) $row['anzahl_rad'] = 0;
				$total_count = ($row['anzahl'])/2;
				//echo $row['anzahl']." + ".$row['anzahl_lab']." = ".$total_count;


				if (($in_outpatient=='outpatient')||($in_outpatient=='artndental')) {
					$sql='SELECT name_formal from care_department where nr='.$row['current_dept_nr'];
					$deptresult=$db->Execute($sql);
					if ($row['current_dept_nr']==0) {
						$deptname='Admissions';
					} else  {
						$deptrow=$deptresult->FetchRow();
						$deptname=$deptrow[0];
					}

				} else {
					$sql='SELECT name from care_ward where nr='.$row['current_ward_nr'];
					$deptresult=$db->Execute($sql);
					if ($row['current_ward_nr']==0) {
						$deptname='Admissions';
					} else  {
						$deptrow=$deptresult->FetchRow();
						$deptname=$deptrow[0];
					}

				}

				if($row['insurance_ID'] > 0) {

                        if($ins_obj->CheckCurrentContractValidity($row['insurance_ID']))
                        $ins_name = $ins_obj->GetName_insurance_from_id($row['insurance_ID']);
						else
						$ins_name = 'Cash';

				}
				else {
						$ins_name = 'Cash';

				}

		echo '


          <tr>
          			<form method="GET" action="billing_tz_quotation_select_pricelist.php">
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_date'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$ins_name.'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$total_count.'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$deptname.'</div></td>

					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.

                                                   '<a href="../../modules/ambulatory/amb_clinic_discharge_info.php'.URL_APPEND.'&ntid=false&lang=en&target=search&pn='.$row['encounter_nr'].'" target="_blank" title="Admission data : Click to show data"><img src="../../gui/img/common/default/pdata.gif" alt="Admission data : Click to show data" width="20" border="0" height="20"></a>'
                                                   .'</div></td>

					  <td '.$BGCOLOR.' class="td_content"><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="createmode" value="'.$createmode.'"><input type="hidden" name="countpres" value="'.$row['anzahl'].'"><input type="hidden" name="countrad" value="'.$row['anzahl_rad'].'"><input type="hidden" name="countlab" value="'.$row['anzahl_lab'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
				$alreadyshown[$row['encounter_nr']] = $row['encounter_nr'];
			}
			else
				echo '<tr><td colspan="8" align="center">Houston we have a problem. Database error :(</td></tr>';

			if(!$counter)
			echo '<tr><td colspan="8" align="center">Nothing to do :)</td></tr>';
	}

	//------------------------------------------------------------------------------

	function ShowNewQuotations_Prescriptions($in_outpatient,$sid)
	{

		global $db;
		$counter=0;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotations()</b><br>";

		$result = $this->GetNewQuotation_Prescriptions(0,$in_outpatient);


		$color_change=FALSE;

		if($result)
		{
			while ($row=$result->FetchRow())
			{
				$counter++;
				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				//$total_count=0;
				//$labinfo = $this->GetLaboratoryCount($row['encounter_nr']);
				//$labinfo['anzahl_lab']+=$labinfo['anzahl_lab'];
				//if(empty($labinfo['anzahl_lab'])) $labinfo['anzahl_lab'] = 0;
				//$total_count = ($row['anzahl']+$labinfo['anzahl_lab']);
				//echo $row['anzahl']." + ".$labinfo['anzahl_lab']." = ".$total_count;
				echo '


          <tr>
          			<form method="GET" action="billing_tz_quotation_select_pricelist.php">
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['create_time'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['anzahl'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center"><input type="hidden" name="namelast" value="'.$row['name_last'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" name="namefirst" value="'.$row['name_first'].'"><input type="hidden" name="countpres" value="'.$row['anzahl'].'"><input type="hidden" name="countlab" value="'.$row['anzahl_lab'].'"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
				$alreadyshown[$row['encounter_nr']] = $row['encounter_nr'];
			}


			if(!$counter)
			echo '<tr><td colspan="8" align="center">Nothing to do :)</td></tr>';
		}
		else
		echo '<tr><td colspan="8" align="center">Houston we have a problem. Database error :(</td></tr>';
	}

	//------------------------------------------------------------------------------

	function ShowNewQuotations_Radiology($in_outpatient,$sid)
	{

		global $db;
		$counter=0;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotations_Radiology()</b><br>";


		$result = $this->GetNewQuotation_Radiology(0,$in_outpatient);

		$color_change=FALSE;



		if($result)
		{
			while ($row=$result->FetchRow())
			{
				$counter++;
				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				//$total_count=0;
				//$labinfo = $this->GetLaboratoryCount($row['encounter_nr']);
				//$labinfo['anzahl_lab']+=$labinfo['anzahl_lab'];
				//if(empty($labinfo['anzahl_lab'])) $labinfo['anzahl_lab'] = 0;
				//$total_count = ($row['anzahl']+$labinfo['anzahl_lab']);
				//echo $row['anzahl']." + ".$labinfo['anzahl_lab']." = ".$total_count;
				echo '


          <tr>
          			<form method="GET" action="billing_tz_quotation_select_pricelist.php">

					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['send_date'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.' class="td_content"><div align="center">'.$row['anzahl'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="createmode" value="radiology"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" name="send_doctor" value="'.$row['send_doctor'].'"><input type="hidden" name="countrad" value="'.$row['anzahl_rad'].'"><input type="hidden" name="send_date" value="'.$row['send_date'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>
					  </form>
					</tr>';
				$alreadyshown[$row['encounter_nr']] = $row['encounter_nr'];
			}


			if(!$counter)
			echo '<tr><td colspan="8" align="center">Nothings to do :)</td></tr>';
		}
		else
		echo '<tr><td colspan="8" align="center">Houston we have a problem. Database error :(</td></tr>';
	}

	//------------------------------------------------------------------------------

	function ShowNewQuotations_Laboratory($in_outpatient)
	{
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotation_Laboratory()</b><br>";
		$result = $this->GetNewQuotation_Laboratory(0, $in_outpatient);
		if($result)
		{
			$color_change=FALSE;
			while ($row=$result->FetchRow())
			{
				$counter++;
				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				echo '
          <tr>
          	<form method="POST" action="billing_tz_quotation_create.php">
					  <td '.$BGCOLOR.'><div align="center">'.substr($row['modify_time'],0,10).'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['encounter_nr'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$this->ShowPID($row['pid']).'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['selian_pid'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['name_last'].', '.$row['name_first'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['date_birth'].'</div></td>
					  <td '.$BGCOLOR.'><div align="center">'.$row['anzahl_lab'].' req.</div></td>
					  <td '.$BGCOLOR.'><div align="center"><input type="hidden" name="createmode" value="laboratory"><input type="hidden" value="'.$row['encounter_nr'].'" name="encounter_nr"><input type="hidden" name="countlab" value="'.$row['anzahl_lab'].'"><input type="hidden" name="patient" value="'.$_REQUEST['patient'].'"><input type="hidden" value="'.$row['pid'].'" name="pid"><input type="submit" value=">>"></div></td>

					  </form>
					</tr>';
			}
			if(!$counter)
			echo '<tr><td colspan="8" align="center">Nothings to do :)</td></tr>';
		}
		else
		echo '<tr><td colspan="8" align="center">Huston we have a problem. Database error :(</td></tr>';
	}

	//------------------------------------------------------------------------------

	function GetMeaningOfPrices($pricing_field) {
		/*
		 * This Mehtord returns description to an column of prices of the pricing
		 * table care_tz_drugsandservices, columns unit_price,unit_price_1,unit_price_2,unit_price_3
		 */
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$this->sql = 'SELECT ShowDescription FROM care_tz_drugsandservices_description WHERE `Fieldname`="'.$pricing_field.'"';

		$this->request = $db->Execute($this->sql);
//		if ($row=$this->request->FetchRow())
//		return $row['ShowDescription'];
//		else
		return "N/A";

	} // end of function GetMeaningOfPrices($pricing_field)

	//------------------------------------------------------------------------------

	// todo: Enter here the new functiopns of quotation/Billing

	function DisplayElementsToQuote($encounter_nr) {

	}

	function ShowNewQuotationEncounter_Prescriptions($encounter_nr,&$id_array)
	{

		global $db, $insurancebudget;
		if (func_num_args()>2) {
			$IS_PATIENT_INSURED=func_get_arg(2);
		}

		# 4 lang
		global $LDNotes, $LDDosage,$LDPrice,$LDInsurance,$LDPricing,$LDTSH,$LDPricing,$LDNothingtodo,$test,$LDTimesPerDay,$LDDays;

		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Prescriptions()</b><br>";

		$result = $this->GetNewQuotation_Prescriptions($encounter_nr,$in_outpatient, $id_array);


		if($result)
		{
			$unit_price_description=$this->GetMeaningOfPrices('unit_price');
			$unit_price_1_description=$this->GetMeaningOfPrices('unit_price_1');
			$unit_price_2_description=$this->GetMeaningOfPrices('unit_price_2');
			$unit_price_3_description=$this->GetMeaningOfPrices('unit_price_3');

			$unit_price_4_description=$this->GetMeaningOfPrices('unit_price_4');
			$unit_price_5_description=$this->GetMeaningOfPrices('unit_price_5');
			$unit_price_6_description=$this->GetMeaningOfPrices('unit_price_6');

			$color_change=FALSE;

			while ($row=$result->FetchRow())
			{

			if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				$id_array['pressum_'.$row['nr']]= true;
				$countpres = $row['anzahl'];
				if(strlen($row['dosage'])<1) $row['dosage']=0;

				$dosage= $row['dosage'];

				$times_per_day = $row['times_per_day'];
				$days = $row['days'];


				// Check if unit_price is NULL -> replace it with 0 as number
				if (empty($row['unit_price']))
				$unit_price="0";
				else
				$unit_price=$row['unit_price'];
		  // replace , to . if needed:
				$unit_price = strtr($unit_price, ',','.');

				// Check if unit_price_1 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_1']))
				$unit_price_1="0";
				else
				$unit_price_1=$row['unit_price_1'];

		  // replace , to . if needed:
				$unit_price_1 = strtr($unit_price_1, ',','.');


				// Check if unit_price_2 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_2']))
				$unit_price_2="0";
				else
				$unit_price_2=$row['unit_price_2'];

		  // replace , to . if needed:
				$unit_price_2 = strtr($unit_price_2, ',','.');


				// Check if unit_price_3 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_3']))
				$unit_price_3="0";
				else
				$unit_price_3=$row['unit_price_3'];

		  // replace , to . if needed:
				$unit_price_3 = strtr($unit_price_3, ',','.');



		// Check if unit_price_4 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_4']))
				$unit_price_4="0";
				else
				$unit_price_4=$row['unit_price_4'];

		  // replace , to . if needed:
				$unit_price_4 = strtr($unit_price_4, ',','.');


		// Check if unit_price_5 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_5']))
				$unit_price_5="0";
				else
				$unit_price_5=$row['unit_price_5'];

		  // replace , to . if needed:
				$unit_price_5 = strtr($unit_price_5, ',','.');


		// Check if unit_price_6 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_6']))
				$unit_price_6="0";
				else
				$unit_price_6=$row['unit_price_6'];

		  // replace , to . if needed:
				$unit_price_6 = strtr($unit_price_6, ',','.');





				echo '<tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="650">
					  		<tr bgcolor="#ffffaa">
					  			<td width="150">
					  				<div align="left">'.$row['prescribe_date'].'</div>
					  			</td>
					  			<td width="250">
					  				<div align="center">'.$row['article'].'</div>
					  			</td width="200">
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="180">
					  					<tr>
					  						<td width="60"><input type="radio" value="bill" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',true,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="center"><input checked type="radio" value="ignore" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',false,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="modepres_'.$row['nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['nr'].'\',false,\''.$row['nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				</div>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffffdd" id="tr_'.$row['nr'].'" style="display: none;">
					  			<td valign="top" width="200">
					  				'.$LDNotes.'<br>
					  				<textarea rows="3" cols="22" name="notes_'.$row['nr'].'">'.$row['notes'].'</textarea>
					  			</td>
					  			<td valign="top"><div>
					  				<table border="0" cellpadding="0" cellspacing="0" width="200" >
										<tr>
											<td>';
												$unitPrice = '';
       												switch($_REQUEST['unit_price'])
				{
					case 1: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price.'">';$unitPrice = $unit_price;
					break;
					case 2: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_1.'">';$unitPrice = $unit_price_1;
					break;
					case 3: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_2.'">';$unitPrice = $unit_price_2;
					break;
					case 4: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_3.'">';$unitPrice = $unit_price_3;
					break;

					case 5: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_4.'">';$unitPrice = $unit_price_4;
					break;
					case 6: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_5.'">';$unitPrice = $unit_price_5;
					break;
					case 7: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['nr'].'" value="'.$unit_price_6.'">';$unitPrice = $unit_price_6;
					break;
				}
											echo '</td>
												<input onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" name="showprice_'.$row['nr'].'" id="showprice_'.$row['nr'].'" value="'.$unitPrice.'">SHOWPRICE: '.$unitPrice;
										echo '</tr>';

				if ($row['purchasing_class']=='labtest')
				{
					echo '<input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="dosage_'.$row['nr'].'"><br><br>';
				}
				else
				{
					echo '<tr>
					  						<td align="center"><u>'.$LDDosage.'</u><br><br></td>
					  						<td align="center"><input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['dosage'].'" name="dosage_'.$row['nr'].'"><br><br></td>
					  						</tr>';
				}
				if ($row['purchasing_class']=='labtest')
				{
					echo '<input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="times_per_day_'.$row['nr'].'"><br><br>


				                        <input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="days_'.$row['nr'].'"><br><br>

							<input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="total_dosage_'.$row['nr'].'"><br><br>';
				}
				else
				{

				if ($row['purchasing_class']=='xray' or $row['purchasing_class']=='service')
                                {
                                        echo '<input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="times_per_day_'.$row['nr'].'"><br><br>


                                                        <input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4" value="1" name="days_'.$row['nr'].'"><br><br>

                                                        <input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="hidden" size="4"
value="'.$row['total_dosage'].'" name="total_dosage_'.$row['nr'].'"><br><br>';
                                }

				else

				{


					echo '<tr>
						  							<td align="center"><u>'.$LDTimesPerDay.'</u><br><br></td>
													<td align="center"><input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['times_per_day'].'" name="times_per_day_'.$row['nr'].'"><br><br></td>
						  					   </tr>

											 <tr>
                                                                                                        <td align="center"><u>'.$LDDays.'</u><br><br></td>
                                                                                                        <td align="center"><input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['days'].'" name="days_'.$row['nr'].'"><br><br></td>
                                                                                           </tr>

											   <tr>
						  							<td align="center"><u>'.$LDTotalDosage.'</u><br><br></td>
													<td align="center"><input readonly onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.$row['total_dosage'].'" name="total_dosage_'.$row['nr'].'"><br><br></td>
						  					   </tr>';
				}

				}
				if ($IS_PATIENT_INSURED){
					echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="'.($row['total_dosage']*$row['price']).'" name="insurance_'.$row['nr'].'"></td>
					  					</tr>';
				}
				else
				{
					echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['nr'].'\');" type="text" size="4" value="0" name="insurance_'.$row['nr'].'"></td>
					  					</tr>';
				}

								echo '	</table>
					  			</div></td>
					  			<td valign="top" id="div_'.$row['nr'].'"><div>
					  				<table border="0" cellpadding="0" cellspacing="0" width="200" >
										<tr>
											<td><u>'.$LDPricing.'</u><br>

									<input type="hidden" name="unit_price_'.$row['nr'].'" id="unit_price_'.$row['nr'].'" value="'.$unitPrice.'">';
				switch($_REQUEST['unit_price'])
				{
				case 1: echo '<br><font size="1">'.$unit_price_description.':'.$unit_price.' '.$LDTSH.'  <input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price.'" checked>';
				break;
				case 2: echo '<br><font size="1">'.$unit_price_1_description.':'.$unit_price_1.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_1.'" checked>';
				break;
				case 3: echo '<br><font size="1">'.$unit_price_1_description.':'.$unit_price_1.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_1.'" checked>';
				break;
				case 4: echo '<br><font size="1">'.$unit_price_3_description.':'.$unit_price_3.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_3.'" checked>';
				break;


				case 5: echo '<br><font size="1">'.$unit_price_4_description.':'.$unit_price_4.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_4.'" checked>';
				break;
				case 6: echo '<br><font size="1">'.$unit_price_5_description.':'.$unit_price_5.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_5.'" checked>';
				break;
				case 7: echo '<br><font size="1">'.$unit_price_6_description.':'.$unit_price_6.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['nr'].'" value="'.$unit_price_6.'" checked>';
				break;
				}
											echo '</td>
										</tr>
										<tr><td><td align="center"><input type="hidden" onkeyup="javascript:calc_article(\''.$row['nr'].'\');" name="div_'.$row['nr'].'" id="div_'.$row['nr'].'">test</td>
										</tr>
									</table>
								</div></td>
							 </tr>
					  	</table>
					  </td>
				</tr>';
			} //end of while
		} // end of if($result)


	}



	//------------------------------------------------------------------------------

	function ShowNewQuotationEncounter_Laboratory($encounter_nr)
	{
		global $db,$root_path, $insurancebudget;
		global $LDInsurance,$LDPricing, $LDDosage, $LDTSH, $LDPrice, $LDNothingtodo;

		if (func_num_args()>2) {
			$IS_PATIENT_INSURED=func_get_arg(2);
		}


		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Laboratory()</b><br>";
		$result = $this->GetNewQuotation_Laboratory($encounter_nr, $in_outpatient, $id_array);

		if($result)
		{
			$unit_price_description=$this->GetMeaningOfPrices('unit_price');
			$unit_price_1_description=$this->GetMeaningOfPrices('unit_price_1');
			$unit_price_2_description=$this->GetMeaningOfPrices('unit_price_2');
			$unit_price_3_description=$this->GetMeaningOfPrices('unit_price_3');

			$unit_price_4_description=$this->GetMeaningOfPrices('unit_price_4');
			$unit_price_5_description=$this->GetMeaningOfPrices('unit_price_5');
			$unit_price_6_description=$this->GetMeaningOfPrices('unit_price_6');

			$color_change=FALSE;
			while ($row=$result->FetchRow())
			{

				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				//if(strlen($row['parameter_value'])<1) $row['parameter_value']=0;
				$id_array['pressum_'.$row['sub_id']]= true;
				$countlab = $row['anzahl_lab'];
				//batch_nr
				//von hier aus zur care_test_request_chemlabor_sub

				//echo 'XXX: '.$row['batch_nr'];

				//$sql2 = 'select * from care_test_request_chemlabor_sub csub, care_tz_laboratory_param cparam  where csub.batch_nr= \''.$row['batch_nr'].'\' and csub.paramater_name=cparam.id';
				//echo $sql2.'<br>';



				//$this->result = $db->Execute($sql2);
				//foreach ($this->result as $val){
					//echo $wert['paramater_name'].' '.$wert['name'];
					//echo $wert['batch_nr'];


				// Check if unit_price is NULL -> replace it with 1 as number
				if (empty($row['unit_price']))
				$unit_price="1";
				else
				$unit_price=$row['unit_price'];
		  // replace , to . if needed:
				$unit_price = strtr($unit_price, ',','.');

				// Check if unit_price_1 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_1']))
				$unit_price_1="0";
				else
				$unit_price_1=$row['unit_price_1'];

		  // replace , to . if needed:
				$unit_price_1 = strtr($unit_price_1, ',','.');


				// Check if unit_price_2 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_2']))
				$unit_price_2="0";
				else
				$unit_price_2=$row['unit_price_2'];

		  // replace , to . if needed:
				$unit_price_2 = strtr($unit_price_2, ',','.');


				// Check if unit_price_3 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_3']))
				$unit_price_3="0";
				else
				$unit_price_3=$row['unit_price_3'];

		  // replace , to . if needed:
				$unit_price_3 = strtr($unit_price_3, ',','.');


				// Check if unit_price_3 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_3']))
				$unit_price_3="0";
				else
				$unit_price_3=$row['unit_price_3'];

		  // replace , to . if needed:
				$unit_price_3 = strtr($unit_price_3, ',','.');


				// Check if unit_price_4 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_4']))
				$unit_price_4="0";
				else
				$unit_price_4=$row['unit_price_4'];

		  // replace , to . if needed:
				$unit_price_4 = strtr($unit_price_4, ',','.');


				// Check if unit_price_5 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_5']))
				$unit_price_5="0";
				else
				$unit_price_5=$row['unit_price_5'];

		  // replace , to . if needed:
				$unit_price_5 = strtr($unit_price_5, ',','.');



				// Check if unit_price_6 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_6']))
				$unit_price_6="0";
				else
				$unit_price_6=$row['unit_price_6'];

		  // replace , to . if needed:
				$unit_price_6 = strtr($unit_price_6, ',','.');



					echo ' <tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="650">
					  		<tr bgcolor="#ffffaa">
					  			<td width="150">
					  				<div align="left">'.substr($row['modify_time'],0,4).'-'.substr($row['modify_time'],5,2).'-'.substr($row['modify_time'],8,2).'</div>
					  			</td>
					  			<td width="250">
					  				<div align="center">

					  '.$row['item_description'].'</div>
					  			</td width="200">
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="180">
					  					<tr>
					  						<td width="60"><input type="radio" value="bill" name="modelab_'.$row['sub_id'].'" onClick="javascript:toggle_tr(\'tr_'.$row['sub_id'].'\',true,\''.$row['sub_id'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="center"><input checked type="radio" value="ignore" name="modelab_'.$row['sub_id'].'" onClick="javascript:toggle_tr(\'tr_'.$row['sub_id'].'\',false,\''.$row['sub_id'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="modelab_'.$row['sub_id'].'" onClick="javascript:toggle_tr(\'tr_'.$row['sub_id'].'\',false,\''.$row['sub_id'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				</div>
					  			</td>
					  		</tr>
							<tr bgcolor="#ffffdd"  id="tr_'.$row['sub_id'].'" style="display: none;">
					  			<td valign="top">
					  				'.$LDNotes.'<br>
					  				<textarea rows="3" cols="22" name="notes_'.$row['sub_id'].'">'.$row['notes'].'</textarea>
					  			</td>				<td valign="top">
					  				<table border="0" cellpadding="0" width="200">
											<tr>
											<td>';
												$unitPrice = '';
       												switch($_REQUEST['unit_price'])
				{
					case 1: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price.'">';$unitPrice = $unit_price;
					break;
					case 2: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_1.'">';$unitPrice = $unit_price_1;
					break;
					case 3: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_2.'">';$unitPrice = $unit_price_2;
					break;
					case 4: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_3.'">';$unitPrice = $unit_price_3;
					break;


					case 5: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_4.'">';$unitPrice = $unit_price_4;
					break;
					case 6: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_5.'">';$unitPrice = $unit_price_5;
					break;
					case 7: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price_6.'">';$unitPrice = $unit_price_6;
					break;
				}
											echo '</td>
												<input onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" type="hidden" name="showprice_'.$row['sub_id'].'" id="showprice_'.$row['sub_id'].'" value="'.$unitPrice.'">SHOWPRICE: '.$unitPrice;
										echo '</tr>';
				echo '<tr>
					  							<td align="center"><u>'.$LDDosage.'</u><br><br></td><td align="center"><input  readonly onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" type="text" size="4" value="'.$row['parameter_value'].'" name="dosage_'.$row['sub_id'].'"><br><br></td>
					  						</tr>';
				if ($IS_PATIENT_INSURED){

					echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" type="text" size="4" value="" name="insurance_'.$row['sub_id'].'"> TSH</td>
					  					</tr>';
					}
					else
					{
						echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" type="text" size="4" value="0" name="insurance_'.$row['sub_id'].'"></td>
					  					</tr>';
					}

									echo '</table>
								</td>
					  			<td valign="top" id="div_'.$row['sub_id'].'">
					  				<table border="0" cellpadding="0" width="200">
					  					<div>
										<tr>
											<td>Price:</td>
					  						<input onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" type="hidden" id="unit_price_'.$row['sub_id'].'" name="unit_price_'.$row['sub_id'].'" value="'.$unit_price.'">
					  						<td align="center"><input type="hidden" onkeyup="javascript:calc_article(\''.$row['sub_id'].'\');" name="div_'.$row['sub_id'].'" id="div_'.$row['sub_id'].'">test</td>
										</tr></div>';
									echo'</table>
					  			</td>
					  		</tr>
					  	</table>
					  </td>
					</tr>';
				} //end while
		} //end if
//		else
//		echo '<tr><td colspan="8">'.$LDNothingtodo.'s</td></tr>';
	}


				//old code:

				/*
				 parse_str($row['parameters'],$tests);



				 while(list($x,$v)=each($tests))
				 {
					$tests_arr[strtok(substr($x,5),"_")] = $v;
					}
					require_once($root_path.'include/care_api_classes/class_lab.php');
					if(!isset($lab_obj)) $lab_obj=new Lab($encounter_nr);


					echo '
					<tr>
					<td colspan=8>
					<table border="0" cellpadding="2" cellspacing="2" width="600">
					<tr bgcolor="#ffffaa">
					<td width="200">
					<div align="left">'.substr($row['modify_time'],0,4).'-'.substr($row['modify_time'],5,2).'-'.substr($row['modify_time'],8,2).'</div>
					</td>
					<td width="200">
					<div align="center">';
					$sum=0;
					$desc=false;
					$pricelist=false;
					while(list($x,$v)=each($tests_arr))
					{
					$labrow = $lab_obj->TestParamsDetails($x);
					$desc .=$labrow['name'].', ';
					$pricelist.= $labrow['name'].': '.$labrow['price'].'<br>';
					$sum += $labrow['price'];

					}

					echo $desc.'</div>
					</td width="200">
					<td>
					<div align="right">
					<table border="0" cellpadding="0" width="180">
					<tr>
					<td width="60"><input type="radio" value="bill" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',true,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item now!" style="filter:alpha(opacity=70)"></td>
					<td width="60" align="center"><input checked type="radio" value="ignore" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					<td width="60" align="right"><input type="radio" value="delete" name="modelab_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					</tr>
					</table>



					</div>
					</td>
					</tr>
					<tr bgcolor="#ffffdd" id="tr_'.$row['batch_nr'].'" style="display: none;">
					<td valign="top">
					'.$pricelist.'= '.$sum.' TSH
					</td>
					<td valign="top">
					<table border="0" cellpadding="0" width="200">
					<tr>
					<td width="100">Price:</td>
					<td align="right"><input type="hidden" id="showprice_'.$row['nr'].'" name="showprice_'.$row['batch_nr'].'" value="'.$sum.'">'.$sum.' TSH<input onChange="calc_article(\''.$row['batch_nr'].'\');" type="hidden" value="1" name="dosage_'.$row['batch_nr'].'"></td>
					</tr>';

					if ($IS_PATIENT_INSURED) echo '
					<tr>
					<td>'.$LDInsurance.'</td>
					<td align="right"><input onkeyup="calc_article(\''.$row['batch_nr'].'\')" type="text" size="4" value='.$sum.' name="insurance_'.$row['batch_nr'].'"> TSH</td>
					</tr>';
					echo '
					</table>
					</td>
					<td valign="top">
					<u>'.$LDPricing.'</u><br>
					<div  id="div_'.$row['batch_nr'].'"></div>
					</td>
					</tr>
					</table>
					</td>
					</tr>';

					*/
				//end of old code

				// even older code:
				/*				echo '
				<tr>
				<td '.$BGCOLOR.'><div align="center">'.$row['modify_time'].'</div></td>
				<td '.$BGCOLOR.'><div align="center">'.$desc.'</div></td>
				<td '.$BGCOLOR.'><div align="center"><input type="radio" value="bill" name="modelab_'.$row['batch_nr'].'"></div></td>
				<td '.$BGCOLOR.'><div align="center"><input checked type="radio" value="ignore" name="modelab_'.$row['batch_nr'].'"></div></td>
				<td '.$BGCOLOR.'><div align="center"><input type="radio" value="delete" name="modelab_'.$row['batch_nr'].'"></div></td>
				</tr>';

				end of even older code

				//		$id_array['pressum_'.$row['batch_nr'].']= true;
*/

	function ShowNewQuotationEncounter_Radiology($encounter_nr)
	{
		global $db, $insurancebudget;
		if (func_num_args()>2) {
			$IS_PATIENT_INSURED=func_get_arg(2);
		}

		# 4 lang
		global $LDNotes, $LDDosage,$LDPrice,$LDInsurance,$LDPricing,$LDTSH,$LDPricing,$LDNothingtodo,$test,$LDTimesPerDay,$LDDays;

		$this->debug=falsE;
		($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "<br><b>Method class_tz_billing::ShowNewQuotationEncounter_Radiology()</b><br>";


		$result = $this->GetNewQuotation_Radiology($encounter_nr,$in_outpatient, $id_array);

		if($result)
		{

			$unit_price_description=$this->GetMeaningOfPrices('unit_price');
			$unit_price_1_description=$this->GetMeaningOfPrices('unit_price_1');
			$unit_price_2_description=$this->GetMeaningOfPrices('unit_price_2');
			$unit_price_3_description=$this->GetMeaningOfPrices('unit_price_3');

			$unit_price_4_description=$this->GetMeaningOfPrices('unit_price_4');
			$unit_price_5_description=$this->GetMeaningOfPrices('unit_price_5');
			$unit_price_6_description=$this->GetMeaningOfPrices('unit_price_6');


			$color_change=FALSE;

			while ($row=$result->FetchRow())
			{

				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}
				$id_array['pressum_'.$row['batch_nr']]= true;

				$dosage = $row['dosage'];
				$times_per_day = 0;
				$days = 0;
				$countrad = $row['anzahl_rad'];

				// Check if unit_price is NULL -> replace it with 0 as number
				if (empty($row['unit_price']))
				$unit_price="0";
				else
				$unit_price=$row['unit_price'];
		  // replace , to . if needed:
				$unit_price = strtr($unit_price, ',','.');

				// Check if unit_price_1 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_1']))
				$unit_price_1="0";
				else
				$unit_price_1=$row['unit_price_1'];

		  // replace , to . if needed:
				$unit_price_1 = strtr($unit_price_1, ',','.');


				// Check if unit_price_2 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_2']))
				$unit_price_2="0";
				else
				$unit_price_2=$row['unit_price_2'];

		  // replace , to . if needed:
				$unit_price_2 = strtr($unit_price_2, ',','.');


				// Check if unit_price_3 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_3']))
				$unit_price_3="0";
				else
				$unit_price_3=$row['unit_price_3'];

		  // replace , to . if needed:
				$unit_price_3 = strtr($unit_price_3, ',','.');



				// Check if unit_price_3 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_4']))
				$unit_price_4="0";
				else
				$unit_price_4=$row['unit_price_4'];

		  // replace , to . if needed:
				$unit_price_4 = strtr($unit_price_4, ',','.');


				// Check if unit_price_5 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_5']))
				$unit_price_5="0";
				else
				$unit_price_5=$row['unit_price_5'];

		  // replace , to . if needed:
				$unit_price_5 = strtr($unit_price_5, ',','.');

				// Check if unit_price_6 is NULL -> replace it with 0 as number
				if (empty($row['unit_price_6']))
				$unit_price_6="0";
				else
				$unit_price_6=$row['unit_price_6'];

		  // replace , to . if needed:
				$unit_price_6 = strtr($unit_price_6, ',','.');



				echo '<tr>
					  <td colspan=8>
					  	<table border="0" cellpadding="2" cellspacing="2" width="650">
					  		<tr bgcolor="#ffffaa">
					  			<td width="150">
					  				<div align="left">'.$row['send_date'].'</div>
					  			</td>
					  			<td width="250">
					  				<div align="center">'.$row['item_description'].'</div>
					  			</td width="200">
					  			<td>
					  				<div align="right">
					  				<table border="0" cellpadding="0" width="180">
					  					<tr>
					  						<td width="60"><input type="radio" value="bill" name="moderad_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',true,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/check2.gif" border=0 alt="Bill this item!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="center"><input checked type="radio" value="ignore" name="moderad_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/clock.gif" width="20" height="20" border=0 alt="Ignore this item now!" style="filter:alpha(opacity=70)"></td>
					  						<td width="60" align="right"><input type="radio" value="delete" name="moderad_'.$row['batch_nr'].'" onClick="javascript:toggle_tr(\'tr_'.$row['batch_nr'].'\',false,\''.$row['batch_nr'].'\');"><img align=absmiddle src="../../gui/img/common/default/delete2.gif" border=0 alt="Delete this item now!" style="filter:alpha(opacity=70)"></td>
					  					</tr>
					  				</table>
					  				</div>
					  			</td>
					  		</tr>
					  		<tr bgcolor="#ffffdd" id="tr_'.$row['batch_nr'].'" style="display: none;">
					  			<td valign="top" width="200">
					  				'.$LDNotes.'<br>
					  				<textarea rows="3" cols="22" name="notes_'.$row['batch_nr'].'">'.$row['clinical_info'].'</textarea>
					  			</td>
					  			<td valign="top"><div>
					  				<table border="0" cellpadding="0" cellspacing="0" width="200" >
										<tr>
											<td>';
												$unitPrice = '';
       												switch($_REQUEST['unit_price'])
				{
					case 1: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price.'">';$unitPrice = $unit_price;
					break;
					case 2: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_1.'">';$unitPrice = $unit_price_1;
					break;
					case 3: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_2.'">';$unitPrice = $unit_price_2;
					break;
					case 4: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_3.'">';$unitPrice = $unit_price_3;
					break;


					case 5: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_4.'">';$unitPrice = $unit_price_4;
					break;
					case 6: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_5.'">';$unitPrice = $unit_price_5;
					break;
					case 7: echo '<br><font size="1"><input type="hidden" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_6.'">';$unitPrice = $unit_price_6;
					break;
				}
											echo '</td>
												<input onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" type="hidden" name="showprice_'.$row['batch_nr'].'" id="showprice_'.$row['batch_nr'].'" value="'.$unitPrice.'">SHOWPRICE: '.$unitPrice;
										echo '</tr>';


					echo '<tr>
					  						<td align="center"><u>'.$LDDosage.'</u><br><br></td>
					  						<td align="center"><input readonly onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" type="text" size="4" value="'.$dosage.'" name="dosage_'.$row['batch_nr'].'"><br><br></td>
					  						</tr>';

				if ($IS_PATIENT_INSURED){
					echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" type="text" size="4" value="" name="insurance_'.$row['batch_nr'].'"></td>
					  					</tr>';
				}
				else
				{
					echo '<tr>
					  						<td>'.$LDInsurance.'</td>
					  						<td align="center"><input onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" type="text" size="4" value="0" name="insurance_'.$row['batch_nr'].'"></td>
					  					</tr>';
				}

								echo '	</table>
					  			</div></td>
					  			<td valign="top" id="div_'.$row['batch_nr'].'"><div>
					  				<table border="0" cellpadding="0" cellspacing="0" width="200" >
										<tr>
											<td><u>'.$LDPricing.'</u><br>

									<input type="hidden" name="unit_price_'.$row['batch_nr'].'" id="unit_price_'.$row['batch_nr'].'" value="'.$unitPrice.'">';
				switch($_REQUEST['unit_price'])
				{
				case 1: echo '<br><font size="1">'.$unit_price_description.':'.$unit_price.' '.$LDTSH.'  <input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price.'" checked>';
				break;
				case 2: echo '<br><font size="1">'.$unit_price_1_description.':'.$unit_price_1.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_1.'" checked>';
				break;
				case 3: echo '<br><font size="1">'.$unit_price_1_description.':'.$unit_price_1.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_1.'" checked>';
				break;
				case 4: echo '<br><font size="1">'.$unit_price_3_description.':'.$unit_price_3.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_3.'" checked>';
				break;


				case 5: echo '<br><font size="1">'.$unit_price_4_description.':'.$unit_price_4.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_4.'" checked>';
				break;
				case 6: echo '<br><font size="1">'.$unit_price_5_description.':'.$unit_price_5.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_5.'" checked>';
				break;
				case 7: echo '<br><font size="1">'.$unit_price_6_description.':'.$unit_price_6.' '.$LDTSH.'<input type="radio" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price_6.'" checked>';
				break;
				}
											echo '</td>
										</tr>
										<input onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" type="hidden" id="unit_price_'.$row['batch_nr'].'" name="unit_price_'.$row['batch_nr'].'" value="'.$unit_price.'">
					  						<td align="center"><input type="hidden" onkeyup="javascript:calc_article(\''.$row['batch_nr'].'\');" name="div_'.$row['batch_nr'].'" id="div_'.$row['batch_nr'].'">test</td>
										</tr>
									</table>
								</div></td>
							 </tr>
					  	</table>
					  </td>
				</tr>';
			} //end of while
		} // end of if($result)
//		else
//		echo '<tr><td colspan="8">'.$LDNothingtodo.'</td></tr>';
	}

	function getItemIdByParamName ($param_name)
	{
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$this->sql = "SELECT item_id from $this->tb_drugsandservices where item_description='".$param_name;
		$this->request = $db->Execute($this->sql);
		if ($row=$this->request -> FetchRow())
		return $row['item_id'];
		else
		return "N/A";
	}

	//TODO: check on enabled drugsandservices item!
	function new_reg($encounter,$reg,$prescriber)
	{
		global $db;
		$debug=false;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;


		$this->sql="SELECT `item_id`, `item_number`,`item_description`, `unit_price` FROM care_tz_drugsandservices where item_description='".$reg."'";
		$this->request=$db->Execute($this->sql);
		while ($this->res=$this->request->FetchRow()) {

			$item_id=$this->res['item_id'];
			$item_number=$this->res['item_number'];
			$item_description=$this->res['item_description'];
			$unit_price=$this->res['unit_price'];


			$this->sql="insert into $this->tbl_prescriptions (encounter_nr,article,article_item_number,price,prescribe_date,prescriber,history,modify_time,dosage,total_dosage)values('".$encounter."','".$item_description."','".$item_id."','".$unit_price."','".date('Y-m-d')."','".$prescriber."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."','1','1')";
			#$this->sql="insert into tbl_prescriptions(encounter_nr)values('".$encounter."')";
			$db->Execute($this->sql);

			$this->sql='select max(nr) from '.$this->tbl_prescriptions.' where encounter_nr='.$encounter;
			$result=$db->Execute($this->sql);
			$WONumberArray = $result->FetchRow();
			$WONumber=$WONumberArray[0];
			if($is_transmit_to_weberp_enable == 1) {
				$weberp_obj = new_weberp();
				$weberp_obj->make_patient_workorder_in_webERP($WONumber);
				$weberp_obj->issue_to_patient_workorder_in_weberp($WONumber, $item_number, $weberp_obj->defaultLocation, '1', '');
				destroy_weberp($weberp_obj);
			}

		}
		return TRUE;
	}


	function disable_reg($encounter_nr,$type,$reg)
	{
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=FALSE : $db->debug=FALSE;

		//$sql="Select * from tbl_prescriptions where encounter_nr=$encounter_nr  ";


		$sql2="select * from $this->tbl_prescriptions as a
		inner join care_tz_drugsandservices as b on a.article_item_number = b.item_id
		where a.encounter_nr=".$encounter_nr." AND (isnull(a.is_disabled) OR a.is_disabled='') AND b.item_number like '$type%'";

		//echo $sql2;
		$result=$db->Execute($sql2);

		while($encounter=$result->FetchRow())
		{
			$article_nr=$encounter['article_item_number'];
		}


		$sql="Update $this->tbl_prescriptions
		set is_disabled='Disabled by Registration officer'
		where encounter_nr=".$encounter_nr." and article_item_number=".$article_nr;
		$db->Execute($sql);

		//echo $sql;



		// Update the care_encounter_prescripting with new information given at admission process.

		// Lösche die Einträge aus tbl_prescriptions, welche Registration oder Consultaiton fee betreffen

		// Verwende new_reg um eben dieses element was gelöscht wurde wieder anzulegen

	}
	//-------------------------------------

	function CountArchivedBill() {
		global $db;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;


		$sql= "SELECT distinct count(nr) as 'anzahl' FROM care_tz_billing_archive";
		$result=$db->Execute($sql);

		while($anzahl=$result->FetchRow())
		{
			return $anzahl['anzahl'];
		}
	}
	//-------------------------------------

	function DisplayAllArchivedBill($txtsearch,$searchtyp, $start_timeframe,$end_timeframe, $trans_id,$max_page_count,$day,$month, $year, $sorttyp,$view) {

		global $db,$type;
		$this->debug=FALSE;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$total_sum = 0;
		$search[0]=$txtsearch;
		$search[1]=$searchtyp;

		$sql_count="SELECT count(*) as count FROM care_encounter " .
			   "inner join care_tz_billing_archive on care_tz_billing_archive.encounter_nr=care_encounter.encounter_nr " .
			   "inner join care_person on care_encounter.pid = care_person.pid " .
			   "inner join care_tz_billing_archive_elem on care_tz_billing_archive.id = care_tz_billing_archive_elem.nr ";

		if( $search[0] == '' || $search[1] == '')
		{
			$sql_count.="WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
			$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe, $trans_id, "1",$txtsearch, $sorttyp);
		}
		else
		{
			$txtsearch=$search[0];

			if($search[1] =='all')
			{
				if($search[0]!='*')
				{
					if(is_numeric($txtsearch))
					{

						$sql_count .="where care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch";
						$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,"6",$txtsearch, $sorttyp);
					}
					else if(is_string($txtsearch))
					{
						$sql_count .= "where care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='".$txtsearch."'";
						$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,"4",$txtsearch, $sorttyp);
					}
				}
				else if($search[0]=='*')
				{
					$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe,$trans_id,"2",$txtsearch, $sorttyp);
				}
			}
			else if ($search[1] == 'month')
			{
				if($search[0]!='*')
				{
					if(is_numeric($txtsearch))
					{
						$sql_count .="where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch)";
						$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,"7",$txtsearch, $sorttyp);
					}
					else if(is_string($txtsearch))
					{
						$sql_count .= "where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch')";
						$sql=$this->getSqlStatment($sql_count,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,"5",$txtsearch, $sorttyp);
					}

				}
				else if($search[0]=='*')
				{

					$sql_count .="WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
					$sql=$this->getSqlStatment($sql_count, $max_page_count,$start_timeframe,$end_timeframe,$trans_id, "3",$txtsearch,$sorttyp);
				}
			}

		}
		$result=$db->Execute($sql);
		$color_change=FALSE;

		while($bills=$result->FetchRow())
		{
			if ($color_change) {
				$BGCOLOR='bgcolor="#ffffdd"';
				$color_change=FALSE;
			} else {
				$BGCOLOR='bgcolor="#ffffaa"';
				$color_change=TRUE;
			}

			$total_sum = $this->DisplayBillsInfo($bills,$view,$BGCOLOR);
			$total_summary+=$total_sum;
		}

		$this->DisplayNavi($sql_count,$max_page_count,$txtsearch, $search[1],$day, $month, $year, $view);

			return $total_summary;

	}
	//-------------------------------------

	function DisplayBillsInfo($bills,$view,$BGCOLOR)
	{

		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		$enc_obj = new Encounter;

		$bill_total = $this->DisplayArchivedBillAmount($bills['nr']);

		echo '<tr class="tr_content">';
		if($view=="month")
		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" ><a href="billing_tz_archive.php?displaybill=true&bill_nr='.$bills['nr'].'&batch_nr='.$bills['pid'].'">'.$bills['nr'].'</a></div></td>';
		else
		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" ><a href="billing_tz_archive_date.php?displaybill=true&bill_nr='.$bills['nr'].'&batch_nr='.$bills['pid'].'">'.$bills['nr'].'</a></div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.date("j F Y",$bills['date_change']).'</div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.$bill_total.'</div> </td>';
		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" >'.$bills['selian_pid'].'</div></td>';
		echo '<td '.$BGCOLOR.' class="td_content"><div align="center" >'.$enc_obj->ShowPID($bills['pid']).'</div></td>';
		echo '<td '.$BGCOLOR.'class="td_content"><div align="center" >'.$bills['User_Id'].'</div> </td>';

		echo '</tr>';


		return $bill_total;

	}

	function getSqlStatment($sql,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,$type,$txtsearch,$sorttyp)
	{
		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;
		if ($this->debug) echo "<br>method::getSqlStatment($sql,$max_page_count,$start_timeframe,$end_timeframe,$trans_id,$type,$txtsearch)<br>";
		$result=$db->Execute($sql);

		while($bills=$result->FetchRow())
		{
			$bill_count=$bills['count'];
		}

		$page_anz= $this->getPageCount($bill_count, $max_page_count);

		if($_REQUEST['next'] != true)
		{
			$from = 0;
		}

		if($_REQUEST['next'] == true)
		{
			$from = ($_REQUEST['page']-1)*$max_page_count;
		}
		else if($_REQUEST['back']==true)
		{
			$from= ($_REQUEST['page']*$max_page_count) - $max_page_count;
		}

		$sql= "SELECT * FROM care_encounter inner join care_tz_billing_archive on " .
	      "care_tz_billing_archive.encounter_nr=care_encounter.encounter_nr " .
		  "inner join care_person on care_encounter.pid = care_person.pid " .
		  "inner join care_tz_billing_archive_elem on care_tz_billing_archive.nr = care_tz_billing_archive_elem.nr ";

		switch ($type) {

			case 1: // not search
				$sql.= "WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
				break;
			case 2: // search all
				$sql.= "";
				break;
			case 3: // search by selected month
				$sql.=" WHERE $start_timeframe <=date_change AND $end_timeframe>=date_change";
				break;
			case 4: // search by selected month
				$sql.= "where care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch'";
				break;
			case 5: // search by selected month
				$sql.= "where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND (care_person.name_first='$txtsearch' OR care_person.name_last = '$txtsearch' OR care_tz_billing_archive_elem.user_id='$txtsearch')";
				break;
			case 6:
				$sql.="where care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch";
				break;
			case 7:
				$sql.="where ( $start_timeframe <=date_change AND $end_timeframe>=date_change) AND ( care_person.pid=$txtsearch OR care_tz_billing_archive_elem.nr=$txtsearch)";
				break;
		}

		switch($trans_id)
                {
                        case "":
				$sql.= "";
				break;

			case 0:
                                $sql.= " AND (care_tz_billing_archive_elem.insurance_id = 0 OR care_tz_billing_archive_elem.insurance_id = 'NULL' )";
                                break;

			case 1:
                                $sql.= " AND (care_tz_billing_archive_elem.insurance_id > 0) ";
                                break;
		}

		switch($_REQUEST['sortby'])
		{
			case "nr":
				$order = " care_tz_billing_archive_elem.nr " . $sorttyp;
				break;
			case "date":
				$order = " care_tz_billing_archive_elem.date_change " . $sorttyp;
				break;
			case "price":
				$order = " care_tz_billing_archive_elem.price*care_tz_billing_archive_elem.amount" . " " . $sorttyp;
				break;
			case "User_Id":
				$order = " care_tz_billing_archive_elem.user_id " . $sorttyp;
				break;
			case "selian_pid":
                                $order = " care_person.selian_pid " . $sorttyp;
                                break;
			case "pid":
				$order = " care_person.pid " . $sorttyp;
				break;

			default: $order = " care_tz_billing_archive_elem.date_change asc";
		}

		$sql.= " group by care_tz_billing_archive_elem.nr";
		$sql.= " order by" .$order;


		if($bill_count>$max_page_count)
		{
			$sql.=" limit $from,$max_page_count";
		}

		return $sql;


	}

	function getPageCount($total_num_of_records, $num_of_rows_to_display)
	{
		if($total_num_of_records>$num_of_rows_to_display)
		{
			if($total_num_of_records % $num_of_rows_to_display != 0)
			{
				$page_anz =  ceil($total_num_of_records / $num_of_rows_to_display);
			}
			else
			{
				$page_anz = $total_num_of_records / $num_of_rows_to_display;
			}
		}

		return $page_anz;
	}

	function DisplayNavi($sql_count,$max_page_count,$txtsearch, $type, $day, $month, $year, $view)
	{

		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$result=$db->Execute($sql_count);

		while($bills=$result->FetchRow())
		{
			$bill_count=$bills['count'];
		}

		$page_anz = $this->getPageCount($bill_count,$max_page_count);

		if($bill_count>$max_page_count)
		{
			$pagenr=$_REQUEST['page'];

			echo ' <td colspan="5" align="center">';
			echo '<table with="100%">';
			echo '<tr>';
			echo '<td align="right">';
			if($_REQUEST['page']>1)
			{
				$pagenr=$_REQUEST['page']-1;
				if($view=="month")
				echo '<a href="billing_tz_archive.php?back=true&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Back-> ';
				else
				echo '<a href="billing_tz_archive_date.php?back=true&day='.$day.'&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Back-> ';
			}
			echo '</td>';
			echo '<td align="left">';

			if($_REQUEST['page']!=$page_anz)
			{
				$pagenr=$_REQUEST['page']+1;
				if($view=="month")
				echo '<a href="billing_tz_archive.php?next=true&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Next-> ';
				else
				 echo '<a href="billing_tz_archive_date.php?next=true&day='.$day.'&month='.$month.'&year='.$year.'&show=Show&print=true&page='.$pagenr.'&txtsearch='.$txtsearch.'&searchtyp='.$type.'">  <-Next-> ';
			}
			echo '</td>';
			echo '<td>';
			echo '</td>';
			echo "Page: " . $_REQUEST['page'] . " / " . $page_anz;
			echo '</tr>';
			echo '</td>';
			echo '</table>';
		}

	}

	function ShowPriceList()
	{
		global $db;
		$this->debug=false;
		($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

		$result=$db->Execute('SELECT * FROM care_tz_drugsandservices_description');

		echo '<table border="0" cellpadding="0" cellspacing="0" width="200"  class="table_content" align="center" >
			<tr class="tr_content">
				<td colspan="2" align="center" bgcolor="#CC9933" ><font size="2" class="submenu_item">Select Pricelist</font></td></tr>';
		while($pricelist=$result->FetchRow())
		{
			echo'<tr><td bgcolor="#FFFF88" >'.$pricelist['ShowDescription'].' </td>
				<td bgcolor="#FFFF88"><input type="radio" name="unit_price" value="'.$pricelist['ID'].'"';  echo'></td></tr>';
		}
		echo '</table></p>';
	}

	function ShowPriceListDropDown()
        {
                global $db;
                $this->debug=false;
                ($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

                $result=$db->Execute('SELECT * FROM care_tz_drugsandservices_description');

		echo '<SELECT name="pricelist_no">';

		while($pricelist_item=$result->FetchRow())
		{

		echo '<OPTION  value="'.$pricelist_item['ID'].'">'.$pricelist_item['ShowDescription'].'</OPTION>';

		}

		echo '</SELECT>';

	}

	function getPriceDescription($price_id)
	{
		global $db;
        $this->debug=false;
        ($this->debug) ? $db->debug=FALSE : $db->debug=FALSE;

        $this->sql = "SELECT ShowDescription FROM care_tz_drugsandservices_description WHERE ID=$price_id";
		$result = $db->Execute($this->sql);


			if($row=$result->fetchRow())
			{
				return $row['ShowDescription'];
			}
			else {
				return false;
			}

	}

	function Display_Header($Title, $Title_Tag, $URL_APPEND){

		global $URL_APPEND;

		echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
	<HTML>
	<HEAD>
	<TITLE>'.$Title.' '.$Title_Tag.'</TITLE>
	<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
	<meta name="Author" content="Robert Meggle">
	<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

			<script language="javascript" >
			<!--
			function gethelp(x,s,x1,x2,x3,x4)
			{
			if (!x) x="";
			urlholder="../../main/help-router.php'.URL_APPEND.'&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
			helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
			window.helpwin.moveTo(0,0);
			}
			// -->
			</script>
	<script language="javascript" >
	<!--
	function printOut()
	{
	urlholder="<?php echo $root_path;?>modules/registration_admission/show_prescription.php?externalcall=TRUE&printout=TRUE&pn=2005500002&sid=<?php echo $sid.;?>&lang=<?php echo $lang;?>";
	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
	}
	// -->
	</script>
	<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
	<script language="javascript" src="../../js/hilitebu.js"></script>

	<STYLE TYPE="text/css">

	.table_content {
	            border: 1px solid #000000;
	}

	.tr_content {
		        border: 1px solid #000000;
	}

	.td_content {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: dotted;
	border-bottom-style: solid;
	border-left-style: dotted;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	}
	p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	}

	.headline {
	            background-color: #CC9933;
	            border-top-width: 1px;
	            border-right-width: 1px;
	            border-bottom-width: 1px;
	            border-left-width: 1px;
	            border-top-style: solid;
	            border-right-style: solid;
	            border-bottom-style: solid;
	            border-left-style: solid;
		}
	A:link  {color: #000066;}
	A:hover {color: #cc0033;}
	A:active {color: #cc0000;}
	A:visited {color: #000066;}
	A:visited:active {color: #cc0000;}
	A:visited:hover {color: #cc0033;}
	.lab {font-family: arial; font-size: 9; color:purple;}
	.lmargin {margin-left: 5;}
	.billing_topic {font-family: arial; font-size: 12; color:black;}

	</style>


	<script language="JavaScript" src="<?php echo $root_path;?>js/cross.js"></script>
	<script language="JavaScript" src="<?php echo $root_path;?>js/tooltips.js"></script>
	<div id="BallonTip" style="POSITION:absolute; VISIBILITY:hidden; LEFT:-200px; Z-INDEX:100"></div>

	</HEAD>';
		return TRUE;
	}

	function Display_Headline($Headline, $Headline_Tag, $Headline_phpTag, $Help_file, $Help_Tag){

		echo '<table cellspacing="0" class="titlebar" border=0 height="35" width="100%>
 			<tr valign=top  class="titlebar" >
            			<td bgcolor="#99ccff" ><font color="#330066"> &nbsp;&nbsp;'.$Headline.' '.$Headline_Tag.' '.$Headline_phpTag.' </font></td>
  				<td bgcolor="#99ccff" align=right> <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>';

		if($_SESSION['ispopup']=="true")
		$closelink='javascript:window.close()';
		else
		$closelink='insurance_tz.php?ntid=false&lang=$lang';

		echo '<a href="javascript:gethelp(\''.$Help_file.'\',\''.$Help_Tag.'\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a href="billing_tz.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
			</tr>
		</table>
		<table width=100% border=0 cellspacing=0 height=80%>
		<tbody class="main">
			<tr valign="middle" align="center">
				<td>';
		return TRUE;
	}

	function Display_Footer($Headline, $Headline_Tag, $Headline_phpTag, $Help_file, $Help_Tag){
		echo '</td></tr></table><table cellspacing="0" class="titlebar" border=0 height="35" width="100%>
 			<tr valign=top  class="titlebar" >
            			<td bgcolor="#99ccff" ><font color="#330066"> &nbsp;&nbsp;'.$Headline.' '.$Headline_Tag.' '.$Headline_phpTag.' </font></td>
  				<td bgcolor="#99ccff" align=right> <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>';

		if($_SESSION['ispopup']=="true")
		$closelink='javascript:window.close()';
		else
		$closelink='insurance_tz.php?ntid=false&lang=$lang';

		echo '<a href="javascript:gethelp(\' '.$Help_file.'\', \''. $Help_Tag.'\')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a href="billing_tz.php"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a></td>
			</tr>
		</table>';
		return TRUE;
	}
	function Display_Credits(){
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
		<tr>
			<td align="center">
 				<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
					<tr>
						<td><div class="copyright">
	<script language="JavaScript">
	<!--
	function openCreditsWindow() {

		urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
		creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

	}
	// -->
	</script>


	<a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> :: <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> :: <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>
						</div></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	</BODY>
	</HTML>';

		return TRUE;
	}
}
//-------------------------------------
/*
 function deduct_from_stock($prescriptions_nr,$amountt)
 {

 $res =mysql_query("select article from $this->tbl_prescriptions WHERE nr = $prescriptions_nr ");
 $r = mysql_fetch_object($res); $item =$r->article;

 $n=$amountt;
 $m = 0;
 while($n!=0)
 {
 $query = "select
 care_tz_stock_in_hand.st_in_h_id,care_tz_stock_in_hand.item_id,current_qty,item_full_description
 from care_tz_stock_in_hand,care_tz_drugsandservices where
 care_tz_stock_in_hand.item_id=care_tz_drugsandservices .item_id and
 item_full_description like '$item%' and store_id=1 order by expire_date asc limit
 $m,1";


 $result = mysql_query($query);
 $num = mysql_num_rows($result);
 $row = mysql_fetch_object($result);
 $curr_am = $row->current_qty;
 $st_id = $row->st_in_h_id;

 if($num!=0)
 {


 if($curr_am >= $n)
 {
 $query1 ="update care_tz_stock_in_hand set current_qty=current_qty-$n where
 st_in_h_id=$st_id";
 mysql_query($query1) or die(mysql_error());
 $n=0;
 }
 else
 {
 $query1 = "update care_tz_stock_in_hand set current_qty=0 where st_in_h_id=$st_id";
 mysql_query($query1) or die(mysql_error());
 $n-=$curr_am;
 $m++;
 }
 }
 else
 {
 $n=0;
 }
 }
 }
 function get_num_av($art)
 {
 $result = mysql_query("select sum(current_qty) as qty from care_tz_stock_in_hand,care_tz_drugsandservices where care_tz_stock_in_hand.item_id=" .
 "care_tz_drugsandservices.item_id and item_full_description like '$art%' " .
 "and expire_date>now()");
 $row = mysql_fetch_object($result);
 if($row->qty >0)
 {
 $num = $row->qty;
 }
 else
 {
 $num=0;
 }

 return $num;
 }
 */
?>
