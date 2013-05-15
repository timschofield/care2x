<?php
/**
* Care2x API package
* @package care_api
*/

/**
* selian reporting methods.
* Note this class should be instantiated only after a "$db" adodb  connector object
* has been established by an adodb instance
* @author Robert Meggle (www.MEROTECH.de: meggle@merotech.de)
* @version beta 0.0.1
* @copyright 2006 Robert Meggle, based on the development of Elpidio Latorilla
* @package care_api
*/

/*
Rewritten and Modified by Moye Masenga moyejm@gmail.com for insurance handling and billing
20-12-2009
06-04-2011
04-08-2011
*/

require_once($root_path.'include/care_api_classes/class_tz_billing.php');

/**
* Include the class_report if it�s not done so far...
*/
require_once($root_path.'include/care_api_classes/class_report.php');

/**
* Class and its members..
*/
class selianreport extends report {

  /**
  * constructor
  */
  function class_selianreport() {
    global $db;
    $this->debug=FALSE;
    $this->debug==TRUE ? $db->debug=TRUE : $db->debug=FALSE;
	}

	function GetPIDOfLaspedContract($days='') {
	  global $db;
    $rep_obj = new report();
    $tmp_reporting_table_1 = $rep_obj -> SetReportingLink('care_tz_insurance','PID','care_person','pid');
    $tmp_reporting_table_2 = $rep_obj -> TMP_GroupBy($tmp_reporting_table_1,'care_tz_insurance_PID');
    $rep_obj -> DisconnectReportingTable($tmp_reporting_table_1);

    $now = time();
    $seconds = $days * 24 * 60;
    $asked_time = $now-$seconds;

    $this->setTable($tmp_reporting_table_2);
    $this->sql="SELECT selian_pid, date_reg, name_first, name_2, name_3, name_middle, name_last, name_maiden, name_others FROM $this->coretable WHERE end_date < $asked_time";
    $mysql_ptr = $db->Execute($this->sql);
	}

	//------------------------------------------------------------------------------------------------------------------------

	function Display_OPD_Diagnostic($start,$end) {
	global $db;
	global $PRINTOUT;
	global $LDNoDiagnosticsResults;
	$rep_obj = new selianreport();
	$debug=FALSE;
	($debug)?$db->debug=TRUE:$db->debug=FALSE;
	$sql_timeframe = "  ( timestamp>=".$start." AND timestamp<=".$end.") ";

	$tmp_tbl_OPD_diagnostic = $rep_obj -> SetReportingLink('care_person','pid', 'care_tz_diagnosis','PID');

	// get the Diagnostic-Codes, Diagnostic-full-name and total out of this table:
	$sql = "SELECT ICD_10_code, ICD_10_description, UNIX_TIMESTAMP(date_birth) as date_birth
				FROM $tmp_tbl_OPD_diagnostic WHERE $sql_timeframe
				group by ICD_10_code";

	if ($rs_ptr = $db->Execute($sql))
		$res_array = $rs_ptr->GetArray();

	if (!$res_array) echo "<font color=\"red\">".$LDNoDiagnosticsResults."</font><br><br>";

	$SHOW_COLORS = $printout ? TRUE : FALSE;
	$bg_col_marker=TRUE;

	while (list ($i,$v)=each($res_array)) {
		if ($SHOW_COLORS) {
			if ($bg_col_marker) {
				echo "<tr bgcolor=#ffffaa>";
				$bg_col_marker = FALSE;
			} else {
				echo "<tr bgcolor=#ffffdd>";
				$bg_col_marker = TRUE;
			}
		}
		$icd_10_code = $v['ICD_10_code'];
		$icd_10_description = $v['ICD_10_description'];
		echo "<td>$icd_10_code</td>";
		echo "<td>$icd_10_description</td>";

		/**
		 * Amount by age
		 */


		$sql = "SELECT count(date_birth) as total From $tmp_tbl_OPD_diagnostic WHERE
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total = $row['total'];



		$sql = "SELECT count(date_birth) as total_under_age From $tmp_tbl_OPD_diagnostic WHERE
					UNIX_TIMESTAMP(date_birth) <= (now() - DATE_SUB(UNIX_TIMESTAMP(date_birth), INTERVAL 5 year))
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_under_age =  $row['total_under_age'];

		$total_over_age = $total - $total_under_age;

		echo "<td>$total_under_age</td>";
		echo "<td>$total_over_age</td>";


		/**
		 * Amount by sex
		 */

		$sql = "SELECT count(date_birth) as total_female From $tmp_tbl_OPD_diagnostic WHERE
					sex='f'
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_female =  $row['total_female'];

		$sql = "SELECT count(date_birth) as total_male From $tmp_tbl_OPD_diagnostic WHERE
					sex='m'
			    AND
			    	ICD_10_code='".$icd_10_code."' AND $sql_timeframe";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$total_male =  $row['total_male'];

		echo '<td width="69">'.$total_male.'</td>';
		echo '<td width="69">'.$total_female.'</td>';
		echo '<td>'.$total.'</td>';
		echo '</tr>';
		}
		$rep_obj->DisconnectReportingTable($tmp_tbl_OPD_diagnostic);
		return 1;
	}


	//------------------------------------------------------------------------------------------------------------------------

