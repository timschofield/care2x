<?php

$lang_tables=array('chemlab_groups.php','chemlab_params.php','prompt.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);


require_once($root_path.'include/inc_front_chain_lang.php');
if(!isset($user_origin)) $user_origin='';
if($user_origin=='lab'||$user_origin=='lab_mgmt'){
  	$local_user='ck_lab_user';
  	if(isset($from)&&$from=='input') $breakfile=$root_path.'modules/laboratory/labor_datainput.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin;
		else $breakfile=$root_path.'modules/laboratory/labor_data_patient_such.php'.URL_APPEND;
}else{
  	$local_user='ck_pflege_user';
  	//$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$pn.'&edit='.$edit;
	$encounter_nr=$pn;
}
if(!$_COOKIE[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;};

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");

$thisfile=basename(__FILE__);

//$db->debug=1;

$_enx = $multi->get_5_visits($pid);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

$jobs = $lab_obj->GetJobsByEncounter_summary($_enx);
$count_job = 0;
$count_subjob=1;
if ($jobs)
  while($j=$jobs->FetchRow()){
  		if($last_job != $j['job_id'])
  			{
  				$count_job++;
  			}
  		$arr_tasks = unserialize($j['serial_value']);
  		while(list($x,$v) = each($arr_tasks))
  		{

  			$parameters[$count_job]['tasks'][$x] = $v;
  			$taskstodo[$x] = $v;
  			if($x>$old_x) $old_x=$x;

  		}
  		$parameters[$count_job]['jobs'] = $j;
  		$last_job = $j['job_id'];
  }

if($debug)
{
	for($i=1;$i<=$count_job;$i++)
	{
			for($k=0;$k<=$old_x;$k++)
			{
				if($parameters[$i]['jobs'][$k])	echo 'parameters['.$i.'][\'jobs\']['.$k.'] = '.$parameters[$i]['jobs'][$k].'<br>';
				if($parameters[$i]['tasks'][$k])	echo 'parameters['.$i.'][\'tasks\']['.$k.'] = '.$parameters[$i]['tasks'][$k].'<br>';
			}

	}
}
$cache='';

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$encounter_nr";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$encounter_nr";

# Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

echo '
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 width="100%" bgcolor="#666666" cellpadding=3 cellspacing=1>';

if(empty($cache)){

	# Get the number of colums
	$cols=sizeof($records);

	$cache= '
		<tr bgcolor="#CAD3EC" >
		<td class="va12_n"><font color="#000"> &nbsp;<b>Parameter</b>
		</td>
		<td  class="j"><font color="#000">&nbsp;<b>Normal Range</b>&nbsp;</td>
		<td  class="j"><font color="#000">&nbsp;<b>Msr. Unit</b>&nbsp;</td>
		';
	for($i=1;$i<=$count_job;$i++){
		$cache.= '
		<td class="a12_b"><font color="#000">&nbsp;<b>'.formatDate2Local($parameters[$i]['jobs'][2],$date_format).'</b>&nbsp;</td>';
	}

	$cache.= '
		</tr>
		<tr bgcolor="#ffddee" >
		<td class="va12_n"><font color="#000"> &nbsp;
		</td>
		<td class="va12_n"><font color="#000"> &nbsp;
		</td>
		<td  class="j"><font color="#000">&nbsp;</td>';


	for($i=1;$i<=$count_job;$i++){
		$cache.= '
		<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($parameters[$i]['jobs'][3]).'</b> '.$LDOClock.'&nbsp;</td>';
	}

	# Reset array
	reset($ttime);

	$cache.= '
		</tr>';

	# Display the values

	$tasks=&$lab_obj->TestParams();
	while($t=$tasks->FetchRow())
	{
		$a_task =  $lab_obj->TestParamsDetails($t['id']);
		$arr_task = $a_task->FetchRow();
		//$arr_task = $lab_obj->TestParamsDetails($t['id']);
		$first=true;
		$imgprep="";
		if($taskstodo[$t['id']])
		{
			for($i=1;$i<=$count_job;$i++)
			{
				if(!$first) { $imgprep .= '~'; }
				$imgprep .= $parameters[$i]['tasks'][$t['id']];

				if($first)
				{

					$txt.= '<tr class="wardlistrow2" style="background:#ECEFF9 !important; ">
					<td class="j" nowrap>'.$arr_task['name'].'</td><td class="j" nowrap>';
					if($arr_task['lo_bound'] && $arr_task['hi_bound'])
					{
						$txt.=$arr_task['lo_bound'].' - '.$arr_task['hi_bound'];
					}
					$txt.='</td><td class="j" nowrap>'.$arr_task['msr_unit'].'</td>';
					$first=false;
				}
				$txt.= '
				<td class="j" nowrap>&nbsp;';

					if($arr_task['hi_bound']&&$parameters[$i]['tasks'][$t['id']]>$arr_task['hi_bound'])
					{
						$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($parameters[$i]['tasks'][$t['id']]).'</font>';
					}
					elseif($parameters[$i]['tasks'][$t['id']]<$arr_task['lo_bound'])
					{
						$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($parameters[$i]['tasks'][$t['id']]).'</font>';
					}
					else
					{
						$txt.=htmlspecialchars($parameters[$i]['tasks'][$t['id']]);
					}
					$flag=true;

				$txt.='&nbsp;</td>';



			}
	$txt.='</tr>';
				$ptrack++;
				$toggle=!$toggle;
			}
			$tracker++;


}
echo 				$cache.=$txt;

		}


# Show the lab results table from the cache



echo '</table>';

?>
