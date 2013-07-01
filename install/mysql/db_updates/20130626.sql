ALTER TABLE care_person CHANGE COLUMN selian_pid selian_pid  bigint(20) NULL DEFAULT '1';

ALTER TABLE care_person DROP INDEX selian_pid;