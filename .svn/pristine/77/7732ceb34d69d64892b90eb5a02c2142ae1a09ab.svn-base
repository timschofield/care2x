	<?php

	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/inc_environment_global.php');

	$lang_tables[]='departments.php';
	$lang_tables[]='pharmacy.php';
$lang_tables[]='diagnoses_ICD10.php';
	define('LANG_FILE','nursing.php');
	//define('LANG_FILE','aufnahme.php');

	define('NO_2LEVEL_CHK',1);
	require_once($root_path.'include/inc_front_chain_lang.php');

	include_once($root_path.'include/care_api_classes/class_mini_dental.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');
	$alergic= new dental;
 	$Radiology= new dental;
 	$multi= new multi;

	/**
	* If the script call comes from the op module replace the user cookie with the user info from op module
	*/
	//$db->debug=true;
	if(isset($op_shortcut)&&$op_shortcut){
		$_COOKIE['ck_pflege_user'.$sid]=$op_shortcut;
		setcookie('ck_pflege_user'.$sid,$op_shortcut,0,'/');
		$edit=1;
	}elseif($_COOKIE['ck_op_pflegelogbuch_user'.$sid]){
		setcookie('ck_pflege_user'.$sid,$_COOKIE['ck_op_pflegelogbuch_user'.$sid],0,'/');
		$edit=1;
	}elseif($_COOKIE['aufnahme_user'.$sid]){
		setcookie('ck_pflege_user'.$sid,$_COOKIE['aufnahme_user'.$sid],0,'/');
		$edit=1;
	}elseif(!$_COOKIE['ck_pflege_user'.$sid]){
		//if($edit) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;};
	}
	/* Load the visual signalling defined constants */
	require_once($root_path.'include/inc_visual_signalling_fx.php');
	require_once($root_path.'global_conf/inc_remoteservers_conf.php');

	/* Retrieve the SIGNAL_COLOR_LEVEL_ZERO = for convenience purposes */
	$z = SIGNAL_COLOR_LEVEL_ZERO;
	/* Retrieve the SIGNAL_COLOR_LEVEL_FULL = for convenience purposes */
	$f = SIGNAL_COLOR_LEVEL_FULL;

	$HTTP_SESSION_VARS['sess_user_origin']='nursing';

	/* Create department object and load all medical depts */
	require_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj= new Department;
	$medical_depts=$dept_obj->getAllMedical();
	/* Create encounter object */
	require_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj= new Encounter;

	/* Load global configs */
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');

session_start();
$_SESSION['logID'] = $HTTP_SESSION_VARS['sess_user_name'];


