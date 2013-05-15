

ALTER TABLE `care_encounter_op` ADD  `bill_number` bigint(20) NOT NULL default '0'AFTER `history`,
 ADD `bill_status` varchar(10) NOT NULL AFTER `bill_number`,
 ADD `is_disabled` varchar(255) default NULL AFTER `bill_status`;

