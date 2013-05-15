<?php
$returnfile=$_SESSION['sess_file_return'];

$_SESSION['sess_file_return']=$thisfile;

if (empty($externalcall))

  $breakfile='javascript:window.close()';

 else

  if($_COOKIE["ck_login_logged".$sid])

    if($target=="notes")

		$breakfile = $root_path."modules/nursing/nursing-station-patientdaten.php".URL_APPEND.
"&edit=$edit&station=$station&pn=$pn";

	else

	    $breakfile = $root_path."main/startframe.php".URL_APPEND.
"&edit=$edit&station=$station&pn=$pn";

  else

    $breakfile = $breakfile.URL_APPEND."&target=entry";

if($backpath)
	$breakfile = urldecode($backpath);
elseif($back_path) {
	$backpath=$back_path; // Just an ugly workaround! Sometimes back_path instead of backpath is used!
	$breakfile = urldecode($backpath);
}

$prescrServ = $_GET['prescrServ'];

$debug=FALSE;
if ($debug) {
	echo "file: gui_show.php<br>";
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "pid:".$pid."<br>";

    echo "pn: ".$pn."<br>";

    echo "prescrServ: ".$prescrServ."<br>";

    echo "showHist: ".$showHist."<br>";

}
# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

if($parent_admit) $sTitleNr= ($_SESSION['sess_full_en']);
	else $sTitleNr = ($_SESSION['sess_full_pid']);


# Title in the toolbar
 if (!empty($externalcall))
    $smarty->assign('sToolbarTitle',$sTitleNr);
 else
  $smarty->assign('sToolbarTitle',"$page_title ($sTitleNr)");

 if ($disablebuttons) $smarty->assign('disableButton',true);

 # href for help button

 if ($breakfile=="billing") {
 	$help_site="billing";
 }

 if (!isset($printout))
 	if($mode=='new')
 		if($show=='insert')
  		$smarty->assign('pbHelp',"javascript:gethelp('prescription.php','Prescription :: Overview','".$help_site."')");
  	else
  		$smarty->assign('pbHelp',"javascript:gethelp('prescription_create.php','Prescription :: Create new record','".$help_site."')");
	else
		$smarty->assign('pbHelp',"javascript:gethelp('prescription.php','Prescription :: Overview','".$help_site."')");

 $smarty->assign('breakfile',$breakfile);
 //$smarty->assign('breakfile','javascript:window.close()');

 # Window bar title
 $smarty->assign('title',"$page_title ( $sTitleNr)");

 # Onload Javascript code
 $smarty->assign('sOnLoadJs',"if (window.focus) window.focus();");

  # href for return button
 //$smarty->assign('pbBack',$returnfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr);


# Start buffering extra javascript output
ob_start();

?>

<script  language="javascript">
<!--

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

-->
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>


<?php

if (isset($printout))
  echo '<script language="javascript"> this.window.print(); </script>';

if($parent_admit) include($root_path.'include/inc_js_barcode_wristband_popwin.php');

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

/* Load the tabs */

if($parent_admit) {
	$tab_bot_line='#66ee66';
	if (empty($externalcall)) include('./gui_bridge/default/gui_tabs_patadmit.php');
	$smarty->assign('sTabsFile','registration_admission/admit_tabs.tpl');
	$smarty->assign('sClassItem','class="adm_item"');
	$smarty->assign('sClassInput','class="adm_input"');
}else{
	$tab_bot_line='#66ee66';
  if (empty($externalcall)) include('./gui_bridge/default/gui_tabs_patreg.php');
	$smarty->assign('sTabsFile','registration_admission/reg_tabs.tpl');
	$smarty->assign('sClassItem','class="reg_item"');
	$smarty->assign('sClassInput','class="reg_input"');
}

# If encounter is already discharged, show warning

if($parent_admit&&$is_discharged){

	$smarty->assign('is_discharged',TRUE);
	$smarty->assign('sWarnIcon',"<img ".createComIcon($root_path,'warn.gif','0','absmiddle',TRUE).">");
	if($current_encounter) $smarty->assign('sDischarged',$LDEncounterClosed);
		else $smarty->assign('sDischarged',$LDPatientIsDischarged);
}

if($parent_admit)
  $smarty->assign('LDCaseNr',$LDAdmitNr);
else
  $smarty->assign('LDCaseNr',$LDFileNr.':');

if($parent_admit) $smarty->assign('sEncNrPID',$selian_pid);
	else $smarty->assign('sEncNrPID',$selian_pid);

$smarty->assign('img_source',"<img height=\"100\" width=\"100\" $img_source>");

if($mode != 'new' && $mode != 'edit' && $mode != 'delete')
{
	$smarty->assign('LDTitle',$LDTitle);
	$smarty->assign('title',$title);
}
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('name_last',$name_last);
$smarty->assign('LDFirstName',$LDFirstName);
$smarty->assign('name_first',$name_first);

# If person is dead show a black cross and assign death date

