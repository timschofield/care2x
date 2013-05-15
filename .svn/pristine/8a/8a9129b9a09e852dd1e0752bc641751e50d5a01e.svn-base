<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<title>ART Overview</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.body {
	position:absolute;
	margin-top:1.5cm;
	
}

.mainTable {
	width:17.7 cm;
	margin-top:0.5cm;
	margin-bottom:0.5cm;
	font-size:4 mm;
	margin-left:0.1cm;
	border-collapse: collapse;
    background-color:white;
    
	table-layout:auto;    
	font-family: Arial, Helvetica, sans-serif;
}
	
.mainTable td {
	border:1px solid black;
	background-color:white;
	padding-left:2 mm;
}

h1 {
	font-family:Arial, Helvetica, sans-serif;
	font-size:17px;
	margin-left:0.1cm;
	color:black;
}

h2,caption {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color:black;
	font-weight:bold;
}


-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
	this.window.print();
//-->
</script>
</head>
<body>
<h1>THE UNITED REPUBLIC OF TANZANIA
  <br>
MINISTRY OF HEALTH AND SOCIAL WELFARE</h1>
<h1><br>
  NATIONAL HIV CARE AND TREATMENT </h1>
<table width="740" border="0" class="mainTable">
  <tr>
    <td width="304" bgcolor="#F0F8FF"><strong>Facility Name: </strong><?php echo $facility_info['main_info_facility_name']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Facility Code: </strong><?php echo $facility_info['main_info_facility_code']; ?></td>
    <td width="159" bgcolor="#F0F8FF"><strong>District: </strong><?php echo $facility_info['main_info_facility_district']; ?></td>
  </tr>
  <tr>
    <td bordercolor="#99ccff" bgcolor="#F0F8FF"><strong>Unique CTC ID Number: </strong><?php echo $art_data['ctc_id']?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Health Facility File Number: </strong><?php echo $registration_data['facility_file_number']; ?></td>
    <td bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Name:</strong> <?php echo $registration_data['name']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Sex: </strong><?php echo $registration_data['sex']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Date of birth: </strong><?php echo formatDate2Local($registration_data['date_of_birth'],$date_format,null,null); ?></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Age: </strong> <?php echo $registration_data['age']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Marital Status: </strong><?php echo $registration_data['marital_status']; ?></td>
    <td bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Date of first HIV+ Test: </strong><?php echo $art_data['date_first_hiv_test']?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Patient Telephone Number: </strong><?php echo $registration_data['telephone']; ?></td>
    <td bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#F0F8FF"><strong>Patient Referred From: </strong><?php echo $art_data['referred_from_text']; ?></strong></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#F0F8FF"><strong>Patient Adress: </strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F0F8FF"><strong>District/Division/Ward: </strong><?php echo $registration_data['district']; ?>  <?php echo $registration_data['division']; ?>  <?php echo $registration_data['ward']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Street/Village: </strong><?php echo $registration_data['street']; ?> <?php echo $registration_data['village']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Street/Village/Hamlet Chairman: </strong><?php echo $art_data['chairman_vname']." ".$art_data['chairman_nname']." ".$art_data['chairman_street']." ".$art_data['chairman_village']." ".$art_data['chairman_hamlet'] ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Ten Cell Leader: </strong><?php echo $art_data['ten_cell_leader']?></td>
  </tr>
  <tr>
    <td colspan="4" align="right" bgcolor="#F0F8FF"><div align="left"><strong>Head of Household: </strong><?php echo $art_data['head_of_household']?></div>      <div align="left"></div></td>
  </tr>
</table>
<table width="740" border="0" class="mainTable">
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Drug Allergies: </strong>
	<?php 
		foreach ($art_data['allergies'] as $var) {
			echo $var.", ";
		}
	?>	</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Treatment Supporter Information: </strong></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Name Treatment Supporter: </strong><?php echo $art_data['supporter_vname']." ".$art_data['supporter_nname']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Treatment Supporter Adress: </strong><?php echo $art_data['supporter_street']." ".$art_data['supporter_village']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Treatment Supporter Telephone Number: </strong><?php echo $art_data['supporter_telephone']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Community Support Organisation/Group: </strong><?php echo $art_data['supporter_organisation']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF"><strong>Prior ARV Exposure: </strong></strong><?php echo $art_data['exposure_text']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Date Confirmed HIV+: </strong><?php echo $art_data['date_confirmed_hiv']?></td>
    <td colspan="3" bgcolor="#F0F8FF"><strong>Date eligible &amp; ready: </strong><?php echo $art_data['date_ready']?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Date Enrolled in care: </strong><?php echo $art_data['date_enrolled']?></td>
    <td colspan="3" bgcolor="#F0F8FF"><strong>Date start ART: </strong><?php echo $art_data['date_start_art']?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Date med.eligible: </strong><?php echo $art_data['date_eligible']?></td>
    <td colspan="3" bgcolor="#F0F8FF"><strong>Why eligible: </strong><?php echo $art_data['eligible_reason_text']?></td>
  </tr>
  <tr>
    <td colspan="5" bgcolor="#F0F8FF">&nbsp;</td>
  </tr>
  <tr>
    <td width="178" bgcolor="#F0F8FF"><strong>Status at start ART: </strong></td>
    <td width="122" bgcolor="#F0F8FF"><strong>Clinical Stage: </strong><?php echo $art_data['status_clinical_stage']?></td>
    <td width="222" bgcolor="#F0F8FF"><strong>Function: </strong><?php echo $art_data['status_function_text']?></td>
    <td width="98" bgcolor="#F0F8FF"><strong>Weight: </strong><?php echo $art_data['status_weight']?></td>
    <td width="86" bgcolor="#F0F8FF"><strong>CD4:</strong> <?php echo $art_data['status_cd4']?></td>
  </tr>
