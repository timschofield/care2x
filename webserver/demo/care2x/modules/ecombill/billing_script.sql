# MySQL-Front Dump 2.2
#
# Host: localhost   Database: CareDB2
#--------------------------------------------------------
# Server version 3.23.52-nt


#
# Table structure for table care_billing_archive
#

CREATE TABLE care_billing_archive (
  bill_no bigint(20) NOT NULL default '0',
  encounter_nr int(10) NOT NULL default '0',
  patient_name tinytext NOT NULL,
  vorname varchar(35) NOT NULL default '0',
  bill_date_time datetime NOT NULL default '0000-00-00 00:00:00',
  bill_amt double NOT NULL default '0',
  payment_date_time datetime NOT NULL default '0000-00-00 00:00:00',
  payment_mode text NOT NULL,
  cheque_no varchar(10) NOT NULL default '0',
  creditcard_no varchar(10) NOT NULL default '0',
  paid_by varchar(15) NOT NULL default '0',
  PRIMARY KEY  (bill_no)
) TYPE=MyISAM;



#
# Table structure for table care_billing_bill
#

CREATE TABLE care_billing_bill (
  bill_bill_no bigint(20) NOT NULL default '0',
  bill_encounter_nr int(10) unsigned NOT NULL default '0',
  bill_date_time date default NULL,
  bill_amount float default NULL,
  bill_outstanding float default NULL,
  PRIMARY KEY  (bill_bill_no),
  KEY index_bill_patnum (bill_encounter_nr)
) TYPE=MyISAM;



#
# Table structure for table care_billing_bill_item
#

CREATE TABLE care_billing_bill_item (
  bill_item_id int(11) NOT NULL auto_increment,
  bill_item_encounter_nr int(10) unsigned NOT NULL default '0',
  bill_item_code varchar(5) default NULL,
  bill_item_unit_cost float default '0',
  bill_item_units tinyint(4) default NULL,
  bill_item_amount float default NULL,
  bill_item_date datetime default NULL,
  bill_item_status enum('0','1') default '0',
  bill_item_bill_no int(11) NOT NULL default '0',
  PRIMARY KEY  (bill_item_id),
  KEY index_bill_item_patnum (bill_item_encounter_nr),
  KEY index_bill_item_bill_no (bill_item_bill_no)
) TYPE=MyISAM;



#
# Table structure for table care_billing_final
#

CREATE TABLE care_billing_final (
  final_id tinyint(3) NOT NULL auto_increment,
  final_encounter_nr int(10) unsigned NOT NULL default '0',
  final_bill_no int(11) default NULL,
  final_date date default NULL,
  final_total_bill_amount float default NULL,
  final_discount tinyint(4) default NULL,
  final_total_receipt_amount float default NULL,
  final_amount_due float default NULL,
  final_amount_recieved float default NULL,
  PRIMARY KEY  (final_id),
  KEY index_final_patnum (final_encounter_nr)
) TYPE=MyISAM;



#
# Table structure for table care_billing_item
#

CREATE TABLE care_billing_item (
  item_code varchar(5) NOT NULL default '',
  item_description varchar(100) default NULL,
  item_unit_cost float default '0',
  item_type tinytext,
  item_discount_max_allowed tinyint(4) unsigned default '0',
  PRIMARY KEY  (item_code)
) TYPE=MyISAM;



#
# Table structure for table care_billing_payment
#

CREATE TABLE care_billing_payment (
  payment_id tinyint(5) NOT NULL auto_increment,
  payment_encounter_nr int(10) unsigned NOT NULL default '0',
  payment_receipt_no int(11) NOT NULL default '0',
  payment_date datetime default '0000-00-00 00:00:00',
  payment_cash_amount float default '0',
  payment_cheque_no int(11) default '0',
  payment_cheque_amount float default '0',
  payment_creditcard_no int(25) default '0',
  payment_creditcard_amount float default '0',
  payment_amount_total float default '0',
  PRIMARY KEY  (payment_id),
  KEY index_payment_patnum (payment_encounter_nr),
  KEY index_payment_receipt_no (payment_receipt_no)
) TYPE=MyISAM;

