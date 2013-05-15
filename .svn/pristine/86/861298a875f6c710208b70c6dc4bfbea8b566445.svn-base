<?php
/**
* @package care_api
*/
/**
*  Dropdown methods. 
*  Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Robert Meggle
* @version beta 1.0.0
* @copyright 2005 Robert Meggle
* @package care_api
*/

/**
*/
require_once($root_path.'include/care_api_classes/class_core.php');

class Language extends Core {

  var $debug = FALSE;
  
  function getList($table, $field, $filter) {
    global $db;
    $this->sql = "select $field AS _res from $table GROUP BY $filter";
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE; 
		return ( $this->res['_res']=$db->Execute($this->sql) ) ? $this->res['_res'] : FALSE;
  }
  
  function createSelectForm(){
    global $db;
    
  }
}