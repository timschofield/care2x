<?php
/*
 * Created on 05.04.2006
 *
 * Monthly Laboratory Report. Shows summaries of how many tests of what type have been performed in a given month.
 * 
 * Notes:
 * Uses heap temp table to summarize the data hence increases the max_heap_table_size. To prevent
 * timeouts, also sets script timeout to 5 mins instead of default 30 secs.)
 * 
 * The temp table is pupulated *only* with monthly data (vs. earlier implementation that used to fetch all) in order
 * to deal with growing number of total labs: i.e. select (*) from care_test_findings_chemlabor_sub
 * is no longer feasible approach.
 * 
 */


error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$lang_tables[]='date_time.php';
$lang_tables[]='reporting.php';
require($root_path.'include/inc_front_chain_lang.php');

#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_encounter.php');
require_once($root_path.'include/care_api_classes/class_lab.php');
require_once($root_path.'include/care_api_classes/class_tz_selianreporting.php');

/**
 * Getting the timeframe...
 */
 $debug=false;
$PRINTOUT=FALSE;
if (empty($_GET['printout'])) {
	if (empty($_POST['month']) && empty($_POST['year'])) {

		if ($debug) echo "no time value is set, we�re using now the current month<br>";

		$month=date("n",time());
		$year=date("Y",time());

		$start_timeframe = mktime (0,0,0,$month, 1, $year);
		$end_timeframe = mktime (0,0,0,$month+1, 0, $year); // Last day of requested month
	} else {

		if ($debug) echo "Getting an new time range...<br>";
		$start_timeframe = mktime (0,0,0,$_POST['month'], 1, $_POST['year']);
		$end_timeframe = mktime (0,0,0,$_POST['month']+1, 0, $_POST['year']);
	}
} else  {
	$PRINTOUT=FALSE;
} // end of if (empty($_GET['printout']))

if (empty($_POST['group_id']) && empty($_GET['group_id'])) {
	if ($debug) echo "--->Ignition call, setting the requested laboratory group to 1<br>";
	$group_id=1;
} else {
	if ($debug) echo "--->getting an post variable about the requested group id<br>";
	if (empty($_GET['group_id']))
		$group_id=$_POST['group_id'];
	else
		$group_id=$_GET['group_id'];
}


$rep_obj = new selianreport();
$lab_obj=new Lab();
$db->debug=false;

// Prepare for large data fetch
$rep_obj->Transact("SET @@max_heap_table_size=4294967296");
set_time_limit(60*5); //set script timeout to 5 mins

$sql="CREATE TEMPORARY TABLE tmp_laboratory TYPE=HEAP (SELECT
  care_tz_laboratory_tests.parent as GroupID,
  care_tz_laboratory_param.name as GroupName,
  care_tz_laboratory_tests.id as TestNr,
  care_tz_laboratory_tests.id as TestID,
  care_tz_laboratory_param.shortname as TestName,
  care_tz_laboratory_tests.name as FullTestName
	FROM care_tz_laboratory_tests
	INNER JOIN care_tz_laboratory_param ON care_tz_laboratory_param.nr=care_tz_laboratory_tests.parent 
	WHERE is_enabled=1)";

$db->Execute($sql);

$sql="CREATE  TEMPORARY TABLE 
	tmp_laboratory_tests (TestID INT NOT NULL, is_positive INT NOT NULL, date INT NOT NULL ) TYPE=HEAP ";
$db->Execute($sql);

/*
$sql="SELECT nr,paramater_name as serial_value, parameter_value as add_value ,UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) as date 
	FROM care_test_findings_chemlabor_sub INNER JOIN care_tz_laboratory_param
		ON care_test_findings_chemlabor_sub.paramater_name = care_tz_laboratory_param.id 
	ORDER BY care_test_findings_chemlabor_sub.create_time DESC";
*/


