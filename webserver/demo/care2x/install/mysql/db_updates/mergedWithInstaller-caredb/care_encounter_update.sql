-- table "care_encounter"
-- change is necessary to allow to move outpatient to inpatient-ward

ALTER TABLE `care_encounter` ADD `encounter_nr_prev` BIGINT( 11 ) UNSIGNED DEFAULT '0' NOT NULL AFTER `encounter_nr` ;
