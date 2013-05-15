ALTER TABLE `care_encounter_prescription` 
ADD `times_per_day` SMALLINT( 10 ) NOT NULL DEFAULT '0' AFTER `dosage` ,
ADD `days` SMALLINT( 10 ) NOT NULL DEFAULT '0' AFTER `times_per_day` ;