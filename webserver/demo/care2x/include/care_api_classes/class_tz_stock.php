<?php
require_once($root_path.'include/care_api_classes/class_tz_pharmacy.php');


/**
*  Stock methods for tanzania (the product-module is completely rewritten by Alexander Irro)
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Alexander Irro (Version 1.0.0) - alexander.irro@merotech.de
* @copyright 2006 Robert Meggle (MEROTECH info@merotech.de)
* @package care_api from Elpidio Latirilla
*/



class Stock_tz extends Product {

  var $test;

  // Constructor
  function Stock_tz() {
    return TRUE;
  }

  //------------------------------------------------------------------------------
  // Methods:


    function get_order_array_search_results($keyword, $supplier){
 	global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;

    if ($debug) echo "class_tz_diagnostics::get_order_array_select_results starts here<br>";
    if($keyword=="*")
    {
	    $this->sql="SELECT `Supplier_item_id1`, `Supplier_item_id2`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize`, 100 as plausibility, `Supplier_item_name` FROM care_tz_stock_supplier_lists
                WHERE Supplier_id = ".$supplier;
	    return $db->Execute($this->sql);

  	}
  	else
  	{
    // Just after 3 letters, try to find a keyword:
    if (strlen($keyword)<=3)
      return $this->get_all_order_items();

    // Create the temporary table:
    $this->sql="CREATE TEMPORARY TABLE ".$this->tbl_temp." (
                `Supplier_item_id1` VARCHAR( 30 ) ,
                `Supplier_item_id2` VARCHAR( 30 ) ,
                `plausibility` INT UNSIGNED,
                `Supplier_item_name` VARCHAR(100),
                `Supplier_item_description` VARCHAR(255),
                `Supplier_item_packsize` VARCHAR(30)
                ) TYPE = HEAP ";

    // Get at first a list of all item_numbers
    $db->Execute($this->sql);

    $this->arr_nice_factor = array();
    if ($debug)
      //$this->sql="SELECT `item_id`, `item_description` FROM ".$this->tbl_product_items." where diagnosis_code LIKE \"B5%\" LIMIT 1,100";
      $this->sql="SELECT `Supplier_item_id1`, `Supplier_item_id2`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize` FROM care_tz_stock_supplier_lists WHERE Supplier_id = ".$supplier;
    else
        $this->sql="SELECT `Supplier_item_id1`, `Supplier_item_id2`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize` FROM care_tz_stock_supplier_lists WHERE Supplier_id = ".$supplier;


    if ($debug) echo "class_tz_diagnostics::get_order_array_select_results -> TMP-table is created<br>";

    $this->arr_keywords = explode (" ", $keyword);

    if ($debug) echo "class_tz_diagnostics::get_order_array_select_results -> keyword >".$keyword."< is splitted into ".count($this->arr_keywords)." words<br>";

    $this->EXACT_MATCH=FALSE;
	if ($this->rs_tbl=$db->Execute($this->sql))
	    while ($this->row_elem = $this->rs_tbl->FetchRow()) {
	      if ($debug) echo "class_tz_diagnostics::get_order_array_select_results -> reading to the description >>".$this->row_elem[$this->tbl_col_content]."<<<br>";
	      if ($debug) echo $this->row_elem['Supplier_item_name'];
	      $this->arr_tbl_col_content = explode (" ", $this->row_elem['Supplier_item_name']);

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
	              if ($debug) echo 'DEBUG: '.$this->nice_factor.'<br>';
	              // Step 1: Function value of levensthein comparison:
	              $this->nice = - 1/2 * $levenshtein + strlen($keyword_value);
	              if ($debug) echo 'Nice: '.$this->nice.'= -1/2 * '.$levenshtein.' + '.strlen($keyword_value).'<br>';
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
        $this->sql="INSERT INTO ".$this->tbl_temp." (`Supplier_item_id1`,`Supplier_item_id2`,`plausibility`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize`) VALUES ('".$this->row_elem['Supplier_item_id1']."','".$this->row_elem['Supplier_item_id2']."',".round($this->nice_factor,0).",'".$this->row_elem['Supplier_item_name']."','".$this->row_elem['Supplier_item_description']."','".$this->row_elem['Supplier_item_packsize']."')";
        if ($debug) echo $this->sql."<br>";
        $db->Execute($this->sql);
        $this->EXACT_MATCH=FALSE; // Reset the exact match flag
      }
      $this->arr_nice_factor=array();





    } // end of while ($this->row_elem = $this->rs_tbl->FetchRow())
      $this->sql="SELECT `Supplier_item_id1`, `Supplier_item_id2`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize` FROM ".$this->tbl_temp." ORDER BY plausibility DESC LIMIT 0,40";
      return $db->Execute($this->sql);
  }
 }





  //------------------------------------------------------------------------------

  function get_all_order_items($supplier){
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT `Supplier_item_id1`, `Supplier_item_id2`, `Supplier_item_name`, `Supplier_item_description`, `Supplier_item_packsize`, 'n/a' as plausibility FROM care_tz_stock_supplier_lists ORDER BY Supplier_item_id1, Supplier_item_name WHERE Supplier_id = ".$supplier;
    return $db->Execute($this->sql);
  }

  //------------------------------------------------------------------------------

   function get_order_description($Supplier_item_id1) {
    global $db;
    $db->debug=false;
    $this->sql="SELECT Supplier_item_name, Supplier_item_packsize FROM care_tz_stock_supplier_lists WHERE Supplier_item_id1='".$Supplier_item_id1."'";
    $this->rs = $db->Execute($this->sql);
    if ($this->rs->RecordCount()) {
      $this->elem = $this->rs->FetchRow();
      return $this->elem[0].' ('.$this->elem[1].' Pcs.)';
    }
    return "N/A";
  }

  //------------------------------------------------------------------------------

  function get_stock_suppliers(){
    global $db;
    $debug=false;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT ID, Name FROM care_tz_stock_suppliers ORDER by Name ASC";
    $result =  $db->Execute($this->sql);
    while($row = $result->FetchRow())
    	$suppliers[$row['ID']] = $row['Name'];
    return $suppliers;
  }

  //------------------------------------------------------------------------------

    function get_all_stock_amounts($orderby, $purchasing_class='all'){
    global $db;
    $debug=true;

    if($debug) echo 'get_all_stock_amounts('.$orderby.', '.$purchasing_class.'); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    switch($orderby)
    {
    	case 'ID':
    		$orderby="das.item_id ASC";
    		break;
    	case 'Description':
    		$orderby="item_description ASC";
    		break;
    	case 'AboveReorderlevel':
    		$orderby="item_description ASC";
    		break;
    	case 'ReorderlevelReached':
    		$orderby="item_description ASC";
    		break;
    	case 'MinimumlevelReached':
    		$orderby="item_description ASC";
    		break;

    	default:
    		$orderby="Drugamount DESC";
    		break;
    }
    switch($purchasing_class)
    {
    	case 'all':
    		$filter="WHERE das.purchasing_class='drug_list' OR das.purchasing_class='supplies' OR das.purchasing_class='supplies_laboratory'";
    		break;
    	case 'drug_list':
    		$filter="WHERE das.purchasing_class = 'drug_list'";
    		break;
    	case 'supplies':
    		$filter="WHERE das.purchasing_class = 'supplies'";
    		break;
    	case 'supplies_laboratory':
    		$filter="WHERE das.purchasing_class = 'supplies_laboratory'";
    		break;
    }

    $this->sql="SELECT das.purchasing_class, das.item_id, das.item_description, sip.Maximumlevel, sip.Reorderlevel, sip.Minimumlevel, count( sia.ID ) AS Drugamount
	FROM `care_tz_drugsandservices` das
	LEFT JOIN care_tz_stock_item_amount sia ON das.item_id = sia.Drugsandservices_id
	LEFT JOIN care_tz_stock_item_properties sip ON das.item_id = sip.Drugsandservices_id
	$filter
	GROUP BY das.item_id, das.purchasing_class
	ORDER BY ".$orderby;
    $result =  $db->Execute($this->sql);
    while($row = $result->FetchRow())
    	$stock[] = $row;
    return $stock;
  }

   //------------------------------------------------------------------------------

   function get_stock_amounts_of_drugsandservices_id($drugsandservices_id){
    global $db;
    $debug=true;
    if($debug) echo 'get_stock_amounts_of_drugsandservicesid('.$drugsandservices_id.'); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if(!is_numeric($drugsandservices_id) || !is_numeric(CURRENT_STOCK_ID)) return false;

    $this->sql="SELECT sim.ID, sim.Timestamp, sim.Timestamp_change, das.item_description FROM care_tz_stock_item_amount sim, care_tz_drugsandservices das WHERE sim.Drugsandservices_id = das.item_id AND Stock_place_id=".CURRENT_STOCK_ID." AND Drugsandservices_id = ".$drugsandservices_id." ORDER BY Timestamp ASC";
    $result =  $db->Execute($this->sql);
    while($row = $result->FetchRow())
    	$stock[] = $row;
    return $stock;
  }

   //------------------------------------------------------------------------------

    function get_pending_transfers(){
    global $db;
    $debug=false;
    if($debug) echo 'get_pending_transfers(); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT ID, Drugsandservices_id, Amount, Transfer_from, Transfer_to, Timestamp_started, Timestamp_finished" .
    		" FROM care_tz_stock_transfer WHERE Timestamp_started < ".time()." AND Timestamp_finished = 0 AND Cancel_flag = 0 ORDER by Timestamp_started DESC, Drugsandservices_id ASC";
    $result =  $db->Execute($this->sql);
    while($row = $result->FetchRow())
    	$transfers[] = $row;
    return $transfers;
  }

   //------------------------------------------------------------------------------

    function transfer_insert_into_stock($id){
    global $db;
    $debug=false;
    if($debug) echo 'transfer_insert_into_stock('.$id.'); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT ID, Drugsandservices_id, Transfer_from, Transfer_to, Timestamp_started, Timestamp_finished" .
    		" FROM care_tz_stock_transfer WHERE ID=$id";
    $result =  $db->Execute($this->sql);
    if($row = $result->FetchRow())
    {
    	$itemtotransfer = $row;
    	$this->sql="UPDATE care_tz_stock_transfer SET Timestamp_finished=".time()." WHERE ID=".$id;
    	$result =  $db->Execute($this->sql);
    	$this->sql="INSERT INTO care_tz_stock_item_amount SET " .
    			"Drugsandservices_id=".$itemtotransfer['Drugsandservices_id'].", " .
    			"Stock_place_id=".CURRENT_STOCK_ID."," .
    			"Timestamp=".time();
    	$result =  $db->Execute($this->sql);
    	return true;
    }
    return false;
  }

   //------------------------------------------------------------------------------

      function transfer_update($id,$newdrugid,$amount){
	    global $db;
	    $debug=false;
	    if($debug) echo 'transfer_update('.$id.', '.$newdrugid.', '.$amount.'); ';
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->sql="UPDATE care_tz_stock_transfer SET Drugsandservices_id=".$newdrugid.", Amount=".$amount." WHERE ID=".$id;
	    $result =  $db->Execute($this->sql);
	    return true;
	}

   //------------------------------------------------------------------------------

    function transfer_cancel($id){
	    global $db;
	    $debug=false;
	    if($debug) echo 'transfer_cancel('.$id.'); ';
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    $this->sql="UPDATE care_tz_stock_transfer SET Timestamp_finished=".time().", Cancel_flag=1 WHERE ID=".$id;
	    $result =  $db->Execute($this->sql);
	    return true;
	}

   //------------------------------------------------------------------------------

  function create_new_transfer($Drugsandservices_id, $Transfer_from, $Transfer_to){
    global $db;
    $debug=false;
    if($debug) echo 'create_new_transfer('.$Drugsandservices_id.', '.$Transfer_from.', '.$Transfer_to.'); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if(!is_numeric($Drugsandservices_id) || !is_numeric($Transfer_from) || !is_numeric($Transfer_to))
    	return false;
    $this->sql="INSERT INTO care_tz_stock_transfer SET" .
    		"	Drugsandservices_id=".$Drugsandservices_id."," .
    		"	Transfer_from=".$Transfer_from.",".
    		"	Transfer_to=".$Transfer_to.",".
    		"	Timestamp_started=".time();
    $result =  $db->Execute($this->sql);
    return $result;
  }

  //------------------------------------------------------------------------------

  function get_all_stocks(){
    global $db;
    $debug=true;
    if($debug) echo 'get_pending_transfers(); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT ID, Stockname, Stocktype, flag_disabled FROM care_tz_stock_place ORDER BY ID ASC";
    if ($result =  $db->Execute($this->sql))
	    while($row = $result->FetchRow())
	    	$stocks[] = $row;
    return $stocks;
  }

  //------------------------------------------------------------------------------

  function get_all_stocktypes(){
    global $db;
    $debug=false;
    if($debug) echo 'get_all_stocktypes(); ';
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT ID, Description, Stocktype FROM care_tz_stock_place_types ORDER BY ID ASC";
    $result =  $db->Execute($this->sql);
    while($row = $result->FetchRow())
    	$types[] = $row;
    return $types;
  }

   //------------------------------------------------------------------------------

	function stock_update($id, $description, $type, $trigger){
	    global $db;
	    $debug=false;
	    if($debug) echo 'stock_update('.$id.', '.$description.', '.$type.', '.$trigger.'); ';
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if($trigger) $trigger=1; else $trigger =0;
	    $this->sql="UPDATE care_tz_stock_place SET Stockname='".$description."', Stocktype='".$type."', flag_disabled=".$trigger." WHERE ID=".$id;
	    $result =  $db->Execute($this->sql);
	    return true;
	}

}

?>
