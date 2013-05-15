<?php 

require('./roots.php');

class purchasereport

{

function purchasereport()
  {
   
  }
  
 function select_distinct_items($orderno)
      {
	     $result = mysql_query("select care_tz_grn_detail.order_no as orderno,  sum(care_tz_grn_detail.received_quantity) as qty,care_tz_grn_detail.item_id as itemid,
		 care_tz_purchase_order_detail.quantity as quantity,item_description from care_tz_purchase_order_detail, care_tz_grn_detail,care_tz_drugsandservices where care_tz_grn_detail.order_no=$orderno and care_tz_grn_detail.item_id=care_tz_drugsandservices.item_id and care_tz_grn_detail.item_id=care_tz_purchase_order_detail.item_id and care_tz_grn_detail.order_no=care_tz_purchase_order_detail.order_no group by care_tz_grn_detail.order_no,care_tz_grn_detail.item_id");
		 ?>
		 <p align="center">
		 <fieldset><legend>Receiving Report</legend>
		 <p></p>
		 <table align="left" border="0"  width="85%"><tr bgcolor="#cccce5" style="font-weight:bold" ><td>Product</td><td>Ordered Quantity</td><td>  Received Quantity </td><td>View</td></tr>
		 <?php
		 $n=0;
		 while($rows=mysql_fetch_object($result))
		 {
		    $prod = $rows->item_description;
			$ordered = $rows->quantity;
			$received = $rows->qty;
			$item=$rows->itemid;
			if($n%2!=0)
			   $bg= '#CCCCCC';
			  else
			   $bg='#EEEEEE';
		   echo "<tr bgcolor=".$bg."><td>".$prod."</td><td>".$ordered."</td><td>".$received."" ?></td><td><a href="../../modules/Stock/purchase_order.php?mode=show&order_id=<?php echo $orderno; ?>&item=<?php echo $item; ?>#report"><img src='includes/images/application_view_list.png' alt='view' border="0"/></a><?php echo "</td></tr><tr>"; ?>
		  <?php if(isset($_GET['item'])) { if($_GET['item']==$item) { ?> <td colspan='4'><?php
		  $res = mysql_query("select care_tz_grn_detail.received_quantity as received,care_tz_grn_detail.exp_date as expire,care_tz_grn_detail.batch_no as batch,care_tz_grn_detail.receiving_status as rec_st,care_tz_grn_detail.invoice_total as invtotal,care_tz_grn_master.delivery_date as deldate,care_tz_grn_master.delivery_no as delnumber,care_tz_grn_master.item_received_by as receivedby,care_tz_grn_master.delivery_date as deldate,care_tz_grn_master.date_received as recedate,care_tz_grn_master.invoice_no as invnumber,care_tz_grn_master.invoice_date as invdate,
care_tz_grn_master.currency as currency from care_tz_grn_master,care_tz_grn_detail where care_tz_grn_master.grn_no=care_tz_grn_detail.grn_no
and care_tz_grn_master.order_no = $orderno  and care_tz_grn_detail.item_id= $item ");
  echo "<p align='center'><strong><br/><a name='report' id='report'>Receiving details for this item</a></strong></p><table style='font:Arial narrow' cellspacing='0' width='100%' border='0' cellpadding='0'>";
          $m=0;
           while($ro = mysql_fetch_object($res))
		   {
		     $qty = $ro->received;
			 $recby = $ro->receivedby;
			 $expiredate = $ro->expire;
			 $batchno = $ro->batch;
			 $receivest = $ro->rec_st;
			 $deliverynumber = $ro->delnumber;
			 $deliverydate = $ro->deldate;
			 $receivedate = $ro->recedate;
			 $invoicenumber = $ro->invnumber;
			 $invoicedate = $ro->invdate;
			 $currency = $ro-> currency;
			 $invtotal= $ro->invtotal;
			 if($m%2==0)
			 {
			  
			 
			  $bgc= '#eeeeee';
			 
			 }
			 else
			 {
			   
			 
			  $bgc= '#ffffff';
			 
			 }
			 echo "<tr  height='25' bgcolor='".$bgc."'><td><strong>Receiving date:</strong> ".$receivedate."</td><td> <strong>qty : </strong>".$qty."</td><td><strong>Batch no:</strong> ".$batchno."</td><td><strong>Delivery no : </strong>". $deliverynumber."</td></tr>
			 <tr  height='25' bgcolor='".$bgc."'><td><strong>Rec. status :</strong> ".$receivest."</td><td><strong>Invoice no:</strong> ".$invoicenumber."</td><td><strong>Invoice total:</strong>".$invtotal." ".$currency."</td><td><strong>Received by</strong> ".$recby."</td></tr>";
			 $m++;
			 		   }
		    ?></table></td></tr> <?php 
		 } }  $n++;
		 }
		 echo "</table></fieldset></p>";
	  }  
  
  
}
?>
