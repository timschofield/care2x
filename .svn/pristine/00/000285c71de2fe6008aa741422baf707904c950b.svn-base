#!/usr/bin/php
<?php

include ('./include/inc_init_main.php');

if ( $argc != 3 ) {
	echo "Usage of this script:\n ./discharge.php ecnounter_class c2x-username\n";
	echo "encouter_class=1 for Inpatient, 2 for Outpatient";
  	die();
	}

$encounter_class = $argv[1];
$username = $argv[2];

echo "Are you shure, you want to discharge ALL patients with\n";
echo "encounter_class $encounter_class and username $username?\n";
echo "Enter YES for procedeing:";
echo "\n";

if ($fp=fopen("php://stdin","r")) {
      $line = fgets($fp,4096);
      }
   fclose($fp);
   
if ($line != "YES\n") {
	die ("Not saying YES: Not discharging patients.\n");
	}	

$db = mysql_connect($dbhost,$dbusername,$dbpassword) or die ("No connection: " . mysql_error());
mysql_select_db($dbname,$db) or die ("Wrong database: " . mysql_error());

$sql="UPDATE care_encounter     SET is_discharged = '1',
                        status='discharged',
                        discharge_date = '".date('Y-m-d')."',
                        discharge_time = '".date('H:i:s')."',
                        history ='"."Update (discharged): " .date('Y-m-d H:i:s'). " ". $username ."',
                        modify_id='" . $username . "'
      WHERE is_discharged='0' AND encounter_class_nr='".$encounter_class."'";
					
mysql_query($sql) or die ("SQL Error: " . mysql_error());
echo "I am just pleased as punch to inform you that ".mysql_affected_rows($db)." Patients have been discharged.\n";
die();
?>
