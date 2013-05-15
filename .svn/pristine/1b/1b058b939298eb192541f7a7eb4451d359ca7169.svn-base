<?php
require('./roots.php');
$conn = mysql_connect("localhost","root","")or die(mysql_error());
mysql_select_db("caredb",$conn);
 require_once('index.php');
$order_id=46;
require($root_path.'include/care_api_classes/class_purchase_report.php');
$report = new  purchasereport();
$report->select_distinct_items($order_id);


?>
