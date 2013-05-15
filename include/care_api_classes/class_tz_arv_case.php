<?php
require_once($root_path.'include/care_api_classes/class_person.php');

/**
*  ARV methods for tanzania (the product-module is completely rewritten by Dorothea Reichert)
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Dorothea Reichert (Version 1.0.0) - dorothea.reichert@merotech.de
* @copyright 2006 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/

/*
Class Structure:

Class Core
    |
    `---> Class Person
              |
              `--->Class ARV_case
*/
class ARV_case extends Person {

	// Properties

	var $arv_facility_data=array(
    					   'main_info_facility_name',
    					   'main_info_facility_code',
    					   'main_info_facility_district');

	var $arv_patient_data=array(
    					   'care_tz_arv_case_id',
                           'arv_pid',
                           'datetime_first_hivtest',
                           'datetime_start_arv',
                           'village',
                           'street',
                           'district',
                           'balozi',
                           'chairman_of_village',
                           'head_of_family',
                           'name_of_secretary',
                           'secretary_phone',
                           'secretary_adress',
                           'create_time',
                           'create_id',
                           'modify_id');

	var $res;
    var $sql;
    var $row_elem;
    var $debug;
    var $ok;
    var $error_message;
    var $msg_tpl = "<div class=\"error\">%s</div>";
    var $msg_tpl_big ="<table class=\"mainTable\"><tr><td class=\"error2\">%s</td></tr></table>";

    // Constructor
  	function ARV_case($pid) {
  		$this->ok=true;
		if(empty($pid)){
  			$this->error_message['pid']=sprintf($this->msg_tpl_big,"No patient selected!");
  			$this->ok=false;
  		}
  		parent::Person($pid);
  	}

//------------------------------------------------------------------------------------------------------------------
  	 // Methods:

  	function isOK() {
  		return $this->ok;
  	}

  	function getFacilityInfo() {
  	//reads the information out of the DB that are entered inside the ARV Administration
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	    $this->sql="SELECT TYPE , value
					FROM care_config_global
					WHERE TYPE = 'main_info_facility_name'
					OR TYPE = 'main_info_facility_code'
					OR TYPE = 'main_info_facility_district'
					";

		if($this->res = $db->Execute($this->sql)) {
			if($this->res->RecordCount()) {
				while ($this->row_elem = $this->res->FetchRow()) {
					$temp=$this->row_elem[0];
					$this->arv_facility_data[$temp]=$this->row_elem[1];;
				}
				return $this->arv_facility_data;
			}
		}
		else { return false; }
	}

	function getTelephoneCombined() {
	// combine all telephone numbers entered inside the registration to one string
		($this->getValue('phone_1_nr')) ? $tel=$this->getValue('phone_1_nr')."; " : $tel="";
		($this->getValue('phone_2_nr')) ? $tel.=$this->getValue('phone_2_nr')."; " : $tel="";
		($this->getValue('cellphone_1_nr')) ? $tel.=$this->getValue('cellphone_1_nr')."; " : $tel="";
		($this->getValue('cellphone_2_nr')) ? $tel.=$this->getValue('cellphone_2_nr')."" : $tel="";

		return $tel;
	}

