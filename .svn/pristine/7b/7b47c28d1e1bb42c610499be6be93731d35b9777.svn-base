<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
//error_reporting(E_ALL);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org,
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='departments.php';
$lang_tables[]='prompt.php';
$lang_tables[]='help.php';
$lang_tables[]='person.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');

/* If patient nr is invallid jump to registration search module*/
/*if(!isset($pid) || !$pid)
{
	header('Location:patient_register_search.php'.URL_APPEND.'&origin=admit');
	exit;
}
*/
//require_once($root_path.'include/inc_config_color.php');
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_person.php');
require_once($root_path.'include/care_api_classes/class_insurance.php');
//require_once($root_path.'include/care_api_classes/class_core.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_weberp_c2x.php');
require_once($root_path.'include/inc_init_xmlrpc.php');

$thisfile=basename($_SERVER['PHP_SELF']);
if($origin=='patreg_reg') $breakfile = 'patient_register_show.php'.URL_APPEND.'&pid='.$pid;
	elseif($_COOKIE["ck_login_logged".$sid]) $breakfile = $root_path.'modules/news/start_page.php'.URL_APPEND;
		elseif(!empty($_SESSION['sess_path_referer'])) $breakfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND.'&pid='.$pid;
			else $breakfile = "aufnahme_pass.php".URL_APPEND."&target=entry";

$newdata=1;

if(isset($transFromOutp)) {
$encounter_nr = $_GET['pn'];
}

/* Default path for fotos. Make sure that this directory exists! */
$default_photo_path=$root_path.'fotos/registration';
$photo_filename='nopic';
$error=0;

if(!isset($pid)) $pid=0;
if(!isset($encounter_nr)) $encounter_nr=0;
if(!isset($mode)) $mode='';
if(!isset($forcesave)) $forcesave=0;
if(!isset($update)) $update=0;

if(!isset($_SESSION['sess_pid'])) $_SESSION['sess_pid']="";
if(!isset($_SESSION['sess_full_pid'])) $_SESSION['sess_full_pid']="";
if(!isset($_SESSION['sess_en'])) $_SESSION['sess_en']="";
if(!isset($_SESSION['sess_full_en'])) $_SESSION['sess_full_en']="";

$patregtable='care_person';  // The table of the patient registration data

$dbtable='care_encounter'; // The table of admission data

/* Create new person's insurance object */
$pinsure_obj=new PersonInsurance($pid);
/* Get the insurance classes */
$insurance_classes=&$pinsure_obj->getInsuranceClassInfoObject('class_nr,name,LD_var AS "LD_var"');

/* Create new person object */
$person_obj=new Person($pid);
/* Create encounter object */
$encounter_obj=new Encounter($encounter_nr);
/* Create a new billing object */
$bill_obj = new Bill;
/* Get all encounter classes */
$encounter_classes=$encounter_obj->AllEncounterClassesObject();

