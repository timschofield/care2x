<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

 require_once('index.php');

require($root_path.'include/care_api_classes/supplier_database_class.php');

require($root_path.'include/care_api_classes/class_purchase_order.php');

require($root_path.'include/care_api_classes/class_purchase_report.php');

require($root_path.'include/care_api_classes/class_grn_master_detail.php');
$del_order=$_REQUEST['del_order'];
$del_no=$_REQUEST['del_no'];
$update_order=$_REQUEST['order_id'];
$update_no=$_REQUEST['updateno'];
$update_cost=$_REQUEST['cost'];
$update_quantity=$_REQUEST['qty'];
if(isset($_REQUEST['order_id']))
 {
   $order_id = $_REQUEST['order_id'];
 }
?>
<script language="JavaScript" type="text/javascript">
  function checkForm(){
  	var save;
  	save=false;
  	with(document.w){
  		if(product_id.value==""){
  			alert("Search for a Product First");
  			return save;
  		}
  		else if(quantity.value==""){
  			alert("Enter product quantity please");
  			quantity.focus();
  			return save;
  		}else if(unitprice.value==""){
  			alert("Enter unit price please");
  			unitprice.focus();
  			return save;

  		}else{
  			return true;
  		}
  	}
  }
  function validateQuantity()

{
	if(isNaN(document.w.quantity.value)==true)
		{
		if(document.w.quantity.value!="")
		{
		alert('pls insert number(s) only')
		document.w.quantity.focus();
		}
		}
}
function validateUnitprice()

{
	if(isNaN(document.w.unitprice.value)==true)
		{
		if(document.w.unitprice.value!="")
		{
		alert('pls insert number(s) only')
		document.w.unitprice.focus();
		}
		}
}

</script>


<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<table cellspacing="0"  class="titlebar" border=0 width="75%">
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo" ORDERS INFORMATIONS"; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right>

  <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
 <a href="#"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>

  <a href= "./index.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>

 </tr>
 </table>
<br/>
<?php

global $purchaseorder,$results,$datetime,$user,$order1,$orderno,$items,$result3,$block,$Quantity,$unit_cost,$totalcost,$itemcode,$order_id;

$purchaseorder=new purchaseorder();

$purchaseorder->dbconnect();

$purchaseorder->dbselect();


$supplierid=$_REQUEST['supplier_id'];

$datetime=date("m/d/y");

$user="demo";
$addable=true;

if ($_REQUEST['mode'] == "create") {

$results=$purchaseorder->add_order($datetime,$supplierid,$user);

$order_id=$results;

$order1=$purchaseorder->get_order($order_id);



while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);
$form="&nbsp;";
echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);

}else if($_REQUEST['mode'] == "o_detail"){
	$order_id=$_REQUEST['order_id'];
	$item_id=$_REQUEST['item_id'];

$order1=$purchaseorder->get_order($order_id);
while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);


echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);

}else if(($_POST['add'])&&($_REQUEST['mode'] == "order_items")){
	$order_id=$_REQUEST['orderid'];
	$product_Id=$_POST['product_id'];
	$quantity=$_POST['quantity'];
	$unitcost=$_POST['unitprice'];
	$amount=$quantity *$unitcost;
	$purchaseorder->add_order_items($order_id,$product_Id,$quantity,$unitcost,$amount);
 $stat = new grn_goods();
 $stat->update_purchase_order_status($orderno);


	$order1=$purchaseorder->get_order($order_id);
	while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);


echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);








}else if($_REQUEST['mode'] == "show"){
	$order_id=$_REQUEST['order_id'];
		$order1=$purchaseorder->get_order($order_id);
	while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;

}
$supplier=$purchaseorder->get_supplier($supplierno);



echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);





}else if(isset($del_order)&&isset($del_no)){
	$sql1="delete from care_tz_purchase_order_detail where order_no='$del_order' AND no='$del_no'";

	$purchaseorder->query($sql1);

$order1=$purchaseorder->get_order($del_order);



while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);
$form="&nbsp;";
echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);


}else if(isset($update_order)&&isset($update_no)){//update starts here
	$sql1="select * from care_tz_purchase_order_detail where order_no='$update_order' AND no='$update_no'";
	$res=$purchaseorder->query($sql1);
	$cost=mysql_result($res,0,'unit_cost');
    $quantity=mysql_result($res,0,'quantity');
    $item_id=mysql_result($res,0,'item_id');
    $od_no=mysql_result($res,0,'order_no');
    $up_no=mysql_result($res,0,'no');
	//$purchaseorder->query($sql1);

$order1=$purchaseorder->get_order($update_order);



while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);

echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);


}else if(($_POST['update'])&&($_REQUEST['mode'] == "order_items")){
	$order_id=$_REQUEST['orderid'];
	$product_Id=$_POST['product_id'];
	$quantity=$_POST['quantity'];
	$unitcost=$_POST['unitprice'];
	$amount=$quantity *$unitcost;
	$purchaseorder->update_order_items($order_id,$product_Id,$quantity,$unitcost,$amount,$update_no);
      $status = new grn_goods();
      $st0 = new purchaseorder();
$st0->getstatus($order_id);
$status=$st0->status;
if($status!='new')
{
	 $status->update_purchase_order_status($order_id);
}
echo $status->price; echo "<br/>";
echo $status->inv;


	$order1=$purchaseorder->get_order($order_id);
	while($result1=$purchaseorder->fetch_object($order1)){
	$orderno=$result1->order_no;
	$supplierno=$result1->supplier_id;
	$datecreated=$result1->order_date;
	$orderedby=$result1->ordered_by;
}
$supplier=$purchaseorder->get_supplier($supplierno);


echo $purchaseorder->generate_order($orderno,$supplier,$orderedby,$datecreated);
}
if($addable){
?>
<br/>
 </p>
<fieldset>
<legend>Add Order Details</legend>

<p>
  <table border="0" cellspacing="2" cellpadding="2" width="">
    <tr bgcolor="#cccce5">
      <th>Delete</th><th>Product</th><th>Quantity Ordered</th><th>Unit Price</th><th>Amount</th><th></th>
    </tr>
    <?php
/*$items=$purchaseorder->get_order_details($orderno);
while($results3=$purchaseorder->fetch_object($items)){
    	$itemcode=$result3->item_id;
    	$Quantity=$result3->quantity;
    	$unit_cost=$result3->unit_cost;
    	$totalcost=$result3->total_cost;
    //	echo "<tr><td></td><td>$itemcode</td><td>$Quantity</td><td>$unit_cost</td><td>$totalcost</td></tr>";
    echo $itemcode;
    }
    */

$ss=$purchaseorder->get_total($orderno);
$sss=$purchaseorder->formatMoney($ss);
$results=mysql_query("select order_no,no,quantity,unit_cost,total_cost,item_description,care_tz_purchase_order_detail.item_id from care_tz_purchase_order_detail,care_tz_drugsandservices where order_no='$orderno' AND care_tz_purchase_order_detail.item_id=care_tz_drugsandservices.item_id")or die(mysql_error());
$k = 0;
while($result3=$purchaseorder->fetch_object($results)){
     $o=$result3->order_no;
	$noo=$result3->no;
	$itemcode=$result3->item_description;
    	$Quantity=$result3->quantity;
    	$unit_cost=$result3->unit_cost;
    	$totalcost=$result3->total_cost;
		$itid = $result3->item_id;
    	if ($k==1){
				echo "<tr bgcolor='#CCCCCC'>";
				$k=0;
			} else {
				echo "<tr bgcolor='#EEEEEE'>";
				$k++;
			}
			$res = mysql_query("select  * from care_tz_grn_detail where order_no=$o and item_id=$itid ");
			$num = mysql_num_rows($res);
    	echo "<td align='center'>"; if($num==0) { ?><a href='purchase_order.php?del_order=$o&del_no=$noo'><IMG src='includes/images/delete.png' border='0'  alt='Delete'></a> <?php } echo"</td><td>$itemcode</td><td>$Quantity</td><td>$unit_cost</td><td>$totalcost</td><td><a href='purchase_order.php?order_id=$o&updateno=$noo&mode2=do&cost=$unit_cost&qty=$Quantity'>select</a></td></tr>";
}// update form


    ?>

    <!--
    ends here
    below tr
    -->
    <tr>
    <?php
    if(!isset($update_order)|| !isset($update_no)||!$update_cost||!$update_quantity){
    ?>
<form action="purchase_order.php?mode=order_items&orderid=<?php echo $orderno; ?>" method="post" name="w">



    <td></td><td><table border="0"><tr>
  <td><input type="text" name="product_id" readonly="product_id" value="<?php echo $item_id ;  ?>" size="10"/></td><td><?php echo "<a href=\"pharmacy_tz_search_o.php?order_id=".$orderno."\"><img src=\"".$root_path."gui/img/common/default/en_searchlamp.gif\"    border=\"0\"></a>";?>
 </td></tr></table></td>
  <td>
  <input type="text" name="quantity" onBlur="validateQuantity();" />

  </td><td><input type="text" name="unitprice" onBlur="validateUnitprice();"   /></td>


  <td>

  <input type="submit" name="add" value="Add" onClick="return checkForm();"/>

  </td>

    </form>
<?php
} else{
	?>
	<form action="purchase_order.php?mode=order_items&updateno=<?php echo $update_no; ?>&orderid=<?php echo $orderno; ?>" method="post" name="w">



    <td></td><td><table border="0"><tr>
  <td><input type="text" name="product_id" readonly="product_id" value="<?php echo $item_id ;  ?>" size="10"/></td><td><?php echo "<a href=\"pharmacy_tz_search_o.php?order_id=$od_no&update_no=$up_no&quantity=$quantity&cost=$cost\"><img src=\"".$root_path."gui/img/common/default/en_searchlamp.gif\"    border=\"0\"></a>";?>
 </td></tr></table></td>
  <td>
  <input type="text" name="quantity" value="<?php echo $update_quantity ;  ?>" onBlur="validateQuantity();" />

  </td><td><input type="text" name="unitprice"  value="<?php echo $update_cost ;  ?>"onBlur="validateUnitprice();"   /></td>


  <td>

  <input type="submit" name="update" value="Update" onClick="return checkForm();"/>

  </td>

    </form>
    <?php
    }
?>
    </tr>
    <?php

    echo"<tr><td></td><td></td><td></td><td></td><td>$sss</td></tr>";
    echo"<tr><td></td><td></td><td></td><td><B>TOTAL :</B></td><td><B>$sss</B></td></tr>";
    //added blow

      ?>




  </table>
  </p>
</fieldset>




<?php
$st = new purchaseorder();
$st->getstatus($order_id);
$status=$st->status;
echo"<a href=\"purchase_orders.php?status=".$status."\"><img src=\"".$root_path."gui/img/common/default/billing_done.gif\"  border=\"0\"></a>";
echo $form;
}
$st= new purchaseorder();
$st->getstatus($order_id);
$status = $st->status;
  if($status!="new")
  {
$report = new  purchasereport();
$report->select_distinct_items($order_id);
}

?>