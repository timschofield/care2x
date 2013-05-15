<?php

require_once($root_path.'include/care_api_classes/class_core.php');

class advanced_search extends Core {

	/**
	* Constructor
	*/
	function advanced_search(){
		global $root_path;
	}

	/**
	*
	* $array = get_equal_words (<column-name>(STRING) , <table_name>(STRING) , <Name for comparison>(STRING) , <percent of quality>(INTEGER) )
  *
	* Example:
	*
  *   $search_obj = & new advanced_search();
  *   if ($result_array=$search_obj->get_equal_words("tribe_name", "care_ug_tribes", $tribe, 65)) {
  *     $tribe_array=$result_array;
  *     $error++;
  *     $SHOW_TRIBE_SELECTION=TRUE;
  *   } else {
  *     $SHOW_TRIBE_SELECTION=FALSE;
  *   }
  */
	function insert_new_tribe($newtribe,$tribecode)
	{
		global $db;
		$this->sql="SELECT name FROM care_ug_tribes WHERE tribe_name LIKE '".$newtribe."' OR tribe_code LIKE'".$tribecode."'";

    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return false;
				else
				{
					$sql="INSERT INTO care_ug_tribes (tribe_code, tribe_name, is_additional)
					VALUES ('".$tribecode."','".$newtribe."',1)";
					$rs_ptr = $db->Execute($sql);
					return $db->Insert_ID();
				}
	}
	function insert_new_city($newcity,$code)
	{
		global $db;
		$this->sql="SELECT name FROM care_address_citytown WHERE name LIKE '".$newcity."'";

    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return false;
				else
				{
					$sql="INSERT INTO care_address_citytown (unece_locode, name, is_additional)
					VALUES ('".$code."','".$newcity."',1)";
					$rs_ptr = $db->Execute($sql);
					return $db->Insert_ID();
				}
	}
	function insert_new_religion($newreligion,$religioncode)
	{
		global $db;
		$this->sql="SELECT name FROM care_tz_religion WHERE name LIKE '".$newreligion."' OR code LIKE'".$religioncode."'";

    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return false;
				else
				{
					$sql="INSERT INTO care_tz_religion (code, name, is_additional)
					VALUES ('".$religioncode."','".$newreligion."',1)";
					$rs_ptr = $db->Execute($sql);
					return $db->Insert_ID();
				}
	}
	function get_tribe_info($tribe_id)
	{
		global $db;
		if(!$tribe_id) return false;
		$this->sql="SELECT * FROM care_ug_tribes WHERE tribe_id=".$tribe_id;

    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return $this->result->FetchRow();
				else
					return false;
	}
	function get_religion_info($religion_id)
	{
		global $db;
		if(!$religion_id) return false;
		$this->sql="SELECT * FROM care_tz_religion WHERE nr=".$religion_id;
    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return $this->result->FetchRow();
				else
					return false;
	}
	function get_citytown_info($nr)
	{
		global $db;
		if(!$nr) return false;
		$this->sql="SELECT * FROM care_address_citytown WHERE nr=".$nr;
    if($this->result=$db->Execute($this->sql))
        if($this->result->RecordCount())
					return $this->result->FetchRow();
				else
					return false;
	}
  function get_equal_words($column, $table, $word_to_compare, $sharpeness, $givekey) {

    global $db;
    $debug = FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

  			if(!$givekey)
  			{
  				$SQLStatement = "SELECT DISTINCT $column FROM $table ORDER BY $column";
  			}
  			else
  			{
        	$SQLStatement = "SELECT DISTINCT $column, $givekey FROM $table ORDER BY $column";
        }
        $rs_ptr = $db->Execute($SQLStatement);
        $res_array = $rs_ptr->GetArray();
        $arr_index = 0;
        $hit_index = 0;
        $PERFECT_HIT=FALSE;
        while (list($u,$v)=each($res_array)){
  				if(!$word_to_compare)
  				{
						$all_record_array[$arr_index][0] = $v[$column];
						$all_record_array[$arr_index][1] = $v[$givekey];
  				}
  				else
  				{
            $s1 = rtrim(strtoupper($word_to_compare));
            $s2 = rtrim(strtoupper($v[$column]));

            $st = similar_text($s1,$s2,$percent);

            $all_record_array[$arr_index][0] = $v[$column];
            $all_record_array[$arr_index][1] = $v[$givekey];
            if ($percent==100) {

              // the spelling is okay
              if ($debug) echo "Yepp...$s1 and $s2 are equal!<br>";
              $PERFECT_HIT = TRUE;
              $database_cell_value = $s2;
              continue;
            } elseif ($percent>=$sharpeness) {
              // we have a selection:
              if ($debug) echo "<br>$s1 and $s2 are more than $percent equal<br>";
              $hit_array[$hit_index][0]=$v[$column];
              $hit_array[$hit_index][1]=$v[$givekey];
              $hit_index++;
            }
            if ($debug) echo "$all_record_array[$arr_index]--";
           }
           $arr_index++;
        } // end of while
				if(!$word_to_compare)
				{
					return $all_record_array;
				}
				else
				{
        // anyway, what's set up before: Reset the global debug-variable
        $db->debug=FALSE;

        if ($debug) echo "<br>Perfect-Hit:".$PERFECT_HIT."<br>";
        if ($debug) echo "<br>Hit-Index:".$hit_index."<br>";

        if ($PERFECT_HIT || $hit_index==1) {
          // Exact (100%) -> Retrun the word out of the database
          // or exact one hit (no one is more equal) -> Retrun an array with one field
          return ($PERFECT_HIT) ? $database_cell_value : $hit_array;
        } elseif ($hit_index==0) {
            // no field in the databse can be compared by search value -> Return all values of the databse;
            if ($debug) echo "no hits -> returning all!<br>";
            return $all_record_array;
          } elseif ($hit_index>1) {
              if ($debug) echo "some hits<br>!";
              return $hit_array;
            } else {
              return FALSE;
            }
        }


}

function get_equal_words1($column, $table, $word_to_compare, $sharpeness, $givekey,$condition) {

    global $db;
    $debug = false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($debug) echo "Column: ".$column;
  if($condition=="")$condition='0';

  			if(!$givekey)
  			{
  				$SQLStatement = "SELECT DISTINCT $column FROM $table where is_additional=$condition ORDER BY $column";
  			}
  			else
  			{
        	$SQLStatement = "SELECT DISTINCT $column, $givekey FROM $table where is_additional=$condition ORDER BY $column";
        }
        $rs_ptr = $db->Execute($SQLStatement);
        $res_array = $rs_ptr->GetArray();
        $arr_index = 0;
        $hit_index = 0;
        $PERFECT_HIT=FALSE;
        while (list($u,$v)=each($res_array)){
  				if(!$word_to_compare)
  				{
						$all_record_array[$arr_index][0] = $v[$column];
						$all_record_array[$arr_index][1] = $v[$givekey];
  				}
  				else
  				{
            $s1 = rtrim(strtoupper($word_to_compare));
            $s2 = rtrim(strtoupper($v[$column]));

            $st = similar_text($s1,$s2,$percent);

            $all_record_array[$arr_index][0] = $v[$column];
            $all_record_array[$arr_index][1] = $v[$givekey];
            if ($percent==100) {

              // the spelling is okay
              if ($debug) echo "Yepp...$s1 and $s2 are equal!<br>";
              $PERFECT_HIT = TRUE;
              $database_cell_value = $s2;
              continue;
            } elseif ($percent>=$sharpeness) {
              // we have a selection:
              if ($debug) echo "<br>$s1 and $s2 are more than $percent equal<br>";
              $hit_array[$hit_index][0]=$v[$column];
              $hit_array[$hit_index][1]=$v[$givekey];
              $hit_index++;
            }
            if ($debug) echo "$all_record_array[$arr_index]--";
           }
           $arr_index++;
        } // end of while
				if(!$word_to_compare)
				{
					return $all_record_array;
				}
				else
				{
        // anyway, what's set up before: Reset the global debug-variable
        $db->debug=FALSE;

        if ($debug) echo "<br>Perfect-Hit:".$PERFECT_HIT."<br>";
        if ($debug) echo "<br>Hit-Index:".$hit_index."<br>";

        if ($PERFECT_HIT || $hit_index==1) {
          // Exact (100%) -> Retrun the word out of the database
          // or exact one hit (no one is more equal) -> Retrun an array with one field
          return ($PERFECT_HIT) ? $database_cell_value : $hit_array;
        } elseif ($hit_index==0) {
            // no field in the databse can be compared by search value -> Return all values of the databse;
            if ($debug) echo "no hits -> returning all!<br>";
            return $all_record_array;
          } elseif ($hit_index>1) {
              if ($debug) echo "some hits<br>!";
              return $hit_array;
            } else {
              return FALSE;
            }
        }


}




}


?>