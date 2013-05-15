<?php
class transferitems extends addtostore
 {
 var $transferid;
 var $fromid;
 var $fromname;
 var $toid;
 var $toname;
 var $tdate;
  function transferitems($transferid)
     {
	  $this->addtostore();
	  $this->transferid=$transferid;
	   $result = mysql_query("select * from care_tz_item_transfer where Tranfer_id='$transferid'");
	   $row = mysql_fetch_object($result);
	   $this->fromid = $row->Transfer_from;
	   $this->toid = $row->Transfer_to;
	   $this->tdate = $row->Transfer_date;
	   $this->fromname=$this->getstorename($this->fromid);
	    $this->toname=$this->getstorename($this->toid);
		
	 }
	 
 function getstorename($id)
   {
     $result = mysql_query("select * from care_tz_store_info where Store_id='$id'");
	 $row = mysql_fetch_object($result);
	 $name = $row->Store_name;
	 return $name;
   }
   
function display_stock_in_hand()
   {
  
   $trno = $this->transferid;
   $storeid = $this->fromid;
    if(isset($_POST['transferitem']))
	   {
	    $qty = $_POST['qty'];
		$stinh = $_POST['sth'];
		$this->transfer_item($trno,$stinh,$qty);
	   }
   $result = mysql_query("select st_in_h_id,care_tz_drugsandservices.item_description as descr,care_tz_stock_in_hand.batch_no as batch,
		 date_format(care_tz_stock_in_hand.expire_date,'%D %M, %Y') as exdate,care_tz_stock_in_hand.current_qty as qty from care_tz_stock_in_hand,care_tz_drugsandservices  where care_tz_stock_in_hand.item_id= care_tz_drugsandservices.item_id and care_tz_stock_in_hand.Store_id='$storeid'");
		 
   echo "<table align='center' width='80%' cellspacing='0'><tr bgcolor='#99ccff' style='font-weight:bold;'><td>Sno.</td><td>Item</td><td>Batch no.</td><td>Expire date</td>
			  <td>Quantity</td><td>select</td></tr>";
			  $m=1;
	while($rows = mysql_fetch_object($result))
	 {
	    $itemname = $rows->descr;
			  $stinh=$rows->st_in_h_id;
			  $batchno = $rows->batch;
			  $exdate = $rows->exdate;
			  $quantity = $rows->qty;
			  
			  echo "<tr><td>".$m."</td><td>".$itemname."</td><td>". $batchno."</td><td>".$exdate."</td>
			  <td>".$quantity."</td><td><a href='index.php?goto=viewstores&transfer=m&stores=$storeid&trno=$trno&stinh=$stinh&trid=$transferid'>select</a></td></tr><tr><td colspan='6'>"; 
			  $m++;
			 if(isset($_GET['stinh']))
			  {
			  if($_GET['stinh']==$stinh)
			  {
			
			  $this->transferform($stinh,$trno,$storeid);
			  }
			  }
			  echo "</td></tr>";
			
	 }
	 echo "</table>";
   
   }
	
	function transferform($stinh,$trno,$storeid)
	 {
	   
	 echo"  <form action='index.php?goto=viewstores&tr=form&transfer=m&stores=$storeid&trno=$trno&stinh=$stinh&trid=$transferid' method='post'>";
	   ?>
	   <table align="center">
	   <tr><td><input name="sth" type="hidden" value="<?php echo $_GET['stinh']; ?>" /></td><td>Quantity :</td><td><input name="qty" type="text" value="<?php echo $qty; ?>" /></td><td><input name="transferitem" type="submit" value="Transfer" /><?php echo $this->msg; ?></td></tr>
	   </table></form>
	   <?php
	 }
 
 function actualtransfer()
   {
     
   }
 
 }

?>