	function Display_OPD_Summary($start,$end) {
		global $db;

		$WITH_TIMEFRAME=FALSE;

		if (func_num_args()) {

			$start=func_get_arg(0);
			$end=func_get_arg(1);
			$WITH_TIMEFRAME=TRUE;
		}


		$rep_obj = new selianreport();

		$tmp_tbl_OPD_summary = $rep_obj -> SetReportingLink('care_person','pid', 'care_tz_diagnosis','PID');
		//$tmp_tbl_allpatients = $rep_obj -> SetReportingTable('care_person');

		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$arr_ret['return']['underage'];
		$arr_ret['return']['adult'];
		$arr_ret['return']['male'];
		$arr_ret['return']['female'];
		$arr_ret['return']['total'];

		$arr_ret['NewRegistration']['underage'];
		$arr_ret['NewRegistration']['adult'];
		$arr_ret['NewRegistration']['male'];
		$arr_ret['NewRegistration']['female'];
		$arr_ret['NewRegistration']['total'];

		$arr_ret['Total']['underage'];
		$arr_ret['Total']['adult'];
		$arr_ret['Total']['male'];
		$arr_ret['Total']['female'];
		$arr_ret['Total']['total'];

		$arr_ret['Total_Pedriatics']['underage'];

		$arr_ret['revisit']['underage'];
		$arr_ret['revisit']['adult'];
		$arr_ret['revisit']['male'];
		$arr_ret['revisit']['female'];
		$arr_ret['revisit']['total'];

		/****************************************************************************************************
		 *  Revisit�s under 5
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='new' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year))) ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['underage'] =  $row['return_underage'];

		/**
		 * Total revisits
		 */
		$sql = "SELECT count(*) AS total FROM $tmp_tbl_OPD_summary
					   WHERE type='new'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['total'] =  $row['total'];

		/**
		 * Revist�s over 5
		 */
		$arr_ret['return']['adult'] = $arr_ret['return']['total'] - $arr_ret['return']['underage'];

		/**
		 * Total male revisits
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='new' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['male'] =  $row['male'];

		/**
		 * Total female revisits
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='new' and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['return']['female'] =  $row['female'];


		/****************************************************************************************************
		 *  New Registration�s under 5
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['underage'] =  $row['return_underage'];

		/**
		 * Total New Registration
		 */
		$sql = "SELECT count(*) AS Total FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['total'] =  $row['Total'];

		/**
		 * New Registration�s over 5
		 */
		$arr_ret['NewRegistration']['adult'] = $arr_ret['NewRegistration']['total'] - $arr_ret['NewRegistration']['underage'];

		/**
		 * Total male New Registration
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['male'] =  $row['male'];

		/**
		 * Total female New Registration
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='new patient'  and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['NewRegistration']['female'] =  $row['female'];

		/****************************************************************************************************
		 *  Total Registration�s under 5
		 */

		$sql = "SELECT count(*) AS Total_underage FROM $tmp_tbl_OPD_summary
					   WHERE UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND (timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['underage'] =  $row['Total_underage'];

		/**
		 * Total New Registration
		 */
		$sql = "SELECT count(*) AS Total FROM $tmp_tbl_OPD_summary ";
		if ($WITH_TIMEFRAME) $sql.=" WHERE ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['total'] =  $row['Total'];

		/**
		 * New Registration�s over 5
		 */
		$arr_ret['Total']['adult'] = $arr_ret['Total']['total'] - $arr_ret['Total']['underage'];

		/**
		 * Total male New Registration
		 */
		$sql = "SELECT count(*) AS Total_male FROM $tmp_tbl_OPD_summary
					   WHERE sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['male'] =  $row['Total_male'];

		/**
		 * Total female New Registration
		 */
		$sql = "SELECT count(*) AS Total_female FROM $tmp_tbl_OPD_summary
					   WHERE sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total']['female'] =  $row['Total_female'];

		/**
		 * **************************************************************************************************
		 * Total Pedriatics
		 */
		$sql = "SELECT count(*) AS Total_underage FROM $tmp_tbl_OPD_summary
					   WHERE UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";

		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['Total_Pedriatics']['underage'] =  $row['Total_underage'];

		/****************************************************************************************************
		 *  Views for the same reasons:
		 */

		$sql = "SELECT count(*) AS return_underage FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' AND UNIX_TIMESTAMP(date_birth) > (UNIX_TIMESTAMP(DATE_SUB(CURDATE(), INTERVAL 5 year)))
		       ";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['underage'] = (empty($row['return_underage'])) ? 0 : $row['return_underage'];
		//$arr_ret['revisit']['underage'] =  $row['return_underage'];

		/**
		 * Total revisits
		 */
		$sql = "SELECT count(*) AS total FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['total'] =  (empty($row['total']))? 0 : $row['total'];

		/**
		 * Revist�s over 5
		 */
		$arr_ret['revisit']['adult'] = $arr_ret['revisit']['total'] - $arr_ret['revisit']['underage'];

		/**
		 * Total male revisits
		 */
		$sql = "SELECT count(*) AS male FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' and sex='m'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['male'] =  (empty($row['male'])) ? 0 : $row['male'];

		/**
		 * Total female revisits
		 */
		$sql = "SELECT count(*) AS female FROM $tmp_tbl_OPD_summary
					   WHERE type='revisit' and sex='f'";
		if ($WITH_TIMEFRAME) $sql.=" AND ( timestamp>=".$start." AND timestamp<=".$end.")";
		$sql .= " GROUP BY ICD_10_code";


		$rs_ptr = $db->Execute($sql);
		$row=$rs_ptr->FetchRow();
		$arr_ret['revisit']['female'] =  (empty($row['female'])) ? 0 : $row['female'];

	$rep_obj->DisconnectReportingTable($tmp_tbl_OPD_summary);

	return $arr_ret;

	}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Laboratory-Section
	 */
	//------------------------------------------------------------------------------------------------------------------------

	function GetAllLaboratorySections() {

	}

	//------------------------------------------------------------------------------------------------------------------------
	function Display_Billing_Summary() {

	}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Billing-Section
	 */
	//--
    function DisplayBillingTableHead(){
    	global $PRINTOUT;
    	global $LDDailyRevenueReport,$LDDate,$LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,
$LDImaging,$LDOther,$LDTotal;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\">".$LDDailyRevenueReport."</td>\n";
		else
			$table_head .= "<td colspan=\"18\" align=\"center\">".$LDDailyRevenueReport."</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDAdvance."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDBed."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDMort."</td>\n" ;
			$table_head .= "<td>".$LDMinProc."</td>\n" ;
			$table_head .= "<td>".$LDProcSurg."</td>\n" ;
			$table_head .= "<td>".$LDImaging."</td>\n" ;
			$table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }




function DisplayCashBillingTableHead($admission){
    	global $PRINTOUT;
    	global $LDDailyCashFinancialRecord,$LDDate,$LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,
$LDImaging,$LDOther,$LDTotal;

		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"19\" align=\"center\">Cash Financial Summary : $admissionclass </td>\n";
		else
			$table_head .= "<td colspan=\"19\" align=\"center\">Cash  Financial Summary : $admissionclass </td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDAdvance."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDBed."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDLab."</td>\n" ;
			$table_head .= "<td>".$LDMort."</td>\n" ;
			$table_head .= "<td>".$LDMinProc."</td>\n" ;
			$table_head .= "<td>".$LDProcSurg."</td>\n" ;
			$table_head .= "<td>".$LDImaging."</td>\n" ;
			$table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }
	
function DisplayCashReceiptsTableHead($admission){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDBillNo,$LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,
$LDImaging,$LDOther,$LDTotal;

		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"19\" align=\"center\"> $admissionclass Cash Receipts Summary </td>\n";
		else
			$table_head .= "<td colspan=\"19\" align=\"center\"> $admissionclass Cash  Receipts Summary</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBillNo."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDBillNo."</td>\n" ;
			$table_head .= "<td>".$LDAdvance."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDBed."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDLab."</td>\n" ;
			$table_head .= "<td>".$LDMort."</td>\n" ;
			$table_head .= "<td>".$LDMinProc."</td>\n" ;
			$table_head .= "<td>".$LDProcSurg."</td>\n" ;
			$table_head .= "<td>".$LDImaging."</td>\n" ;
			$table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }

function DisplayInsuranceBillingTableHead($admission){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDAmb,$LDAdvance,$LDBed,$LDConsult,$LDConsum,
    	       $LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort, $LDMinProc,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\">Insurance Financial Summary : $admissionclass </td>\n";
		else
			$table_head .= "<td colspan=\"18\" align=\"center\">Insurance  Financial Summary : $admissionclass </td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDAdvance."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDBed."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDLab."</td>\n" ;
                        $table_head .= "<td>".$LDMort."</td>\n" ;
			$table_head .= "<td>".$LDMinProc."</td>\n" ;
                        $table_head .= "<td>".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td>".$LDImaging."</td>\n" ;
                        $table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }


function DisplayInsuranceCompanyBillingTableHead($insurance_id,$admission){
	global $db;
        global $PRINTOUT;
        global $LDDailyFinancialRecordOPD,$LDDate,$LDPatient,$LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,
               $LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

                // Table definition will be organized by the variable $table_head from here:

                // headline:

		$sql_insurancename="SELECT name FROM care_tz_company where id='$insurance_id'";

		$insurance_name = $db->Execute($sql_insurancename);

		$sql_insurancename =  $insurance_name->FetchRow();

		$insurancename = $sql_insurancename['name'];

                $table_head = "<tr>\n";
                if (!$PRINTOUT)
                        $table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"19\" align=\"center\"> $admissionclass Financial Summary for $insurancename </td>\n";
                else
                        $table_head .= "<td colspan=\"19\" align=\"center\"> $admissionclass Financial Summary for $insurancename </td>\n";
                $table_head.="</tr>\n";

                $table_head.="<tr>\n";
                if (!$PRINTOUT) {
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDPatient."</td>\n" ;
				   $table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                } else {
						$table_head .= "<td>".$LDDate."</td>\n";
						$table_head .= "<td>".$LDPatient."</td>\n" ;
				   		$table_head .= "<td>".$LDAdvance."</td>\n" ;
                        $table_head .= "<td>".$LDAmb."</td>\n" ;
                        $table_head .= "<td>".$LDBed."</td>\n" ;
						$table_head .= "<td>".$LDConsult."</td>\n" ;
                        $table_head .= "<td>".$LDConsum."</td>\n" ;
                        $table_head .= "<td>".$LDDental."</td>\n" ;
                        $table_head .= "<td>".$LDDrugs."</td>\n" ;
						$table_head .= "<td>".$LDEye."</td>\n" ;
				   		$table_head .= "<td>".$LDFile."</td>\n" ;
                        $table_head .= "<td>".$LDICU."</td>\n" ;
                        $table_head .= "<td>".$LDLab."</td>\n" ;
                        $table_head .= "<td>".$LDMort."</td>\n" ;
						$table_head .= "<td>".$LDMinProc."</td>\n" ;
                        $table_head .= "<td>".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td>".$LDImaging."</td>\n" ;
						$table_head .= "<td>".$LDOther."</td>\n" ;
                        $table_head .= "<td>".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                }
                echo $table_head;

    }
	
function DisplayCompaniesBillingTableHead($admission){
	global $db;
        global $PRINTOUT;
        global $LDDailyFinancialRecordOPD,$LDCompany,$LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,
               $LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

                // Table definition will be organized by the variable $table_head from here:

                // headline:

                $table_head = "<tr>\n";
                if (!$PRINTOUT)
                        $table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\"> $admissionclass Financial Summary for all Companies </td>\n";
                else
                        $table_head .= "<td colspan=\"18\" align=\"center\"> $admissionclass Financial Summary for all Companies </td>\n";
                $table_head.="</tr>\n";

                $table_head.="<tr>\n";
                if (!$PRINTOUT) {
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDCompany."</td>\n";
				   		$table_head .= "<td bgcolor=\"#CC9933\">".$LDAdvance."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                } else {
			
						$table_head .= "<td>".$LDCompany."</td>\n" ;
				   		$table_head .= "<td>".$LDAdvance."</td>\n" ;
                    	$table_head .= "<td>".$LDAmb."</td>\n" ;
                    	$table_head .= "<td>".$LDBed."</td>\n" ;
						$table_head .= "<td>".$LDConsult."</td>\n" ;
                        $table_head .= "<td>".$LDConsum."</td>\n" ;
                        $table_head .= "<td>".$LDDental."</td>\n" ;
                        $table_head .= "<td>".$LDDrugs."</td>\n" ;
						$table_head .= "<td>".$LDEye."</td>\n" ;
				   		$table_head .= "<td>".$LDFile."</td>\n" ;
                        $table_head .= "<td>".$LDICU."</td>\n" ;
                        $table_head .= "<td>".$LDLab."</td>\n" ;
                        $table_head .= "<td>".$LDMort."</td>\n" ;
						$table_head .= "<td>".$LDMinProc."</td>\n" ;
                        $table_head .= "<td>".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td>".$LDImaging."</td>\n" ;
						$table_head .= "<td>".$LDOther."</td>\n" ;
                        $table_head .= "<td>".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                }
                echo $table_head;

    }


function DisplayPendingQuotationsTableHead($admission,$pricelist) {
	    global $db;
        global $PRINTOUT;
        global $LDPendingQuotationsReport,$LDDate,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental, $LDDrugs,$LDEye,$LDFile,$LDICU,
               $LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		$bill_obj = New Bill;
		$price_detail = $bill_obj->getPriceDescription($pricelist);
		
		$admissionclass="";
		
		if($admission==2)
		{
		$admissionclass="Outpatient";
		}
		else 
		if($admission==1)
		{
		$admissionclass="Inpatient";
		}
		else
		$admissionclass="All";

		$table_head = "<tr>\n";
                if (!$PRINTOUT) 
		$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\">  $admissionclass Pending Quotations Report assuming $price_detail pricelist</td>\n";
                else
                        $table_head .= "<td colspan=\"18\" align=\"center\"> $admissionclass Pending Quotations Report assuming $price_detail pricelist </td>\n";
                $table_head.="</tr>\n";

                $table_head.="<tr>\n";
                if (!$PRINTOUT) {
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
						$table_head .= "<td bgcolor=\"#CC9933\">".$LDMinProc."</td>\n";
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                }
				 else {
						$table_head .= "<td>".$LDDate."</td>\n";
                        $table_head .= "<td>".$LDAmb."</td>\n" ;
                        $table_head .= "<td>".$LDBed."</td>\n" ;
						$table_head .= "<td>".$LDConsult."</td>\n" ;
                        $table_head .= "<td>".$LDConsum."</td>\n" ;
                        $table_head .= "<td>".$LDDental."</td>\n" ;
                        $table_head .= "<td>".$LDDrugs."</td>\n" ;
						$table_head .= "<td>".$LDEye."</td>\n" ;
						$table_head .= "<td>".$LDFile."</td>\n" ;
                        $table_head .= "<td>".$LDICU."</td>\n" ;
                        $table_head .= "<td>".$LDLab."</td>\n" ;
                        $table_head .= "<td>".$LDMort."</td>\n" ;
						$table_head .= "<td>".$LDMinProc."</td>\n";
                        $table_head .= "<td>".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td>".$LDImaging."</td>\n" ;
						$table_head .= "<td>".$LDOther."</td>\n" ;
                        $table_head .= "<td>".$LDTotal."</td>\n" ;
                        $table_head.="</tr>\n";
                }
                echo $table_head;

    }

function DisplayDeletedQuotationsTableHead($pricelist) {
	global $db;
        global $PRINTOUT;
        global $LDDeletedQuotationsReport,$LDDate,$LDDescription,$LDPrice,$LDNoOfItems,$LDTotal,$LDCashier,$LDDeleteDate;

	$bill_obj =New Bill;
	$price_details = $bill_obj->getPriceDescription($pricelist);

$table_head = "<tr>\n";
                if (!$PRINTOUT)
                        $table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"7\" align=\"center\"> Deleted Quotations Report assuming $price_details pricelist</td>\n";
						
                else
				
                        $table_head .= "<td colspan=\"7\" align=\"center\">Deleted Quotations Report assuming $price_details pricelist.</td>\n";
                $table_head.="</tr>\n";
				
                $table_head.="<tr>\n";
                if (!$PRINTOUT) {
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
		 	        	$table_head .= "<td bgcolor=\"#CC9933\">".$LDDescription."</td>\n";
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDPrice."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDNoOfItems."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
 	    		    	$table_head .= "<td bgcolor=\"#CC9933\">".$LDCashier."</td>\n" ;
						$table_head	.= "<td bgcolor=\"#CC9933\">".$LDDeleteDate."</td>\n";

	        $table_head.="</tr>\n";
                } else {
				
	       		$table_head .= "<td>".$LDDate."</td>\n";
	       		$table_head .= "<td>".$LDDescription."Description</td>\n" ;
				$table_head .= "<td>".$LDPrice."Price</td>\n" ;
                $table_head .= "<td>".$LDNoOfItems."No.Of Items</td>\n" ;
                $table_head .= "<td>".$LDTotal."</td>\n" ;
                $table_head .= "<td>".$LDCashier."Cashier</td>\n" ;
				$table_head	.= "<td>".$LDDeleteDate."Delete Date</td>\n";
	        	$table_head.="</tr>\n";
                }
                echo $table_head;
				
    }

function DisplayPrepaidFinancialTableHead(){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDInvoice,$LDFileTSH,$LDMatTSH,$LDLabTSH,
    	       $LDXRayTSH,$LDDawaTSH,$LDProcSurgTSH,$LDDressTSH,$LDMengTSH,$LDJumlaTSH;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"12\" align=\"center\">Insurance Receipt-General Financial Summary</td>\n";
		else
			$table_head .= "<td colspan=\"12\" align=\"center\">Insurance Receipt-General Financial Summary</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">Organization</td>\n" ;
//			$table_head .= "<td bgcolor=\"#CC9933\">".$LDInvoice."/td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFileTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMatTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLabTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDXRayTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDawaTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurgTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDressTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMengTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDJumlaTSH."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDInvoice."Invoice</td>\n" ;
			$table_head .= "<td>".$LDFileTSH."File(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMatTSH."Mat(TSH)</td>\n" ;
			$table_head .= "<td>".$LDLabTSH."Lab(TSH)</td>\n" ;
			$table_head .= "<td>".$LDXRayTSH."X-Ray(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDawaTSH."Dawa(TSH)</td>\n" ;
			$table_head .= "<td>".$LDProcSurgTSH."Proc/Surg(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDressTSH."Dress(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMengTSH."Meng(TSH)</td>\n" ;
			$table_head .= "<td>".$LDJumlaTSH."Jumla(TSH)</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }




function DisplayDentalPrepaidFinancialTableHead(){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDInvoice,$LDFileTSH,$LDMatTSH,$LDLabTSH,
    	       $LDXRayTSH,$LDDawaTSH,$LDProcSurgTSH,$LDDressTSH,$LDMengTSH,$LDJumlaTSH;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"12\" align=\"center\">Dental Insurance Financial Summary</td>\n";
		else
			$table_head .= "<td colspan=\"12\" align=\"center\">Dental Insurance Financial Summary</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">Organization</td>\n" ;
//			$table_head .= "<td bgcolor=\"#CC9933\">".$LDInvoice."/td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFileTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMatTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLabTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDXRayTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDawaTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurgTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDressTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDMengTSH."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">Dental</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDJumlaTSH."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDInvoice."Invoice</td>\n" ;
			$table_head .= "<td>".$LDFileTSH."File(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMatTSH."Mat(TSH)</td>\n" ;
			$table_head .= "<td>".$LDLabTSH."Lab(TSH)</td>\n" ;
			$table_head .= "<td>".$LDXRayTSH."X-Ray(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDawaTSH."Dawa(TSH)</td>\n" ;
			$table_head .= "<td>".$LDProcSurgTSH."Proc/Surg(TSH)</td>\n" ;
			$table_head .= "<td>".$LDDressTSH."Dress(TSH)</td>\n" ;
			$table_head .= "<td>".$LDMengTSH."Meng(TSH)</td>\n" ;
			$table_head .= "<td>".$LDJumlaTSH."Jumla(TSH)</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }



/**
	 * ARV-Billing-Section
	 */
	//--
    function DisplayARVBillingTableHead(){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecordOPD,$LDDate,$LDPatientName,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDress,$LDDrugs,$LDEye,
    	       $LDFile,$LDICU,$LDLab,$LDMort,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\">DailyFinancialRecord ART Fund</td>\n";
		else
			$table_head .= "<td colspan=\"18\" align=\"center\">DailyFinancialRecord ART Fund</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">Patient Name/ID</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDPatientName."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDLab."</td>\n" ;
                        $table_head .= "<td>".$LDMort."</td>\n" ;
                        $table_head .= "<td>".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td>".$LDImaging."</td>\n" ;
                        $table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

    }

	function DisplayTBBillingTableHead(){
    	global $PRINTOUT;
    	global $LDDailyFinancialRecord,$LDDate,$LDPatientName,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,
    	       $LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		// Table definition will be organized by the variable $table_head from here:

		// headline:
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"18\" align=\"center\">DailyFinancialRecord TB Fund</td>\n";
		else
			$table_head .= "<td colspan=\"18\" align=\"center\">DailyFinancialRecord TB Fund</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		if (!$PRINTOUT) {
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDate."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">Patient Name/ID</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmb."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDBed."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsult."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDConsum."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDental."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugs."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDEye."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDFile."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDICU."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDLab."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDMort."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDProcSurg."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDImaging."</td>\n" ;
                        $table_head .= "<td bgcolor=\"#CC9933\">".$LDOther."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head .= "<td>".$LDDate."</td>\n";
			$table_head .= "<td>".$LDPatientName."</td>\n" ;
			$table_head .= "<td>".$LDAmb."</td>\n" ;
			$table_head .= "<td>".$LDBed."</td>\n" ;
			$table_head .= "<td>".$LDConsult."</td>\n" ;
			$table_head .= "<td>".$LDConsum."</td>\n" ;
			$table_head .= "<td>".$LDDental."</td>\n" ;
			$table_head .= "<td>".$LDDrugs."</td>\n" ;
			$table_head .= "<td>".$LDEye."</td>\n" ;
			$table_head .= "<td>".$LDFile."</td>\n" ;
			$table_head .= "<td>".$LDICU."</td>\n" ;
			$table_head .= "<td>".$LDLab."</td>\n" ;
            $table_head .= "<td>".$LDMort."</td>\n" ;
            $table_head .= "<td>".$LDProcSurg."</td>\n" ;
            $table_head .= "<td>".$LDImaging."</td>\n" ;
            $table_head .= "<td>".$LDOther."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;

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

	function _get_amount_of($start_timeframe,$day,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {
			
			case "amb": //
				if ($debug) echo "amb<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "bed": //Consultation
				if ($debug) echo "bed<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "consult": //Consultation
				if ($debug) echo "consult<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "consum": //Consumables
				if ($debug) echo "consum<br>";

				$sql_filter="WHERE purchasing_class='supplies' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "drugs":
                 if ($debug) echo "drugs<br>";
                 $sql_filter="WHERE (  purchasing_class='drug_list') AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
                                break;
				
			case "eye": //eye patients
				if ($debug) echo "eye<br>";
				$sql_filter="WHERE (purchasing_class='eye-service' OR purchasing_class='eye-surgery') AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			
			case "icu":
				if ($debug) echo $LDICU."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "lab":
				if ($debug) echo $LDLab."<br>";
				$sql_filter="WHERE purchasing_class='labtest' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "minproc":
                if ($debug) echo $LDMinProc."<br>";
                $sql_filter="WHERE purchasing_class='minor_proc_op' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
                break;
	
			case "proc/surg":
				if ($debug) echo "proc/surg<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "radio"://returns
				if ($debug) echo "radio<br>";
   				$sql_filter="WHERE purchasing_class='xray' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "other"://returns
			// returns: all other items 
				if ($debug) echo "other<br>";
   				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies'
				AND purchasing_class!='service'
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE $curr_day_start <=date_change AND $curr_day_end>=date_change"; // count of all
				break;
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}


	function _get_cash_amount_of($start_timeframe,$day,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {
		
			case "amb": 
				if ($debug) echo "amb<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "bed": 

				if ($debug) echo "bed<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "consult": //Consultation
				if ($debug) echo $LDConsult."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";

				break;
				
			case "consum": //Consultation
				if ($debug) echo $LDConsum."<br>";
				$sql_filter="WHERE purchasing_class='supplies'  
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";

				break;
			
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental'  
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "drugs":
				$sql_filter="WHERE (purchasing_class='drug_list') 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "eye":
				$sql_filter="WHERE (purchasing_class='eye-service' OR purchasing_class='eye-surgery') 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			
			case "icu": 
				if ($debug) echo "icu<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "lab":
				if ($debug) echo $LDLab."<br>";
				// start und ende timeframe fehlt noch!
				$sql_filter="WHERE purchasing_class='labtest' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				// start und ende timeframe fehlt noch!
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
			
			 case "minproc":
                if ($debug) echo $LDMinProc."<br>";
                $sql_filter="WHERE purchasing_class='minor_proc_op' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
                break;
				
			case "proc/surg":
				if ($debug) echo "proc/surg<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "radio":
				if ($debug) echo "Radio<br>";
				$sql_filter="WHERE purchasing_class='xray' 
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
				
			case "other"://returns
			// returns: all patients, what got the service item R02
				if ($debug) echo "other<br>";
   				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service' 
				AND purchasing_class!='dental' 
				AND purchasing_class!='service'
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;

			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE $curr_day_start <=date_change   AND $curr_day_end>=date_change
				AND (insurance_id=0 OR insurance_id='' OR insurance_id='NULL')"; // count of all
				break;
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}



function _get_insurance_amount_of($start_timeframe,$day,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {

			case "amb": 
				if ($debug) echo "amb<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "bed": 
				if ($debug) echo $LDBed."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";

				break;
				
			case "consult":
				if ($debug) echo "consult<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;				
				
			case "consum":
				if ($debug) echo "consum<br>";
				$sql_filter="WHERE  purchasing_class='supplies' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "drugs":
				if ($debug) echo "drugs<br>";
				$sql_filter="WHERE ( purchasing_class='drug_list') 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "eye":
				if ($debug) echo "eye<br>";
				$sql_filter="WHERE ( purchasing_class='eye-service' OR purchasing_class='eye-surgery') 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			
			case "file":
				if ($debug) echo "file<br>";

   				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "icu":
				if ($debug) echo "icu<br>";

   				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "lab":
				if ($debug) echo $LDLab."<br>";
				// start und ende timeframe fehlt noch!
				$sql_filter="WHERE purchasing_class='labtest' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				// start und ende timeframe fehlt noch!
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
			
			 case "minproc":
                if ($debug) echo $LDMinProc."<br>";
                $sql_filter="WHERE purchasing_class='minor_proc_op' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
                break;
	
			case "proc/surg":
				if ($debug) echo "proc/surg<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			
			case "radio":
				if ($debug) echo "radio<br>";
				$sql_filter="WHERE purchasing_class='xray' 
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
					
			case "other":
				if ($debug) echo "other<br>";
				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service' 
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND insurance_id!='0' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;

			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE $curr_day_start <=date_change 
				 AND insurance_id!='0' AND $curr_day_end>=date_change"; //
				break;
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}



function _get_arv_amount_of($start_timeframe,$day,$encounternr,$filter,$total_summary) {

		$sql_filter="";
		$day-=1;
		$debug=false;

	if ($total_summary) {
			//$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";


		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";


		switch ($filter) {
		
			case "amb": //new patients
				// new patient: all the patients what got the service item R01
				if ($debug) echo "amb<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				break;
				
			case "bed": 
				if ($debug) echo "bed<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='B%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				break;
	
			case "consult": //Consultation

			if ($debug) echo $LDConsult."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				
				break;
				
			case "consum": //Consultation

			if ($debug) echo $LDConsum."<br>";
				$sql_filter="WHERE purchasing_class='supplies' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				break;
			
              case "drugs":
              if ($debug) echo "drugs<br>";
              $sql_filter="WHERE purchasing_class='drug_list' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
              break;
			  
			  case "eye":
              if ($debug) echo "eye<br>";
              $sql_filter="WHERE purchasing_class='eye-service' OR purchasing_class='eye-surgery' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
              break;

		
			case "file": //file

                        if ($debug) echo $LDFile."<br>";
                                $sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

                        case "icu":
                                if ($debug) echo "icu<br>";
                                $sql_filter="WHERE purchasing_class='service'  AND item_number like 'I%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

                        case "lab": //lab
                        if ($debug) echo $LDLab."<br>";
                                $sql_filter="WHERE purchasing_class='labtest' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

                        case "mort":
                                if ($debug) echo "mort<br>";
                                $sql_filter="WHERE purchasing_class='service'  AND item_number like 'M%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

			 case "minproc":
                                if ($debug) echo $LDMinProc."<br>";
                                $sql_filter="WHERE purchasing_class='mminor_proc_op'  AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

			case "proc/surg": //
                        if ($debug) echo $LDProcSurg."<br>";
                                $sql_filter="WHERE (purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR  purchasing_class='surgical_op')
AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;

                        case "radio":
                                if ($debug) echo "radio<br>";
                                $sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
                                break;
	
			case "other"://returns
				if ($debug) echo "other<br>";
   				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service' 
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr'";
				break;
				
			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  and encounter_nr='$encounternr' and purchasing_class !='dental'" ; // count of all
				break;
			default:
				return FALSE;

		}
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}


function _get_bill_amount_of($start_timeframe,$admission,$day,$billnr,$filter,$total_summary) {

		$sql_filter="";
		$day-=1;
		$debug=false;

	if ($total_summary) {  
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		if($admission == '1')
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 1 ";
                }
                else if($admission == '2' )
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 2 ";
                }
                else 
                        $admission_encounter = "";
                
				
		if ($billnr) {
		$and_bill = " AND BillNumber = '$billnr'";
		$a_bill = " AND care_tz_billing_archive_elem.nr = '$billnr'";
		} else {
		$and_bill = "";
		$a_bill = "";
		}
		
		global $db;
	
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;

		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";


		switch ($filter) {

			case "amb": //new patients
				// new patient: all the patients what got the service item R01
				if ($debug) echo "amb<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				
				break;
				
			case "bed": 
				if ($debug) echo "bed<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='B%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
	
			case "consult": //Consultation

			if ($debug) echo $LDConsult."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
				
			case "consum": //Consultation

			if ($debug) echo $LDConsum."<br>";
				$sql_filter="WHERE purchasing_class='supplies' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') $and_bill";
				break;
			
              case "drugs":
              if ($debug) echo "drugs<br>";
              $sql_filter="WHERE purchasing_class='drug_list' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
              break;

			 case "eye":
              if ($debug) echo "eye<br>";
              $sql_filter="WHERE (purchasing_class='eye-service' OR purchasing_class='eye-surgery') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
              break;
 
			case "file": //file

                        if ($debug) echo $LDFile."<br>";
                                $sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

                        case "icu":
                                if ($debug) echo "icu<br>";
                                $sql_filter="WHERE purchasing_class='service'  AND item_number like 'I%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

                        case "lab": //lab
                        if ($debug) echo $LDLab."<br>";
                                $sql_filter="WHERE purchasing_class='labtest' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

                        case "mort":
                                if ($debug) echo "mort<br>";
                                $sql_filter="WHERE purchasing_class='service'  AND item_number like 'M%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

			 case "minproc":
                                if ($debug) echo $LDMinProc."<br>";
                                $sql_filter="WHERE purchasing_class='minor_proc_op'  AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

			case "proc/surg": //
                        if ($debug) echo $LDProcSurg."<br>";
                                $sql_filter="WHERE (purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR  purchasing_class='surgical_op')
AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
                                break;

                        case "radio":
                                if ($debug) echo "radio<br>";
                                $sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
						  break;
	
	
			case "other"://returns
				if ($debug) echo "other<br>";
   				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies'
				AND purchasing_class!='service'  
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
			
			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";  // count of all
				break; 
			default:
				return FALSE;

		}
	
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}


function _get_prepaid_amount_of($start_timeframe,$day,$insuranceid,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {
		case "amb": 
				if ($debug) echo $LDAmb."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";

				break;
				
			case "bed": 
				if ($debug) echo $LDBed."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";

				break;
				
			case "consult": //Consultation
				if ($debug) echo $LDConsult."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";

				break;
				
			case "consum": 
				if ($debug) echo $LDConsum."<br>";

				$sql_filter="WHERE purchasing_class='supplies'  AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";

				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
   				$sql_filter="WHERE purchasing_class='dental' AND 
				from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "drugs":
				if ($debug) echo "drugs<br>";
		$sql_filter="WHERE (  purchasing_class='drug_list') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "eye":
				if ($debug) echo "eye<br>";
		$sql_filter="WHERE (  purchasing_class='eye-service' OR purchasing_class='eye-surgery' ) AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "icu":
				if ($debug) echo $LDICU."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
					
			case "lab":
				if ($debug) echo $LDLab."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='labtest' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;

			 case "minproc":
                                if ($debug) echo $LDMinProc."<br>";
                                // start und ende timeframe fehlt noch!
                                                        $sql_filter="WHERE purchasing_class='minor_proc_op' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;

			case "proc/surg		
				if ($debug) echo $LDProcSurg<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
			
			case "radio":
				if ($debug) echo "radio<br>";
				$sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
					
			case "other":
				if ($debug) echo "other<br>";
				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service' 
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;

			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE  from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'"; // count of all
				break;
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}



function _get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
			
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
		
		
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		if($encounternr)
		{
			$and_encounter = " AND encounter_nr ='$encounternr'";
		} else {
			$and_encounter = "";
		}
		
		global $db;
		global $LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {

			case "amb": 
				if ($debug) echo $LDAmb."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";

				break;
				
			case "bed": 
				if ($debug) echo $LDBed."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";

				break;
				
			case "consult": //Consultation
				if ($debug) echo $LDConsult."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";

				break;
				
			case "consum": 
				if ($debug) echo $LDConsum."<br>";

				$sql_filter="WHERE purchasing_class='supplies'  AND 
				from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";

				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
   				$sql_filter="WHERE purchasing_class='dental' AND 
				from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
				
			case "drugs":
				if ($debug) echo "drugs<br>";
		$sql_filter="WHERE (  purchasing_class='drug_list') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  
		encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				break;
				
			case "eye":
				if ($debug) echo "eye<br>";
		$sql_filter="WHERE ( purchasing_class='eye-service' OR purchasing_class='eye-surgery' ) 
AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  
		encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
				
			case "icu":
				if ($debug) echo $LDICU."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
					
			case "lab":
				if ($debug) echo $LDLab."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='labtest' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
							
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
							
				break;
				
			case "minproc":
                                if ($debug) echo $LDMinProc."<br>";
                                $sql_filter="WHERE purchasing_class='minor_proc_op'  AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;

			case "proc/surg":
				if ($debug) echo $LDProcSurg."<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
			
			case "radio":
				if ($debug) echo "radio<br>";
				$sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  
				encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
					
			case "other":
				if ($debug) echo "other<br>";
				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service' 
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op' 
				AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND 
				 encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				 
				break;

			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE  from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";
				
				break;
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}
	
function _get_insurance_company_total($start_timeframe,$day,$insuranceid,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		if($insuranceid)
		{
			$and_insurance = " AND insurance_id = '$insuranceid'";
		} else {
			$and_insurance = "";
		}
		
		global $db;
		global $LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {

			case "amb": 
				if ($debug) echo $LDAmb."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";

				break;
				
			case "bed": 
				if ($debug) echo $LDBed."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";

				break;
				
			case "consult": //Consultation
				if ($debug) echo $LDConsult."<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";

				break;
				
			case "consum": 
				if ($debug) echo $LDConsum."<br>";

				$sql_filter="WHERE purchasing_class='supplies' AND $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";

				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
   				$sql_filter="WHERE purchasing_class='dental' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
				
				break;
				
			case "drugs":
				if ($debug) echo "drugs<br>";
		$sql_filter="WHERE (  purchasing_class='drug_list') AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
				break;
				
			case "eye":
				if ($debug) echo "eye<br>";
		$sql_filter="WHERE ( purchasing_class='eye-service' OR purchasing_class='eye-surgery' ) 
AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
				break;
				
			case "icu":
				if ($debug) echo $LDICU."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
				
				break;
				
			case "lab":
				if ($debug) echo $LDLab."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='labtest' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
							
				break;
		
			case "mort":
				if ($debug) echo $LDMort."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change $and_insurance";
							
				break;
				
			case "minproc":
                          		if ($debug) echo $LDMinProc."<br>";
                                $sql_filter="WHERE purchasing_class='minor_proc_op'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";
                                break;

			case "proc/surg":
				if ($debug) echo $LDProcSurg."<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') AND $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";
				
				break;
			
			case "radio":
				if ($debug) echo "radio<br>";
				$sql_filter="WHERE purchasing_class='xray' AND $curr_day_start <=date_change AND $curr_day_end>=date_change   $and_insurance";
				
				break;
					
			case "other":
				if ($debug) echo "other<br>";
				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service'  
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op' 
				AND $curr_day_start <=date_change AND $curr_day_end>=date_change AND $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";
				 
				break;

			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE  $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";
				
				break;
			default:
				return FALSE;

		}
	
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];


		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}



function _get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		switch ($filter) {
			case "invoice":
				if ($debug) echo $LDInvoice."<br>";
				$sql="SELECT count(distinct(nr)) as RetVal FROM care_tz_billing_archive_elem  where $curr_day_start <=date_change AND $curr_day_end>=date_change AND (care_tz_billing_archive_elem .insurance_id !='' OR care_tz_billing_archive_elem .insurance_id !='NULL' OR care_tz_billing_archive_elem .insurance_id !='0') ";
				break;
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "consult": //Consultation
				if ($debug) echo $LDmat."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "lab":
				if ($debug) echo $LDlab."<br>";
				// start und ende timeframe fehlt noch!
							$sql_filter="WHERE purchasing_class='labtest' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
			case "xray":
			
				if ($debug) echo "xray<br>";
				$sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;

			case "drugs":
				if ($debug) echo "drugs<br>";
		$sql_filter="WHERE ( purchasing_class='drug_list') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;

			case "file":
                                if ($debug) echo "file<br>";
                                $sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;

                        case "icu":
                                if ($debug) echo "icu<br>";
                $sql_filter="WHERE ( purchasing_class='service') AND item_number like 'I%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;
			
			 case "mort":
                                if ($debug) echo "mort<br>";
                                $sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;

                        case "minproc":
                                if ($debug) echo "min. proc<br>";
                $sql_filter="WHERE ( purchasing_class=minor_proc_op')  AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
                                break;
				
			case "proc/surg":
				if ($debug) echo "proc/surg<br>";
				$sql_filter="WHERE ( purchasing_class='eye-service' OR purchasing_class='obgyne_op' OR purchasing_class='ortho_op' 
OR purchasing_class='surgical_op') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
				
			case "radio":
				if ($debug) echo "Imaging<br>";
				$sql_filter="WHERE purchasing_class='xray' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";
				break;
			
			case "other":
				if ($debug) echo "other<br>";
				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies' 
				AND purchasing_class!='service'  
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op' 
				AND $curr_day_start <=date_change AND $curr_day_end>=date_change AND $curr_day_start <=date_change AND $curr_day_end>=date_change  $and_insurance";
				 
				break;

			case "total":
				if ($debug) echo $LDjumla."<br>";
				$sql_filter="WHERE  from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid' "; // count of all
				break;
			default:
				return FALSE;

		}
		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}
	

	function _get_advance_amount_of($start_timeframe,$day,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master   ";
		switch($filter)
		{				
			case "";
				if($debug) echo "<br>";

				$sql_filter="WHERE description like 'Advance%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;

			case "cash": //
				if ($debug) echo "cash<br>";

				$sql_filter="WHERE description like 'Advance%' AND insurance_id=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "insurance": //
				if ($debug) echo "insurance<br>";

				$sql_filter="WHERE description like 'Advance%'  AND insurance_id!=0 AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
								
				default:
					return FALSE;
	}

		$db_obj = $db->Execute($sql.$sql_filter);
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}

	function _get_bill_advance_amount_of($start_timeframe,$admission,$day,$billnr,$filter,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";
	
				
		if ($billnr) {
		$and_bill = " AND BillNumber = '$billnr'";
		} else {
		$and_bill = "";
		}

		global $db;
		
		
		global $LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master  ";
		
		switch($filter)
		{				
			case "";
				if($debug) echo "<br>";

				$sql_filter="WHERE description like 'Advance%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				
				break;

			case "cash": //
				if ($debug) echo "cash<br>";

				$sql_filter="WHERE description like 'Advance%' AND (insurance_id=0 OR insurance_id='' OR insurance_id='NULL') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
				
			case "insurance": //
				if ($debug) echo "insurance<br>";

				$sql_filter="WHERE description like 'Advance%'  AND (insurance_id!=0 AND insurance_id!='' AND insurance_id!='NULL') AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_end,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y')  $and_bill";
				break;
								
				default:
					return FALSE;
	}  
	
		$db_obj = $db->Execute($sql.$sql_filter);   
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}

	function _get_insurance_company_advance_amount($start_timeframe,$day,$encounternr,$insuranceid,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master WHERE description like 'Advance%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND encounter_nr='$encounternr' AND  insurance_id='$insuranceid'";

		if($db_obj = $db->Execute($sql))
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

	if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}
	
	function _get_insurance_company_advance_total($start_timeframe,$day,$insuranceid,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global $LDAdvance,$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,$LDMort,$LDMinProc,$LDProcSurg,$LDRadio,$LDOther,$LDTotal;


		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		$sql="SELECT SUM(price*amount) as RetVal FROM tmp_billing_master WHERE description like 'Advance%' AND from_unixtime($curr_day_start,'%d-%m-%Y') <= from_unixtime(date_change,'%d-%m-%Y') AND from_unixtime($curr_day_start,'%d-%m-%Y') >= from_unixtime(date_change,'%d-%m-%Y') AND  insurance_id='$insuranceid'";

		if($db_obj = $db->Execute($sql))
		$row=$db_obj->FetchRow();
		$return_value=$row['RetVal'];

	if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}

	function _get_pending_amount_of($start_timeframe,$day,$filter,$pricelist,$total_summary) {
		$sql_filter="";
		$day-=1;
		$debug=false;
		if ($total_summary) {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = mktime(0,0,0,date("n",$start_timeframe)+1,1,date("Y",$start_timeframe))-1;
		} else {
			$curr_day_start=$this->_get_requested_day($start_timeframe, $day);
			$curr_day_end = $curr_day_start + (24*60*60-1);
		} // end of if ($total_summary)
			if ($debug) echo $curr_day_start.": ";
			if ($debug) echo date("d.m.y",$curr_day_start)."<br>";
			if ($debug) echo $curr_day_end.": ";
			if ($debug) echo date("d.m.y",$curr_day_end)."<br>";

		global $db;
		global$LDAmb,$LDBed,$LDConsult,$LDConsum,$LDDental,$LDDrugs,$LDEye,$LDFile,$LDICU,$LDLab,
$LDMort,$LDMinProc,$LDProcSurg,$LDImaging,$LDOther,$LDTotal;

		($debug) ? $db->debug=TRUE : $db->debug=FALSE;
		
$sql="SELECT SUM(unit_price*amount) as RetVal FROM tmp_billing_pending_quotations   ";

switch ($filter) {

			case "amb": //
				if ($debug) echo "amb<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'A%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			
			case "bed": //Consultation
				if ($debug) echo "bed<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'B%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "consult": //Consultation
				if ($debug) echo "consult<br>";

				$sql_filter="WHERE purchasing_class='service' AND item_number like 'C%'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "consum": //Consumables
				if ($debug) echo "consum<br>";

				$sql_filter="WHERE purchasing_class='supplies' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "dental":
				if ($debug) echo "dental<br>";
				$sql_filter="WHERE purchasing_class='dental' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "drugs":
				if ($debug) echo "drugs<br>";
				$sql_filter="WHERE (  purchasing_class='drug_list') AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "eye":
				if ($debug) echo "eye<br>";
				$sql_filter="WHERE ( purchasing_class='eye-service' OR purchasing_class='eye-surgery' ) AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "file": //new patients
				// new patient: all the patients what got the service item R01

				if ($debug) echo "file<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number='R01' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
			
			case "icu":
				if ($debug) echo $LDICU."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'I%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "lab":
				if ($debug) echo $LDLab."<br>";
				$sql_filter="WHERE purchasing_class='labtest' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "mort":
				if ($debug) echo $LDMort."<br>";
				$sql_filter="WHERE purchasing_class='service' AND item_number like 'M%' AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;

			case "minproc":
				if ($debug) echo $LDMinProc."<br>";
				$sql_filter="WHERE purchasing_class='minor_proc_op'  AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
					
			case "proc/surg":
				if ($debug) echo "proc/surg<br>";
				$sql_filter="WHERE ( purchasing_class='obgyne_op' OR purchasing_class='ortho_op' OR purchasing_class='surgical_op') AND $curr_day_start <=date_change AND $curr_day_end>=date_change ";
				break;
				
			case "radio"://returns
				if ($debug) echo "radio<br>";
   				$sql_filter="WHERE purchasing_class='xray' AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "other"://returns
			// returns: all other items
				if ($debug) echo "other<br>";
   				$sql_filter="WHERE purchasing_class!='drug_list' 
				AND purchasing_class!='supplies'
				AND purchasing_class!='service'   
				AND purchasing_class!='dental' 
				AND purchasing_class!='labtest'
				AND purchasing_class!='xray'
				AND purchasing_class!='minor_proc_op'
				AND purchasing_class!='eye-service' 
				AND purchasing_class!='eye-surgery' 
				AND purchasing_class!='obgyne_op'
				AND purchasing_class!='ortho_op' 
				AND purchasing_class!='surgical_op'
				AND $curr_day_start <=date_change AND $curr_day_end>=date_change";
				break;
				
			case "total":
				if ($debug) echo $LDTotal."<br>";
				$sql_filter="WHERE $curr_day_start <=date_change AND $curr_day_end>=date_change"; // count of all
				break;
	
			default:
				return FALSE;

		}
		
		$db_obj = $db->Execute($sql.$sql_filter);
		if($row=$db_obj->FetchRow())
		$return_value=$row['RetVal'];

		if ($return_value) {
			return number_format($return_value,0,'.',',');
		} else { // no return value given for this query...
			return "0";
		} // end of if ($return_value)
	}


	function _Create_financial_tmp_master_table($start_timeframe,$end_timeframe,$admission) {
		global $db;
		$db->debug=false;

		 if($admission == '1')
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 1";
                }
                else if($admission == '2' )
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 2";
                }
                else
                        $admission_encounter = "";
			  
				
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP  TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				LEFT JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' $admission_encounter )"; 

		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}

function _Create_Cash_financial_tmp_master_table($start_timeframe,$end_timeframe, $admission) {
		global $db;
		$db->debug=false;

		if($admission == '1')
                {
                        $admission_encounter = "AND care_encounter.encounter_class_nr = 1";
                }
                else if($admission == '2' )
                {
                        $admission_encounter = "AND care_encounter.encounter_class_nr = 2";
                }
                else 
                
                        $admission_encounter = "";
                


		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE  TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				LEFT JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' $admission_encounter AND (insurance_id ='' OR insurance_id ='NULL' OR insurance_id ='0') )";
				
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}
	
function _Create_Cash_receipts_tmp_master_table($start_timeframe,$end_timeframe, $admission) {
		global $db;
		$db->debug=false;

		if($admission == '1')
                {
                        $admission_encounter = "AND care_encounter.encounter_class_nr = 1";
                }
                else if($admission == '2' )
                {
                        $admission_encounter = "AND care_encounter.encounter_class_nr = 2";
                }
                else
                        $admission_encounter = "";
                


		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				LEFT JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' $admission_encounter AND (insurance_id ='' OR insurance_id ='NULL' OR insurance_id ='0') )";
				
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}

function _Create_insurance_financial_tmp_master_table($start_timeframe,$end_timeframe, $admission) {
		global $db;
		$db->debug=false;


		if($admission == '1')
		{
			$admission_encounter = "AND care_encounter.encounter_class_nr = 1";
		}
		else if($admission == '2' )
		{
			$admission_encounter = "AND care_encounter.encounter_class_nr = 2";
		}
		else if( $admission == "")
		{
			$admission_encounter = "";
		}


		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TEMPORARY TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);

	
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				LEFT JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' $admission_encounter AND (insurance_id !='' OR insurance_id!='NULL' OR insurance_id !='0') )";
		if ($db_ptr = $db->Execute($sql_s))
		
			return TRUE;
		else
			return FALSE;

	}

function _Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill) {
		global $db;
		$db->debug=false;

		 if($admission == '1')
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 1";
                }
                else if($admission == '2' )
                {
                        $admission_encounter = " AND care_encounter.encounter_class_nr = 2";
                }
                else
                        $admission_encounter = "";
						
            if($bill == '1')
                {
                        $and_bill = " AND (insurance_id ='' OR insurance_id ='NULL' OR insurance_id ='0')";
                }
                else if($bill == '2' )
                {
                         $and_bill = " AND (insurance_id !='' AND insurance_id !='NULL' OR insurance_id !='0')";
                }
                else
                        $and_bill = "";    
				
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP  TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				LEFT JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' $admission_encounter $and_bill)"; 

		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}

function _Create_prepaid_tmp_master_table($start_timeframe,$end_timeframe) {
		global $db;
		$db->debug=false;
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.is_labtest,
				  care_tz_billing_archive_elem.is_medicine,
				  care_tz_billing_archive_elem.is_comment,
				  care_tz_billing_archive_elem.is_paid,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,care_tz_drugsandservices.item_description,care_tz_drugsandservices.item_full_description,
          		  care_encounter.encounter_nr,care_encounter.current_dept_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' AND (insurance_id !='' OR insurance_id!='NULL' OR insurance_id !='0') )";
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}


function _Create_art_financial_tmp_master_table($start_timeframe,$end_timeframe) {
		global $db;
		$db->debug=false;
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,care_encounter.current_dept_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' AND current_dept_nr='42')";  
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}
	
	function _Create_tb_financial_tmp_master_table($start_timeframe,$end_timeframe) {
		global $db;
		$db->debug=false;
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_master`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE  TEMPORARY TABLE tmp_billing_master TYPE=HEAP (SELECT DISTINCT
				  care_tz_billing_archive_elem.nr as BillNumber,
				  care_tz_billing_archive_elem.date_change,
				  care_tz_billing_archive_elem.amount,
				  care_tz_billing_archive_elem.price,
				  care_tz_billing_archive_elem.insurance_id,
				  care_tz_billing_archive_elem.description,
				  care_tz_drugsandservices.purchasing_class,
				  care_tz_drugsandservices.item_number,
          		  care_encounter.encounter_nr,care_encounter.current_dept_nr,
          		  care_encounter.pid
				from care_tz_billing_archive
				INNER JOIN care_tz_billing_archive_elem on care_tz_billing_archive.nr=care_tz_billing_archive_elem.nr
				INNER JOIN care_tz_drugsandservices ON care_tz_drugsandservices.item_id = care_tz_billing_archive_elem.item_number
				INNER JOIN care_encounter ON care_encounter.encounter_nr=care_tz_billing_archive.encounter_nr
				WHERE care_tz_billing_archive_elem.date_change>='".$start_timeframe."' AND care_tz_billing_archive_elem.date_change<='".$end_timeframe."' AND current_dept_nr='47')";  
		if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}


	function _Create_pending_quotations_tmp_master_table($start_timeframe,$end_timeframe,$admission) {
		global $db;
		$db->debug=false;
		
		$and_admission ="";
		
		if($admission == '2') {
		$and_admission="AND care_encounter.encounter_class_nr=2";
		}
		else
		if($admission=='1') {
		$and_admission="AND care_encounter.encounter_class_nr=1";
		}
		else 
		$and_admission="";
		

		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_pending_quotations`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_pending_quotations SELECT
care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_encounter.encounter_date
				,	unix_timestamp(care_encounter.encounter_date) as date_change
				,   care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				,	care_tz_drugsandservices.item_number
				, 	CASE WHEN isnull(care_tz_drugsandservices.item_description)=1 THEN 'not available' ELSE care_tz_drugsandservices.item_description END as item_description
				,	1 as amount
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price END as unit_price
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_1)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_1 END as unit_price_1
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_2)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_2 END as unit_price_2
				, 	CASE WHEN isnull(care_tz_drugsandservices.unit_price_3)=1 THEN 0 ELSE care_tz_drugsandservices.unit_price_3 END as unit_price_3
				, 	CASE WHEN isnull(care_tz_drugsandservices.purchasing_class)=1 THEN 'not available' ELSE care_tz_drugsandservices.purchasing_class END as purchasing_class
				,	care_encounter.encounter_nr
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_test_request_chemlabor
				ON care_test_request_chemlabor.encounter_nr=care_encounter.encounter_nr
			INNER JOIN care_test_request_chemlabor_sub
				ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_chemlabor_sub.item_id=care_tz_drugsandservices.item_id
			
