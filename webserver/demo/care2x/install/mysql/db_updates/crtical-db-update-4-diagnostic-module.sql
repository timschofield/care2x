-- Synopsis: If there is no way of store a diagnose, so check if the 
-- following column is given. if not, just add it with follwing sql-statement:

ALTER TABLE `care_tz_diagnosis` ADD `doctor_name` VARCHAR( 50 ) NOT NULL ;