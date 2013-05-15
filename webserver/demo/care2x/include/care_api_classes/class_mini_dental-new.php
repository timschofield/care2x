<?php
session_start();
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Person methods.
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Dennis Mollel (deemagics@yahoo.com)
* @version beta 2.05.1
* @copyright 2008 Dennis Mollel
* @package care_dental
*/
class dental extends Core {
	/*
	* @access private
	*/

	var $sql;
	var $pid;
	var $result;
	var $newquery;
	var $lastquery;
	var $ok;
	var $data_array;
	var $buffer;
	var $row;
	var $person=array();
	var $is_preloaded=false;
	var $cc; // count
	var $bg; // carries color
	var $viewtype; # service type


	function SelianFileExists($selian_pid){
		global $db;
		// Patch for db where the pid does not start with the predefined init
		//$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		$this->sql="SELECT selian_pid FROM $this->tb_person WHERE selian_pid=$selian_pid";
		if($this->result=$db->Execute($this->sql)){
			if($this->result->RecordCount()){
				return true;
			} else { return false; }
		} else { return false; }
	}

	function GetNewSelianFileNumber(){
		global $db;
		// Patch for db where the pid does not start with the predefined init
		//$this->sql="SELECT pid FROM $this->tb_person WHERE pid=$init_nr";
		$this->sql="SELECT max(selian_pid) as maximum FROM $this->tb_person";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
						$this->row['maximum']+1; // date('y'). '/'.
				return ($newfno=$this);
			} else { return false; }
		} else { return false; }
	}

	function GetNewDCMCFileNumber(){
		global $db;
		$this->sql="SELECT max(selian_pid) as fileno FROM care_person";
		$this->result=$db->Execute($this->sql);
		($this->row=$this->result->FetchRow())? print intval($this->row['fileno']+1) : print '';
	}

	function GetPidFromEncounter($encounter_nr) {
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT pid FROM care_encounter where encounter_nr=".$encounter_nr;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['pid']);
			} else { return false; }
		} else { return false; }
	}

	# get last encounter from pid
	function GetEncounterFromPid($pid) {
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT encounter_nr FROM care_encounter where pid=".$pid." ORDER BY encounter_nr DESC LIMIT 1";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return false; }
		} else { return false; }
	}

     // get department number

	function getDept($encounter_nr){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT current_dept_nr FROM care_encounter where encounter_nr=".$encounter_nr;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['current_dept_nr']);
			} else { return false; }
		} else { return false; }
	}

	/**
	 *
	 * Get Departments those who send a request for repair Support
	 *
	 * TECH MODULE
	 *
	 */


	function printTechDepartments(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT dept FROM care_tech_repair_job";
		$this->result=$db->Execute($this->sql);

		echo '<select name="dept" class="other">';
			while($this->row = $this->result->FetchRow()){
	        	echo '<option value="'.$this->row[0].'">'.$this->row[0].'</option>';
	        }
	   echo '</select>';
	}



	/**
	 * find file number with PID
	 */

	function GetFileNoFromPID($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT selian_pid FROM care_person where pid=".$pid;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return ( '0' ); }
		} else { return ( '0' ); }
	}

	/**
	 * find Department by Encounter
	 */

	function GetDepartment($en){
		global $db;
		$this->sql="SELECT current_dept_nr,encounter_class_nr FROM care_encounter where encounter_nr=".$en;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				if ($this->row[1]==2){
					$dx = $db->Execute('SELECT `name_short` FROM `care_department` WHERE `nr`='.$this->row[0]);
					if ($th = $dx->FetchRow()) return ($th[0]);
					else return ' discharged ';
				} else if ($this->row[1]==1){
					$dx = $db->Execute('SELECT `name` FROM `care_ward` WHERE `nr`='.$this->row[0]);
					if ($trh = $dx->FetchRow()) return ($trh[0]);
					else return ' discharged ';
				}
			} else { return ( ' discharged ' ); }
		} else { return ( ' discharged ' ); }
	}

	function CheckIn_o_Outpatient($en){
		global $db;
		$this->sql="SELECT encounter_class_nr FROM care_encounter where encounter_nr=".$en;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return $this->row[0];
			} else { return ( 1 ); }
		} else { return ( 1 ); }
	}

	/**
	 *
	 * GETS Name of a notes by using Notes_Type Number
	 *
	 */

	function GetNameOfNotesFromType($type){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name FROM care_type_notes where nr='".$type."'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return false; }
		} else { return false; }
	}

	function FindoutPatientWardStatus($encounter_nr,$out,$in){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT current_ward_nr FROM care_encounter where encounter_nr='$encounter_nr'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
			  ($this->row[0]!=0)? print $out : print $in;
			} else { return false; }
		} else { return false; }
	}



	/**
	 *
	 * Require first and last name using BatchNo
	 *
	 */

	function GetNamesFromBatchNo($bachno){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_first, name_last FROM care_person where pid=".$bachno;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return (ucfirst($this->row[1]) . ' '. ucfirst($this->row[0]));
			} else { return false; }
		} else { return false; }
	}

	/**
	 * DCMC hospital
	 * POOR FUND program insertion
	 */
	function dentalPoorFundInsert($geta){
		global $db;
		//$db->debug=TRUE;

		$items = explode('|',$geta);

		$this->sql="DELETE FROM care_tz_billing_special where encounter_nr = '$items[0]' AND billno = '$items[6]'";

		$this->Transact();

		$this->sql="INSERT INTO care_tz_billing_special SET " .
															"" .
															"encounter_nr = '$items[0]', " .
															"paid = '$items[1]', " .
															"type = '$items[2]', " .
															"total = '$items[3]', " .
															"remain = '$items[4]', " .
															"fullname = '$items[5]', " .
															"billno = '$items[6]', " .
															"dept_nr='43', " .
															"date='" . date('Y-m-d') ."'" .
															"" .
															"";
		//echo $this->sql;

		return $this->Transact();
	}

	/**
	 *
	 * SAVE NEW NOTE FOR A PATIENT
	 *
	 */

	function SaveNewPatientNote($xb2){
		global $db;

		$rex = explode('+',$xb2);

		$rex[6] = trim($rex[6]);

		if ($rex[6]!='')
			$sql="UPDATE care_encounter_notes SET " .
															"" .
															"encounter_nr = '$rex[0]', " .
															"type_nr = '$rex[1]', " .
															"short_notes = '$rex[2]', " .
															"notes = '$rex[3]', " .
															"personell_name = '$rex[4]', " .
															"date = '" . date('Y-m-d') . "', " .
															"create_id = '$rex[4]', " .
															"create_time = '". date('Y-m-d H:m:s') . "', " .
															"modify_time = '". date('Y-m-d H:m:s') . "', " .
															"history = " . "'Created: " . date('Y-m-d H:m:s') . " : " . $rex[4] . "'" .
															"WHERE nr=".$rex[6];

		else
			$sql="INSERT INTO care_encounter_notes SET " .
															"" .
															"encounter_nr = '$rex[0]', " .
															"type_nr = '$rex[1]', " .
															"short_notes = '$rex[2]', " .
															"notes = '$rex[3]', " .
															"personell_name = '$rex[4]', " .
															"date = '" . date('Y-m-d') . "', " .
															"create_id = '$rex[4]', " .
															"create_time = '". date('Y-m-d H:m:s') . "', " .
															"modify_time = '". date('Y-m-d H:m:s') . "', " .
															"history = " . "'Created: " . date('Y-m-d H:m:s') . " : " . $rex[4] . "'" .
															"";
		#echo $sql;

		return $db->execute($sql);
	}

	/**
	 * Get total amount paid for a support POORFUND program (DENTAL BILLING)
	 */

	function getDentalPoorFund($encounter_nr,$bilno){
		global $db;
		$this->sql="SELECT paid,type FROM care_tz_billing_special where encounter_nr='$encounter_nr' AND billno='$bilno'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0] . '-' . $this->row[1]);
			} else { return false; }
		} else { return false; }
	}

	/*
	 *
	 * GET ALERGY FROM A PATIENT
	 *
	 */

	 function LookForAlergy($pid){
	 	global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_others, blood_group, rh FROM care_person where pid='$pid'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				$alg = 'Patient Alergy: ';
				($this->row[0])? $alg .= '<b>' . $this->row[0].'</b>' : $alg .= '<b>' . 'None;' . '</b>';

				$blood = 'Blood Group: ';
				($this->row[1])? $blood .= '<b>' . $this->row[1] . '</b>' : $blood .= '<b>None;</b>';

				$oneline = '<div style="background-color:lime; padding:4px; width:100%">';

				$oneline .= $alg . '<hr style="border:1px solid maroon;"/>' . $blood;
				($this->row[2])? $oneline .= ' &nbsp;Rhesus: ' . '<b>'.$this->row[2].'</b>' : $oneline = $oneline;

				$oneline .= '</div>';

				echo $oneline;

			} else { return $this->sql; }
		} else { return false; }

	 }

	 function _GetAlergy($pid){
	 	global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_others, blood_group, rh FROM care_person where pid='$pid'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				$alg = '';
				($this->row[0])? $alg = $this->row[0] : $alg = 'None;';

				$blood = '';
				($this->row[1])? $blood = $this->row[1] : $blood = '';

				($this->row[2])? $rh = $this->row[2]: $rh = '';

				$r = $alg.'|'.$blood.'|'.$rh;

				return $r;

			} else { return false; }
		} else { return false; }

	 }

	 function PrintAlergyBloodRhesus($pid){
	 	global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_others, blood_group,rh FROM care_person where pid='$pid'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				$all4one = $this->row[0].'|'.$this->row[1].'|'.$this->row[2];
				return $all4one;
			} else { return $this->sql; }
		} else { return false; }

	 }


	 /**
	  *
	  * Radiology Batch No.
	  *
	  */
	function FindRadiologyBatchNo($pn){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT max(batch_nr) FROM care_test_findings_radio where encounter_nr='$pn'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row[0]);
			} else { return 'none'; }
		} else { return false; }
	}

	/**
	 *
	 * PERSONELL REGISTRATION FUNCTION
	 *
	 */

	function personelregs(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT nr,name FROM care_role_person";
		$this->result=$db->Execute($this->sql);
			while($this->row = $this->result->FetchRow()){

	        	echo '<option value="'.$this->row[0].'">'.$this->row[1].'</option>';

	        }
	}
	/**
	 *
	 *  request PID from fileno
	 *
	 */

	function GetPidFromFileNo($filenr){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT pid FROM care_person where selian_pid='$filenr'";
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				return ($this->row['pid']);
			} else { return $this->sql; }
		} else { return false; }
	}


	/**
	 *
	 * PATIENT NAME FROM PID
	 *
	 */

	function GetPatientNameFromPid($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT name_first, name_last FROM care_person where pid=".$pid;
		if($this->result=$db->Execute($this->sql)){
			if($this->row=$this->result->FetchRow()){
				echo ucfirst($this->row['name_last']) . ' ' . ucfirst($this->row['name_first']);
			} else { return false; }
		} else { return false; }
	}


	/**
	 *
	 * PRINT PATIENT HISTORY (NOTES)
	 *
	 */

	function PrintPatientNotes($pid,$note,$color1,$color2,$recs,$enno){
		global $db;
		//$db->debug=TRUE;
		$nipo = FALSE;
		$notename = '';

		$none = '';
		$cc='1';

		$MORE = ($this->viewtype==4)?' AND type_nr='.$this->viewtype:'';
		$this->sql="SELECT date, notes, create_id, short_notes, encounter_nr, type_nr, nr FROM care_encounter_notes WHERE (encounter_nr IN (SELECT encounter_nr FROM care_encounter WHERE pid = '$pid')) ".$MORE." ORDER BY encounter_nr DESC  limit 0,15";
		$this->result=$db->Execute($this->sql);

		$nb = rand(10220,500000);
		while($this->row = $this->result->FetchRow()){

 			$nipo = TRUE;

 			$printThiSs=TRUE;

 			$prowexist = '<tr style="background:yellow;" id="w'.$nb.'j9">';

			$prrow = ($cc=='1')? '<tr style="background:white;" id="w'.$nb.'j9">' : '<tr style="background:#F1F5F1;" id="w'.$nb.'j9">';

			($this->row[4] == $enno)? print $prowexist : print $prrow;

			$cc=($cc=='1')?'2':'1';

	            echo '<td valign="top">'.date('d/M/Y', strtotime($this->row[0])).'</td>';
	            echo '<td valign="top" style=" padding-bottom:15px;">';

            		if ($this->row[5]){
            				$bc = new dental;
            				$notename = $bc->GetNameOfNotesFromType($this->row[5]);

			               echo '' .
			            		'' .
			            		'<div style="border-bottom:1px dotted #ccc; padding:2px; margin-bottom:10px; width:97%; font-weight:normal; color: #359F45;">' .

			            				'<b>&curren;' . $notename . '</b>';

			            		($this->row[3])? print '<br><br><span style="color:red;"> <b>Brief: </b>'.nl2br($this->row[3]) . '</span>' : print $none;

			               echo '</div>' .
			            		'';
	            		}
	               echo '' .
	            		'<div style="width:100%;">' .
	            	  			''.nl2br($this->row[1]).'' .
	            	  	'</div>' .
	            	  	'' .
	            	  	'</td>';
		            echo '<td valign="top">'.$this->row[2].'' .
		            		'<br />' .
		            		'<br />' .
		            		'<br />' .
		            		'<br />' .
		            		'<br />' .(($this->row[4] == $enno)?
		            		'<a href="Javascript:void(0);" onclick="navigate(\''.$this->row['encounter_nr'].'&id='.$this->row['nr'].'&mode=edit&url../dental/gui_patient_history.php|'.$pid.'\', \'../dental/gui_dental_addnotes.php\')">Edit</a> ' .
		            		'| ' .
		            		'<a href="Javascript:void(0);" onclick="if (confirm(\'Remove: '.addslashes(nl2br($this->row[1])).'\')){xtarget=\'w'.$nb.'j9\'; navigate(\'&mode=remove&nr='.$this->row['nr'].'&table=care_encounter_notes&col=nr\', \'../dental/_act_.php\');  $(\'#w'.$nb.'j9\').fadeOut(); };">Delete</a>'
		            		:'').
		            		'</td>';

		          echo '</tr>';
		          $nb++;

			}// end while
	}

	/**
	 *
	 * POOR FUND BILLING PRINT REPORT
	 *
	 */


	function GetRowsFromSpecial($mnth,$yrs,$type,$ca,$cb,$action){
		global $db;
		//$db->debug=TRUE;

		$dt = $yrs . '-' . $mnth . '%';
		$cc='0';
		$toto = 0;
		$nipo = FALSE;
		$this->sql="SELECT encounter_nr,date,fullname,remain,paid,billno FROM care_tz_billing_special WHERE date like '$dt' AND type = '$type' ORDER BY encounter_nr DESC";
		$this->result=$db->Execute($this->sql);

			 echo ' </td>
					</tr>
					<tr  valign=top>
					  <td colspan="5">' .
					  '<table width="' .
					  '' .
					  '' ;

						($action == 'prnt') ? print '95%' : print '60%';

				echo  '' .
					  '' .
					  '"border="0" align="left" cellpadding="5" cellspacing="1" class="tablebg">
					    <tr class="searchtxthead" id="rowhead" valign="middle">
					      <td width="10%" height="25" nowrap>S/No</td>
					      <td width="10%" nowrap>Attendant Date </td>
					      <td width="20%" nowrap>Name</td>
					      <td width="50%" nowrap>No. of Procedures done </td>
					      <td width="10%" align="center" nowrap>Not paid</td>
					    </tr>';

			while($this->row = $this->result->FetchRow()){
				  $nipo = TRUE;

				  $billno = $this->row[5];

				  $getpid_obj = new dental;

				  $myid = $getpid_obj->GetPidFromEncounter($this->row[0]);

				  echo '<tr class="';

				  if ($cc=='0'){echo $ca; $cc='1';} else{echo $cb; $cc='0';}

				  echo '" valign="top">';
			      echo '<td nowrap>'. $myid .'</td>'; //
			      echo '<td nowrap>'. $this->row[1] .'</td>';
			      echo '<td nowrap>'. nl2br($this->row[2]) .'</td>';
			      echo '<td nowrap>';

			      $this->totorows=$db->Execute("SELECT nr FROM care_tz_billing_archive_elem WHERE nr = '$billno'");

				  $this->tt = $this->totorows->FetchRow();

				  $ennoz=$this->row[0];

			      if ($this->tt[0]>0){


						$this->rr=$db->Execute("SELECT description, price, amount FROM care_tz_billing_archive_elem WHERE nr = '$billno'");

								echo '<table width="100%" border="0" align="right" cellpadding="4" cellspacing="1">';

									$counttoto = 0;

									while($this->mm = $this->rr->FetchRow()){

											echo '<tr valign="top" style="font:normal 12px Tahoma, monospace; color:black; ">';

												echo '<td align="left" style="border-bottom:1px dotted #F2F2F2; " nowrap> ' . $this->mm[0] .' </td>';

												echo '<td align="right" style="border-bottom:1px dotted #F2F2F2; "> ' . ($this->mm[1]*$this->mm[2]) .'.00 </td>';

												$counttoto += intval($this->mm[1]*$this->mm[2]);

											echo '</tr>';


									}

							   echo '   <tr style="font:normal 12px Tahoma, monospace; color:black; ">
								  			<td width="70%" align="right" valign="middle"><strong>Grand Total:</strong></td>
										    <td width="30%" align="right" valign="middle" bgcolor="#FFFFFF" style="border-bottom:1px solid #F2F2F2; border-top:1px solid #F2F2F2;">' .
										    	'<strong>'  .
										    	$counttoto  .
										    	'.00' .
										    	'</strong>' .
									    	'</td>
									  </tr>';
							   echo '   <tr style="font:normal 12px Tahoma, monospace; color:black; ">
								  			<td width="70%" align="right" valign="middle"><strong>Total Paid:</strong></td>
										    <td width="30%" align="right" valign="middle" bgcolor="#FFFFFF" style="border-bottom:1px solid #F2F2F2; border-top:1px solid #F2F2F2;">' .
										    	'<strong>'  .
										    	  $this->row[4].
										    	'.00' .
										    	'</strong>' .
									    	'</td>
									  </tr>
									</table>';
									$showme='yes';

			      			}

							//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

							else {
									echo 'no description found'; //  ???????????????????????????????????????????????????
									$showme='no';
									}


				  echo '</td>';
			      echo '<td align="right" valign="bottom">' .
			      			'<div style="width:100%;padding-bottom:3px; border-bottom:1px solid #F2F2F2; font-weight:bold;">' .
			      			'' ;

			      			($showme == 'yes')? print $this->row[3] : print '0';

			      			($showme == 'no')?  $toto=$toto : $toto += $this->row[3];

			      	   echo '.00</div></td>' .
			      			'' .
			      			'';
			      echo '</tr>';

			      $showme = 'yes';

			}




		if (intval($toto)!=0){
					 echo '<tr class="';
					 	if ($cc=='0'){echo $ca;} else{echo $cb;}
					 echo '"  style="text-align:right;font:bold 12px Tahoma,Monospace;">';
					 echo '<td colspan="4">Total: </td>';
					 echo '<td>'. $toto .'.00</td>';
					 echo '</tr></table>';
				  }

		else {
					 echo '<tr class="';
					 	if ($cc=='0'){echo $ca;} else{echo $cb;}
					 echo '">';
					 echo '<td colspan="5" align="center">No Record Found</td>';
					 echo '</tr></table>';
			}
	}