			WHERE care_test_request_chemlabor_sub.bill_number = 0 $and_admission 

AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'
			
			AND 	(isnull(care_test_request_chemlabor_sub.is_disabled) OR care_test_request_chemlabor_sub.is_disabled='')
			        
			UNION

			SELECT
                                care_person.pid
                                ,       care_person.selian_pid
                                ,       care_person.name_first
                                ,       care_person.name_last
                                ,       care_person.date_birth
                                ,       care_encounter.encounter_date
								,		unix_timestamp(care_encounter.encounter_date) as date_change
								,       care_encounter.encounter_class_nr
                                ,       care_encounter.current_dept_nr
                                ,       care_encounter.current_ward_nr
								,		care_tz_drugsandservices.item_number
 								,       care_tz_drugsandservices.item_description 
								,		care_test_request_radio.number_of_tests as amount
                                ,       care_tz_drugsandservices.unit_price
                                ,       care_tz_drugsandservices.unit_price_1
                                ,       care_tz_drugsandservices.unit_price_2
                                ,       care_tz_drugsandservices.unit_price_3
                                ,       care_tz_drugsandservices.purchasing_class
                                ,       care_encounter.encounter_nr
		 FROM care_person

                        INNER JOIN care_encounter
                                ON care_encounter.pid=care_person.pid
                        INNER JOIN care_test_request_radio
 				ON care_test_request_radio.encounter_nr = care_encounter.encounter_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_radio.test_request = care_tz_drugsandservices.item_description


