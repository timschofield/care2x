<?php

define('SIGNAL_COLOR_LEVEL_FULL',2);   // integer for full signal

define('SIGNAL_COLOR_LEVEL_HALF',1);  // integer for half signal
                                                            //  As of beta 1.0.04, the half level signalling
                                                            //  is not yet implemented
define('SIGNAL_COLOR_LEVEL_ZERO',0);  // integer for no event

/**
*  Valid colors for signalling are:
*
*  yellow
*  black
*  blue_pale
*  brown
*  pink
*  yellow_pale
*  red
*  green_pale
*  violet
*  blue
*  biege
*  orange
*  green
*  rose
*/

define('SIGNAL_COLOR_DIAGNOSTICS_REPORT','brown');   // color to be set for signalling a diagnostic report
define('SIGNAL_COLOR_DIAGNOSTICS_REQUEST','blue_pale');   // color to be set for signalling a diagnostic/consult request

define('SIGNAL_COLOR_QUERY_DOCTOR','yellow');    // color to be set for signalling a query to the doctor
define('SIGNAL_COLOR_DOCTOR_INFO','black');             // color to be set for signalling a doctor's instruction or answer

define('SIGNAL_COLOR_CONSUMABLES','pink');             // color to be set for signalling the prescription of consumables

define('SIGNAL_COLOR_PROCEDURES','red');             // color to be set for signalling procedures

define('SIGNAL_COLOR_ANTIBIOTIC','biege');    // color to be set for signalling the prescription of antibiotics

define('SIGNAL_COLOR_RADIOLOGY_REQUEST','green_pale');             // color to be set for signalling radiology requests
define('SIGNAL_COLOR_RADIOLOGY_REPORT','violet');             // color to be set for signalling radiology  reports

define('SIGNAL_COLOR_SERVICES','orange');             // color to be set for signalling the prescription of anticoagulants
define('SIGNAL_COLOR_IV','rose');             // color to be set for signalling the prescription of anticoagulants

/* ****************** Do not edit the following functions **************************/

function setEventSignalColor($pn, $color, $status = SIGNAL_COLOR_LEVEL_FULL )
{
   	global $db,  $LDDbNoSave;
	$nogo=false;

	//$event_table='care_nursing_station_patients_event_signaller';
	$event_table='care_encounter_event_signaller';

	$sql="SELECT encounter_nr, $color FROM $event_table WHERE encounter_nr=$pn";
   	if($ergebnis=$db->Execute($sql)) {
   		$row=$ergebnis->FetchRow();
   		if ($row[1]!=$status)
	   		if($ergebnis->RecordCount()){
	   			$sql="UPDATE $event_table SET $color ='$status' WHERE encounter_nr=$pn";
				$db->Execute($sql);
				//echo $db->Affected_Rows();
				if(!$db->Affected_Rows()){
					$nogo=true;
				}
			}else{
				$nogo=true;
			}
   	}else{
   		$nogo=true;
	}
	//echo $sql;
	if($nogo){
	    $sql="INSERT INTO ".$event_table." ( encounter_nr, ".$color.") VALUES ( ".$pn.", ".$status.")";
        $db->Execute($sql);
	}
   //echo $sql;
}
?>
