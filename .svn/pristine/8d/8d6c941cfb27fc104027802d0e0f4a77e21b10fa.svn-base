<?php
class addtostore extends supplier
{
var $transfer_id;
var $msg;

  function addtostore()
         {
		   $this->dbconnect();
		   $this->dbselect();
		 }
  function insert_item($itemid,$storeid,$batchno,$expdate,$quantity)
        {
 $query0 = "select * from care_tz_stock_in_hand where item_id='$itemid' and Store_id='$storeid' and  batch_no='$batchno' and expire_date = '$expdate'";
		  $result = mysql_query($query0) or die(mysql_error("error"));
		  $num = mysql_num_rows($result);
		  if($num==0)
		  {
		    $query1 = "insert into care_tz_stock_in_hand(item_id,Store_id,batch_no,expire_date,current_qty) values('$itemid','$storeid','$batchno','$expdate','$quantity') ";
		  }
		  else
		  {
		  $query1 = "update care_tz_stock_in_hand set current_qty = current_qty + '$quantity' where item_id='$itemid' and Store_id='$storeid' and batch_no='$batchno' and expire_date='$expdate' ";
		  }
		  $this->query($query1);
		}

 function register_transfer($date,$transferedby,$from,$to)
 {
   mysql_query("insert into care_tz_transfer_item(Transfer_date,Transfered_by,Transfer_from,Transfer_to) values('$date','$transferedby','$from','$to')");
   $this->transfer_id = mysql_insert_id();
 }