function Spacer()
{
/*?>
<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1
                  src="../../gui/img/common/default/pixel.gif"
                  width=5></TD></TR>
<?php
*/}





	/* Establish db connection */
	if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
	if($dblink_ok)
	{
	    /* Load date formatter */
		include_once($root_path.'include/inc_date_format_functions.php');
			$enc_obj->where=" encounter_nr=$pn";
		    if( $enc_obj->loadEncounterData($pn)) {
	/*			switch ($enc_obj->EncounterClass())
				{
			    	case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
			                   break;
					case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
								break;
					default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
				}
	*/
				$full_en=$pn;

				if( $enc_obj->is_loaded){
					$result=&$enc_obj->encounter;
					$rows=$enc_obj->record_count;

						if($result['is_discharged']) $edit=0;

						$event_table= 'care_encounter_event_signaller';

						/* If mode = save_event_changes, save the color bar status */

						if($mode=='save_event_changes')
						{
						   $sql_buf='';

						   /* prepare the rose_x part sql query */

						   for ($i=1;$i<25;$i++)
						   {
						       $buf='rose_'.$i;

							   $sql_buf.=$buf." ='".$$buf."', ";
						   }

						   /* prepare the green_x part */

						   for ($i=1;$i<8;$i++)
						   {
						       $buf='green_'.$i;

							   $sql_buf.=$buf."='".$$buf."', ";
						   }

						   /* append the additional color event signallers */

						   $sql_buf.="yellow='$yellow', black='$black', blue_pale='$blue_pale', brown='$brown',
						                   pink='$pink', yellow_pale='$yellow_pale', red='$red', green_pale='$green_pale',
										   violet='$violet', blue='$blue', biege='$biege', orange='$orange'";


						   $sql = "UPDATE $event_table SET $sql_buf WHERE encounter_nr='$pn'";

						 //  echo $sql;

						   if ($event_result=$enc_obj->Transact($sql))
						   {
						     if (!$db->Affected_Rows())
						      {
	                            /* If entry not yet existing, insert data */

						        /* prepare the rose_x part sql query */

							    $set_str='';
								$sql_buf='';

						        for ($i=1;$i<25;$i++)
						       {

						          $buf='rose_'.$i;

								  $set_str.=$buf.', ';

							       $sql_buf.="'".$$buf."', ";
						       }

						       /* prepare the green_x part */

						       for ($i=1;$i<8;$i++)
						      {
						          $buf='green_'.$i;

								  $set_str.=$buf.', ';

							       $sql_buf.="'".$$buf."', ";
						       }

						   /* append the additional color event signallers */

						   $set_str.='yellow, black, blue_pale, brown,
						                   pink, yellow_pale, red, green_pale,
										   violet, blue, biege, orange';

						   /* prepare the values part */

						   $sql_buf.="'$yellow', '$black', '$blue_pale', '$brown',
						                   '$pink', '$yellow_pale', '$red', '$green_pale',
										   '$violet', '$blue', '$biege', '$orange'";

							$sql = "INSERT INTO $event_table (encounter_nr, $set_str) VALUES ('$pn', $sql_buf)";

						    if($event_result=$enc_obj->Transact($sql))
						    {
						       $event=&$HTTP_POST_VARS;

							   $mode='changes_saved';
							    //echo "ok insertd $sql";
						    }
							else
							{
							    //echo "failed insert $sql";
							    $mode='';
							}

					      }
						  else
						  {
						      $mode='changes_saved';
							   //echo "update ok $sql";
						  }
						}
						else
						{
						      $mode='';
							   //echo " failed update $sql";
						}
				    }

					//echo $sql;

				   if(!isset($mode) || ($mode=='') || ($mode=='changes_saved'))
				   {
						/* Get the color event signaller data */

						$sql="SELECT * FROM ".$event_table." WHERE encounter_nr='".$pn."'";

						if($event_result=$db->Execute($sql))
						{
						   if($event_result->RecordCount())
						   {
						      $event=$event_result->FetchRow();
							}
						    else
							{
							   /* If no event entry yet, create event array with zeros */
							   $event=array('yellow'=>$z,'black'=>$z,'blue_pale'=>$z,'brown'=>$z,'pink'=>$z,'yellow_pale'=>$z,'red'=>$z,'green_pale'=>$z,'violet'=>$z,'blue'=>$z,'biege'=>$z,'orange'=>$z);
							   /* Add the green_n */
							   for ($i=1;$i<8;$i++)
							   {
							       $event['green_'.$i]=$z;
							    }
								/* Add the rose_n */
							   for ($i=1;$i<25;$i++)
							   {
							       $event['rose_'.$i]=$z;
							    }
						    }

						}
				   }
				} // end of if($rows)
		  }else{ // end of if ($ergebnis)
		  	echo "<p>$sql$LDDbNoRead";
			exit;
		}
	}else{
		echo "$LDDbNoLink<br>$sql<br>";
	}

	$fr=strtolower(str_replace('.','-',($result['encounter_nr'].'_'.$result['name_last'].'_'.$result['name_first'].'_'.$result['date_birth'])));


	# Start Smarty templating here
	 /**
	 * LOAD Smarty
	 */
	 # Note: it is advisable to load this after the inc_front_chain_lang.php so
	 # that the smarty script can use the user configured template theme

	 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
	 $smarty = new smarty_care('nursing');

	# Title in toolbar
	# $smarty->assign('sToolbarTitle',"$LDPatDataFolder $station");

	 # hide return button
	# $smarty->assign('pbBack',FALSE);

	 # href for help button
	 #$smarty->assign('pbHelp',"javascript:gethelp('patient_charts.php','Patient&acute;s chart folder :: Overview','','$station','Main folder')");

	 # href for close button
	 #$smarty->assign('breakfile','javascript:window.close()');

	 # Window bar title
	# $smarty->assign('sWindowTitle',ucfirst($result[name_last]).",".ucfirst($result[name_first])." ".$result[date_birth]." ".$LDPatDataFolder);

	 # Body Onload js
	 #$sOnLoadJs = 'onLoad="initwindow();';
	 # if($mode=='changes_saved') $sOnLoadJs = $sOnLoadJs.'window.opener.location.reload();';
	 #$sOnLoadJs = $sOnLoadJs.'"';
	 #$smarty->assign('sOnLoadJs',$sOnLoadJs);

	//-- get dept_nr
	if (isset($_SESSION['deptnr'])){$dept_nr = $_SESSION['deptnr'];}


	# Collect js code

	#ob_start();


	# internal function for the following lines of code only
	function ha(){
		global $edit;
		if ($edit) return '<a href="#">';
	}
	function he(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullbar(this)"></a><a href="#">';
			else return  '>';
	}
	function hx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullbar(this)"></a>';
			else return '>';
	}
	function gx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullGreenbar(this)"></a>';
			else return '>';
	}
	function rx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullRosebar(this)"></a>';
			else return '>';
	}
	function mx(){
		global $edit;
		if ($edit) return 'onClick="javascript:pullMaroonbar(this)"></a>';
			else return '>';
	}

	require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
	include_once($root_path.'include/care_api_classes/class_person.php');

	$pobj= new Person;

	$pid=$pobj->GetPidFromEncounter($pn);

	?>


	<script language="javascript" type="text/javascript">
		function hideme(str,div,ht){
			if (document.getElementById(str).value == "+"){
					document.getElementById(str).value="-";
					document.getElementById(div).style.height=ht+'px';
				}
			else {
					document.getElementById(str).value="+";
					document.getElementById(div).style.height="30px";
					}
		}

		function extratable(){
			var my = document.getElementById('extratable');
			var bt = document.getElementById('bner');

			if (my.style.display=='none'){
				my.style.display='block';
				bt.value = 'Hide History';
			}else {
				my.style.display='none';
				bt.value = 'Show History';
			}


		}

		window.print();

	</script>

	<style type="text/css">
		<!--
		.heading {
			font-family: Tahoma, monospace;
			font-size: 11px;
			color: white;
			background-color: #696969;
			font:bold 11px Tahoma; color:white; text-transform:uppercase;
			}
		-->
	</style>

