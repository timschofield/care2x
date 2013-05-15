<script type="text/javascript">
<!--
	if (parent.frames["HELPINDEXFRAME"] && parent.frames["HELPINDEXFRAME"].d && parent.frames["HELPINDEXFRAME"].d.openTo) { 		
		parent.frames["HELPINDEXFRAME"].d.openTo(17, true);
	}
//-->
</script>
<h1><?php echo $src; ?></h1>
<div>Click 
<?php if ($x1=='new') : ?>
<img src="<?php echo $root_path; ?>/gui/img/common/default/ball_red.png" style="vertical-align:bottom" alt="" width=20 height=22> 
<?php else : ?>
<img src="<?php echo $root_path; ?>/gui/img/common/default/ball_gray.png" style="vertical-align:bottom" alt=""  width=20 height=22> 
<?php endif; ?>
in The ARV clinic patient overviw to enter the ARV Menu.</div>
<h2><img src="<?php echo $root_path; ?>/gui/img/common/default/frage.gif" alt="" width=15 height=15> What can I do here?</h2>
<ul>
	<?php if ($x1=='new') : ?>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_new_patient.php&src=New ARV Patient">New ARV Patient:</a> Register a new patient for the ARV programme.</li>
 	<?php elseif ($x1='menu') : ?>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_new_patient.php&src=New ARV Patient">New ARV Patient:</a> Register a new patient for the ARV programme.</li>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_edit_patient.php&src=Edit ARV Patient">Edit ARV Patient:</a> Edit Patient's ARV Registration data.</li>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_new_visit.php&src=New Visit">New Visit:</a> Insert data of a new arv visit.</li>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_overview.php&src=ARV Overview">Show ARV Data:</a> Get an overview over patient's ARV data.</li>
 	<?php else : ?>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_edit_patient.php&src=Edit ARV Patient">Edit ARV Patient:</a> Edit Patient's ARV Registration data.</li>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_new_visit.php&src=New Visit">New Visit:</a> Insert data of a new arv visit.</li>
 	<li><a href="<?php echo $root_path; ?>/main/help-info.php?helpidx=arv_overview.php&src=ARV Overview">Show ARV Data:</a> Get an overview over patient's ARV data.</li>
	<?php endif; ?>
</ul>
<br>
<div><img src="<?php echo $root_path; ?>/help/en/img/en_arrow.jpg" id="arrow" alt="" width=16 height=14><a href="<?php echo $root_path; ?>main/help-info.php?helpidx=arv_workflow.php"> Look at the ARV workflow</a></div> 

