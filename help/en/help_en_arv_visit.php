<script type="text/javascript">
<!--
	if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 		
		parent.frames["HELPINDEXFRAME"].d.openTo(17, true);
	}
//-->
</script>

<h1><?php echo $src; ?></h1>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> What can I do here?</h2>
<p>
<?php if($src=='New Visit'): ?>
<span class="bold" >Note:</span> 
Fill out this form for each visit of a patient to the hospital. 
<br/>
<span class="bold" >Note:</span> 
You can create only one “New visit” for one encouncer. You will get an error 
message if you try to create more than one visit for one encounter.
<?php else: ?>
<span class="bold" >Note:</span> 
Edit or complete the treatment data of a patient.
<?php endif; ?>
<br>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> Explanation of the form's components?</h2>
<p>
	<span class="bold" >Weight:</span>
	Enter the patient's weight here.
	<br/><br/>
	<span class="bold" >Radio Buttons:</span>
	Choose between the tree posibilities "YES", "NO", "Don't know" by clicking into the circles.
	<br/>
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_radio_buttons.png" width="300" id="screenshot" height="79">
	<br/>
	<span class="bold" >Other problems:</span>
	Enter here other important data about the patient' treatment that is not mentioned anywhere else.
	<br/><br/>
	<span class="bold" >AIDS defining events:</span>
	Click on the <span class="blue">"select>>"</span> next to "Aids defining events" to enter the "AIDS defining events" selection form.
	After the selection a table will appear that contains the selected AIDS defining events.
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_aids_def_events.png" id="screenshot" width="473" height="83">
	<br/>
	<span class="bold" >Codes for ARV Therapie:</span>
	ARV drugs that was prescribed for the current encounter of the selected patient are displayed in this list:
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_drugs.png" id="screenshot" width="371" height="100">
	<br/>
	<span class="bold" >Relevant Comediacation:</span>
	All other drugs prescribed for the current encounteer appear in this list.
	<br>
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_comedi.png" id="screenshot" width="439" height="59">
	<br/>
	<span class="bold" >ARV Status:</span>
	For each visit select the status of the current ARV therapy:
	<br/><br/>
	Click on <span class="blue">"Select>>"</span> to give an reason for changing the ARV status. You will enter
	an extra Selection form.
	Selected Reason will appear in a table below.
	<br/>
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_status_reason.png" width="370" height="83" id="screenshot"><br/>
	<span class="bold" >Lab Results:</span>
	If there are laboratory test results for the selected patient they are shown in this list. 
	<br/>
	<img src="<?php echo $root_path; ?>help/en/img/en_arv_lab_results.png" width="452" height="142">
<p>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> I'm finished. What to do next?</h2>
<p>
	Click on the the <img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_save.png" alt="" width=61 height=16> Button to safe any changes on the form. Or click the <img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_cancel.png" alt="" width=61 height=16> button to leave the form without saving.
</p>
<?php if($src=='New Visit'): ?>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> I saved the form. Now I want to edit and complete the form data.</h2>
<p>
	Go back to the patient ARV menu.
	Click on "Show ARV data".
	Select a visit and click on "edit"
</p>
<?php endif; ?>
<br/>
<br>
<a href="javascript:window.history.back()" > &lt;&lt;prev </a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=billing_create_2.php&src=Billing :: Create Quotation">next>></a>

