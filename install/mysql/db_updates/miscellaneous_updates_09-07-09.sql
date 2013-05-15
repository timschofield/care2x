ALTER TABLE `care_test_request_radio` ADD `r_cm_2` varchar(15) NOT NULL default '' AFTER `status`,
ADD `mtr` varchar(35) NOT NULL default '' AFTER `r_cm_2`;
  
ALTER TABLE `care_tz_insurance`
ALTER column `start_date` {DROP DEFAULT},
ALTER column `end_date` {DROP DEFAULT};