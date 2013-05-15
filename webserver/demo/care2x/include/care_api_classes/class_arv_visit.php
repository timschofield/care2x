<?php
require_once($root_path.'include/care_api_classes/class_encounter.php');

class ARV_visit extends Encounter{
	
	var $arv_case_id;
	var $arv_visit_id;
	
	var $a_visit_data=array('create_time',
							'weight',
                            'other_problems',
                            'test_TB', 
						    'test_Cotrimoxazole',
						    'test_INH', 
						    'test_Difflucan',
						    'care_tz_arv_status_id',
						    'create_id');
						    
	var $a_item_no=array();
	var $r_item_no=array();
	var $lab_values=array();
	
	var $row_elem;
	var $sql;
	var $res;
	var $ok;
	var $error_message;
	var $msg_tpl_big ="<table class=\"mainTable\"><tr><td class=\"error2\">%s</td></tr></table>";
	
	function ARV_visit($enc_nr='',$arv_case_id='',$arv_visit_id='') {
		parent::Encounter($enc_nr);
		$this->arv_case_id=$arv_case_id;
		$this->arv_visit_id=$arv_visit_id;	
	}
	
//---------------------------------------------------------------------------------------------------	
	
	function set_visit_data($values,$a_item_no,$r_item_no) {
		$this->a_visit_data=$values;
		$this->a_item_no=$a_item_no;
		$this->r_item_no=$r_item_no;
	}
	
//---------------------------------------------------------------------------------------------------	
	function get_visit_data() {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT 
						care_tz_arv_case_id, 
						care_tz_arv_status_id, 
						create_time,
						weight, 
						test_TB, 
						test_Cotrimoxazole, 
						test_INH, 
						test_Difflucan,
						other_problems,
						create_id
					FROM care_tz_arv_visit 
					WHERE care_tz_arv_visit_id=".$this->arv_visit_id.";
					";
					
	    if ($this->res = $db->Execute($this->sql) AND ($this->row_elem = $this->res->FetchRow())){
			$this->a_visit_data=$this->row_elem;
			return $this->a_visit_data;
		}
		else {
			return false;
		}
	}
	
	function get_a_item_no() {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT 
						a.care_tz_arv_events_code_id,
						c.who_code,
						c.who_code_text
					FROM care_tz_arv_events a,
						care_tz_arv_events_code c
					WHERE a.care_tz_arv_events_code_id=c.care_tz_arv_events_code_id
					and care_tz_arv_visit_id=".$this->arv_visit_id.";
					";
		
		if (!$this->res = $db->Execute($this->sql)) {return false;}
		if(!($this->res->RecordCount())) {return false;}
		return $this->res;
	}
	
	function get_aidsdef_events() {
		if(!$this->res=$this->get_a_item_no()) return false;
		
		while ($this->row_elem = $this->res->FetchRow()) {
			$this->a_item_no[$this->row_elem[0]]=$this->row_elem[1].". ".$this->row_elem[2];
		}			
	    
	    return $this->a_item_no;
	}
	
	function get_aidsdef_codes() {
		if(!$this->res=$this->get_a_item_no()) return false;
		
		while ($this->row_elem = $this->res->FetchRow()) {
			$this->codes[$this->row_elem[0]]=$this->row_elem[1];
		}
		
		return $this->codes;
	}
	
