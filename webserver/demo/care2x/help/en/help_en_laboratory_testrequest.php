
	<script type="text/javascript">
	<!--
		if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 
			<?php if($x1==lab) :?> 
				parent.frames["HELPINDEXFRAME"].d.openTo(42, true);
			<?php elseif ($x1==bill) :?>
				parent.frames["HELPINDEXFRAME"].d.openTo(56, true);
			<?php else :?>
				parent.frames["HELPINDEXFRAME"].d.openTo(17, true);
			<?php endif; ?>
		}
	//-->
	</script>

 	<h1><? echo $src; ?></h1>
	<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How can I create a laboratory test request?</h2>
	<p>
 		<?php if($x1==lab or $x1==bill) :?> 
		 	<span class="bold" >Step 1:</span> 
		 	Search an admitted patient <img src="<?php echo $root_path; ?>/help/en/img/en_arrow.jpg" id="arrow" alt="" width=16 height=14>
		 	<a href="<?php echo $root_path; ?>main/help-info.php?helpidx=search_patient.php&src=Laboratories :: Test Request">How to search a patient?</a>.
		 	<br>
		 	<span class="bold" >Step 2:</span> 
		 	Fill out the parameter form.
		 	<br>
		 	<span class="bold" >Step 3:</span> 
	 	<?php else :?>
		 	<span class="bold" >Step 1:</span> 
		 	Fill out the parameter form.
		 	<br>
		 	<span class="bold" >Step 2:</span> 
	 	<?php endif; ?>
	 	Click the 
	 	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_send.png" alt="" width=57 height=16>  
	 	button.
 	</p>
 	<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to select a test parameter? </h2>
	<p>
	<span class="bold" >Step:</span> 
	Click the name of the test.
	<br/>
	<img src="<?php echo $root_path; ?>/help/en/img/en_request_chemlab.png" alt="" id="screenshot" width=352 height=125>
	</p>
	<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to unselect a test parameter?</h2>
	<p>
	<span class="bold" >Step:</span> 
	Click again the name of the test.
	</p>
	<?php if($x1==lab) :?> 
		<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> I need a new laboratory request form.</h2>
		<p>
		<span class="bold" >Step:</span> 
		Click 
		<img src="<?php echo $root_path; ?>help/en/img/en_button_blue_new_form.png" alt="" width=56 height=16>.
	<?php endif; ?>
	</p>
	<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How can I go back without sending the form? </h2>
	<p>
	<span class="bold" >Step:</span> 
	Click the button 
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_close.png" alt="" width=61 height=16>   
	or the Button 
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_cancel.png" alt="" width=58 height=16>  
	to return.
	</p>
	<br/>
	<br>
	<a href="javascript:window.history.back()" > &lt;&lt;prev </a>



