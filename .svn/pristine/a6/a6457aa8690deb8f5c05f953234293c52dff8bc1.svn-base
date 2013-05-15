<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (preg_match('/class_tz_pharmacy.php/i',$_SERVER['PHP_SELF']))
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require_once($root_path.'include/care_api_classes/class_core.php');


/**
*  Pharmacy methods for tanzania (the product-module is completely rewritten by Robert Meggle.
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @author Alexander Irro (Version 2.0.0) - alexander.irro@merotech.de
* @version beta 2.0.0
* @copyright 2005 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Product extends Core {

  var $tbl_product_items='care_tz_drugsandservices';
  var $tbl_pricedefinition='care_tz_drugsandservices_description';

  var $tbl_temp="tmp_search_results";
  var $fields_tbl_product=array(
	                            'item_number',
  								'partcode',
								'is_pediatric',
								'is_adult',
								'is_other',
								'is_consumable',
								'item_description',
								'item_full_description',
								'purchasing_class',
								'sub_class',
								'unit_price',
								'unit_price_1',
								'unit_price_2',
								'unit_price_3',

								'unit_price_4',
								'unit_price_5',
								'unit_price_6');

  var $fields_tbl_price=array (
  								'Fieldname',
  								'ShowDescription',
  								'FullDescription',
  								'is_insurance_price',
  								'last_change',
  								'UID'
  );
  var $result;
  var $rs_fuzziness;


  // Constructor
  function Product() {
    return TRUE;
  }

  //------------------------------------------------------------------------------
  // Methods:

  function check_form_variable($me) {
    return (!empty($me)) ? FALSE : TRUE;
  }

  // -----------------------------------------------------------------------------
	function useProductTable(){
		$this->setTable($this->tbl_product_items);
		$this->setRefArray($this->fields_tbl_product);
	}

  // -----------------------------------------------------------------------------
	function usePriceDescriptionTable(){
		$this->setTable($this->tbl_pricedefinition);
		$this->setRefArray($this->fields_tbl_price);
	}


  //------------------------------------------------------------------------------

  function item_number_exists($item_number) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $db;
    $this->sql = "SELECT * FROM ".$this->tbl_product_items." WHERE item_number = '".$item_number."'";
    $this->result = $db->Execute($this->sql);
    return ($this->result->RecordCount()) ? TRUE : FALSE;
  }

  //------------------------------------------------------------------------------

  function item_id_exists($item_id) {
    /**
    * Returns TRUE if this item number still exists in the database
    */
    global $db;
    $this->sql = "SELECT * FROM ".$this->tbl_product_items." WHERE item_id = '".$item_id."'";
    $this->result = $db->Execute($this->sql);
    return ($this->result->RecordCount()) ? TRUE : FALSE;
  }

  //------------------------------------------------------------------------------



  // Private update class:
  function _updatePharmacyDataFromArray(&$array,$item_nr='',$isnum=TRUE) {
  	global $dbtype;
  	$x='';
  	$v='';
  	$elems='';

  	if($dbtype=='postgres7'||$dbtype=='postgres') $concatfx='||';
  		else $concatfx='concat';

  	if(empty($array)) return FALSE;

  	if ($isnum)
  	  if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
  	else
  	  if(empty($item_nr)) return FALSE;

  	while(list($x,$v)=each($array)) {

  	if(stristr($v,$concatfx)||stristr($v,'null')) $elems.="$x= $v,";
  	    else $elems.="$x='$v',";
  	}
  	# Bug fix. Reset array.
  	reset($array);
  	//echo strlen($elems)." leng<br>";
  	$elems=substr_replace($elems,'',(strlen($elems))-1);
  	$this->where="item_id='$item_nr'";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
  	# Bug fix. Reset the condition variable to prevent affecting subsequent update calls.
  	//$this->where='';
  	return $this->Transact();
  }

  // Private update class:
  function _updatePricingDataFromArray(&$array,$field_nr='',$isnum=TRUE) {
  	global $dbtype;
  	$x='';
  	$v='';
  	$elems='';
  	if($dbtype=='postgres7'||$dbtype=='postgres') $concatfx='||';
  		else $concatfx='concat';

  	if(empty($array)) return FALSE;

  	if ($isnum)
  	  if(empty($field_nr)||($isnum&&!is_numeric($field_nr))) return FALSE;
  	else
  	  if(empty($field_nr)) return FALSE;

  	while(list($x,$v)=each($array)) {

  	if(stristr($v,$concatfx)||stristr($v,'null')) $elems.="$x= $v,";
  	    else $elems.="$x='$v',";
  	}
  	# Bug fix. Reset array.
  	reset($array);
  	//echo strlen($elems)." leng<br>";
  	$elems=substr_replace($elems,'',(strlen($elems))-1);
  	$this->where="Fieldname='$field_nr'";
        $this->sql="UPDATE $this->coretable SET $elems WHERE $this->where";
  	# Bug fix. Reset the condition variable to prevent affecting subsequent update calls.
  	//$this->where='';
  	//echo $this->sql.'<br>';
  	return $this->Transact();
  }

  // Public update class:
  function updatePharmacyDataFromInternalArray($item_nr='',$isnum=TRUE) {
		//if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
		if(empty($item_nr)) return FALSE;
	    $this->_prepSaveArray();
		return $this->_updatePharmacyDataFromArray($this->buffer_array,$item_nr,$isnum);
	}

  // Public update class:
  function updatePricingDataFromInternalArray($item_nr='',$isnum=TRUE) {
		//if(empty($item_nr)||($isnum&&!is_numeric($item_nr))) return FALSE;
		if(empty($item_nr)) return FALSE;
	    $this->_prepSaveArray();
		return $this->_updatePricingDataFromArray($this->data_array,$item_nr,$isnum);
	}

  //------------------------------------------------------------------------------
  function delete_item($item_id){
    /**
    * Delete item out of the table
    */
    if(empty($item_id)) {
        return FALSE;
    } else {
      $this->where="item_number='$item_id'";
      $this->sql="DELETE FROM $this->coretable WHERE $this->where";
      return $this->Transact();
    }
    return FALSE;
  }

  //------------------------------------------------------------------------------

  function get_array_search_results($keyword, $result_filter){
 	global $db;

    $debug=FALSE;

    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

	if ($debug) echo "get_array_search_results($keyword, $result_filter)";

	if (empty($result_filter) || $result_filter=='all')
    		$SQL_FILTER=" 1=1 ";
	else
    		$SQL_FILTER=" (purchasing_class='".$result_filter."') ";


    if ($debug) echo "class_tz_diagnostics::get_array_select_results starts here<br>";
    if($keyword=="*") {
	    $this->sql="SELECT `item_id`, `partcode`, 100 as plausibility, `item_description`,`not_in_use` FROM ".$this->tbl_product_items." WHERE ".$SQL_FILTER;
	    return $db->Execute($this->sql);

  	} else {
	  	$this->sql="SELECT `item_id`, `partcode`, `item_description`,`not_in_use` FROM ".$this->tbl_product_items." WHERE `purchasing_class`='".$keyword."'";
		$res=$db->execute($this->sql);

	#print $this->sql.'<hr />';

/*
  	else if($category=="category")
  	{
  	$this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items." WHERE `purchasing_class`='".$keyword."'";
	$res=$db->execute($this->sql);
	}
  	else
  	{
    // Just after 3 letters, try to find a keyword:
    if (strlen($keyword)<=3)
      return $this->get_all_items($result_filter);

	// Is there an exact hit for all words?
	$this->sql="SELECT `item_id`, `partcode`,`item_description` FROM ".$this->tbl_product_items." WHERE `item_description`='".$keyword."' AND ".$SQL_FILTER;
	$res=$db->execute($this->sql);
	if ($res->RecordCount()>0) {
		if ($debug) echo "Exact hit!";
		return $res;
	}
*/


    // Create the temporary table:
    $this->sql="CREATE TEMPORARY TABLE ".$this->tbl_temp." (
                `item_id` VARCHAR( 20 ) ,
                `plausibility` INT UNSIGNED,
                `item_description` VARCHAR(255),
                `not_in_use` VARCHAR(255)
                ) TYPE = HEAP ";

    // Get at first a list of all item_numbers
    $db->Execute($this->sql);

    $this->arr_nice_factor = array();
    $this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items." WHERE ".$SQL_FILTER;
    $this->rs_tbl=$db->Execute($this->sql);

    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> TMP-table is created<br>";

    $this->arr_keywords = explode (" ", $keyword);

    if ($debug) echo "class_tz_diagnostics::get_array_select_results -> keyword >".$keyword."< is slpitted into ".count($this->arr_keywords)." words<br>";

    $this->EXACT_MATCH=FALSE;

    while ($this->row_elem = $this->rs_tbl->FetchRow()) {
      if ($debug) echo "class_tz_diagnostics::get_array_select_results -> reading to the description >>".$this->row_elem[$this->tbl_col_content]."<<<br>";
      if ($debug) echo $this->row_elem['item_description'];
      $this->arr_tbl_col_content = explode (" ", $this->row_elem['item_description']);

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
              if ($this->EXACT_MATCH) {
              	$this->nice_factor=4000;
              	array_push($this->arr_nice_factor,$this->nice_factor);
              } else {
              	$this->EXACT_MATCH=TRUE;
              	$this->nice_factor=1000;
              	array_push($this->arr_nice_factor,$this->nice_factor);
              }


              if ($debug) echo "<b>WOUW</b>:".$keyword_value." with ".$content_value." gives a nice factor of:".$this->nice_factor."<br>";
              continue 2;
            } else {
			  $this->nice_factor=0;
              $m1=metaphone(strtolower($keyword_value));
              $m2=metaphone(strtolower($content_value));
              if ($debug) echo "<br> metaphone value of $keyword_value is $m1::metaphone value of $content_value is $m2<br>";
              //$nix=similar_text($m1,$m2,$this->nice_factor);
              //$levenshtein=levenshtein(strtolower($keyword_value),strtolower($content_value));
              $levenshtein=levenshtein($m1,$m2);
              //if ($debug) echo $levenshtein."<br>";

              // Step 1: Function value of levensthein comparison:
              $this->nice = - 1/2 * $levenshtein + strlen($keyword_value);
              if ($debug) echo 'Nice: '.$this->nice.'= -1/2 * '.$levenshtein.' + '.strlen($keyword_value).'<br>';
              // Step 2: Percent value of levensthein comparison:
              $this->nice_factor = 100/strlen($keyword_value)*$this->nice;
              if ($debug) echo 'DEBUG: current nice factor of this run is:'.$this->nice_factor.'<br>';
              // By more exact hits increase the nice value more higher than the exact percent match
              //if ($this->nice_factor > 90) $this->nice_factor=500;
              //if ($this->nice_factor >= 75) $this->nice_factor=200;


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
      //if (!$this->EXACT_MATCH) {
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
      //} else {
      //  $this->nice_factor=1000;
      //}

      if ($debug) echo "=".$this->nice_factor."<br>";

      if ($this->nice_factor) {
        if ($debug)
        	$this->sql="INSERT INTO ".$this->tbl_temp." (`item_id`,`plausibility`, `item_description`, `not_in_use`) VALUES ('".$this->row_elem['item_id']."',".round($this->nice_factor,0).",'".$this->row_elem['item_description']." (nice=".$this->nice_factor.")',,'".$this->row_elem['not_in_use']."')";
        else
        	$this->sql="INSERT INTO ".$this->tbl_temp." (`item_id`,`plausibility`, `item_description`, `not_in_use`) VALUES ('".$this->row_elem['item_id']."',".round($this->nice_factor,0).",'".$this->row_elem['item_description']."','".$this->row_elem['not_in_use']."')";
        if ($debug) echo $this->sql."<br>";
        $db->Execute($this->sql);
        $this->EXACT_MATCH=FALSE; // Reset the exact match flag
      }
      $this->arr_nice_factor=array();





    } // end of while ($this->row_elem = $this->rs_tbl->FetchRow())

      $this->sql="SELECT item_id, plausibility, item_description,`not_in_use` FROM ".$this->tbl_temp." ORDER BY plausibility DESC LIMIT 0,40";
      return $db->Execute($this->sql);
  }
 }





  //------------------------------------------------------------------------------

  function get_all_items($result_filter='all'){
    global $db;
    $debug=FALSE;
    switch ($result_filter) {
    	case 'all':
    		$SQL_FILTER=" 1=1 ";
    		break;
    	case 'stock':
    		$SQL_FILTER=" purchasing_class='drug_list' OR purchasing_class='supplies' ";
    		break;
    	default:
    		$SQL_FILTER=" 1=1 ";
    		break;
    }

    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT `item_id`, 'n/a' AS `plausibility`,  `item_description` FROM care_tz_drugsandservices WHERE $SQL_FILTER ORDER BY purchasing_class, item_description ";
    return $db->Execute($this->sql);
  }
