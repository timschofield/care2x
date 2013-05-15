# add column at pricetable
ALTER TABLE `care_tz_drugsandservices` ADD `is_labtest` TINYINT NOT NULL DEFAULT '0' AFTER `is_consumable` ;
#
# copy all values to pricetable
INSERT into care_tz_drugsandservices (
  `item_number` ,
  `is_pediatric` ,
  `is_adult` ,
  `is_other` ,
  `is_consumable` ,
  `is_labtest` ,
  `item_description` ,
  `item_full_description` ,
  `unit_price` ,
  `unit_price_1` ,
  `unit_price_2` ,
  `unit_price_3` ,
  `purchasing_class` )
select
  	CONCAT('LAB',tests.id) as item_number,
  	0 as `is_pediatric`,
	0 as `is_adult`,
	0 as `is_other`,
	1 as `is_consumable`,
	1 as `is_labtest`,
	tests.name as item_description,
  	tests.name as item_full_description,
  	param.price as `unit_price`,
  	0 as `unit_price1`,
	0 as `unit_price2`,
	0 as `unit_price3`,
  	'labtest' as purchasing_class
FROM
	care_tz_laboratory_tests tests,
	care_tz_laboratory_param param
where tests.id = param.id AND parent<>-1