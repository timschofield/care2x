CREATE TABLE care_tz_person_insurance (
    person_insurance_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    insurance smallint(5) NOT NULL REFERENCES care_tz_insurances_admin(insurance_ID),
    person int(11) UNSIGNED NOT NULL REFERENCES care_person(pid),
    PRIMARY KEY (person_insurance_id)
);

