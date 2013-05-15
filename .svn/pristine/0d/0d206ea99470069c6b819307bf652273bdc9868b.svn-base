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

			if (!$ward){

			header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&backpath=$backpath&bd=$bd&rm=$rm&pyear=$pyear&pmonth=$pmonth&pday=$pday&mode=$mode&released=1&lock=1&x_date=$x_date&x_time=$x_time&relart=$relart&encoder=".strtr($encoder," ","+")."&info=".strtr($info," ","+")."&station=$station&dept_nr=$dept_nr");

			}
			else
			{
				echo '
				<script  language="javascript">
					opener.focus();opener.location.reload();window.close();
				</script>';
			}
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

 $smarty->assign('sToolbarTitle',$LDReleasePatient);

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

echo $mode;
echo $released;

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
//$smarty->assign('sBarcodeLabel','<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>');
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
	$smarty->assign('sDischargeTypes',$sTemp);

	$obj_diag = New Diagnostics;
	$case_arr = $obj_diag->GetAllCasesFromPIDbyDate($enc_obj->PID());
	$smarty->assign('LDNotes',$LDLastDiagnosis);
	while(list($x,$v) = each($case_arr))
	{
		$case_data = $obj_diag->GetCase($x);
		$case_list = $case_list.'<b>'.date('Y-m-d',$case_data['timestamp']).':</b> '.$v.' - '.$obj_diag->get_icd10_description_from_code($v).'<br>';
		if($casecount++>3) break;
	}
	if(!$case_list) $case_list = $LDNoDiagnosesAvailable;
	$smarty->assign('diagnosis',nl2br($case_list));

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
		<input type="hidden" name="s_date" value="'."$pyear-$pmonth-$pday".'">

		<input type="hidden" name="ward" value="'.$ward.'">';


	$smarty->assign('sHiddenInputs',$sTemp);


if(($mode=='release')&&($released)) $sBreakButton= '<img '.createLDImgSrc($root_path,'close2.gif','0').'>';
	else $sBreakButton= '<img '.createLDImgSrc($root_path,'cancel.gif','0').' border="0">';

$smarty->assign('pbCancel','<a href="'.$breakfile.'">'.$sBreakButton.'</a>');

$smarty->assign('sMainBlockIncludeFile','nursing/discharge_patient_form.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>