//fetch data for requested month ONLY
/*$sql="SELECT nr,paramater_name as serial_value, parameter_value as add_value ,UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) as date 
	FROM care_test_findings_chemlabor_sub INNER JOIN care_tz_laboratory_param
		ON care_test_findings_chemlabor_sub.paramater_name = care_tz_laboratory_param.id
	WHERE UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) >= ".$start_timeframe." 
		AND UNIX_TIMESTAMP(care_test_findings_chemlabor_sub.create_time) <= ".$end_timeframe."
	ORDER BY care_test_findings_chemlabor_sub.create_time DESC";
*/
//NOTE: due to bug in code that does not populate care_test_findings_chemlabor_sub.create_time,
//use lab request create_time instead -- once fixed, switch back to use of result time as in sql above
$sql="SELECT care_tz_laboratory_param.nr,
	res.paramater_name as serial_value, 
	res.parameter_value as add_value ,
	UNIX_TIMESTAMP(req.create_time) as date 
	FROM care_test_findings_chemlabor_sub res INNER JOIN care_tz_laboratory_param
		ON res.paramater_name = care_tz_laboratory_param.id
	INNER JOIN care_test_findings_chemlab req 
		ON res.batch_nr = req.batch_nr and res.encounter_nr = req.encounter_nr and res.job_id = req.job_id
	WHERE UNIX_TIMESTAMP(req.create_time) >= ".$start_timeframe." 
		AND UNIX_TIMESTAMP(req.create_time) <= ".$end_timeframe."
		AND (res.job_id is not null and res.encounter_nr is not null and res.batch_nr is not null)
	ORDER BY req.create_time DESC";

if ($debug) echo $sql;

$db_obj=$db->Execute($sql);
$row=$db_obj->GetArray();
if ($debug) echo "<br/>Total results fetched:".count($row); 
while (list($u,$v)=each($row)){
	//$a =  unserialize($v['serial_value']); // Here we can find the value given to each test-id
	//$b =  unserialize($v['add_value']); // Here we can find the information if it was a check box or not
	//echo "array a:"; print_r($a); echo "<br>";
	//echo "array b:"; print_r($b); echo "<br>";

	$nr = $v['nr'];
	$a = $v['serial_value'];
	$b = $v['add_value'];
	
	if (strpos($a,'+')===0)
		$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$nr.",1,".$v['date'].")";
	else
		$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$nr.",0,".$v['date'].")";
	$db->Execute($sql);
	
	if ($debug) echo date("F j, Y, g:i a", $v['date'])."<br>";

	//echo (strpos($av,'check'))."<br>";
	if (strpos($a,'check')===0)
		$sql="update tmp_laboratory_tests set is_positive=1 where TestID=$nr AND date='$v[date]'";
		//$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$au.",1,".$v['date'].")";
	else
		$sql="update tmp_laboratory_tests set is_positive=0 where TestID=$nr AND date='$v[date]'";
		//$sql="INSERT INTO tmp_laboratory_tests (TestID,is_positive, date) VALUES (".$au.",0,".$v['date'].")";
	$ok = $db->Execute($sql);
	if (!$ok) {
		echo '<br/>Error:'.$db->ErrorMsg();
		echo '<br/>Executing stmt: '.$sql;
		
	}
	if ($debug) echo date("F j, Y, g:i a", $v['date'])."<br>";
}

//totals
$sql_number_of_columns = "SELECT count(*) FROM tmp_laboratory";
$db_prt = $db->Execute($sql_number_of_columns);
$db_row = $db_prt->FetchRow();
$number_of_columns = $db_row[0]; 

function Display_TestGroupSelectItems($group_id) {
	global $db;
	$sql ="SELECT DISTINCT GroupID, GroupName FROM tmp_laboratory  ORDER BY GroupID";
	$db_obj=$db->Execute($sql);
	echo $sql;
	$row = $db_obj->GetArray();
	while (list($u,$v)=each($row)) {

		if ($group_id == $v['GroupID'])
			echo "<option value=".$v['GroupID']." selected>".$v['GroupName']."</option>";
		else
			echo "<option value=".$v['GroupID'].">".$v['GroupName']."</option>";
	}
}