	function get_arv_status_reasons() {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT 
						r.care_tz_arv_status_txt_id, 
						r.care_tz_arv_status_txt_code_id,
						r.notes,
						c.status_code,
						c.status_text
					FROM care_tz_arv_status_txt r, care_tz_arv_status_txt_code c
					WHERE r.care_tz_arv_status_txt_code_id=c.care_tz_arv_status_txt_code_id
					AND care_tz_arv_visit_id=".$this->arv_visit_id.";
					";
		
		$this->ok=$this->res = $db->Execute($this->sql);
		if(!($this->res->RecordCount())) {return false;}
		while ($this->row_elem = $this->res->FetchRow()) {
			$this->r_item_no[$this->row_elem[1]]=$this->row_elem[3].". ".$this->row_elem[4].": ".$this->row_elem[2];
		}			
	   
		return ($this->ok) ? $this->r_item_no : false;			
	    
	}
	
//---------------------------------------------------------------------------------------------------
	function insertNewVisit($values,$a_item_no,$r_item_no) {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->set_visit_data($values,$a_item_no,$r_item_no);
	  
			$this->sql_1="INSERT INTO care_tz_arv_visit SET
								care_tz_arv_case_id=".$this->arv_case_id.",
								care_tz_arv_status_id=".$this->a_visit_data['care_tz_arv_status_id'].",	
								encounter_nr=$this->enc_nr,
								weight='".$this->a_visit_data['weight']."',
								test_TB=".$this->a_visit_data['test_TB'].",
								test_Cotrimoxazole=".$this->a_visit_data['test_Cotrimoxazole'].",
								test_INH=".$this->a_visit_data['test_INH'].",
								test_Difflucan=".$this->a_visit_data['test_Difflucan'].",
								other_problems='".$this->a_visit_data['other_problems']."',
								history='Created ".date('Y-m-d H:i:s')." ".$this->a_visit_data['user'].";\n',
								create_id='".$this->a_visit_data['create_id']."',
								create_time=".time().";
								";
					    
			if(!$this->Transact($this->sql_1)) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Insert failed");
				return false;	
			}
			$this->arv_visit_id=$db->Insert_ID();
			while (list($x,$v) = each($this->a_item_no)) {	
				$this->sql_2="INSERT INTO care_tz_arv_events(
								care_tz_arv_events_id, 
								care_tz_arv_events_code_id, 
								care_tz_arv_visit_id)
							  VALUES (
								null,
								".$x.",
								".$this->arv_visit_id.");
								";
				
				if(!$this->Transact($this->sql_2)) {
					$this->error_message['db']=sprintf($this->msg_tpl_big,"Insert failed");
					return false;	
				}
			}
			
			while (list($x,$v) = each($this->r_item_no)) {	
				$temp=explode(":", $v,2);
				$this->sql_3="INSERT INTO care_tz_arv_status_txt SET
								care_tz_arv_visit_id=".$this->arv_visit_id.",
								care_tz_arv_status_txt_code_id=$x,
								notes='".trim($temp[1])."';
								";
		        
		        if(!$this->Transact($this->sql_3)) {
					$this->error_message['db']=sprintf($this->msg_tpl_big,"Insert failed");
					return false;	
				}
			}
			return true;
	}
	
//---------------------------------------------------------------------------------------------------	
	
	function updateVisit($values,$aids_def_events,$r_item_no) {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->set_visit_data($values,$aids_def_events,$r_item_no);
	    
	   	$this->sql="UPDATE care_tz_arv_visit SET 
						care_tz_arv_status_id=".$this->a_visit_data['care_tz_arv_status_id'].", 
						weight='".$this->a_visit_data['weight']."',
						test_TB=".$this->a_visit_data['test_TB'].", 
						test_Cotrimoxazole=".$this->a_visit_data['test_Cotrimoxazole'].", 
						test_INH=".$this->a_visit_data['test_INH'].", 
						test_Difflucan=".$this->a_visit_data['test_Difflucan'].", 
						other_problems='".$this->a_visit_data['other_problems']."', 
						history=".$this->ConcatHistory('Update'.' '.date('Y-m-d H:i:s').' '.$this->a_visit_data['create_id'].' ;\n').",
						modify_id='".$this->a_visit_data['create_id']."'
					WHERE care_tz_arv_visit_id=".$this->arv_visit_id."; 
					";
		
		if(!$db->Execute($this->sql)) {
			$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
			return false;	
		}
		
		$this->sql="DELETE FROM care_tz_arv_events WHERE care_tz_arv_visit_id=".$this->arv_visit_id.";";
		
		if(!$db->Execute($this->sql)) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
				return false;	
		}
		
		$this->sql="DELETE FROM care_tz_arv_status_txt WHERE care_tz_arv_visit_id=".$this->arv_visit_id.";";
		
		if(!$db->Execute($this->sql)) {
			$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
			return false;	
		}
		
		while (list($x,$v) = each($this->a_item_no)) {	
			$this->sql="INSERT INTO care_tz_arv_events(
							care_tz_arv_events_id, 
							care_tz_arv_events_code_id, 
							care_tz_arv_visit_id)
						  VALUES (
							null,
							".$x.",
							".$this->arv_visit_id.");
							";
			
			if(!$db->Execute($this->sql)) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
				return false;	
			}
		}
		
		while (list($x,$v) = each($r_item_no)) {	
			$temp=explode(":", $v);
			$this->sql="INSERT INTO care_tz_arv_status_txt SET
							care_tz_arv_visit_id=".$this->arv_visit_id.",
							care_tz_arv_status_txt_code_id=$x,
							notes='".trim($temp[1])."';
							";
	        
	        if(!$db->Execute($this->sql)) {
				$this->error_message['db']=sprintf($this->msg_tpl_big,"Update failed");
				return false;
	        }	
		}
		return true;
	}
	
