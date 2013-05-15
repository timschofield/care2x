<?php $insurance_tz->Display_Header($LDBillingInsurance); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066">

<?php $insurance_tz->Display_Headline($LDInsuranceTypeOverview, 'insurance_type_overview.php','Administrative Insurance types :: Overview'); ?>


			<?php $insurance_tz->ShowInsuranceTypesList(); ?>
			<p>
			<a href="insurance_types_tz_new.php"><?php echo $LDInsertType; ?></a>
				
<?php $insurance_tz->Display_Footer($LDInsuranceTypeOverview, 'insurance_type_overview.php','Administrative Insurance types :: Overview'); ?>
		
<?php $insurance_tz->Display_Credits(); ?>