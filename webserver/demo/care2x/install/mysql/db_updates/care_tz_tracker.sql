--this table tracks actions of the user;

CREATE TABLE `care_tz_tracker` (
`tracker_ID` BIGINT NOT NULL AUTO_INCREMENT ,
`time` TIMESTAMP NOT NULL ,
`module` VARCHAR( 255 ) NOT NULL ,
`action` VARCHAR( 255 ) NOT NULL ,
`parameters` VARCHAR( 255 ) NOT NULL ,
`comment_user` VARCHAR( 255 ) NOT NULL ,
`session_user` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( `tracker_ID` ) ,
INDEX ( `time` , `session_user` )
) CHARACTER SET = latin1 COMMENT = 'tracking users action';


ALTER TABLE `care_tz_tracker` ADD `module_id` BIGINT NOT NULL AFTER `module` ,
ADD `refering_module` VARCHAR( 255 ) NOT NULL AFTER `module_id` ,
ADD `refering_module_id` BIGINT NOT NULL AFTER `refering_module` ;


ALTER TABLE `care_tz_tracker` ADD `old_value` VARCHAR( 255 ) NOT NULL AFTER `action` ,
ADD `new_value` VARCHAR( 255 ) NOT NULL AFTER `old_value` ,
ADD `value_type` VARCHAR( 255 ) NOT NULL AFTER `new_value` ;