//-------------------------------------------------------------------------------------------------------------------------------------------------------------	

	function getSelectedARVDrugs() {
	    global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT item_description, who_code
					FROM care_tz_drugsandservices
					WHERE purchasing_class = 'drug_list'
					AND is_consumable =1
					AND item_description IN 
						(SELECT article 
						 FROM care_encounter_prescription 
					WHERE encounter_nr=".$this->enc_nr.");
					";
					
	    if(!$this->res = $db->Execute($this->sql)) {return false;}
	    if(!($this->res->RecordCount())) {return false;}
		
	    return $this->res;     
	}
	
	function displaySelectedARVDrugs_table() {
	    global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if(!$this->res=$this->getSelectedARVDrugs()) {return false;}
					
	    $table_string="<table>\n";
	    
		while ($this->row_elem = $this->res->FetchRow()) {
			$table_string.="<tr><td>".$this->row_elem[1].".</td><td>".$this->row_elem[0]."</td></tr>\n"; 
		}		
	  
	    $table_string.="</table>\n"; 
	    return $table_string;     
	}
	
	function display_ARV_codes() {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if(!$this->res=$this->getSelectedARVDrugs()) {return false;}
	    
	    while ($this->row_elem = $this->res->FetchRow()) {
			$codes_string.=$this->row_elem[1]." | ";
		}
	    
	    return $codes_string;
	}

	function displayAllDrugs() {
		global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT item_description
					FROM care_tz_drugsandservices
					WHERE purchasing_class = 'drug_list'
					AND !is_consumable =1
					AND item_description IN 
						(SELECT article 
						 FROM care_encounter_prescription 
					WHERE encounter_nr=".$this->enc_nr.");
					";
					
	    $table_string="<table>\n";
	    if(!$this->res = $db->Execute($this->sql)) {return false;}
	    if(!($this->res->RecordCount())) {return false;}
		while ($this->row_elem = $this->res->FetchRow()) {
			$table_string.="<tr><td>".$this->row_elem[0]."</td></tr>\n"; 
		}		
	  
	    $table_string.="</table>\n"; 
	    return $table_string;     	    
	}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------	
	function getallLabResults() {
	    global $db;
		$debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    $this->sql="SELECT batch_nr, test_date, test_time,job_id, serial_value
					FROM care_test_findings_chemlab 
					WHERE encounter_nr=".$this->enc_nr."
					ORDER by job_id desc;";
		
	    if(!($this->res = $db->Execute($this->sql))) { return false;} 
	    
		$i=0;
		if(!($this->res->RecordCount())) {return false;}
	    while ($this->row_elem = $this->res->FetchRow()) {
			$temp=unserialize($this->row_elem['serial_value']);
			 
			while (list($x,$v) = each($temp)) {
				$this->lab_values[$i]['batch_nr']=$this->row_elem['batch_nr'];
				$this->lab_values[$i]['test_date']=$this->row_elem['test_date'];
				$this->lab_values[$i]['test_time']=$this->row_elem['test_time'];
				$this->lab_values[$i]['job_id']=$this->row_elem['job_id'];
				$this->lab_values[$i]['param_value']=$v;
				
				$this->sql="SELECT name, msr_unit, hi_bound, lo_bound, id
							FROM care_tz_laboratory_param
							WHERE id=$x";
							
				if(!($this->res1 = $db->Execute($this->sql))) {return false;}
				
				if(!($this->res1->RecordCount())) {return false;}
				$this->row_elem1 = $this->res1->FetchRow();
				
				$this->lab_values[$i]['param_name']=$this->row_elem1['name'];
				$this->lab_values[$i]['param_unit']=$this->row_elem1['msr_unit'];
				$this->lab_values[$i]['hi_bound']=$this->row_elem1['lo_bound'];
				$this->lab_values[$i]['lo_bound']=$this->row_elem1['lo_bound'];
				$this->lab_values[$i]['param_id']=$this->row_elem1['id'];
				$i++;
			}
		}	
		return $this->lab_values;	
	}
	
	function getAbnormal_Labresults() {
		if(!$temp=$this->getallLabResults()) {return false;};
		for ($i=0; $i<count($temp); $i++) {
			if(!empty($temp[$i]['hi_bound']) AND !empty($temp[$i]['lo_bound'])) {
				if ($temp[$i]['param_value']>$temp[$i]['hi_bound'] OR $temp[$i]['param_value']<$temp[$i]['lo_bound']) {
					$temp_new[]=$temp[$i];
				}
			}
			else {
				return $temp;
			}
		}
	}
	
	function getLabParamFromName($param_name) {
		if(!$temp=$this->getallLabResults()) {return false;};
		for ($i=0; $i<count($temp); $i++) {
			if ($temp[$i]['param_name']==$param_name) {
				
				return $temp[$i];
			}	
		}
		return false;
	}
	
	function displayLabResults_table() {
		global $date_format;
	    if(!$temp=$this->getAbnormal_Labresults()) {return false;}
		$table_string="<table>\n";
		
		$table_string.="<tr>
					     <td class=\"blue\">Date</td>
					     <td class=\"blue\">Name</td>
					     <td class=\"blue\">Value</td>
					     <td class=\"blue\">Unit</td>
					   </tr>";
		
		for ($i=0; $i<count($temp); $i++) {
			$table_string.="<tr>
					     		<td style=\"padding-right:18px;\">".formatDate2Local($temp[$i]['test_date'],$date_format,null,null)."</td>
					     		<td style=\"padding-right:18px;\">".$temp[$i]['param_name']."</td>
					     		<td style=\"padding-right:18px;\">".$temp[$i]['param_value']."</td>
					     		<td style=\"padding-right:18px;\">".$temp[$i]['param_unit']."&nbsp;</td>
					   		</tr>";
		}

	    $table_string.="</table>\n";    
	    return $table_string;     
	}
	
	function displayCD4_count() {
		if(!$temp=$this->getallLabResults()) {return false;}	
		$table_string="<table>";
		for ($i=0; $i<count($temp); $i++) {
			if ($temp[$i]['param_name']=='CD4') {
				$table_string.="<table>
					  <tr>
					    <td>".$temp[$i]['test_date']." ".$temp[$i]['test_time']."</td>
					    <td>&nbsp;</td>
					  </tr>
					  <tr>
					    <td>".$temp[$i]['param_value']."</td>
					    <td>".$temp[$i]['param_unit']."</td>
					  </tr>";
		$table_string.="</table>";
				return 	$table_string;
			}	
		}
		return false;
	}
	
	
	
	function displayLabParamFromName($param_name) {
		global $date_format;
		if(!$temp=$this->getLabParamFromName($param_name)) { return false; }
		$table_string="<table>\n";
		
		$table_string.="<tr>
					     	<td class=\"blue\">Date</td>
					     	<td class=\"blue\">Value</td>
					     	<td class=\"blue\">Unit</td>
					   </tr>";
		
		$table_string.="<tr>
				     		<td style=\"padding-right:18px;\">".formatDate2Local($temp['test_date'],$date_format,null,null)."</td>
				     		<td style=\"padding-right:18px;\">".$temp['param_value']."</td>
				     		<td style=\"padding-right:18px;\">".$temp['param_unit']."&nbsp;</td>
				   		</tr>";

	    $table_string.="</table>\n";    
	    return $table_string;   
	}  
	
