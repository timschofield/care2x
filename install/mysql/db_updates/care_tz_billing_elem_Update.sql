-- changes for billing

ALTER TABLE `care_tz_billing_elem` ADD `times_per_day` SMALLINT( 10 ) NOT NULL AFTER `amount_doc` ,
ADD `days` SMALLINT( 10 ) NOT NULL AFTER `times_per_day` ;
