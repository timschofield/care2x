<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$sql = "SELECT " .
		"		care_tz_drugsandservices.item_id " .
		"	, 	care_tz_drugsandservices.item_description " .
		"	,	care_tz_laboratory_param.name " .
		"	FROM care_tz_drugsandservices" .
		"		INNER JOIN care_tz_laboratory_param " .
		"			ON care_tz_drugsandservices.item_description=care_tz_laboratory_param.name";


echo $sql;

$result=$db->Execute($sql);

while($row=$result->FetchRow())
	{
				$sql="update care_tz_laboratory_param set item_id='".$row['item_id']."' where name='".$row['item_description']."' ";

				//echo $sql."<br>";
				$db->Execute($sql);
	}

/*
 elements in laboratory what not found in pricelist:
SELECT * FROM care_tz_laboratory_param where item_id=0 and group_id<>-1

elements in pricelist what is not defined in laboratory:
SELECT * FROM care_tz_drugsandservices
LEFT JOIN care_tz_laboratory_param ON care_tz_drugsandservices.item_description=care_tz_laboratory_param.name
where care_tz_drugsandservices.purchasing_class = 'labtest'
and care_tz_laboratory_param.nr is null

Other way round, but there should no results given:
SELECT * FROM care_tz_drugsandservices
right JOIN care_tz_laboratory_param ON care_tz_drugsandservices.item_description=care_tz_laboratory_param.name
where care_tz_drugsandservices.purchasing_class = 'labtest'
and care_tz_drugsandservices.item_id is null

*/

?>