			WHERE care_test_request_radio.bill_number = 0 $and_admission 
AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'
			AND 	(isnull(care_test_request_radio.is_disabled) OR care_test_request_radio.is_disabled='')

			UNION
			
			SELECT
					care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_encounter.encounter_date
				,	unix_timestamp(care_encounter.encounter_date) as date_change
				,   care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				,	care_tz_drugsandservices.item_number
				, 	care_tz_drugsandservices.item_description
				,	care_encounter_prescription.total_dosage as amount
				, 	care_tz_drugsandservices.unit_price
				, 	care_tz_drugsandservices.unit_price_1
				, 	care_tz_drugsandservices.unit_price_2
				, 	care_tz_drugsandservices.unit_price_3
				, 	care_tz_drugsandservices.purchasing_class
				,	care_encounter.encounter_nr
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_encounter_prescription
				ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
			INNER JOIN care_tz_drugsandservices 
			ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id

			WHERE
					care_encounter_prescription.bill_number = 0 $and_admission

AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'

				AND	care_tz_drugsandservices.purchasing_class != 'labtest'

				AND     care_tz_drugsandservices.purchasing_class != 'xray'
					
				AND 	(isnull(care_encounter_prescription.is_disabled) OR care_encounter_prescription.is_disabled='')
			";

if ($db_ptr = $db->Execute($sql_s))
			return TRUE;
		else
			return FALSE;

	}


	function _Create_deleted_quotations_tmp_master_table($start_timeframe,$end_timeframe) {
		global $db;
		$db->debug=false;
		
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_billing_deleted_quotations`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_billing_deleted_quotations SELECT 
care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_encounter.encounter_date
				,   care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				,	care_tz_drugsandservices.item_description
				,	care_tz_drugsandservices.item_id
				,	1  as amount
				,	care_test_request_chemlabor_sub.disable_id
				,	care_test_request_chemlabor_sub.disable_date
				, 	care_tz_drugsandservices.unit_price
				, 	care_tz_drugsandservices.unit_price_1
				, 	care_tz_drugsandservices.unit_price_2
				, 	care_tz_drugsandservices.unit_price_3
			    , 	care_tz_drugsandservices.purchasing_class
				,	care_encounter.encounter_nr
				
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_test_request_chemlabor
				ON care_test_request_chemlabor.encounter_nr=care_encounter.encounter_nr
			INNER JOIN care_test_request_chemlabor_sub
				ON care_test_request_chemlabor.batch_nr=care_test_request_chemlabor_sub.batch_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_chemlabor_sub.item_id=care_tz_drugsandservices.item_id
			
			WHERE care_test_request_chemlabor_sub.bill_status='dropped'
AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'
			  			    
			UNION

			SELECT
                                care_person.pid
                                ,       care_person.selian_pid
                                ,       care_person.name_first
                                ,       care_person.name_last
                                ,       care_person.date_birth
                                ,       care_encounter.encounter_date
		   						,       care_encounter.encounter_class_nr
                                ,       care_encounter.current_dept_nr
                                ,       care_encounter.current_ward_nr
 		  						,       care_tz_drugsandservices.item_description
		  						,       care_tz_drugsandservices.item_id
		 						,       care_test_request_radio.number_of_tests as amount 
		 						,       care_test_request_radio.disable_id
								,		care_test_request_radio.disable_date
                                ,       care_tz_drugsandservices.unit_price
                                ,       care_tz_drugsandservices.unit_price_1
                                ,       care_tz_drugsandservices.unit_price_2
                                ,       care_tz_drugsandservices.unit_price_3
                                ,       care_tz_drugsandservices.purchasing_class
                                ,       care_encounter.encounter_nr
		 FROM care_person

                        INNER JOIN care_encounter
                                ON care_encounter.pid=care_person.pid
                        INNER JOIN care_test_request_radio
 				ON care_test_request_radio.encounter_nr = care_encounter.encounter_nr
			INNER JOIN care_tz_drugsandservices
				ON care_test_request_radio.test_request = care_tz_drugsandservices.item_description
			WHERE care_test_request_radio.bill_status='dropped' 
AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'
 		
			UNION
			
			SELECT
					care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_encounter.encounter_date
				,   care_encounter.encounter_class_nr
				, 	care_encounter.current_dept_nr
				, 	care_encounter.current_ward_nr
				, 	care_tz_drugsandservices.item_description
				,	care_tz_drugsandservices.item_id
				,	care_encounter_prescription.total_dosage as amount
				,	care_encounter_prescription.disable_id
				,	care_encounter_prescription.disable_date
				, 	care_tz_drugsandservices.unit_price
				, 	care_tz_drugsandservices.unit_price_1
				, 	care_tz_drugsandservices.unit_price_2
				, 	care_tz_drugsandservices.unit_price_3
				, 	care_tz_drugsandservices.purchasing_class
				,	care_encounter.encounter_nr
				
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			INNER JOIN care_encounter_prescription
				ON care_encounter.encounter_nr=care_encounter_prescription.encounter_nr
			INNER JOIN care_tz_drugsandservices 
			ON care_encounter_prescription.article_item_number=care_tz_drugsandservices.item_id

			WHERE
					care_encounter_prescription.bill_status='dropped' 

				AND	care_tz_drugsandservices.purchasing_class != 'labtest'

				AND care_tz_drugsandservices.purchasing_class != 'xray'
				
				AND unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."'";		
				
if ($db_ptr = $db->Execute($sql_s))
			return TRUE;	
		else
			return FALSE;

	}
	
	function _Create_patients_table($start_timeframe,$end_timeframe,$admission) {
		global $db;
		$db->debug=false;
		$admission="";
		
		if($admission==1)
		{
			$and_amission = " AND encounter_class_nr=1";
		}
		else 
		if($admission==2)
		{
			$and_amission = " AND encounter_class_nr=2";
		}
		
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_patients`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_patients SELECT 
care_person.pid
				,	care_person.selian_pid
				,	care_person.name_first
				, 	care_person.name_last
				, 	care_person.date_birth
				, 	care_encounter.encounter_date	
				,	care_encounter.encounter_nr
				
			FROM care_person

			INNER JOIN care_encounter
				ON care_encounter.pid=care_person.pid
			
			WHERE 
unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."' $and_admission ";		
				
if ($db_ptr = $db->Execute($sql_s))
			return TRUE;	
		else
			return FALSE;

	}
	
	function _Create_Diagnostics_table($start_timeframe,$end_timeframe,$admission,$is_entered) {
		global $db;
		$db->debug=false;
		$admission="";
		
		if($admission==1)
		{
			$and_amission = " AND encounter_class_nr=1";
		}
		else 
		if($admission==2)
		{
			$and_amission = " AND encounter_class_nr=2";
		}
		
		// SELECT-Statement with all the informations we need:
		$sql_d ="DROP TABLE IF EXISTS `tmp_diagnostics`";
		$db_ptr = $db->Execute($sql_d);
		$sql_s ="CREATE TEMPORARY TABLE tmp_diagnostics SELECT 
				distinct(care_encounter.pid)
				
			FROM care_encounter

			INNER JOIN care_tz_diagnosis
				ON care_encounter.encounter_nr=care_tz_diagnosis.encounter_nr
			
			WHERE 
unix_timestamp(care_encounter.encounter_date)>='".$start_timeframe."' AND unix_timestamp(care_encounter.encounter_date)<='".$end_timeframe."' $and_admission ";		
				
if ($db_ptr = $db->Execute($sql_s))
			return TRUE;	
		else
			return FALSE;

	}
	
	function Get_Diagnostic_patients($start_timeframe,$end_timeframe,$admission,$is_entered,$offset,$rowsperpage) {
	global $db;
		$db->debug=false;
		
		$this->_Create_patients_table($start_timeframe,$end_timeframe,$admission);
		
		$this->_Create_Diagnostics_table($start_timeframe,$end_timeframe,$admission,$is_entered);
		
		$sql_patients = "SELECT distinct(pid) AS PID ,encounter_nr as ENR,encounter_date,selian_pid,name_first,name_last,date_birth  FROM tmp_patients where pid not in(select distinct(pid) from tmp_diagnostics) and UNIX_TIMESTAMP(encounter_date) >= '$start_timeframe' AND UNIX_TIMESTAMP(encounter_date) <= '$end_timeframe' LIMIT $offset, $rowsperpage";    
		
		if ($this->debug) echo $sql_patients;

                $this->request = $db->Execute($sql_patients);
                if ($this->debug) echo $this->request;
                return $this->request;
				
	}
	
	function Get_Diagnostics_count($is_entered) {
	global $db;
		$db->debug=false;
		
		if($is_entered==1) {
		$sql_patients = "SELECT COUNT(tmp_patients.pid) AS numrows  FROM  tmp_patients INNER JOIN  tmp_diagnostics 
ON tmp_patients.pid = tmp_diagnostics.pid";  
		}
		else {
		$sql_patients = "SELECT COUNT(pid) AS numrows  FROM  tmp_patients where pid not in(select distinct(pid) from tmp_diagnostics)";
		}
		
		if ($this->debug) echo $sql_patients;

                $this->request = $db->Execute($sql_patients);
                if ($this->debug) echo $this->request;
                $countrow     = $this->request->FetchRow();

				return $countrow[0];
	}

	function DisplayBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$color_change=FALSE;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_financial_tmp_master_table($start_timeframe, $end_timeframe);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {

					if (!$PRINTOUT)	$bg_color="#ffffff"; 

					$italic_tag_open="<i>";
                                        $italic_tag_close="</i>";
		          	
				} else {

					if (!$PRINTOUT) $bg_color="#ffffaa";

					$italic_tag_open="";
					$italic_tag_close="";
				
				} // end of if ($current_day > time())


				
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$this->_get_requested_day($start_timeframe, $day-1, FALSE)).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,$day,"", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"icu", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"mort", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"minproc", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"proc/surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"radio", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,$day,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,1,"", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"minproc", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"proc/surg", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		echo $table;
	}
  	function DisplayBillingResultRows($start_timeframe, $end_timeframe){

  	}