	function getPatientARVData() {
  		global $db;
  		$tehis->debug=FALSE;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;

    	$this->sql="SELECT
						care_tz_arv_case_id,
						datetime_first_hivtest,
						datetime_start_arv,
						arv_pid,
						district,
						village,
						street,
						balozi,
						chairman_of_village,
						head_of_family,
						name_of_secretary,
						secretary_phone,
						secretary_adress,
						create_time
					FROM care_tz_arv_case
					WHERE
						pid=".$this->pid;

		if ($this->res = $db->Execute($this->sql) AND $this->arv_patient_data=$this->res->FetchRow()) {
	  		return $this->arv_patient_data;
	  	}
	  	else {
	  		return false;
  		}
  	}
//------------------------------------------------------------------------------------------------------------------------------------------------
	function setARVdata($values) { $this->arv_patient_data=$values; }
//------------------------------------------------------------------------------------------------------------------------------------------------
	function getARVcaseID() { return $this->arv_patient_data['care_tz_arv_case_id'];}
//------------------------------------------------------------------------------------------------------------------------------------------------
	function updateARVdata($values) {
  		global $db,$date_format;
    	$this->debug=false;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	$this->setARVdata($values);
    	$this->arv_patient_data['modify_id']=$_SESSION['sess_login_userid'];
    	$this->sql="UPDATE care_tz_arv_case
					SET datetime_first_hivtest='".formatDate2STD($this->arv_patient_data['datetime_first_hivtest'],$date_format)."',
						datetime_start_arv='".formatDate2STD($this->arv_patient_data['datetime_start_arv'], $date_format)."',
						arv_pid=".$this->arv_patient_data['arv_pid'].",
						district='".$this->arv_patient_data['district']."',
						village= '".$this->arv_patient_data['village']."',
						street= '".$this->arv_patient_data['street']."',
						balozi= '".$this->arv_patient_data['balozi']."',
						chairman_of_village='".$this->arv_patient_data['chairman_of_village']."',
						head_of_family='".$this->arv_patient_data['head_of_family']."',
						name_of_secretary='".$this->arv_patient_data['name_of_secretary']."',
						secretary_phone='".$this->arv_patient_data['secretary_phone']."',
						secretary_adress='".$this->arv_patient_data['secretary_adress']."',
						history=".$this->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$this->arv_patient_data['modify_id'].";\n").",
						modify_id='".$this->arv_patient_data['modify_id']."'
                    WHERE pid=".$this->pid;

    	if(!Core::Transact($this->sql)) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
			return false;
		}
		return true;
  	}
//------------------------------------------------------------------------------------------------------------------------------------------------
  	function insertARVdata($values) {
  		global $db,$date_format;
    	$this->debug=false;
    	($this->debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	$this->setARVdata($values);
    	$this->arv_patient_data['create_id']=$_SESSION['sess_login_userid'];
    	$this->sql="INSERT INTO care_tz_arv_case (
	                    care_tz_arv_case_id,
	                    pid,
	                    datetime_first_hivtest,
	                    datetime_start_arv,
	                    arv_pid,
						district,
						village,
						street,
	                    balozi,
	                    chairman_of_village,
	                    head_of_family,
	                    name_of_secretary,
	                    secretary_phone,
	                    secretary_adress,
	                    history,
						create_id,
	                    create_time,
	                    modify_id,
	                    modify_time)
                    VALUES(
						null,
						".$this->pid.",
						'".formatDate2STD($this->arv_patient_data['datetime_first_hivtest'],$date_format)."',
                        '".formatDate2STD($this->arv_patient_data['datetime_start_arv'],$date_format)."',
						".$this->arv_patient_data['arv_pid'].",
						'".$this->arv_patient_data['district']."',
						'".$this->arv_patient_data['village']."',
						'".$this->arv_patient_data['street']."',
                        '".$this->arv_patient_data['balozi']."',
						'".$this->arv_patient_data['chairman_of_village']."',
						'".$this->arv_patient_data['head_of_family']."',
						'".$this->arv_patient_data['name_of_secretary']."',
						'".$this->arv_patient_data['secretary_phone']."',
						'".$this->arv_patient_data['secretary_adress']."',
						'Created ".date('Y-m-d H:i:s')." ".$this->arv_patient_data['create_id'].";\n',
						'".$this->arv_patient_data['create_id']."',
						".time().",
						null,
					    null)";

		if(!Core::Transact($this->sql)) {
			if ($db->ErrorNo()==1062) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"A patient with this ID is already registered");
			}
			else {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Insert failed");
			}
			return false;
		}
		return true;
  	}
