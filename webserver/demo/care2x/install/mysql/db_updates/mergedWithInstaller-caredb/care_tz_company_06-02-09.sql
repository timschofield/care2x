-- table "care_tz_company"
-- change is necessary to allow to move outpatient to inpatient-ward

ALTER TABLE `care_tz_company` ADD `email` VARCHAR( 60 ) NULL AFTER `contact` ;