if($pid!='' || $encounter_nr!=''){

	   	/* Get the patient global configs */
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');
        $glob_obj->getConfig('person_foto_path');
        $glob_obj->getConfig('encounter_%');

		if(!$GLOBAL_CONFIG['patient_service_care_hide']){
			/* Get the care service classes*/
			$care_service=$encounter_obj->AllCareServiceClassesObject();
		}
		if(!$GLOBAL_CONFIG['patient_service_room_hide']){
			/* Get the room service classes */
			$room_service=$encounter_obj->AllRoomServiceClassesObject();
		}
		if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
			/* Get the attending doctor service classes */
			$att_dr_service=$encounter_obj->AllAttDrServiceClassesObject();
		}

        /* Check whether config path exists, else use default path */
        $photo_path = (is_dir($root_path.$GLOBAL_CONFIG['person_foto_path'])) ? $GLOBAL_CONFIG['person_foto_path'] : $default_photo_path;

        if ($pid)
        {
        	if (isset($transFromOutp))
         	{
						//echo 'transFrom Outpatient';


						if($encoder=='') $encoder=$_SESSION['sess_user_name'];
						# Load date formatter

						require_once($root_path.'include/care_api_classes/class_encounter.php');

						$enc_obj=new Encounter;

						$pn = $_GET['pn'];

						//echo 'Encounter: '.$pn;

						//$encounter_obj->sql="UPDATE care_encounter SET encounter_nr_prev=$pn where encounter_nr=$pn";
						//
						//$encounter_obj->Transact($encounter_obj->sql);

						if($encounter_obj->loadEncounterData($pn)){
							//$db->debug=1;

							$date=(empty($x_date))?date('Y-m-d'):formatDate2STD($x_date,$date_format);
							$time=(empty($x_time))?date('H:i:s'):convertTimeToStandard($x_time);
							# Check the discharge type

							if($mode == 'save')
							{
					 			if( $enc_obj->DischargeFromDeptForAdmission($pn,8,$date,$time)){
									//echo 'discharge has been successfull';
					 			}
					 				else echo 'couldn\'t discharge outpatient';
							}
							
						}else echo 'could not load encounter data';
          	}else{

		  	/* Check whether the person is currently admitted. If yes jump to display admission data */
		  	if(!$update&&$encounter_nr=$encounter_obj->isPIDCurrentlyAdmitted($pid)){
		    	  header('Location:aufnahme_daten_zeigen.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$encounter_nr.'&origin=admit&sem=isadmitted&target=entry');
			exit;
		  	}

          }

			 /* Get the related insurance data */
			 $p_insurance=&$pinsure_obj->getPersonInsuranceObject($pid);
			 if($p_insurance==false) {
				$insurance_show=true;
			 } else {
				if(!$p_insurance->RecordCount()) {
				    $insurance_show=true;
				} elseif ($p_insurance->RecordCount()==1){
				    $buffer= $p_insurance->FetchRow();
					extract($buffer);
				    $insurance_show=true;
				    $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);
				} else { $insurance_show=false;}
			 }


            if (($mode=='save') || ($forcesave!=''))
            {
            	 if(!$forcesave)
	             {
	                  //clean and check input data variables
					  /**
					  *  $error = 1 will cause to show the "save anyway" override button to save the incomplete data
					  *  $error = 2 will cause to force the user to enter a data in an input element (no override allowed)
					  */

	                  $encoder=trim($encoder);
					  if($encoder=='') $encoder=$_SESSION['sess_user_name'];

					  /*if ($referrer_notes=='') { $errorbesonder=1; $error=1; $errornum++;};

	                  $encounter_class_nr=trim($encounter_class_nr);

					  if ($encounter_class_nr=='') { $errorstatus=1; $error=1; $errornum++;};

			          if($insurance_show) {
                          if(trim($insurance_nr) &&  trim($insurance_firm_name)=='') { $error_ins_co=1; $error=1; $errornum++;}
		              }
	           */   }




                 if(!$error)
	             {

		             	if($is_transmit_to_weberp_enable == 1)
		             	{
							$persondata = $person_obj->getAllInfoArray();
		             		$weberp_obj = new_weberp();
							if(!$weberp_obj->transfer_patient_to_webERP_asCustomer($pid,$persondata))
							{
								$person_obj->setPatientIsTransmit2ERP($pid,0);
							}
							else
							{
								$person_obj->setPatientIsTransmit2ERP($pid,1);
							}
							destroy_weberp($weberp_obj);

		             	}

						if(!$GLOBAL_CONFIG['patient_service_care_hide']){
						    if(!empty($sc_care_start)) $sc_care_start=formatDate2Std($sc_care_start,$date_format);
						    if(!empty($sc_care_end)) $sc_care_end=formatDate2Std($sc_care_end,$date_format);
						    $care_class=compact('sc_care_nr','sc_care_class_nr', 'sc_care_start', 'sc_care_end','encoder');
						}
						if(!$GLOBAL_CONFIG['patient_service_room_hide']){
						    if(!empty($sc_room_start)) $sc_room_start=formatDate2Std($sc_room_start,$date_format);
						    if(!empty($sc_room_end)) $sc_room_end=formatDate2Std($sc_room_end,$date_format);
						    $room_class=compact('sc_room_nr','sc_room_class_nr', 'sc_room_start', 'sc_room_end','encoder');
						}
						if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
						    if(!empty($sc_att_dr_start)) $sc_att_dr_start=formatDate2Std($sc_att_dr_start,$date_format);
						    if(!empty($sc_att_dr_end)) $sc_att_dr_end=formatDate2Std($sc_att_dr_end,$date_format);
						    $att_dr_class=compact('sc_att_dr_nr','sc_att_dr_class_nr','sc_att_dr_start', 'sc_att_dr_end','encoder');
						}

				      if($update || $encounter_nr)
					  {
							//echo formatDate2STD($geburtsdatum,$date_format);
					      $itemno=$itemname;
									$_POST['modify_id']=$encoder;
									if($dbtype=='mysql' || $dbtype=='mysqli'){
										$_POST['history']= "CONCAT(history,\"\n Update: ".date('Y-m-d H:i:s')." = $encoder\")";
									}else{
										$_POST['history']= "(history || '\n Update: ".date('Y-m-d H:i:s')." = $encoder')";
									}
									if(isset($_POST['encounter_nr'])) unset($_POST['encounter_nr']);
									if(isset($_POST['pid'])) unset($_POST['pid']);

									$encounter_obj->setDataArray($_POST);

									if($encounter_obj->updateEncounterFromInternalArray($encounter_nr))
									{
									    /* Save the service classes */
									    if(!$GLOBAL_CONFIG['patient_service_care_hide']){
										    $encounter_obj->updateCareServiceClass($care_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_room_hide']){
										    $encounter_obj->updateRoomServiceClass($room_class);
										}
									    if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
										    $encounter_obj->updateAttDrServiceClass($att_dr_class);
										}
										
										$type_r="R";
										$type_a="A";
										$type_c="C";
										
										if($registration_fee!='')
											$bill_obj->disable_reg($encounter_nr,$type_r,$registration_fee);
											
										if($ambulance_fee!='')
											$bill_obj->disable_reg($encounter_nr,$type_a,$ambulance_fee);

										if($consultation_fee!='')
											$bill_obj->disable_reg($encounter_nr,$type_c,$consultation_fee);

											
									    if($registration_fee!='')
											$bill_obj->new_reg($encounter_nr,$registration_fee,$user);
											
										if($ambulance_fee!='')
											$bill_obj->new_reg($encounter_nr,$ambulance_fee,$user);

									    if($consultation_fee!='')
									    	$bill_obj->new_reg($encounter_nr,$consultation_fee,$user);

							            header("location: aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&origin=admit&target=entry&newdata=$newdata");
								        exit;
								    }

					  }else{

					  	    $newdata=1;
							/* Determine the format of the encounter number */
							if($GLOBAL_CONFIG['encounter_nr_fullyear_prepend']) $ref_nr=(int)date('Y').$GLOBAL_CONFIG['encounter_nr_init'];
								else $ref_nr=$GLOBAL_CONFIG['encounter_nr_init'];
							//echo $ref_nr;
							switch($_POST['encounter_class_nr'])
							{
								case '1': $_POST['encounter_nr']=$encounter_obj->getNewEncounterNr($ref_nr+$GLOBAL_CONFIG['patient_inpatient_nr_adder'],1);
											break;
								case '2': $_POST['encounter_nr']=$encounter_obj->getNewEncounterNr($ref_nr+$GLOBAL_CONFIG['patient_outpatient_nr_adder'],2);


							}

									$_POST['encounter_date']=date('Y-m-d H:i:s');
									$_POST['modify_id']=$encoder;
									//$_POST['modify_time']='NULL';
									$_POST['create_id']=$encoder;
									$_POST['create_time']=date('YmdHis');
									$_POST['history']='Create: '.date('Y-m-d H:i:s').' = '.$encoder;
									if(isset($_POST['encounter_nr'])) unset($_POST['encounter_nr']);
									//print_r($_POST);
									$encounter_obj->setDataArray($_POST);




									if($encounter_obj->insertDataFromInternalArray()) {
									    /* Get last insert id */
										if($dbtype=='mysql' || $dbtype=='mysqli') {
											$encounter_nr=$db->Insert_ID();
										}else{
											$encounter_nr=$encounter_obj->postgre_Insert_ID($dbtable,'encounter_nr',$db->Insert_ID());
										} // end of if($dbtype=='mysql')

										if($is_transmit_to_weberp_enable == 1)
		             					{
//											$weberp_obj = new weberp($webERPServerURL,$weberpuser,$weberppassword,$weberpDebugLevel);
//											$weberp_obj->make_patient_workorder_in_webERP($encounter_nr);
		             					}

										$encounter_obj->assignInDept($encounter_nr,$current_dept_nr,$current_dept_nr);

										# If appointment number available, mark appointment as "done"
										if(isset($appt_nr)&&$appt_nr)
											$encounter_obj->markAppointmentDone($appt_nr,$_POST['encounter_class_nr'],$encounter_nr);

										//echo $encounter_obj->getLastQuery();

										// Add to table presciptions the registration fee's comming from admission seciton...
										
											
										if($registration_fee!='')
											$bill_obj->new_reg($encounter_nr,$registration_fee,$user);
											
										if($ambulance_fee!='')
											$bill_obj->new_reg($encounter_nr,$ambulance_fee,$user);

									    if($consultation_fee!='')
									    	$bill_obj->new_reg($encounter_nr,$consultation_fee,$user);


									    if (isset($transFromOutp))
          								{
											global $pn;
											$enc_new = $_POST['encounter_nr'];
											$encounter_obj->sql_="UPDATE care_encounter SET encounter_nr_prev='$pn' where encounter_nr='$enc_new'";
											//$encounter_obj->sql_old="UPDATE care_encounter SET is_discharged='1', discharge_date='$date', discharge_time='$time' where encounter_nr='$pn'";
											//echo $encounter_obj->sql_;
						//if ($encounter_obj->Transact($encounter_obj->sql_)&&$encounter_obj->Transact($encounter_obj->sql_old))

											if ($encounter_obj->Transact($encounter_obj->sql_))
											{
												//echo 'transact erfolgreich';
												echo '<script language="javascript">';
												echo 'function closeWindow(){';
												echo 'window.close();';
												echo '}';
												echo 'closeWindow();';
												echo '</script>';
											}
											else {
												echo 'problem occured at aufnahme_start.php: '.$encounter_obj->sql_.' and/or '.$encounter_obj->sql_old;
											}

          							}

							            // Show the admission data:
							            header("location: aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&origin=admit&target=entry&newdata=$newdata");
								        exit;
								    }else{
										echo $LDDbNoSave.'<p>'.$encounter_obj->getLastQuery();
									}

					 }// end of if(update) else()
                  }	// end of if($error)
             } // end of if($mode)

        }elseif($encounter_nr!='') {
			  /* Load encounter data */
			  $encounter_obj->loadEncounterData();
			  if($encounter_obj->is_loaded) {
		          $zeile=&$encounter_obj->encounter;
					//load data
				  extract($zeile);

                  // Get insurance firm name
			      $insurance_firm_name=$pinsure_obj->getFirmName($insurance_firm_id);

			  /* GEt the patient's services classes */

			  if(!empty($GLOBAL_CONFIG['patient_financial_class_single_result'])) $encounter_obj->setSingleResult(true);

				if(!$GLOBAL_CONFIG['patient_service_care_hide']){
                	if($buff=&$encounter_obj->CareServiceClass()){
					    while($care_class=$buff->FetchRow()){
							extract($care_class);
						}
						reset($care_class);
					}
				}
				if(!$GLOBAL_CONFIG['patient_service_room_hide']){
                	if($buff=&$encounter_obj->RoomServiceClass()){
					    while($room_class=$buff->FetchRow()){
							extract($room_class);
						}
						reset($room_class);
					}
				}
				if(!$GLOBAL_CONFIG['patient_service_att_dr_hide']){
                	if($buff=&$encounter_obj->AttDrServiceClass()){
					    while($att_dr_class=$buff->FetchRow()){
							extract($att_dr_class);
						}
						reset($att_dr_class);
					}
				}
        	}

		}

    if(!$encounter_nr||$encounter_class_nr==1){
		# Load all  wards info
		$ward_obj=new Ward;
		$items='nr,name';
		$ward_info=&$ward_obj->getAllWardsItemsObject($items);
	}
	if(!$encounter_nr||$encounter_class_nr==2){
		# Load all medical departments
		include_once($root_path.'include/care_api_classes/class_department.php');
		$dept_obj=new Department;
		$all_meds=&$dept_obj->getAllMedicalObject();

	}

	$person_obj->setPID($pid);
	if($data=&$person_obj->BasicDataArray($pid)){
		//while(list($x,$v)=each($data))	$$x=$v;
		extract($data);
	}

	# Prepare the photo filename
	include_once($root_path.'include/inc_photo_filename_resolve.php');
	/* Get the citytown name */
	$addr_citytown_name=$person_obj->CityTownName($addr_citytown_nr);

}
# Prepare text and resolve the numbers
include_once($root_path.'include/inc_patient_encounter_type.php');

