<?php
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>OPD Summary</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo $LDOPDAdmissionSummary; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
<table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDDay; ?></td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDTotalOPD; ?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php echo $LDNEW; ?></td>
            <td width="65" bgcolor="#ffffaa"><b><?php echo $LDRETURN; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo 'NEW'.$LDUNDERFIVE; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo 'NEW'.$LDAge; ?>5-14</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php echo 'RETURN '.$LDUNDERFIVE; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php echo 'RETURN '.$LDAge; ?>5-14</td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><b><?php echo $LDTotalPediatrics; ?></td>
          </tr>

		  <?php





		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";

		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {

		  	  $date_person_reg = $v['REGISTRATION_DATE'];
			  $sql_under_age="SELECT count( * ) AS Total_underage FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_under_age = $db->Execute($sql_under_age);
                           
			  $sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);

  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);


			  $sql_under_age_return="SELECT count( * ) AS Total_underage_return FROM $tmp_table1 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND date_format( encounter_date, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_under_age_return = $db->Execute($sql_under_age_return);
                          $sql_age5_14_return="SELECT count( * ) AS Total_age5_14_return FROM $tmp_table1 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=14 AND date_format( encounter_date, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14_return= $db->Execute($sql_age5_14_return);

			  $db_row_under_age_return=$db_ptr_under_age_return->FetchRow();
			  $db_row_age5_14_return=$db_ptr_age5_14_return->FetchRow();


			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();

			  $total_opd=$total_opd+$v['AMOUNT_ENCOUTERS'];
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			 $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			 $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];

			$total_underage_return=$total_underage_return+$db_row_under_age_return['Total_underage_return'];
			$total_age5_14_return=$total_age5_14_return+$db_row_age5_14_return['Total_age5_14_return'];

				$return_underage= $db_row_under_age_return['Total_underage_return']-$db_row_under_age['Total_underage'];
				$return_age5_14=$db_row_age5_14_return['Total_age5_14_return']-$db_row_age5_14['Total_age5_14'];
			  	$return_underage_total=$return_underage_total+$return_underage;
			  	$return_age5_14_total=$return_age5_14_total+$return_age5_14;
			  $total_paediatrics= $total_underage+$total_age5_14+$return_underage_total+$return_age5_14_total;

		  ?>
		    <table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><?php echo $v['REGISTRATION_DATE']; ?></td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo $v['AMOUNT_ENCOUTERS']; ?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $db_row_new['NEW'];?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $v['AMOUNT_ENCOUTERS']-$db_row_new['NEW']  ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage']; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_age5_14['Total_age5_14']; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $return_underage; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $return_age5_14; ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage'] + $db_row_age5_14['Total_age5_14']+$return_underage + $return_age5_14; ?></td>
          </tr>

		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php //echo $LDtotal; ?>LDtotal</td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php //echo $total_opd;?>total OPD</td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php //echo $total_new;?>total new</td>
            <td width="65" bgcolor="#ffffaa"><?php //echo $total_return;?>total return</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php //echo $total_underage ?>total new under 5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php //echo $total_age5_14 ?>total new over 5</td>

            <td width="100" bgcolor="#ffffaa" widtd="64"><?php //echo $return_underage_total?>total return under 5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php //echo $return_age5_14_total ?>total return over 5</td>
            <td width="155" bgcolor="#ffffaa" widtd="64"> <?php //echo $total_paediatrics ?>total patient</td>
          </tr>
        </table>
        <p>&nbsp; </p>

