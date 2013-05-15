<?php
require_once($root_path.'include/care_api_classes/class_prescription.php');
if(!isset($pres_obj)) $pres_obj=new Prescription;
require_once($root_path.'include/care_api_classes/class_person.php');
$person_obj = new Person;

require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_tz_billing.php');
require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$bill = new Bill();

$thisfile=basename($_SERVER['PHP_SELF']);

echo '<script type="text/javascript">';

echo 'function reCalculate(tl,s,t,d){';
echo '	tl.value= s.value*t.value*d.value;';
echo '}';
echo '</script>';

if (empty($encounter_nr) and !empty($pid))
	$encounter_nr = $person_obj->CurrentEncounter($pid);

$debug=FALSE;
if ($debug) {
	if (!empty($back_path)) $backpath=$back_path;

	echo "file: show_prescription<br>";
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

    echo "encounter_nr:".$encounter_nr."<br>";

    echo "Session-ecnounter_nr: ".$HTTP_SESSION_VARS['sess_en'];
}
$pres_types=$pres_obj->getPrescriptionTypes();


?>

<script language="javascript">

function chkform(d) {

  var dosage_item;
  var times_item;
  var days_item;
  var total_dosage_item;
  var pres_item = document.getElementById('prescr_count');
  var pres_count = pres_item.value;
  
	for ( i=0; i < pres_count; i++ ) {
	
		dosage_item = document.getElementById('dosage'+i);
		times_item = document.getElementById('timesperday'+i);
		days_item = document.getElementById('days'+i);
		total_dosage_item = document.getElementById('total_dosage'+i);
	   
			if((dosage_item.value == "") || (dosage_item.value  < 0))
	   		{
	   			alert("Please enter dosage for prescription item "+(i+1));
	   			return false;
	   
	   		}
			else
			if((times_item.value == "") || (times_item.value  < 0))
	   		{
	   			alert("Please enter times per day for prescription item "+(i+1));
	   			return false;
	   
	   		}
			else
			if((days_item.value == "") || (days_item.value  < 0))
	   		{
	   			alert("Please enter days for prescription item "+(i+1));
	   			return false;
	   
	   		}
			else 
			if((total_dosage_item.value == "") || (total_dosage_item.value  < 0) || (total_dosage_item.value  == 0))
	   		{
	   			alert("Please enter total dosage for prescription item "+(i+1));
	   			return false;
	   
	   		}
			 else
                        if(isNaN(dosage_item.value))
                        {
                                alert("Wrong value,enter only numbers for single dose/items for prescription "+(i+1));
                                return false;

                        }
			 else
                        if(isNaN(total_dosage_item.value))
                        {
                                alert("Wrong value,enter only numbers for total items for prescription "+(i+1));
                                return false;

                        }


			
      }

}

</script>

<form method="post" action="" name="prescform" onSubmit = "return chkform(this)">

<input type="hidden" name="backpath" value="<?php echo $backpath; ?>">

<?PHP





if(!$nr)
{
	$item_array=$_SESSION['item_array'];
}
else
{
	$prescriptionitem = $pres_obj->GetPrescritptionItem($nr);
	$item_array='';
	$item_array[0]= $prescriptionitem['article_item_number'];
	echo '<input type="hidden" value="'.$nr.'" name="nr">';
}
//echo "-->items in array: ".count($item_array)."<br>";#

 

