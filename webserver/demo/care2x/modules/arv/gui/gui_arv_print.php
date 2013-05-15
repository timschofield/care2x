<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<title>ARV Print</title>
<style type="text/css">
<!--
body {
    color: black; background-color: white;
    font-family: Arial, Helvetica, sans-serif;
    margin-top:1.5cm;
	margin-left:1.5cm;
	margin-right:1.5cm;
	position:absolute;
}

table {
	width:18cm;
	border:thin solid black;
	margin-bottom:2mm;
	border-collapse:collapse;
}

.title {
	font-size: 5mm;
	margin-bottom:1mm;
	font-weight: bold;
}

.mainTable {
	font-size: 4mm;
	table-layout:auto;
}

td> table {
	border:none;
	width:40%;
}

.patientdata {
	font-weight: bold;
}

.table2 {
	font-size: 3mm;
	
}

td {
	padding-right:1mm;
	padding-left:1mm;
}
.sonstiges {
	font-weight: bold;
	
}
.blue {
	font-weight: bold;
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
<div class="title">PATIENT RECORD FORM </div>
<?php echo $o_arv_case->displayARVData()?>
<?php echo $o_arv_case->displayARVData2()?>
<table class="table2" border=1 >
  <tr>
    <td width="30%" class="sonstiges"><div align="right">Date:</div></td>
    <td width="70%" ><?php echo formatDate2Local(date('Y-m-d',$visit_data['create_time']),$date_format) ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Weight:</div></td>
    <td><?php echo $visit_data['weight'];?> kg</td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">New AIDS defining events: </div></td>
    <td><?php echo $codes_string;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Hospitalization, pregnancy, other problems, complications, please mention: </div></td>
    <td><?php echo $visit_data['other_problems'];?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Confirmed new TB case:</div></td>
    <td><?php echo $label[$visit_data['test_TB']];?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Cotrimoxazole:</div></td>
    <td><?php echo $label[$visit_data['test_Cotrimoxazole']] ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">INH:</div></td>
    <td><?php echo $label[$visit_data['test_INH']] ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Difflucan:</div></td>
    <td><?php echo $label[$visit_data['test_Difflucan']] ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Codes for arv therapy: </div></td>
    <td><?php echo $o_arv_visit->displaySelectedARVDrugs_String() ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">ARV Status:</div></td>
    <td><?php echo $visit_data['care_tz_arv_status_id'].". ".$label2[$visit_data['care_tz_arv_status_id']] ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Why start, change, stop: </div></td>
    <td><?php echo $o_arv_visit->displaySelectedItems_table($_GET['a_item_no'])?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Relevant co-medication: </div></td>
    <td><?php echo $o_arv_visit->displayAllDrugs();?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">CD 4 count or %: </div></td>
    <td><?php echo $o_arv_visit->displayLabParamFromName('CD4');?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Hb:</div></td>
    <td><?php $o_arv_visit->displayLabParamFromName('Hemoglobin (Hb)');?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Abnormal lab results: </div></td>
    <td><?php echo $o_arv_visit->displayLabResults_table() ;?></td>
  </tr>
  <tr>
    <td class="sonstiges"><div align="right">Sign clinician: </div></td>
    <td><?php echo $visit_data['create_id'] ;?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
