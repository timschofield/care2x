--Update care_ward
--nr has previously had the value '0'

UPDATE `care_ward` SET `nr` = '2',
`info` = NULL ,
`modify_time` = NOW( '2009-01-28 12:31:13' ) ,
`create_time` = '2005-02-25 12:51:36' WHERE `nr` = '0' LIMIT 1 ;

