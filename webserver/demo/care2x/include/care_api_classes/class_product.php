<?php
/**
* @package care_api
*/
/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');
/**
*  Product methods. 
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/
class Product extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for pharmay order lists
	*/
	var $tb_polist='care_pharma_orderlist'; 
	/**
	* Table name for pharmacy order catalog
	*/
	var $tb_pocat='care_pharma_ordercatalog'; 
	/**
	* Table name for pharmacy main products
	*/
	var $tb_pmain='care_pharma_products_main';
	/**
	* Table name for medical depot order lists
	*/
	var $tb_molist='care_med_orderlist';
	/**
	* Table name for medical depot order catalog
	*/
	var $tb_mocat='care_med_ordercatalog';
	/**
	* Table name for medical depot main products
	*/
	var $tb_mmain='care_med_products_main';
	/**#@-*/
	
	/**
	* Field names of care_pharma_ordercatalog or care_med_ordercatalog tables
	* @var array
	*/
	var $fld_ocat=array('item_no',
								'dept_nr',
								'hit',
								'artikelname',
								'bestellnum',
								'minorder',
								'maxorder',
								'proorder');
	/**
	* Field names of care_pharma_products_main or care_med_products_main tables
	* @var array
	*/
	var $fld_prodmain=array('bestellnum',
										'artikelnum',
										'industrynum',
										'artikelname',
										'generic',
										'description',
										'packing',
										'minorder',
										'maxorder',
										'proorder',
										'picfile',
										'encoder',
										'enc_date',
										'enc_time',
										'lock_flag',
										'medgroup',
										'cave',
										'status',
										'history',
										'modify_id',
										'modify_time',
										'create_id',
										'create_time');

	/**
	* Constructor
	*/				
	function Product(){
	}
	/**
	* Sets the core object to point  to either care_pharma_orderlist or care_med_orderlist table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useOrderList($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_polist;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_molist;
		}else{return false;}
	}
	/**
	* Sets the core object to point  to either care_pharma_ordercatalog or care_med_ordercatalog table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useOrderCatalog($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pocat;
			$this->ref_array=$this->fld_ocat;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_mocat;
			$this->ref_array=$this->fld_ocat;
		}else{return false;}
	}
	/**
	* Sets the core object to point  to either care_pharma_products_main or care_med_products_main table and field names.
	*
	* The table is determined by the parameter content. 
	* @access public
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function useProduct($type){
		if($type=='pharma'){
			$this->coretable=$this->tb_pmain;
			$this->ref_array=$this->fld_prodmain;
		}elseif($type=='medlager'){
			$this->coretable=$this->tb_mmain;
			$this->ref_array=$this->fld_prodmain;
		}else{return false;}
	}
	/**
	* Deletes an order.
	* @access public
	* @param int Order number
	* @param string Determines the final table name 
	* @return boolean.
	*/
	function DeleteOrder($order_nr,$type){
		$this->useOrderList($type);
		$this->sql="DELETE  FROM $this->coretable WHERE order_nr='$order_nr'";
       	return $this->Transact();
	}
	/**
	* Returns the actual order catalog of a department.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains catalog  data with  index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function ActualOrderCatalog($dept_nr,$type=''){
		global $db;
		if(empty($type)||empty($dept_nr)) return false;
		$this->useOrderCatalog($type);
		$this->sql="SELECT * FROM $this->coretable WHERE dept_nr='$dept_nr' ORDER BY hit DESC";
        if($this->res['aoc']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['aoc']->RecordCount()) {
				return $this->res['aoc'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Saves (inserts)  an item in the order catalog.
	*
	* The data must be passed by reference with associative array.
	* Data must have the index keys as outlined in the <var>$fld_ocat</var> array.
	* @access public
	* @param array Data to save
	* @param string Determines the final table name 
	* @return boolean
	*/
	function SaveCatalogItem(&$data,$type){
		if(empty($type)) return false;
		$this->useOrderCatalog($type);
		$this->data_array=&$data;
		return $this->insertDataFromInternalArray();
	}
	/**
	* Deletes a catalog item based on its item number key.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function DeleteCatalogItem($item_nr,$type){
		if(!$item_nr||!$type) return false;
		$this->useOrderCatalog($type);
		$this->sql="DELETE  FROM $this->coretable WHERE item_no='$item_nr'";
       	return $this->Transact();
	}
	/**
	* Returns all orders of a department marked as draft or are still unsent.
	*
	* The returned adodb record object contains rows of arrays.
	* Each array contains order  data with the following index keys:
	* - order_nr = order's primary key number
	* - dept_nr = department number      
	* - order_date = date of ordering
	* - order_time = time of ordering   
	* - articles = ordered articles                
	* - extra1 = extra notes                
	* - extra2 = extra notes                
	* - validator = validator's name                
	* - ip_addr = IP address of the workstation that send the order            
	* - priority = priority level                
	* - status = record's status                
	* - history = record's history                
	* - modify_id = name of user                
	* - modify_time = modify time stamp in yyyymmddhhMMss format              
	* - create_id = name of use                
	* - create_time = creation time stamp in yyyymmddhhMMss format    
	* - sent_datetime = date and time sent in yyyy-mm-dd hh:MM:ss format              
	* - process_datetime = date and time processed in yyyy-mm-dd hh:MM:ss format              

	* @access public
	* @param int Department number
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function OrderDrafts($dept_nr,$type){
		global $db;
		if(empty($type)||empty($dept_nr)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable
						WHERE sent_datetime = '".DBF_NODATETIME."'
						AND validator=''
						AND (status='draft' OR status='')
						AND dept_nr=$dept_nr
						ORDER BY order_date";

        if($this->res['od']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['od']->RecordCount()) {
				return $this->res['od'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Returns all pending orders or orders with  "acknowledge and print" status. 
	*
	* These orders are marked in the table as "pending" or "ack_print".
	* For detailed structure of the returned data, see <var>OrderDrafts()</var> method.
	* @access public
	* @param string Determines the final table name 
	* @return mixed adodb record object or boolean
	*/
	function PendingOrders($type){
		global $db;
		if(empty($type)) return false;
		$this->useOrderList($type);
		$this->sql="SELECT * FROM $this->coretable WHERE status='pending' OR status='ack_print' ORDER BY sent_datetime DESC";

        if($this->res['po']=$db->Execute($this->sql)) {
            if($this->rec_count=$this->res['po']->RecordCount()) {
				return $this->res['po'];
			} else { return false; }
		} else { return false; }
	}
	/**
	* Checks if the product exists based on its primary key number.
	* @access public
	* @param int Item number
	* @param string Determines the final table name 
	* @return boolean
	*/
	function ProductExists($nr=0,$type=''){
		global $db;
		if(empty($type)||!$nr) return false;
		$this->useProduct($type);
		$this->sql="SELECT bestellnum FROM $this->coretable WHERE bestellnum='$nr'";

        if($buf=$db->Execute($this->sql)) {
            if($buf->RecordCount()) {
				return true;
			} else { return false; }
		} else { return false; }
	}
}
?>