//------------------------------------------------------------------------------
 function get_all_categories() {
 	global $db;
 	$debug=FALSE;
 	($debug) ? $db->debug=TRUE:$db->debug=FALSE;
 	$this->sql="SELECT `purchasing_class` FROM care_tz_drugsandservices GROUP BY `purchasing_class`";
 	$this->rs = $db->Execute($this->sql);
 	return $this->rs;
 }

//this selects items from specific cateogry
function get_all_items_in_category($keyword){
    global $db;
    $debug=FALSE;
    /*switch ($result_filter) {
    	case 'all':
    		$SQL_FILTER=" 1=1 ";
    		break;
    	case 'stock':
    		$SQL_FILTER=" purchasing_class='drug_list' OR purchasing_class='supplies' ";
    		break;
    	default:
    		$SQL_FILTER=" 1=1 ";
    		break;
    }*/

    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT `item_id`, 'n/a' AS `plausibility`,  `item_description` FROM care_tz_drugsandservices WHERE purchasing_class like'%$keyword%' ORDER BY  item_description ";
    return $db->Execute($this->sql);
  }





  //------------------------------------------------------------------------------

  // Notice by Robert Meggle: See to the following functions: If somebody has time and force, he could
  // think about a more intelligent solution. But this still works with a big lack of elegance...

  function get_description($item_id) {
    global $db;
    $db->debug=false;
    $this->sql="SELECT item_description FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_itemnumber($item_id) {
    global $db;
    $this->sql="SELECT item_number FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }


  function get_item_peadric($item_id) {
    global $db;
    $this->sql="SELECT is_pediatric FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_adult($item_id){
    global $db;
    $this->sql="SELECT is_adult FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_item_other($item_id){
    global $db;
    $this->sql="SELECT is_other FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_item_consumable($item_id){
    global $db;
    $this->sql="SELECT is_consumable FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_description($item_id){
    global $db;
    $this->sql="SELECT item_description FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_items_full_description($item_id){
    global $db;
    $this->sql="SELECT item_full_description FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }
  function get_item_classification($item_id){
    global $db;
    $this->sql="SELECT purchasing_class FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      if ($this->elem[0]=="drug_list")
        return "drug";
      if ($this->elem[0]=="supplies")
        return "supplies";
      if ($this->elem[0]=="supplies_laboratory")
        return "supplies lab.";
      if ($this->elem[0]=="special_others_list")
        return "special others";
      if ($this->elem[0]=="xray")
        return "x-ray";
      if ($this->elem[0]=="service")
        return "service";
      if ($this->elem[0]=="dental")
        return "dental services";
      if ($this->elem[0]=="eye-service")
        return "eye services";
      if ($this->elem[0]=="minor_proc_op")
        return "minor proc op";
      if ($this->elem[0]=="labtest")
        return "labtest";
      if ($this->elem[0]=="obgyne_op")
        return "obgyne op";
      if ($this->elem[0]=="ortho_op")
        return "ortho op";
      if ($this->elem[0]=="surgical_op")
        return "surgical op";


      //return $this->elem[0];
    }
    return "N/A";
  }

  function get_item_subclass($item_id){
    global $db;
    $this->sql="SELECT sub_class FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_partcode($item_id) {
    global $db;
    $this->sql="SELECT partcode FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_price($item_id){
    global $db;
    $this->sql="SELECT unit_price FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_selians_item_alt_price($item_id, $NUMBER){
  	/*
  	 * Getting the alternative price informations. Give the "NUMBER" parameter as follow:
  	 * $NUMBER = 0 -> column: unit_price
  	 * $NUMBER = 1 -> column: unit_price_1
  	 * $NUMBER = 2 -> column: unit_price_2
  	 * $NUMBER = 3 -> column: unit_price_3
  	 * Robert Meggle :: meggle@merotech.de (July 2007)
  	 */
  	global $db;
  	if (($NUMBER <0 || $NUMBER >6) || empty($item_id))
  		return FALSE;
    $field = array ('unit_price','unit_price_1','unit_price_2', 'unit_price_3', 'unit_price_4', 'unit_price_5', 'unit_price_6');
    $this->sql="SELECT ".$field[$NUMBER]." FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0];
    }
    return "N/A";
  }

  function get_all_prices($item_id){
    global $db;
    $return_string=""; // local variable of this method declared here

    $this->sql="SELECT unit_price, unit_price_1, unit_price_2, unit_price_3, unit_price_4, unit_price_5, unit_price_6 FROM care_tz_drugsandservices WHERE item_id='".$item_id."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      $return_string=number_format($this->elem[0],0,'.',',');
      if (
      	(!empty($this->elem[1])) ||
      	(!empty($this->elem[2])) ||
      	(!empty($this->elem[3])) ||
      	(!empty($this->elem[4])) ||
      	(!empty($this->elem[5])) ||
      	(!empty($this->elem[6]))){
      	// Is there at least one more price given, then show it on a string

      	$return_string .= "/";

      	if (!empty($this->elem[1]))
      		$return_string .= number_format($this->elem[1],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";

      	if (!empty($this->elem[2]))
      		$return_string .= number_format($this->elem[2],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";

      	if (!empty($this->elem[3]))
      		$return_string .= number_format($this->elem[3],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";

      	if (!empty($this->elem[4]))
      		$return_string .= number_format($this->elem[4],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";


      	if (!empty($this->elem[5]))
      		$return_string .= number_format($this->elem[5],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";


      	if (!empty($this->elem[6]))
      		$return_string .= number_format($this->elem[6],0,'.',',')."/";
      	else
      		$return_string .= "-"."/";
      }
      return $return_string;
    }
    return "N/A";
  }

}

?>