function DisplayLaboratoryTableHead($group_id) {
	global $db;
	global $PRINTOUT;
	// Table definition will be organized by the variable $table_head from here:
	$table_head = "<tr>\n";
	if ($PRINTOUT)
		$table_head .= "<td>&nbsp;</td>\n";
	else
		$table_head .= "<td bgcolor=\"#ffffaa\">&nbsp;</td>\n";

	// Line of all groups
	$sql_groups = "SELECT Count(GroupID) as colspan, GroupName, GroupID FROM tmp_laboratory WHERE GroupID=".$group_id." GROUP BY GroupID";
	$db_prt = $db->Execute($sql_groups);
	$db_array = $db_prt->GetArray();

	while (list($u,$v)=each($db_array)) {
		$table_head .= "<td colspan=\"".$v['colspan']."\" bgcolor=\"#ffffaa\" id=\"".$v['GroupID']."\"> <div align=\"center\"><h1>".$v['GroupName']."</h1></div></td>\n" ;
	}
	$table_head.="</tr>\n<tr>";
	if ($PRINTOUT)
		$table_head .= "<td>day</td>\n";
	else
		$table_head .= "<td bgcolor=\"#CC9933\">Date</td>\n";
	$sql_tests = "SELECT TestID, TestName, FullTestName FROM tmp_laboratory WHERE GroupID=$group_id";
	$db_prt=$db->Execute($sql_tests);
	$db_row=$db_prt->GetArray();
	while (list($u,$v)=each($db_row)) {
		if (empty($v['FullTestName']))
			$testname=$v['TestName'];
		else
			$testname=$v['FullTestName'];
		
		if ($PRINTOUT)
			$table_head .= "<td id=\"".$v['TestID']."\">".$testname."</td>\n" ;
		else
			$table_head .= "<td bgcolor=\"#CC9933\" id=\"".$v['TestID']."\">".$testname."</td>\n" ;
	}

	echo $table_head;
}

function NumberOfTests($TestID,$day_as_timestamp) {
	global $db;
	$debug=false;
	// getting the day: start_time_frame plus day is what we need:
	$start_time = $day_as_timestamp;
	$end_time   = $day_as_timestamp+(24*60*60-1);
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$day_as_timestamp)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(TestID) as number_of_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." )";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_tests']."<br><br>";

	$return_value = $row['number_of_tests'];
	if ($pos=NumberOfPositiveTests($TestID,$day_as_timestamp)) {
	  $return_value .= "($pos+)";
	}
	return $return_value;
}

function NumberOfPositiveTests($TestID,$day_as_timestamp) {
	global $db;
	$debug = false;
	// getting the day: start_time_frame plus day is what we need:
	$start_time = $day_as_timestamp;
	$end_time   = $day_as_timestamp+(24*60*60-1);
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$day_as_timestamp)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(is_positive) as number_of_positive_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." ) AND is_positive=1";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_positive_tests']."<br><br>";
	return $row['number_of_positive_tests'];
}

function NumberOfTestsOfMonth($TestID,$start_time) {
	global $db;
	$debug=FALSE;
	if (empty($TestID)) return "-1";
	$end_time = mktime(0,0,0,date("n",$start_time)+1,1,date("Y",$start_time))-1;
	// getting the day: start_time_frame plus day is what we need:
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$start_time)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(TestID) as number_of_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." )";
	if ($debug) echo $sql."<br>";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_tests']."<br><br>";
	$return_value = $row['number_of_tests'];
	if ($pos=NumberOfPositiveTestsOfMonth($TestID,$start_time)) {
	  $return_value .= "($pos+)";
	}
	return $return_value;
}

function NumberOfPositiveTestsOfMonth($TestID,$start_time) {
	global $db;
	$debug = FALSE;
	$end_time = mktime(0,0,0,date("n",$start_time)+1,1,date("Y",$start_time))-1;
	// getting the day: start_time_frame plus day is what we need:
	if ($debug) echo "Looking for test $TestID by time range: day: ".date("d.m.y",$start_time)." starttime: ".date("d.m.y :: G:i:s",$start_time)." endtime: ".date("d.m.y :: G:i:s",$end_time)."<br>";
	$sql = "Select Count(is_positive) as number_of_positive_tests FROM tmp_laboratory_tests WHERE TestID=".$TestID." AND ( ".$start_time." <= date AND date <= ".$end_time." ) AND is_positive=1";
	$db_ptr = $db->Execute($sql);
	$row = $db_ptr->FetchRow();
	if ($debug) echo "hits:".$row['number_of_positive_tests']."<br><br>";
	return $row['number_of_positive_tests'];
}


