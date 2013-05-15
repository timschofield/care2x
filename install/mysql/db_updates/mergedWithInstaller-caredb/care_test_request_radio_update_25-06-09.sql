
-- change for autoselect region, district and ward
ALTER TABLE `care_test_request_radio` 
	DROP column `xray`, 
	DROP column `mrt`, 
	DROP column `ct`, 
	DROP column `sono`, 
	DROP column `mammograph`, 
	DROP column `nuclear`, 
	DROP column `mtr`, 
	DROP column `xray_nr`, 
	ADD `test_nr` varchar(9) NOT NULL default '0' AFTER `send_doctor`, 
	DROP column `r_cm_2`, 
	DROP column `xray_date`, 
	ADD `test_date` date NOT NULL default '0000-00-00' AFTER `test_nr`,
	ADD `test_type` varchar(20) NOT NULL AFTER `dept_nr`, 
	DROP column `xray_time`,
	ADD `test_time` time NOT NULL default '00:00:00' AFTER `test_date`;
