<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<?php
echo '<script language="JavaScript">';
	require($root_path.'include/inc_checkdate_lang.php');
echo '</script>';
echo '<script language="javascript" src="'.$root_path.'js/setdatetime.js"></script>';
echo '<script language="javascript" src="'.$root_path.'js/checkdate.js"></script>';
echo '<script language="javascript" src="'.$root_path.'js/dtpick_care2x.js"></script>';
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function submitForm()
  {
    action="eye_examination.php"
  submit();

  return true;
  }

//-->
</script>
<title>EYE Patient Examination</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--

.error {
	color: red;
	font-weight: bold;
}

fieldset {
	width:775px;
	margin-top:15px;
	margin-left:20px;
	background-color:#E8F2FF;
}


-->
</style>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff"><font color="#330066">&nbsp;&nbsp;Eye Examination Report</font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php echo $errorMessages ?>


</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Registration Data</strong></legend>
<table width="750" border="0">
  <tr>
    <td bgcolor="#F0F8FF"><strong>Health Facility File Number: </strong><?php echo $registration_data['facility_file_number']; ?></td>
    <td bgcolor="#F0F8FF"><strong>PID: </strong><?php echo $pid=$registration_data['pid']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Sex: </strong><?php echo $registration_data['sex']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Date of Birth: </strong><?php echo formatDate2Local($registration_data['date_of_birth'],$date_format,null,null); ?></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Name:</strong> <?php echo $registration_data['name']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Marital Status: </strong> <?php echo $registration_data['marital_status']; ?></td>
    <td colspan="2" bgcolor="#F0F8FF"><strong>Age:</strong> <?php echo $registration_data['age']; ?></td>
  </tr>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Patient Adress </strong></legend>
<table width="750" border="0">
  <tr>
    <td bgcolor="#F0F8FF"><strong>District: <?php echo $registration_data['district']; ?></strong></td>
    <td bgcolor="#F0F8FF"><strong>Division: <?php echo $registration_data['division']; ?></strong></td>
    <td bgcolor="#F0F8FF"><strong>Ward: </strong> <?php echo $registration_data['ward']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#F0F8FF"><strong>Street: </strong>  <?php echo $registration_data['street']; ?></td>
    <td bgcolor="#EAF4FF"><strong>Village: </strong>  <?php echo $registration_data['village']; ?></td>
    <td bgcolor="#F0F8FF"><strong>Telephone:</strong>  <?php echo $registration_data['telephone']; ?></td>
  </tr>
</table>
</fieldset>

<form  method="post" action="">
<fieldset>
<legend onClick="toggle(this)"><strong>Visual Acuity</strong></legend>
<table width="750" border="0">
<?
 $sql_visual_report="SELECT * from care_tz_eye_visualacuity where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2'] ?>, <?php echo $report['right_eye_test3'] ?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?>, <?php echo $report['left_eye_test2'] ?>, <?php echo $report['left_eye_test3'] ?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>

  </table>
</fieldset>


<fieldset>
<legend onClick="toggle(this)"><strong>Intraocular pressure</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_intraocularpressure where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?> </td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> , <?php echo $report['test3'] ?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>

</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Facial, ocular, orbital symmetry</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_facial_ocular_orbitalsymmetry where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> </td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?> </td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>

</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Squint/strabismus</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_squint_strabismus where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?> </td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?> </td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>

</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Trauma</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_trauma where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> , <?php echo $report['right_eye_test8']?>, <?php echo $report['right_eye_test9']?>, <?php echo $report['right_eye_test10']?>, <?php echo $report['right_eye_test11']?>, <?php echo $report['right_eye_test12']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?>,<?php echo $report['left_eye_test8']?>,<?php echo $report['left_eye_test9']?>,<?php echo $report['left_eye_test10']?>,<?php echo $report['left_eye_test11']?>,<?php echo $report['left_eye_test12']?> </td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Eyelids</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_eyelids where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> , <?php echo $report['right_eye_test8']?>, <?php echo $report['right_eye_test9']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?>,<?php echo $report['left_eye_test8']?>,<?php echo $report['left_eye_test9']?> </td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Conjunctiva</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_conjunctiva where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> , <?php echo $report['right_eye_test8']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?>,<?php echo $report['left_eye_test8']?> </td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Cornea</strong></legend>
<table width="750" border="0">

<?php

 $sql_visual_report="SELECT * from care_tz_eye_cornea  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> </td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Anterior segment(A/C)</strong></legend>
<table width="750" border="0">


<?php

 $sql_visual_report="SELECT * from care_tz_eye_anterior_segment  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> </td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>