</table>
<table width="750" border="0" class="mainTable">
  <tr>
    <td width="79" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Visit Date </span></strong></div></td>
    <td width="93" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Weight/ <br />
    Height </span></strong></div></td>
    <td width="57" bgcolor="#99ccff"><div align="center"><strong><span class="style2"> WHO <br />
      Clinical <br />
    Stage </span></strong></div></td>
    <td width="125" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Aids defining illness,<br />
      new symptoms, side<br />
    effects, hospitalized </span></strong></div></td>
    <td width="54" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Pregnant</span></strong></div></td>
    <td width="64" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Functional<br />
    Status</span></strong></div></td>
    <td width="79" bgcolor="#99ccff"><div align="center"><strong><span class="style2">TB <br />
    Status</span></strong></div></td>
    <td width="58" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Cotrim</span></strong></div></td>
    <td width="51" bgcolor="#99ccff"><div align="center"><strong><span class="style2">Diflucan</span></strong></div></td>
    <td width="60" bgcolor="#99ccff"><div align="center"><strong><span class="style2">ARV<br />
    Status</span></strong></div></td>
    <td width="45" bgcolor="#99ccff"><div align="center"><strong><span class="style2">ARV<br />
    Reason</span></strong></div></td>
  </tr>
  <?php 
  $BGCOLOR='#E8F2FF';
  foreach($visit_table_rows as $row) {
  	$table_string="<tr tr bgcolor=\"#F0F8FF\">";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['visit_date']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['weight_height']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['clinical_stage']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['illness_code']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['pregnancy']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['functional_status']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['tb_status']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['cotrim']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['diflucan']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['status']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['status_txt_code']."&nbsp;</div></td>";
	$_REQUEST['encounter_nr']."&mode=edit&pid=".$_REQUEST['pid']."\">edit&gt;&gt;</a></strong></div></td>" ;
	$table_string.="</tr>";
	echo $table_string;
	if($BGCOLOR=='#E8F2FF') {$BGCOLOR='#F0F8FF';}
	elseif($BGCOLOR=='#F0F8FF') {$BGCOLOR='#E8F2FF';}
  }
  ?>
</table>
<table width="750" border="0" class="mainTable"><caption>CTC 2: PATIENT RECORD FORM</caption>
  <tr>
    <td bgcolor="#99ccff"><p align="center" class="style3"><strong>ARV Combin.<br />
    Regimen </strong></p></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">ARV Adherr <br />
    Status </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Relevant <br />
    CO-Meds </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">CD4 <br />
    Count / % </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">HB</span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">ALT</span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Abnormal<br />
      Lab Results/ <br />
    Others</span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Nutrition <br />
      Support <br />
    needed </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Referred<br />
    to </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Next Visit <br />
    Date </span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Follow<br />
      UP<br />
    Status</span></strong></div></td>
    <td bgcolor="#99ccff"><div align="center"><strong><span class="style2">Signature <br />
    of Clinician </span></strong></div></td>
  </tr>
  <?php 
  $BGCOLOR='#E8F2FF';
  foreach($visit_table_rows as $row) {
  	$table_string="<tr>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['regimen_combined']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['adher_combined']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['drugsandservices']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['cd4']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['hb']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['alt']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['laboratory_param']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['nutrition_support']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['referred_code']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['next_visit_date']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['follow_status_code']."&nbsp;</div></td>";
	$table_string.="<td bgcolor='$BGCOLOR'><div align=\"center\">".$row['signature']."&nbsp;</div></td>";
	$_REQUEST['encounter_nr']."&mode=edit&pid=".$_REQUEST['pid']."\">edit&gt;&gt;</a></strong></div></td>" ;
	$table_string.="</tr>";
	echo $table_string;
	if($BGCOLOR=='#E8F2FF') {$BGCOLOR='#F0F8FF';}
	elseif($BGCOLOR=='#F0F8FF') {$BGCOLOR='#E8F2FF';}
  }
  ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
