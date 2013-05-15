<script type="text/javascript">
<!--
	if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 		
		parent.frames["HELPINDEXFRAME"].d.openTo(68, true);
	}
//-->
</script>
<h1><?php echo $src; ?></h1>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> What does this report show?</h2>
<p>
Table 4.1 compares the proportion of patients who start ART in the same month of the same year with their status at 6 and 12 months. So it shows the success at 6 and 12 months of ART with ealier or later cohorts, or with other districts.
<br/>
<img src="<?php echo $root_path; ?>help/en/img/en_arv_report_quarterly_r4.png" id="screenshot" width="459" height="130">
<br/>
<span class="bold" >a.</span>
From the selected quarter (see: <a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_reporting_quarterly.php&src=Quarterly, Facility-Based HIV Care/ART Reporting Form">How to use this report?</a>) we substract 6 months back into the past. 
For example if we select quarter 1. 2007 (Jan, Feb, March) we count the patients started ART in the months 
(Jul, Aug, Sept)
Select the month here for which the report should be created.
<br/><br/>
<img src="<?php echo $root_path; ?>help/en/img/en_arv_reporting_quarterly_select.png" id="screenshot" width="71" height="91">
<br/>
<span class="bold" >b.</span>
You get the sum of the patients started ART in the selected month.
<br/><br/>
<span class="bold" >c.</span>
You get a subset of b.) containing those patients who have CD4 test results in the month of starting ART.
<br/><br/>
<span class="bold" >d.</span>
Calculate the statistical median of CD4 counts, including the test results of c.)
<br/><br/>
<span class="bold" >e.</span>
You get the sum ot the patients started ART in the selected month and are still on ART after a six month period.
<br/><br/>
<span class="bold" >f.</span>
You get a subset of e.) containing those patients who have CD4 test results at the last month of the six month period.
<br/><br/>
<span class="bold" >g.</span>
Calculate the statistical median of CD4 counts, including the test results of f.)
<br/><br/>
<span class="bold" >h.</span>
Number of patients that have not stopped ART for a six month period.
<br/>
</p>
<br/>
<br>
<a href="javascript:window.history.back()" > &lt;&lt;prev </a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_reporting_quarterly_r6.php&src=Report 6: Patients stop ARV">next>></a>