<fieldset>
<legend onClick="toggle(this)"><strong>Lens</strong></legend>
<table width="750" border="0">


<?php

 $sql_visual_report="SELECT * from care_tz_eye_lens  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> , <?php echo $report['right_eye_test9']?>, <?php echo $report['right_eye_test9']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?>,<?php echo $report['left_eye_test8']?>,<?php echo $report['left_eye_test9']?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>

<fieldset>
<legend onClick="toggle(this)"><strong>Posterior segment</strong></legend>
<table width="750" border="0">


<?php

 $sql_visual_report="SELECT * from care_tz_eye_posterior_segment  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?>, <?php echo $report['right_eye_test7']?> , <?php echo $report['right_eye_test9']?>, <?php echo $report['right_eye_test9']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?>,<?php echo $report['left_eye_test7']?>,<?php echo $report['left_eye_test8']?>,<?php echo $report['left_eye_test9']?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>

<fieldset>
<legend onClick="toggle(this)"><strong>Optic disc</strong></legend>
<table width="750" border="0">


<?php

 $sql_visual_report="SELECT * from care_tz_eye_optic_disc   where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>
  <td colspan="2" bgcolor="#F0F8FF">

      ExaminationDate: <?php echo $report['Examination_date'] ?></td>

    <td bgcolor="#F0F8FF">


    RightEye:  <?php echo $report['right_eye_test1']?>, <?php echo $report['right_eye_test2']?>, <?php echo $report['right_eye_test3']?>, <?php echo $report['right_eye_test4']?>, <?php echo $report['right_eye_test5']?>, <?php echo $report['right_eye_test6']?></td>
    <td colspan="2" bgcolor="#F0F8FF">

      LeftEye: <?php echo $report['left_eye_test1']?> ,<?php echo $report['left_eye_test2']?> ,<?php echo $report['left_eye_test3']?>,<?php echo $report['left_eye_test4']?>,<?php echo $report['left_eye_test5']?>,<?php echo $report['left_eye_test6']?></td>

  <td colspan="2" bgcolor="#F0F8FF">

      Comments: </td>



  </tr>

<?php } ?>
</table>
</fieldset>



<fieldset>
<legend onClick="toggle(this)"><strong>History Report 1</strong></legend>
<table width="750" border="0">

<!--<tr><td>Examination Date</td><td>Patient Compalin</td><td>Which Eye</td><td>Duration</td><td>Remarks</td><td>Signature</td>-->
<?php

 $sql_visual_report="SELECT * from care_tz_eye_history1  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>


<td>Examination Date:<?php echo $report['examination_date'] ?></td><td>Patient Complaint:<?php echo $report['hid1'] ?>:<?php echo $report['hid1e'] ?>,<?php echo $report['hid1d'] ?> ;<?php echo $report['hid2'] ?>:<?php echo $report['hid2e'] ?>,<?php echo $report['hid2d'] ?>;<?php echo $report['hid3'] ?>:<?php echo $report['hid3e'] ?>,<?php echo $report['hid3d'] ?>;<?php echo $report['hid4'] ?>:<?php echo $report['hid4e'] ?>,<?php echo $report['hid4d'] ?>;<?php echo $report['hid5'] ?>:<?php echo $report['hid5e'] ?>,<?php echo $report['hid5d'] ?></td>



  </tr>

<?php } ?>
</table>
</fieldset>

<fieldset>
<legend onClick="toggle(this)"><strong>History Report 2</strong></legend>
<table width="750" border="0">

<!--<tr><td>Examination Date</td><td>Patient Compalin</td><td>Which Eye</td><td>Duration</td><td>Remarks</td><td>Signature</td>-->
<?php

 $sql_visual_report="SELECT * from care_tz_eye_history2  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>


<td>Examination Date:<?php echo $report['examination_date'] ?></td><td>Patient Complaint:<?php echo $report['hid1'] ?>:<?php echo $report['hid1e'] ?>,<?php echo $report['hid1d'] ?> ;<?php echo $report['hid2'] ?>:<?php echo $report['hid2e'] ?>,<?php echo $report['hid2d'] ?>;<?php echo $report['hid3'] ?>:<?php echo $report['hid3e'] ?>,<?php echo $report['hid3d'] ?>;<?php echo $report['hid4'] ?>:<?php echo $report['hid4e'] ?>,<?php echo $report['hid4d'] ?>;<?php echo $report['hid5'] ?>:<?php echo $report['hid5e'] ?>,<?php echo $report['hid5d'] ?>;<?php echo $report['hid6'] ?>:<?php echo $report['hid6e'] ?>,<?php echo $report['hid6d'] ?>;<?php echo $report['hid7'] ?>:<?php echo $report['hid7e'] ?>,<?php echo $report['hid7d'] ?>;<?php echo $report['hid8'] ?></td>



  </tr>