for ($i=0 ; $i < count($item_array) ; $i++) {
$class = $pres_obj->GetClassOfItem($item_array[$i]);
$sub_class = $pres_obj->GetSubClassOfItem($item_array[$i]);

if($nexttime)
{
	$prescriptionitem['total_dosage']="";
	$nexttime=false;
}
if($class=='drug_list')
{
    if( $sub_class=='tabs') {
    $caption_total=' tabs';
	$caption_dose=' tabs';
	}
	else 
	
	if( $sub_class=='syrups' || $sub_class=='suspensions') {
	$caption_total=' bottles';
	$caption_dose=' mls';
	}
	else 
		
	if( $sub_class=='injections' ) {
	$caption_total=' injections';
	
	}
	
	else 
	
	$caption_total=' items';

	$caption_dosage = 'Single dose(per intake)';
}
else
{
	if($class=='dental' || $class=='eye-service' || $class=='minor_proc_op' || $class=='obgyne_op'
    || $class=='ortho_op' || $class=='surgical_op')
    {

	$caption_dosage = 'Number of Procedures';
	if(!$prescriptionitem['total_dosage']) $prescriptionitem['total_dosage']=1;
	}
	else
	 
	if($class=='service')
	{
	$caption_dosage = 'Amount/Items';
	}
	else 
	
	$caption_dosage = 'Total Amount/Items';

	$nexttime=true;
}
?>

<font class="adm_div"><?php echo $pres_obj->GetNameOfItem($item_array[$i]); ?></font>
 <table border=0 cellpadding=2 width=100%>

   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $caption_dosage; ?></td> 
     <td>
	<?php

		 //select "dosage"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {
			if($sub_class=='tabs') {
			
			echo '<select id="dosage'.$i.'" name="arr_dosage['.$i.']" onChange=reCalculate(total_dosage'.$i.',dosage'.$i.',timesperday'.$i.',days'.$i.')> ';
			
			} 
			
			else 
			
			if($sub_class=='syrups' || $sub_class=='suspensions') {
			
	     	echo '<select id="dosage'.$i.'" name="arr_dosage['.$i.']"> ';

            }  

			else

                         if($sub_class=='injections') {

              
                echo '<input type="text" id="dosage'.$i.'" name="arr_dosage['.$i.']" size=5  value = "'.$prescriptionitem['dosage'].'">';


            }

			else 
			
		
		echo '<input type="hidden" id="dosage'.$i.'" name="arr_dosage['.$i.']" value="1">';


			 if($sub_class=='tabs' || $sub_class=='syrups' || $sub_class=='suspensions')
                        {
			
	     			 $dosageUnits = array (	"" => "",
										"0.1" =>  "1 / 10",
										"0.25" => "1 / 4",
										"0.5"  => "1 / 2",
										"0.75" => "3 / 4",
										"1"    => "1",
										"1.25"    => "1 + 1 / 4",
										"1.5"     => "1 + 1 / 2",
										"1.75"    => "1 + 3 / 4",
										"2"    => "2",
										"2.25"    => "2 + 1 / 4",
										"2.5"    => "2 + 1 / 2",
										"3"    => "3",
										"4"    => "4",
										"5"    => "5",
										"6"    => "6",
										"7"    => "7",
										"8"    => "8",
										"9"    => "9",
										"10"   => "10",
										"15"   => "15",
										"20"   => "20",
										"25"   => "25",
										"30"   => "30"	);

			foreach($dosageUnits as $dec => $fract)
			{
				//preselect "1" in case of a new entry or the old value in case of an edit
				if (($prescriptionitem['dosage'] == $dec)||((!$nr)&&($dec == "-1")))
					$selected = 'selected="selected"';
				else
					$selected = '';

				echo '<option value="'.$dec.'" '.$selected.'>'.$fract.'</option>';

			}

	       echo '</select>';
		   
		   echo $caption_dose; 

	     }
		   
	       if (isset($nr)&&($prescrServ!='serv')) echo '('.$prescriptionitem['dosage'].')&nbsp;&nbsp;&nbsp;';
			
		 }
		 else
		 {
		 
		 echo '<input type="hidden" id="dosage'.$i.'" name="arr_dosage['.$i.']" value="1">';
			
		 }

       ?>
&nbsp;&nbsp;&nbsp;

      <?php

      	 //select "times_per_day"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

    		echo '<FONT SIZE=-1  FACE="Arial" color="#000066"> Times per day :  </FONT>';
			
			if($sub_class=='tabs') {
					
     		echo '<select id="timesperday'.$i.'" name="arr_timesperday['.$i.']" onChange=reCalculate(total_dosage'.$i.',dosage'.$i.',timesperday'.$i.',days'.$i.')>';
			
			}
			else {
			
			echo '<select id="timesperday'.$i.'" name="arr_timesperday['.$i.']">';
			
			}
			
      		$timesperdayUnits = array('', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

     		foreach ($timesperdayUnits as $unit)
     		{
     			//preselect "1" in case of a new entry or the old value in case of an edit
				if (($prescriptionitem['times_per_day'] == $unit)||((!$nr)&&($unit == "-1")))
					$selected = 'selected="selected"';
				else
					$selected = '';

				echo '<option value="'.$unit.'" '.$selected.'>'.$unit.'</option>';
     		}

			echo '</select>';
		 }
		 else
		 {
		 	echo '<input type="hidden" id="timesperday'.$i.'" name="arr_timesperday['.$i.']" value="1">';
		 }

		 if (isset($nr)&&($prescrServ!='serv')&&($prescrServ!='proc')) echo '('.$prescriptionitem['times_per_day'].')&nbsp;&nbsp;&nbsp;'

      ?>

