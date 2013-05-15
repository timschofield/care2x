<?php
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

global $db;
$debug=false;
($debug) ? $db->debug=true : $db->debug=FALSE;

if($_REQUEST['discharge'] == true)
{
	$sql="UPDATE `care_encounter` SET `is_discharged` = '1',`discharge_date` = curdate(),`discharge_time` = curtime() WHERE IS_discharged = '0'";
	$result=$db->Execute($sql);
}
if($_REQUEST['movebills2archive']==true)
{
	$sql="INSERT INTO care_tz_billing_archive (`nr`,`encounter_nr`, `first_date`, `create_id`) SELECT `nr`, `encounter_nr`, `first_date`, `create_id` FROM care_tz_billing";
	$db->Execute($sql);
	$sql="INSERT INTO care_tz_billing_archive_elem
                      (	`nr`,
			`date_change`,
			`is_labtest`,
			`is_medicine`,
			`is_comment`,
			`is_paid`,
			`amount`,
			`price`,
			`balanced_insurance`,
			`insurance_id`,
			`description`,
			`item_number`,
			`prescriptions_nr`,
			`User_Id`
			)
                  SELECT
			`nr`,
			`date_change`,
			`is_labtest`,
			`is_medicine`,
			`is_comment`,
			1,
			`amount`,
			`price`,
			`balanced_insurance`,
			`insurance_id`,
			`description`,
			`item_number`,
			`prescriptions_nr`,
			`User_Id`
		FROM care_tz_billing_elem";
	$db->Execute($sql);
	//$sql="UPDATE care_tz_billing_archive_elem SET user_id='admin' where user_id=''";
	//$db->Execute($sql);
	$sql="UPDATE care_encounter_prescription SET bill_status='archived'WHERE bill_status=''";
	$db->Execute($sql);
	$sql="UPDATE care_test_request_chemlabor SET bill_status='archived' WHERE bill_status=''";
	$db->Execute($sql);
	$sql="DELETE FROM care_tz_billing";
	$db->Execute($sql);
	$sql="DELETE FROM care_tz_billing_elem";
	$db->Execute($sql);
}
if($_REQUEST['prescription']==true)
{

$sql="create table tmp_prescription
 		SELECT pr.encounter_nr, pr.status, pr.article_item_number
		FROM care_encounter_prescription as pr
 		inner join care_tz_drugsandservices as dr on (pr.article_item_number=dr.item_number)
 		WHERE (pr.status='pending' OR pr.status='')
 		AND ( dr.purchasing_class = 'drug_list' OR dr.purchasing_class='supplies')";
$db->Execute($sql);

$sql="UPDATE care_encounter_prescription set status='done'
 		WHERE encounter_nr in
		(
 			SELECT encounter_nr
 			FROM tmp_prescription
 		)";
$db->Execute($sql);

$sql=" drop table tmp_prescription";
$db->Execute($sql);

}



$sql="Select count(*) as count from care_tz_billing";
$result=$db->Execute($sql);
$bill_count=$result->FetchRow();

$sql="select count(*) from `care_encounter` WHERE IS_discharged = '0'";
$result=$db->Execute($sql);
$admited_patient_count=$result->FetchRow();

$sql="	SELECT count(*)
		FROM care_encounter_prescription as pr
		inner join care_tz_drugsandservices as dr on (pr.article_item_number=dr.item_number)
		WHERE (pr.status='pending' OR pr.status='')
 		AND ( dr.purchasing_class = 'drug_list' OR dr.purchasing_class='supplies') ";
$result=$db->Execute($sql);
$pending_prescription_count=$result->FetchRow();


?>

<HTML>
<HEAD>
 <TITLE>Generally Management - </TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta name="Author" content="Elpidio Latorilla">
<meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo $sid."&lang=".$lang;?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->

</script>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo $sid."&lang=".$lang;?>&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>


</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >
<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">
	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066">Database Maintanance</font>
       </td>
  <td bgcolor="#99ccff" align=right><a
   href="edv_generally_management.php?sid=<?php echo $sid."&lang=".$lang;?>&ntid=false"><img src="../../gui/img/control/blue_aqua/en/en_back2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a><a
   href="javascript:gethelp('edp.php','access','')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="edv-system-admi-welcome.php?sid=<?php echo $sid."&lang=".$lang;?>&ntid=false" ><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>

 </table>

 <br><br>
 <form  method="post" name="form">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $bill_count[0]; ?></b> Pendings Billing:</FONT></td>
	<td  align="left"><FONT><a href="edv_database_maintanance.php?movebills2archive=true">Click here to move all Pending Bills to Archive</a> </FONT></td>
</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $admited_patient_count[0]; ?></b> admited Patient: </FONT></td>
	<td  align="left"><FONT><a href="edv_database_maintanance.php?discharge=true">Click here to discharge all Patient</a> </FONT></td>
</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b><?php echo $pending_prescription_count[0]; ?></b> Pending Prescription: </FONT></td>
	<td  align="left"><FONT><a href="edv_database_maintanance.php?prescription=true">Click here to move out all pending prescription </a> </FONT></td>
</tr>


</table>
</form>


<ul>
</html>