<?php } ?>
</table>
</fieldset>


<fieldset>
<legend onClick="toggle(this)"><strong>History Report 3</strong></legend>
<table width="750" border="0">

<!--<tr><td>Examination Date</td><td>Patient Compalin</td><td>Which Eye</td><td>Duration</td><td>Remarks</td><td>Signature</td>-->
<?php

 $sql_visual_report="SELECT * from care_tz_eye_history3  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>


<td>Examination Date:<?php echo $report['examination_date'] ?></td><td>Patient Complaint:<?php echo $report['hid1'] ?>:<?php echo $report['hid1e'] ?>,<?php echo $report['hid1d'] ?> ;<?php echo $report['hid2'] ?>:<?php echo $report['hid2e'] ?>,<?php echo $report['hid2d'] ?>;<?php echo $report['hid3'] ?>:<?php echo $report['hid3e'] ?>,<?php echo $report['hid3d'] ?>;<?php echo $report['hid4'] ?>:<?php echo $report['hid4e'] ?>,<?php echo $report['hid4d'] ?>;<?php echo $report['hid5'] ?>:<?php echo $report['hid5e'] ?>,<?php echo $report['hid5d'] ?>;<?php echo $report['hid6'] ?></td>



  </tr>

<?php } ?>
</table>
</fieldset>


<fieldset>
<legend onClick="toggle(this)"><strong>History Report 4</strong></legend>
<table width="750" border="0">

<!--<tr><td>Examination Date</td><td>Patient Compalin</td><td>Which Eye</td><td>Duration</td><td>Remarks</td><td>Signature</td>-->
<?php

 $sql_visual_report="SELECT * from care_tz_eye_history4  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>


<td>Examination Date:<?php echo $report['examination_date'] ?></td><td>Patient Complaint:<?php echo $report['hid1'] ?>:<?php echo $report['hid1e'] ?>,<?php echo $report['hid1d'] ?> ;<?php echo $report['hid2'] ?>:<?php echo $report['hid2e'] ?>,<?php echo $report['hid2d'] ?>;<?php echo $report['hid3'] ?>:<?php echo $report['hid3e'] ?>,<?php echo $report['hid3d'] ?>;<?php echo $report['hid4'] ?>:<?php echo $report['hid4e'] ?>,<?php echo $report['hid4d'] ?>;<?php echo $report['hid5'] ?>:<?php echo $report['hid5e'] ?>,<?php echo $report['hid5d'] ?>;<?php echo $report['hid6'] ?>:<?php echo $report['hid6e'] ?>,<?php echo $report['hid6d'] ?>;<?php echo $report['hid7'] ?></td>



  </tr>

<?php } ?>
</table>
</fieldset>

<fieldset>
<legend onClick="toggle(this)"><strong>History Report 5</strong></legend>
<table width="750" border="0">

<!--<tr><td>Examination Date</td><td>Patient Compalin</td><td>Which Eye</td><td>Duration</td><td>Remarks</td><td>Signature</td>-->
<?php

 $sql_visual_report="SELECT * from care_tz_eye_history5  where pid = '$pid'";
				$db_visual_report = mysql_query($sql_visual_report);
			 while($report=mysql_fetch_array($db_visual_report))
		{




?>
<tr>


<td>Examination Date:<?php echo $report['examination_date'] ?></td><td>Patient Complaint:<?php echo $report['hid1'] ?>:<?php echo $report['hid1e'] ?>,<?php echo $report['hid1d'] ?> ;<?php echo $report['hid2'] ?>:<?php echo $report['hid2e'] ?>,<?php echo $report['hid2d'] ?>;<?php echo $report['hid3'] ?>:<?php echo $report['hid3e'] ?>,<?php echo $report['hid3d'] ?>;<?php echo $report['hid4'] ?>:<?php echo $report['hid4e'] ?>,<?php echo $report['hid4d'] ?>;<?php echo $report['hid5'] ?>:<?php echo $report['hid5e'] ?>,<?php echo $report['hid5d'] ?>;<?php echo $report['hid6'] ?>:<?php echo $report['hid6e'] ?>,<?php echo $report['hid6d'] ?>;<?php echo $report['hid7'] ?>:<?php echo $report['hid7e'] ?>,<?php echo $report['hid7d'] ?></td>



  </tr>

<?php } ?>
</table>
</fieldset>





</form>
    </p>
  <p>&nbsp;</p></td>
</tr>
</body>
</html>
