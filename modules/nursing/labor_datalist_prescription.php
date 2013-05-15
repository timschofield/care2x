<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">
<?php
$toggle=0;

$sql = " SELECT pr.*, e.encounter_class_nr FROM care_encounter AS e, care_person AS p, care_encounter_prescription AS pr, care_tz_drugsandservices as service WHERE p.pid=".$pid." AND p.pid=e.pid AND e.encounter_nr=pr.encounter_nr AND service.item_id=pr.article_item_number AND service.is_labtest=0 AND ( service.purchasing_class = 'drug_list' OR service.purchasing_class ='supplies' OR purchasing_class ='dental') ORDER BY pr.modify_time DESC";

# print '&nbsp;'.$sql;

if($result=$db->Execute($sql)){
print mysql_error();
if ($result->RecordCount()==0)
	print '<div style="text-align:center; font:bold 12px Tahoma,Arial,SanSerif,system; color:green;">No Prescriptions Found</div>';

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
				if($billrow=$billresult->FetchRow()){
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
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><?php
    if($amount>0)
    {
    	echo '<s>'.$row['dosage'].'</s> '.$amount;
  	}
  	else
  	{
    	echo $row['dosage'];
    }

    ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['application_type_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $full_en; ?></td>
    <td rowspan=2 colspan=2><FONT SIZE=-1  FACE="Arial"><?php echo $row['notes']; ?>

<?php

    if($row['is_disabled'])
    {
    	echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"> <font color=red>'.$row['is_disabled'].'</font>';
  	}
  	elseif($row['bill_number']>0)
  	{
  		echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color=green>'.$LDAlreadyBilled.' '.$row['bill_number'].'</font>';
  		if($amount>0) echo '<br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)"> <font color="red">'.$LDTheDrugDosagehasChanged.'</font>';
  	}
  	elseif($notbilledyet)
  	{
  		echo '<br><br><img src="../../gui/img/common/default/warn.gif" border=0 height="15" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"> <font color=red>'.$LDPrescriptionNotBilled.'</font>';
  	}
  	?>
    </td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['order_nr']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>" valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescription_type_nr']; ?></td>


    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['prescriber']; ?></td>
  </tr>

<?php
}
?>
</table>

<?php
}
?>