<table width="700px" align='center' border="0" style="min-width:700px;">
	<tr>
		<td colspan=2><?php
		  echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'&pid='.$pid.'" width=282 height=178 align="left" hspace=5 vspace=5>';
			?>
		</td>
	</tr>

	<tr>
		<td>
	     <table width="100%"  border="0" align="center" cellpadding="10" cellspacing="1" id="extratable" >
		  <tr>
	        <td width="15%" bgcolor="#D2DFD0" style="border-top:3px solid red;" valign="top"><strong>Laboratory</strong></td>
	        <td width="85%" style="border-top:3px solid red;">
				<?php include('./labor_datalist_history.php'); ?>
			</td>
	      </tr>
		  <tr>
	        <td width="15%" bgcolor="#D2DFD0" style="border-top:3px solid red;" valign="top"><strong>Diagnosis</strong></td>
	        <td width="85%" style="border-top:3px solid red;">
				<?php include('./labor_datalist_icd10_history.php'); ?>
			</td>
	      </tr>
		  <tr>
	        <td width="15%" bgcolor="#D2DFD0" style="border-top:3px solid red;" valign="top"><strong>Prescriptions</strong></td>
	        <td width="85%" style="border-top:3px solid red;">
				<?php include('./labor_datalist_prescription.php'); ?>
			</td>
	      </tr>
          <tr align="center" valign="middle">
            <td align="center" colspan=2 style="border-top:3px solid red;">****End****</td>
          </tr>
      </table>
	</td>
