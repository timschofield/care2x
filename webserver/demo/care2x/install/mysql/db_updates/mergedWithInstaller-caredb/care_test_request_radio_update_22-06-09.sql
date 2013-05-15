
-- change for autoselect region, district and ward
ALTER TABLE `care_test_request_radio` ADD  `bill_number` bigint(20) NOT NULL default '0'AFTER `history`,
 ADD `bill_status` varchar(10) NOT NULL AFTER `bill_number`,
 ADD `is_disabled` varchar(255) default NULL AFTER `bill_status`;

