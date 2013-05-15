-- care_tz_billing_archive_elem_Update

ALTER TABLE `care_tz_billing_archive_elem` ADD `times_per_day` SMALLINT( 10 ) NOT NULL AFTER `amount` ,
ADD `days` SMALLINT( 10 ) NOT NULL AFTER `times_per_day` ;