/*
 * DAYLY COST REPORTS  designed by D.Mollel from softweb
 * dennis.mollel@yahoo.com
 *
 */

	function GetRowsFromCosting($mnth,$yrs,$type,$ca,$cb,$action){
		global $db;
		//$db->debug=TRUE;

		$cc='0';
		$toto = 0;
		$nipo = FALSE;


       $watu      =     0  ;
       $Tinc       =   0   ;
       $Tcosts      = 0    ;
       $TavIncome  =   0   ;
       $TavCost   =     0  ;

	   $numdays = cal_days_in_month(CAL_GREGORIAN, $mnth, $yrs);

	   echo ' </td>
				</tr>
				<tr  valign=top align="center">
				  <td colspan="5">' .
				  '<table width="' .
				  '' .
				  '' ;
				  ($action == 'prnt') ? print '95%' : print '60%';
			echo  '' .
				  '' .
				  '"border="0" align="left" cellpadding="5" cellspacing="1" class="tablebg">
				    <tr class="searchtxthead" id="rowhead" valign="middle">
				      <td width="10%" height="25" nowrap>Date</td>
				      <td width="10%" nowrap>Attendants </td>
				      <td width="20%" nowrap>Total Income</td>
				      <td width="20%" nowrap>Total Costs </td>
				      <td width="20%" nowrap>Average Income</td>
				      <td width="20%" nowrap>Average Cost</td>
				    </tr>';

		$loly = 1;
		while ($loly<$numdays){
			$income = 0;
			$cost = 0;
			$costs = 0;

			$dt = $yrs . '-' . $mnth . '-' . $loly;

			if ($cc=='0'){$cc='1';} else{$cc='0';}

			$this->sql='SELECT `encounter_nr`,`article_item_number`,`dosage`,`price`  FROM `care_encounter_prescription` WHERE `bill_status` = "archived" AND `prescribe_date` = "'.$dt.'" ORDER BY encounter_nr ASC ';
			$this->result=$db->Execute($this->sql);
			$this->sql='SELECT DISTINCT(`encounter_nr`)  FROM `care_encounter_prescription` WHERE `bill_status` = "archived" AND `prescribe_date` = "'.$dt.'" ORDER BY encounter_nr ASC ';
			$this->newquery=$db->Execute($this->sql);
			$patients = $this->newquery->RecordCount();
			while($this->row = $this->result->FetchRow()){
				  $this->sql = 'SELECT `unit_cost` FROM `care_tz_drugsandservices` WHERE `item_id` = '.$this->row[1];
				  $this->lastquery=$db->Execute($this->sql);
				  if ($vx = $this->lastquery->FetchRow()) $cost = $vx[0];
				  else $cost = 0;

				  $costs += $this->row[2]  * $cost;         # dosage * cost
				  $income += $this->row[2] * $this->row[3]; # dosage * price
			}

			$avIncome = $income/$patients; # income/total number of patients per date
			$avCost = $costs/$patients;    # toto cost/toto number of patient per date


		 echo '<tr class="';
		 	if ($cc=='0'){echo $ca;} else{echo $cb;}
		 echo '"  style="text-align:right;font:bold 12px Tahoma,Monospace;">
		      <td align="left" nowrap>'.date('dS/m/Y',strtotime($dt)).'</td>
		      <td nowrap>'.$patients.'</td>
		      <td nowrap>'.number_format($income,2).'</td>
		      <td nowrap>'.number_format($costs,2).'</td>
		      <td nowrap>'.number_format($avIncome,2).'</td>
		      <td nowrap>'.number_format($avCost,2).'</td>' .
		     '</tr>';

		     $watu += $patients;
		     $Tinc += $income;
		     $Tcosts +=$costs;
		     $TavIncome += $avIncome;
		     $TavCost += $avCost;

		$loly++;
		}

		 echo '<tr class="total">
		      <td nowrap>Total:</td>
		      <td nowrap>'.$watu.'</td>
		      <td nowrap>'.number_format($Tinc,2).'</td>
		      <td nowrap>'.number_format($Tcosts,2).'</td>
		      <td nowrap>'.number_format($TavIncome,2).'</td>
		      <td nowrap>'.number_format($TavCost,2).'</td>' .
		     '</tr>';
		print '</table>';
	}










	/**
	 *
	 * GENERATE IMAGE FOR A PATIENT NOTES ICON
	 *
	 */

	function CreateIconNotesForPatient($pid){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT create_id FROM care_encounter_notes WHERE encounter_nr IN (SELECT encounter_nr FROM care_encounter WHERE pid = '$pid') ORDER BY encounter_nr DESC  limit 0,1";
		$this->result=$db->Execute($this->sql);

		($this->row = $this->result->FetchRow())?

		print 'gui/img/common/default/history1.gif"  ' .
			  'title="View Patient History &raquo;" border="0"' // if patient Notes exists

						:

		print 'gui/img/common/default/history.gif"' . // if no notes exists for a patient
			  ' title="No history, Enter Patient Notes now &raquo;" border="0"';


	}


	/**
	 *
	 * PATIENT NOTE TYPE
	 * for selection menu (dropdown)
	 *
	 */

	function GetTypesOfNotes(){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT nr,name FROM care_type_notes where status not in ('hidden') order by sort_nr;";
		$this->result=$db->Execute($this->sql);

		echo '<select name="types">';
			while($this->row = $this->result->FetchRow()){
	        	echo '<option value="'.$this->row[0].'"';
	        		($this->row[0] == '2')? print ' selected ' : print ' '; //preselect doctor's daily notes
	        	echo '>'.$this->row[1].'</option>';
	        }
        echo '</select>';
	}

	/**
	 *
	 * check if Technical support Request was replied
	 *
	 */
	function CheckItHasReply($dpt){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT * FROM care_tech_repair_done where dept = '$dpt'";
		$this->result=$db->Execute($this->sql);
		if($this->row=$this->result->FetchRow()){
			return $this->row[0];
		} else { return (''); }
	}

	/**
	 *
	 * 	PRINT SEARCH RESULT FROM TECH MODULE
	 *
	 */

	function PrintTechSearchedRows($m, $y){
		global $db;
		//$db->debug=TRUE;
		$dt = $y . '-' . $m . '-%';
		$this->sql="SELECT tdate, dept, job, reporter FROM care_tech_repair_job where tdate like '$dt'";
		$this->result=$db->Execute($this->sql);

		$cc='1';
		$ys = 'Yes';
		$ns = '<a href="../tech/technik-reparatur-melden.php?sid=&ntid=false&lang=en" title ="Click here to reply this &raquo;">Reply</a>';

		$wapo = '';

		$nipo=FALSE;

			while($this->row = $this->result->FetchRow()){

			($cc=='1')? $prrow = '<tr style="background:white;">' : $prrow = '<tr style="background:#F1F5F1;">';

			($cc=='1')? $cc='2' : $cc = '1';

				  echo  $prrow;
				  echo '  <td align="center" valign="top"> '             .  date('d/m/Y', strtotime($this->row[0])) .            ' </td>';
				  echo '  <td align="left" valign="top"> '               .  $this->row[1] .            ' </td>';
				  echo '  <td align="left" valign="top"> '               .  nl2br($this->row[2]) .     ' </td>';
				  echo '  <td align="center" valign="top"> '             .  $this->row[3] .            ' </td>';

				  $obb = new person;

				  $wapo = $obb -> CheckItHasReply($this->row[1]);

				  echo '  <td align="center" valign="top">';

				    ($wapo != '') ?  print '<a href="#"' .
				    								   'onclick="window.open(\'../reporting_tz/gui/gui_tech_replies_result_dcmc.php?dp='.

				    								   $this->row[1] .

													   '\',\'freed\',\'scrolbars=yes,width=500,height=600\');"> ' .

				    								   $ys . ' </a>'

				    								   :

				    								   Print $ns;

				    echo '</td>';


				  echo '</tr>';

	        } // end while

	}  //  end function


	/**
	 *
	 * Print Replies for the Specified type of Problem
	 *
	 */

	function PrintRepliedReports($dpt){
		global $db;
		//$db->debug=TRUE;
		$this->sql="SELECT tdate, reporter, job  FROM care_tech_repair_done where dept = '" . $dpt . "'";
		$this->result=$db->Execute($this->sql);

		$nipo = '';

		echo '<table border="0" align="center" cellpadding="3" cellspacing="1" class="tbd">
			  <tr class="footer" id="rowhead">
			    <td height="25" colspan="2" align="center"><span class="searchhead">' .
			    		'' .
			    		'' .
			    		'Replies for: ' .
			    		'' .
			    		'<u>' .
			    		'' .
			    		'' . $dpt .
			    		'' .
			    		'</u>' .
			    		'' .
			    		'</span></td>
			  </tr>';

			while($this->row = $this->result->FetchRow()){

					 ($nipo!='yes')? print '' : print '<tr class="whiterow"><td height="20" colspan="2" align="right" valign="top">&nbsp;</td></tr>';

					 echo ' ' .
					 		'<tr class="whiterow">
							    <td align="right" valign="top">' .
							    '' .
							    'Date:' .
							    '' .
							    '</td>
							    <td width="295" align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . date('d/m/Y', strtotime($this->row[0])) .
							    '' .
							    '</td>
							</tr>' .
							'' .
							'
							<tr class="whiterow">
							    <td align="right" valign="top">' .
							    '' .
							    'Technician:' .
							    '' .
							    '</td>
							    <td align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . $this->row[1] .
							    '' .
							    '</td>
							</tr>' .
							'' .
							'
							<tr class="whiterow">
							    <td height="71" align="right" valign="top">' .
							    '' .
							    'Descriptions:' .
							    '' .
							    '</td>
							    <td align="left" valign="top" class="colorrow">' .
							    '' .
							    '' . nl2br($this->row[2]) .
							    '' .
							    '</td>
							</tr>';

			  $nipo = 'yes';

			}


		($nipo == 'yes') ? print '' : print '<tr class="whiterow"><td height="20" colspan="2" align="right" valign="top">No record Found </td></tr>';

		echo '<tr class="footer">
			    <td colspan="2">****END****</td>
			  </tr>
			</table>';

	}



	 /***************************************************
	  *                                                 *
	  *             END OF EDITION PART                 *
	  *                                                 *
	  ***************************************************/



	/**
	* Database transaction. Uses the adodb transaction method.
	* @access private
	*/
	function Transact($sql='') {

	    global $db;
        if(!empty($sql)) $this->sql=$sql;

        $db->BeginTrans();
        $this->ok=$db->Execute($this->sql);
        if($this->ok) {
            $db->CommitTrans();
			return true;
        } else {echo 'DEBUG: '.$this->sql;
	        $db->RollbackTrans();
			return false;
	    }
    }

}
?>