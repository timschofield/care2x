-- table "care_tz_company"
-- change is necessary to allow to move outpatient to inpatient-ward

ALTER TABLE `care_tz_company` ADD  `phone_code` bigint(15) NOT NULL default '0'AFTER `email`,
 ADD `phone_nr` varchar(35) default '' AFTER `phone_code`;
