<?php
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');


/**
*  Insurance methods for tanzania (the product-module is completely rewritten by Robert Meggle)
* Remark RM: The class_tz_inurance is really confusion so I hope that this will be more clear...
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle (Version 1.0.0) - alexander.irro@merotech.de
* @copyright 2006 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Insurance_Reports_tz extends Insurance_tz {

	var $sql="";
	var $tbl_content_bgcolor_1="ffffaa";
	var $tbl_content_bgcolor_2="ffffee";

  // Constructor
  function Insurance_Reports_tz() {
    return TRUE;
  }

  /*
  * functional part
  */

  function GetCompanyList() {
  	global $db;
  	$this->sql ="";
  }

  function GetPrepaidList() {

	global $db;

	$this->sql ="select
					Company.id,
					Company.name,
					Company.contact,
					Company.po_box,
					Company.city,
					Company.prepaid_amount,
					Insurance.start_date,
					Insurance.end_date
				from care_tz_company Company
					LEFT JOIN care_tz_insurance Insurance
						ON Insurance.company_id = Company.id
				WHERE Insurance.parent=-1";
	return TRUE;
	}

  /*
   * Display Methods
   */


  function Display_ReportTable_Head($BGCOL='#99ccff') {
  	/*
  	 * Definition of a stadardized table, the ampunt of parameters gives a html output of the
  	 * given parameters in a standard way... returns FALSE when there is something wrong.
  	 */


	$this->debug=FALSE;

	if ($this->debug) echo "Display_ReportTable_Head($BGCOL='#99ccff') : ".func_num_args();

  	if (func_num_args()>=2) {

	  	echo '<tr bgcolor="'.$BGCOL.'">';

	    for ($i=1 ; $i<= (func_num_args()) ; $i++) {
	    	echo '<th>';
	    	echo func_get_arg($i);
			echo '</th>';
	    } // end of for ($i=0 ; $i<= (func_get_args()-1) ; $i++)

		echo '</tr>';

		return TRUE;
  	} // end of if (func_get_args()>=2)

	if ($this->debug) echo "Output error, maybe wrong parameters? <br>";
  	return FALSE;
  }

  function Dispaly_ReportPrepaidContent($year){
  	global $db;
	$this->debug = FALSE;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
	$this->sql ="SELECT id, name, prepaid_amount FROM care_tz_company";
	$this->result=$db->Execute($this->sql);

	$BGswitch=FALSE;

	// show the content out of the sql-queryresult
	while ($this->row=$this->result->FetchRow()) {

		// Switch the background color
		if ($BGswitch) {
			$BGswitch=FALSE;
			echo '<tr bgcolor='.$this->tbl_content_bgcolor_1.'>';
		} else {
			$BGswitch=TRUE;
			echo '<tr bgcolor='.$this->tbl_content_bgcolor_2.'>';
		} // end of if ($BGswitch)

		// show the name of the company
		echo '<td>'.$this->row['name'].'</td>';

		$prepaid_amount = $this->row['prepaid_amount'];
		$number_of_members = $this->GetNumberOfMembers($this->row['id'],$year);
		$to_pay = $number_of_members * $prepaid_amount;

		// sho the given prepaid amount for that company
		echo '<td align="right">'.number_format($prepaid_amount).'&nbsp;</td>';
		echo '<td align="right">'.$number_of_members.'</td>';
		echo '<td align="right">'.number_format($to_pay).'&nbsp;</td>';
		echo '</tr>';
	} // end of while ($this->res=$this->request->FetchRow())
  }

  function Display_ReportCeiling($year) {
  	global $db, $root_path;

	$this->debug = FALSE;
	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

	// Get a list of all companies:
	$this->sql ="SELECT id, name, prepaid_amount FROM care_tz_company";
	$this->result=$db->Execute($this->sql);

	// Get a list(=array) of these companies having a vaild contract for the given time period:
	//$my_company_array=$this->GetCompanylistWithValidContracts();

	$BGswitch=TRUE;

	// show the content out of the sql-queryresult
	if ($this->result) {
		while ($this->row=$this->result->FetchRow()) {

			// assign the company's id we're currently working out:
			$company_id=$this->row['id'];
//echo ($this->is_poor_people_company($company_id)) ? "ist poor people" : "nee, is keine";
			// when there is something to be invoiced, prepare the variable for it:
			$bill_amount=0;
			// We don't know if that company does have members: So set as default that we don't have:
			$MEMBERS=FALSE;

			// Switch the background color
			if ($BGswitch) {
				$BGswitch=FALSE;
				echo '<tr bgcolor='.$this->tbl_content_bgcolor_1.'>';
			} else {
				$BGswitch=TRUE;
				echo '<tr bgcolor='.$this->tbl_content_bgcolor_2.'>';
			} // end of if ($BGswitch)


			$number_of_members = $this->GetNumberOfMembers($company_id,$year);
			$maximum_amount = $this->GetMaximumCeilingForCompany($company_id, $year);
			$used_amount = $this->GetUsedAmountForCompany($company_id, $year);
			$difference = $maximum_amount - $used_amount;
			// Show the company name in bold letters if it has an valid contract, if not,
			// show it italic:
			//if (array_search($this->row['id'],$my_company_array)) {

			if ($number_of_members > 0) {
	    		echo '<td><b>'.$this->row['name'].'</b></td>';
	    		$MEMBERS=TRUE;
			} else {
	    		echo '<td><i>'.$this->row['name'].'</i></td>';
	    		$MEMBERS=FALSE;
			} // end of if ($number_of_members)

			// show the given prepaid amount for that company
			echo '<td align="right">'.$number_of_members.'&nbsp;</td>';
			echo '<td align="right">'.number_format($maximum_amount).'</td>';
			echo '<td align="right">'.number_format($used_amount).'&nbsp;</td>';
			// if the difference is negative (company has to pay) show it red:
			if ($difference >= 0 )
				echo '<td align="right">'.number_format($difference).'&nbsp;</td>';
			else
				echo '<td align="right" ><font color="red">'.number_format($difference).'</font>&nbsp;</td>';
			echo '</tr>';

			// Debug output:
			if ($this->debug) echo ($number_of_members>0) ? "This company has members for the year $year" : "This company has no members for the year $year";

			// Does this company have members for the specific time range?
			if ($number_of_members > 0) {


				// show the members attached to this company for this year:
				echo '<tr>';
				echo '<td colspan="5">';
				echo '<table border="1" cellspacing="0" align="right" width="80%">';

				$memberlist = $this->GetMembersOfCompany($company_id, $year);

				if ($this->is_poor_people_company($company_id)) {

					$this->Display_ReportTable_Head('#A8A00','Assignments (total)','Used Insurance(TSH)');

					while (list($u,$v) = each($memberlist)) {
							$used_amount=$v[4];
							echo '<tr>';
							echo '<td align="right">'.$v[2].'&nbsp;</td>';
							echo '<td align="right">'.number_format($used_amount).'&nbsp;</td>';

							echo '</tr>';
							echo '<tr>';
							echo '<td colspan="6">';
							echo '<table border="1" cellspacing="0" align="right" width="50%">';
							echo '<tr bgcolor="red"><td align="right"><b>Total amount: </b></td><td align="right"><b>'.number_format($used_amount).'</b></td><td>TSH</td></tr>';
							echo '</table><td></tr>';
					} // end of while (list($u,$v) = each($memberlist))

				} else {

					$this->Display_ReportTable_Head('#A8A00','Name','Hospital PID','Serv. got for: (TSH)','Used Insurance(TSH)','balance','ceiling');

					while (list($u,$v) = each($memberlist)) {
							echo '<tr>';
							echo '<td align="right">'.$v[0].'&nbsp;'.$v[1].'&nbsp;</td>';
							echo '<td align="right">'.$v[2].'&nbsp;</td>';
							echo '<td align="right">'.number_format($v[3]).'&nbsp;</td>';
							echo '<td align="right">'.number_format($v[4]).'&nbsp;</td>';
							$used_amount=$v[5]-$v[4];
							if ($used_amount>=0) {

								echo '<td align="right">'.number_format($used_amount).'&nbsp;</td>';

							} else {

								echo '<td align="right"><font color="red">'.number_format($used_amount).'&nbsp;</font></td>';
								$SHOW_BILL_AMOUNT=TRUE;
								$bill_amount += $used_amount*(-1);

							} // end of if ($used_amount>=0)
							echo '<td align="right">'.number_format($v[5]).'&nbsp;</td>';
							echo '</tr>';

							// check if there is something what we can bill:
							if ($bill_amount>0) {
								// yes we can, so show it:
								echo '<tr>';
								echo '<td colspan="6">';
								echo '<table border="1" cellspacing="0" align="right" width="50%">';
								echo '<tr bgcolor="red"><td align="right"><b>Total amount: </b></td><td align="right"><b>'.number_format($bill_amount).'</b></td><td>TSH</td></tr>';
								echo '</table><td></tr>';
							} // end of if ($bill_amount)
					} // end of while (list($u,$v) = each($memberlist))
				} // end of if ($this->is_poor_people_company($company_id))
				echo '</table><td></tr>';
			} // end of if ($number_of_members...)
		} // end of while ($this->res=$this->request->FetchRow())
	} // end of if ($this->result)
  } // end of function Display_ReportCeiling

  function Display_Selectbox_Years($VALUE_NAME, $SUBMIT_NAME,$SELECTED_YEAR=0){
  	$current_year=date(Y); // get the current year

  	if (empty($SELECTED_YEAR)) // if there is no attribute given take the current year
  		$SELECTED_YEAR=$current_year;

  	echo '<select name="'.$VALUE_NAME.'" size="1">';

  	for ($i=$current_year-2; $i<=$current_year+1; $i++) {
  		echo ($i==$SELECTED_YEAR) ? '<option value="'.$i.'" selected >'.$i.'</option>' : '<option value="'.$i.'">'.$i.'</option>';
  	} // end of for ($i=$current_year-2; $i<=$current_year; $i++)

  	echo '</select>';
  	echo '<input type="submit" name="'.$SUBMIT_NAME.'" value="'.$SUBMIT_NAME.'">';

  } // end of function Display_Selectbox_Years()

} // end of Method
