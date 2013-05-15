
-- change for autoselect region, district and ward
ALTER TABLE `care_tz_billing_elem` ADD `is_radio_test` tinyint(5) NOT NULL default '0',AFTER `is_labtest`; ;

