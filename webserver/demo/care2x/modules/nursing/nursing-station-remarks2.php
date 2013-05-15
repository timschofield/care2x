<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('date_time.php','departments.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
//define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
require_once($root_path.'include/care_api_classes/class_person.php');
$report_obj= new NursingNotes;
$person_obj= new Person;

require_once($root_path.'include/care_api_classes/class_notes.php');
$notes_obj= new Notes;

$pid=$person_obj->GetPidFromEncounter($pn);
 
//if ($station=='') { $station='Non-department specific';  }
if($pday=='') $pday=date('d');
if($pmonth=='') $pmonth=date('m');
if($pyear=='') $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;

$thisfile=basename($_SERVER['PHP_SELF']);
			
require_once($root_path.'include/inc_date_format_functions.php');


if($mode=='save'){
	# Know where we are
	switch($_SESSION['sess_user_origin']){
		case 'lab': $_POST['location_type_nr']=1; # 1 =department
						break;
		default: 	$_POST['location_type_nr']=2; # 2 = ward 
						break;
	}
	
	$_POST['location_id']=$station; 
	
	$type_no = $_GET['types'];
	$_POST['type_nr']= $type_no;
	
	if($report_obj->saveDailyNotesType($_POST)){
		//echo $report_obj->getLastQuery();
		header("location:$thisfile".URL_REDIRECT_APPEND."&pn=$pn&station=$station&dept_nr=$dept_nr&location_nr=$location_nr&saved=1");
		exit;
	}else{echo $report_obj->getLastQuery()."<p>$LDDbNoUpdate";}
}else{ //echo $_SESSION['sess_pid'];
	if($d_notes=&$report_obj->getDailyNotesTypes($pn)){
   		include_once($root_path.'include/inc_editor_fx.php');
		$occup=true;
	}
	# If location name is empty, fetch by location nr
	if(!isset($station)||empty($station)){
		# Know where we are
		switch($_SESSION['sess_user_origin']){
			case 'amb': # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_department.php');
						$obj= new Department;
						$station=$obj->FormalName($dept_nr);
						break;
			default: # Create nursing notes object 
						include_once($root_path.'include/care_api_classes/class_ward.php');
						$obj= new Ward;
						$station=$obj->WardName($location_nr);
		}
		echo $obj->getLastQuery();
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar

 $smarty->assign('sToolbarTitle', $LDNotes.' :: '.$$station.' ('.formatDate2Local($s_date,$date_format).')');

   # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('outpatient_notes.php','Outpatient Clinic :: Notes on the patient','','$station','$LDNotes')");

 # href for close button
 $smarty->assign('breakfile','javascript:window.close()');


 # OnLoad Javascript code
  if(($mode=='save')&&($occup)||$saved) $sTemp = "window.opener.location.reload();";
  	else $sTemp = '';

 $smarty->assign('sOnLoadJs','onLoad="'.$sTemp.' if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDNotes.' :: '.$$station.' ('.formatDate2Local($s_date,$date_format).')');

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!-- 
var n=false;
function checkForm(f)
{
	if(f.types.value=="")
	{
	alert("<?php echo 'Please enter Notes Type'; ?>");
	f.types.focus();
	return false;
	}
	else 
	 
	if(f.notes.value=="")
	{
	alert("<?php echo 'Please enter Notes '; ?>");
        f.notes.focus();
	return false;
	}
	else 
	 
	if(f.personell.value=="")
	{
	alert("<?php echo 'Please enter Personell Name '; ?>");
        f.personell_name.focus();
        return false;
	}

	else return true;
}

function setChg()
{
	n=true;
}
// -->
</script>

<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

ob_start();

if($occup){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=80%>
  <tr class="adm_item">
    <td width="20%"><FONT color="#000066"><?php echo $LDDate; ?></td>
    <td width="10%"><FONT color="#000066"><?php echo $LDTime; ?></td>
    <td width="45%"><FONT color="#000066"><?php echo $LDNotes; ?></td>
    <td width="25%"><FONT color="#000066"><?php echo $LDCreatedBy; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$d_notes->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		if($toggle) $sRowClass='wardlistrow2';
			else $sRowClass='wardlistrow1';
		$toggle=!$toggle;
		if(!empty($row['short_notes'])) $bgc='yellow';
		
	
	$notes_type=$report_obj->GetNameOfNotesFromType($row['type_nr']);
?>

  <tr  class="<?php echo $sRowClass ?>"  valign="top">
    <td><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><?php if($row['time']) echo $row['time']; ?></td>
    <td><FONT color="#000033">
	 <?php 
		if(!empty($row['type_nr'])) echo $notes_type; ?><hr />
		
	<?php 
		if(!empty($row['short_notes'])) echo '<br>[ '.deactivateHotHtml($row['short_notes']).' ]'; 
		if(!empty($row['notes'])) echo deactivateHotHtml(nl2br($row['notes']));?>
	</td>
		
	
    <td><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>

 <ul>
 
 
<form method="post" name="remform" action="nursing-station-remarks.php" onSubmit="return checkForm(this)">
<table>

<tr bgcolor="#E7EEE6">
          <td width="119" height="30" align="right" bgcolor="#E7EEE6"><strong><?php echo $LDDate ?>
		  </strong></td>
          <td colspan="2" bgcolor="#FFFFFF"><input name="date" type="text" value="<?php echo date('d/m/Y'); ?>" size="43" readonly="true" />
          </td>
      </tr>
		
 <tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong><?php echo $LDNotesType ?></strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7">

            <?php $notes_obj->GetTypesOfNotes();?>

        </td>
      </tr>
		
		<tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong><?php echo $LDTitleNotes ?></strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7"><input name="short" type="text" id="short" size="43" maxlength="100">
          </td>
        </tr>
		
		<tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="top" nowrap bgcolor="#E7EEE6"><strong><?php echo $LDFullDescription ?>
		  </strong></td>
          <td width="257" align="left" nowrap bgcolor="#FFFFFF" class="style7"><textarea name="notes" cols="40" rows="5" id="notes" wrap="physical" onKeyup="setChg()"></textarea>
          </td>
          <td width="66" align="left" nowrap bgcolor="#FFFFFF" class="style7"><?php echo $LDRequired ?></td>
        </tr>
		
		<tr align="center" valign="top" bgcolor="#FFFFFF">
          <td align="right" valign="middle" bgcolor="#E7EEE6"><strong><?php echo $LDEnteredBy ?></strong></td>
          <td colspan="2" align="left" bgcolor="#FFFFFF" class="style7">
          <input type="text" name="personell_name" size=43 maxlength=43 
		  value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly>
		
		  </td>
	  </tr>
		 
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="location_nr" value="<?php echo $location_nr; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
</table>
<p>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif') ?>>
</form>

<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