function DisplayCashBillingTestSummary($start_timeframe, $end_timeframe, $admission){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;

		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_Cash_financial_tmp_master_table($start_timeframe, $end_timeframe, $admission);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$this->_get_requested_day($start_timeframe, $day-1, FALSE)).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,$day,"cash", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"icu", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"mort", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"minproc", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"proc/surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"radio", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,$day,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,1,"cash", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"minproc", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,
"proc/surg", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		echo $table;
	}
  	function DisplayCashBillingResultRows($start_timeframe, $end_timeframe){

  	}

function DisplayCashReceiptsTestSummary($start_timeframe, $end_timeframe, $admission){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);

		$this->_Create_Cash_receipts_tmp_master_table($start_timeframe, $end_timeframe, $admission);

		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.Y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())


		$sql_encounter_nr="SELECT distinct(BillNumber) FROM tmp_billing_master where  from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  ";
				$db_ptr_encounter_nr = $db->Execute($sql_encounter_nr);
				
				
			 while($db_row_encounter_nr=$db_ptr_encounter_nr->FetchRow())
			{
								$billnr=$db_row_encounter_nr['BillNumber'].'<br>';
							  //$encounternr=$db_row_encounter_nr['encounternr'].'<br>';
							//$pid=$db_row_encounter_nr['pid'].'<br>';

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day-1).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$billnr.$italic_tag_close."</td>\n";
				//$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"invoice", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_advance_amount_of($start_timeframe,$admission,$day,$billnr,"", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"icu", FALSE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"lab", FALSE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"mort", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"minproc", FALSE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"proc/surg", FALSE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"radio", FALSE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_bill_amount_of($start_timeframe,$admission,$day,$billnr,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		}
		$billnr=FALSE;
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,1,"", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
         $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"minproc", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"proc/surg", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
        $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_cash_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
	
			echo $table;
		

	}
	
	function DisplayCashReceiptsRows()
	 	{
	
	
		}


