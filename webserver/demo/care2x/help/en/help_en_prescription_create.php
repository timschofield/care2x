
<?php if ($x1=="pharmacy"):  ?>	
<script type="text/javascript">
<!--
	if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 		
		parent.frames["HELPINDEXFRAME"].d.openTo(49, true);
	}
//-->
</script>
<?php endif;?>

<h1><?php echo $src; ?></h1>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to select a prescription item groups?</h2>
<p>
 	<span class="bold" >Note:</span> 
 	If you clicked on 
 	<img src="<?php echo $root_path; ?>gui/img/common/default/createnew_tz.gif" width=96 height=16/> 
 	you will get this view:
 	<br><br>
 	<img src="<?php echo $root_path; ?>/gui/img/common/default/prescription_help_selection.gif" width=480 height=184/>
 	<br><br>
 	<span class="bold" >Step 1:</span> 
 	Click on one of the thumbnails (small pictures) to select a main item group like "Supplies" or "Special drugs".
 	<br>
 	<span class="bold" >Step 2:</span> 
 	Some groups have very much items. To get a better view on it you're able to select a sub item group, but this is optional and not every main group has sub groups!
</p>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to add an item to a prescription?</h2>
<p>
	<span class="bold" >Step 1:</span> 
	Search the "Available items" list down until you found the right one. Now double click it or use the "add >>"-button. If the item is already prescribed, a warning message will appear. 
	<br>
	<span class="bold" >Step 2:</span> 
	You can add as much items as you want. To switch the item groups just click another thumbnail (explained above). Your "Selected items"-List will stay the same throughout all groups, so feel free to navigate through the groups as you want it.
</p>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to remove an item to a prescription?</h2>
<p>
	<span class="bold" >Step:</span> 
	Select an item in the "Selected items"-List and double click it or use the "<< del"-button.
</p>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> I'm finished with the selection, how to proceed?</h2>
<p>
	<span class="bold" >Step 1:</span> 
	Click on the button "Prescribe!" you will get this view:
	<br>
	<img src="<?php echo $root_path; ?>/help/en/img/en_prescription_dosage.png" alt="" id="screenshot" width=387 height=131>
	<br>
	<span class="bold" >Step 2:</span> 
	Enter a overall dosage for the first item. Please use only numbers like without "." and "," for example "15".
	<br>
	<span class="bold" >Step 3:</span> 
	Enter a note for example the daily dosage, how to use it, etc. This is a free text field.
	<br>
	<span class="bold" >Step 4:</span> 
	Correct the entry in the "Prescribed by" field if necessary.
	<br>
	<span class="bold" >Step 5:</span> 
	If you have more than one item in your prescription list redo the 2 previous steps with the other prescriptions.
	<br>
	<span class="bold" >Step 6:</span> 
	Click on 
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_save.png" alt="" width=61 height=16>  
	to finalize the prescription and return to "pending prescriptions", or 
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_close.png" alt="" width=61 height=16>   
	to return without saving the prescription.		
</p>
<?php if ($x1=="patient_charts"):  ?>	
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> I am finished. How to go back to the patient's chart folder</h2>
<p>
	<span class="bold" >Step 1:</span> 
	Click the button "Close".
</p>
<?php endif; ?>
<br>
<br>
<a href="javascript:window.history.back()" > &lt;&lt;prev </a>





