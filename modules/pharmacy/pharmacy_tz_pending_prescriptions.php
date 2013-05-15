<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;

$debug = false;
	if(!$mode) /* Get the pending test requests */
	{

		$sql="SELECT 
									care_person.pid,
									care_person.selian_pid,
		              name_first, 
		              name_last, 
		              pr.encounter_nr,
		              pr.prescribe_date,
		              care_person.pid as batch_nr
		      FROM care_encounter_prescription pr, care_encounter, care_person 
		      WHERE     (pr.status='pending' OR pr.status='') 
		            AND  pr.encounter_nr = care_encounter.encounter_nr 
		            AND  care_encounter.pid = care_person.pid 
		      group by pr.prescribe_date, encounter_nr
		      ORDER BY pr.prescribe_date DESC";						         
		if($requests=$db->Execute($sql)){
			/* If request is available, load the date format functions */
			
			if ($debug) echo ($sql);
			require_once($root_path.'include/inc_date_format_functions.php');
						
			$batchrows=$requests->RecordCount();
			//if($batchrows && (!isset($batch_nr) || !$batch_nr)) {
			if($batchrows ) {
			  
			  if ($debug) echo "<br>got rows...";
			  
				$test_request=$requests->FetchRow();
				 /* Check for the patietn number = $pn. If available get the patients data */
				$requests->MoveFirst();
				/*
				while($test_request=$requests->FetchRow())  
				  echo $test_request['encounter_nr']."<br>";
				*/
				if (empty($pn)) 
				  $pn=$test_request['encounter_nr'];
				if (empty($prescription_date)) 
				  $prescription_date = $test_request['prescribe_date'];
				if (empty($batch_nr))
				  $batch_nr=$test_request['batch_nr'];
				if ($debug) echo $batch_nr."<br>".$prescription_date."<br>";
			}
		}else{
			echo "<p>$sql<p>$LDDbNoRead"; 
			exit;
		}
		$mode="show";   
	}	
	
	//require($root_path.'include/inc_pharmacy_pending_lister_fx.php');


require ("gui/gui_pharmacy_tz_pending_prescriptions.php");

?>