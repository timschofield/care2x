<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');



require($root_path.'include/care_api_classes/supplier_database_class.php');

require($root_path.'include/care_api_classes/class_purchase_order.php');
 require_once('index.php');
global $supplier,$del_order;
$supplier=$_REQUEST['supplier'];
$del_order=$_REQUEST['del_order'];

$orders=new purchaseorder();
$orders->dbconnect();
$orders->dbselect();
if(isset($del_order)){
	$sql1="delete from care_tz_purchase_order_detail where order_no='$del_order'";
		$sql2="delete from care_tz_purchase_order where order_no='$del_order'";
	$orders->query($sql1);
	$orders->query($sql2);

}
$rs=$orders->orders($supplier);


?>
<html>
<head>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">

TH {
    font-family: verdana;
    font-size: 10pt;
    background-color: #CCCCE5;
    font-weight: bold;
}
A {
	text-decoration: none;
	color: #000099;


FONT { font-family: verdana; font-size: 10pt; }


</style>
</head>
<body>

<table cellspacing="0"  class="titlebar" border=0 width="75%">
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo"PLACED ORDER'S INFORMATIONS"; ?></font>
       </td>
  <td bgcolor="#99ccff" align=right>

  <a href="javascript:window.history.back()"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
 <a href="#"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>

  <a href= "./index.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  </td>

 </tr>
 </table>
 <p>

<fieldset>
<legend>Search specific Suppliers`s Order</legend>

  <form action="purchase_orders.php" method="post" >

 Enter Supplier: <input type="text" name="supplier" value="<?php echo $supplier; ?>" size="40" maxlength="40"/>

  <input type="submit" name="search" value="Search"/>

  </form>

</fieldset>
<form>
<table padding="0" width="70%">
<tr >
<th>Delete</th><th>Receive</th><th>Order no</th><th>Supplier</th><th>Order date</th><th>Order total</th><th>Show</th>
</tr>
</p>
<?php
$k=0;
while($order=$orders->fetch_object($rs)){
	$o=$order->order_no;
	$s=$order->Company_Name;
	$sid=$order->supplier_id;
	$d=$order->order_date;
    $oby=$order->ordered_by;
	$orders->getstatus($o);
	$st = $orders->status;
$ss=$orders->get_total($o);
$sss=$orders->formatMoney($ss);

if($k==1){
	echo"<tr bgcolor='#CCCCCC'>";
	$k=0;
}else{
	echo"<tr bgcolor='#EEEEEE'>";
	$k++;
}
echo"<td align='center'>"; if($st!='received' && $st!='attended') { ?> <a href='purchase_orders.php?del_order=$o'><IMG src='includes/images/delete.png' border='0' align='center' alt='Delete'></a><?php } echo "</td><td>"; if ($st!='received')
{ echo"<a href='receiving_goods.php?oid=$o&odate=$d&sp=$s&total=$sss&pby=$oby&si=$sid'>Receive</a>"; } else { echo ' complete '; }echo"</td><td>$o</td><td>$s</td><td>$d</td><td>$sss</td><td align='center'><a href=\"purchase_order.php?mode=show&order_id=".$o."\"><img src=\"".$root_path."gui/img/common/default/common_infoicon.gif\"  border=\"0\"></a></td></tr>";
}
?>

</form>
</body>