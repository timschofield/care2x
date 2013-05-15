<?php
/*
 * Created on 26.08.2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

/*
 * first - kick out what we have in the pricelist ... we do not need it anymore
 */

// later...

/*
 * select the parameters we need from the laboratory-ables
 */


$item_number="";
$partcode="";
$is_pediatric=0;
$is_adult=0;
$is_other=0;
$is_consumable=0;
$is_labtest=1;
$item_description="";
$item_full_description="";
$unit_price=1500;
$unit_price_1=2000;
$unit_price_2=0;
$unit_price_3=0;
$purchasing_class='labtest';

$db->debug=TRUE;

$sql_labtests="SELECT nr, name, id FROM care_tz_laboratory_param where group_id<>-1";

$results_labtest_rs = $db->Execute($sql_labtests);
if ($results_labtest_rs)
	while ($arr=$results_labtest_rs->FetchRow()) {

		//echo $arr['nr']."#".$arr['name']."#".$arr['id']."<br>";
		$item_number="LAB".$arr['nr'];
		$item_description = $arr['name'];
		$item_full_description = $arr['name'];
		$partcode = $arr['id'];

		$sql_insert = " INSERT INTO `care_tz_drugsandservices` (" .
				"`item_number` ," .
				"`partcode` ," .
				"`is_pediatric` ," .
				"`is_adult` ," .
				"`is_other` ," .
				"`is_consumable` ," .
				"`is_labtest` ," .
				"`item_description` ," .
				"`item_full_description` ," .
				"`unit_price` ," .
				"`unit_price_1` ," .
				"`unit_price_2` ," .
				"`unit_price_3` ," .
				"`purchasing_class`" .
				")" .
				"" .
				"VALUES (" .
				"'$item_number', " .
				"'$partcode', " .
				"'$is_pediatric', " .
				"'$is_adult', " .
				"'$is_other', " .
				"'$is_consumable', " .
				"'$is_labtest', " .
				"'$item_description', " .
				"'$item_full_description', " .
				"'$unit_price', " .
				"'$unit_price_1', " .
				"'$unit_price_2', " .
				"'$unit_price_3', " .
				"'$purchasing_class') ";
		$db->Execute($sql_insert);
	}




/*
 * add the information we do not have so far...
 */

/*
 * Insert it as new elements in the pricelist
 */
?>
