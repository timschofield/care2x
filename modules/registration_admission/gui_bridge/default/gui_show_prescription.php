<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">

<tr bgcolor="<?php echo $bgc; ?>" valign="top">

    <td><FONT SIZE=-1  FACE="Arial">Date/Admission No.</td>
	<td><FONT SIZE=-1  FACE="Arial"><?php if($prescrServ=="serv" || prescrServ=="proc") { 
	echo "Procedure / Details"; } else { echo "Drug /Prescription"; } ?></td>
	
	<td><FONT SIZE=-1  FACE="Arial"><?php if($prescrServ=="serv" || prescrServ=="proc") { 
	echo ""; } else { echo "Single Dose"; } ?></td>
	
    <td><FONT SIZE=-1  FACE="Arial"><?php if($prescrServ=="serv" || prescrServ=="proc") { 
	echo ""; } else { echo "Times Per Day"; } ?></td>
	
    <td><FONT SIZE=-1  FACE="Arial"><?php if($prescrServ=="serv" || prescrServ=="proc") { 
	echo ""; } else { echo "Days"; } ?></td>
	
	<td><FONT SIZE=-1  FACE="Arial"><?php if($prescrServ=="serv" || prescrServ=="proc") { 
	echo "Total Tests /Items "; } else { echo "Total Dose"; } ?></td>
   
  </tr>

<?php
$toggle=0;

while($row=$result->FetchRow()){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#fefefe';
	$toggle=!$toggle;

	if($row['encounter_class_nr']==1) $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']; // inpatient admission
		else $full_en=$row['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']; // outpatient admission
	$amount = 0;
	$notbilledyet=false;
	if($row['bill_number']>0)
	{
		include_once($root_path.'include/care_api_classes/class_tz_billing.php');
		if(!isset($bill_obj)) $bill_obj = new Bill;
		$billresult = $bill_obj->GetElemsOfBillByPrescriptionNr($row['nr']);
		if($billrow=$billresult->FetchRow())
		{
			if($billrow['amount']!=$row['dosage'])
				$amount=$billrow['amount'];
		}
		if(!$amount>0)
		{
				$billresult = $bill_obj->GetElemsOfBillByPrescriptionNrArchive($row['nr']);
				if($billrow=$billresult->FetchRow())
				{
					if($billrow['amount']!=$row['dosage'])
						$amount=$billrow['amount'];
				}
		}
	}
	{
		$notbilledyet=true;
	}

?>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['prescribe_date'],$date_format); ?></td>
	
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['article']; ?></td>
	<td><FONT SIZE=-1  FACE="Arial"><?php echo $row['dosage']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['times_per_day']; ?></td>
	<td><FONT SIZE=-1  FACE="Arial"><?php echo $row['days']; ?></td>
	<td><FONT SIZE=-1  FACE="Arial">
	
	<?php
    if($amount>0)
    {
    	echo '<s>'.$row['total_dosage'].'</s> '.$amount;
  	}
  	else
  	{
    	echo $row['total_dosage'];
    }

    ?>
	</td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"></td>
    <td rowspan=2><FONT SIZE=-1  FACE="Arial">
	<?php

    if($row['is_disabled'])
    {
    	echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"> <font color=red>'.$LDDisabled.'</font>';
  	}
  	elseif($row['bill_number']>0)
  	{
  		echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color=green>'.$LDAlreadyBilled.' '.$row['bill_number'].'</font>';
  		if($billrow['amount'] != $row['total_dosage']) echo '<br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color="red">'.$LDTheDrugDosagehasChanged.'</font>';
  	}
  	elseif($notbilledyet)
  	{
  		echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"> <font color=red>'.$LDPrescriptionNotBilled.'</font>';
  	}
  	?>    </td>
    <td><FONT SIZE=-1  FACE="Arial">Notes</td>
    <td colspan=3><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?></td>
	
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"></td>

    <td><FONT SIZE=-1  FACE="Arial">
    | <?php
    if($row['is_disabled'] || $row['bill_number']>0)
  	{
  		echo '<font color="#D4D4D4">edit</font>';
  	}
  	else
    echo '<a href="'.$thisfile.URL_APPEND.'&mode=edit&nr='.$row['nr'].'&show=insert&backpath='.urlencode($backpath).'&prescrServ='.$_GET['prescrServ'].'&externalcall='.$externalcall.'&disablebuttons='.$disablebuttons.'">'.$LDEdit.'</a>';
	?> | 
    <?php
    if($row['is_disabled'] || $row['bill_number']>0)
  	{
  		echo '<font color="#D4D4D4">'.$LDdelete.'</font>';
  	}
  	else
      echo '<a href="'.$thisfile.URL_APPEND.'&mode=delete&nr='.$row['nr'].'&show=insert&backpath='.urlencode($backpath).'&prescrServ='.$_GET['prescrServ'].'&externalcall='.$externalcall.'&disablebuttons='.$disablebuttons.'">'.$LDdelete.'</a>' ?></td>
    <td><FONT SIZE=-1  FACE="Arial">Prescribed by:</td>
	<td colspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>

  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
  	<td colspan="2">
	</td>

	<td>
	<?php 
	if($row['status'] =="done") {
	$status="Taken";
	}
	else {
	$status=$row['status'];
	}
	echo "Status: ".$status; ?>
	</td>	

	<td>
	<?php 
	if(!$row['is_disabled']) { 
	echo 'Issued By:'; 
	}
	?>
	</td>
	
	<td colspan="2">
	<FONT SIZE=-1 FACE="Arial">
	<?php
	if(!$row['is_disabled']) {
	echo $row['issuer']; 
	}
	?>
	</td>  
  </tr>
<?php
}
?>
</table>

<?php
if($parent_admit&&!$is_discharged) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new'; ?>">
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