//------------------------------------------------------------------------------------------------------------------------------------------------
	function addARV_visit() {
  		$this->a_arv_visits[$this->arv_patient_data['arv_pid']]=&new ARV_visit();
  	}
//------------------------------------------------------------------------------------------------------------------------------------------------

	function is_arv_admitted($pid) {
	// check if a patient is already registered to the ARV programme
		global $db;

		$debug=FALSE;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $sql="SELECT * from care_person, care_tz_arv_case, care_encounter
			  WHERE care_tz_arv_case.pid=care_person.pid
			  AND care_person.pid=$pid";

	    return ($rs=$db->Execute($sql) AND $rs->FetchRow()) ? true : false;
	}

//------------------------------------------------------------------------------------------------------------------------------------------------
	function getAllARVvisits() {
		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	    $this->sql="SELECT
						care_tz_arv_visit_id,
						create_time,
						encounter_nr
					FROM care_tz_arv_visit
					WHERE care_tz_arv_case_id=".$this->arv_patient_data['care_tz_arv_case_id'].";
					";

		if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
		}
		else {
			return false;
		}

	}

	function displayAllARVvisits() {
		global $db,$root_path, $date_format;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->res = $this->getAllARVvisits();
		$color_change=false;
		$table_string="<table align=\"center\" class=\"mainTable\" width=\"764\">\n";
    	$count=1;
    	if(!$this->res) return false;
    	if(!($this->res->RecordCount())) {return false;}
    	while ($this->row_elem = $this->res->FetchRow()) {

	    	if ($color_change) {
		        $BGCOLOR='bgcolor="#F0F5FF"';
		        $color_change=FALSE;
	     	} else {
		        $BGCOLOR='bgcolor="#99ccff"';
		        $color_change=TRUE;
	      	}

			$table_string.="<tr>";
			$table_string.="<td width=\"10\"  $BGCOLOR class=\"blue\">$count</td>";
	    	$table_string.="<td width=\"19\"  $BGCOLOR ><img src=\"$root_path/gui/img/common/default/eyeglass.gif\" width=\"17\" height=\"17\"></td>";
	   		$table_string.="<td width=\"534\" $BGCOLOR class=\"blue\">".formatDate2Local(date("Y-m-d H:i",$this->row_elem['create_time']),$date_format)."</td>";
	    	$table_string.="<td width=\"97\"  $BGCOLOR><a class=\"blue\" href=\"javascript:printOut('arv_print.php".URL_APPEND."&arv_visit_id=".$this->row_elem['care_tz_arv_visit_id']."&encounter_nr=".$this->row_elem['encounter_nr']."&mode=edit&pid=".$this->pid."')\">print&gt;&gt;</a></td>";
	    	$table_string.="<td width=\"102\" $BGCOLOR><a class=\"blue\" href=\"arv_visit.php".URL_APPEND."&arv_visit_id=".$this->row_elem['care_tz_arv_visit_id']."&encounter_nr=".$this->row_elem['encounter_nr']."&mode=edit&pid=".$this->pid."\">edit&gt;&gt;</a></td>";
	  		$table_string.="</tr>";

	  		$count++;
    	}
		$table_string.="</table>";
		return $table_string;
	}

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	function displayARVData() {
	//method for dislaying a table with Patient's registration data
		global $date_format;
		if(!$this->getFacilityInfo()) {
			echo "<b>No Facility Info given. Please go to System Admin->System Admin->Facility Information and give the basic information for your hospital</b><br>";
		}
		if(!$this->getPatientARVData()) return false;

		$table_string="<table class=\"mainTable\"  >
						  <tr>
						    <td class=\"tablebackground\"><span class=\"blue\">Facility&nbsp;Name:&nbsp;</span>".$this->arv_facility_data['main_info_facility_name']."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Code:&nbsp;</span>".$this->arv_facility_data['main_info_facility_code']."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">District:&nbsp;</span>".$this->arv_facility_data['main_info_facility_district']."</td>
						  </tr>
						  <tr>
						    <td class=\"tablebackground\"><span class=\"blue\">ARV-ID:&nbsp;</span>".$this->arv_patient_data['arv_pid']."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Firstname:&nbsp;</span>".$this->getValue('name_first')."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Lastname:&nbsp;</span>".$this->getValue('name_last')."</td>
						  </tr>
						  <tr>
						    <td class=\"tablebackground\"><span class=\"blue\">Date&nbsp;of&nbsp;Birth:&nbsp;</span>".formatDate2Local($this->getValue('date_birth'),$date_format)."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Sex:&nbsp;</span>".$this->getValue('sex')."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Simu&nbsp;ya&nbsp;Mgonjwa:&nbsp;</span>".$this->getTelephoneCombined()."</td>
						  </tr>
						  <tr>
						    <td colspan=\"2\" class=\"tablebackground\"><span class=\"blue\">Year&nbsp;if&nbsp;1st&nbsp;pos&nbsp;HIV-test:&nbsp;</span>".formatDate2Local($this->arv_patient_data['datetime_first_hivtest'],$date_format)."</td>
						    <td class=\"tablebackground\"><span class=\"blue\">Start&nbsp;date&nbsp;ARV's:&nbsp;</span>".formatDate2Local($this->arv_patient_data['datetime_start_arv'],$date_format)." </td>
						  </tr>
					 </table>";
		return $table_string;
	}

	function displayARVData2() {
	//method for displaying a table with patient's arv data'
		if(!$this->getPatientARVData()) return false;

		$table_string="<table class=\"mainTable\">
					  <tr>
					    <td colspan=\"3\" class=\"tablebackground\"><span class=\"blue\">District/&nbsp;Wilaya/&nbsp;Tarafa&nbsp;/&nbsp;Kata:&nbsp;</span>".$this->arv_patient_data['district']."</td>
					  </tr>
					  <tr>
					    <td colspan=\"2\" class=\"tablebackground\"><span class=\"blue\">Village/&nbsp;Kitongoji:&nbsp;</span>".$this->arv_patient_data['village']."</td>
					    <td  class=\"tablebackground\"><span class=\"blue\">Street/&nbsp;Mtaa:&nbsp;</span>".$this->arv_patient_data['street']."</td>
					  </tr>
					  <tr>
					    <td class=\"tablebackground\"><span class=\"blue\">Mfumbe&nbsp;/Balozi:&nbsp;</span>".$this->arv_patient_data['balozi']."</td>
					    <td colspan=\"2\" class=\"tablebackground\"><span class=\"blue\">Head of family/ Mkuu wa kaya: </span>".$this->arv_patient_data['head of family']."</td>
					  </tr>
					  <tr>
					    <td colspan=\"3\" class=\"tablebackground\"><span class=\"blue\">Chairman&nbsp;of&nbsp;the&nbsp;village/&nbsp;Mwenyekiti&nbsp;wa&nbsp;Mtaa/&nbsp;Kitongolji:&nbsp;</span>".$this->arv_patient_data['chairman_of_village']."</td>
					  </tr>
					  <tr>
					    <td colspan=\"2\" class=\"tablebackground\"><span class=\"blue\">Jina&nbsp;la&nbsp;msaidizi&nbsp;wa&nbsp;karibu:&nbsp;</span>".$this->arv_patient_data['name_of_secretary']."</td>
					    <td class=\"tablebackground\"><span class=\"blue\">Phone/ Simu: </span>".$this->arv_patient_data['secretary_phone']."</td>
					  </tr>
					  <tr>
					    <td colspan=\"3\" class=\"tablebackground\"><span class=\"blue\">Postal&nbsp;adress/&nbsp;anuani:&nbsp;</span>".$this->arv_patient_data['secretary_adress']."</td>
					  </tr>
					</table>";
		return $table_string;
	}