//---------------------------------------------------------------------------------------------------------------------

	function getAIDSEventsGroups ($parent) {
    	global $db;
   		$debug=false;
        ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    	
		if (!isset($parent)) { $parent=1;}
			
    	$this->sql="SELECT care_tz_arv_events_code_id, who_code, who_code_text
                    FROM care_tz_arv_events_code
					WHERE parent=$parent
					ORDER by who_code asc;";
		
		 if ($this->res = $db->Execute($this->sql)) {
	  	 	return $this->res;
  		 }
  		 else {
  			return false;
  		 }
  	}
  	
  	function getARVStatusReasonGroup ($status_code) {
    	global $db;
   		$debug=false;
        ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		
		switch ($status_code) {
			case 1:
	   			$temp="2,3,4";
	  			break;
			case 2:
   				$temp="1";
   				break;
			case 3:
   				$temp="1";
   				break;
   			case 4:
   				$temp="2,3,4";
   				break;
   			case 5:
   				$temp="2,3,4";
   				break;
			default:
				$temp="1,2,3,4";
				break;
		}
    	
    	$this->sql="SELECT care_tz_arv_status_txt_code_id, status_code, status_text
					FROM care_tz_arv_status_txt_code
					WHERE care_tz_arv_status_txt_code_id IN ( $temp ) ";
		
		if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
  		}
  		else {
  			return false;
  		}
  	}
  	
