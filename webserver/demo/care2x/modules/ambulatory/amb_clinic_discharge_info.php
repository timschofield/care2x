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
$lang_tables[]='prompt.php';
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
if(!$encoder) $encoder=$_SESSION['sess_user_name'];

//$breakfile="amb_clinic_patients.php".URL_APPEND."&edit=$edit&dept_nr=$dept_nr";
$breakfile="javascript:window.close();";
//if($backpath) $breakfile=urldecode($backpath).URL_APPEND;
$thisfile=basename($_SERVER['PHP_SELF']);

# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_diagnostics.php');
$enc_obj=new Encounter;

if($enc_obj->loadEncounterData($pn)){
	//$db->debug=1;

	if(($mode=='release')&&!(isset($lock)||$lock)){
		$date=(empty($x_date))?date('Y-m-d'):formatDate2STD($x_date,$date_format);
		$time=(empty($x_time))?date('H:i:s'):convertTimeToStandard($x_time);
		# Check the discharge type
		switch($relart){
			case 8: if( $released=$enc_obj->DischargeFromDept($pn,$relart,$date,$time)){
							# Reset current department
							//$enc_obj->ResetAllCurrentPlaces($pn,0);
						}
						 break;
			default: $released=$enc_obj->Discharge($pn,$relart,$date,$time);
		}
		if($released){
			# If discharge note present
			if(!empty($info)){
				$data_array['notes']=$info;
				$data_array['encounter_nr']=$pn;
				$data_array['date']=$date;
				$data_array['time']=$time;
				$data_array['personell_name']=$encoder;
				$enc_obj->saveDischargeNotesFromArray($data_array);
			}

			# If patient died
			//$db->debug=1;
			if($relart==7){
				include_once($root_path.'include/care_api_classes/class_person.php');
				$person=new Person;
				$death['death_date']=$date;
				$death['death_encounter_nr']=$pn;
				if($dbtype=='mysql') $death['history']="CONCAT(history,'Discharged ".date('Y-m-d H:i:s')." $encoder\n')";
					else $death['history']="history || 'Discharged ".date('Y-m-d H:i:s')." $encoder\n' ";
				$death['modify_id']=$encoder;
				$death['modify_time']=date('YmdHis');
				@$person->setDeathInfo($enc_obj->PID(),$death);
				//echo $person->getLastQuery();
			}

			header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&backpath=$backpath&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&dept_nr=$dept_nr");
			exit;
		}
	}

		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$GLOBAL_CONFIG=array();
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
		$glob_obj->getConfig('patient_%');
		$glob_obj->getConfig('person_%');

		$result=&$enc_obj->encounter;

		/* Check whether config foto path exists, else use default path */
		$default_photo_path='fotos/registration';
		$photo_filename=$result['photo_filename'];
		$photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;
		require_once($root_path.'include/inc_photo_filename_resolve.php');
		/* Load the discharge types */
		$discharge_types=&$enc_obj->getDischargeTypesData();

		if(!isset($dept)||empty($dept)){
			# Create nursing notes object
			include_once($root_path.'include/care_api_classes/class_department.php');
			$dept_obj= new Department;
			$dept=$dept_obj->FormalName($dept_nr);
		}
	}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle','Discharge Summary');

 # href for the return button
 $smarty->assign('pbBack',FALSE);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('discharge_patient.php','Discharge Patient','','$station','$LDReleasePatient')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDReleasePatient);

 # If not yet released, create javascript code
 # Collect extra javascript code

  if(!$released){

	ob_start();

?>

<script language="javascript">
<!--

function pruf(d)
{
	if(!d.sure.checked){
		return false;
	}else{
		if(!d.encoder.value){
			alert("<?php echo $LDAlertNoName ?>");
			d.encoder.focus();
			return false;
		}
		if (!d.x_date.value){ alert("<?php echo $LDAlertNoDate ?>"); d.x_date.focus();return false;}
		if (!d.x_time.value){ alert("<?php echo $LDAlertNoTime ?>"); d.x_time.focus();return false;}
		// Check if death
		if(d.relart[3].checked==true&&d.x_date.value!=""){
			if(!confirm("<?php echo $LDDeathDateIs ?> "+d.x_date.value+". <?php echo "$LDIsCorrect $LDProceedSave" ?>")) return false;
		}
		return true;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php

	$sTemp = ob_get_contents();
	ob_end_clean();

	$smarty->append('JavaScript',$sTemp);
} // End of if !$released

if(($mode=="release")&&($released)){

	echo '
	<html><head>
	<script  language="javascript">
	window.opener.location.replace(\''.$backpath.'\');
	window.close();
	</script></head></html>';
	die();
	$smarty->assign('sPrompt',$LDJustReleased);
}

$smarty->assign('thisfile',$thisfile);
$smarty->assign('sBarcodeLabel','<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>');
$smarty->assign('img_source','<img '.$img_source.' align="top">');
$smarty->assign('LDLocation',"$LDClinic/$LDDept");
$smarty->assign('sLocation',$dept);
$smarty->assign('LDDate',$LDDate);

$temp_image="<a href=\"javascript:getARV('".$patient['pid']."','".$patient['encounter_nr']."')\"><img ".createComIcon($root_path,'ball_gray.png','0','',TRUE)." alt=\"inARV\"></a>";
$smarty->assign('sARVIcon', 'TEST');
	if($released){
		$smarty->assign('released',TRUE);
		$smarty->assign('x_date',nl2br($x_date));
	}else{
		$smarty->assign('sDateInput','<input type="text" name="x_date" size=12 maxlength=10 value="'.formatdate2Local(date('Y-m-d'),$date_format).'"  onBlur="IsValidDate(this,\''.$date_format.'\')"  onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">');
		$smarty->assign('sDateMiniCalendar',"<a href=\"javascript:show_calendar('discform.x_date','$date_format')\"><img ".createComIcon($root_path,'show-calendar.gif','0','top')."></a>");
	}
	$smarty->assign('LDClockTime',$LDClockTime);

	if($released) $smarty->assign('x_time',nl2br($x_time));
		else $smarty->assign('sTimeInput','<input type="text" name="x_time" size=12 maxlength=12 value="'.convertTimeToLocal(date('H:i:s')).'" onKeyUp=setTime(this,\''.$lang.'\')>');
	$smarty->assign('LDReleaseType',$LDReleaseType);

	$sTemp = '';
	if($released){

		while($dis_type=$discharge_types->FetchRow()){
			if($dis_type['nr']==$relart){
				//$sTemp = $sTemp.'&nbsp;';
				if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) $sTemp = $sTemp.$$dis_type['LD_var'];
					else $sTemp = $sTemp.$dis_type['name'];
				break;
			}
		}
	}else{
		$init=1;
		while($dis_type=$discharge_types->FetchRow()){
				# We will display only discharge types 1 to 7
				if(stristr('4,5,6',$dis_type['nr'])) continue;
			     $sTemp = $sTemp.'<input type="radio" name="relart" value="'.$dis_type['nr'].'"';
			     if($init){
				    $sTemp = $sTemp.' checked';
				    $init=0;
		         }
			     $sTemp = $sTemp.'>';
			     if(isset($$dis_type['LD_var'])&&!empty($$dis_type['LD_var'])) $sTemp = $sTemp.$$dis_type['LD_var'];
				    else $sTemp = $sTemp.$dis_type['name'];
			     $sTemp = $sTemp.'<br>';
		}
	}

	$patient_nr = $enc_obj->PID();
	$enc_obj->LastName();

	global $db;

	require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
	$coreObj = new core;
	$coreObj2 = new core;
	$coreObj3 = new core;

	$sqlPurchaseClass =  "SELECT purchasing_class FROM care_tz_drugsandservices WHERE purchasing_class != 'service' group by purchasing_class";
	$coreObj3->result= $db->Execute($sqlPurchaseClass);
	$tabAll = '<table cellpadding=6>';


	$encounterNr = $pn;
	while ($encounterNr != null)
	{
		//block "location"
		$tab_temp0 = '';
		$sql4 ="select * from care_encounter_location where encounter_nr =".$encounterNr;

		$coreObj->result = $db->Execute($sql4);
		foreach ($coreObj->result as $wert){
			//echo $wert['name'].'<br>';

			$sqlTemp="select * from care_encounter where encounter_nr=".$encounterNr;
			$ergTemp=$db->Execute($sqlTemp);
			$rowTemp=$ergTemp->FetchRow();

			if ($rowTemp['encounter_class_nr']==1)
			{
				//inpatient
				$table = 'care_ward';
				$column ='name';

			}else
			{
				//outpatient
				$table = 'care_department';
				$column = 'name_formal';

			}

			$sql5 = "select * from ".$table." where nr=".$wert['location_nr'];
			$ergebnis=$db->Execute($sql5);
			$row2=$ergebnis->FetchRow();


			if($wert['date_to']=="0000-00-00")
			{
				$date_to = '---';
			}
			else
			$date_to = $wert['date_to'];

			$type = $wert['type_nr'];

			$currWard = $wert['current_ward'];
			$encDate  = $wert['encounter_date'];


			if ($rowTemp['encounter_class_nr']==1)
			{
				//inpatient
				if ($type==1)
					$location = "Waiting Area";
				else
					$location = $row2[$column];

				if (($type == 1)||($type==2))
					$tab_temp0 .="<tr bgcolor=lightgreen><td>".$wert['date_from']."</td><td>".$wert['time_from']."</td><td>".$date_to."</td><td>".$wert['time_to']."</td><td>".$location."</td></tr>";
			}
			else
			{
				//outpatient
				$location = $row2[$column];
				$tab_temp0 .="<tr bgcolor=lightgreen><td>".$wert['date_from']."</td><td>".$wert['time_from']."</td><td>".$date_to."</td><td>".$wert['time_to']."</td><td>".$location."</td></tr>";
			}

		}

		if ($tab_temp0 != '')
		{

			$tabAll .= "<tr><td>&nbsp;</td></tr><tr><th>location</th></tr><tr><th align=left>date from</th><th align=left>time from</th><th align=left>date to</th><th align=left>time to</th><th align=left>location</th></tr>";
			$tabAll .= $tab_temp0;
			$tabAll .= "</table><br/><table cellpadding=6>";


		}// end of block "location"



		//drugs and services
		$tab_temp1 = '';
		$sql4 ="select distinct purchasing_class from care_tz_drugsandservices";
		$coreObj3->result = $db->Execute($sql4);
		foreach($coreObj3->result as $wert)
		{
			$p_class = $wert['purchasing_class'];

			$sql="SELECT * FROM care_encounter_prescription INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id=care_encounter_prescription.article_item_number where encounter_nr='".$encounterNr."' and purchasing_class='".$p_class."'";

			//sql-query for every purchasing class
			$coreObj->result = $db->Execute($sql);
			foreach ($coreObj->result as $wertInner){
				$tab_temp1 .="<tr><td>".$wertInner['article']."</td><td>".$wertInner['article_item_number']."</td></tr>";
			}


			//output only if there is any entry
			if ($tab_temp1 != '')
			{
				$tab_prescr1 = "<tr><td>&nbsp;</td></tr><tr><th>".$p_class."</th></tr><tr><th align=left>article</th><th align=left>article item number</th></tr>";
				$tab_prescr1 .= $tab_temp1;
			}else
				$tab_prescr1 ='';

		}

		$tabAll .= $tab_prescr1;
		$tabAll .="</table><br/><table cellpadding=6>";

		//diagnosises
		$tab_temp2 = '';
		$sql2 ="select * from care_tz_diagnosis where encounter_nr =".$encounterNr;
		$coreObj->result = $db->Execute($sql2);
		foreach ($coreObj->result as $wert){
			//echo $wert['ICD_10_code'].' '.$wert['ICD_10_description'].' '.date("d.m.Y H:i",$wert['timestamp']).'<br>';
			$tab_temp2 .="<tr><td>".date("d.m.Y H:i",$wert['timestamp'])."</td><td>".$wert['ICD_10_description']."</td><td>".$wert['ICD_10_code']."</td></tr>";
		}

		if ($tab_temp2 != '')
		{
			$tab_diagnosis = "<tr><td>&nbsp;</td></tr><tr><th>diagnosises</th></tr><tr><th align=left>date and time</th><th align=left>ICD 10 description</th><th align=left>ICD 10 code</th></tr>";
			$tab_diagnosis .= $tab_temp2;
		}
		else
			$tab_diagnosis = '';

		$tabAll .= $tab_diagnosis;
		$tabAll .= "</table><br/><table cellpadding=6>";


		//test findings chemlab
		$tab_temp3 = '';
		$sql3 ="select * from care_test_findings_chemlab where encounter_nr =".$encounterNr;
		//echo $sql3;
		$coreObj->result = $db->Execute($sql3);
		foreach ($coreObj->result as $wert){

			$batchNr = $wert['batch_nr'];

			$sqlBatch = "select * from care_test_findings_chemlabor_sub where batch_nr=$batchNr";
			$coreObj2->result = $db->Execute($sqlBatch);

			foreach ($coreObj2->result as $param)
			{
				$tab_temp3 .="<tr><td>".$wert['test_date']."</td><td>".$wert['test_time']."</td><td>".$param['paramater_name']."</td><td>".$param['parameter_value']."</td></tr>";
			}


		}

		if ($tab_temp3 != '')
		{
			$tab_findings_chemlab = "<tr><td>&nbsp;</td></tr><tr><th>laboratory</th></tr><tr><th align=left>date</th><th align=left>time</th><th align=left>parameter</th><th align=left>value</th></tr>";
			$tab_findings_chemlab .= $tab_temp3;
		}
		else
			$tab_findings_chemlab = '';

		$tabAll .= $tab_findings_chemlab;
		$tabAll .= "</table><br/><table cellpadding=6>";



		//block: find previous encounter_nr
		$sqlEncounter = "SELECT encounter_nr_prev FROM care_encounter where encounter_nr=$encounterNr";
		$result = $db->Execute($sqlEncounter);

		foreach ($result as $wert){
			$encounter_nr_prev = $wert['encounter_nr_prev'];
			//echo 'encounter nr prev: '.$encounter_nr_prev;
		}


		if ($encounter_nr_prev != 0)
			$encounterNr = $wert['encounter_nr_prev'];
		else
			$encounterNr = null;


	}//Ende der encounter-Schleife

	$tabAll .="</table>";

	$smarty->assign('list', $tabAll);

		/*important tables:
		 * care_class_encounter		 : division inpatient/outpatient
		 * care_department     		 : all outpatient departments
		 * care_ward            	 : all inpatient wards
		 * care_encounter_location 	 : history of patient by encounter_nr
		 * care_type_discharge       : type of discharge/transfer
		 *
		 * care_test_findings_chemlab
		 * care_test_findings_chemlabor_sub
		 */


	$smarty->assign('LDNurse',$LDNurse);

	$smarty->assign('encoder',$encoder);

	if(!(($mode=='release')&&($released))) {

		$smarty->assign('bShowValidator',TRUE);
		$smarty->assign('pbSubmit','<input type="submit" style="height:35;width:100" value="'.$LDRelease.'" >');
		$smarty->assign('sValidatorCheckBox','<input type="checkbox" name="sure" value="1">');
		$smarty->assign('LDYesSure',$LDYesSure);
	}

	$sTemp = '<input type="hidden" name="mode" value="release">
						';

	if(($released)||($lock)) $sTemp = $sTemp.'<input type="hidden" name="lock" value="1">';

	$sTemp = $sTemp.'<input type="hidden" name="sid" value="'.$sid.'">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type="hidden" name="station" value="'.$station.'">
		<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
		<input type="hidden" name="dept" value="'.$dept.'">
		<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
		<input type="hidden" name="pday" value="'.$pday.'">
		<input type="hidden" name="pmonth" value="'.$pmonth.'">
		<input type="hidden" name="pyear" value="'.$pyear.'">
		<input type="hidden" name="rm" value="'.$rm.'">
		<input type="hidden" name="bd" value="'.$bd.'">
		<input type="hidden" name="pn" value="'.$pn.'">
		<input type="hidden" name="backpath" value="'.urlencode($backpath).'">
		<input type="hidden" name="s_date" value="'."$pyear-$pmonth-$pday".'">';

	$smarty->assign('sHiddenInputs',$sTemp);


if(($mode=='release')&&($released)) $sBreakButton= '<img '.createLDImgSrc($root_path,'close2.gif','0').'>';
	else $sBreakButton= '<img '.createLDImgSrc($root_path,'cancel.gif','0').' border="0">';

$smarty->assign('pbCancel','<a href="'.$breakfile.'">'.$sBreakButton.'</a>');

$smarty->assign('sMainBlockIncludeFile','nursing/discharge_patient_info.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>
