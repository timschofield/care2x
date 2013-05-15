<?php

if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob= new GlobalConfig($GLOBAL_CONFIG);
# Get all config items starting with "main_"
$glob->getConfig('main_%');

$addr[]=array($GLOBAL_CONFIG['main_info_address'],
						"$LDPhone:\n$LDFax:\n$LDEmail:",
						$GLOBAL_CONFIG['main_info_phone']."\n".$GLOBAL_CONFIG['main_info_fax']."\n".$GLOBAL_CONFIG['main_info_email']."\n"
						);
						
$main_address = $GLOBAL_CONFIG['main_info_address'];
$addr_line = explode(",",$main_address);


function createDataBlock($param)
{
    global $stored_findings, $edit;
	
	if ($edit)
	 {    
	       echo '
	 		<textarea name="'.$param.'" cols=82 rows=10 wrap="physical">'.stripslashes($stored_findings[$param]).'</textarea>';
      }
	 else	
	 {
	  		echo '
			         <blockquote><font face="verdana,arial" color="#000000" size=2>'.nl2br(stripslashes($stored_findings[$param])).'</font></blockquote>';
     }

}

function createInputBlock($param, $value)
{
    global $stored_findings, $date_format, $edit, $lang;
	
	if ($edit)
	 {    /*
	       echo '&nbsp;<input type="text" name="'.$param.'"  value="'.$value.'" size=';
		   if ($param=='doctor_id') echo '35 maxlength=35>';
		    else echo '10 maxlength=10 onBlur="IsValidDate(this,\''.$date_format.'\')"   onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
			
		*/
		
		if ($param=='doctor_id')
		
		
		echo '&nbsp;<input type="text" name="'.$param.'" value="'.$value.'" size= 35 maxlength=35 >'; 
		 
		  else 
		  
		echo '&nbsp;<input type="text" name="'.$param.'" value="'.$value.'" size=10 maxlength=10  onBlur="IsValidDate(this,\''.$date_format.'\')"   onKeyUp="setDate(this,\''.$date_format.'\',\''. $lang.'\')">';
		
		
      }
	 else	
	 {
	  		echo '&nbsp;
			         <font face="verdana,arial" color="#000000" size=2>'.$value.'</font><br>&nbsp;';
     }

}

?>
<table  border=0 cellpadding=1 cellspacing=0 bgcolor="#000000">
  <tr>
    <td>
	
	
<table border=0 cellpadding=0 cellspacing=0 bgcolor="#ffffff">
  <tr>
    <td>
	
	<table   cellpadding="0" cellspacing=1 border="0" width=700>
		
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" align="left"><font color="#000099" size=2 face="verdana,arial">	
		
		<?php 

			echo $addr_line[0].'<br>';
			echo $addr_line[1];
			echo $addr_line[2];
			     
		?>

		</td>
		 
		<td  valign="top" align="right">
		<div class="fva0_ml10"><font color="#000099" size=2 face="verdana,arial">	
		<?php
		  echo $LDCaseNr.'<br>'.$LDPatNr.'<br>'.$LDFamilyName.'<br>'.$LDNames.'<br>'.$LDSex.'<br>'.$LDBDay;
		 ?>
		 </div> 		 </td>
		 
		 <td  valign="top">
		<div class="fva0_ml10"><font color="#000000" size=2 face="verdana,arial">	
		<?php
		   echo $full_en.'<br>'.$result['selian_pid'].'<br>'.$result['name_last'].'<br>'.$result['name_first'].' '.$result['name_first'].'<br>'.$result['sex'].'<br>'.formatDate2Local($result['date_birth'],$date_format);
		 ?>
		 </div> 		 </td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="center"><div class=fva0_ml10>
		
		</td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="center"><div class=fva0_ml10>
		
		<p>
		
		</td>
	</tr>
		
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		
		<td  valign="top" colspan=3  align="center"><div class=fva0_ml10><font color="#000099">	 
		<font size=3 color="#000099" face="verdana,arial"><b><?php echo $formtitle ?></b></font><br>
		<hr />
		
  	</td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="left">
		<div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">	
		
		<?php echo $LDRequestDate    ?>
		<u><?php echo $stored_tests['send_date'] ?><p>
		
		</td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="left">
		<div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">	
		
		<?php echo $LDRequestingDoc ?>
		<u><?php echo $stored_tests['send_doctor'] ?><p>
		
		</td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="left">
		<div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">	
		
		<?php echo $LDClinicalSum ?>
		<u><?php echo $stored_tests['clinical_info'] ?><p>
		
		</td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
	
		<td  valign="top" colspan=3  align="left">
		<div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">	
		
		<?php echo $LDDiagnosticTest ?>

		<?php 
		$sql='select item_description from care_tz_drugsandservices where item_id='.$stored_tests['test_request'];
		$requests=$db->Execute($sql);
		if ($requests) $test_request=$requests->FetchRow();
		?>
		<u><?php echo $test_request[0] ?><p>
		
		</div></td>
	</tr>
		
	<tr bgcolor="<?php echo $bgc1 ?>">

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=3><div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">	 
		<?php echo $LDTestFindings ?><br>
		<?php createDataBlock('findings') ?>
  </td>
</tr>
  
  	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=3 ><div class=fva0_ml10><font color="#000099" size=2 face="verdana,arial">		 
		<?php echo $LDDiagnosis ?><br>
		<?php createDataBlock('diagnosis') ?>
  </div></td>
  
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		 <?php 
		 
/*		           if($mode=="edit") $fdate=formatDate2Local($stored_findings['findings_date'],$date_format);
				      else $fdate=formatDate2Local(date("Y-m-d"),$date_format);
*/		      
/*				 
	           if($mode=='edit' && $stored_findings['findings_date']) $fdate=formatDate2Local($stored_findings['findings_date'],$date_format);
				      else $fdate=formatDate2Local(date('Y-m-d'),$date_format);
*/					  
	           if($stored_findings['findings_date']) $fdate=formatDate2Local($stored_findings['findings_date'],$date_format);
				      else $fdate=formatDate2Local(date('Y-m-d'),$date_format);
					  
				   createInputBlock('findings_date',$fdate); 
			
			if($edit){
				   
		  ?>
		  	<a href="javascript:show_calendar('form_test_request.findings_date','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>
		  <?php
		  }
		  ?>
            </div></td>
			<td align="right" colspan=3><div class=fva2_ml10><font color="#000099">
			
		
			
		 <?php echo $LDReportingRad ?>:</font><font color="#000000"> 
		 
		 <?php	if($stored_findings['doctor_id']) 
		
		           $doctor_id=$stored_findings['doctor_id'];
		
		       else 
		
		           $doctor_id=$HTTP_SESSION_VARS['sess_user_name'];
		
		       createInputBlock('doctor_id',$doctor_id);
		
		?>
		
		<!-- <?php createInputBlock('doctor_id',$stored_findings['doctor_id']); ?>  -->
		
		<!-- <input type="text" name="doctor_id" size=30 maxlength=30 value="<?php echo $HTTP_SESSION_VARS['sess_user_name']; ?>" readonly>  -->
        &nbsp;&nbsp;
  </div></td>
</tr>
		</table>	
	
	</td>
  </tr>
</table>

	</td>
  </tr>
</table>

