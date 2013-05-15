<html>
<head>
<script language="javascript"> this.window.print(); </script>
<title>Insurance Companies - Member Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/themes/default/default.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<script language="javascript" src="../../js/check_insurance_form.js"></script>

</head>

<body onSubmit="javascript:submit_form(this,'insurance_members_tz.php','<?php echo $sid ?>','search');">
<table width="100%" border="0">
 <tr valign=top>
  <td bgcolor="#99ccff" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	  <tr  class="titlebar" >
	  	<td>&nbsp;&nbsp;<font color="#330066">Insurance Contract</font></td>
	  	<td align="right" width="213"><a href="javascript:window.close()"><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)"></a>
	  	</td>
	  </tr>
  </table>
    </td>
 </tr>
<?php 
$contract = $insurance_tz->GetContractsByIDAsArray($id);
$company = $insurance_tz->GetInsuranceAsArray($contract['company_id']);

?>
  <tr>
    <td align="center">
    	<b><?php echo $hosp_name;?></b><br><br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
	<tr>
		<td>AGREEMENT WITH:</td><td><b><?php echo $company['name']; ?></b></td>
	</tr>
	<tr>
		<td>ADDRESS:</td><td><b>PO Box:<?php echo $company['po_box'].'<br>';
		echo $company['city']; ?></b></td>
	</tr>
</table><br><br>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
	<tr>
		<td>

It is hereby agreed by <br><?php echo $hosp_name;?> and <b><?php echo $company['name']; ?></b><br>
to enter into an agreement for the provision of medical care by <br><?php echo $hosp_name;?> <br>
to <b><?php echo $company['name']; ?></b> employees and families.<br><br>

<br><?php echo $hosp_name;?> agrees to provide hospital and clinic based medical care to<br>
<b><?php echo $company['name']; ?></b> Employees and designated members of their families.<br>
These designated family members are constituted as the employee's spouse and as many<br>
of the married couple's children as the employer wishes to enroll. The agreement is for a<br> 
one year period at a fixed cost per capital. Such registered persons are referred to as<br>
"Plan Members". It is agreed that at least 80% of the total employees and their family<br>
members will be enrolled in the plan.<br><br>

For the purpose of this agreement, hospital based medical care refers to those services<br>
and medications which are routinely available and on site at the <br><?php echo $hosp_name;?><br>
and the <br><?php echo $hosp_name;?>. This include the following services:<br><br>

 Hospital Outpatient Department<br>
 Inpatient Wards - Medicine, Surgery, Obstetrics, Gynacology and Paediatrics<br>
 Hospital Labor and Delivery<br>
 Surgical Theatre<br>
 General Laboratory<br>
 General X-Ray including Abdominal Ultrasonography<br>
 Maternal and Child Health Care<br>
 Private Ward<br>
 AIDS Couneling Service<br>
 Chaplaincy Services<br><br>

This is an agreement for the calendar year <b><?php echo date("Y",$contract['start_date']); ?></b>. The Premium will be pro-rated for<br>
the number of months of th! e calendar year actually contracted for contract. The contract<br>
will begin on <b><?php echo date("F Y",$contract['start_date']); ?></b>.<br><br>

<br><br><br><br>

<ol><li>All clients mut be provided with a photo identification.</li>
<li>All members are required to present identification at the hospital or clinic
 upon presentation to the hospital for care.</li>
<li>Services required or desired beyond what is available at <br><?php echo $hosp_name;?>
 are the responsibility of the patient
 and the employer and not of <br><?php echo $hosp_name;?>.</li>
<li>Transport to and from the hospi! tal or clinic are the patient's or employer's
 responsibility.</li>
<li>Members will be cared for by Clinical Officers and/or Medical Officers
 who are constantly available for referral and consultation.</li>
<li>Admissions to the hospital will be to the standard wards for the Silver Plan
 and to the private ward for the Gold Plan. Should a Silver plan patient
 prefer to be admitted to a private room the patient will be responsible for
 the difference in price for private compared to standard ward.</li>
<li>Dental care is not provided in this contract</li>
<li>This agreement does not cover routine physical exams, purchase of eye
 glasses, insurance physicals, or school admission physicals. These will be
 charged for separately.</li>
</ol><br><br><br>


Entry and exit from the plan:<br><br>

Employees and the ir families can be entered or removed from the plan on a<br>
quarterly basis. New entries must be approved by the hospital prior to entry.<br>
Existing employees must return their plan identification cards to the <br>
time of termination. No refund is provided for the quarter of termination.<br>
Death of an employee or family member does not qualify for a "substitute"<br>
recipient of care for the remainder of the year.  <br><br>


This agreement is signed this ____________ day of _________________, 20__ by:<br><br><br>

 
<table width="100%">
	<tr>
		<td>
			_______________________
		</td>
		<td>
			_______________________
		</td>
		<td>
			_______________________
		</td>
	</tr>
	<tr>
		<td>Employer</td>
		<td>Representative</td>
		<td>Witnessed by</td>
	</tr>
</table><br><br>
<hr>
<br><?php echo $hosp_name;?>

		</td>
  </tr>
</table>
</body>
</html>