function DisplayInsuranceBillingTestSummary($start_timeframe, $end_timeframe, $admission){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_insurance_financial_tmp_master_table($start_timeframe, $end_timeframe, $admission);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())


				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$this->_get_requested_day($start_timeframe, $day-1, FALSE)).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,$day,"insurance", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"eye", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"file", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"icu", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"mort", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"minproc", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"proc/surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"radio", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,$day,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_advance_amount_of($start_timeframe,1,"insurance", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,
"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"minproc", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"proc/surg", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		echo $table;
	}
  	function DisplayInsuranceBillingResultRows($start_timeframe, $end_timeframe){

  	}



function DisplayInsuranceCompanyTestSummary($start_timeframe, $end_timeframe, $insuranceid, $admission){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_insurance_financial_tmp_master_table($start_timeframe, $end_timeframe, $admission);
	
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);  
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())


	$sql_encounter_nr="SELECT distinct (encounter_nr)  as encounternr , pid FROM tmp_billing_master where insurance_id='$insuranceid' and from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  ";
				$db_ptr_encounter_nr = $db->Execute($sql_encounter_nr);

		while($db_row_encounter_nr=$db_ptr_encounter_nr->FetchRow())
		{

			$encounternr=$db_row_encounter_nr['encounternr'];
		
			$pid=$db_row_encounter_nr['pid'];

			 $sql_hospitalnr="SELECT name_last,name_first FROM care_person where pid='$pid'";
			 $db_ptr_hospitalnr = $db->Execute($sql_hospitalnr);
			 $db_row_hospitalnr=$db_ptr_hospitalnr->FetchRow();
			 $hospitalnr=$db_row_hospitalnr['name_last'].'  '.$db_row_hospitalnr['name_first'];

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day-1).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$hospitalnr.$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_advance_amount($start_timeframe,$day,$encounternr,$insuranceid, FALSE).$italic_tag_close."</td>\n";
				
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"icu", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"mort", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"minproc", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"proc/surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"radio", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_amount_of($start_timeframe,$day,$encounternr,$insuranceid,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		}

		$table.="<tr>\n";
		
		if (!$PRINTOUT)$bg_color="#CC9933";
			
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"right\"></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_advance_amount($start_timeframe,1,$encounternr,$insuranceid, TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"amb", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"bed", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"consult", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"consum", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"dental", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"drugs", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"eye", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"file", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"icu", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"lab", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"mort", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"minproc", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"proc/surg", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"radio", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"other", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"total", TRUE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
        		        $table.="</tr>\n";

			echo	$table;
			
		
	}
	

  	function DisplayInsuranceCompanyResultRows($start_timeframe, $end_timeframe , $insurance_id){

  	}


function DisplayCompaniesBillingTestSummary($start_timeframe, $end_timeframe, $admission){
                global $db;
                global $PRINTOUT;
                global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
                $first_day_of_req_month=0;
                $last_day_of_req_month=0;
                $end_timeframe += (24*60*60-1);
               $this->_Create_insurance_financial_tmp_master_table($start_timeframe, $end_timeframe, $admission);
                echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";
				/*
                $first_day_of_req_month = date ("d",$start_timeframe);
                $last_day_of_req_month = date ("d",$end_timeframe);
				*/
                $table.="<tr>\n";
                

        $sql_insurance_id="SELECT distinct (tmp_billing_master.insurance_id) as insuranceid,care_tz_company.name FROM tmp_billing_master INNER JOIN care_tz_company ON 
		tmp_billing_master.insurance_id=care_tz_company.id ORDER BY name ASC";   
		 
              	$db_ptr_insurance_id = $db->Execute($sql_insurance_id); 
								
                while($db_row_insurance_id=$db_ptr_insurance_id->FetchRow())
                {
                   $insuranceid=$db_row_insurance_id['insuranceid'].'<br>';
				   
						 $insurance_name = $db_row_insurance_id['name'];
		
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$insurance_name.$italic_tag_close."</td>\n";
                             
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_advance_total($start_timeframe,$day,$insuranceid, TRUE).$italic_tag_close."</td>\n";
				
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"amb", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"bed", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"consult", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"consum", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"dental", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"drugs", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"eye", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"file", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"icu", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"lab", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"mort", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"minproc", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"proc/surg", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"radio", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"other", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,$insuranceid,"total", TRUE).$italic_tag_close."</td>\n";

                                $table.="</tr>\n";
        }
              
				
                $table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		
                $table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
				
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_advance_total($start_timeframe,1,"", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","amb", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","bed", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","consult", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","consum", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","dental", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","drugs", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","eye", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","file", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","icu", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","lab", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","mort", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","minproc", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","proc/surg", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","radio", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","other", TRUE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_insurance_company_total($start_timeframe,1,"","total", TRUE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
        		        $table.="</tr>\n";

			echo	$table;
			
		 }
        function DisplayCompaniesBillingResultRows($start_timeframe, $end_timeframe, $admission){

        }



function DisplayPrepaidBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_prepaid_tmp_master_table($start_timeframe, $end_timeframe);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

	$sql_insurance_id="SELECT distinct (insurance_id)  as insuranceid  FROM tmp_billing_master where from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  and insurance_id != '0'";
				$db_ptr_insurance_id = $db->Execute($sql_insurance_id);
			 while($db_row_insurance_id=$db_ptr_insurance_id->FetchRow())
		{
      		   $insuranceid=$db_row_insurance_id['insuranceid'].'<br>';

			 $sql_insurancename="SELECT name FROM care_tz_company where id='$insuranceid'";
			 $db_ptr_insurancename = $db->Execute($sql_insurancename);
			 $db_row_insurancename=$db_ptr_insurancename->FetchRow();
			 $insurancename=$db_row_insurancename['name'];




				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day-1).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$insurancename.$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"mat", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"xray", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"dawa", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"dress", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"meng", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_prepaid_amount_of($start_timeframe,$day,$insuranceid,"jumla", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
	}
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		/*$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"invoice", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mat", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"xray", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dawa", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"surg", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dress", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"meng", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"jumla", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		*/echo $table;
	}
  	function DisplayPrepaidBillingResultRows($start_timeframe, $end_timeframe){

  	}



function DisplayDentalPrepaidBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$this->_Create_prepaid_tmp_master_table($start_timeframe, $end_timeframe);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

	$sql_insurance_id="SELECT distinct (insurance_id)  as insuranceid  FROM tmp_billing_master where from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  and insurance_id != '0' and current_dept_nr='43' ";
				$db_ptr_insurance_id = $db->Execute($sql_insurance_id);
			 while($db_row_insurance_id=$db_ptr_insurance_id->FetchRow())
		{
      		   $insuranceid=$db_row_insurance_id['insuranceid'].'<br>';

			 $sql_insurancename="SELECT name FROM care_tz_company where id='$insuranceid'";
			 $db_ptr_insurancename = $db->Execute($sql_insurancename);
			 $db_row_insurancename=$db_ptr_insurancename->FetchRow();
			 $insurancename=$db_row_insurancename['name'];




				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day-1).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$insurancename.$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"mat", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"lab", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"xray", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"dawa", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"surg", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"dress", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"meng", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_dental_prepaid_amount_of($start_timeframe,$day,$insuranceid,"jumla", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
	}
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		/*$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"invoice", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mat", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"xray", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dawa", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"surg", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dress", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"meng", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"jumla", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		*/echo $table;
	}
  	function DisplayDentalPrepaidBillingResultRows($start_timeframe, $end_timeframe){

  	}





function DisplayARVBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);

		$this->_Create_art_financial_tmp_master_table($start_timeframe, $end_timeframe);

		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.Y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";





		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())


		$sql_encounter_nr="SELECT distinct (encounter_nr)  as encounternr , pid FROM tmp_billing_master where from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  ";
				$db_ptr_encounter_nr = $db->Execute($sql_encounter_nr);
			 while($db_row_encounter_nr=$db_ptr_encounter_nr->FetchRow())
			{
							  $encounternr=$db_row_encounter_nr['encounternr'].'<br>';
							$pid=$db_row_encounter_nr['pid'].'<br>';

			 $sql_hospitalnr="SELECT name_last,name_first FROM care_person where pid='$pid'";
			 $db_ptr_hospitalnr = $db->Execute($sql_hospitalnr);
			 $db_row_hospitalnr=$db_ptr_hospitalnr->FetchRow();
			 $hospitalnr=$db_row_hospitalnr['name_last'].'  '.$db_row_hospitalnr['name_first'];



				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day-1).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$hospitalnr.$italic_tag_close."</td>\n";
				//$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"invoice", FALSE).$italic_tag_close."</td>\n";

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"icu", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"lab", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"mort", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"proc/surg", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"radio", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"proc/surg", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
	
			echo $table;
		//}

	}


