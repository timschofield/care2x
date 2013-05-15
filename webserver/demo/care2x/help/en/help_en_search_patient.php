
	<script type="text/javascript">
	<!--
		if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 		
			<?php if ($src=="Registration :: Search") : ?>
				parent.frames["HELPINDEXFRAME"].d.openTo(5, true);
			<?php elseif ($src=="Admission :: Search") : ?>
				parent.frames["HELPINDEXFRAME"].d.openTo(10, true);
			<?php elseif ($src=="Laboratories :: Search Patient") : ?>
				parent.frames["HELPINDEXFRAME"].d.openTo(42, true);
			<?php elseif ($src=="Billing :: Drug and other Services Request") : ?>
				parent.frames["HELPINDEXFRAME"].d.openTo(56, true);
			<?php endif; ?>
		}
	//-->
	</script>

 	<h1><?php echo $src;?></h1>
 	<?php if ($src=="Registration :: Search") : ?>
 		<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to search an already registered patient?</h2>
 	<?php elseif ($src=="Insurance Management :: Member Management") : ?>
 		<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to search for a person?</h2>
 	<?php elseif ($src=="Admission :: Search") : ?>
 		<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to search an admitted patient?</h2>
 	<?php else : ?>
 		<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> How to search a patient?</h2>
 	<?php endif; ?>
 	<p>
 	
 	<?php if ($src=="Registration :: Search") : ?>
 		<span class="bold" >Option 1:</span> 
		Click "Search" in the left registration submenu.
		<br>
		<img src="<?php echo $root_path; ?>help/en/img/en_menu_search.png" alt="" id="screenshot" width=156 height=91>  
		<br>
		<span class="bold" >Option 2:</span> 
		Click the "Search" register tab.
		<br>
		<img src="<?php echo $root_path; ?>help/en/img/en_register_search.png" alt="" id="screenshot" width=405 height=23>  
		<br><br>
 	<?php elseif ($src=="Admission :: Search"): ?>
 		<span class="bold" >Note:</span> 
 		With this option you can find the patients who are admitted in the hospital now.
 		<br>
 		<span class="bold" >Option 1:</span> 
		Click "Search Admission" in the left registration submenu.
		<br>
 		<img src="<?php echo $root_path; ?>help/en/img/en_menu_search_admission.png" alt="" id="screenshot" width=160 height=92>
 		<br><br>
 	<?php endif; ?>
 	
 	<span class="bold" >Step 1:</span> 
 	Enter either full information or a few letters from a patient's information, like for example first name, or family name, 
 	<?php if ($src=="Registration :: Search") : ?>
 		or the hospital file nr. 
 	<?php else : ?>
 		or the encounter number. 
 	<?php endif; ?>
 	<br><br>
 	Example 1: enter "21000012" or "12".<br/>
 	Example 2: enter "Guerero" or "gue".<br/>
 	Example 3: enter "Alfredo" or "Alf".<br><br>
 	<span class="bold" >Note:</span> 
 	You can also use the <span class="red">%</span> or <span class="red">*</span> wildcard. 
 	<br>
 	<?php if ($src=="Registration :: Search") : ?>
 	<span class="bold" >Note:</span>
 	If you want to search for both family and first names activate the "Search for first names, too" box.
 	<br>
 	<img src="<?php echo $root_path; ?>help/en/img/en_search_first_name.png" alt="" id="screenshot" width=193 height=24>  
 	<br/>
 	<?php endif; ?>
 	<span class="bold" >Step 2:</span> 
 	Click the 
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_search.png" alt="" width=58 height=16>  
	button to start searching. 
 	<br>
    <span class="bold" >Step 3:</span>
    If the search finds a result, select the right person from the displayed list by clicking its
    <?php if ($src=="Billing :: Archive") : ?>
 		bill number.
 		<img src="<?php echo $root_path; ?>gui/img/common/default/billing_archive.gif" alt="" id="screenshot" width=476 height=25> 
    <?php elseif ($src=="Laboratories :: Test Request") : ?>
 		<img src="<?php echo $root_path; ?>gui/img/control/default/en/en_ok_small.gif" alt="" width=115 height=16> 
 		button. 
 	<?php elseif ($src=="Billing :: Drug and other Services Request" or $src=="Prescription :: Overview") : ?>
 		<img src="<?php echo $root_path; ?>gui/img/common/default/pdata.gif" alt="" width=20 height=20>
 		button. 
 	<?php elseif ($src=="Admission :: Search") : ?>
 		<img src="<?php echo $root_path; ?>gui/img/common/default/pdata.gif" alt="" width=20 height=20>
 		button to see the admission data of the person you are looking for.
 		<br>
 		<span class="bold" >Note:</span> 
		If you don’t find the patient try the "Archive Search". Follow the instructions 
		<br> 
		<img src="<?php echo $root_path; ?>help/en/img/en_arrow.jpg" alt="" width=16 height=14>
		<a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=search_advanced.php&src=Admission :: Archive Search">
		How to use the archive search?</a> 
 		Look also at the
 		<img src="<?php echo $root_path; ?>help/en/img/en_arrow.jpg" alt="" width=16 height=14>
 		<a href="<?php echo $root_path; ?>main/help-info.php?helpidx=tips_and_tricks.php&src=Search :: Tips & Tricks">
 		Tips & Tricks in searching a person
 		</a>
 	<?php elseif ($src=="Laboratories :: Search Patient") : ?>
		<img src="<?php echo $root_path; ?>gui/img/common/default/play_one.gif" alt="" width=15 height=15>
 		button.
 	<?php elseif ($src=="Registration :: Search") : ?>
 		<img src="<?php echo $root_path; ?>gui/img/control/default/en/en_ok_small.gif" alt="" width=115 height=16> 
 		button to see the registration data of the person you are looking for.
 		<br>
 		<span class="bold" >Note:</span> 
 		If you don't find the person you are looking for read the 
 		<img src="<?php echo $root_path; ?>/help/en/img/en_arrow.jpg" alt="" id="arrow" width=16 height=14>
 		<a href="">Tips & tricks in searching a person</a>.
		If you have too many results try the "Advanced Search". 
		<br>Click  
		<img src="<?php echo $root_path; ?>help/en/img/en_arrow.jpg" alt="" width=16 height=14>
		<a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=search_advanced.php&src=Registration :: Advanced Search">
		How to use the advanced search?</a> for more information.
 	<?php endif; ?>
 	<br>
	<span class="bold">Note:</span> 
	If you decide to cancel search click the 
	<?php if ($src=="Billing :: Archive") : ?>
	<img src="<?php echo $root_path; ?>help/en/img/en_button_close.png" alt="" width=71 height=16> 
	<?php else : ?>
	<img src="<?php echo $root_path; ?>/help/en/img/en_button_blue_close.png" alt="" width=61 height=16>  
	button. 
	<?php endif; ?>
	</p>
	<br>
	<br>
	<a href="javascript:window.history.back()" > &lt;&lt;prev </a>
	<?php if ($src=="Laboratories :: Search Patient") : ?>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=lab_report_edit.php&src=Laboratories :: Lab Report Edit">next>></a>
	<?php endif; ?>


