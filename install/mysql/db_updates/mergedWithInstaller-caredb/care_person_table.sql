
-- change for autoselect region, district and ward
ALTER TABLE `care_person` ADD `region` VARCHAR( 50 ) NOT NULL AFTER `religion` ,
ADD `district` VARCHAR( 50 ) NOT NULL AFTER `region` ,
ADD `ward` VARCHAR( 50 ) NOT NULL AFTER `district` ;