 function transfer_item($transfer_id,$stock_in_hand,$quantity)
  {
    $result = mysql_query("select * from care_tz_item_transfer where Tranfer_id='$transfer_id'");
	$row = mysql_fetch_array($result);
	$transfer_to = $row['Transfer_to'];
	$transfer_from = $row['Transfer_from'];
	$result1 = mysql_query("select * from care_tz_stock_in_hand where st_in_h_id = '$stock_in_hand' ");
	$row1 = mysql_fetch_array($result1);
	$qty = $row1['current_qty'];
	$batch = $row1['batch_no'];
	$date = $row1['expire_date'];
	$item_id = $row1['item_id'];
	if($transfer_to==$transfer_from)
	 {
	 $this->msg = "<font color='red'>You are transfering to the same destination</font>";
	 }
	 else
	 {
	 if($quantity=="")
	  {
	  $this->msg = " <font color='red'>You have not entered the quantity</font>";
	  }
	elseif($qty >= $quantity )
	  {
	    $this->insert_item($item_id,$transfer_to,$batch,$date,$quantity);
		mysql_query("update care_tz_stock_in_hand set current_qty=current_qty - '$quantity' where st_in_h_id = '$stock_in_hand' ");
		mysql_query("insert into care_tz_item_transfer_detail(transfer_id,st_in_h_id,quantity) values('$transfer_id','$stock_in_hand','$quantity')");
		$this->msg = " <font color='red'>You have transfered ".$quantity." unit(s).</font>";
	  }

	  else
	  {
	  $this->msg = " <font color='red'>The available quantity is ".$qty."</font>";
	  }
	  }
  }

function select_stores($store)
  {
   if(isset($_GET['transfer']))
   {
   $result=mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_location.id=care_tz_store_info.location_id and care_tz_store_info.Store_id =$store") or die(mysql_error("error"));
   }
   else
   {
    $result=mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_location.id=care_tz_store_info.location_id and care_tz_store_info.Store_name like '%".$store."%'") or die(mysql_error("error")); }
	echo "<table align='center' width='80%' cellspacing='0'><tr bgcolor='#99ccff' style='font-weight:bold;'><td>Sno.</td><td>Location</td><td>Store type</td><td>Store Name</td><td>Transfer</td><td>View</td></tr>";

	$n=1;
	while($rows=mysql_fetch_array($result))
	  {
	  $storeid=$rows['Store_id'];
	  $storename = $rows['Store_name'];
	  $storetype = $rows['Store_type'];
	  $locationname = $rows['Name'];
	  echo "<tr><td>".$n."</td><td>".$locationname."</td><td>".$storetype."</td><td>".$storename."</td><td><a href='index.php?goto=viewstores&stores=$storeid&transfer=t'>Transfer</a></td><td><a href='index.php?goto=viewstores&id=$storeid&stores=$store&view=v'>view</a></td></tr>";
	  $n++;

	  if(isset($_GET['view']))
	    {
		  $storeid1 = $_GET['id'];

		 if($storeid1==$storeid)
		  {
		  	mysql_query("delete from care_tz_stock_in_hand where current_qty=0");
		  	if(isset($_GET['del']))
		  	{
               $itemid = $_GET['del'];
		  		mysql_query("delete from care_tz_stock_in_hand where item_id='$itemid'");
		  	}
		 $res = mysql_query("select care_tz_stock_in_hand.item_id,care_tz_drugsandservices.item_full_description as descr,care_tz_stock_in_hand.batch_no as batch,care_tz_stock_in_hand.expire_date as date1,
		 date_format(care_tz_stock_in_hand.expire_date,'%D %M, %Y') as exdate,care_tz_stock_in_hand.current_qty as qty from care_tz_stock_in_hand,care_tz_drugsandservices  where care_tz_stock_in_hand.item_id= care_tz_drugsandservices.item_id and care_tz_stock_in_hand.Store_id='$storeid'");
		  echo "<tr><td colspan='6'><table align='center' width='90%' cellspacing='0'>
		  <caption><strong><br/></strong></caption><tr style='font-weight:bold;' bgcolor='#99ccff'><td>Sno.</td><td>Item</td><td>Batch no.</td><td>Expire date</td>
			  <td>Quantity</td></tr>";

		  $m=1;

		  while($row=mysql_fetch_array($res))
		   {

              $itemid = $row['item_id'];
			  $itemname = $row['descr'];
              $date1 = $row['date1'];
			  $batchno = $row['batch'];
			  $exdate = $row['exdate'];
			  $quantity = $row['qty'];

               (date("Y-m-d",time()) > $date1 ) ? $color='yellow' : $color='white';
(date("Y-m-d",time()) > $date1 ) ? $deci="&nbsp;&nbsp;&nbsp;<a href='index.php?goto=viewstores&id=$storeid&stores=$store&view=v&del=$itemid' onclick='return(ckeckOkToLoad(this))'>Dispose</a>" : $deci='';
			  echo "<tr bgcolor='".$color."'><td>".$m."</td><td>".$itemname."</td><td>". $batchno."</td><td>".$exdate."</td>
			  <td>".$quantity."   ".$deci."</font></td></tr>";
			  $m++;
		   }
		   echo "</table></td></tr><tr><td colspan='6'>&nbsp;</td></tr>";
		   }
		}

	  }
	  echo "</table>";
  }

  function transfer($store)
    {
	 $result=mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_location.id=care_tz_store_info.location_id and care_tz_store_info.Store_id =$store") or die(mysql_error("error"));
	 echo "<table align='center' width='50%' cellspacing='0'><caption><strong><p>Transfer some items from this store</p></strong><br/></caption><tr bgcolor='#99ccff' style='font-weight:bold;'><td>Location</td><td>Store type</td><td>Store Name</td></tr>";


	$rows=mysql_fetch_array($result);

	  $storeid=$rows['Store_id'];
	  $storename = $rows['Store_name'];
	  $storetype = $rows['Store_type'];
	  $locationname = $rows['Name'];
	  echo "<tr><td>".$locationname."</td><td>".$storetype."</td><td>".$storename."</td></tr>";

	  echo "</table><p align='center'><form action='index.php?goto=viewstores&transfer=m&stores=$store' method='post'><table align='center'><tr><td>Transfer to :</td><td><select name='locationstore'><option value=''>----select destination store---</option>";
	  $res1 = mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_store_info.location_id=care_tz_location.id");
	  while($rows = mysql_fetch_array($res1))
	  {
	    $location = $rows['Name'];
		$store = $rows['Store_name'];
		$id1 = $rows['Store_id'];
		if($store1==$id1) { $selected = "selected='selected'";  }
		echo "<option value='".$id1."'  ".$selected.">".$location." - ".$store."</option>";
	  }
	  echo "</td><td><input name='submit6' type='submit' value='Submit' /></td></tr><table></form></p>";


	}

function goto_transfer($date,$transferedby,$from,$to)
      {



			if($to=="")
			 {
			 echo"<p align='center'><strong>You did not select any destination store :</strong></p> ";
			 $this->transfer($from);
			 }
			 elseif(isset($_GET['trno']))
			 {
			 	$this->transfer_address($from,$to);
			 }
			 else
			 {
			 mysql_query("insert into care_tz_item_transfer(Transfer_date,Transfered_by,Transfer_from,Transfer_to)
			values(now(),'$transferedby','$from','$to')") or die(mysql_error());
			$this->transfer_id=mysql_insert_id();
			$this->transfer_address($from,$to);
			}

	  }

 function transfer_address($from,$to)

  {

  $result=mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_location.id=care_tz_store_info.location_id and care_tz_store_info.Store_id =$from") or die(mysql_error("error"));
		$rows=mysql_fetch_array($result);

	  $storeid=$rows['Store_id'];
	  $storename = $rows['Store_name'];
	  $storetype = $rows['Store_type'];
	  $locationname = $rows['Name'];
	  $result=mysql_query("select * from care_tz_store_info,care_tz_location where care_tz_location.id=care_tz_store_info.location_id and care_tz_store_info.Store_id =$to") or die(mysql_error("error"));
		$rows=mysql_fetch_array($result);

	  $storeid1=$rows['Store_id'];
	  $storename1 = $rows['Store_name'];
	  $storetype1 = $rows['Store_type'];
	  $locationname1 = $rows['Name'];

			echo"<p align='center'><strong>Transfer the items from ".$locationname."- ".$storename."<br/>to ".$locationname1."- ".$storename1."</strong></p> ";


  }


}


?>

