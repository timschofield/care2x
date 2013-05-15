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
$lang_tables=array('departments.php');
define('LANG_FILE','konsil.php');
$local_user='ck_lab_user';

require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_global_address.php'); 
require_once($root_path.'include/inc_test_findings_fx_baclabor.php');
require_once($root_path.'include/inc_test_request_vars_baclabor.php');
require_once($root_path.'include/inc_diagnostics_report_fx.php');

/* Load additional language table */
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
  else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');


$breakfile='labor.php'.URL_APPEND;
$returnfile='labor_test_request_admin_'.$subtarget.'.php'.URL_APPEND.'&target='.$target.'&subtarget='.$subtarget.'&user_origin='.$user_origin.'&batch_nr='.$batch_nr.'&pn='.$pn.'&tracker='.$tracker; ;

$thisfile='labor_test_findings_'.$subtarget.'.php';

//$db->debug=1;

$bgc1='#fff3f3'; 
$edit=0; /* Assume to not edit first */
$read_form=1;
$edit_findings=1;

//$konsil="patho";
$formtitle=$LDBacteriologicalLaboratory;
$dept_nr=25; // 25 = department nr. of bacteriological lab
$db_request_table=$subtarget;

require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter;
						
/* Here begins the real work */
/* Establish db connection */
require_once($root_path.'include/inc_date_format_functions.php');
    /* Check for the patient number = $pn. If available get the patients data, otherwise set edit to 0 */
    if(isset($pn)&&$pn){		

	    if( $enc_obj->loadEncounterData($pn)) {
		
			include_once($root_path.'include/care_api_classes/class_globalconfig.php');
			$GLOBAL_CONFIG=array();
			$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
			$glob_obj->getConfig('patient_%');	
			switch ($enc_obj->EncounterClass())
			{
		    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
				case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
				default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			}						

			$result=&$enc_obj->encounter;
		}else{
			$edit=0;
			$mode='';
			$pn='';
		}		
     }

	 if(!isset($mode) && $batch_nr && $pn)   $mode='edit_findings';
	 
	 if($mode=='save' || $mode=='update')
	 {
	 	 /* Process the variables */
		$type_general = &processFindings($lab_TestType,0);
								 
		$resist_ana_1= &processFindings($lab_ResistANaerob_1,1);
		$resist_ana_2= &processFindings($lab_ResistANaerob_2,1);
		$resist_ana_3= &processFindings($lab_ResistANaerob_3,1);
							
		$resist_anaerob = $resist_ana_1.'&'.$resist_ana_2.'&'.$resist_ana_3;
								 
		$resist_a_1= &processFindings($lab_ResistAerob_1,1);
		$resist_a_2= &processFindings($lab_ResistAerob_2,1);
		$resist_a_3= &processFindings($lab_ResistAerob_3,1);
		$resist_a_x= &processFindings($lab_ResistAerobExtra_1,1);
		$resist_a_x2= &processFindings($lab_ResistAerobExtra_2,1);
		$resist_a_x3= &processFindings($lab_ResistAerobExtra_3,1);

		$resist_aerob = $resist_a_1.'&'.$resist_a_2.'&'.$resist_a_3.'&'.$resist_a_x.'&'.$resist_a_x2.'&'.$resist_a_x3;
								 
		$findings_1= &processFindings($lab_TestResult_1,1);
		$findings_2= &processFindings($lab_TestResult_2,1);
		$findings_3= &processFindings($lab_TestResult_3,1);
								 
		$findings = $findings_1.'&'.$findings_2.'&'.$findings_3;
	  }
		
		  switch($mode)
		  {
				     case 'save':

							
                                 $sql="INSERT INTO care_test_findings_".$db_request_table." 
                                         (
										  batch_nr, encounter_nr, room_nr, dept_nr, 
										  notes, findings_init, findings_current, 
										  findings_final, entry_nr, rec_date, 
										  type_general, resist_anaerob, 
										  resist_aerob, findings, doctor_id, findings_date, 
										  findings_time, status, history,
										  create_id,
										  create_time
										  )
										  VALUES 
										  (
										   '".$batch_nr."','".$pn."','".$room_nr."','".$dept_nr."',
										   '".htmlspecialchars($notes)."','".$findings_init."','".$findings_current."',
										   '".$findings_final."','".$entry_nr."','".formatDate2Std($rec_date,$date_format)."',
										   '".$type_general."','".$resist_anaerob."',
										   '".$resist_aerob."','".$findings."','".$doctor_id."','".date('Y-m-d')."',
										   '".date('H:i')."','initial','Create: ".date('Y-m.d H:i:s')." = ".$_SESSION['sess_user_name']."\n',
										   '".$_SESSION['sess_user_name']."',
										   '".date('YmdHis')."'
										   )";						 


							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
								     signalNewDiagnosticsReportEvent();
									//echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else 
								  {
								     echo "<p>$sql<p>$LDDbNoSave"; 
									 $mode="";
								  }
								
								break; // end of case 'save'
								
		     case 'update':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table." SET 
                                           notes = '".htmlspecialchars($notes)."', findings_init = '".$findings_init."', findings_current = '".$findings_current."', 
										   findings_final = '".$findings_final."', entry_nr = '".$entry_nr."', rec_date = '".formatDate2Std($rec_date,$date_format)."', 
										   type_general = '".$type_general."', resist_anaerob ='".$resist_anaerob."', resist_aerob = '".$resist_aerob."', 
										   findings = '".$findings."', doctor_id = '', findings_date = '".date('Y-m-d')."', 
										   findings_time = '".date('H:i')."',  
										   history =".$enc_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '$batch_nr'";	
										   							  							
							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
								     signalNewDiagnosticsReportEvent();
									//echo $sql;
									 header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									 exit;
								  }
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode="";
								   }
								
								break; // end of case 'save'
								
		     case 'done':
			 
							      $sql="UPDATE care_test_findings_".$db_request_table." SET 
										   status='done', 
										   history =".$enc_obj->ConcatHistory("Done: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";
										  							
							      if($ergebnis=$enc_obj->Transact($sql))
       							  {
									//echo $sql;
							          $sql="UPDATE care_test_request_".$db_request_table." SET 
										   status='done',
										   history =".$enc_obj->ConcatHistory("Done: ".date('Y-m-d H:i:s')." = ".$_SESSION['sess_user_name']."\n").",
										   modify_id = '".$_SESSION['sess_user_name']."',
										   modify_time='".date('YmdHis')."'
										   WHERE batch_nr = '".$batch_nr."'";
							          if($ergebnis=$enc_obj->Transact($sql))
       							      {
								  		// Load the visual signalling functions
										include_once($root_path.'include/inc_visual_signalling_fx.php');
										// Set the visual signal 
										setEventSignalColor($pn,SIGNAL_COLOR_DIAGNOSTICS_REPORT);									
									     header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=insert&mode=edit_findings&pn=$pn&station=$station&user_origin=$user_origin&status=$status&target=$target&subtarget=$subtarget&noresize=$noresize&batch_nr=$batch_nr&entry_date=$entry_date");
									     exit;
								       }
								       else
								       {
								          echo "<p>$sql<p>$LDDbNoSave"; 
								          $mode='save';
								        }								 
									}
								  else
								   {
								      echo "<p>$sql<p>$LDDbNoSave"; 
								      $mode='save';
								   }
								
								break; // end of case 'save'
	        
			/* If mode is edit, get the stored test findings */
			case 'edit_findings':

			           $sql="SELECT * FROM care_test_findings_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_findings=$ergebnis->FetchRow();
							   
							   parse_str($stored_findings['type_general'],$parsed_type);
							   parse_str($stored_findings['resist_anaerob'],$parsed_resist_anaerob);
							   parse_str($stored_findings['resist_aerob'],$parsed_resist_aerob);
							   parse_str($stored_findings['findings'],$parsed_findings);
						   
							   if($stored_findings['status']=="done") $edit_findings=0; /* Inhibit editing of the findings */
							   
							   $mode='update';
							   $edit_form=1;
					         }
							 else
							 {
							    $mode='save';
						     }
			             }
						 else
						 {
						    $mode='save'; 
						  }
						 
						 break; ///* End of case 'edit': */
						 
			 default:	$mode='';
			 
		  }// end of switch($mode)


