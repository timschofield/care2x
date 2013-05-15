<?php

require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_notes.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
/**
*  Diagnostics.
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance.
* @author Robert Meggle
* @version beta 1.0
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Diagnostics extends Encounter {


  var $tbl_temp="tmp_search_results";
  var $sql = "";

  // Table definitions what the keyword(s) is maybe available:
  var $tbl="care_icd10_en";
  var $tbl_col_code="diagnosis_code";
  var $tbl_col_content="description";

  var $tbl_groups = "care_tz_icd10_quicklist";
  var $tbl_groups_id = "ID";
  var $tbl_groups_parent = "parent";
  var $tbl_groups_description = "description";
  var $tbl_groups_code = "diagnosis_code";

  var $tbl_diagnosis = "care_tz_diagnosis";
  var $tbl_diagnosis_casenr = "case_nr";
  var $tbl_diagnosis_parent_casenr = "parent_case_nr";
  var $tbl_diagnosis_PID = "PID";
  var $tbl_diagnosis_encounter_nr = "encounter_nr";
  var $tbl_diagnosis_timestamp = "timestamp";
  var $tbl_diagnosis_ICD_10_code = "ICD_10_code";
  var $tbl_diagnosis_ICD_10_description = "ICD_10_description";
  var $tbl_diagnosis_comment = "comment";
  var $tbl_diagnosis_type = "type";
  var $tbl_diagnosis_doctor_name = "doctor_name";
  var $counter;

  // The description field as an array, splitted off to an array of each word:
  //var $arr_tbl_col_content=array();

  // The keyword as an array, splitted off to an array of each words:
  var $arr_keyword=array();

  // tmp-array-field to store all the levensthein-values
  var $arr_nice_factor=array();
  var $nice_factor=0;
  var $levenshtein=0;
  var $methaphone="";

  //------------------------------------------------------------------------------
  function get_array_search_results($keyword){
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if($keyword=="*")
    {
    $this->sql="SELECT `".$this->tbl_col_code."` as code, `".$this->tbl_col_content."` as content FROM ".$this->tbl."
                WHERE 1";
  	}
  	else
  	{
    $this->sql="SELECT `".$this->tbl_col_code."` as code, `".$this->tbl_col_content."` as content FROM ".$this->tbl."
                WHERE
                      `".$this->tbl_col_content."` like '".$keyword."'
                      OR
                      `".$this->tbl_col_content."` like '%".$keyword."'
                      OR
                      `".$this->tbl_col_content."` like '".$keyword."%'
                      OR
                      `".$this->tbl_col_content."` like '%".$keyword."%'
                      OR `diagnosis_code` like '%".$keyword."%'
                ORDER BY `".$this->tbl_col_content."`";
		}
    return $db->Execute($this->sql);

  }


  //------------------------------------------------------------------------------

  function get_array_fuzzysearch_results($keyword){


    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if ($debug) echo "class_tz_diagnostics::get_array_select_results starts here<br>";
    if($keyword=="*")
    {
    	return $this->get_array_search_results($keyword);
  	}
  	else
  	{
    // Just after 3 letters, try to find a keyword:
    if (strlen($keyword)<3)
      return -1;

    // Create the temporary table:
    $this->sql="CREATE TEMPORARY TABLE ".$this->tbl_temp." (
                `code` VARCHAR( 10 ) ,
                `nice` INT UNSIGNED,
                `content` VARCHAR(255) ,
                INDEX ( `code` )
                ) TYPE = HEAP ";
    // Get at first a list of all item_numbers
    $db->Execute($this->sql);

    if ($debug)
      //$this->sql="SELECT `".$this->tbl_col_code."`, `".$this->tbl_col_content."` FROM ".$this->tbl ." where diagnosis_code LIKE \"B5%\" LIMIT 1,100";
      $this->sql="SELECT `".$this->tbl_col_code."`, `".$this->tbl_col_content."` FROM ".$this->tbl;
    else
        $this->sql="SELECT `".$this->tbl_col_code."`, `".$this->tbl_col_content."` FROM ".$this->tbl;
    $this->rs_tbl=$db->Execute($this->sql);

    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> TMP-table is created<br>";

    $this->arr_keywords = explode (" ", $keyword);

    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> keyword >".$keyword."< is slpitted into ".count($this->arr_keywords)." words<br>";

    $this->EXACT_MATCH=FALSE;

    while ($this->row_elem = $this->rs_tbl->FetchRow()) {
      if ($debug) echo "class_tz_diagnostics::get_array_select_results -> reading to the description >>".$this->row_elem[$this->tbl_col_content]."<<<br>";
      if ($debug) echo $this->row_elem['$this->tbl_col_content'];
      $this->arr_tbl_col_content = explode (" ", $this->row_elem[$this->tbl_col_content]);

      $this->avg_levensthein=0;
      $this->arr_levenshtein=array();

      reset($this->arr_keywords);
      reset($this->arr_tbl_col_content);
      $nice_factor=0;

      while (list($keyword_index,$keyword_value) = each ($this->arr_keywords)) {
        reset($this->arr_tbl_col_content);
        while (list($content_index,$content_value) = each ( $this->arr_tbl_col_content )) {
          // if this word has more than three letters, then cover it into our search algorithm:
          if (strlen($content_value)>3 && strlen($keyword_value)>3 ) {
            if ($debug) echo "compare:".$keyword_value."<->".$content_value.":";
            if (strcmp($content_value,$keyword_value)==0) {
              $this->nice_factor=100;
              $this->EXACT_MATCH=TRUE;
              array_push($this->arr_nice_factor,"100");
              if ($debug) echo "<b>WOUW</b>:".$keyword_value." with ".$content_value." gives a nice factor of:".$this->nice_factor."<br>";
              continue 2;
            } else {
              $m1=metaphone(strtolower($keyword_value));
              $m2=metaphone(strtolower($content_value));
              //echo "<br>".$m1."::".$m2."<br>";
              //$nix=similar_text($m1,$m2,$this->nice_factor);
              $levenshtein=levenshtein(strtolower($keyword_value),strtolower($content_value));

              if ($debug) echo $levenshtein."<br>";

              // Step 1: Function value of levensthein comparison:
              $this->nice = - 1/2 * $levenshtein + strlen($keyword_value);

              // Step 2: Percent value of levensthein comparison:
              $this->nice_factor = 100/strlen($keyword_value)*$this->nice;

              // By more exact hits increase the nice value more higher than the exact percent match
              if ($this->nice_factor > 90) $this->nice_factor=500;
              if ($this->nice_factor >= 75) $this->nice_factor=200;


              //$this->nice_factor = ($levenshtein/strlen($keyword_value));

              if ($this->nice_factor) {
                array_push($this->arr_nice_factor,$this->nice_factor);
                if ($debug) echo "<u>".$keyword_value."</u> with <u>".$content_value."</u> gives a nice factor of:".$this->nice_factor."<br>";
              }
              $nice_factor=0;
            }
          } // end of if (strlen($content_value)>3)
        } // end of while (list($content_index,$content_value) = each ( $this->arr_tbl_col_content )
      } // (list($keyword_index,$keyword_value) = each ($this->arr_keywords))

      // If there is an exact match:
      if (!$this->EXACT_MATCH) {
        // average of levensthein values:
        $this->nice_factor=0;
        /*
        for ($i=0; $i < count($this->arr_nice_factor); $i++)
          $this->nice_factor = $this->nice_factor + ( 1 / $this->arr_nice_factor[$i]);
        $this->nice_factor = 1 / count($this->arr_nice_factor) * ( $this->nice_factor );
        $this->nice_factor = 1/ $this->nice_factor;
        */
        for ($i=0; $i < count($this->arr_nice_factor); $i++)
          $this->nice_factor = $this->nice_factor + $this->arr_nice_factor[$i];
        $this->nice_factor = $this->nice_factor / count($this->arr_nice_factor)  ;
      } else {
        $this->nice_factor=1000;
      }

      if ($debug) echo "=".$this->nice_factor."<br>";

      if ($this->nice_factor) {
        $this->sql="INSERT INTO ".$this->tbl_temp." (`code`,`nice`, `content`) VALUES ('".$this->row_elem[$this->tbl_col_code]."',".round($this->nice_factor,0).",'".$this->row_elem[$this->tbl_col_content]."')";
        if ($debug) echo $this->sql."<br>";
        $db->Execute($this->sql);
        $this->EXACT_MATCH=FALSE; // Reset the exact match flag
      }
      $this->arr_nice_factor=array();





    } // end of while ($this->row_elem = $this->rs_tbl->FetchRow())
      $this->sql="SELECT code,nice,content FROM ".$this->tbl_temp." ORDER BY nice DESC LIMIT 0,40";
      return $db->Execute($this->sql);
  }
  }
  //------------------------------------------------------------------------------

  function GetAllCasesFromPID($pid) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$this->sql="SELECT ICD_10_code, case_nr FROM ".$this->tbl_diagnosis." WHERE pid='".$pid."'";
		$d_rs = $db->Execute($this->sql);
		while ($d_row=$d_rs->FetchRow()) {
		 $returnarray[$d_row['ICD_10_code']]= $d_row['case_nr'];
		}
		return $returnarray;
  }
  //------------------------------------------------------------------------------
  function GetAllCasesFromPIDbyDate($pid) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$this->sql="SELECT ICD_10_code, case_nr FROM ".$this->tbl_diagnosis." WHERE pid='".$pid."' ORDER BY Timestamp DESC";
		$d_rs = $db->Execute($this->sql);
		while ($d_row=$d_rs->FetchRow()) {
		 $returnarray[$d_row['case_nr']]= $d_row['ICD_10_code'];
		}
		return $returnarray;
  }
  //------------------------------------------------------------------------------
  function get_icd10_description_from_array($rs) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    while ($row=$rs->FetchRow()) {
      if ($debug) echo $row['diagnosis_code'];
      $this->sql="SELECT diagnosis_code, description FROM ".$this->tbl_icd10." WHERE diagnosis_code='".$row['diagnosis_code']."'";
      $d_rs = $db->Execute($this->sql);
      //return $d_rs;

      while ($d_row=$d_rs->FetchRow()) {
       echo $d_row['description']."<br>";
      }

    }
  }
  //------------------------------------------------------------------------------

  function get_icd10_description_from_code($code) {
    global $db;
    if(!$code) return false;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

      if ($debug) echo $code;
      $this->sql="SELECT diagnosis_code, description FROM ".$this->tbl." WHERE diagnosis_code='".$code."'";
      $d_rs = $db->Execute($this->sql);
      //return $d_rs;
      //echo $this->sql;
      if ($d_row=$d_rs->FetchRow()) {
       return $d_row['description'];
      }
      return false;
  }
  //------------------------------------------------------------------------------
  function GetDiagnosisGroups () {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    $this->sql = "SELECT $this->tbl_groups_id,$this->tbl_groups_description FROM $this->tbl_groups WHERE $this->tbl_groups_parent = '-1' ORDER BY $this->tbl_groups_description";
    $this->rs = $db->Execute($this->sql);
    return $this->rs;
  }
  //------------------------------------------------------------------------------
  function GetDiagnosisGroupName($id) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    $this->sql = "SELECT $this->tbl_groups_id,$this->tbl_groups_description FROM $this->tbl_groups WHERE $this->tbl_groups_id = '$id'";
    $this->rs = $db->Execute($this->sql);
    return $this->rs;
  }
  //------------------------------------------------------------------------------
  function GetDiagnosisGroupItems ($grupID) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($debug) echo "calling: GetDiagnosisGroupItems<br>";
    if (empty($grupID))
      return FALSE;
    $this->sql = "SELECT $this->tbl_groups_code FROM $this->tbl_groups WHERE $this->tbl_groups_parent = '".$grupID."' ORDER BY $this->tbl_groups_description ASC";
    echo $this->sql;
    $this->rs = $db->Execute($this->sql);
    if($this->rs!=-1) {
      //echo $this->rs[0];
    }
    return $this->rs;
  }
  //------------------------------------------------------------------------------
  function AddDiagnosisGroupName($group_description) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if (empty($group_description))
      return FALSE;
		$this->sql = "SELECT $this->tbl_groups_description FROM $this->tbl_groups WHERE $this->tbl_groups_description LIKE '$group_description'";
    $this->rs = $db->Execute($this->sql);
    if($this->rs->RecordCount()<=0)
    {
	    $this->sql = "REPLACE INTO $this->tbl_groups (
	                      $this->tbl_groups_parent,
	                      $this->tbl_groups_description,
	                      $this->tbl_groups_code
	                  ) VALUES ( '-1','".strtoupper($group_description)."',NULL )";
	    $this->rs = $db->Execute($this->sql);
	    $this->new_parent = $db->Insert_ID();
  	}
    return $this->new_parent;
  }
  //------------------------------------------------------------------------------
  function AddDiagnosisCodeToGroup($parent, $code) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql = "INSERT INTO $this->tbl_groups (
                      '$this->tbl_groups_id',
                      '$this->tbl_groups_parent',
                      '$this->tbl_groups_description',
                      '$this->tbl_groups_code'
                  ) VALUES ( '',NULL,$parent,$code )";
    $this->rs = $db->Execute($this-sql);
    if ($db->Insert_ID())
      return TRUE;
    else
      return FALSE;
  }
  //------------------------------------------------------------------------------
  function AddDiagnosisListToGroup($parent, $items) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql = "DELETE FROM $this->tbl_groups WHERE parent=$parent";
    $this->rs = $db->Execute($this->sql);

    while(list($x,$v) = each($items))
    {
	    $this->sql = "INSERT INTO $this->tbl_groups (
	                      $this->tbl_groups_id,
	                      $this->tbl_groups_parent,
	                      $this->tbl_groups_description,
	                      $this->tbl_groups_code
	                  ) VALUES ( '',$parent,'".$this->get_icd10_description_from_code($v)."','$v' )";
			$this->rs = $db->Execute($this->sql);
    }

    return $parent;
  }
  //------------------------------------------------------------------------------
  function DeleteDiagnosisGroup($parent) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if (empty($parent))
      return FALSE;
    // delete all childs of this parent
    $this->sql = "DELETE FROM $this->tbl_groups WHERE ID = $parent";
    $db->Execute($this->sql);
    if ($db->Affected_Rows()) {
      $this->sql = "DELETE FROM $this->tbl_groups WHERE parent = $parent";
      $db->Execute($this->sql);
    }
    return TRUE;
  }
  //------------------------------------------------------------------------------

  function get_parent_diagnosis_casenr($encounter_nr, $ICD10_code) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if (empty($encounter_nr) || empty($ICD10_code))
      return FALSE;

    $this->sql="SELECT `$this->tbl_diagnosis_casenr` AS parent_casenr FROM `$this->tbl_diagnosis`
                    WHERE     `$this->tbl_diagnosis_ICD_10_code` = $ICD10_code
                            AND
                              `$this->tbl_diagnosis_encounter_nr` = $encounter_nr";

    $this->rs = $db->Execute($this->sql);
    if ($db->RecordCount())
      return $this->rs['parent_casenr'];
    else
      return FALSE;
  }

  //------------------------------------------------------------------------------

  function EnterNewCase($dataarray) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if (!is_array($dataarray)) {
	  echo "internal error at class_tz_diagnostics.php::EnterNewCase(dataarray)";
      return FALSE;
    }
    while(list($x,$v) = each($dataarray))
    {
    	if(strstr($x,"diagnosistype"))
    	{
    		$form_id = substr(strrchr($x,"_"),1);
    		if($dataarray['diagnosistype_'.$form_id]=="revisit")
    			$return = $this->insert_diagnosis_as_revisit($dataarray['parentcase_'.$form_id], $dataarray['pid'], $dataarray['encounter'], $dataarray['icd_'.$form_id], $dataarray['icddesc_'.$form_id], $dataarray['comment_'.$form_id], $dataarray['diagnosistype_'.$form_id], $dataarray['doctor_'.$form_id]);
    		else
    			$return = $this->insert_diagnosis_as_new($dataarray['pid'], $dataarray['encounter'], $dataarray['icd_'.$form_id], $dataarray['icddesc_'.$form_id], $dataarray['comment_'.$form_id], $dataarray['diagnosistype_'.$form_id], $dataarray['doctor_'.$form_id]);

    	}
    	if($return)
    		header("location: icd10_history.php".URL_APPEND);
  	}
  }
  //------------------------------------------------------------------------------
  function GetCase($id) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if (!$id)
      return FALSE;
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    $this->sql="SELECT * FROM ".$this->tbl_diagnosis." WHERE case_nr='".$id."'";
    $d_rs = $db->Execute($this->sql);
    if($d_row=$d_rs->FetchRow()) {
     return $d_row;
    }
  }
  //------------------------------------------------------------------------------

  function insert_diagnosis_as_new($pid, $encounter_nr, $ICD10_code, $ICD10_description, $comment, $type, $doctor) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if($debug)
    	echo $pid.' - '.$encounter_nr.' - '.$ICD10_code.' - '.$ICD10_description.' - '.$comment.' - '.$doctor.'<br>';
    if (empty($pid) || empty($encounter_nr) || empty( $ICD10_code) || empty( $ICD10_description))
      return FALSE;
    $this->timestamp = time();

    $this->sql = "INSERT INTO `$this->tbl_diagnosis` (
                      `$this->tbl_diagnosis_casenr` ,
                      `$this->tbl_diagnosis_parent_casenr` ,
                      `$this->tbl_diagnosis_PID` ,
                      `$this->tbl_diagnosis_encounter_nr` ,
                      `$this->tbl_diagnosis_timestamp` ,
                      `$this->tbl_diagnosis_ICD_10_code` ,
                      `$this->tbl_diagnosis_ICD_10_description` ,
                      `$this->tbl_diagnosis_type`,
                      `$this->tbl_diagnosis_comment`,
					  `$this->tbl_diagnosis_doctor_name`
                  ) VALUES (
                      '',
                      '-1',
                      '$pid',
                      '$encounter_nr',
                      '$this->timestamp',
                      '$ICD10_code',
                      '$ICD10_description',
                      '$type',
                      '$comment',
					   '$doctor'
                  );";
    $db->Execute($this->sql);
    if ($db->Affected_Rows())
      return TRUE;
    else
      return FALSE;
  }

  //------------------------------------------------------------------------------

  function insert_diagnosis_as_revisit($parent_case_nr, $pid, $encounter_nr, $ICD10_code, $ICD10_description, $comment, $type, $doctor) {
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if (empty($parent_case_nr) || empty($pid) || empty($encounter_nr) || empty( $ICD10_code) || empty( $ICD10_description))
      return FALSE;


    $this->timestamp = time();
    $this->sql = "INSERT INTO `$this->tbl_diagnosis` (
                      `$this->tbl_diagnosis_casenr` ,
                      `$this->tbl_diagnosis_parent_casenr` ,
                      `$this->tbl_diagnosis_PID` ,
                      `$this->tbl_diagnosis_encounter_nr` ,
                      `$this->tbl_diagnosis_timestamp` ,
                      `$this->tbl_diagnosis_ICD_10_code` ,
                      `$this->tbl_diagnosis_ICD_10_description` ,
                      `$this->tbl_diagnosis_type`,
                      `$this->tbl_diagnosis_comment`,
					  `$this->tbl_diagnosis_doctor_name`
                  ) VALUES (
                      '',
                      '$parent_case_nr',
                      '$pid',
                      '$encounter_nr',
                      '$this->timestamp',
                      '$ICD10_code',
                      '$ICD10_description',
                      '$type',
                      '$comment',
					  '$doctor'
                  );";
    $db->Execute($this->sql);
    if ($db->Affected_Rows())
      return TRUE;
    else
      return FALSE;
  }

  /****************************************************************
  * DISPLAY CLASSES
  */

  //------------------------------------------------------------------------------
  function Display_Quicklist_Elements($selected) {
    $this->rs = $this->GetDiagnosisGroups();
    while ($this->row_elem = $this->rs->FetchRow()) {
    	if($this->row_elem[0] == $selected) $checked = 'selected'; else $checked= '';
      	echo "<option value=\"".$this->row_elem[0]."\" ".$checked.">".$this->row_elem[1]."</option>\n";
      	$counter++;
    }
    if(!$counter) echo '<option value="-1">Empty!</opion>';
    return TRUE;
  }
  //------------------------------------------------------------------------------
  function Display_Quicklist_Elements_Items($id){
  	global $LDNothingFoundSelectQuicklist,$LDNothingFoundTryFuzzySearch;
    if (empty($id) || $id==-1)
    {
      echo '<option value="-1">'.$LDNothingFoundSelectQuicklist.'</opion>';
      return false;
    }
    $this->rs = $this->GetDiagnosisGroupItems($id);
    while ($this->row_elem = $this->rs->FetchRow()) {
      echo "<option value=\"".$this->row_elem[0]."\">".$this->get_icd10_description_from_code($this->row_elem[0])." (".$this->row_elem[0].")</option>\n";
      $counter++;
    }
    if(!$counter) echo '<option value="-1">'.$LDNothingFoundTryFuzzySearch.'</opion>';
    return true;
  }
  //------------------------------------------------------------------------------
  function Display_Selected_Elements($array){ echo "Hallo Welt";
    if (empty($array))
      return FALSE;
    while (list($x,$v) = each($array)) {
      echo "<option value=\"".$v."\">".$this->get_icd10_description_from_code($v)." (".$v.")</option>\n";
      $counter++;
    }
    if(!$counter) echo '<option value="-1">Empty!</opion>';
  }
  //------------------------------------------------------------------------------
  function Display_Search_Results($keyword,$search_mode){
  	global $db,$LDNothingFoundTryFuzzySearch;
    if (!$keyword || !$search_mode) return false;
    elseif($search_mode=="exact")
    	$this->rs = $this->get_array_search_results($keyword);
    else
    	$this->rs = $this->get_array_fuzzysearch_results($keyword);
    if($this->rs!=-1)
	    while ($this->row_elem = $this->rs->FetchRow()) {
	      echo "<option value=\"".$this->row_elem['code']."\">".$this->row_elem['content']." (".$this->row_elem['code'].")</option>\n";
	      $counter++;
	    }
    if(!$counter) echo '<option value="-1">'.$LDNothingFoundTryFuzzySearch.'</opion>';
  }
  //------------------------------------------------------------------------------
  function Display_Group_Name($id){
  	global $db,$LDQuicklistItems;
    $this->rs = $this->GetDiagnosisGroupName($id);
    if($this->rs!=-1)
    {
	    if ($this->row_elem = $this->rs->FetchRow())
	      echo "Items from Quicklist ".strtoupper($this->row_elem[$this->tbl_groups_description]).":";
	  }
	  else echo $LDQuicklistItems;
  }
  //------------------------------------------------------------------------------
  function Display_Case($id){
  	global $db;
    $case_arr = $this->GetCase($id);

  }
  //------------------------------------------------------------------------------
  function Display_Selected_Diagnoses($encounter, $itemlist, $pid){
  	global $db,$userName;
  	global $LDNewPatient,$LDNewCase,$LDRevisit,$LDComment,$LDVIEW,$LDResetFields,$LDSubmitDiagnose,
  	       $LDSameDiagnose,$LDDiagnosis;
    $this->icd_old_array = $this->GetAllCasesFromPID($pid);
    echo '<form action="" method="post">
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr bgcolor="#99ccff">
            <td width="40%">'.$LDDiagnosis.'  </td>
            <td width="10%"><div align="center">'.$LDNewPatient.'</div></td>
            <td width="10%"><div align="center">'.$LDNewCase.'</div></td>
            <td width="10%"><div align="center">'.$LDRevisit.'</div></td>
            <td width="10%"><div align="center">'.$LDComment.'</div></td>
   			<td width="10%"><div align="center">Doctor Name</div></td>
          </tr>';
    while(list($x,$v) = each($itemlist))
    {
    	$idcounter++;
    	if($this->icd_old_array[$v])
    	{
    		$case_arr = $this->GetCase($this->icd_old_array[$v]);
    		$oldcase_code = '<br><font color="#FF0000">'.$LDSameDiagnose.' '.date("Y-m-d - H:i:s",$case_arr['timestamp']).'</font> - <a href="javascript:openpopup(\'icd10_showdetails.php\',\'show_details\',\'id\',\''.$this->icd_old_array[$v].'\');">'.$LDVIEW.'</a>
    		<input type="hidden" name="parentcase_'.$idcounter.'" value="'.$this->icd_old_array[$v].'">';
    		$revisit="checked";
    		$new="";
    	}
    	else
    	{
    		$oldcase_code ='';
    		$new="checked";
    		$revisit="";
    	}
    		echo '
					<tr bgcolor="#CAD3EC">
            <td>'.$this->get_icd10_description_from_code($v).$oldcase_code.'</td>
            <td><div align="center">
              <input name="diagnosistype_'.$idcounter.'" type="radio" value="new patient">
            </div></td>
            <td><div align="center">
              <input name="diagnosistype_'.$idcounter.'" type="radio" value="new" '.$new.'>
            </div></td>
            <td><div align="center">
              <input type="radio" name="diagnosistype_'.$idcounter.'" value="revisit" '.$revisit.'>
              <input type="hidden" name="icd_'.$idcounter.'" value="'.$v.'">
              <input type="hidden" name="icddesc_'.$idcounter.'" value="'.$this->get_icd10_description_from_code($v).'">
            </div></td>
            <td valign="bottom"><input type="text" name="comment_'.$idcounter.'" value="" size="25" maxlength="255"></td>

			<td valign="bottom"><input type="text" name="doctor_'.$idcounter.'" value="'.$userName.'" size="25" maxlength="255"></td>

          </tr>';
  	}
  	echo '
  		      <tr bgcolor="#99ccff">

            <td width="40%"><input type="reset" value="'.$LDResetFields.'"></td>
            <td width="10%"><div align="center">'.$LDNewPatient.'</div><input type="hidden" name="todo" value="submit"></td>
            <td width="10%"><div align="center">'.$LDNewCase.'</div><input type="hidden" name="encounter" value="'.$encounter.'"></td>
            <td width="10%"><div align="center">'.$LDRevisit.'</div><input type="hidden" name="pid" value="'.$pid.'"></td>
            <td width="30%" align="right"></td>
			<td width="30%" align="right"><input type="submit" value="'.$LDSubmitDiagnose.'"></td>
          </tr>
       </table>
 	  </form>';
  }
  //------------------------------------------------------------------------------
  function Display_Archived_Diagnoses($pid){
  	global $db;
  	global $LDDate,$LDCase,$LDDiagnoses,$LDType,$LDComment,$LDNoComment,$LDRevisitOfCase,$LDfrom,$LDSHOW;
    $this->icd_old_array = $this->GetAllCasesFromPIDbyDate($pid);
    echo '<form action="" method="post">
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
          <tr bgcolor="#99ccff">

						<td width="20%"><div align="center">'.$LDDate.'</div></td>
						<td width="5%"><div align="center">'.$LDCase.'</div></td>
            <td width="38%">'.$LDDiagnoses.'</td>
            <td width="7%"><div align="center">'.$LDType.'</div></td>
            <td width="30%"><div align="center">'.$LDComment.'</div></td>
			<td width="30%"><div align="center">Doctor Name</div></td>
          </tr>';
    while(list($x,$v) = each($this->icd_old_array))
    {
    	$idcounter++;
  		$case_arr = $this->GetCase($x);
  		$case_old = "";

  		if($case_arr['parent_case_nr']!=-1 && $case_arr['parent_case_nr'] && $case_arr['type']=="revisit" )
  		{

  			$case_old = $this->GetCase($case_arr['parent_case_nr']);
				$oldcase_code = '<br><font color="#FF0000">'.$LDRevisitOfCase.' '.$case_arr['parent_case_nr'].' '.$LDfrom.' '.date("Y-m-d",$case_old['timestamp']).'</font> - <a href="javascript:openpopup(\'icd10_showdetails.php\',\'show_details\',\'id\',\''.$case_arr['parent_case_nr'].'\');">'.$LDSHOW.'</a>';
  		}
  		else
  			$oldcase_code = "";
  		$revisit="checked";
  		$new="";
			echo '
					<tr bgcolor="#CAD3EC">
            <td><div align="center">
              '.date("Y-m-d - H:i:s",$case_arr['timestamp']).'
            </div></td>
            <td><div align="center">'.$case_arr['case_nr'].'</div></td>
            <td>'.$case_arr['ICD_10_description'].$oldcase_code.'</td>
            <td><div align="center">
              '.$case_arr['type'].'
            </div></td>
            <td>';

            if(!$case_arr['comment']) echo $LDNoComment;
            else echo $case_arr['comment'];

            echo '</td>
			 <td><div align="center">'.$case_arr['doctor_name'].'</div></td>

          </tr>';
  	}
  	echo '
  		    <tr bgcolor="#99ccff">

						<td><div align="center">'.$LDDate.'</div></td>
						<td><div align="center">'.$LDCase.'</div></td>
            <td>'.$LDDiagnoses.'  </td>
            <td><div align="center">'.$LDType.'</div></td>
            <td><div align="center">'.$LDComment.'</div></td>
			<td ><div align="center">Doctor Name</div></td>
          </tr>
       </table>
 	  </form>';
  }
  //------------------------------------------------------------------------------
}

?>
