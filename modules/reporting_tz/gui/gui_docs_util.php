<?php 
if ($printout) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>Doctors Utilization Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo 'Doctors Utilization Report'; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
         <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
           <td><b>Doctor</td>
          <?php
            
          		echo '<td><b>'.$LDTotalPatients.'</td>';
				echo '<td><b>'.$LDLabPatients.'</td>';
				echo '<td><b>'.$LDRadPatients.'</td>';
				echo '<td><b>'.$LDPrescPatients.'</td>';
				echo '<td><b>'.$LDDiagnosisPatients.'</td>';
			 
          ?>

          </tr>
		  
		   <?php
		   
		   $patient_total=0;
		   $lab_total = 0;
		   $rad_total=0;
		   $presc_total=0;
		   $diag_total=0;
         		
			while($docs_row = $docs_list->FetchRow()) 
			{
				$doctor = $docs_row['consulting_dr']; 
				echo '<tr><td>'.$doctor.'</td>';
	
					
          			$sql_count="SELECT count(*) as patient_count  FROM tmp_table where consulting_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$patient_total+=$db_row['patient_count'];
			 		echo '<td>'.$db_row['patient_count'].'</td>';
					
					$sql_count="SELECT count(*) as labs_count  FROM tmp_table where lab_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$lab_total+=$db_row['labs_count'];
			 		echo '<td>'.$db_row['labs_count'].'</td>';
					
					$sql_count="SELECT count(*) as radio_count  FROM tmp_table where rad_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$rad_total+=$db_row['radio_count'];
			 		echo '<td>'.$db_row['radio_count'].'</td>';
					
					$sql_count="SELECT count(*) as presc_count  FROM tmp_table where presc_dr='$doctor'
					AND drug_class='drug_list'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$presc_total+=$db_row['presc_count'];
			 		echo '<td>'.$db_row['presc_count'].'</td>';
					
					$sql_count="SELECT count(*) as diagnosis_count  FROM tmp_table where diag_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$diag_total+=$db_row['diagnosis_count'];
			 		echo '<td>'.$db_row['diagnosis_count'].'</td>';
						 
          ?>

          		</tr>
		<?
			}
		?>
		<tr> 
            <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
        <?php
			 		
			 		
			  		echo '<td>'.$patient_total.'</td>';
	
			  		echo '<td>'.$lab_total.'</td>';
			  		
			  		echo '<td>'.$rad_total.'</td>';
					
			  		echo '<td>'.$presc_total.'</td>';
					
			  		echo '<td>'.$diag_total.'</td>';
					
			  ?>
				
				
          </tr>  
        </table>
                        
<?php
exit();
}
?>





<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Moye Masenga">
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
    	urlholder="./docs_util_report.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
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
          <td width="202" bgcolor="#99ccff" > &nbsp;&nbsp;<font color="#330066"><?php echo 'Doctors Utilization Report'; ?></font></td>
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
        </p>
		<DIV align="center">
			<h2><?php echo 'Doctors Utilization Report '; ?><?php echo date('F Y',$start);?></h1>
			<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
		</DIV>
        <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
          <tr> 
          <td><b>Doctor</td>
		  
          <?php
            
          		echo '<td><b>'.$LDTotalPatients.'</td>';
				echo '<td><b>'.$LDLabPatients.'</td>';
				echo '<td><b>'.$LDRadPatients.'</td>';
				echo '<td><b>'.$LDPrescPatients.'</td>';
				echo '<td><b>'.$LDDiagnosisPatients.'</td>';
			 
          ?>

          </tr>
		  
		   <?php
		   
		   $patient_total=0;
		   $lab_total = 0;
		   $rad_total=0;
		   $presc_total=0;
		   $diag_total=0;
         		
			while($docs_row = $docs_list->FetchRow()) 
			{
				$doctor = $docs_row['consulting_dr']; 
				echo '<tr><td>'.$doctor.'</td>';
	
					
          			$sql_count="SELECT count(*) as patient_count  FROM tmp_table where consulting_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$patient_total+=$db_row['patient_count'];
			 		echo '<td>'.$db_row['patient_count'].'</td>';
					
					$sql_count="SELECT count(*) as labs_count  FROM tmp_table where lab_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$lab_total+=$db_row['labs_count'];
			 		echo '<td>'.$db_row['labs_count'].'</td>';
					
					$sql_count="SELECT count(*) as radio_count  FROM tmp_table where rad_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$rad_total+=$db_row['radio_count'];
			 		echo '<td>'.$db_row['radio_count'].'</td>';
					
					$sql_count="SELECT count(*) as presc_count  FROM tmp_table where presc_dr='$doctor'
					AND drug_class='drug_list'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$presc_total+=$db_row['presc_count'];
			 		echo '<td>'.$db_row['presc_count'].'</td>';
					
					$sql_count="SELECT count(*) as diagnosis_count  FROM tmp_table where diag_dr='$doctor'";
			  		$db_ptr = $db->Execute($sql_count); 
			  		$db_row = $db_ptr->FetchRow();
					$diag_total+=$db_row['diagnosis_count'];
			 		echo '<td>'.$db_row['diagnosis_count'].'</td>';
						 
          ?>

          		</tr>
		<?
			}
		?>
		<tr> 
            <td bgcolor="#ffffaa"><b><?php echo $LDtotal; ?></td>
        <?php
			 		
			 		
			  		echo '<td>'.$patient_total.'</td>';
			  		
			  		echo '<td>'.$lab_total.'</td>';
			  
			  		echo '<td>'.$rad_total.'</td>';
					
			  		echo '<td>'.$presc_total.'</td>';
					
			  		echo '<td>'.$diag_total.'</td>';
					
			  ?>
				
				
          </tr>  
        </table>
        <p>&nbsp; </p>
      
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