<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
 // globalize POST, GET, & COOKIE  vars
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
require_once($root_path.'include/inc_charset_fx.php') // load the charset functions
?>
<?php html_rtl($lang); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<title>Help :: Main Menu</title>
	<link rel="StyleSheet" href="<?php echo $root_path?>main/menu/dtree/dtree.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $root_path?>main/menu/dtree/dtree.js"></script>
	<style type="text/css">
		H1 {font-size: 1.4em;font-family:Verdana,Arial;}
	</style>
</head>
<body>

<h1>Help</h1>

<div class="dtree">

	<script type="text/javascript">
		<!--
		var link_path="<?php echo $root_path?>main/help-info.php?helpidx=";
		var image_path="<?php echo $root_path?>gui/img/common/default/";

		d = new dTree('d');

		d.config.target="HELPINFOFRAME";
		d.config.useCookies=false;

		d.add(0,-1,'Menu');
		d.add(1,0,'Start',link_path + 'main.php','','',image_path + 'frage.gif');

		d.add(2,0,'Basic Usage',link_path +'basic_usage.php&src=Basic Usage','','HELPINFOFRAME','<?php echo $root_path?>gui/img/common/default/articles.gif');
		d.add(3,0,'Registration','','','','<?php echo $root_path?>gui/img/common/default/new_group.gif','<?php echo $root_path?>gui/img/common/default/new_group.gif');
			d.add(4,3,'Overview','<?php echo $root_path?>main/help-info.php?helpidx=registration_overview.php&src=Person Registration :: Overview','','HELPINFOFRAME');
			d.add(5,3,'Registration','','','',image_path + 'new_group.gif',image_path + 'new_group.gif');
				d.add(6,5,'Search for an already registered patient','<?php echo $root_path?>main/help-info.php?helpidx=search_patient.php&src=Registration :: Search','','HELPINFOFRAME');
				d.add(7,5,'Search for an previously admitted patient using the advanced search','<?php echo $root_path?>main/help-info.php?helpidx=search_advanced.php&src=Registration :: Advanced Search','','HELPINFOFRAME');
				d.add(8,5,'Register a patient','<?php echo $root_path?>main/help-info.php?helpidx=registration_new.php&src=Registration :: Register new patient','','HELPINFOFRAME');
				d.add(9,5,'Update patient�s registration data','<?php echo $root_path?>main/help-info.php?helpidx=update_registration_data.php&src=Registration :: Update patient&acute;s registration data','','HELPINFOFRAME');
			d.add(10,3,'Admission','','','',image_path + 'prescription.gif',image_path + 'prescription.gif');
				d.add(11,10,'Search an admitted patient','<?php echo $root_path?>main/help-info.php?helpidx=search_patient.php&src=Admission :: Search','','HELPINFOFRAME');
				d.add(12,10,'Search and admitted patient in the archive','<?php echo $root_path?>main/help-info.php?helpidx=search_advanced.php&src=Admission :: Archive Search','','HELPINFOFRAME');
				d.add(13,10,'Admitting a patient','<?php echo $root_path?>main/help-info.php?helpidx=admission_new.php&src=Admission :: Admitting a patient','','HELPINFOFRAME');
				d.add(14,10,'Update patient´s admission data','<?php echo $root_path?>main/help-info.php?helpidx=update_admission_data.php&src=Registration :: Update patient&acute;s admission data','','HELPINFOFRAME');
			d.add(15,3,'Discharge a patient','<?php echo $root_path?>main/help-info.php?helpidx=discharge_patient.php&src=Discharge Patient','','HELPINFOFRAME');

		d.add(16,0,'Archive','<?php echo $root_path?>main/help-info.php?helpidx=search_advanced.php&src=Admission :: Archive Search','','HELPINFOFRAME','<?php echo $root_path?>gui/img/common/default/bn.gif');

		d.add(17,0,'Outpatient','','','',image_path + 'disc_unrd.gif',image_path + 'disc_unrd.gif');
			d.add(18,17,'Overview',link_path + 'outpatient_overview.php&src=Outpatient :: Overview');
			d.add(19,17,'Appointments',link_path + 'outpatient_appointments.php&src=Outpatient :: Appointments');
			d.add(20,17,'Outpatient Clinic','','','',image_path + 'disc_unrd.gif',image_path + 'disc_unrd.gif');
				d.add(40,20,'Outpatien Clinic Overview',link_path + 'outpatient_clinic.php&src=Outpatient Clinic');
				d.add(81,20,'ARV Clinic','','','',image_path + 'ball_gray.png',image_path + 'ball_gray.png');
					d.add(82,81,'ARV Menu',link_path + 'arv_menu.php&src=ARV Menu&x1=menu');
					d.add(83,81,'New ARV Patient',link_path + 'arv_registration.php&src=New ARV Patient&x1=new');
					d.add(84,81,'Edit ARV Patient',link_path + 'arv_registration.php&src=Edit ARV Patient&x1=edit');
					d.add(85,81,'New Visit',link_path + 'arv_visit.php&src=New Visit');
					d.add(86,84,'New Visit',link_path + 'arv_visit.php&src=New Visit');
					d.add(87,84,'Edit Visit',link_path + 'arv_visit.php&src=Edit Visit');
					d.add(88,84,'AIDS def events',link_path + 'arv_aids_def_events.php?src=Aids defining events');
					d.add(89,84,'ARV reasons',link_path + 'arv_status_reason.php?src=ARV Status Reason');
					d.add(90,81,'ARV Overview',link_path + 'arv_overview.php&src=ARV Overview');
				d.add(21,20,'Patient&acute;s chart folder','','','',image_path + 'open.gif',image_path + 'open.gif');
					d.add(22,21,'Overview',link_path + 'patient_charts.php&src=Patient&acute;s chart folder :: Overview');
					d.add(23,21,'Consultation Report',link_path + 'consultation_reports.php&src=Patient&acute;s chart folder :: Consultation report');
					d.add(24,21,'Diagnoses',link_path + 'diagnoses.php&src=Patient&acute;s chart folder :: Diagnoses');
					d.add(25,21,'Lab Requests',link_path + 'laboratory_testrequest.php&src=Laboratory :: Test Request');
					d.add(26,21,'Lab Reports',link_path + 'patientcharts_lab_report.php&src=Laboratories :: Lab Report');
					d.add(27,21,'Prescriptions',link_path + 'prescription.php&src=Prescription :: Overview&x1=patient_charts');
					d.add(28,21,'Request diagnostic test','','','',image_path + 'qkvw.gif',image_path + 'qkvw.gif');
						d.add(29,28,'ARV Clinic',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: ARV Clinic');
						d.add(30,28,'Bacteriological Laboratory',link_path + 'request_diagnostic_test_bact_lab.php&src=Request diagnostic test :: Bacteriological Laboratory');
						d.add(31,28,'Blood Bank',link_path + 'request_diagnostic_test_blood.php&src=Request diagnostic test :: Blood Bank');
						d.add(32,28,'Central Laboratory',link_path + 'laboratory_testrequest.php&src=Laboratory :: Test Request');
						d.add(33,28,'Dental Clinic',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: Dental Clinic');
						d.add(34,28,'General Outpatient Clinic',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: General Outpatient Clinic');
						d.add(35,28,'General Surgery',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: General Surgery');
						d.add(36,28,'Internal Medicine',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: Internal Medicine');
						d.add(37,28,'Ob-Gynecology',link_path + 'request_diagnostic_test.php&src=Request diagnostic test ::  Ob-Gynecology');
						d.add(38,28,'Opthamology',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: Opthamology');
						d.add(39,28,'Pediatric Clinic',link_path + 'request_diagnostic_test.php&src=Request diagnostic test :: Pediatric Clinic');
				d.add(40,20,'Notes on the patient','<?php echo $root_path?>main/help-info.php?helpidx=outpatient_notes.php&src=Outpatient Clinic :: Notes on the patient','','HELPINFOFRAME');
				d.add(41,20,'Transfer Patient','<?php echo $root_path?>main/help-info.php?helpidx=outpatient_transfer.php&src=Outpatient Clinic :: Transfer','','HELPINFOFRAME');

		d.add(42,0,'Laboratories','','','','<?php echo $root_path?>gui/img/common/default/chart.gif','<?php echo $root_path?>gui/img/common/default/chart.gif');
			d.add(43,42,'Laboratories menu',link_path + 'lab_menu.php&src=Laboratories :: Main Menu');
			d.add(44,42,'Test request',link_path + 'laboratory_testrequest.php&src=Laboratories :: Test Request&x1=lab');
			d.add(45,42,'Pending lab request',link_path + 'lab_pending_requests.php&src=Laboratories :: Pending Requests');
			d.add(46,42,'Display data',link_path + 'search_patient.php&src=Laboratories :: Search Patient');
			d.add(47,42,'Edit results',link_path + 'search_patient.php&src=Laboratories :: Search Patient');
			d.add(48,42,'Edit test parameters',link_path + 'lab_test_parameters.php&src=Laboratories :: Test Parameters');

		d.add(49,0,'Pharmacy','','','','<?php echo $root_path?>gui/img/common/default/add.gif','<?php echo $root_path?>gui/img/common/default/add.gif');
			d.add(50,49,'Pharmacy menu',link_path + 'pharmacy_menu.php&src=Pharmacy :: Main Menu');
			d.add(51,49,'Show patient&acute;s prescriptions',link_path + 'prescription.php&src=Prescription :: Overview&x1=pharmacy');
			d.add(52,49,'Create new prescriptions',link_path + 'prescription_create.php&src=Prescription :: Create new Record&x1=pharmacy');
			d.add(53,49,'Pharmacy products menu',link_path + 'pharmacy_product_menu.php&src=Pharmacy :: My Product Catalog');
			d.add(54,49,'Insert product',link_path + 'pharmacy_product_insert.php&src=My Product Catalog :: New Product');
			d.add(55,49,'Edit product',link_path + 'pharmacy_product_edit.php&src=My Product Catalog :: Search');

		d.add(56,0,'Billing','','','','<?php echo $root_path?>gui/img/common/default/showdata.gif','<?php echo $root_path?>gui/img/common/default/showdata.gif');
			d.add(57,56,'Main Menu',link_path + 'billing_overview.php&src=Billing :: Main Menu');
			d.add(58,56,'Create Quotation',link_path + 'billing_create.php');
			d.add(59,56,'Pending Bills',link_path + 'billing_pendingbills.php');
			d.add(60,56,'Archive',link_path + 'billing_archive.php');
			d.add(61,56,'Laboratory Test Request',link_path + 'laboratory_testrequest.php&src=Billing :: Laboratory Test Request&x1=bill');
			d.add(62,56,'Drug and other Service Requests',link_path + 'prescription.php&src=Billing :: Drug and other Services Request&x1=billing');
			d.add(63,56,'Insurance Management','','','','<?php echo $root_path?>gui/img/common/default/pdata.gif','<?php echo $root_path?>gui/img/common/default/pdata.gif');
				d.add(88,63,'Insurance menu',link_path + 'insurance_menu.php&src=Insurance Management :: Main Menu');
				d.add(64,63,'Manage companies and their contracts',link_path + 'insurance_companies_overview.php&src=Administrative Companies :: Overview');
				d.add(65,63,'Create and edit insurance types',link_path + 'insurance_type_overview.php&src=Administrative Insurance types :: Overview');
				d.add(66,63,'Member Management',link_path + 'insurance_members.php&src=Member Management');
				d.add(67,63,'Insurance Reports menu',link_path + 'insurance_reports_menu.php&src=Insurance Reports :: Menu');
				d.add(80,63,'Reports Overview',link_path + 'insurance_reports_companies.php&src=Insurance Reports :: Company Overview');

		d.add(68,0,'Reporting','','','',image_path + 'eyeglass.gif',image_path + 'eyeglass.gif');
			d.add(91,68,'Reporting',link_path + 'reporting_overview.php&src=Reporting :: Overview','','',image_path + 'eyeglass.gif');
			d.add(92,68,'ARV-Reporting','','','',image_path + 'ball_gray.png',image_path + 'ball_gray.png');
				d.add(93,92,'Reporting',link_path + 'arv_reporting_quarterly.php&src=Quarterly, Facility-Based HIV Care/ART Reporting Form');
				d.add(94,92,'Reporting',link_path + 'arv_reporting_quarterly_r1.php&src=Report 1: HIV Palliative Care');
				d.add(95,92,'Reporting',link_path + 'arv_reporting_quarterly_r2.php&src=Report 2: ART Care');
				d.add(96,92,'Reporting',link_path + 'arv_reporting_quarterly_r4.php&src=Report 4: Cohort analyses');
				d.add(97,92,'Reporting',link_path + 'arv_reporting_quarterly_r6.php&src=Report 6: Patients stop ARV');
				d.add(98,92,'Reporting',link_path + 'arv_reporting_overview.php&src=Patients Overview');
				d.add(99,92,'Reporting',link_path + 'arv_reporting_cstatistics.php&src=C-Statistics-Patients');

		//d.add(69,0,'System Admin','','','','<?php echo $root_path?>gui/img/common/default/sections.gif','<?php echo $root_path?>gui/img/common/default/sections.gif');
		//d.add(70,0,'Special Tools','','','','<?php echo $root_path?>gui/img/common/default/settings_tree.gif','<?php echo $root_path?>gui/img/common/default/settings_tree.gif');

		d.add(69,0,'Workflow Charts','','','',image_path + 'templates.gif',image_path + 'templates.gif');
			d.add(70,69,'Registration',link_path + 'registration_workflow.php');
			d.add(71,69,'Admission',link_path + 'admission_workflow.php');
			d.add(72,69,'Laboratory',link_path + 'laboratory_workflow.php');
			d.add(73,69,'Pending Prescriptions',link_path + 'prescription_workflow.php');
			d.add(74,69,'Create prescription',link_path + 'prescription_create_workflow.php');
			d.add(75,69,'Billing',link_path + 'billing_workflow.php');
			d.add(76,69,'Insurance',link_path + 'insurance_workflow.php');

		d.add(77,0,'Person Search',link_path + 'tips_and_tricks.php&src=Search :: Tips & Tricks','','',image_path + 'man-gr.gif');

		d.add(78,0,'System Admin','','','',image_path + 'sections.gif',image_path + 'sections.gif');
			d.add(79,78,'Users',link_path + 'admin_function.php');
		document.write(d);



		//-->
	</script>
	<p><a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a></p>

</div>


</body>

</html>