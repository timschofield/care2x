<?php $insurance_tz_report->Display_Report_Header(); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<?php $insurance_tz_report->Dispay_Headline($LDInsuranceReportsOverview); ?>
<br>

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	
	<tr>
		<td bgcolor=#ffffff valign=top>
				<?php $insurance_tz->ShowInsuranceList('report',TRUE); ?>
			
			
		</td>
	</tr>
</table>
<br><br>
<?php $insurance_tz_report->Dispay_Footer($LDInsuranceReportsOverview); ?>

<?php $insurance_tz_report->Dispay_Credits(); ?>
