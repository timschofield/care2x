<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
/**
* @package care_api
*/
/** */
require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_weberp_c2x.php');
//require_once($root_path.'include/care_api_classes/class_diagnostics.php');

/**
*  Prescription methods.
*
* Note this class should be instantiated only after a "$db" adodb  connector object  has been established by an adodb instance
* @author Elpidio Latorilla
* @version beta 2.0.1
* @copyright 2002,2003,2004,2005,2005 Elpidio Latorilla
* @package care_api
*/

class Prescription extends Core {
	/**#@+
	* @access private
	* @var string
	*/
	/**
	* Table name for prescription data
	*/
	var $tb='care_encounter_prescription';
	/**
	* Table name for application types
	*/
	var $tb_app_types='care_type_application';
	/**
	* Table name for prescription types
	*/
	var $tb_pres_types='care_type_prescription';
	/**
	* Table for drugs and supplies
	*/
	var $tb_drugsandservices='care_tz_drugsandservices';
	/**#@-*/

	/**#@+
	* @access private
	*/
	/**
	* SQL query result buffer
	* @var adodb record object
	*/
	var $result;
	var $sql;
	/**
	* Preloaded department data
	* @var adodb record object
	*/
	var $preload_dept;
	/**
	* Preloaded data flag
	* @var boolean
	*/
	var $is_preloaded=false;
	/**
	* Number of departments
	* @var int
	*/
	var $dept_count;
	/**
	* Field names of care_encounter_prescription table
	* @var int
	*/
	var $tabfields=array('nr',
						'encounter_nr',
						'prescription_type_nr',
						'article',
						'article_item_number',
						'price',
						'drug_class',
						'order_nr',
						'dosage',
						'times_per_day',
						'days',
						'application_type_nr',
						'notes',
						'prescribe_date',
						'prescriber',
						'color_marker',
						'is_stopped',
						'is_outpatient_prescription',
						'is_disabled',
						'stop_date',
						'status',
						'history',
						'bill_number',
						'bill_status',
						'modify_id',
						'modify_time',
						'create_id',
						'create_time',
						'priority');
	/**#@-*/

