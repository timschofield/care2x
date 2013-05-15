ALTER TABLE care_personell CHANGE job_function_title job_function_title SMALLINT( 60 ) NOT NULL;
CREATE TABLE care_personell_jobs(number INTEGER NOT NULL AUTO_INCREMENT,name VARCHAR(30),PRIMARY KEY(number));

