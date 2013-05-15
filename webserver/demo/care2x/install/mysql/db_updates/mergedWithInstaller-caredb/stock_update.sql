INSERT INTO `care_menu_main` ( `nr` , `sort_nr` , `name` , `LD_var` , `url` , `is_visible` , `hide_by` , `status` , `modify_id` , `modify_time` ) VALUES ( '', '61', 'Stock', 'LDstock', 'modules/stock_tz/stock_main_menu.php', '1', NULL , '', NOW( ) , '0000-00-00 00:00:00'
);
CREATE TABLE `care_tz_stock_item_properties` ( `ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Drugsandservices_id` BIGINT NOT NULL DEFAULT '0', `Stock_place_id` BIGINT NOT NULL DEFAULT '0', `UnitOfIssue` VARCHAR( 25 ) NOT NULL , `Alternatives` VARCHAR( 255 ) NOT NULL , `Maximumlevel` BIGINT NOT NULL DEFAULT '0', `Reorderlevel` BIGINT NOT NULL DEFAULT '0', `Minimumlevel` BIGINT NOT NULL DEFAULT '0', `Orderquantity` BIGINT NOT NULL DEFAULT '0'
) ENGINE = MYISAM ;


CREATE TABLE `care_tz_stock_place` (
`ID` BIGINT NOT NULL ,
`Stockname` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( `ID` )
) ENGINE = MYISAM ;

CREATE TABLE `care_tz_stock_item_amount` ( `ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Drugsandservices_id` BIGINT NOT NULL DEFAULT '0', `Amount` BIGINT NOT NULL DEFAULT '0', `Stock_place_id` BIGINT NOT NULL DEFAULT '0'
) ENGINE = MYISAM ;

RENAME TABLE care_tz_druglist TO care_tz_drugsandservices;

ALTER TABLE `care_tz_drugsandservices` DROP `mems_item_code` ;

ALTER TABLE `care_tz_drugsandservices` DROP `mems_sizes`;

ALTER TABLE `care_tz_drugsandservices` DROP `dosage`;

ALTER TABLE `care_tz_drugsandservices` DROP `mems_item_description`;

ALTER TABLE `care_tz_drugsandservices` DROP `mems_price_per_pack_size`;

ALTER TABLE `care_tz_drugsandservices` DROP `mems_pack_size`;

UPDATE care_tz_drugsandservices SET purchasing_class = 'supplies' WHERE purchasing_class='mems_supplies'; UPDATE care_tz_drugsandservices SET purchasing_class = 'drug_list' WHERE purchasing_class='mems_drug_list';
UPDATE care_tz_drugsandservices SET purchasing_class = 'special_others_list'
WHERE purchasing_class='mems_special_others_list';
UPDATE care_tz_drugsandservices SET purchasing_class = 'supplies_laboratory'
WHERE purchasing_class='mems_supplies_laboratory';
UPDATE care_tz_drugsandservices SET purchasing_class = 'smallop' WHERE purchasing_class='mems_smallop'; UPDATE care_tz_drugsandservices SET purchasing_class = 'service' WHERE purchasing_class='mems_service'; UPDATE care_tz_drugsandservices SET purchasing_class = 'dental' WHERE purchasing_class='mems_dental'; UPDATE care_tz_drugsandservices SET purchasing_class = 'xray' WHERE purchasing_class='mems_xray'; UPDATE care_tz_drugsandservices SET purchasing_class = 'bigop' WHERE purchasing_class='mems_bigop';