<?php
exit();
}
?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
	}
	function printOut()
    {
    	urlholder="./OPD_Admissions.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
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

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>


</HEAD>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT -->


<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingOPDAdmissionSummary; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
  </td>
 </tr>
 </table>

<!-- END HEAD OF HTML CONTENT -->

<form name="form1" method="post" action=""></p>
        <?php require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>
        <p><br>
          <br>
          <br>
        </p>
        <table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php //echo $LDDay; ?>Day</td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDTotalOPD; ?>Total OPD</td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><b><?php //echo $LDNEW; ?>New</td>
            <td width="65" bgcolor="#ffffaa"><b><?php //echo $LDRETURN; ?>Return</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDUNDERFIVE; ?>New under 5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'NEW '.$LDAge; ?>New Over 5</td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDUNDERFIVE; ?>Return Under 5</td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><b><?php //echo 'RETURN '.$LDAge; ?>Return Over 5</td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><b><?php //echo $LDTotalPediatrics; ?>Total Patient</td>
          </tr>

		  <?php





		// echo "Start time of the script:".date("G:i:s")."<br>";
		 //echo "Looking for test $TestID by time range: day: ".date("d.m.y", $start_timeframe)." starttime: ".date("d.m.y :: G:i:s",$start_timeframe)." endtime: ".date("d.m.y :: G:i:s", $end_timeframe)."<br>";

		  if ($debug) echo "elements in the array: ".sizeof($res_array)."<br>";
		  $db->Execute("SET @@max_heap_table_size=4294967296");
		  while(list($u,$v)=each($res_array) )
		  {

		  	  $date_person_reg = $v['REGISTRATION_DATE'];
			  $sql_under_age="SELECT count( * ) AS Total_underage FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_under_age = $db->Execute($sql_under_age);
                          //added by israel, age 5-14 dont apply to tz settings
                          // $sql_age5_14="SELECT count( * ) AS Total_underage FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
                          //israel ended here 
			  $sql_age5_14="SELECT count( * ) AS Total_age5_14 FROM $tmp_table2 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=1000 AND date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14 = $db->Execute($sql_age5_14);

  			  $sql_new="SELECT count( * ) AS NEW  FROM $tmp_table2 WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' ";
			  //$sql_new="SELECT count( * ) AS NEW  FROM care_person,care_encounter WHERE date_format( date_reg, '%d.%m.%y' ) ='$date_person_reg' and care_person.pid=care_encounter.pid and date_format( care_encounter.encounter_date, '%d.%m.%y' )=date_format( care_person.date_reg, '%d.%m.%y' )";
			  $db_ptr_new = $db->Execute($sql_new);


			  $sql_under_age_return="SELECT count( * ) AS Total_underage_return FROM $tmp_table1 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <5 AND date_format( encounter_date, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_under_age_return = $db->Execute($sql_under_age_return);
			  //added by israel, age 5-14 dont apply to tz settings
                          //$sql_age5_14_return="SELECT count( * ) AS Total_underage_return FROM $tmp_table1 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >5 AND date_format( encounter_date, '%d.%m.%y' ) ='$date_person_reg'";
                          //israel ended here 
                          $sql_age5_14_return="SELECT count( * ) AS Total_age5_14_return FROM $tmp_table1 WHERE (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) >=5  AND (DATE_FORMAT( NOW( ) , '%Y' ) - DATE_FORMAT( date_birth, '%Y' ) ) <=1000 AND date_format( encounter_date, '%d.%m.%y' ) ='$date_person_reg'";
			  $db_ptr_age5_14_return= $db->Execute($sql_age5_14_return);

			  $db_row_under_age_return=$db_ptr_under_age_return->FetchRow();
			  $db_row_age5_14_return=$db_ptr_age5_14_return->FetchRow();


			  $db_row_under_age=$db_ptr_under_age->FetchRow();
			  $db_row_age5_14=$db_ptr_age5_14->FetchRow();
			  $db_row_new=$db_ptr_new->FetchRow();

			  $total_opd=$total_opd+$v['AMOUNT_ENCOUTERS'];
			  //$total_new=$total_new+$v['NEW'];
			  $total_new=$total_new+$db_row_new['NEW'];
			  $total_return=$total_opd-$total_new;
			 $total_underage=$total_underage+$db_row_under_age['Total_underage'];
			 $total_age5_14=$total_age5_14+$db_row_age5_14['Total_age5_14'];

			$total_underage_return=$total_underage_return+$db_row_under_age_return['Total_underage_return'];
			$total_age5_14_return=$total_age5_14_return+$db_row_age5_14_return['Total_age5_14_return'];

				$return_underage= $db_row_under_age_return['Total_underage_return']-$db_row_under_age['Total_underage'];
				$return_age5_14=$db_row_age5_14_return['Total_age5_14_return']-$db_row_age5_14['Total_age5_14'];
			  	$return_underage_total=$return_underage_total+$return_underage;
			  	$return_age5_14_total=$return_age5_14_total+$return_age5_14;
			  $total_paediatrics= $total_underage+$total_age5_14+$return_underage_total+$return_age5_14_total;

		  ?>
		    <table  border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><?php echo $v['REGISTRATION_DATE']; ?></td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo $v['AMOUNT_ENCOUTERS']; ?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $db_row_new['NEW'];?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $v['AMOUNT_ENCOUTERS']-$db_row_new['NEW']  ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage']; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_age5_14['Total_age5_14']; ?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $return_underage; ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $return_age5_14; ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"><?php echo $db_row_under_age['Total_underage'] + $db_row_age5_14['Total_age5_14']+$return_underage + $return_age5_14; ?></td>
          </tr>

		<?php }
		// echo "End time of the script:".date("G:i:s")."<br>";
		?>
		<tr>
            <td width="79" bgcolor="#ffffaa" widtd="220"><b><?php echo $LDtotal; ?></td>
            <td width="104" bgcolor="#ffffaa" widtd="32"><?php echo $total_opd;?></td>
            <td width="51" bgcolor="#ffffaa" widtd="32"><?php echo $total_new;?></td>
            <td width="65" bgcolor="#ffffaa"><?php echo $total_return;?></td>
            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $total_underage ?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $total_age5_14 ?></td>

            <td width="100" bgcolor="#ffffaa" widtd="64"><?php echo $return_underage_total?></td>
            <td width="74" bgcolor="#ffffaa" widtd="64"><?php echo $return_age5_14_total ?></td>
            <td width="155" bgcolor="#ffffaa" widtd="64"> <?php echo $total_paediatrics ?></td>
          </tr>
        </table>
        <p>&nbsp; </p>
       <!-- <table width="500" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            <tr>
                              <td widtd="220" bgcolor="#ffffaa"><?php echo $LDOPDVisits; ?></td>
                              <td widtd="32" bgcolor="#ffffaa">&lt; 5 </td>
                              <td widtd="32" bgcolor="#ffffaa">&gt; 5 </td>
                              <td colspan="2" bgcolor="#ffffaa"><?php echo $LDsex; ?></td>
                              <td widtd="64" bgcolor="#ffffaa"><?php echo $LDtotal; ?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDRETURN; ?></b></td>
                              <td><?php echo $arr_ret['return']['underage'];?></td>
                              <td><?php echo $arr_ret['return']['adult'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['male'];?></td>
                              <td width="69"><?php echo $arr_ret['return']['female'];?></td>
                              <td><?php echo $arr_ret['return']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDNewRegistrations; ?></b> </td>
                              <td><?php echo $arr_ret['NewRegistration']['underage'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['adult'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['male'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['female'];?></td>
                              <td><?php echo $arr_ret['NewRegistration']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDViewsforthesameReason; ?></b> </td>
                              <td><?php echo $arr_ret['revisit']['underage'];?></td>
                              <td><?php echo $arr_ret['revisit']['adult'];?></td>
                              <td><?php echo $arr_ret['revisit']['male'];?></td>
                              <td><?php echo $arr_ret['revisit']['female'];?></td>
                              <td><?php echo $arr_ret['revisit']['total'];?></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></b></td>
                              <td><b><?php echo $arr_ret['Total']['underage'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['adult'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['male'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['female'];?></b></td>
                              <td><b><?php echo $arr_ret['Total']['total'];?></b></td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td bgcolor="#ffffaa"><b><?php echo $LDTotalPediatrics; ?></b></td>
                              <td><?php echo $arr_ret['Total_Pedriatics']['underage'];?></td>
                              <td>&nbsp;</td>
                              <td colspan="2">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>

                          </table>-->
				</form>
						<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>
						  <br><br><br>  <br><br><br>


<!-- START BOTTIOM OF HTML CONTENT --->
<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {

						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");

					}
					//  Script End -->
					</script>


					 <a href="http://www.care2x.org" target=_new>CARE2X 2nd Generation pre-deployment 2.0.2</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:info@care2x.org>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</body>