if($death_date && $death_date != DBF_NODATE){
	$smarty->assign('sCrossImg','<img '.createComIcon($root_path,'blackcross_sm.gif','0','',TRUE).'>');
	$smarty->assign('sDeathDate',@formatDate2Local($death_date,$date_format));
}

	# Set a row span counter, initialize with 7
	if($mode=='new' || $mode=='edit' || $mode=='delete')
	{
		$iRowSpan = 5;
	}
	else
	{
		$iRowSpan = 7;
	}

	if($GLOBAL_CONFIG['patient_name_2_show']&&$name_2){
		$smarty->assign('LDName2',$LDName2);
		$smarty->assign('name_2',$name_2);
		$iRowSpan++;
	}

	if($GLOBAL_CONFIG['patient_name_3_show']&&$name_3){
		$smarty->assign('LDName3',$LDName3);
		$smarty->assign('name_3',$name_3);
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

if($mode != 'new' && $mode != 'edit' && $mode != 'delete')
{
	$smarty->assign('LDBloodGroup',$LDBloodGroup);
	if($blood_group){
		$buf='LD'.$blood_group;
		$smarty->assign('blood_group',$$buf);
	}
}

/* Buffer and load the options table  */

ob_start();

if (empty($externalcall))
	if($parent_admit)  include('./gui_bridge/default/gui_patient_encounter_showdata_options.php');
		else include('./gui_bridge/default/gui_patient_reg_options.php');
	$sTemp = ob_get_contents();

ob_end_clean();

$smarty->assign('sOptionsMenu',$sTemp);

# If mode = show then display data

if($mode=='show' /*&& !isset($externalcall) */){
	if($parent_admit) $bgimg='tableHeaderbg3.gif';
		else $bgimg='tableHeader_gr.gif';

	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
	if($rows){
		# Buffer the option block
		ob_start();
		//echo 'gui_'.$thisfile;
		include('./gui_bridge/default/gui_'.$thisfile);
		$sTemp = ob_get_contents();

      $smarty->assign('bShowNoRecord',TRUE);
      if (!isset($printout))
        $smarty->assign('sPromptIcon','<img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle',TRUE).'>');
        echo 'externalcall: '.$externalcall;

      if (!empty($externalcall)) {
        if (!isset($printout)) {

        	$smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&help_site='.$help_site.'&externalcall='.$externalcall.'&prescrServ='.$prescrServ.'&backpath='.urlencode($backpath).'"><img '.createComIcon($root_path,'createnew_tz.gif','0' ).' ></a>');
        }
      } else
        $smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new">'.$LDEnterNewRecord.'</a>');

/*

		//History
		$smarty->assign('sPromptLinkEdit', '<input type=submit value="show history" name="show_history" onclick="javascript:alert(\''.$showHist.'\');"/>');


*/


		ob_end_clean();

	  $smarty->assign('sOptionBlock',$sTemp);

	}else{
      if (!empty($externalcall)) {

	        if (!isset($printout)) {

	          	$smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&prescrServ='.$prescrServ.'&mode=new&help_site&externalcall='.$externalcall.'&backpath='.urlencode($backpath).'"><img '.createComIcon($root_path,'createnew_tz.gif','0' ).' ></a>');

	        } else {

	        	$smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&prescrServ='.$prescrServ.'>'.$LDEnterNewRecord.'</a>');

	        }

      }

  	  $smarty->assign('bShowNoRecord',TRUE);
	  $smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>');

	  $smarty->assign('norecordyet',$norecordyet);

	  if($parent_admit && !$is_discharged && $thisfile!='show_diagnostics_result.php'){

	  	  $smarty->assign('sPromptIcon','<img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle',TRUE).'>');

	      if (!empty($externalcall))
	        $smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&mode=new&help_site&externalcall='.$externalcall.'"><img '.createComIcon($root_path,'createnew_tz.gif','0' ).' ></a>');
	      else
	        $smarty->assign('sPromptLink','<a href="'.$thisfile.URL_APPEND.'&disablebuttons='.$disablebuttons.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=new&mode=new&help_site"><img '.createComIcon($root_path,'createnew_tz.gif','0' ).' ></a>');

 	  }else{
	  		if(file_exists('./gui_bridge/default/gui_person_createnew_'.$thisfile)) include('./gui_bridge/default/gui_person_createnew_'.$thisfile);
	  	}
	}

}else {
	# Buffer the option input block
	ob_start();
	   // witch tab sould be activated at first:
	   //set here "druglist", "Supplies", "supplies-lab", "special-others" if you want.

	   //old code:
	   //$activated_tab = "druglist";

	   if ($prescrServ=="serv")
	   {


		   	if (!isset($show))
		   		$show = 'service';
		   	$activated_tab ="service";

	   }
	   else
	   {

	   	if ($prescrServ=="proc")
	   	{

		   	if (!isset($show))
		   		$show = 'dental';
		   	$activated_tab = "dental";
		}

		else {

			if (!isset($show))
		   		$show = 'druglist';
		   	$activated_tab = "druglist";


		 }
	   }

	   // (by Merotech(RM): Here the main prescription-table-content will be loaded: ;
		//echo './gui_bridge/default/gui_input_'.$thisfile;

	  include('./gui_bridge/default/gui_input_'.$thisfile);


		$sTemp = ob_get_contents();
	ob_end_clean();
	$smarty->assign('sOptionBlock',$sTemp);
}
# Buffer the bottom controls

ob_start();

if (empty($externalcall))
	if($parent_admit) {
		include('./include/bottom_controls_admission_options.inc.php');
	}else{
		include('./include/bottom_controls_registration_options.inc.php');
	}

	# Get buffer contents and stop buffering

	$sTemp= ob_get_contents();

ob_end_clean();

$smarty->assign('sBottomControls',$sTemp);

if (empty($externalcall)) {
  $smarty->assign('pbBottomClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0').'  title="'.$LDCancel.'"  align="absmiddle"></a>');
}

$smarty->assign('sMainBlockIncludeFile','registration_admission/common_option_prescription.tpl');


$smarty->display('common/mainframe.tpl');

?>
