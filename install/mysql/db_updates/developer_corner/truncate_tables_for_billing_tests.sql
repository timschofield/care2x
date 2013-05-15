/*********************************************************************
creation of a tuncate script what will empty all data
tables for billing tests. Be carefully

DO NEVER USE IT on productive system when you do not know what you do!
*********************************************************************/

TRUNCATE TABLE care_tz_billing;

TRUNCATE TABLE care_tz_billing_elem;

TRUNCATE TABLE care_tz_billing_archive;

TRUNCATE TABLE care_tz_billing_archive_elem;

TRUNCATE TABLE care_encounter_prescription;

TRUNCATE TABLE care_test_findings_chemlab;

TRUNCATE TABLE care_test_findings_chemlabor_sub;

TRUNCATE TABLE care_test_request_chemlabor;

TRUNCATE TABLE care_test_request_chemlabor_sub;

/*
INSERT INTO `care_encounter_prescription` (`nr`, `encounter_nr`, `prescription_type_nr`, `article`, `article_item_number`, `price`, `drug_class`, `order_nr`, `dosage`, `times_per_day`, `days`, `application_type_nr`, `notes`, `prescribe_date`, `prescriber`, `color_marker`, `is_stopped`, `is_outpatient_prescription`, `is_disabled`, `stop_date`, `status`, `history`, `bill_number`, `bill_status`, `modify_id`, `modify_time`, `create_id`, `create_time`, `priority`) VALUES
(1, 2009500951, 0, 'ACETYL SALICYLIC ACID 300MG Tab', '1558', '', 'drug_list', 0, '1', 1, 1, 0, '', '2009-09-04', 'niemi', '', 0, 1, NULL, NULL, '', 'ACETYL SALICYLIC ACID 300MG Tab\r\nCreated: 2009-09-04 21:44:20 : niemi\r\n', 0, '', '', '2009-09-04 21:44:28', '', '2009-09-04 00:00:00', 0),
(2, 2009500951, 0, 'ACYCLOVIR (ZOVIRAX) CREAM', '1472', '', 'drug_list', 0, '1', 1, 1, 0, '', '2009-09-04', 'niemi', '', 0, 1, NULL, NULL, '', 'ACYCLOVIR (ZOVIRAX) CREAM\r\nCreated: 2009-09-04 21:44:20 : niemi\r\n', 0, '', '', '2009-09-04 21:44:28', '', '2009-09-04 00:00:00', 0);



INSERT INTO `care_test_request_chemlabor` (`batch_nr`, `encounter_nr`, `room_nr`, `dept_nr`, `parameters`, `doctor_sign`, `highrisk`, `notes`, `send_date`, `sample_time`, `sample_weekday`, `status`, `history`, `bill_number`, `bill_status`, `is_disabled`, `modify_id`, `modify_time`, `create_id`, `create_time`, `priority`) VALUES
(10000000, 2009500951, '', 0, '_acid_phosphotate__chemisteries=1&_acp__chemisteries=1&_coomb__s_test__hematology=1&_esr__hematology=1', '', 0, ' ', '2009-09-04 23:27:50', '00:00:00', 0, 'pending', 'Create: 2009-09-04 23:27:50 = niemi\n', 0, '', NULL, 'niemi', '2009-09-04 23:27:50', 'niemi', '2009-09-04 23:27:50', 0);

INSERT INTO `care_test_request_chemlabor_sub` (`sub_id`, `batch_nr`, `encounter_nr`, `item_id`, `paramater_name`, `parameter_value`, `status`) VALUES
(1, 10000000, 2009500951, '1947', '_acid_phosphotate__chemisteries', '1', 'pending'),
(2, 10000000, 2009500951, '1947', '_acp__chemisteries', '1', 'pending'),
(3, 10000000, 2009500951, '1968', '_coomb__s_test__hematology', '1', 'pending'),
(4, 10000000, 2009500951, '1964', '_esr__hematology', '1', 'pending');
*/