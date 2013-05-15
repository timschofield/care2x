<?php
/**
*  A routine to create links to insurances
*  (left list at the 'manage insurances'-menu)
*/

require_once($root_path.'include/care_api_classes/class_tz_insurance.php');
$coreObj = new Core;

if (!$status)
	$condition = "where deleted != 1";
else
	$condition = "where deleted = 1";

$coreObj->sql="select * from care_ward";

//$coreObj->result = $db->Execute($coreObj->sql);
$result=$db->Execute($coreObj->sql);

while($row=$result->FetchRow())
{
	if($bg=="#ffffaa")
    		$bg="#ffffdd";
    	else
    		$bg="#ffffaa";

    if ($ward_nr == $row['nr'])
    {
    	$marker = '#006400';
    }
    else $marker = '#000000';

   	echo "<tr bgcolor=$bg ><td>";
	echo "<a href=\"".$root_path."modules/pharmacy_tz/pharmacy_tz_show_prescr.php".URL_APPEND."&nr=".$row['nr']."\">";
	echo '<font color='.$marker.'>'.$row['name'].'</font></a>';
	echo "</td></tr>";
}
?>