&nbsp;&nbsp;&nbsp;
     <?php

		 //select "days"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

	    	 echo '<FONT SIZE=-1  FACE="Arial" color="#000066">  Days : </FONT>';
			 
			if($sub_class=='tabs') {
			
			echo '<select id="days'.$i.'" name="arr_days['.$i.']" onChange=reCalculate(total_dosage'.$i.',dosage'.$i.',timesperday'.$i.',days'.$i.')>';
			 
			}
			  else {
			  
			echo '<select id="days'.$i.'" name="arr_days['.$i.']">';  
			  
			}
			
	     	$dayUnits[0]='';
			
			for ($daycounter=1;$daycounter<121;$daycounter++) {
				$dayUnits[$daycounter]=$daycounter;
			}
			
	     	 foreach ($dayUnits as $unit)
	     	 {
	     			//preselect "1" in case of a new entry or the old value in case of an edit
					if (($prescriptionitem['days'] == $unit)||((!$nr)&&($unit == "-1")))
						$selected = 'selected="selected"';
					else
						$selected = '';

					echo '<option value="'.$unit.'" '.$selected.'>'.$unit.'</option>';
	     	 }

			 echo '</select>';
		
		 }
		 else
		 {
			echo '<input type="hidden" id="days'.$i.'" name="arr_days['.$i.']" value="1">';
		 }

		 if (isset($nr)&&($prescrServ!='serv')&&($prescrServ!='proc')) echo '('.$prescriptionitem['days'].')&nbsp;&nbsp;&nbsp;'

     ?>
	 &nbsp;&nbsp;&nbsp;
	 <?php

		 //select "total dose"

		 if ($caption_dosage == 'Single dose(per intake)')
		 {

	    	 echo '<FONT SIZE=-1  FACE="Arial" color="#000066">  Total Dose/Items : </FONT>';
			 
			 
			 if($sub_class=='tabs') {
			 		 	 
			 echo '<input type="text" id="total_dosage'.$i.'" name="arr_total_dosage['.$i.']" size=5 readonly=true>';
			 
			 } 
			 else {
			 
	     	 echo '<select id="total_dosage'.$i.'" name="arr_total_dosage['.$i.']">';

	     	
			$totalDoseUnits[0]='';
			for ($doseCounter=1;$doseCounter<11;$doseCounter++) {
				$totalDoseUnits[$doseCounter]=$doseCounter;
			}
			
	     	 foreach ($totalDoseUnits as $td_unit)
	     	 {
	     			//preselect "1" in case of a new entry or the old value in case of an edit
					if (($prescriptionitem['total_dosage'] == $td_unit)||((!$nr)&&($td_unit == "-1")))
						$selected = 'selected="selected"';
					else
						$selected = '';

					echo '<option value="'.$td_unit.'" '.$selected.'>'.$td_unit.'</option>';
	     	 }

			 echo '</select>';
			
			}
			 
			 echo $caption_total; 
		 }
		 else
		 {
			
			if ($caption_dosage == 'Total Amount/Items')
	                 {
                        
			 echo '<select id="total_dosage'.$i.'" name="arr_total_dosage['.$i.']">';


                        $totalDoseUnits[0]='';
                        for ($doseCounter=1;$doseCounter<121;$doseCounter++) {
                                $totalDoseUnits[$doseCounter]=$doseCounter;
                        }

                 foreach ($totalDoseUnits as $td_unit)
                 {
                                //preselect "1" in case of a new entry or the old value in case of an edit
                                        if (($prescriptionitem['total_dosage'] == $td_unit)||((!$nr)&&($td_unit == "-1")))
                                                $selected = 'selected="selected"';
                                        else
                                                $selected = '';

                                        echo '<option value="'.$td_unit.'" '.$selected.'>'.$td_unit.'</option>';
                 }

                         echo '</select>';
 


                       	}
			else 

		 	echo '<input type="text" id="total_dosage'.$i.'" name="arr_total_dosage['.$i.']" size=50 maxlength=60 value = "'.$prescriptionitem['total_dosage'].'">';
		    
		 }

		 if (isset($nr)&&($prescrServ!='serv')&&($prescrServ!='proc')) echo '('.$prescriptionitem['total_dosage'].')&nbsp;&nbsp;&nbsp;'

     ?>
	 

	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDApplication.' '.$LDNotes; ?></td>
     <!--<td><textarea name="arr_notes[<?PHP echo $i; ?>]" cols=40 rows=3 wrap="physical"><?php echo $prescriptionitem['notes'];?></textarea>
         </td>-->
		 <td><input type="text" name="arr_notes[<?PHP echo $i; ?>]" size="120"><?php echo $prescriptionitem['notes'];?>
         </td>
   </tr>


   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDPrescribedBy; ?></td>
     <td><input type="text" name="prescriber" size=50 maxlength=60 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly></td>
   </tr>
 </table>
 
