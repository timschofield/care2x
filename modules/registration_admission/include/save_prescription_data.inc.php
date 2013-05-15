<?php

require_once($root_path.'include/care_api_classes/class_prescription.php');
$presc_obj= new Prescription;

/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('save_admission_data.inc.php',$PHP_SELF))
	die('<meta http-equiv="refresh" content="0; url=../">');


$debug=false;
($debug)?$db->debug=TRUE:$db->debug=FALSE;
if ($debug) {
    if (!isset($externalcall))
      echo "internal call<br>";
    else
      echo "external call<br>";

    echo "mode=".$mode."<br>";

		echo "show=".$show."<br>";

    echo "nr=".$nr."<br>";

    echo "breakfile: ".$breakfile."<br>";

    echo "backpath: ".$backpath."<br>";

    echo "pid:".$pid."<br>";

    echo "encounter_nr:".$encounter_nr;
	
	echo "prescrServ: ".$_GET['prescrServ'];
}
$i=0;
if($mode=='delete') $arr_item_number[0] = $nr;
foreach ($arr_item_number AS $item_number) {

  $dosage        	= $arr_dosage[$i];
  $times_per_day        = $arr_timesperday[$i];
  $days        		= $arr_days[$i];
  $total_dosage         = $arr_total_dosage[$i];
  $notes                = $arr_notes[$i];
  $article_item_number  = $arr_article_item_number[$i];
  $price                = $arr_price[$i];
  $article              = $arr_article[$i];

  $drug_class 			= $presc_obj->GetClassOfItemFromItemNo($article_item_number);

  $is_labtest			= $arr_is_labtest[$i];
  $is_medicine			= $arr_is_medicine[$i];
  $is_radio_test		= $arr_is_radio_test[$i];
  $is_service			= $arr_is_service[$i];
  
  $i++;

  //$obj->setDataArray($HTTP_POST_VARS);

  switch($mode){
  		case 'create':
  		            $sql="INSERT INTO care_encounter_prescription (
  		                          `encounter_nr`,
  		                          `prescription_type_nr`,
  		                          `article`,
  		                          `article_item_number`,
  		                          `price`,
  		                          `drug_class`,
								  `dosage`,
								  `times_per_day`,
								  `days`,
								  `total_dosage`,
  		                          `application_type_nr`,
  		                          `notes`,
  		                          `prescribe_date`,
  		                          `prescriber`,
  		                          `is_outpatient_prescription`,
  		                          `history`,
  		                          `modify_id`)

  		                          VALUES (
  		                          '".$_SESSION['sess_en']."',
  		                          0,
  		                          '".$article."',
  		                          '".$article_item_number."',
  		                          '".$price."',
  		                          '".$drug_class."',
								  '".$dosage."',
								  '".$times_per_day."',
								  '".$days."',
  		                          '".$total_dosage."',
  		                          0,
  		                          '".$notes."',
  		                          '".date('Y-m-d',time())."',
  		                          '".$prescriber."',
  		                          1,
  		                          '".$history."',
  		                          ''
  		                          )";
                  $db->Execute($sql);
				  
				  //*******
 								  	// Load the visual signalling functions
									include_once($root_path.'include/inc_visual_signalling_fx.php');
									
									if($presc_obj->GetClassOfItem($article_item_number) == 'drug_list')
									{
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_DOCTOR_INFO);
									
									}
									else 
									if($presc_obj->GetClassOfItem($article_item_number) == 'supplies')
									{
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_CONSUMABLES);
									
									}
									else 
									if($presc_obj->GetClassOfItem($article_item_number) == 'service')
									{
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_SERVICES);
									
									}
									else 
									if($presc_obj->GetClassOfItem($article_item_number) == 'dental' ||
$presc_obj->GetClassOfItem($article_item_number) == 'minor_proc_op' ||
$presc_obj->GetClassOfItem($article_item_number) == 'obgyne_op'  	||
$presc_obj->GetClassOfItem($article_item_number) == 'ortho_op'  	||
$presc_obj->GetClassOfItem($article_item_number) == 'surgical_op')
									{
									// Set the visual signal
									setEventSignalColor($encounter_nr,SIGNAL_COLOR_PROCEDURES);
									
									}
									
									//********
  								break;

								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
 								  //exit;
  								//break;
  		case 'update':
  		            $sql="UPDATE care_encounter_prescription SET
  		                          `dosage`='$dosage',
								  `times_per_day`='$times_per_day',
								  `days`='$days',
								  `total_dosage`='$total_dosage',
  		                          `notes`='$notes',
  		                          `prescriber`='$prescriber',
  		                          `history`='$history'
  		                  WHERE nr=$nr";
                  $db->Execute($sql);
  								break;
  		case 'delete':
  		            
			$reason="Disabled by pharmacy user";    
			 $sql="UPDATE care_encounter_prescription  SET
			 					`status`='deleted',
								`is_disabled`='1',
								`disable_id`='".$_SESSION['sess_user_name']."',
								`disable_date`=NOW(),
								`history`= concat(history,'$reason')
			 			WHERE nr=$nr";
                  $db->Execute($sql);

								  //if (isset($externalcall))
									//  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&pid=".$HTTP_SESSION_VARS['sess_pid']);
 								  //exit;
  								break;
  }// end of switch
} // end of foreach

if (isset($externalcall)){
	if ($backpath=='billing' || $backpath=='billing')
  		header("location: $root_path/modules/billing_tz/billing_tz_quotation.php");
  	else
  		header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&externalcall=".$externalcall."&backpath=".urlencode($backpath)."&prescrServ=".$_GET['prescrServ']."&pid=".$_SESSION['sess_pid']);
} else
  header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&backpath=".urlencode($backpath)."&prescrServ=".$_GET['prescrServ']."&pid=".$_SESSION['sess_pid']);


exit();

?>
