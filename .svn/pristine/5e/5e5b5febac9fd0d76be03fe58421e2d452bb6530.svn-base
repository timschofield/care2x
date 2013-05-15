<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

#$db->debug=1;

define('SHOW_DOC_2',1);  # Define to 1 to  show the 2nd doctor-on-duty
define('DOC_CHANGE_TIME','7.30'); # Define the time when the doc-on-duty will change in 24 hours H.M format (eg. 3 PM = 15.00, 12 PM = 0.00)

$lang_tables[]='prompt.php';
define('LANG_FILE','nursing.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_pflege_user';
require($root_path.'include/inc_front_chain_lang.php');

if(empty($_COOKIE[$local_user.$sid])){
	$edit=0;
	include($root_path."language/".$lang."/lang_".$lang."_".LANG_FILE);
}

# Set default values if not available from url
if (!isset($station)||empty($station)) { $station=$_SESSION['sess_nursing_station']; } # Default station must be set here !!
if(!isset($pday)||empty($pday)) $pday=date('d');
if(!isset($pmonth)||empty($pmonth)) $pmonth=date('m');
if(!isset($pyear)||empty($pyear)) $pyear=date('Y');
$s_date=$pyear.'-'.$pmonth.'-'.$pday;
if($s_date==date('Y-m-d')) $is_today=true;
	else $is_today=false;

if(!isset($mode)) $mode='';

$breakfile='nursing.php'.URL_APPEND; # Set default breakfile
$thisfile=basename($_SERVER['PHP_SELF']);

if(isset($retpath)){
	switch($retpath){
		case 'quick': $breakfile='nursing-schnellsicht.php'.URL_APPEND;
							break;
		case 'ward_mng': $breakfile='nursing-station-info.php'.URL_APPEND.'&ward_nr='.$ward_nr.'&mode=show';
							break;
		case 'search_patient': $breakfile='nursing-patient-such-start.php'.URL_APPEND;
	}
}

# Create ward object
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj= new Ward;

# Create insurance object
        include_once($root_path.'include/care_api_classes/class_tz_insurance.php');
        $ins_obj = New Insurance_tz;

# create multi functional object
        include_once($root_path.'include/care_api_classes/class_multi.php');
        $multi_obj = New multi;
		$vct = $multi_obj->__genNumbers();

# Create insurance object
        include_once($root_path.'include/care_api_classes/class_mini_dental.php');
        $mini_obj = New dental;

# Load date formatter
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');

if(($mode=='')||($mode=='fresh')){
	if($ward_info=&$ward_obj->getWardInfo($ward_nr)){
		$room_obj=&$ward_obj->getRoomInfo($ward_nr,$ward_info['room_nr_start'],$ward_info['room_nr_end']);

		$all_info=$ward_obj->getAll_WardInfo($doclist);

		if(is_object($room_obj)) {
			$room_ok=true;
		}else{
			$room_ok=false;
		}
		# GEt the number of beds
		$nr_beds=$ward_obj->countBeds($ward_nr);


		//echo $ward_obj->getLastQuery();
		//echo $ward_obj->LastRecordCount();


		$ward_ok=true;

		# Create the waiting inpatients' list
		$wnr=(isset($w_waitlist)&&$w_waitlist) ? 0 : $ward_nr;
		$waitlist=$ward_obj->createWaitingInpatientList($wnr);
		$waitlist_count=$ward_obj->LastRecordCount();

		# Get the doctor's on duty information
		#### Start of routine to fetch doctors on duty
		$elem='duty_1_pnr';
		if(SHOW_DOC_2) $elem.=',duty_2_pnr';

		# Create personnel object
		include_once($root_path.'include/care_api_classes/class_personell.php');
		$pers_obj=new Personell;

		if($result=$pers_obj->getDOCDutyplan($ward_info['dept_nr'],$pyear,$pmonth,$elem)){
			$duty1=&unserialize($result['duty_1_pnr']);
			if(SHOW_DOC_2) $duty2=&unserialize($result['duty_2_pnr']);
					//echo $sql."<br>";
		}
		//echo $sql;
		# Adjust the day index
		$offset_day=$pday-1;
		# Consider the early morning hours to belong to the past day
		if(date('H.i')<DOC_CHANGE_TIME) $offset_day--;
		if($pnr1=$duty1['ha'.$offset_day]){
			$person1=&$pers_obj->getPersonellInfo($pnr1);
		}
		if(SHOW_DOC_2 && ($pnr2=$duty2['hr'.$offset_day])){
			$person2=&$pers_obj->getPersonellInfo($pnr2);
		}
		#### End of routine to fetch doctors on duty
	}else{
		$ward_ok=false;
	}
}elseif($mode=='newdata'){

	if(($pn=='lock')||($pn=='unlock')){
		//$db->debug=true;
		if($pn=='lock') $ward_obj->closeBed($ward_nr,$rm,$bd);
			else $ward_obj->openBed($ward_nr,$rm,$bd);

		//header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
		//exit;
	}else{
		if($ward_obj->AdmitInWard($pn,$ward_nr,$rm,$bd)){
			//echo "ok";
			$ward_obj->setAdmittedInWard($pn,$ward_nr,$rm,$bd);
		}
		//header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
		//exit;
	}
	header("location:nursing-station.php".URL_REDIRECT_APPEND."&edit=1&mode=&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station&ward_nr=$ward_nr");
	exit;
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
 $smarty->assign('sToolbarTitle', $LDServicesList[$doclist]." $LDServicesDesc (".formatDate2Local($s_date,$date_format,'','',$null='').")");

  # hide back button
 $smarty->assign('pbBack',TRUE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_station.php','$mode','$occup','$station','$LDStation')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDStation  ".$ward_info['name']." $LDOccupancy (".formatDate2Local($s_date,$date_format,'','',$null='').")");

# Reload the page after 5 minutes
	$smarty->assign('sReloadPage',TRUE);
	$smarty->assign('sReloadTarget',$REQUEST_URI.'&refreshed=1');
	$smarty->assign('sReloadDelay',300);

 # Collect extra javascript code

 ob_start();

?>
<script language="javascript">
<!--
var urlholder;

function getinfo(pn){

<?php /* if($edit)*/
	{ echo '
	urlholder="nursing-station-patientdaten.php'.URL_REDIRECT_APPEND;
	echo '&pn=" + pn + "';
	echo "&pday=$pday&pmonth=$pmonth&pyear=$pyear&edit=$edit&station=".$ward_info['name'];
	echo '";';
	echo '
	patientwin=window.open(urlholder,pn,"width=700,height=600,menubar=no,resizable=yes,scrollbars=yes");
	';
	}
	/*else echo '
	window.location.href=\'nursing-station-pass.php'.URL_APPEND.'&rt=pflege&edit=1&station='.$station.'\'';*/
?>

	}
function getrem(pn){
	urlholder="nursing-station-remarks.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pn+"<?php echo "&dept_nr=$ward_nr&location_nr=$ward_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&station=$station"; ?>";
	patientwin=window.open(urlholder,pn,"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
	}

function indata(room,bed)
{
	urlholder="nursing-station-bettbelegen.php<?php echo URL_REDIRECT_APPEND; ?>&rm="+room+"&bd="+bed+"<?php echo "&py=".$pyear."&pm=".$pmonth."&pd=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&s=<?php echo $station; ?>&wnr=<?php echo $ward_nr; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
function release(room,bed,pid)
{
	urlholder="nursing-station-patient-release.php<?php echo URL_REDIRECT_APPEND; ?>&rm="+room+"&bd="+bed+"&pn="+pid+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&station=<?php echo $station; ?>&ward_nr=<?php echo $ward_nr; ?>";
	//indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes"
	window.location.href=urlholder;
}

function release_info(pid)
{
	urlholder="../../modules/ambulatory/amb_clinic_discharge_info.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"<?php echo "&pyear=".$pyear."&pmonth=".$pmonth."&pday=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>&station=<?php echo $station; ?>&dept_nr=<?php echo $dept_nr; ?>&backpath=<?php echo $breakfile; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=730,menubar=no,resizable=yes,scrollbars=yes");
	//window.location.href=urlholder;
}

function unlock(b,r)
{
<?php
	echo 'urlholder="nursing-station.php'.URL_REDIRECT_APPEND.'&mode=newdata&pn=unlock&rm="+r+"&bd="+b+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&station='.$station.'&ward_nr='.$ward_nr.'";
	';
?>
	if(confirm('<?php echo $LDConfirmUnlock ?>'))
	{
		window.location.replace(urlholder);
	}
}

function popinfo(l,d)
{
	urlholder="<?php echo $root_path ?>modules/doctors/doctors-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;

	infowin=window.open(urlholder,"dienstinfo","width=400,height=450,menubar=no,resizable=yes,scrollbars=yes");

}
function assignWaiting(pn,pw)
{
	urlholder="nursing-station-assignwaiting.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pat_station="+pw+"&ward_nr=<?php echo $ward_nr ?>&station=<?php echo $station ?>";
	asswin<?php echo $sid ?>=window.open(urlholder,"asswind<?php echo $sid ?>","width=650,height=600,menubar=no,resizable=yes,scrollbars=yes");

}
function Transfer(pn,pw)
{
	if(confirm("<?php echo $LDSureTransferPatient ?>")){
		urlholder="nursing-station-transfer-select.php<?php echo URL_REDIRECT_APPEND ?>&pn="+pn+"&pat_station="+pw+"&ward_nr=<?php echo $ward_nr ?>&station=<?php echo $station ?>";
		transwin<?php echo $sid ?>=window.open(urlholder,"transwin<?php echo $sid ?>","width=650,height=600,menubar=no,resizable=yes,scrollbars=yes");
	}
}
<?php
require($root_path.'include/inc_checkdate_lang.php');
?>
// -->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>

<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:10}
</style> <?php

$sTemp = ob_get_contents();

ob_end_clean();
$smarty->append('JavaScript',$sTemp);

if(($occup=='template')&&(!$mode)&&(!isset($list)||!$list)){

	$smarty->assign('sWarningPrompt'.$LDNoListYet.'<br>
			<form action="nursing-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
   			<input type="hidden" name="lang" value="'.$lang.'">
   			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
			<input type="hidden" name="mode" value="getlast">
			<input type="hidden" name="c" value="1">
			<input type="hidden" name="edit" value="'.$edit.'">
   			<input type="submit" value="'.$LDShowLastList.'" >
 			</form>');

}elseif($mode=="getlast"){

	$sWarnBuffer = $LDLastList;
			if($c>2) $sWarnBuffer = $sWarnBuffer.'<font color=red><b>'.$LDNotToday.'</b></font><br>'.str_replace("~nr~",$c,$LDListFrom);
				else $sWarnBuffer = $sWarnBuffer.'<font color=red><b>'.$LDFromYesterday.'</b></font><br>
				';
			$sWarnBuffer = $sWarnBuffer.'
			<form action="nursing-station.php" method=post>
			<input type="hidden" name="sid" value="'.$sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
  			<input type="hidden" name="pyear" value="'.$pyear.'">
 			<input type="hidden" name="pmonth" value="'.$pmonth.'">
  			<input type="hidden" name="pday" value="'.$pday.'">
			<input type="hidden" name="station" value="'.$station.'">
			<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
			<input type="hidden" name="mode" value="copylast">&nbsp;&nbsp;&nbsp;';
			if($c>2) $sWarnBuffer = $sWarnBuffer.'<input type="submit" value="'.$LDCopyAnyway.'">';
				else $sWarnBuffer = $sWarnBuffer.'
   					<input type="submit" value="'.$LDTakeoverList.'" >';
			$sWarnBuffer = $sWarnBuffer.'
			&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDDoNotCopy.'" onClick="javascript:window.location.href=\'nursing-station.php?sid='.$sid.'&edit=1&list=1&station='.$station.'&mode=fresh\'">
 			</form>';

	$smarty->assign('sWarningPrompt',$sWarnBuffer);
}

# If ward exists, show the occupancy list
if($ward_ok){
	if($pyear.$pmonth.$pday<date('Ymd')){
	 	$smarty->assign('sWarningPrompt','
		<img '.createComIcon($root_path,'warn.gif','0','absmiddle',TRUE).'> <font color="#ff0000"><b>'.$LDAttention.'</font> '.$LDOldList.'</b>');

		# Prevent adding new patients to the list  if list is old
		$edit=FALSE;
	}

	# Start here, create the occupancy list
	# Assign the column  names

	$smarty->assign('LDRoom',$LDRoom);
	$smarty->assign('LDBed',$LDPatListElements[1]);
	$smarty->assign('LDFamilyName',$LDLastName);
	$smarty->assign('LDName',$LDName);
	$smarty->assign('LDBirthDate',$LDBirthDate);
	$smarty->assign('LDPatNr',$LDPatNr);
	$smarty->assign('LDAdmissionDate',$LDAdmissionDate);
	$smarty->assign('LDInsuranceType',$LDPatListElements[6]);
	$smarty->assign('LDOptions',$LDPatListElements[7]);

	# Initialize help flags
	$toggle=1;
	$room_info=array();
	# Set occupied bed counter
	$occ_beds=0;
	$lock_beds=0;
	$males=0;
	$females=0;
	$cflag=$ward_info['room_nr_start'];

	# Initialize list rows container string
	$sListRows='';

	# Loop trough the ward rooms

	if (is_object($all_info)){
		while($genInfo=$all_info->FetchRow()){

				$ward_nr=$genInfo['current_ward_nr'];
				$i = $genInfo['current_room_nr'];

				$ward_info=&$ward_obj->getWardInfo($ward_nr);
				$room_obj=&$ward_obj->getRoomInfo($ward_nr,$i,$i);

				$ward_obj->DocServicesList = TRUE;
				$ward_obj->DocServicesList = TRUE;
				$ward_obj->enk=$genInfo['encounter_nr'];

				# Get ward patients
				if($is_today) $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr);
					else $patients_obj=&$ward_obj->getDayWardOccupants($ward_nr,$s_date);

				if(is_object($patients_obj)){
					# Prepare patients data into array matrix

					while($buf=$patients_obj->FetchRow()){
						$patient[$buf['room_nr']][$buf['bed_nr']]=$buf;
						$bed_nr = $buf['bed_nr'];
					}

					$patients_ok=true;
					$occup='ja';

					foreach($patient[$i] as $vim){
						$bed = $vim;
						break;
					}

					$j = $bed_nr;

					$bed = $patient[$i][$j];

					#print '0000000000=='.$bed['name_last'];

				 	$is_patient=true;
				 	# Increase occupied bed nr
				 	$occ_beds++;
					$edit=true;

					$room_info=$room_obj->FetchRow();

				}else{
					$patients_ok=false;
					$room_info['nr_of_beds']=1;
					$edit=false;

				}

				// Scan the patients object if the patient is assigned to the bed & room
				# Loop through room beds

				//for($j=1;$j<=$room_info['nr_of_beds'];$j++){
					# Reset elements

					$smarty->assign('sMiniColorBars','');
					$smarty->assign('sRoom','');
					$smarty->assign('sBed','');
					$smarty->assign('sBedIcon','');
					$smarty->assign('cComma','');
					$smarty->assign('sFamilyName','');
					$smarty->assign('sName','');
					$smarty->assign('sTitle','');
					$smarty->assign('sBirthDate','');
					$smarty->assign('sPatNr','');
					$smarty->assign('sAdmDate','');
					$smarty->assign('sInsuranceType','');
					$smarty->assign('sAdmitDataIcon','');
					$smarty->assign('sChartFolderIcon','');
					$smarty->assign('sNotesIcon','');
					$smarty->assign('sTransferIcon','');
					$smarty->assign('sDischargeInfoIcon','');
					$smarty->assign('sDischargeIcon','');

					$sAstart='';
					$sAend='';
					$sFamNameBuffer='';
					$sNameBuffer='';

					if($patients_ok){
						if(isset($patient[$i][$j])){
				 		}else{
				 			#continue;
				 			$is_patient=false;
							$bed=NULL;
						}
					}



					# set room nr change flag , toggle row color
					if($cflag!=$i){
						$toggle=!$toggle;
						$cflag=$i;
					}


					$retn = $mini_obj->GetEncounterFromPid($bed['pid']);

					if ($genInfo['encounter_nr']!=$retn) continue;

					# set row color/class

					if ($toggle){
						$smarty->assign('bToggleRowClass',TRUE);
					}else{
						$smarty->assign('bToggleRowClass',FALSE);
					}

					# Check if bed is locked
					if(stristr($room_info['closed_beds'],$j.'/')){
						$bed_locked=true;
						$lock_beds++;
						# Consider locked bed as occupied so increase occupied bed counter
						$occ_bed++;
					}else{
						$bed_locked=false;
					}

					# If patient and edit show small color bars
					if($is_patient&&$edit){
					 	$smarty->assign('sMiniColorBars','<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')">
					 		<img src="'.$root_path.'main/imgcreator/imgcreate_colorbar_small.php'.URL_APPEND.'&pn='.$bed['encounter_nr'].'" alt="'.$LDSetColorRider.'" align="absmiddle" border=0 width=80 height=18>
					 		</a>');
					}

					# If bed nr  is 1, show the room number

					$smarty->assign('sRoom',strtoupper($ward_info['roomprefix']).$i);

					$smarty->assign('sBed',strtoupper(chr($j+96)));

					# If patient, show images by sex
					if($is_patient){
						$sBuffer = '<a href="javascript:popPic(\''.$bed['pid'].'\')">';
						switch(strtolower($bed['sex'])){
							case 'f':
								$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spf.gif','0','',TRUE).'></a>');
								$females++;
								break;
							case 'm':
								$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'spm.gif','0','',TRUE).'></a>');
								$males++;
								break;
							default:
								$smarty->assign('sBedIcon',$sBuffer.'<img '.createComIcon($root_path,'bn.gif','0','',TRUE).'></a>');
						}

					}elseif($bed_locked){
						$smarty->assign('sBedIcon','<img '.createComIcon($root_path,'delete2.gif','0','',TRUE).'>');
					}
					elseif($edit){ // Else show the image link to assign bed to patient
						$smarty->assign('sBedIcon','<a href="javascript:indata(\''.$i.'\',\''.$j.'\')"><img '.createComIcon($root_path,'plus2.gif','0','',TRUE).' alt="'.$LDClk2Occupy.'"></a>');
					}

					# Show the patients name with link to open charts
					if($edit){

						$sAstart = '<a href="';
						if(!$bed_locked){
							$sAstart = $sAstart.$root_path.'modules/registration_admission/aufnahme_pass.php'.URL_APPEND.'&target=search&fwd_nr='.$bed['encounter_nr'].'" title="'.$LDClk2Show.'">';
						}else{
							$sAstart = $sAstart.'javascript:unlock(\''.strtoupper($j).'\',\''.$i.'\')" title="'.$LDInfoUnlock.'">'.$LDLocked; //$j=bed   $i=room number
						}
					}else{
						if($bed_locked){
							$smarty->assign('cComma','');
						}
					}

					if($is_patient&&($bed['encounter_nr']!="")){

						//$smarty->assign('sTitle',ucfirst($bed['title']));

						if(isset($sln)&&$sln) $sFamNameBuffer = eregi_replace($sln,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_last']));
							else $sFamNameBuffer = ucfirst($bed['name_last']);

						if($bed['name_last']) $smarty->assign('cComma',',');
							else $smarty->assign('cComma','');

						if(isset($sfn)&&$sfn) $sNameBuffer = eregi_replace($sfn,'<span style="background:yellow">'.ucfirst($sln).'</span>',ucfirst($bed['name_first']));
							else $sNameBuffer = ucfirst($bed['name_first']);

					}else{
						$smarty->assign('sFamilyName','');
						$smarty->assign('sName','');
						$smarty->assign('cComma','');
					}

					if($edit) $sAend ='</a>';
						else $sAend='';

					# Assign the family and first names together with the <a href></a> tags

					if($bed_locked){
						$smarty->assign('sFamilyName',$sFamilyName);
					}else{
						$smarty->assign('sFamilyName',$sFamNameBuffer);
						$smarty->assign('sName',$sNameBuffer);
					}

					if ($vct[9]==1){
						$kct = $multi_obj->CheckDiagnosis($bed['encounter_nr']);
						if (($kct<1)&&($bed['encounter_nr']!='')){
							$smarty->assign('sFlagDiag',' style="background-color:yellow !important; color:#000000;" ');
							$smarty->assign('sFlagDiag2',' style="background-color:gold !important; color:#000000;" ');
							$smarty->assign('sNoDiag',' [ No Dx ] ');
						} else {
								$smarty->assign('sFlagDiag','');
								$smarty->assign('sFlagDiag2',' ');
								$smarty->assign('sNoDiag','  ');
							}
					} else {
							$smarty->assign('sFlagDiag','');
							$smarty->assign('sFlagDiag2',' ');
							$smarty->assign('sNoDiag','  ');
						}

					# old code
					/*
					if($bed_locked){
						$smarty->assign('sFamilyName',$sAstart.$sAend);
					}else{
						$smarty->assign('sFamilyName',$sAstart.$sFamNameBuffer.$sAend);
						$smarty->assign('sName',$sAstart.$sNameBuffer.$sAend);
					}
					*/

					if($bed['date_birth']){

						if(isset($sg)&&$sg) $smarty->assign('sBirthDate',eregi_replace($sg,"<font color=#ff0000><b>".ucfirst($sg)."</b></font>",formatDate2Local($bed['date_birth'],$date_format)));
							else $smarty->assign('sBirthDate',formatDate2Local($bed['date_birth'],$date_format));
					}

					//if ($bed['encounter_nr']) $smarty->assign('sPatNr',$bed['encounter_nr']);

					if ($bed['encounter_nr'])
					{

						# Create encounter object
						require_once ($root_path . 'include/care_api_classes/class_encounter.php');
						$enc_obj = new Encounter ( $bed['encounter_nr'] );

						$enc_obj->loadEncounterData( $bed['encounter_nr'] );

						$pid = $enc_obj->SelianPID();

						$date = $enc_obj->EncounterDate();

						$dateArr = date_parse($date);

						$smarty->assign('sPatNr',$pid);

						$smarty->assign('sAdmDate',formatDate2Local($date,$date_format).' '.$dateArr['hour'].':'.$dateArr['minute']);

					}

					$insurance_name = '';
					if($bed['insurance_ID']) {

                        if($ins_obj->CheckCurrentContractValidity($bed['insurance_ID']))
                        $insurance_name = $ins_obj->GetName_insurance_from_id($bed['insurance_ID']);
                        $smarty->assign('sInsuranceType',substr($insurance_name,0,15));

                        }
                        else {
                        $smarty->assign('sInsuranceType',substr($insurance_name,0,15));
                        }

					$sBuffer = '';

					$kct = $multi_obj->CheckDiagnosis($bed['encounter_nr']);
					if (($vct[9]==1)&&($bed['encounter_nr']!='')){
						if ($kct<1){
							$smarty->assign('sFlagDiag',' style="background-color:yellow !important; color:#000000;" ');
							$smarty->assign('sFlagDiag2',' style="background-color:gold !important; color:#000000;" ');
							$smarty->assign('sNoDiag',' [ No Dx ] ');
							$nodischarge = 1;
						}
					}



				    #if($bed['insurance_class_nr']!=2) $sBuffer = $sBuffer.'<font color="#ff0000">';

					if($edit){
						if(($is_patient)&&!empty($bed['encounter_nr'])){

							$smarty->assign('sAdmitDataIcon','<a href="'.$root_path.'modules/registration_admission/aufnahme_pass.php'.URL_APPEND.'&target=search&fwd_nr='.$bed['encounter_nr'].'" title="'.$LDAdmissionData.' : '.$LDClk2Show.'"><img '.createComIcon($root_path,'pdata.gif','0','',TRUE).' alt="'.$LDAdmissionData.' : '.$LDClk2Show.'"></a>');

							$smarty->assign('sChartFolderIcon','<a href="javascript:getinfo(\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'open.gif','0','',TRUE).' align="absmiddle" alt="'.$LDShowPatData.'"></a>');

							$display = $multi_obj->has_notes($bed['encounter_nr']);

							$sBuffer = '<a href="javascript:getrem(\''.$bed['encounter_nr'].'\')"><img ';
							if($display>0) $sBuffer = $sBuffer.createComIcon($root_path,'bubble3.gif','0','',TRUE);
								else $sBuffer = $sBuffer.createComIcon($root_path,'bubble2.gif','0','',TRUE);
							$sBuffer = $sBuffer.' align="absmiddle" alt="'.$LDNoticeRW.'"></a>';

							$smarty->assign('sNotesIcon',$sBuffer);

							$smarty->assign('sTransferIcon','<a style="display:none;" href="javascript:Transfer(\''.$bed['encounter_nr'].'\')"><img '.createComIcon($root_path,'xchange.gif','0','',TRUE).' align="absmiddle" alt="'.$LDTransferPatient.'"></a>');

						        $smarty->assign('sDischargeInfoIcon','<a href="javascript:release_info(\''.$bed['encounter_nr'].'\')" title="show info"><img '.createComIcon($root_path,'button_info.gif','0','',TRUE).' align="absmiddle" alt="show info"></a>');

							$smarty->assign('sDischargeIcon','<a href="javascript:void(0);" onclick="'.((($vct[11]==1)&&($kct==0))?'alert(\'This Patient has no Diagnosis \n You can not Discharge.\')':'release(\''.$bed['room_nr'].'\',\''.$bed['bed_nr'].'\',\''.$bed['encounter_nr'].'\')').'"><img '.createComIcon($root_path,'bestell.gif','0','',TRUE).' align="absmiddle" alt="'.$LDReleasePatient.'"></a>');
						}
					}

					# Create the rows using ward_occupancy_list_row.tpl template^
					ob_start();
						$smarty->display('nursing/ward_occupancy_list_row.tpl');
						$sListRows = $sListRows.ob_get_contents();
					ob_end_clean();

				} // end of bed loop

				# Append the new row to the previous row in string

				$smarty->assign('sOccListRows',$sListRows);

			//} # for loop
		#} // end of ward loop
	}


	# Final occupancy list line

	# Prepare the stations quick info data
	# Occupancy in percent
	$occ_percent=ceil(($occ_beds/$nr_beds)*100);
	# Nr of vacant beds
	$vac_beds=$nr_beds-$occ_beds;

	# Declare template items
	$TP_DOC1_BLOCK='';
	$TP_DOC2_BLOCK='';
	$TP_ICON1='';
	$TP_ICON2='';
	$TP_Legend1_BLOCK='';

	//$buf1='<img '.createComIcon($root_path,'powdot.gif','0','absmiddle').'>';
	# Create waiting list block

	if($waitlist_count&&$edit){
		while($waitpatient=$waitlist->FetchRow()){

			$buf2='';
			//if($waitpatient['current_ward_nr']!=$ward_nr) $buf2='<nobr>'.$waitpatient['ward_id'].'::';
			if($waitpatient['current_ward_nr']!=$ward_nr) $buf2=createComIcon($root_path,'red_dot.gif','0','',TRUE);
				else  $buf2=createComIcon($root_path,'green_dot.gif','0','',TRUE);
			$TP_WLIST_BLOCK.='<nobr><img '.$buf2.'><a href="javascript:assignWaiting(\''.$waitpatient['encounter_nr'].'\',\''.$waitpatient['ward_id'].'\')">';
			$TP_WLIST_BLOCK.='&nbsp;'.$waitpatient['name_last'].', '.$waitpatient['name_first'].' '.formatDate2Local($waitpatient['date_birth'],$date_format).'</nobr></a><br>';
		}
	}else{
		$TP_WLIST_BLOCK='&nbsp;';
	}
	if($edit){
		$wlist_url=$thisfile.URL_APPEND.'&ward_nr='.$ward_nr.'&edit='.$edit.'&station='.$station;
		if($w_waitlist){
			$TP_WLIST_OPT =	'[<a href="'.$wlist_url.'&w_waitlist=0">'.$LDShowWardOnly.'</a>]';
		}else{
			$TP_WLIST_OPT=	'<!--[<a href="'.$wlist_url.'&w_waitlist=1">'.$LDShowAll.'</a>]-->';
		}
	}
	# Create doctors-on-duty block
	if(isset($person1)){
		$TP_DOC1_BLOCK='<a href="javascript:popinfo(\''.$pnr1.'\',\''.$dept_nr.'\')" title="'.$LDClk4Phone.'">'.$person1['name_last'].', '.$person1['name_first'].'</a>';
		$TP_ICON1='<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'>';
	}
	if(isset($person2)){
		$TP_DOC2_BLOCK='<a href="javascript:popinfo(\''.$pnr2.'\',\''.$dept_nr.'\')" title="'.$LDClk4Phone.'">'.$person2['name_last'].', '.$person2['name_first'].'</a>';
		$TP_ICON2=$TP_ICON1;
	}

	# Create the legend block
	$TP_Legend1_BLOCK.='
	&nbsp;<img '.createComIcon($root_path,'green_dot.gif','0','absmiddle',TRUE).'>&nbsp;<b>'.$LDOwnPatient.'</b><br>
	&nbsp;<img '.createComIcon($root_path,'red_dot.gif','0','absmiddle',TRUE).'> <b>'.$LDNonOwnPatient.'</b><br>
	&nbsp;<img '.createComIcon($root_path,'plus2.gif','0','absmiddle',TRUE).'> <b>'.$LDFreeOccupy.'</b><br>
	&nbsp;<img '.createComIcon($root_path,'delete2.gif','0','absmiddle',TRUE).'> <b>'.$LDLocked.'</b><br>
	';

	if($edit&&$patients_ok){
		$TP_Legend1_BLOCK.= '&nbsp;<img '.createComIcon($root_path,'pdata.gif','0','absmiddle',TRUE).'> <b>'.$LDAdmissionData.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'open.gif','0','absmiddle',TRUE).'> <b>'.$LDOpenFile.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'bubble2.gif','0','absmiddle',TRUE).'> <b>'.$LDNotesEmpty.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'bubble3.gif','0','absmiddle',TRUE).'> <b>'.$LDNotes.'</b><br>
		&nbsp;<nobr><img '.createComIcon($root_path,'xchange.gif','0','absmiddle',TRUE).'> <b>'.$LDTransferPatient.'</b></nobr><br>
		&nbsp;<img '.createComIcon($root_path,'bestell.gif','0','absmiddle',TRUE).'> <b>'.$LDRelease.'</b><br>
		';

		$TP_Legend2_BLOCK= '
		&nbsp;<img '.createComIcon($root_path,'spf.gif','0','absmiddle',TRUE).'> <b>'.$LDFemale.'</b><br>
		&nbsp;<img '.createComIcon($root_path,'spm.gif','0','absmiddle',TRUE).'> <b>'.$LDMale.'</b><br>';
	}
	# Load the quick info block template
	$tp=$TP_obj->load('nursing/tp_ward_quickinfo.htm');

	# Buffer orig template output
	ob_start();
		eval("echo $tp;");
		$sTemp = ob_get_contents();
	ob_end_clean();
	 # Assign to page template object
	$smarty->assign('sSubMenuBlock',$sTemp);

}else{

	$smarty->assign('sNewWardLink','<ul><div class="prompt"><img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>
			'.str_replace("~station~",strtoupper($station),$LDNoInit).'</b></font><br>
			<a href="nursing-station-new.php'.URL_APPEND.'&station='.$station.'&edit='.$edit.'">'.$LDIfInit.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','',TRUE).'></a><p>
			</div></ul>');
} // end of if ward_ok

if($pday.$pmonth.$pyear<>date('dmY'))

	$smarty->assign('sToArchiveLink','<p>
			<a href="nursing-station-archiv.php'.URL_APPEND.'">'.$LDClk2Archive.' <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','',TRUE).'></a>
			<p>');

$stationName = $ward_info['name'];

$smarty->assign('pDiagnosis', '<!--<a href=nursing-station-diagnosis-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDShowDiagnosis.'</a>');

$smarty->assign('pLabs', '<a href=nursing-station-laboratory-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDShowLabs.'</a>');

$smarty->assign('pPrescriptions', '<a href=nursing-station-pharmacy-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDShowPrescr.'</a>');

$smarty->assign('pProcedures', '<a href=nursing-station-procedures-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDProcedures.'</a>');

$smarty->assign('pConsumables', '<a href=nursing-station-consumables-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDConsumables.'</a>');

$smarty->assign('pRadio', '<a href=nursing-station-radiology-list.php'.URL_APPEND.'&station='.urlencode($stationName).'&ward_nr='.$ward_nr.'>'.$LDShowRadio.'</a>');

$smarty->assign('pbClose','--><a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp');

if(!$edit){
	$smarty->assign('sOpenWardMngmt','<a href="nursing-station-pass.php'.URL_APPEND.'&edit=1&rt=pflege&ward_nr='.$ward_nr.'&station='.$ward_info['name'].'"><img '.createComIcon($root_path,'uparrowgrnlrg.gif','0','absmiddle',TRUE).'> '.$LDOpenWardManagement.'</a>');
}


# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','nursing/ward_occupancy.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
