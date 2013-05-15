ALTER TABLE `care_person` ADD `is_transmit2ERP` TINYINT NOT NULL DEFAULT '0' AFTER `addr_citytown_name` ;
ALTER TABLE `care_tz_billing_archive_elem` ADD `is_transmit2ERP` TINYINT NOT NULL DEFAULT '0' AFTER `date_change` ;
ALTER TABLE `care_tz_drugsandservices` ADD `partcode` VARCHAR( 50 ) NOT NULL AFTER `item_number` ;