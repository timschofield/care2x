<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/care_api_classes/supplier_database_class.php');
require($root_path.'include/care_api_classes/class_add_to_store.php');
require($root_path.'include/care_api_classes/class_transfer.php');

$stores = new addtostore();
if(isset($_POST['store']))
  {
   $store = $_POST['store'];
   $store1 = $store;
   $_SESSION['stores']=$store;
  }
  elseif(isset($_GET['stores']))
   {
    $store = $_GET['stores'];
   }
?>
<p align="center"><form action="index.php?goto=viewstores" method="post"><table align="center">
<tr><td><strong>Search Store Name :</strong></td><td><input name="store" type="text" value="<?php echo $store1; ?>"></td>
<td><input name="searchstore" type="submit" value="Search"></td></tr></table></form></p>

<?php
 if(isset($_POST['submit6']))
  {
   $from = $_POST['locationstore'];
   $stores->goto_transfer($date,"pharmacy",$store,$from);
   $transferid = $stores->transfer_id; 
  
  }
  
  
elseif(isset($_GET['transfer']))
  {
   if(!isset($_GET['stinh']))
   {
  $stores->transfer($store);
  }
  }
  else
  {
   $stores->select_stores($store);
   
  }
 if(isset($_GET['trno']))
  {
    $transferid = $_GET['trno'];
	$transfers = new transferitems($transferid);
	$from = $transfers->fromid;
	$to = $transfers->toid;
	$date = $transfers->tdate;
	$stores->goto_transfer($date,"pharmacy",$store,$from);
  } 

 if($_GET['transfer']=='m')
  {
   $transfers = new transferitems($transferid);
   $toname = $transfers->toname;
 
   $transfers->display_stock_in_hand();
   
   
   
  }
?>