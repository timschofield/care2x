-- care_tz_billing_archive_elem_Update

ALTER TABLE `care_tz_billing_elem` ADD `is_radio_test` TINYINT( 4 ) NOT NULL AFTER `is_labtest`;
ALTER TABLE `care_tz_billing_archive_elem` ADD `is_radio_test` TINYINT( 4 ) NOT NULL AFTER `is_labtest`;
