<?php
function is_arv_admitted($pid) {
	global $db;
	
	$debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;        
    $sql="SELECT * from care_person, care_tz_arv_case, care_encounter
		  WHERE care_tz_arv_case.pid=care_person.pid
		  AND care_person.pid=$pid";
    
    $rs=$db->Execute($sql);
    return ($rs->FetchRow()) ? true : false;
}
?>