# Prepare the title
if($encounter_nr) $headframe_title = "$headframe_title $headframe_append ";

# Prepare onLoad JS code
if(!$encounter_nr && !$pid) $sOnLoadJs ='onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();"';


# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in the toolbar
 $smarty->assign('sToolbarTitle',$headframe_title);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('','')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$headframe_title);

 # Onload Javascript code
 $smarty->assign('sOnLoadJs',$sOnLoadJs);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('registration_overview.php','Person Registration :: Overview')");

 # Hide the return button
 $smarty->assign('pbBack',FALSE);


 # Start collectiong extra Javascript code
 ob_start();

# If  pid exists, output the form checker javascript
if(isset($pid) && $pid){

?>

<script  language="javascript">
<!--

function chkform(d) {
	encr=<?php if ($encounter_class_nr) {echo $encounter_class_nr; } else {echo '0';} ?>;
	if(d.encounter_class_nr[0]&&d.encounter_class_nr[1]&&!d.encounter_class_nr[0].checked&&!d.encounter_class_nr[1].checked){
		alert("<?php echo $LDPlsSelectAdmissionType; ?>");
		return false;
	}else if(d.encounter_class_nr[0]&&d.encounter_class_nr[0].checked&&!d.current_ward_nr.value){
		alert("<?php echo $LDPlsSelectWard; ?>");
		d.current_ward_nr.focus();
		return false;
	}else if(d.encounter_class_nr[1]&&d.encounter_class_nr[1].checked&&!d.current_dept_nr.value){
		alert("<?php echo $LDPlsSelectDept; ?>");
		d.current_dept_nr.focus();
		return false;
	}else if(!d.encounter_class_nr[0]&&encr==1&&!d.current_ward_nr.value){
		alert("<?php echo $LDPlsSelectWard; ?>");
		d.current_ward_nr.focus();
		return false;
	}else if(!d.encounter_class_nr[1]&&encr==2&&!d.current_dept_nr.value){
		alert("<?php echo $LDPlsSelectDept; ?>");
		d.current_dept_nr.focus();
		return false;
	}else if(d.encoder.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.encoder.focus();
		return false;
	}else{
		return true;
	}
}
function resolveLoc(){
	d=document.aufnahmeform;
	if(d.encounter_class_nr[0].checked==true) d.current_dept_nr.selectedIndex=0;
		else d.current_ward_nr.selectedIndex=0;
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php

} // End of if(isset(pid))

require('./include/js_popsearchwindow.inc.php');

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Load tabs
$target='search';

$parent_admit = TRUE;

include('./gui_bridge/default/gui_tabs_patadmit.php');

# If the origin is admission link, show the search prompt
if(!isset($pid) || !$pid){

	# Set color values for the search mask
	$searchmask_bgcolor="#f3f3f3";
	$searchprompt=$LDEntryPrompt;
	$entry_block_bgcolor='#fff3f3';
	$entry_body_bgcolor='#ffffff';

	$smarty->assign('entry_border_bgcolor','#6666ee');

	$smarty->assign('sSearchPromptImg','<img '.createComIcon($root_path,'angle_down_l.gif','0','',TRUE).'>');

	$smarty->assign('LDPlsSelectPatientFirst',$LDPlsSelectPatientFirst);
	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_l.gif','0','absmiddle').'>');

	# Start buffering the searchmask

	ob_start();

	$search_script='patient_register_search.php';
	$user_origin='admit';
	include($root_path.'include/inc_patient_searchmask.php');

	$sTemp = ob_get_contents();

	ob_end_clean();

	$smarty->assign('sSearchMask',$sTemp);
	$smarty->assign('sWarnIcon','<img '.createComIcon($root_path,'warn.gif','0','absmiddle',TRUE).'>');
	$smarty->assign('LDRedirectToRegistry',$LDRedirectToRegistry);

}else{

	$smarty->assign('bSetAsForm',TRUE);

	if($error){
		$smarty->assign('error',TRUE);
		$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').' align="absmiddle">');

		 if ($errornum>1) $smarty->assign('LDError',$LDErrorS);
		 	else 	$smarty->assign('LDError',$LDError);
	}

	$smarty->assign('LDCaseNr',$LDCaseNr);
	if(isset($encounter_nr)&&$encounter_nr) 	$smarty->assign('encounter_nr',$encounter_nr);
		else  $smarty->assign('encounter_nr','<font color="red">'.$LDNotYetAdmitted.'</font>');

	$smarty->assign('img_source',"<img $img_source>");

	$smarty->assign('LDAdmitDate',$LDAdmitDate);

	$smarty->assign('sAdmitDate',@formatDate2Local(date('Y-m-d'),$date_format));

	$smarty->assign('LDAdmitTime',$LDAdmitTime);

	$smarty->assign('sAdmitTime',@convertTimeToLocal(date('H:i:s')));

	$smarty->assign('LDTitle',$LDTitle);
	$smarty->assign('title',$title);
	$smarty->assign('LDLastName',$LDLastName);
	$smarty->assign('name_last',$name_last);
	$smarty->assign('LDFirstName',$LDFirstName);
	$smarty->assign('name_first',$name_first);

	# Set a row span counter, initialize with 6
	$iRowSpan = 6;

	if($GLOBAL_CONFIG['patient_name_2_show']&&$name_2){
		$smarty->assign('LDName2',$LDName2);
		$smarty->assign('name_2',$name_2);
		$iRowSpan++;
	}

	if($GLOBAL_CONFIG['patient_name_3_show']&&$name_3){
		$smarty->assign('LDName3',$LDName3);
		$smarty->assign('name_3',$name_3.'xxx');
		$iRowSpan++;
	}

	if($GLOBAL_CONFIG['patient_name_middle_show']&&$name_middle){
		$smarty->assign('LDNameMid',$LDNameMid);
		$smarty->assign('name_middle',$name_middle);
		$iRowSpan++;
	}
		$smarty->assign('sRowSpan',"rowspan=\"$iRowSpan\"");

		$smarty->assign('LDBday',$LDBday);
		$smarty->assign('sBdayDate',@formatDate2Local($date_birth,$date_format));

		$smarty->assign('LDSex',$LDSex);
		if($sex=='m') $smarty->assign('sSexType',$LDMale);
			elseif($sex=='f') $smarty->assign('sSexType',$LDFemale);

		$smarty->assign('LDBloodGroup',$LDBloodGroup);
		if($blood_group){
				$buf='LD'.$blood_group;
			$smarty->assign('blood_group',$$buf);
		}

		$smarty->assign('LDAddress',$LDAddress);

		$smarty->assign('addr_str',$addr_str);
		$smarty->assign('addr_str_nr',$addr_str_nr);
		$smarty->assign('addr_zip',$addr_zip);
		$smarty->assign('addr_citytown',$addr_citytown_name);

		$smarty->assign('LDAdmitClass',$LDAdmitClass);


			if(is_object($encounter_classes)){
				$sTemp = '';
				while($result=$encounter_classes->FetchRow()) {
					$LD=$result['LD_var'];
					//if($in_ward && ($encounter_class_nr==$result['class_nr'])){ # If in ward, freeze encounter class
					if($encounter_nr ){ # If admitted, freeze encounter class
						if ($encounter_class_nr==$result['class_nr']){
							if(isset($$LD)&&!empty($$LD)) $sTemp = $sTemp.$$LD;
								else $sTemp = $sTemp.$result['name'];
							$sTemp = $sTemp.'<input name="encounter_class_nr" type="hidden"  value="'.$encounter_class_nr.'">';
							break;
						}
					}else{
						//old code:

//						$sTemp = $sTemp.'<input name="encounter_class_nr" onClick="resolveLoc()" type="radio"  value="'.$result['class_nr'].'" ';
//						if($encounter_class_nr==$result['class_nr']) $sTemp = $sTemp.'checked';
//						$sTemp = $sTemp.'>';
//
//						if(isset($$LD)&&!empty($$LD)) $sTemp = $sTemp.$$LD;
//							else $sTemp = $sTemp.$result['name'];


						//new code:

						if($encounter_class_nr==$result['class_nr']) {
							$sTemp = $sTemp.'<input name="encounter_class_nr"  type="hidden"  value="'.$result['class_nr'].'" ';
							$sTemp = $sTemp.'>';
						}


					}
				}

				if ($encounter_class_nr==1)
							$sTemp .= $LDStationary;
						else if ($encounter_class_nr==2)
								$sTemp .= $LDAmbulant;

				$smarty->assign('sAdmitClassInput',$sTemp);

			}



			# If no encounter nr or inpatient, show ward/station info, 1 = inpatient
			if($encounter_class_nr==1){
				if ($errorward||$encounter_class_nr==1){ $smarty->assign('LDWard',"<font color=red>$LDWard</font>");}
					$smarty->assign('LDWard',$LDWard);
				$sTemp = '';
				if($in_ward){

					while($station=$ward_info->FetchRow()){
						if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])){
							$sTemp = $sTemp.$station['name'];
							$sTemp = $sTemp.'<input name="current_ward_nr" type="hidden"  value="'.$current_ward_nr.'">';
							break;
						}
					}
				}else{
					$sTemp = $sTemp.'<select name="current_ward_nr">
								<option value=""></option>';
					if(!empty($ward_info)&&$ward_info->RecordCount()){
						while($station=$ward_info->FetchRow()){
							$sTemp = $sTemp.'
								<option value="'.$station['nr'].'" ';
							if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) $sTemp = $sTemp.'selected';
							$sTemp = $sTemp.'>'.$station['name'].'</option>';
						}
					}
					$sTemp = $sTemp.'</select>
							<font size=1><img '.createComIcon($root_path,'redpfeil_l.gif','0','',TRUE).'> '.$LDForInpatient.'</font>';
				}
				//old code:
				//$smarty->assign('sWardInput',$sTemp);

				//new code:
				if ($encounter_class_nr==1)$smarty->assign('sWardInput',$sTemp);
			} //  End of if no encounter nr

			# If no encounter nr or outpatient, show clinic/department info, 2 = outpatient
			$sTemp = $sTemp.'<input name="current_dept_nr" type="hidden"  value="'.$current_dept_nr.'">';
			if($encounter_class_nr==2){

				if ($errorward||$encounter_class_nr==2) $smarty->assign('LDDepartment',"<font color=red>$LDClinic/$LDDepartment</font>");
					else $smarty->assign('LDDepartment',"$LDClinic/$LDDepartment");
				$sTemp = '';
				if($in_dept){
					while($deptrow=$all_meds->FetchRow()){
						if(isset($current_dept_nr)&&($current_dept_nr==$deptrow['nr'])){
							$sTemp = $sTemp.$deptrow['name_formal'];
							$sTemp = $sTemp.'<input name="current_dept_nr" type="hidden"  value="'.$current_dept_nr.'">';
							break;
						}
					}
				}else{
					$sTemp = $sTemp.'<select name="current_dept_nr">
							<option value=""></option>';

					if(is_object($all_meds)){
						while($deptrow=$all_meds->FetchRow()){
							$sTemp = $sTemp.'
								<option value="'.$deptrow['nr'].'" ';
							if(isset($current_dept_nr)&&($current_dept_nr==$deptrow['nr'])) $sTemp = $sTemp.'selected';
							$sTemp = $sTemp.'>';
							if($$deptrow['LD_var']!='') $sTemp = $sTemp.$$deptrow['LD_var'];
								else $sTemp = $sTemp.$deptrow['name_formal'];
									$sTemp = $sTemp.'</option>';
						}
					}
					$sTemp = $sTemp.'</select><font size=1><img '.createComIcon($root_path,'redpfeil_l.gif','0','',TRUE).'> '.$LDForOutpatient.'</font>';
				}
				//old code:
				//$smarty->assign('sDeptInput',$sTemp);

				//new code:
				if ($encounter_class_nr==2)$smarty->assign('sDeptInput',$sTemp);

			} // End of if no encounter nr

			$smarty->assign('LDDiagnosis',$LDDiagnosis);
			$smarty->assign('referrer_diagnosis','<input name="referrer_diagnosis" type="text" size="60" value="'.$referrer_diagnosis.'">');

			$smarty->assign('LDTherapy',$LDCon);


			// CONSULTATION FEE
			$cTemp = $cTemp.'<select name="consultation_fee">
							<option value=""></option>';


						$sql_con="SELECT  item_description FROM care_tz_drugsandservices WHERE item_number like 'C%' and
						 item_description LIKE '%CONS%'";
			  			$db_con = $db->Execute($sql_con);
						while($conrow=$db_con->FetchRow()){
							$cTemp = $cTemp.'<option value="'.$conrow['item_description'].'" ';
							$cTemp = $cTemp.'>';
							$cTemp = $cTemp.$conrow['item_description'];
							$cTemp = $cTemp.'</option>';
						}

					$cTemp = $cTemp.'</select>';

				$smarty->assign('consultation_fee',$cTemp);





			// medical service
			$sTemp = '<select name="medical_service" style="width:300px;">
							<option value="">'.$LDServicesType.'</option>
							<option value="1">Medicine</option>
							<option value="2">OB/GYN</option>
							<option value="3">Pediatrics</option>
							<option value="4">General Surgery</option>
							<option value="5">Othorpedic Surgery</option>
							<option value="6">Spina Bifida & HC Surgery</option>
							<option value="7">Mental Health</option>
							<option value="0">Unknown</option>';

					/*
						$sql_con="SELECT  item_description FROM care_tz_drugsandservices WHERE item_number like 'C%' and
						 item_description LIKE '%CONS%'";
			  			$db_con = $db->Execute($sql_con);
						while($conrow=$db_con->FetchRow()){
							$sTemp = $sTemp.'<option value="'.$conrow['item_description'].'" ';
							$sTemp = $sTemp.'>';
							$sTemp = $sTemp.$conrow['item_description'];
							$sTemp = $sTemp.'</option>';
						}
					*/
					$sTemp = $sTemp.'</select>';

			$smarty->assign('LDServices',$LDServices);

			$smarty->assign('LDServicesLst',$sTemp);









			// AMBULANCE FEE

				$aTemp = '<select name="ambulance_fee">
							<option value=""></option>';


						$sql_con="SELECT  item_description FROM care_tz_drugsandservices WHERE  purchasing_class='service' AND item_number LIKE 'AMB%'";
			  			$db_con = $db->Execute($sql_con);
						while($conrow=$db_con->FetchRow()){
							$aTemp = $aTemp.'<option value="'.$conrow['item_description'].'" ';
							$aTemp = $aTemp.'>';
							$aTemp = $aTemp.$conrow['item_description'];
							$aTemp = $aTemp.'</option>';
						}

					$aTemp = $aTemp.'</select>';

				$smarty->assign('ambulance_fee',$aTemp);

			$smarty->assign('LDAmbulance',$LDAmbulance);




			// REGISTRATION FEE
			//$rTemp = $rTemp.'<select name="registration_fee">
				//			<option value=""></option>';
						$sql_reg="SELECT  item_description FROM care_tz_drugsandservices WHERE  item_description LIKE 'REG%'";
			  			$db_reg = $db->Execute($sql_reg);
						while($regrow=$db_reg->FetchRow()){
							$rTemp = $rTemp.'<input type="radio" name="registration_fee" value="'.$regrow['item_description'].'" ';
							$rTemp = $rTemp.'>';
						    $rTemp = $rTemp.$regrow['item_description'];
						}
			  		//	while($regrow=$db_reg->FetchRow()){
						//	$rTemp = $rTemp.'<option value="'.$regrow['item_description'].'" ';
							//$rTemp = $rTemp.'>';
						    //$rTemp = $rTemp.$regrow['item_description'];
							//$rTemp = $rTemp.'</option>';
						//}

					//$rTemp = $rTemp.'</select>';

			$smarty->assign('registration_fee',$rTemp);
			$smarty->assign('LDRecBy',$LDReg);

			$smarty->assign('LDSpecials',$LDSpecials);
			$smarty->assign('referrer_notes','<input name="referrer_notes" type="text" size="60" value="'.$referrer_notes.'">');


			$smarty->assign('LDRefFrom',$LDRefFrom);
                        $smarty->assign('referrer_institution','<input name="referrer_institution" type="text" size="60" value="'.$referrer_institution.'">');

			if ($errorinsclass) $smarty->assign('LDBillType',"<font color=red>$LDBillType</font>");
				else  $smarty->assign('LDBillType',$LDBillType);

			$sTemp = '';
			if(is_object($insurance_classes)){
				while($result=$insurance_classes->FetchRow()) {

					$sTemp = $sTemp.'<input name="insurance_class_nr" type="radio"  value="'.$result['class_nr'].'" ';
					if($insurance_class_nr==$result['class_nr']) $sTemp = $sTemp.'checked';
					$sTemp = $sTemp.'>';

					$LD=$result['LD_var'];
					if(isset($$LD)&&!empty($$LD)) $sTemp = $sTemp.$$LD;
						else $sTemp = $sTemp.$result['name'];
				}
			}
			$smarty->assign('sBillTypeInput',$sTemp);
			$sTemp = '';
			if ($error_ins_nr) $smarty->assign('LDInsuranceNr',"<font color=red>$LDInsuranceNr</font>");
				else  $smarty->assign('LDInsuranceNr',$LDInsuranceNr);
			 if(isset($insurance_nr)&&$insurance_nr) $sTemp = $insurance_nr;
			$smarty->assign('insurance_nr','<input name="insurance_nr" type="text" size="60" value="'.$sTemp.'">');

			$sTemp = '';
			 if(isset($insurance_firm_name)) $sTemp = $insurance_firm_name;
			if ($error_ins_co) $smarty->assign('LDInsuranceCo',"<font color=red>$LDInsuranceCo</font>");
				else $smarty->assign('LDInsuranceCo',$LDInsuranceCo);

			$sBuffer ="<a href=\"javascript:popSearchWin('insurance','aufnahmeform.insurance_firm_id','aufnahmeform.insurance_firm_name')\"><img ".createComIcon($root_path,'l-arrowgrnlrg.gif','0','',TRUE)."></a>";
			$smarty->assign('insurance_firm_name','<input name="insurance_firm_name" type="text" size="60" value="'.$sTemp.'">'.$sBuffer);

			if (!$GLOBAL_CONFIG['patient_service_care_hide']&& is_object($care_service)){
				$smarty->assign('LDCareServiceClass',$LDCareServiceClass);
				$sTemp = '';

				$sTemp = $sTemp.'<select name="sc_care_class_nr" >';

				while($buffer=$care_service->FetchRow()){
					$sTemp = $sTemp.'
						<option value="'.$buffer['class_nr'].'" ';
					if($sc_care_class_nr==$buffer['class_nr']) $sTemp = $sTemp.'selected';
					$sTemp = $sTemp.'>';
					if(empty($$buffer['LD_var'])) $sTemp = $sTemp.$buffer['name'];
						else $sTemp = $sTemp.$$buffer['LD_var'];
					$sTemp = $sTemp.'</option>';
				}
				$sTemp = $sTemp.'</select>';

				$smarty->assign('sCareServiceInput',$sTemp);

				$smarty->assign('LDFrom',$LDFrom);
				$sTemp = '';
				 if(!empty($sc_care_start)) $sTemp = @formatDate2Local($sc_care_start,$date_format);

				$smarty->assign('sCSFromInput','<input type="text" name="sc_care_start"  value="'.$sTemp.'" size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				$smarty->assign('LDTo',$LDTo);
				$sTemp = '';
				 if(!empty($sc_care_end)) $sTemp = @formatDate2Local($sc_care_end,$date_format);
				$smarty->assign('sCSToInput','<input type="text" name="sc_care_end"  value="'.$sTemp.'"  size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				$smarty->assign('sCSHidden','<input type="hidden" name="sc_care_nr" value="'.$sc_care_nr.'">');

			}

			if (!$GLOBAL_CONFIG['patient_service_room_hide']&& is_object($room_service)){
				$smarty->assign('LDRoomServiceClass',$LDRoomServiceClass);
				$sTemp = '';

				$sTemp = $sTemp.'<select name="sc_room_class_nr" >';

				while($buffer=$room_service->FetchRow()){
					$sTemp = $sTemp.'
						<option value="'.$buffer['class_nr'].'" ';
					if($sc_room_class_nr==$buffer['class_nr']) $sTemp = $sTemp.'selected';
					$sTemp = $sTemp.'>';
					if(empty($$buffer['LD_var'])) $sTemp = $sTemp.$buffer['name'];
						else $sTemp = $sTemp.$$buffer['LD_var'];
					$sTemp = $sTemp.'</option>';
				}
				$sTemp = $sTemp.'</select>';

				$smarty->assign('sCareRoomInput',$sTemp);

				//$smarty->assign('LDFrom',$LDFrom);
				$sTemp = '';
				 if(!empty($sc_room_start)) $sTemp = @formatDate2Local($sc_room_start,$date_format);

				$smarty->assign('sRSFromInput','<input type="text" name="sc_room_start"  value="'.$sTemp.'" size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				//$smarty->assign('LDTo',$LDTo);
				$sTemp = '';
				 if(!empty($sc_room_end)) $sTemp = @formatDate2Local($sc_room_end,$date_format);
				$smarty->assign('sRSToInput','<input type="text" name="sc_room_end"  value="'.$sTemp.'"  size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				$smarty->assign('sRSHidden','<input type="hidden" name="sc_room_nr" value="'.$sc_room_nr.'">');

			}

			if (!$GLOBAL_CONFIG['patient_service_att_dr_hide']&& is_object($att_dr_service)){
				$smarty->assign('LDAttDrServiceClass',$LDAttDrServiceClass);
				$sTemp = '';

				$sTemp = $sTemp.'<select name="sc_att_dr_class_nr" >';

				while($buffer=$att_dr_service->FetchRow()){
					$sTemp = $sTemp.'
						<option value="'.$buffer['class_nr'].'" ';
					if($sc_att_dr_class_nr==$buffer['class_nr']) $sTemp = $sTemp.'selected';
					$sTemp = $sTemp.'>';
					if(empty($$buffer['LD_var'])) $sTemp = $sTemp.$buffer['name'];
						else $sTemp = $sTemp.$$buffer['LD_var'];
					$sTemp = $sTemp.'</option>';
				}
				$sTemp = $sTemp.'</select>';

				$smarty->assign('sCareDrInput',$sTemp);

				//$smarty->assign('LDFrom',$LDFrom);
				$sTemp = '';
				 if(!empty($sc_att_dr_start)) $sTemp = @formatDate2Local($sc_att_dr_start,$date_format);

				$smarty->assign('sDSFromInput','<input type="text" name="sc_att_dr_start"  value="'.$sTemp.'" size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				//$smarty->assign('LDTo',$LDTo);
				$sTemp = '';
				 if(!empty($sc_att_dr_end)) $sTemp = @formatDate2Local($sc_att_dr_end,$date_format);
				$smarty->assign('sDSToInput','<input type="text" name="sc_att_dr_end"  value="'.$sTemp.'"  size=9 maxlength=10   onBlur="IsValidDate(this,\''.$date_format.'\')" onKeyUp="setDate(this,\''.$date_format.'\',\''.$lang.'\')">');
				$smarty->assign('sDSHidden','<input type="hidden" name="sc_att_dr_nr" value="'.$sc_att_dr_nr.'">');

			}

			$smarty->assign('LDAdmitBy',$LDAdmitBy);
			if (empty($encoder)) $encoder = $_COOKIE[$local_user.$sid];
if(isset($user_id) && $user_id) $encoder= $user_id; else $encoder= $_SESSION['sess_user_name'];
			$smarty->assign('encoder','<input  name="encoder" type="text" value="'.$encoder.'" size="28" readonly>');


			$sTemp = '<input type="hidden" name="pid" value="'.$pid.'">
				<input type="hidden" name="encounter_nr" value="'.$encounter_nr.'">
				<input type="hidden" name="appt_nr" value="'.$appt_nr.'">
				<input type="hidden" name="sid" value="'.$sid.'">
				<input type="hidden" name="lang" value="'.$lang.'">
				<input type="hidden" name="mode" value="save">
				<input type="hidden" name="insurance_firm_id" value="'.$insurance_firm_id.'">
				<input type="hidden" name="insurance_show" value="'.$insurance_show.'">';

			if($update) $sTemp = $sTemp.'<input type="hidden" name=update value=1>';

			$smarty->assign('sHiddenInputs',$sTemp);

			$smarty->assign('pbSave','<input  type="image" '.createLDImgSrc($root_path,'savedisc.gif','0').' title="'.$LDSaveData.'" align="absmiddle">');

			$smarty->assign('pbRegData','<a href="patient_register_show.php'.URL_APPEND.'&pid='.$pid.'"><img '.createLDImgSrc($root_path,'reg_data.gif','0').'  title="'.$LDRegistration.'"  align="absmiddle"></a>');
			$smarty->assign('pbCancel','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').'  title="'.$LDCancel.'"  align="absmiddle"></a>');
			//<!-- Note: uncomment the ff: line if you want to have a reset button  -->
			/*<!--
			$smarty->assign('pbRefresh','<a href="javascript:document.aufnahmeform.reset()"><img '.createLDImgSrc($root_path,'reset.gif','0').' alt="'.$LDResetData.'"  align="absmiddle"></a>');
			-->
			*/

			if($error==1)
				$smarty->assign('sErrorHidInputs','<input type="hidden" name="forcesave" value="1">
				<input  type="submit" value="'.$LDForceSave.'">');

	if (!($newdata)) {

		$sTemp = '
		<form action='.$thisfile.' method=post>
		<input type="hidden" name=sid value='.$sid.'>
		<input type="hidden" name=patnum value="">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type=submit value="'.$LDNewForm.'">
		</form>';

		$smarty->assign('sNewDataForm',$sTemp);
	}

}  // end of if !isset($pid...

# Prepare shortcut links to other functions

$smarty->assign('sSearchLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="aufnahme_daten_such.php'.URL_APPEND.'">'.$LDPatientSearch.'</a>');
$smarty->assign('sArchiveLink','<img '.createComIcon($root_path,'varrow.gif','0').'> <a href="aufnahme_list.php'.URL_APPEND.'&newdata=1&from=entry">'.$LDArchive.'</a>');



$smarty->assign('sMainBlockIncludeFile','registration_admission/admit_input.tpl');

$smarty->display('common/mainframe.tpl');
?>