	/**
	* Constructor
	*/
	function Prescription(){
		$this->setTable($this->tb);
		$this->setRefArray($this->tabfields);
	}
	/**
	* Gets all prescription types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - type = prescription type
	* - name = type default name
	* - LD_var = variable's name for the foreign laguange version of type's name
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getPrescriptionTypes(){
		global $db;
		$debug = false;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($this->result=$db->Execute('SELECT nr,type,name,LD_var FROM '.$this->tb_pres_types)) {
			if ($this->result->RecordCount()) {
				return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	/**
	* Gets all application types returned in a 2 dimensional array.
	*
	* The resulting data have the following index keys:
	* - nr = the primary key number
	* - group_nr = the group number
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @return mixed array or boolean
	*/
	function getAppTypes(){
		global $db;
		$debug = FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($this->result=$db->Execute('SELECT nr,group_nr,type,name,LD_var,description FROM '.
			$this->tb_app_types.' ORDER BY name ASC')) {
			if ($this->result->RecordCount()) {
				return $this->result->GetArray();
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	/**
	* Gets the information of an application type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - group_nr = the group number
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getAppTypeInfo($type_nr){
		global $db;
		$debug = false;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($this->result=$db->Execute('SELECT type,group_nr,name,LD_var,description FROM '.$this->tb_app_types .
			' WHERE nr='.$type_nr)) {
			if ($this->result->RecordCount()) {
				return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	/**
	* Gets the information of a prescription type based on its type number key.
	*
	* The resulting data have the following index keys:
	* - type = application type
	* - name = application's default name
	* - LD_var = variable's name for the foreign laguange version of application's name
	* - description =  description
	*
	* @access public
	* @param int Type number
	* @return mixed array or boolean
	*/
	function getPrescriptionTypeInfo($type_nr){
		global $db;
		$debug = false;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($this->result=$db->Execute('SELECT type,name,LD_var,description FROM '.$this->tb_pres_types.' WHERE nr='
				.$type_nr)) {
			if ($this->result->RecordCount()) {
				return $this->result->FetchRow();
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	/**
	* Merotech customation methods
	*/

	function getDrugList($class, $is_enabled ) {
		global $db;
		global $is_transmit_to_weberp_enable;
		echo $class;
		$weberp_cat = '';
		if($is_enabled) $query = " AND ".substr($is_enabled, 0, strlen($is_enabled)-1)." = 1";
		else $query = "";
		$debug = FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		if($class =='drug_list')
		{
			$weberp_cat = 'A';
		}
		else
		if($class =='supplies')
                {
                        $weberp_cat = 'B';
                }
                else
                if($class =='dental')
                {
                        $weberp_cat = 'DS';
                }
                else
		if($class =='service')
                {
                        $weberp_cat = 'S';
                }
		else
		if($class =='xray')
                {
                        $weberp_cat = 'X';
                }
                else
                if($class =='eye-service')
                {
                        $weberp_cat = 'EP';
                }
                else
                if($class =='minor_proc_op')
                {
                        $weberp_cat = 'MS';
                }
                else
                if($class =='obgyne_op')
                {
                        $weberp_cat = 'OB';
                }
		 else
                if($class =='ortho_op')
                {
                        $weberp_cat = 'OT';
                }
                else
                if($class =='surgical_op')
                {
                        $weberp_cat = 'SP';
                }


		$this->sql='SELECT  item_description as description, item_id as drug_id, partcode as stockid, not_in_use FROM '.
			$this->tb_drugsandservices.' WHERE purchasing_class = "'.$class.'" '.$query.' ORDER BY item_description';

			$this->result=$db->Execute($this->sql);
			$typeno=substr($is_enabled, strlen($is_enabled)-1, 1);

			$types=array('%','','Tablets','Syrups','Suspensions','Injections','Others','Procedure');

			if ($is_transmit_to_weberp_enable==1) {
				$weberp_obj = new_weberp();

				#echo $weberp_cat.'======'.$weberp_cat;

				$items=$weberp_obj->get_stock_items_from_category_property($types[$typeno],$weberp_cat);

				$c2x_items=$this->result->GetArray();

				for ($i=0; $i<sizeof($c2x_items); $i++) {
					$itemlist_c2x[$c2x_items[$i]['stockid']]=$c2x_items[$i]['drug_id'];
				}

				for ($i=0; $i<sizeof($items); $i++) {
					$itemlist[$i]['description']=$items[$i]['description'];
					$itemlist[$i]['drug_id']=$itemlist_c2x[$items[$i]['stockid']];
				}
				return $itemlist;

			} else {

				// webERP is not available
				if ($this->result=$db->Execute($this->sql)) {

					if ($this->result->RecordCount()) {

						$items=$this->result->GetArray();

						return $items;

					} else {

						return false;
					}
				} else {
					return false;
				}
			} // end of if ($is_transmit_to_weberp_enable==1)


	} // end of function getDrugList($class, $is_pediatric, $is_adult, $is_other, $is_consumable )

	function insert_prescription($encounter_nr,$drug_list_id,$type) {
		global $db;
		global $is_transmit_to_weberp_enable;
		if ($type==1) {
			$sql='select item_id from care_tz_drugsandservices where item_number="'.$drug_list_id.'"';
			$result=$db->Execute($sql);
			$row=$result->FetchRow();
			$item=$row['item_id'];
		} else {
			$item=$drug_list_id;
		}
		$enc_obj = new Encounter;
		//$diag_obj_sub = new Diagnostics;
		//$diag_obj = new Diagnostics;
		$debug = false;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($debug) echo "class prescription::insert_prescription($encounter_nr, $drug_list_id, $type)<br>";
		$enc_class=$enc_obj->EncounterClass($encounter_nr);
		if ($enc_class==2) {
			$class = 1;
		} else {
			$class = 0;
		}
		$this->sql="INSERT INTO ".$this->tb." (
			`nr`,
			`encounter_nr` ,
			`prescription_type_nr` ,
			`article` ,
			`article_item_number` ,
			`price` ,
			`drug_class` ,
			`order_nr` ,
			`dosage` ,
			`times_per_day` ,
			`days` ,
			`total_dosage` ,
			`application_type_nr` ,
			`notes` ,
			`prescribe_date` ,
			`prescriber` ,
			`color_marker` ,
			`is_stopped` ,
			`is_outpatient_prescription` ,
			`is_disabled` ,
			`stop_date` ,
			`status` ,
			`history` ,
			`bill_number` ,
			`bill_status` ,
			`modify_id` ,
			`modify_time` ,
			`create_id` ,
			`create_time` )
		VALUES (
			null,
			'".$encounter_nr."',
			'0',
			'".$this->GetNameOfItem($item)."',
			'".$item."',
			'".$this->GetPriceOfItem($item)."',
			'".$this->GetClassOfItem($item)."',
			'01',
			'1',
			'1',
			'1',
			'1',
			'01',
			'0',
			NOW(),
			'".$_SESSION['sess_user_name']."',
			'1',
			'0',
			'".$class."',
			NULL ,
			NULL ,
			'pending',
			'Create: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."'\n ,
			'0',
			'',
			'',
			'".date('Y-m-d H:i:s')."',
			'".$_SESSION['sess_user_name']."',
			NOW()
		)";
//echo $this->sql;
		if ($debug) echo $this->sql;
		$db->Execute($this->sql);
		if($is_transmit_to_weberp_enable)
		{
			$this->sql='select partcode from '.$this->tb_drugsandservices.' where item_id="'.$drug_list_id.'"';
			$result=$db->Execute($this->sql);
			$itemrow = $result->FetchRow();
			$WONumber=$WONumberArray[0];
			$weberp_obj = new_weberp();
			$weberp_obj->stock_adjustment_in_webERP($WONumber);
			weberp_destroy($weberp_obj);
		}
		return TRUE;
	} // end of function insert_prescription($encounter_nr, $drug_list_id)



	function insert_prescription_Radio($encounter_nr, $drug_list_id,$number_of_tests) {
	  global $db;
	  global $is_transmit_to_weberp_enable;
      $debug = FALSE;
      ($debug)?$db->debug=TRUE:$db->debug=FALSE;

	$enc_obj = new Encounter;

      if ($debug) echo "class prescription::insert_prescription_Radio($encounter_nr, $drug_list_id,$number_of_tests)<br>";

	  $enc_class=$enc_obj->EncounterClass($encounter_nr);
                if ($enc_class==2) {
                        $class = 1;
                } else {
                        $class = 0;
                }

	  $this->sql="INSERT INTO `care_encounter_prescription` ( " .
	  		"			" .
	  		"			`encounter_nr` , " .
	  		"			`prescription_type_nr` , " .
	  		"			`article` , " .
	  		"			`article_item_number` , " .
	  		"			`price` , " .
	  		"			`drug_class` , " .
	  		"			`order_nr` , " .
	  		"			`dosage` , " .
	  		"           `times_per_day` , " .
	  		"           `days` , " .
			"           `total_dosage` , " .
	  		"			`application_type_nr` , " .
	  		"			`notes` , " .
	  		"			`prescribe_date` , " .
	  		"			`prescriber` , " .
	  		"			`color_marker` , " .
	  		"			`is_stopped` , " .
	  		"			`is_outpatient_prescription` , " .
	  		"			`is_disabled` , " .
	  		"			`stop_date` , " .
	  		"			`status` , " .
	  		"			`history` , " .
	  		"			`bill_number` , " .
	  		"			`bill_status` , " .
	  		"			`modify_id` , " .
	  		"			`modify_time` , " .
	  		"			`create_id` , " .
	  		"			`create_time` )" .
	  		"VALUES (" .
	  		"			" .
	  		"			'".$encounter_nr."', " .
			"			'0', " .
	  		"			'".$this->GetNameOfItem($drug_list_id)."', " .
	  		"			'".$drug_list_id."', " .
	  		"			'".$this->GetPriceOfItem($drug_list_id)."', " .
	  		"			'xray', " .
	  		"			'01', " .
			"			'1', " .
	  		"			'1', " .
	  		"			'1', " .
	  		"			'".$number_of_tests."', " .
	  		"			'01', " .
	  		"			'1', " .
	  		"			NOW(), " .
	  		"			'".$_SESSION['sess_user_name']."', " .
	  		"			'1', " .
	  		"			'0', " .
			"			'".$class."', " .
	  		"			NULL , " .
	  		"			NULL , " .
	  		"			'', " .
	  		"			'', " .
	  		"			'0', " .
	  		"			'', " .
	  		"			'', " .
	  		"			NOW( ), " .
	  		"			'', " .
	  		"			NOW() );";

	if ($debug) echo $this->sql;
	$db->Execute($this->sql);

   return TRUE;

}

//TODO: check on enabled drugsandservices item!


	function GetItemNumberByID($item_id) {
		global $db;
		$debug = FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($debug) echo "class prescription::GetItemIDByNumber($item_id)<br>";

		if (!empty($item_id)){
			$this->sql = "SELECT item_number,partcode FROM $this->tb_drugsandservices WHERE item_id='".$item_id."'";

			if ($this->result=$db->Execute($this->sql)) {
				if ($this->row=$this->result->FetchRow()) {
					return $this->row['item_number'];
				}
			} // end of if ($this->result=$db->Execute($this->sql))
		} else {
			return FALSE;
		} // end of if (!empty($item_number))
	} // end of function GetItemIDByNumber($item_number)

	function GetItemIDByNumber($item_number) {
		global $db;
		$debug = FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		if ($debug) echo "class prescription::GetItemIDByNumber($item_number)<br>";
		if (!empty($item_number)){
			$this->sql = "SELECT item_id FROM $this->tb_drugsandservices WHERE item_number='".$item_number."'";
			if ($debug) echo $this->sql."<br>";
			if ($this->result=$db->Execute($this->sql)) {
				if ($this->row=$this->result->FetchRow()) {
					return $this->row['item_id'];
				}
			} // end of if ($this->result=$db->Execute($this->sql))
		} else {
			return FALSE;
		} // end of if (!empty($item_number))
	} // end of function GetItemIDByNumber($item_number)


function GetItemIDByName($article) {
    global $db;
    $debug=FALSE;
    ($debug)?$db->debug=TRUE:$db->debug=FALSE;

    $this->sql="SELECT item_id FROM $this->tb_drugsandservices WHERE item_description = '$article' ";
    if ($this->result=$db->Execute($this->sql)) {

		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;

		            return $v['item_id'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetItemIDByName($article)


	function DisplayBGColor($actual, $target) {
		//echo ($actual==$target) ?  'bgcolor="green"' : 'bgcolor="gray"';
		echo ($actual==$target) ?  'bgcolor="#CAD3EC"' : 'class="adm_input"';
		return TRUE;
	}

	function insertDrugItem() {
		global $db;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		$db->debug=FALSE;
		return $ret;
	}

	//TODO: check on enabled drugsandservices item!

	function DisplaySelectedItems($items) {
		global $db;
		if ($items) {
			$debug=FALSE;
			($debug)?$db->debug=TRUE:$db->debug=FALSE;
			$js_command = '<script language="javascript">';
			foreach($items as $item_no) {

				$this->sql="SELECT item_id as drug_id, item_description as description FROM ".
					$this->tb_drugsandservices." WHERE item_id = '".$item_no."' ";
				if ($this->result=$db->Execute($this->sql)) {
					if ($this->result->RecordCount()) {
						$this->item_array = $this->result->GetArray();
						while (list($x,$v)=each($this->item_array)) {
							$js_command .= "add_to_list('".$v['description']."', ".$v['drug_id'].");";
						}
					} else {
						return false;
					}
				}
			}
			$js_command .= '</script>';
			echo $js_command;
		}
		return TRUE;
	}

	function DisplayDrugs($drug_list) {
			sort($drug_list);
			if(is_array($drug_list))
			{
				while(list($x,$v)=each($drug_list)){
					echo '<option '.(($v['not_in_use']==1)?' disabled="disabled" style="color:red;" ':'').' value="'.$v['drug_id'].'">';
					echo $v['description'] . (($v['not_in_use']==1)?' &nbsp; &nbsp; &lsaquo;&mdash; Out Of Stock':'');
					echo '</option>
					';
				}
			}
	  return TRUE;
	}
//TODO: check on enabled drugsandservices item!

	function GetNameOfItem($item_number) {
		global $db;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		$this->sql="SELECT item_description as description FROM $this->tb_drugsandservices WHERE item_id = '".
			$item_number."' order by item_description DESC ";
		if ($this->result=$db->Execute($this->sql)) {
			if ($this->result->RecordCount()) {
				$this->item_array = $this->result->GetArray();
				while (list($x,$v)=each($this->item_array)) {
					$db->debug=FALSE;
					return $v['description'];
				}
			} else {
				$db->debug=FALSE;
				return false;
			}
		}
	} // end of function GetNameOfDrug($item_number)


//TODO: check on enabled drugsandservices item!

	function GetPriceOfItem($item_number) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$this->sql="SELECT unit_price as price FROM $this->tb_drugsandservices WHERE item_id = '".$item_number."' ";
		if ($this->result=$db->Execute($this->sql)) {
			if ($this->result->RecordCount()) {
				$this->item_array = $this->result->GetArray();
				while (list($x,$v)=each($this->item_array)) {
					$db->debug=FALSE;
					 return $v['price'];
				}
			} else {
				$db->debug=FALSE;
				return false;
			}
		}
	} // end of function GetPriceOfItem($item_number)


function GetClassOfItemFromItemNo($item_number) {
    global $db;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $this->sql="SELECT purchasing_class FROM $this->tb_drugsandservices WHERE item_number = '$item_number' ";
    if ($this->result=$db->Execute($this->sql)) {
		    if ($this->result->RecordCount()) {
		        $this->item_array = $this->result->GetArray();
		          while (list($x,$v)=each($this->item_array)) {
                $db->debug=FALSE;
		            return $v['purchasing_class'];
		          }
			} else {
			  $db->debug=FALSE;
				return false;
			}
		}
  } // end of function GetClassOfItemFromItemNo($item_number)


function GetSubClassOfItem($item_number) {
    global $db;
    global $is_transmit_to_weberp_enable;
    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    if ($is_transmit_to_weberp_enable==1) {
		$this->sql='SELECT partcode from care_tz_drugsandservices where item_id='.$item_number;

		if($this->result=$db->Execute($this->sql))
		{
		if ($this->result->RecordCount()) {
		$this->row=$this->result->GetArray();
		$weberp_obj=new_weberp();
		$property=$weberp_obj->getStockCatProperty('1', $this->row[0]['partcode']);
		switch ($property) {
			case 'Tablets':
			    return 'tabs';
			    break;
                        case 'Injections':
                            return 'injections';
                            break;
			case 'Syrups':
			    return 'syrups';
			    break;
			case 'Suspensions':
			    return 'suspensions';
			    break;
			 case 'Others':
                            return 'others';
                            break;
			 case '':
                            return '';
                            break;

			default:
			    return '';
		}
		}
		else {
			    return '';
		}
		}
    } else {
	$this->sql="SELECT sub_class FROM $this->tb_drugsandservices WHERE item_id = '$item_number' ";
        if ($this->result=$db->Execute($this->sql)) {
		if ($this->result->RecordCount()) {
			$this->item_array = $this->result->GetArray();
		        while (list($x,$v)=each($this->item_array)) {
                		$db->debug=FALSE;
				return $v['sub_class'];
		        }
		} else {
			$db->debug=FALSE;
			return false;
		}
	}
    }
} // end of function SubClassOfItem($item_number)


//TODO: check on enabled drugsandservices item!

	function GetClassOfItem($item_number) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$this->sql="SELECT purchasing_class FROM $this->tb_drugsandservices WHERE item_id = '".$item_number."' ";
		if ($this->result=$db->Execute($this->sql)) {
			if ($this->result->RecordCount()) {
				$this->item_array = $this->result->GetArray();
				while (list($x,$v)=each($this->item_array)) {
					$db->debug=FALSE;
					return $v['purchasing_class'];
				}
			} else {
				$db->debug=FALSE;
				return 0;
			}
		}
	} // end of function GetPriceOfItem($item_number)


	function GetPrescritptionItem($nr) {
		global $db;
		$debug=FALSE;
		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$this->sql="SELECT * FROM $this->tb WHERE nr = '$nr' ";
		if ($this->result=$db->Execute($this->sql)) {
			return $this->result->FetchRow();
		}
	} // end of function GetPriceOfItem($item_number)
}
?>
