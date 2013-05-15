<?php $insurance_tz_report->Display_Report_Header(); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<?php $insurance_tz_report->Dispay_Headline($LDReportPrepaidAmount); ?>
<br>



<table border="1" cellspacing="0" >


    <form action="" method="post" >

	  <?php $insurance_tz_report->Display_Selectbox_Years("year","show",$year); ?>
	  
	</form>

	<br>

	<?php $insurance_tz_report->Display_ReportTable_Head('#99ccff','Company Name','Prepaid(TSH)','members','total sum(TSH)'); ?>

	<?php $insurance_tz_report->Dispaly_ReportPrepaidContent($year); ?>


</table>


</BODY>