//-------------------------------------------------------------------------------------------------------
  
  	function displayAIDSEventsGroups($selected,$parent) {
    	if(!$this->res = $this->getAIDSEventsGroups($parent)) {return false;}; 	
    	$counter=0;
    	while ($this->row_elem = $this->res->FetchRow()) {
    		if($this->row_elem[0] == $selected) $checked = 'selected'; else $checked= '';
     	 	echo "<option value=\"".$this->row_elem[0]."\" ".$checked.">Clinical Stage ".$this->row_elem[1].": ".$this->row_elem[2]."</option>\n";
    		$counter++;		
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}
  	
  	function displayARVStatusReasonGroup($selected,$status_code) {
    	$counter=0;
    	if(!$this->res = $this->getARVStatusReasonGroup($status_code)) {return false;}	
    	while ($this->row_elem = $this->res->FetchRow()) {
    		if($this->row_elem[0] == $selected) $checked = 'selected'; else $checked= '';
     	 	echo "<option value=\"".$this->row_elem[0]."\" ".$checked.">".$this->row_elem[2]."</option>\n";
    		$counter++;
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}

//---------------------------------------------------------------------------------------------------------------

	function getAIDSEventsGroups_Items($stage) {
	    global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if (empty($stage)) {
	    	return FALSE;
	    }
		
		$this->sql="SELECT care_tz_arv_events_code_id,who_code,who_code_text
                    FROM care_tz_arv_events_code
                    WHERE parent=$stage";
                    
	    if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
  		}
  		else {
  			return false;
  		}
    }
    
    function getARVStatusReasonGroup_Items($selected) {
	    global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
	    if (empty($selected)) { return FALSE; }
		
		$this->sql="SELECT care_tz_arv_status_txt_code_id, status_code, status_text              
					FROM care_tz_arv_status_txt_code
					WHERE parent=$selected";
	                
	    if ($this->res = $db->Execute($this->sql)) {
	  		return $this->res;
		}
		else {
			return false;
		}
    }
  
//-------------------------------------------------------------------------------------------------------------------

  	function displayAIDSEventsGroups_Items($selected) {
  		$counter=0;
  		if (empty($selected) || $selected==-1)
    	{
      		echo '<option value="-1"></opion>';
      		return false;
    	}
    	$this->res = $this->getAIDSEventsGroups_Items($selected);
    	while ($this->row_elem = $this->res->FetchRow()) {
      		echo "<option value=\"".$this->row_elem[0]."\">".$this->row_elem[1].". ".$this->row_elem[2]."</option>\n";
    		$counter++;
    	}
    	if(!$counter) echo '<option value="-1">Empty!</opion>';
    	return TRUE;
  	}
  	
  	function displayARVStatusReasonGroup_Items($selected) {
    	$counter=0;
    	if (empty($selected) || $selected==-1)
    	{
      		echo '<option value="-1">no entries</opion>';
      		return false;
    	}
    	$this->res = $this->getARVStatusReasonGroup_Items($selected);
    	while ($this->row_elem = $this->res->FetchRow()) {
      		echo "<option value=\"".$this->row_elem[0]."\">".$this->row_elem[1].". ".$this->row_elem[2]."</option>\n";
    		$counter++;	
    	}
    	if(!$counter) echo '<option value="-1">no entries</opion>';

    	return true;
  	}
  
//-------------------------------------------------------------------------------------------------------------------------------
  	function get_AIDSEventsDesc_from_code($code) {
  	 	global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if ($debug) echo $code;
	    
  		$this->sql="SELECT who_code,who_code_text
				    FROM care_tz_arv_events
                    WHERE care_tz_arv_events_id=$code";
		
		if ($this->res = $db->Execute($this->sql) AND ($this->row_elem = $this->res->FetchRow())){
			return $this->row_elem[0].". ".$this->row_elem[1];
		}
		else {
			return false;
		}
  	}

  	function get_ARVStatusReasonDesc_from_code($code) {
  	 	global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    if ($debug) echo $code;
	    
  		$this->sql="SELECT status_code,status_text 
                    FROM care_tz_arv_status_txt_code 
                    WHERE care_tz_arv_status_txt_code_id=$code";
		
		if ($this->res = $db->Execute($this->sql) AND ($this->row_elem = $this->res->FetchRow())){
			return $this->row_elem[0].". ".$this->row_elem[1];
		}
		else {
			return false;
		}
  	}
//---------------------------------------------------------------------------------------------------------------------	
	function displaySelectedAIDSEvents_Items($array){
		$counter=0;
	    if (empty($array))return FALSE;
	    while (list($x,$v) = each($array)) {
	    	echo "<option value=\"".$x."\">".$this->get_AIDSEventsDesc_from_code($v)."</option>\n";
	      	$counter++;
	    }
	    if(!$counter) echo '<option value="-1">Empty!</opion>';
  	}
	
	function displaySelected_Items($array){
	   $counter=0;
	   if (empty($array))return FALSE;
	   while (list($x,$v) = each($array)) {
	   		echo "<option value=\"".$x."\">".$v."</option>\n";
	      	$counter++;
	   }
	   if(!$counter) echo '<option value="-1">Empty!</opion>';
  	}
  	
//---------------------------------------------------------------------------------------------------------------------
	
	function displaySelectedAIDSEvents_table($itemlist) {
   		global $db;
	    $debug=false;
	    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
	    
   		if(empty($itemlist)) { return false;}
   		
   		$this->sql="SELECT who_code,who_code_text
				    FROM care_tz_arv_events
                    WHERE care_tz_arv_events_id IN (".implode(",",$itemlist).")";
         
        if(!$this->res = $db->Execute($this->sql)) {return true;}
	  	$table_string="<table>\n";
	  	while ($this->row_elem = $this->res->FetchRow()) {
	    	$table_string=$table_string."<tr><td>".$this->row_elem[0]."</td><td>".$this->row_elem[1]."</td></tr>\n";
	    } 
	    $table_string=$table_string."</table>\n"; 
	    return $table_string;     
   }
   
	function displaySelectedARVStatusReason_table($r_item_no) {
	    $table_string="<table>\n";
	    while (list($x,$v) = each($r_item_no)) {
	    	$table_string=$table_string."<tr><td>".$v."</td></tr>\n"; 
	    }
	    $table_string=$table_string."</table>\n"; 
	    return $table_string;     
   }
   
    function displaySelectedItems_table($array) {
   		if(!isset($array)) { return false; }
	    $table_string="<table>\n";
	    while (list($x,$v) = each($array)) {
	    	$part=explode(".",$v,2);
	    	$table_string=$table_string."<tr><td valign=\"top\">".$part[0].".</td><td>".$part[1]."</td></tr>\n"; 
	    }
	    $table_string=$table_string."</table>\n"; 
	    return $table_string;     
   }

//-----------------------------------------------------------------------------------------------------------------------------
	
	function get_Error_message($name='all') {
		if ($name=='all'){
			return $this->error_message;
		};
		return $this->error_message[$name];
	}
	
//----------------------------------------------------------------------------------------------------------------------------
	
	function filterData($val) {
		$val=trim($val);
		$val=htmlspecialchars($val);
		$val=strip_tags($val);
		return $val;
	}

	function querystring($name) {
#		global $HTTP_GET_VARS;
		reset ($_GET); 
		#stripslashes($_GET[$name]);
		$querystring="";
		$querystring=$querystring."&arv_visit_id=".$_GET['arv_visit_id']."&pid=".$_GET['pid']."&mode=".$_GET['mode'];
		while (list ($key, $val) = each ($_GET[$name])) {
			$querystring.="&".$name."[".$key."]=".urlencode($this->filterData($val));
		}
		return $querystring;
	}
} 
?>