</tr>
</table>




	<input type="hidden" name="sid" value="<?php echo $sid ?>">
	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="hidden" name="dept_nr" value="<?php echo $dept_nr ?>">
	<input type="hidden" name="pn" value="<?php echo $pn ?>">

	<?php
	# If in edit mode create the hidden items
	if($edit){
	?>

	<input type="hidden" name="yellow" value="<?php echo $event['yellow'] ?>">
	<input type="hidden" name="black" value="<?php echo $event['black'] ?>">
	<input type="hidden" name="blue_pale" value="<?php echo $event['blue_pale'] ?>">
	<input type="hidden" name="brown" value="<?php echo $event['brown'] ?>">
	<input type="hidden" name="pink" value="<?php echo $event['pink'] ?>">
	<input type="hidden" name="yellow_pale" value="<?php echo $event['yellow_pale'] ?>">
	<input type="hidden" name="red" value="<?php echo $event['red'] ?>">
	<input type="hidden" name="green_pale" value="<?php echo $event['green_pale'] ?>">
	<input type="hidden" name="violet" value="<?php echo $event['violet'] ?>">
	<input type="hidden" name="blue" value="<?php echo $event['blue'] ?>">
	<input type="hidden" name="biege" value="<?php echo $event['biege'] ?>">
	<input type="hidden" name="orange" value="<?php echo $event['orange'] ?>">
	<input type="hidden" name="green_1" value="<?php echo $event['green_1'] ?>">
	<input type="hidden" name="green_2" value="<?php echo $event['green_2'] ?>">
	<input type="hidden" name="green_3" value="<?php echo $event['green_3'] ?>">
	<input type="hidden" name="green_4" value="<?php echo $event['green_4'] ?>">
	<input type="hidden" name="green_5" value="<?php echo $event['green_5'] ?>">
	<input type="hidden" name="green_6" value="<?php echo $event['green_6'] ?>">
	<input type="hidden" name="green_7" value="<?php echo $event['green_7'] ?>">
	<input type="hidden" name="rose_1" value="<?php echo $event['rose_1'] ?>">
	<input type="hidden" name="rose_2" value="<?php echo $event['rose_2'] ?>">
	<input type="hidden" name="rose_3" value="<?php echo $event['rose_3'] ?>">
	<input type="hidden" name="rose_4" value="<?php echo $event['rose_4'] ?>">
	<input type="hidden" name="rose_5" value="<?php echo $event['rose_5'] ?>">
	<input type="hidden" name="rose_6" value="<?php echo $event['rose_6'] ?>">
	<input type="hidden" name="rose_7" value="<?php echo $event['rose_7'] ?>">
	<input type="hidden" name="rose_8" value="<?php echo $event['rose_8'] ?>">
	<input type="hidden" name="rose_9" value="<?php echo $event['rose_9'] ?>">
	<input type="hidden" name="rose_10" value="<?php echo $event['rose_10'] ?>">
	<input type="hidden" name="rose_11" value="<?php echo $event['rose_11'] ?>">
	<input type="hidden" name="rose_12" value="<?php echo $event['rose_12'] ?>">
	<input type="hidden" name="rose_13" value="<?php echo $event['rose_13'] ?>">
	<input type="hidden" name="rose_14" value="<?php echo $event['rose_14'] ?>">
	<input type="hidden" name="rose_15" value="<?php echo $event['rose_15'] ?>">
	<input type="hidden" name="rose_16" value="<?php echo $event['rose_16'] ?>">
	<input type="hidden" name="rose_17" value="<?php echo $event['rose_17'] ?>">
	<input type="hidden" name="rose_18" value="<?php echo $event['rose_18'] ?>">
	<input type="hidden" name="rose_19" value="<?php echo $event['rose_19'] ?>">
	<input type="hidden" name="rose_20" value="<?php echo $event['rose_20'] ?>">
	<input type="hidden" name="rose_21" value="<?php echo $event['rose_21'] ?>">
	<input type="hidden" name="rose_22" value="<?php echo $event['rose_22'] ?>">
	<input type="hidden" name="rose_23" value="<?php echo $event['rose_23'] ?>">
	<input type="hidden" name="rose_24" value="<?php echo $event['rose_24'] ?>">
	<input type="hidden" name="mode" value="save_event_changes">
	<!-- dony by d.r. from merotech
	<input type="submit" value="<?php echo $LDSaveChanges ?>">-->
	<?php
	}

	  //echo '<a href="javascript:winClose()"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').'></a>';
	?>

	</form>

	</ul>
	<?php

	#$sTemp = ob_get_contents();
	#ob_end_clean();

	# Assign page output to the mainframe template

	#$smarty->assign('sMainFrameBlockData',$sTemp);
	 /**
	 * show Template
	 */
	 #$smarty->display('common/mainframe.tpl');

	?>
