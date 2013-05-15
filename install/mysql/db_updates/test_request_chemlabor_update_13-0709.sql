ALTER TABLE  `care_test_request_chemlabor` ADD `item_id` VARCHAR (20) NOT NULL AFTER 	`encounter_nr`;
ALTER TABLE `care_test_request_chemlabor_sub` ADD `status` VARCHAR( 12 ) NOT NULL