/* Get the stored request for displayint only*/			           
                       $sql="SELECT * FROM care_test_request_".$db_request_table." WHERE batch_nr='".$batch_nr."'";
		                if($ergebnis=$db->Execute($sql))
       		            {
				            if($editable_rows=$ergebnis->RecordCount())
					        {
							
     					       $stored_request=$ergebnis->FetchRow();
							   
							   parse_str($stored_request['material'],$stored_material);
							   parse_str($stored_request['test_type'],$stored_test_type);
							   
							   if($stored_request['status']=='done') $edit=0; /* Inhibit editing of the findings */
							   
							   $edit_form=1;
					         }
							 else
							 {
							    $mode='save';echo $sql;
						     }
			             }
						 else
						 {
						    $mode='save'; echo $sql;
						  }

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle', "$LDDiagnosticTest (#$batch_nr)");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('pending_baclabor_findings.php')");

 # hide return  button
 $smarty->assign('pbBack',$returnfile);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDDiagnosticTest (#$batch_nr)");

# Prepare Body onLoad javascript code
$sTemp = 'onLoad="if (window.focus) window.focus(); loadM(\'form_test_request\');"';

$smarty->assign('sOnLoadJs',$sTemp);

 # collect extra javascript code
 ob_start();
?>

<style type="text/css">
.lab {font-family:ms ui gothic; font-size: 9; color:#ee6666;}
.lmargin {margin-left: 5;}
</style>

<script language="javascript">
<!-- 
function chkForm(d){

   if((d.entry_nr.value=='')||(d.entry_nr.value==' '))
	{
		alert("<?php echo $LDPlsEnterLEN ?>");
		d.entry_nr.focus();
		return false;
	}
	else  if((d.rec_date.value=='')||(d.rec_date.value==' '))
	{
		alert("<?php echo $LDPlsEnterDate ?>");
		d.rec_date.focus();
		return false;
	}
}

function loadM(fn)
{
	mBlank=new Image();
	mBlank.src="b.gif";
	mFilled=new Image();
	mFilled.src="f.gif";
	
	form_name=fn;
}

function setM(m)
{
    eval("marker=document.images."+m);
	eval("element=document."+form_name+"."+m);
	
    if(marker.src!=mFilled.src)
	{
	   marker.src=mFilled.src;
	   element.value='1';
	  // alert(element.name+element.value);
	}
	 else 
	 {
	    marker.src=mBlank.src;
		element.value='0';
	  // alert(element.name+element.value);
	 }
}


function setThis(prep,elem,begin,end,step)
{
  for(i=begin;i<end;i=i+step)
  {
     x=prep + i;
     if(elem!=i)
     {
       eval("marker=document.images."+x);
	   if(marker.src==mFilled.src)  setM(x);
     }
  }
  setM(prep+elem);
}


function printOut()
{
	urlholder="labor_test_findings_printpop.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&user_origin=<?php echo $user_origin ?>&subtarget=<?php echo $subtarget ?>&batch_nr=<?php echo $batch_nr ?>&pn=<?php echo $pn ?>&entry_date=<?php echo $entry_date ?>";
	findings_printout<?php echo $sid ?>=window.open(urlholder,"findings_printout<?php echo $sid ?>","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
    findings_printout<?php echo $sid ?>.print();
}
   
<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>

<?php
$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

if ($edit_findings)
{
?>
<form name="form_test_request" method="post" action="<?php echo $thisfile ?>" onSubmit="return chkForm(this)">
<?php
}

echo '<ul>';

if ($edit_findings)
{
?>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
<?php
}
?>  
 <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!='done' && $stored_findings['status']!='final')
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').'></a>';
}

/* Load the image functions */
require_once($root_path.'include/inc_test_request_printout_fx.php');
/* Load the findings part of the form */
require($root_path.'include/inc_test_findings_form_baclabor.php');

?>


<?php
if ($edit_findings)
{
/* Load the common hidden post vars */
require($root_path."include/inc_test_request_hiddenvars.php");

?>
<input type="hidden" name="entry_date" value="<?php echo $entry_date ?>">
<?php
}


if ($edit_findings)
{
?>
 <input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
<?php
}
?>    
         <a href="javascript:printOut()"><img <?php echo createLDImgSrc($root_path,'printout.gif','0') ?>></a>
<?php
if (isset($stored_findings['status']) && $stored_findings['status']!="done" && $stored_findings['status']!="final")
{
  echo'
         <a href="'. $thisfile.'?sid='.$sid.'&lang='.$lang.'&edit='.$edit.'&mode=done&target='.$target.'&subtarget='.$subtarget.'&batch_nr='.$batch_nr.'&pn='.$pn.'&user_origin='.$user_origin.'&entry_date='.$entry_date.'"><img '.createLDImgSrc($root_path,'done.gif','0').'></a>';
}

echo '</ul>';

if ($edit_findings) echo '</form>';

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
