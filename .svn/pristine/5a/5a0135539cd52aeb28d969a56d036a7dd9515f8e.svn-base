<?php

require_once($root_path.'include/care_api_classes/class_tz_diagnostics.php');

$diagnostic_obj = new Diagnostics;

$diagnostic_obj->loadEncounterData($pn);

$encounter_arr = $diagnostic_obj->getLoadedEncounterData();

$diagnostic_obj->Display_chartfolder_Diagnoses($pid);


?>