function DisplayTBBillingTestSummary($start_timeframe, $end_timeframe){
		global $db;
		global $PRINTOUT;
		global $LDLookingforFinancialReports,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);

		$this->_Create_tb_financial_tmp_master_table($start_timeframe, $end_timeframe);

		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.Y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";





		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())


		$sql_encounter_nr="SELECT distinct (encounter_nr)  as encounternr , pid FROM tmp_billing_master where from_unixtime( date_change, '%Y-%d-%m' )=from_unixtime( $current_day, '%Y-%d-%m' )  ";
				$db_ptr_encounter_nr = $db->Execute($sql_encounter_nr);
			 while($db_row_encounter_nr=$db_ptr_encounter_nr->FetchRow())
			{
							  $encounternr=$db_row_encounter_nr['encounternr'].'<br>';
							$pid=$db_row_encounter_nr['pid'].'<br>';

			 $sql_hospitalnr="SELECT name_last,name_first FROM care_person where pid='$pid'";
			 $db_ptr_hospitalnr = $db->Execute($sql_hospitalnr);
			 $db_row_hospitalnr=$db_ptr_hospitalnr->FetchRow();
			 $hospitalnr=$db_row_hospitalnr['name_last'].'  '.$db_row_hospitalnr['name_first'];



				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$current_day).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$hospitalnr.$italic_tag_close."</td>\n";
				//$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"invoice", FALSE).$italic_tag_close."</td>\n";

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"amb", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"bed", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"consult", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"consum", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"dental", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"drugs", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"eye", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"file", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"icu", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"lab", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"mort", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"proc/surg", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"radio", FALSE).$italic_tag_close."</td>\n";
                                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"other", FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_arv_amount_of($start_timeframe,$day,$encounternr,"total", FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"amb", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"bed", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consult", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"consum", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"dental", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"drugs", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"eye", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"file", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"icu", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"lab", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"mort", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"proc/surg", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"radio", TRUE).$italic_tag_close."</td>\n";
                $table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"other", TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_amount_of($start_timeframe,1,"total", TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
	
			echo $table;
		//}

	}


	function DisplayTBBillingResultRows($start_timeframe, $end_timeframe){

  	}

	function DisplayPendingQuotationsSummary($start_timeframe, $end_timeframe,$admission,$pricelist)  {
		global $db;
		global $PRINTOUT;
		global $LDPendingQuotationsReport,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		
		$bill_obj = New Bill;	

$this->_Create_pending_quotations_tmp_master_table($start_timeframe, $end_timeframe, $admission);
		echo $LDLookingforFinancialReports.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		$table.="<tr>\n";
		for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				$table.="<tr>\n";
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.date("j/m/Y",$this->_get_requested_day($start_timeframe, $day-1, FALSE)).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\"align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"amb",$pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"bed", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"consult", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"consum", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"dental", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"drugs", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"eye", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"file", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"icu", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"lab", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"mort", $pricelist,FALSE).$italic_tag_close."</td>\n";

				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"minproc", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"proc/surg", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"radio", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"other", $pricelist,FALSE).$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,$day,"total", $pricelist,FALSE).$italic_tag_close."</td>\n";

				$table.="</tr>\n";
		}
		$table.="<tr>\n";
		if (!$PRINTOUT)$bg_color="#CC9933";
		$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"amb", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"bed", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"consult", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"consum", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"dental", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"drugs", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"eye", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"file", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"icu", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"lab", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"mort", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"minproc", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"proc/surg", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"radio", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"other", $pricelist,TRUE).$italic_tag_close."</td>\n";
		$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$this->_get_pending_amount_of($start_timeframe,1,"total", $pricelist,TRUE).$italic_tag_close."</td>\n";

		$table.="</tr>\n";
		$table.="</tr>\n";
		echo $table;
	}



  	function DisplayPendingQuotationsResultRows($start_timeframe, $end_timeframe){

  	}

	function GetDeletedQuotations() {
		global $db, $tbl;
		$db->debug=FALSE;


		$this->sql="SELECT encounter_date,name_first,name_last,item_description,amount,item_id,disable_id,disable_date from tmp_billing_deleted_quotations
					 ORDER BY encounter_date ASC ";
					
		$db->Execute($this->sql);
		$this->request = $db->Execute($this->sql);
		return $this->request;
	}
	

	function DisplayDeletedQuotationsSummary($start_timeframe, $end_timeframe,$pricelist) {
		global $db;
		global $PRINTOUT;
		global $LDDeletedQuotationsReport,$LDstarttime,$LDendtime;
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		
		echo $LDeletedQuotationsReport.": ".$LDstarttime.": ".date("d.m.y :: G:i:s",$start_timeframe)." ".$LDendtime.": ".date("d.m.y :: G:i:s",$end_timeframe)."<br>";

		$bill_obj=new Bill;

if($this->_Create_deleted_quotations_tmp_master_table($start_timeframe, $end_timeframe))

$del_items = $this->GetDeletedQuotations();
$total_del = 0;

if($del_items)

		while ($del_row=$del_items->FetchRow())
			{
				$counter++;
				if ($color_change) {
					$BGCOLOR='bgcolor="#ffffdd"';
					$color_change=FALSE;
				} else {
					$BGCOLOR='bgcolor="#ffffaa"';
					$color_change=TRUE;
				}

					$price= $bill_obj->getPrice($del_row['item_id'],$pricelist);
					$amount = $del_row['amount']*$price; 
					$total_del +=$amount;

					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$del_row['encounter_date'].
$italic_tag_close."</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$del_row['item_description'].$italic_tag_close."</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$price.$italic_tag_close."</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$del_row['amount'].$italic_tag_close."</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$amount.$italic_tag_close."</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$del_row['disable_id'].$italic_tag_close."						</td>\n";
					$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$del_row['disable_date'].$italic_tag_close."
</td>\n";

					$table.="</tr>\n";
				}
				
				$table.="<tr>\n";
				if (!$PRINTOUT)$bg_color="#CC9933";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"><strong>&sum;</strong></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$total_del.$italic_tag_close."</td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
				$table .= "<td bgcolor=\"$bg_color\" align = \"center\"></td>\n";
				
$table.="</tr>\n";
				$table.="</tr>\n";
	
			echo $table;
		//}

	}
	
	function DisplayDeletedQuotationsResultRows() {
	
	}


	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Insurance Section
	 */
	//--
    function DisplayCompanyTableHead(){
		// Table definition will be organized by the variable $table_head from here:

		global $LDCompanyReportInsurance,$LDNameofemployee,$LDSelianfilenumber,$LDDateofcontract,$LDValidto,$LDPrice;
		// headline:
		$table_head = "<tr>\n";
		$table_head .= "<td bgcolor=\"#ffffaa\" colspan=\"11\" align=\"center\">".$LDCompanyReportInsurance."Company Report (Insurance)</td>\n";
		$table_head.="</tr>\n";

		$table_head.="<tr>\n";
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDNameofemployee."</td>\n";
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDSelianfilenumber."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDDateofcontract."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDValidto."</td>\n" ;
		$table_head .= "<td bgcolor=\"#CC9933\">".$LDPrice."</td>\n" ;
		$table_head.="</tr>\n";
		echo $table_head;

    }

	function DisplayCompanyTestSummary($start_timeframe, $end_timeframe){}
	function DisplayCompanyResultRows($start_timeframe, $end_timeframe){}

	//------------------------------------------------------------------------------------------------------------------------
	/**
	 * Pharmacy Section
	 */
	//--

	function DisplayPharmacyTableHead($class,$admission,$bill){
		global $PRINTOUT;
		global $LDPharmacyReportwithoutstockinfo,$LDDrugName,$LDAmountofDrugsused,$LDCostofdrugsused,$LDUnitPrice;

		$header = "";

		if($class == 'drug_list') {
		$category = " Pharmacy Report";
		}
		else 
		if($class == 'supplies') {
		$category = " Consumables Report";
		}

		if($admission == 1) {
		$adm_info = " Inpatient";
		}
		else 
		if($admission == 2) {
		$adm_info = " Outpatient";
		}
		else
		$adm_info = " All";
	
		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}

		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"11\" align=\"center\"> ".$adm_info." ".$header." ".$category."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\"> ".$adm_info." ".$header." ".$category."</td>\n";
		$table_head.="</tr>\n";

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugName."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmountofDrugsused."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDCostofdrugsused."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDDrugName."</td>\n";
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td>".$LDAmountofDrugsused."</td>\n" ;
			$table_head .= "<td>".$LDCostofdrugsused."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}
	
	function DisplayPharmacyMonthlyTableHead($start_timeframe, $end_timeframe,$class,$admission,$bill){
		global $PRINTOUT;
		global $LDPharmacyReportwithoutstockinfo,$LDDrugName,$LDAmountofDrugsused,$LDCostofdrugsused,$LDUnitPrice;
		
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$header = "";
			
			$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		
		if($class == 'drug_list') {
		$category = " Pharmacy Report";
		}
		else 
		if($class == 'supplies') {
		$category = " Consumables Report";
		}

		if($admission == 1) {
		$adm_info = " Inpatient";
		}
		else 
		if($admission == 2) {
		$adm_info = " Outpatient";
		}
		else
		$adm_info = " All";
	
		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}

		$colspan= $last_day_of_req_month+4;
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"$colspan\" align=\"center\"> ".$adm_info." ".$header." ".$category."</td>\n";
		else
			$table_head .= "<td colspan=\"$colspan\" align=\"center\"> ".$adm_info." ".$header." ".$category."</td>\n";
		$table_head.="</tr>\n";
		

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDrugName."</td>\n";
			
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

			$table_head .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$day.$italic_tag_close."</td>\n";
			
			}
			
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDAmountofDrugsused."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDCostofdrugsused."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDDrugName."</td>\n";
			
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
		
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())
			
			$table_head .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$day.$italic_tag_close."</td>\n";
			
			}
			$table_head .= "<td>".$LDAmountofDrugsused."d</td>\n" ;
			$table_head .= "<td>".$LDCostofdrugsused."</td>\n" ;
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}
	
	function DisplayServicesTableHead($class,$admission,$bill){
		global $PRINTOUT;
		global $LDDetails,$LDNoOfItems,$LDAmount,$LDUnitPrice,$LDtotal;

		$header = "";
	
		if($class == 'drug_list') {
		$category = " Pharmacy Report";
		}
		else 
		if($class == 'supplies') {
		$category = " Consumables Report";
		}
		if($class == 'service') {
		$category = " Services Report";
		}
		
		if($admission == 1) {
		$adm_info = " Inpatient";
		}
		else 
		if($admission == 2) {
		$adm_info = " Outpatient";
		}
		else
		$adm_info = " All";
		
		

		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}

		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"11\" align=\"center\"> ".$adm_info." ".$header." ".$category."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\">".$adm_info." ".$header." ".$category."</td>\n";
		$table_head.="</tr>\n";

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDetails."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDNoOfItems."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDtotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDDetails."</td>\n";
			$table_head .= "<td>".$LDUnitPrice."d</td>\n" ;
			$table_head .= "<td>".$LDNoOfItems."</td>\n" ;
			$table_head .= "<td>".$LDtotal."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}

	function DisplayLaboratoryTableHead($admission,$bill){
		global $PRINTOUT;
		global $LDLaboratoryReport,$LDTestName,$LDNoOfTests,$LDTotal,$LDUnitPrice;

		$header = "";
		$adm_info="";
		
		if($admission == 1) {
		$adm_info = " Inpatient";
		}
		else 
		if($admission == 2) {
		$adm_info = " Outpatient";
		}
		else
		$adm_info = " All";
		
		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}
		
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"11\" align=\"center\"> ".$adm_info." ".$header." ".$LDLaboratoryReport."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\"> ".$adm_info." ".$header." ".$LDLaboratoryReport."</td>\n";
		$table_head.="</tr>\n";

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTestName."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDNoOfTests."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotal."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDTestName."</td>\n";
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td>".$LDNoOfTests."</td>\n" ;
			$table_head .= "<td>".$LDTotal."</td>\n" ;
			
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}
	
	function DisplayServiceTableHead($admission,$bill){
		global $PRINTOUT;
		global $LDServicesReport,$LDDetails,$LDNoItems,$LDCostofItemsused,$LDUnitPrice;

		$header = "";

		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}

		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"11\" align=\"center\"> ".$header." ".$LDServicesReport."</td>\n";
		else
			$table_head .= "<td colspan=\"11\" align=\"center\">".$header." ".$LDServicesReport."</td>\n";
		$table_head.="</tr>\n";

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDDetails."</td>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDNoOfItems."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDCostofItemsused."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDDetails."</td>\n";
			$table_head .= "<td>".$LDNoOfItems."d</td>\n" ;
			$table_head .= "<td>".$LDCostofItemsused."</td>\n" ;
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}

	function _GetSumOfItemAmount($price,$item_number) {
		global $db;
		$sql="SELECT SUM(amount) as RetVal FROM tmp_billing_master WHERE  item_number='".$item_number."' AND price='".$price."'";
		$res_ptr=$db->Execute($sql);
		$res_row=$res_ptr->FetchRow();
		return $res_row['RetVal'];
	}

	function _GetDailySumOfItemAmount($start_timeframe, $day, $price, $item_number) {
		global $db;
		$curr_day_start=$this->_get_requested_day($start_timeframe, $day-1);
			$curr_day_end = $curr_day_start + (24*60*60-1);
			
		$sql="SELECT SUM(amount) as RetVal FROM tmp_billing_master WHERE item_number='".$item_number."' AND price='".$price."' AND
		$curr_day_start<=date_change AND $curr_day_end>=date_change ";
		
		$res_ptr=$db->Execute($sql);
		if($res_row=$res_ptr->FetchRow())
			return $res_row['RetVal'];
		else
		return 0;
	}
	
	function _GetTotalSumOfItems($class) {
		global $db;
		$sql="SELECT SUM(amount*price) as RetVal FROM tmp_billing_master WHERE purchasing_class='".$class."' ";
		$res_ptr=$db->Execute($sql);
		$res_row=$res_ptr->FetchRow();
		$return_value=$res_row['RetVal'];
		return (!empty($return_value))?$res_row['RetVal']:"&nbsp;";
	}

	function _GetTotalSumOfItemAmount($price,$item_number) {
		global $db;
		
		$sql="SELECT SUM(amount*price) as RetVal FROM tmp_billing_master WHERE  item_number='".$item_number."' AND price='".$price."'";
		$res_ptr=$db->Execute($sql);
		if($res_row=$res_ptr->FetchRow())
		return $res_row['RetVal'];
		else 
		return 0;
	}

	function DisplayPharmacyResultRows($start_timeframe, $end_timeframe, $p_class, $admission, $bill){
		global $db;
		global $PRINTOUT;
		global $LDLookingforPharmacyReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$end_timeframe += (24*60*60-1);
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;
		
		if($bill =="")
		{
		$s_bill = "";
		}
		else
		if($bill ==1)
		{
		$s_bill = " AND insurance_id = 0 ";
		}
		if($bill ==2)
		{
		$s_bill = " AND insurance_id != 0 ";
		}

	$this->_Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill);

		echo "Looking for Pharmacy Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='$p_class' $s_bill GROUP BY item_number, price";     
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
                                $table.="  ".$v['price'];
                                $table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfItemAmount($v['price'],$v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetTotalSumOfItemAmount($v['price'],$v['item_number']), 0, '.', ',');
				$table.="</td>\n";
				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";
		$table.="<td>\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfItems($p_class),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}
	
	function DisplayPharmacyMonthlyResultRows($start_timeframe, $end_timeframe, $p_class, $admission, $bill){
		global $db;
		global $PRINTOUT;
		global $LDLookingforPharmacyReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		
		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;
		
		if($bill =="")
		{
		$s_bill = "";
		}
		else
		if($bill ==1)
		{
		$s_bill = " AND insurance_id = 0 ";
		}
		if($bill ==2)
		{
		$s_bill = " AND insurance_id != 0 ";
		}

	$this->_Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill);

		echo "Looking for Pharmacy Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		
		
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='$p_class' $s_bill GROUP BY item_number, price";  
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";
				
				for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
		
				if ($current_day > time()) {
					
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())
					
					$table.="<td align=\"right\">\n";
                   	$table.="  ".$italic_tag_open.$this->_GetDailySumOfItemAmount($start_timeframe, $day,$v['price'],$v['item_number']).$italic_tag_close;
                    $table.="</td>\n";

				}

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfItemAmount($v['price'],$v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
                $table.="  ".$v['price'];
                $table.="</td>\n";
				
				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetTotalSumOfItemAmount($v['price'],$v['item_number']), 0, '.', ',');
				$table.="</td>\n";
				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";
		$table.="<td colspan=".$last_day_of_req_month.">\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfItems($p_class),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}
	
			
  function DisplayLaboratoryResultRows($start_timeframe, $end_timeframe, $admission, $bill){
		global $db;
		global $PRINTOUT;
		global $LDLookingforLaboratoryReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$end_timeframe += (24*60*60-1);
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;
		
		if($bill =="")
		{
		$s_bill = "";
		}
		else
		if($bill ==1)
		{
		$s_bill = " AND (insurance_id = 0 OR insurance_id = '' OR  insurance_id = 'NULL')";
		}
		if($bill ==2)
		{
		$s_bill = " AND insurance_id != 0 AND insurance_id != '' AND insurance_id != 'NULL' ";
		}

		
	$this->_Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill);

		echo "Looking for Laboratory Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='labtest' $s_bill GROUP BY item_number, price";
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
                                $table.="  ".$v['price'];
                                $table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfItemAmount($v['price'],$v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetTotalSumOfItemAmount($v['price'],$v['item_number']), 0, '.', ',');
				$table.="</td>\n";
				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";
		$table.="<td>\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfItems('labtest'),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}

  function DisplayLaboratoryMonthlyResultRows($start_timeframe, $end_timeframe, $admission, $bill){
		global $db;
		global $PRINTOUT;
		global $LDLookingforLaboratoryReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;
		
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		
		$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;
		
		if($bill =="")
		{
		$s_bill = "";
		}
		else
		if($bill ==1)
		{
		$s_bill = " AND (insurance_id = 0 OR insurance_id = '' OR insurance_id = 'NULL') ";
		}
		if($bill ==2)
		{
		$s_bill = " AND insurance_id != 0 AND insurance_id != '' AND insurance_id = 'NULL'";
		}

	$this->_Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill);

		echo "Looking for Pharmacy Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		
		
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='labtest' $s_bill GROUP BY item_number, price";  
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";
				
				for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
		
				if ($current_day > time()) {
					
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())
					
					$table.="<td align=\"right\">\n";
                   	$table.="  ".$italic_tag_open.$this->_GetDailySumOfItemAmount($start_timeframe, $day,$v['price'],$v['item_number']).$italic_tag_close;
                    $table.="</td>\n";

				}

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfItemAmount($v['price'],$v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
                $table.="  ".$v['price'];
                $table.="</td>\n";
				
				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetTotalSumOfItemAmount($v['price'],$v['item_number']), 0, '.', ',');
				$table.="</td>\n";
				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";
		$table.="<td colspan=".$last_day_of_req_month.">\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfItems('labtest'),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}
	
  function DisplayLaboratoryMonthlyTableHead($start_timeframe, $end_timeframe, $admission, $bill){
		global $PRINTOUT;
		global $LDLaboratoryReport,$LDTestName,$LDNoOfTests,$LDTotalAmount,$LDUnitPrice;
		
		$first_day_of_req_month=0;
		$last_day_of_req_month=0;
		$end_timeframe += (24*60*60-1);
		$header = "";
			
			$first_day_of_req_month = date ("d",$start_timeframe);
		$last_day_of_req_month = date ("d",$end_timeframe);
		
		if($class == 'drug_list') {
		$category = " Pharmacy Report";
		}
		else 
		if($class == 'supplies') {
		$category = " Consumables Report";
		}

		if($admission == 1) {
		$adm_info = " Inpatient";
		}
		else 
		if($admission == 2) {
		$adm_info = " Outpatient";
		}
		else
		$adm_info = " All";
	
		if($bill == 1) {
		$header = " Cash";
		}
		else 
		if($bill == 2) {
		$header = " Credit";
		}

		$colspan= $last_day_of_req_month+4;
		$table_head = "<tr>\n";
		if (!$PRINTOUT)
			$table_head .= "<td bgcolor=\"#ffffaa\"  colspan=\"$colspan\" align=\"center\"> ".$adm_info." ".$header." ".$LDLaboratoryReport."</td>\n";
		else
			$table_head .= "<td colspan=\"$colspan\" align=\"center\"> ".$adm_info." ".$header." ".$LDLaboratoryReport."</td>\n";
		$table_head.="</tr>\n";
		

		if (!$PRINTOUT) {
			$table_head.="<tr>\n";
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTestName."</td>\n";
			
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
				
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())

			$table_head .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$day.$italic_tag_close."</td>\n";
			
			}
			
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDNoOfItems."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td bgcolor=\"#CC9933\">".$LDTotalAmount."</td>\n" ;
			$table_head.="</tr>\n";
		} else {
			$table_head.="<tr>\n";
			$table_head .= "<td>".$LDTestName."</td>\n";
			
			for ($day=$first_day_of_req_month; $day<=$last_day_of_req_month ; $day++) {
				$current_day = $this->_get_requested_day($start_timeframe, $day-1);
		
				if ($current_day > time()) {
					if (!$PRINTOUT)$bg_color="#ffffff";
					$italic_tag_open="<i>";
					$italic_tag_close="</i>";
				} else {
					if (!$PRINTOUT)$bg_color="#ffffaa";
					$italic_tag_open="";
					$italic_tag_close="";
				} // end of if ($current_day > time())
			
			$table_head .= "<td bgcolor=\"$bg_color\" align=\"right\">".$italic_tag_open.$day.$italic_tag_close."</td>\n";
			
			}
			$table_head .= "<td>".$LDNoOfItems."d</td>\n" ;
			$table_head .= "<td>".$LDUnitPrice."</td>\n" ;
			$table_head .= "<td>".$LDTotalAmount."</td>\n" ;
			$table_head.="</tr>\n";
		}
		echo $table_head;
	}
	
  function DisplayServiceResultRows($start_timeframe, $end_timeframe, $admission, $bill){
		global $db;
		global $PRINTOUT;
		global $LDLookingforServiceReports,$LDstarttime,$LDendtime,$LDNothinginList,$LDNA,$LDtotal;
		$debug=FALSE;
		($debug)?$db->debug=TRUE:$db->debug=FALSE;

		$end_timeframe += (24*60*60-1);
		if (!$PRINTOUT) {
			$bg_color_1="#ffffaa";
			$bg_color_2="#ffffbb";
		} else {
			$bg_color_1="";
			$bg_color_2="";
		}
		$bg_color_swich=FALSE;
		
		if($bill =="")
		{
		$s_bill = "";
		}
		else
		if($bill ==1)
		{
		$s_bill = " AND insurance_id = 0 ";
		}
		if($bill ==2)
		{
		$s_bill = " AND insurance_id != 0 ";
		}

	$this->_Create_billing_tmp_master_table($start_timeframe,$end_timeframe,$admission,$bill);

		echo "Looking for Services Reports by time range: starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s",$end_timeframe)."<br><br><br>";
		$sql="SELECT item_number, description, price FROM tmp_billing_master WHERE purchasing_class='service' $s_bill GROUP BY item_number, price";
		$rs_ptr=$db->Execute($sql);
		$table="";
		if ($res_array = $rs_ptr->GetArray()) {

			while (list($u,$v)=each($res_array)) {

				if ($bg_color_swich) {
					$bg_color=$bg_color_1;
					$bg_color_swich=FALSE;
				} else {
					$bg_color=$bg_color_2;
					$bg_color_swich=TRUE;
				} // end of if ($bg_color_swich)

				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$v['description'];
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
                                $table.="  ".$v['price'];
                                $table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".$this->_GetSumOfItemAmount($v['item_number']);
				$table.="</td>\n";

				$table.="<td align=\"right\">\n";
				$table.="  ".number_format($this->_GetTotalSumOfItemAmount($v['item_number']), 0, '.', ',');
				$table.="</td>\n";
				$table.="</tr>\n";
			} // end of while (list($u,$v)=each($res_array))
		} else {
				$table .= "<tr bgcolor=$bg_color>\n";

				$table.="<td>\n";
				$table.="  ".$LDNothinginList;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.="N/A";
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="<td>\n";
				$table.=$LDNA;
				$table.="</td>\n";

				$table.="</tr>\n";
		} // End of if ($res_array = $rs_ptr->GetArray())
		$table .= "<tr bgcolor=$bg_color>\n";

		$table.="<td align=\"right\">\n";
		$table.="<b>".$LDtotal." &sum;</b>";
		$table.="</td>\n";
		$table.="<td>\n";
		$table.="<td>\n";
		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="<td align=\"right\">\n";
		$table.="  <b>".number_format($this->_GetTotalSumOfItems('service'),0,'.',',')."</b>";
		$table.="</td>\n";

		$table.=" &nbsp;";
		$table.="</td>\n";

		$table.="</tr>\n";


		echo $table;
	}


  function SetReportingLink_OPDAdmission($tbl1,$tbl1_key,$tbl1_key1, $tbl2,$tbl2_key,$tbl2_key1) {
    global $db;
    if ($this->debug) echo "class_report::SetReportingLink_OPDAdmission($tbl1,$tbl1_key, $tbl2,$tbl2_key)<br>";
	// enlarge the max_tmp_table_size to the maximum what we can use:
	$this->Transact("SET @@max_heap_table_size=4294967296");
    if ( ! (empty($tbl1) || empty($tbl1_key) || empty($tbl1_key1) || empty($tbl2) || empty($tbl2_key) || empty($tbl2_key1)) ) {

      // For a given existing table from the database, we need more specific informations in the alias field

      // check it for table 1:
      $result_fields_tbl1 = $this->_SetColumnNamesAsString($tbl1,$this->GetFieldnames($tbl1));
      // check it for table 2:
      $result_fields_tbl2 = $this->_SetColumnNamesAsString($tbl2,$this->GetFieldnames($tbl2));

      // There are no TEXT nor BLOBS in TEMPORARY tables allowed: Clean it:
      $result_fields = $this->_ColumnNames($tbl1,$result_fields_tbl1,$tbl2,$result_fields_tbl2);

      $this->setTable($this->tmp_tbl_name.=time());
      $this->sql="CREATE TEMPORARY TABLE $this->coretable TYPE=HEAP SELECT $result_fields FROM $tbl1 INNER JOIN $tbl2 ON $tbl1.$tbl1_key=$tbl2.$tbl2_key and date_format( $tbl1.$tbl1_key1, '%d.%m.%y' )=date_format( $tbl2.$tbl2_key1, '%d.%m.%y' ) ";
      return ($this->Transact($this->sql)) ? $this->coretable : FALSE;
    } else {
      return FALSE;
    }
  }


}

?>