<input type="hidden" id= "prescr_count" name="prescr_count" value= "4" >

<input type="hidden" name="arr_item_number[<?PHP echo $i; ?>]" value="<?PHP echo $i; ?>">

<input type="hidden" name="arr_article_item_number[<?PHP echo $i; ?>]" value="<?php echo $item_array[$i];?>">

<input type="hidden" name="arr_price[<?PHP echo $i; ?>]" value="<?php echo $pres_obj->GetPriceOfItem($item_array[$i]);?>">

<input type="hidden" name="arr_article[<?PHP echo $i; ?>]" value="<?php echo $pres_obj->GetNameOfItem($item_array[$i]);?>">

<input type="hidden" name="arr_is_labtest[<?PHP echo $i; ?>]" value="<?php if ($pres_obj->GetClassOfItem($item_no[$i])=='lab_test') echo 1; else echo 0;?>">

<input type="hidden" name="arr_is_medicine[<?PHP echo $i; ?>]" value="<?php if ($pres_obj->GetClassOfItem($item_array[$i])=='drug_list' || $pres_obj->GetClassOfItem($item_array[$i])=='supplies') echo 1; else echo 0 ;?>">

<input type="hidden" name="arr_is_radio_test[<?PHP echo $i; ?>]" value="<?php if ($pres_obj->GetClassOfItem($item_no[$i])=='xray') echo 1; else echo 0;?>">

<input type="hidden" name="arr_is_service[<?PHP echo $i; ?>]" value="<?php if ($pres_obj->GetClassOfItem($item_array[$i])=='service' || $pres_obj->GetClassOfItem($item_array[$i])=='dental' ||
$pres_obj->GetClassOfItem($item_array[$i])=='eye-services' || $pres_obj->GetClassOfItem($item_array[$i])=='minor_proc_op' || $pres_obj->GetClassOfItem($item_array[$i])=='obgyne_op' || $pres_obj->GetClassOfItem($item_array[$i])=='ortho_op' || $pres_obj->GetClassOfItem($item_array[$i])=='surgical_op') echo 1; else echo 0 ;?>">

<?php
} // end of loop
?>
<input type="hidden" name="encounter_nr" value="<?php echo $HTTP_SESSION_VARS['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $HTTP_SESSION_VARS['sess_pid']; ?>">
<?php
if(!$nr)
	echo '<input type="hidden" name="mode" value="create">';
else
	echo '<input type="hidden" name="mode" value="update">';
?>
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $HTTP_SESSION_VARS['sess_user_name']."\n"; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">


        <?
        if (isset($externalcall)) {
        ?>
          <input type="hidden" name="externalcall" value="<?php echo $externalcall;?>">
        <?}?>

<input type="hidden" name="is_outpatient_prescription" value="1">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>


<?php
/**
* Second part: Show all prescriptions for this encounter no. since now.
*/
?>

<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
<?php
$toggle=TRUE;
while($row=$result->FetchRow() ){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	if ($toggle)
		$toggle=FALSE;
	else $toggle=TRUE;

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission

?>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['prescribe_date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><?php echo $row['total_dosage']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['drug_class']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td rowspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial">Notes</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescription_type_nr']; ?></td>

    <td><FONT SIZE=-1  FACE="Arial">Requested by:</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>
<?php

}
?>
</table>