CREATE TABLE `care_tz_stock_transfer` (
`ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Drugsandservices_id` BIGINT NOT NULL , `Amount` BIGINT NOT NULL , `Transfer_from` BIGINT NOT NULL , `Transfer_to` BIGINT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `care_tz_stock_suppliers` ( `ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Name` VARCHAR( 50 ) NOT NULL , `Comment` VARCHAR( 255 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `care_tz_stock_supplier_lists` ( `ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Supplier_id` BIGINT NOT NULL , `Supplier_item_id1` VARCHAR( 30 ) NOT NULL , `Supplier_item_id2` VARCHAR( 30 ) NOT NULL , `Supplier_item_name` VARCHAR( 100 ) NOT NULL , `Supplier_item_description` VARCHAR( 255 ) NOT NULL , `Supplier_item_packsize` VARCHAR( 30 ) NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `care_tz_stock_suppliers` ( `ID` , `Name` , `Comment` ) VALUES ( NULL , 'MEMS', 'Standard supplier'
), (
NULL , 'MSD', 'Government supllier'
);

INSERT INTO `care_tz_stock_supplier_lists` VALUES (1, 1, 'AD001', '10011001', 'Acetylsalicylic Acid (Aspirin) Tablet 300mg', '', '1000'); INSERT INTO `care_tz_stock_supplier_lists` VALUES (2, 1, 'AD002', '', 'Acyclovir Tablet 200mg', '', '200'); INSERT INTO `care_tz_stock_supplier_lists` VALUES (3, 1, 'AD013', '10101050', 'Amoxicillin 125mg/5ml Suspension, 100 ml Bottle', '', '5'); INSERT INTO `care_tz_stock_supplier_lists` VALUES (4, 2, '10011007', '', 'Amoxicillin Capsule 250mg', '', '1'); INSERT INTO `care_tz_stock_supplier_lists` VALUES (5, 2, '10141004', 'AD018', 'Ampicillin Dry Powder for Injection 500mg , Vial', '', '1'); INSERT INTO `care_tz_stock_supplier_lists` VALUES (6, 2, '10152001', 'AD024', 'Anti-Rabies Vaccine Injection, Vial', '', '25');

ALTER TABLE `care_tz_stock_item_amount` ADD `Timestamp_change` BIGINT NOT NULL ;
ALTER TABLE `care_tz_stock_place` ADD `Stocktype` BIGINT( 20 ) NOT NULL ; ALTER TABLE `care_tz_stock_place` CHANGE `ID` `ID` BIGINT( 20 ) NOT NULL AUTO_INCREMENT

CREATE TABLE `care_tz_stock_place_types` ( `ID` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY , `Description` VARCHAR( 255 ) NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `care_tz_stock_place_types` ( `ID` , `Description` ) VALUES ( NULL , 'Trash'
), (
NULL , 'Transfer'
);

INSERT INTO `care_tz_stock_place_types` ( `ID` , `Description` ) VALUES ( NULL , 'Main Stock'
), (
NULL , 'Sub Stock (Dispensery, Ward)'
);

ALTER TABLE `care_tz_stock_place_types` ADD `Stocktype` VARCHAR( 255 ) NOT NULL ;

UPDATE `care_tz_stock_place_types` SET `Stocktype` = 'trash' WHERE `ID` =1 LIMIT 1 ; UPDATE `care_tz_stock_place_types` SET `Stocktype` = 'transfer' WHERE `ID`
=2 LIMIT 1 ;
UPDATE `care_tz_stock_place_types` SET `Stocktype` = 'main' WHERE `ID` =3 LIMIT 1 ; UPDATE `care_tz_stock_place_types` SET `Stocktype` = 'substock' WHERE `ID`
=4 LIMIT 1 ;

INSERT INTO `care_tz_stock_place` ( `ID` , `Stockname` , `Stocktype` ) VALUES ( NULL , 'Selian Hospital', 3 ), ( NULL , 'Selian Town Clinic', 4 );

INSERT INTO `care_tz_stock_place` ( `ID` , `Stockname` , `Stocktype` ) VALUES ( NULL , 'Outside Dispensery', 4 ), ( NULL , 'Trash', 1 );

INSERT INTO `care_tz_stock_place` ( `ID` , `Stockname` , `Stocktype` ) VALUES ( NULL , 'Transfer', 2 );

ALTER TABLE `care_tz_stock_place` ADD `flag_disabled` TINYINT NOT NULL DEFAULT '0';