function _get_requested_day($start_time_frame, $day) {
	/**
	 * Private function: getting the exact date, beginning with start_time_frame (UNIX timestamp)
	 * adding the value given in the variable "day"
	 * Return value is an UNIX-Timestamp
	 */
	 $sec_to_add = $day * 24 * 60 * 60;
	 return $requested_day = $start_time_frame + $sec_to_add;
}

function DisplayLaboratoryTestSummary($group_id, $start_time_frame, $end_time_frame) {
	global $db;
	global $PRINTOUT;
	global $LDShowentriesinthetimeof, $LDtill;

	$table ="<tr>\n";
	echo $LDShowentriesinthetimeof." <b>".date("F j, Y",$start_time_frame)."</b> ".$LDtill." <b>".date("F j, Y",$end_time_frame)."</b><br>";

	$first_day_of_req_month = date ("d",$start_time_frame);
	$last_day_of_req_month = date ("d",$end_time_frame);

	// is "today" between start_time_frame and end_time_frame - or even older??
	$SHOW_ITALIC=FALSE;
	if (($start_time_frame<time() && $end_time_frame) || $start_time_frame>time())
		$SHOW_ITALIC=TRUE; // Yes, then we should might display it in italic ...

	for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
		$current_day = _get_requested_day($start_time_frame, $day-1);

		$table.="<tr>\n";
		if ($current_day > time())
			if ($PRINTOUT)
				$table .= "<td><i>".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</i></td>\n";
			else
				$table .= "<td bgcolor=\"#ffffff\"><i>".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</i></td>\n";
		else
			$table .= "<td bgcolor=\"#ffffaa\">".date("j/m/Y",_get_requested_day($start_time_frame, $day-1))."</td>\n";

		$sql = "SELECT TestID FROM tmp_laboratory WHERE GroupID=".$group_id;

		$db_ptr=$db->Execute($sql);
		$arr_ret = $db_ptr -> GetArray();
		while (list($u,$v)=each($arr_ret)) {
			if (empty($v['TestID'])) {
				$number_of_hits = "-1";
			} else {
				$number_of_hits = NumberOfTests($v['TestID'],_get_requested_day($start_time_frame, $day-1));
			}
			$amount_string = "0";
			if ($number_of_hits>0)
				$amount_string = "<b>$number_of_hits</b>";
			else
				$amount_string = "0";

			if ($current_day > time())
				if ($PRINTOUT)
					$table .= "<td id=\"".$v['TestID']."\" align=\"center\">--</td>\n";
				else
					$table .= "<td bgcolor=\"#ffffff\" id=\"".$v['TestID']."\" align=\"center\">--</td>\n";
			else
				$table .= "<td bgcolor=\"#ffffaa\" id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
		}
		$table .="</tr>\n";
	}

	echo $table;
}

function DisplayResultRow($group_id, $start_time_frame, $end_time_frame) {
	global $db;
	global $PRINTOUT;
	$table ="<tr>\n";
	$first_day_of_req_month = date ("d",$start_time_frame);
	$last_day_of_req_month = date ("d",$end_time_frame);

	$table.="<tr>\n";
	$table .= "<td bgcolor=\"#CC9933\" align = \"center\"><strong>&sum;</strong></td>\n";
	$sql = "SELECT TestID FROM tmp_laboratory WHERE GroupID=".$group_id;
	$db_ptr=$db->Execute($sql);
	$arr_ret = $db_ptr -> GetArray();
	while (list($u,$v)=each($arr_ret)) {
		$number_of_hits = NumberOfTestsOfMonth($v['TestID'],$start_time_frame);
		$amount_string = "0";
		if ($number_of_hits>0)
			$amount_string = "<b>$number_of_hits</b>";
		if ($PRINTOUT)
			$table .= "<td id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
		else
			$table .= "<td bgcolor=\"#CC9933\" id=\"".$v['TestID']."\" align=\"center\">".$amount_string."</td>\n";
	}
	$table .="</tr>\n";

	echo $table;
}



require_once('include/inc_timeframe.php');

require_once('gui/gui_laboratory.php');
?>
