<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
/**
*  Laboratory methods.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Radio extends Encounter {

	var $tb_req_radio='care_test_request_radio';
	/**
	* Table name for test findings for chemical lab
	* @var string
	*/
	var $tb_find_radio='care_test_findings_radio';
	/**
	
	/**
	* Prepend characters for english
	* @var string
	*/
	var $en_prepend;
	/**
	
	/**
	* Field names for care_test_findings_radio table
	* @var array
	*/
	var $fld_find_radio=array(
				'batch_nr',
				'encounter_nr',
				'room_nr',
				'dept_nr',
				'findings',
				'diagnosis',
				'doctor_id',
				'findings_date',
				'findings_time',
				'status',
				'history',
				'modify_id',
				'modify_time',
				'create_id',
				'create_time');
	
	/**
	* Constructor
	* @param int Encounter number
	*/
	function Radio($enc_nr=''){
		if(!empty($enc_nr)) $this->enc_nr=$enc_nr;
		$this->setTable($this->tb_find_radio);
		$this->setRefArray($this->fld_find_radio);
		//$this->en_prepend=date('Y')*1000000;
	}

	/**
	* Searches for existing laboratory reports for an encounter.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function createResultsList($enc_nr){
	    global $db;

		$this->sql="SELECT batch_nr,findings,diagnosis, findings_date,findings_time FROM $this->tb_find_radio WHERE encounter_nr='$enc_nr' AND status<>'hidden' ORDER BY batch_nr DESC";

		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	function GetJobsByEncounter($enc_nr){
	    global $db;

		$this->sql="SELECT batch_nr,findings,diagnosis, findings_date,findings_time FROM $this->tb_find_radio WHERE encounter_nr='$enc_nr' AND status<>'hidden' ORDER BY batch_nr ASC";

		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	function GetUserDataByEncounter($enc_nr){
		global $db;
		if(!$enc_nr) return false;
		$this->sql="SELECT * FROM care_person cp, care_encounter ce WHERE
		ce.pid = cp.pid AND
		ce.encounter_nr = ".$enc_nr;
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	/**
	* Gets the batch number of a given encounter number and  job id.
	* @access public
	* @param int Encounter number
	* @param int Job (test request) id
	* @param int Test group id
	* @return mixed integer or boolean
	*/

	function BatchNr($enc_nr,$batch_nr){
	    global $db;
		$this->sql="SELECT batch_nr,findings_date FROM $this->tb_find_radio WHERE encounter_nr='$enc_nr' AND batch_nr='$batch_nr'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				$row=$this->result->FetchRow();
				return $row['batch_nr'];
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Checks if the job id is existing.
	* @param int Encounter number
	* @param int Job (test request) id
	* @param int Test group id
	* @return boolean
	*/
	function JobIDExists($enc_nr,$batch_nr){
		if($this->BatchNr($enc_nr,$batch_nr)){
			return TRUE;
		} else {return FALSE;}
	}
	/**
	* Hides the test result if it exists.
	* @param int Encounter number
	* @param int Job (test request) id
	* @param int Test group id
	* @return boolean
	*/
	function hideResultIfExists($enc_nr,$batch_nr){
		global $HTTP_SESSION_VARS;
		$this->sql="UPDATE $this->tb_find_radio SET status='hidden',history=".$this->ConcatHistory("Hide ".date('Y-m-d H:i:s')." ".$HTTP_SESSION_VARS['sess_user_name']."\n")."
								WHERE encounter_nr='$enc_nr' AND batch_nr='$batch_nr'  AND status NOT IN ($this->dead_stat)";
		return $this->Transact();
	}
	/**
	* Gets the test result data basing on the batch number key.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_radio</var> array.
	* @access public
	* @param int Batch number
	* @return mixed adodb record object or boolean
	*/
	function getBatchResult($bn){
		global $db;
		$this->sql="SELECT * FROM $this->tb_find_radio WHERE batch_nr=$bn";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets the test result data basing on encounter number, job id, and test group id keys.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_radio</var> array.
	* @access public
	* @param int Job (test request) id
	* @param int Test group id
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getResult($batch_nr,$enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		if($grp_id=='all')
			$this->sql="SELECT * FROM $this->tb_find_radio WHERE encounter_nr='$this->enc_nr' AND batch_nr='$batch_nr' AND status<>'hidden'";
		else
			$this->sql="SELECT * FROM $this->tb_find_radio WHERE encounter_nr='$this->enc_nr' AND batch_nr='$batch_nr' AND group_id='$grp_id' AND status<>'hidden'";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets all test result records for an encounter.
	*
	* The returned adodb record object contains row of array.
	* The array contains the test result data with index keys as outlined in the <var>$fld_find_radio</var> array.
	* @access public
	* @param int Encounter number
	* @return mixed adodb record object or boolean
	*/
	function getAllResults($enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT * FROM $this->tb_find_radio WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat) ORDER BY test_date";
		if($this->result=$db->Execute($this->sql)){
		    if($this->rec_count=$this->result->RecordCount()) {
				return $this->result;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Returns all test parameters belonging to a test group.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the test result data with index keys as outlined in the <var>$fld_test_param</var> array.
	* @access public
	* @param int Test group id
	* @return mixed adodb record object or boolean
	*/
	function TestParams($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="AND p.group_id='$id'";
		$this->sql="SELECT p.*, g.is_enabled FROM $this->tb_test_param p, $this->tb_test_group g WHERE
		p.id = g.id	$cond ORDER BY name";

		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function GetTestsToDo($id=''){
		$this->debug=FALSE;
		if ($this->debug) echo "calling function GetTestsToDo($id)<br>";
		global $db;
		if(empty($id)) $cond='';
			else $cond="batch_nr='$id'";
		$this->sql="SELECT parameters FROM $this->tb_req_radio WHERE $cond";
		if($this->tparams=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparams->RecordCount()) {
				return $this->tparams;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function TestParamsDetails($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="WHERE id='$id'";
		$this->sql="SELECT * FROM $this->tb_test_param $cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function TestParamsGroupsDetails($id=''){
		global $db;
		if(empty($id)) $cond='';
			else $cond="AND p.id='$id'";
		$this->sql="SELECT p.*, g.is_enabled FROM $this->tb_test_param p, $this->tb_test_group g WHERE
		p.id = g.id	$cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function TestParamsDetailsByNr($nr=''){
		global $db;
		if(empty($nr)) $cond='';
			else $cond="WHERE nr='$nr'";
			echo "SELECT * FROM $this->tb_test_param $cond";
		$this->sql="SELECT * FROM $this->tb_test_param $cond";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}



	/**
	* Returns all test groups.
	* @access public
	* @return mixed adodb record object or boolean
	*/
	function TestGroups(){
		global $db;
		$this->debug=FALSE;
		$this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
		if ($this->debug) echo "TestGroups()<br>";
		$this->sql="SELECT * FROM $this->tb_test_group WHERE parent=-1 AND is_enabled=1 ORDER BY name";
		if($this->tgroups=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tgroups->RecordCount()) {
				return $this->tgroups;
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function TestGroupByID($id){
		global $db;
		if(!id) return false;
		$this->sql="SELECT * FROM $this->tb_test_group WHERE id=".$id." ORDER BY name";
		if($this->tparamsdetails=$db->Execute($this->sql)){
		    if($this->rec_count=$this->tparamsdetails->RecordCount()) {
				return $this->tparamsdetails->FetchRow();
			} else {return FALSE;}
		}else {return FALSE;}
	}

	function InsertParams(){
		global $db, $HTTP_POST_VARS;
		// TODO: Make sure that this test will also added to drugsandservices
		if ($HTTP_POST_VARS['name']=='New parameter') return FALSE;
		$this->sql="INSERT INTO $this->tb_test_group (parent, name, is_enabled) VALUES
		(".$HTTP_POST_VARS['parameterselect'].", '".$HTTP_POST_VARS['name']."',1)";
		$db->Execute($this->sql);
		$this->sql="INSERT INTO $this->tb_test_param
		(`group_id`, `name`, `id`, `msr_unit`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`,`add_type`,`add_label`, `status`, `history`, `modify_id`, `create_id`, `price`) VALUES
		('".$HTTP_POST_VARS['parameterselect']."','".$HTTP_POST_VARS['name']."','".$db->Insert_ID()."','".$HTTP_POST_VARS['msr_unit']."','".$HTTP_POST_VARS['median']."','".$HTTP_POST_VARS['hi_bound']."','".$HTTP_POST_VARS['lo_bound']."',
		'".$HTTP_POST_VARS['hi_critical']."','".$HTTP_POST_VARS['lo_critical']."','".$HTTP_POST_VARS['hi_toxic']."','".$HTTP_POST_VARS['lo_toxic']."','radio','Positive','".$HTTP_POST_VARS['status']."','".addslashes($HTTP_POST_VARS['history'])."','".$HTTP_POST_VARS['modify_id']."',
		'".$HTTP_POST_VARS['create_id']."','".$HTTP_POST_VARS['price']."')";

		$id = $db->Insert_ID();

		if($this->tgroups=$db->Execute($this->sql)){
				// Store test to care_tz_drugsandservices

				$sql = "INSERT INTO care_tz_drugsandservices (
  							`item_number` ,
  							`is_pediatric` ,
  							`is_adult` ,
  							`is_other` ,
  							`is_consumable` ,
  							`is_labtest` ,
  							`item_description` ,
  							`item_full_description` ,
  							`unit_price` ,
  							`unit_price_1` ,
  							`unit_price_2` ,
  							`unit_price_3` ,
  							`purchasing_class` )
  						VALUES ( 'LAB".$id."',0,0,0,0,1,'".$HTTP_POST_VARS['name']."','".$HTTP_POST_VARS['name']."',0,0,0,0,'labtest')";
  				$db->Execute($sql);
  				return ($db->Insert_ID()>1) ? TRUE : FALSE;
		} else {
			return FALSE;
		} // End of if($this->tgroups=$db->Execute($this->sql))
	}

	/**
	* Check if at least one laboratory result exists for the encounter.
	* @access public
	* @param int Encounter number
	* @return boolean
	*/
	function ResultExists($enc_nr=''){
		global $db;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT nr FROM $this->tb_find_radio WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat)";
		if($buf=$db->Execute($this->sql)){
		    if($this->rec_count=$buf->RecordCount()) {
				return TRUE;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Gets all information of a test parameter.
	*
	* The param $nr takes precedence. If it is not empty it will be used to find the test parameter.
	* If the $id is needed, set $nr to empty character.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contain the test data with index keys as outlined in the <var>$fld_test_param</var> array.
	* @access public
	* @param int Key number
	* @param string Key id
	* @return mixed adodb record object or boolean
	*/
	function getTestParam($nr=0,$id=''){
		global $db;
		if($nr){
			$cond="nr='$nr'";
		}elseif(!empty($id)){
			$cond="id='$id'";
		}else{
			return FALSE;
		}
		$this->sql="SELECT * FROM $this->tb_test_param WHERE $cond";
		if($this->buffer=$db->Execute($this->sql)){
		    if($this->buffer->RecordCount()) {
				return $this->buffer;
			} else {return FALSE;}
		}else {return FALSE;}
	}
	/**
	* Searches for encounters with existing laboratory results.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains the encounter data with the following index keys:
	* - encounter_nr = encounter number
	* - encounter_class_nr = encounter class number e.g. 1 = inpatient, 2 = outpatient
	* - pid = pid number
	* - name_last = person's last or family name
	* - name_first = person's first or given name
	* - date_birth = date of birth
	* - sex = sex
	* @access public
	* @param string Search keyword
	* @param string Optional query append e.g sort directive
	* @param boolean Flags if search return is limited or not. Defaults to FALSE = unlimited return.
	* @param int Maximum number or rows returned in case of limited return search. Defaults to 30 rows.
	* @param int Start index of rows to be returned. Defaults to 0 = begin of rows block.
	* @return mixed adodb record object or boolean
	*/
	function searchEncounterRadResults($key='',$add_opt='',$limit=FALSE,$len=30,$so=0){
		global $db, $sql_LIKE;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		if(empty($key)) return FALSE;
		$this->sql="SELECT f.encounter_nr,f.findings_date, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex
				FROM $this->tb_find_radio AS f
				LEFT JOIN $this->tb_enc AS e ON e.encounter_nr = f.encounter_nr
				LEFT JOIN $this->tb_person AS p ON p.pid = e.pid";
		if(is_numeric($key)){
			$key=(int)$key;
			$this->sql.=" WHERE e.encounter_nr = $key";
		}else{
			$this->sql.=" WHERE e.encounter_nr = f.encounter_nr
						AND f.status NOT IN ($this->dead_stat)
						AND
						(e.encounter_nr $sql_LIKE '$key%'
						OR p.pid $sql_LIKE '$key%'
						OR p.name_last $sql_LIKE '$key%'
						OR p.name_first $sql_LIKE '$key%'
						OR p.date_birth $sql_LIKE '$key%') ";
			if($enc_class) $sql.="	AND e.encounter_class_nr=$enc_class";
		}
		# Append the common condition
		$this->sql.=" GROUP BY f.encounter_nr, e.encounter_class_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex  $add_opt";
		//echo $this->sql;
		if($limit){
	    	$this->res['selr']=$db->SelectLimit($this->sql,$len,$so);
		}else{
	    	$this->res['selr']=$db->Execute($this->sql);
		}
	    if ($this->res['selr']) {
		   	if ($this->record_count=$this->res['selr']->RecordCount()) {
				# Workaround
				$this->rec_count=$this->record_count;
				return $this->res['selr'];
			}else{return FALSE;}
		}else{return FALSE;}
	}
	/**
	* Searches for encounters with existing lab results.
	*
	* Similar to <var>searchEncounterLabResults()</var> but returns a limited number of rows.
	* For details of the returned data structure see the <var>searchEncounterLabResults()</var> method.
	* @access public
	* @param string Search keyword
	* @param int Maximum number or rows returned in case of limited return search. Defaults to 30 rows.
	* @param int Start index of rows to be returned. Defaults to 0 = begin of rows block.
	* @param string Field name for sorting. Defaults to empty = unsorted result.
	* @param string Sort direction. Defaults to ascending order.
	* @return mixed adodb record object or boolean
	*/
	function searchLimitEncounterLabResults($key,$len,$so,$sortitem='',$order='ASC'){
		if(!empty($sortitem)){
			$option=" ORDER BY $sortitem $order";
		}else{
			$option='';
		}
		return $this->searchEncounterLabResults($key,$option,TRUE,$len,$so);
	}
	/**
	 * Searches for one encounter having results in the database:
	 * @param int encounter_number
	 * return:
	 * 	TRUE: All tests requests having at least one entry in the database
	 *    -1: not all, but several of them having an test result in the database
	 *    -2: not even one test result is given to the pending list
	 */
	function IsMissingLabResult($batch_nr) {
		global $db;
		$debug=FALSE;
		$param_array=array();
		($debug)?$db->debug=TRUE: $db->debug=FALSE;
		$this->sql="SELECT DISTINCT * FROM care_test_request_radio where batch_nr=".$batch_nr;
		$db_obj=$db->Execute($this->sql);
		$row=$db_obj->GetArray();
		while (list($u,$v)=each($row)){
			$arr_test_requests =  explode("&",$v['parameters']);
		}
		
		while (list($u,$v)=each($arr_test_requests)) {
			$param = substr($v,5);
			$param = substr($param,0,strpos($param,'_'));
			array_push($param_array, $param);
		}
		$num_of_pending_requests = sizeof($param_array);
		//now we have all test id's what should have results...

		$this->sql="SELECT DISTINCT serial_value FROM care_test_findings_radio where batch_nr=".$batch_nr;
		$db_obj=$db->Execute($this->sql);
		$row=$db_obj->GetArray();
		$num_of_records=$db_obj->RecordCount();
		if ($debug) echo "<br>Records for $batch_nr found in table care_test_request_chemlabor: $num_of_pending_requests<br>";
		$RET_CODE=1; // Return code is switched to "all results are given"

		if ($num_of_records>0) {
			while (list($u,$v)=each($row)) {
				$a =  unserialize($v['serial_value']); // Here we can find the value given to each test-id
				$num_of_lab_results=sizeof($a);
			}
		}

		if ($num_of_pending_requests==$num_of_lab_results) {
			if ($debug) echo "all results are given! return code is true";
			return 1;
		} else if (($num_of_pending_requests<$num_of_lab_results) && $num_of_lab_results!=0) {
			if ($debug) echo "there is at least one result pending, but one or more given: return is -1";
			return -1;
		} else {
			if ($debug) echo "there is not even one result given: return is -2";
			return -2;
		}

	}
	
	
	/**
	* Gets the latest modify_time information of an encounter's laboratory result.
	* @access public
	* @param int Encounter number
	* @return mixed integer or boolean
	*/
	function getLastModifyTime($enc_nr=0){
		global $db;
		$buf;
		$row;
		if(!$this->internResolveEncounterNr($enc_nr)) return FALSE;
		$this->sql="SELECT modify_time FROM $this->tb_find_radio WHERE encounter_nr='$this->enc_nr' AND status NOT IN ($this->dead_stat) ORDER BY modify_time DESC";
		if($buf=$db->SelectLimit($this->sql,1)){
		    if($buf->RecordCount()) {
				$row=$buf->FetchRow();
				return $row['modify_time'];
			} else {return FALSE;}
		}else {return FALSE;}
	}
}
?>
