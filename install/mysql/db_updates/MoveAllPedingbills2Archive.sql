INSERT INTO care_tz_billing_archive
                      (`nr`,`encounter_nr`, `first_date`, `create_id`)
                  SELECT `nr`, `encounter_nr`, `first_date`, `create_id` FROM care_tz_billing;

INSERT INTO care_tz_billing_archive_elem
                      (	`nr`,
			`date_change`,
			`is_labtest`,
			`is_medicine`,
			`is_comment`,
			`is_paid`,
			`amount`,
			`price`,
			`balanced_insurance`,
			`insurance_id`,
			`description`,
			`item_number`,
			`prescriptions_nr`
			)
                  SELECT
			`nr`,
			`date_change`,
			`is_labtest`,
			`is_medicine`,
			`is_comment`,
			1,
			`amount`,
			`price`,
			`balanced_insurance`,
			`insurance_id`,
			`description`,
			`item_number`,
			`prescriptions_nr`
		FROM care_tz_billing_elem;


UPDATE care_tz_billing_archive_elem SET user_id='admin' where user_id='';

UPDATE care_encounter_prescription SET bill_status='archived'WHERE bill_status='';

UPDATE care_test_request_chemlabor SET bill_status='archived' WHERE bill_status='';

DELETE FROM care_tz_billing;

DELETE FROM care_tz_billing_elem;