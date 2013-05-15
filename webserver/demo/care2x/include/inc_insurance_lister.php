<?php
/**
*  A routine to create links to insurances
*  (left list at the 'manage insurances'-menu)
*/

//require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
//$coreObj = new Insurance_tz;

if (!$status)
	$condition = "where ins.cancel_flag != 1";
else
	$condition = "where ins.cancel_flag = 1";

$insurance_tz->sql="SELECT ins.*, co.name FROM care_tz_insurance ins, care_tz_company co $condition AND ins.company_id=co.id AND ins.PID = 0 order by co.name asc";

//$coreObj->result = $db->Execute($coreObj->sql);
$result=$db->Execute($insurance_tz->sql);

while($row=$result->FetchRow())
{
	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";

    if ($insurance_ID == $row['company_id'])
    {
    	$marker = '#006400';
    }
    else $marker = '#000000';

   	echo "<tr bgcolor=$bg ><td>";
	echo "<a href=\"".$root_path."modules/billing_tz/insurance_company_tz_manage.php".URL_APPEND."&insurance_ID" .
			"=".$row['company_id']."&name=".$row['name']."&id_insurer=".$row['name']."&max_pay=".$row['ceiling']."&status=".$status."&contact_person" .
			"=".$row['contact']."&po_box=".$row['po_box']."&city=".$row['city']."&phone=".$row['phone_code']." ".$row['phone_nr']."&email=".$row['email']."\">";
	echo '<font color='.$marker.'>'.$row['name'].'</font></a>';
	echo "</td></tr>";
}
?>