//------------------------------------------------------------------------------------------------------------------------------

	function form_validate() {
		$this->ok=true;
		if(!$this->rule_not_empty($_GET['arv_patient_data']['arv_pid']) ) {
			$this->error_message['arv_pid']="<div class=\"error\">Please enter a value!</div>";
			$this->ok=false;
		}
		if(!$this->rule_numeric($_GET['arv_patient_data']['arv_pid'])) {
			$this->error_message['arv_pid']="<div class=\"error\">Please enter a numeric value!</div>";
			$this->ok=false;
		}
		if (!$this->rule_numeric($_GET['arv_patient_data']['secretary_phone'])) {
			$this->error_message['secretary_phone']="<div class=\"error\">Please enter a numeric value!</div>";
			$this->ok=false;
		}

		return $this->ok;
	}

	function get_Error_message($name) {
		if ($name=='all'){
			return $this->error_message;
		};
		return $this->error_message[$name];
	}
//------------------------------------------------------------------------------------------------------------------------------
	function set_rule($field,$rule,$param) {
	//Method for setting a validation rule for the ARV forms
			$this->rules[$field][$rule] = $param;
	}

	function filterData($val) {
	//clean the data entered into the ARV forms
		$val=trim($val);
		$val=htmlentities($val);
		$val=strip_tags($val);
		return $val;
	}

	function apply_rules($defaults,$data_in) {
	/* Method for form validation.
	 * Parameters:
	 * $defaults: Array of $default values for the form elements
	 * $data_in: Array of $_GET or $_POST variables.
	 *
	 * set empty fields to the default value
	 * apply the rules given with the set_rule method
	 * return an array, containing the number of errors, error messages, and the validated data
	 * */

		$data_out = array();
  		$messages = array();
  		$errors = 0;

		$keys = array_keys($defaults);

		 foreach ($keys as $k) {

		    $messages[$k] = false;

		    if (!isset($data_in[$k])){

		      $data_out[$k] = $defaults[$k];
		      continue;
		    }
			$this->filterData($data_in[$k]);
		    $data_out[$k] = $data_in[$k];

		 }

		  foreach ($keys as $field) {
		  while (list($rule, $param) = each($this->rules[$field])) {

				  $success= $this->$rule($data_out[$field],$param);

			      if ($success){
			        $messages[$field] = sprintf($this->msg_tpl, $this->$rule($data_out[$field],$param));
			        $errors ++;
			        break;
			      }
		    }
		  }

		  $result = array(
		   'values' => $data_out,
		   'messages' => $messages,
		   'errors' => $errors,
		  );

		  return $result;
	}

	function rule_required($val) {
		if(empty($val)) {
			$msg_string="Please enter a value!";
			return $msg_string;
		}
		return false;
	}

	function rule_date($val) {
		$success=true;
		if(empty($val)) { return false;}
		$rule_date = '#^((0?\d|[1-2]\d)[. /]\s*(0?[1-9]|10|11|12)|(30)[. /]
		\s*(0?[13456789]|10|11|12)|(31)[. /]\s*(0?[13578]|10|12))[. /]\s*(19\d\d|20\d\d)$#x';
		$success = preg_match($rule_date, $val);

		return !$success ? "Please enter a valid date!" : false;
	}

	function rule_decimal($val) {
		 $success=true;
		 $regex = '#^\d{1,3}[.]+\d{1,2}$|^\d{0,3}$#';
		 $success = preg_match($regex, $val);
		 return !$success ? "Please use the format 111.22 or 111!" : false;
	}

	function rule_min_chars($val,$number) {
		if(strlen($val)<=$number) {
			$error_string="Please enter at minimum $number characters!";
			return $error_string;
		}
		return false;
	}

	function rule_not_empty($val) {
		if(empty($val)) {
			return false;
		}
		return true;
	}

	function rule_numeric($val) {
		if(!empty($val)){
			return is_numeric($val)? false : $error_string="Please enter a numeric value!";
		}
		else {
			return false;
		}
	}
}

?>