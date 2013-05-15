<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

//require_once('index.php');

require($root_path.'include/care_api_classes/supplier_database_class.php');

require($root_path.'include/care_api_classes/class_purchase_order.php');
require($root_path.'include/care_api_classes/class_grn_master_detail.php');
require($root_path.'include/care_api_classes/class_add_to_store.php');

$additem = new addtostore();
$order_id=$_REQUEST['oid'];
$plced_date=$_REQUEST['odate'];
$supplier=$_REQUEST['sp'];
$amount=$_REQUEST['total'];
$placed_by=$_REQUEST['pby'];
$supplier_id=$_REQUEST['si'];
$SP=strtoupper($supplier);
$datedefault=date("d/m/Y");

?>
<script language="JavaScript" type="text/javascript">
  function checkForm(){
  	var save;
  	save=false;
  	with(document.grn){
  		if(currency.value==""){
  			alert("Select currency");
  			currency.focus();
  			return save;
  		}else if(datereceived.value==""){
  			alert("Enter received date");
  			datereceived.focus();
  			return save;

  		}
  		else if(receivedby.value==""){
  			alert("Enter who is receiving this order");
  			receivedby.focus();
  			return save;

  		}
  		else if(cash_credit.value==""){
  			alert("Specify receiving status");
  			cash_credit.focus();
  			return save;

  		}
  		else if(invoicedate.value==""){
  			alert("Invoice date please");
  			invoicedate.focus();
  			return save;
  		}else if(invoiceno.value==""){
  			alert("Enter invoice number please");
  			invoiceno.focus();
  			return save;

  		}
  		else if(deliveryno.value==""){
  			alert("Enter delivery number please");
  			deliveryno.focus();
  			return save;

  		}else if(deliverydate.value==""){
  			alert("Enter delivery date please");
  			deliverydate.focus();
  			return save;

  		}

  		else{
  			return true;
  		}
  	}
  }

  function checkForm2(){
  	var save;
  	save=false;
    var va1=document.grn2.rquantity.value;
     var va2=document.grn2.oquantity.value;
     var r=document.grn2.rcd.value;
     var received=parseInt(va1,10);
     var ordered=parseInt(va2,10);
     var rr=parseInt(r,10);
     var m=received+rr;

  	with(document.grn2){
  		if(rquantity.value==""){
  			alert("Please enter received quantity");
  			rquantity.focus();
  			return save;
  		}else if(cash_credit.value==""){
  			alert("Select the receiving status");
  			cash_credit.focus();
  			return save;

  		}else if(expdate.value==""){
  			alert("Specify the expare date");
  			expdate.focus();
  			return save;

  		}else if(m > ordered ){
			alert('Please note that the quantity received should not exceed the ordered quantity')
		     document.grn2.rquantity.focus();
		     return save;

		}
  		else{
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
function validatereceivedquantity()


{
	if(isNaN(document.grn2.rquantity.value)==true)
		{
		if(document.grn2.rquantity.value!="")
		{
		alert('pls insert number(s) only')
		document.grn2.rquantity.focus();

		}

		}
}

</script>


<STYLE TYPE="text/css">
<!--
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
.product_table {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
}

// .class_classification {
}
.classification {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: dotted;
	border-bottom-style: none;
	border-left-style: none;
}
.product_price {
	font-family: Arial, Helvetica, sans-serif;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: dotted;
	border-right-style: none;
	border-bottom-style: dotted;
	border-left-style: none;
}
-->
</style>
<script type="text/javascript" src="calendarDateInput.js">
</script>
</HEAD>
<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>


<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">

<table cellspacing="0"  class="titlebar" border=0 width="75%">
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo" RECEIVING GOODS FROM  $SP"; ?></font>
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

/*$grn=new grn_goods();
$grn->dbconnect();

$grn->dbselect();
$result1=$grn->check_order_duplicate($order_id);
*/
if(isset($_POST['receive'])){
	$grn=new grn_goods($_POST['orderno'],$_POST['odate'],$_POST['supplierid'],$_POST['oby'],$_POST['amount'],$_POST['datereceived'],$_POST['receivedby'],$_POST['invoicedate'],$_POST['invoiceno'],$_POST['currency'],$_POST['cash_credit'],$_POST['deliveryno'],$_POST['deliverydate']);
	$orderid=$grn->getorder_id();
	$orderdate=$grn->getdate_ordered();
	$supplierid=$grn->getsupplier_id();
	$orderedby=$grn->getplaced_by();
	$amounts=$grn->getorder_price();
	$datereceived=$grn->getreceived_date();
	$receivedby=$grn->getreceived_by();
	$invoicedate=$grn->getinvoice_date();
	$invoiceno=$grn->getinvoice_no();
	$currency=$grn->getcurrency();
	$status=$grn->getcash_credit();
	$dno=$grn->getdelivery_no();
	$ddate=$grn->getdelivery_date();



$grn->dbconnect();

$grn->dbselect();
$grn_no=$grn->add_in_grn_master($orderid,$supplierid,$dno,$ddate,$receivedby,$datereceived,$status,$amounts,$currency,$invoicedate,$invoiceno);
$data=$grn->get_grn_details($orderid);
$//data=mysql_query($data)or die(mysql_error());




$k=0;
if($grn->recordcount($data)< 1){
	//think of deleting its information from grn_master
	echo "There is nothing to receive on the selected order";
}else{
	echo"
<table padding='2' cellspacing='2' border='1'>
<tr bgcolor='#CCCCCC'>
<th>Item name</th><th>Oder number</th><th>Ordered quntity</th><th>Received quanity</th><th>Unit price</th><th>Order Amount</th><th>Invoice Amount</th><th>Receive</th>
</tr>";

while($row=$grn->fetch_object($data)){
	$trans_no=$row->no;
	$order_no=$row->order_no;
	$item_id=$row->itid;
	$orderedquantity=$row->quantity;
	$receivedq=$row->received_quantity;
	$unitcost=$row->unit_cost;
	$totalodered=$row->total_cost;
	$itemname=$row->item_description;
	$am=$row->invoice_total;
	$amount1=$grn->formatMoney($totalodered);

	$amount2=$grn->formatMoney($am);
	if($k==1){
		echo "<tr bgcolor='#EEEEEE'>";
		$k=0;
	}else{
		echo "<tr bgcolor=#ffffff>";
		$k++;
	}
	// this is the first output after submiting the first recevining form
	echo"<td align='center'>$itemname</td><td align='center'>$order_no</td><td align='center'>$orderedquantity</td><td align='center'>$receivedq</td><td align='center'>$unitcost</td><td align='center'>$amount1</td><td align='center'>$amount2</td><td><a href='receiving_goods.php?mode=selected&id=$order_no&grn=$grn_no&itname=$itemname&odquantity=$orderedquantity&itemid=$item_id&itemno=$trans_no&price=$unitcost&rcvd=$receivedq'>select</a></td></tr>";
}
}
echo "<table>";
//the above outputs ends here.

//code forms goes here for a specific item after clicking a select link for aparticular product
}else if($_REQUEST['mode']=='selected'){
	$id=$_REQUEST['id'];
	$grns=$_REQUEST['grn'];
	$itemnames=$_REQUEST['itname'];
	$orderquantity=$_REQUEST['odquantity'];
	$itemid=$_REQUEST['itemid'];
	$itemno=$_REQUEST['itemno'];
	$price=$_REQUEST['price'];
	$rcvd=$_REQUEST['rcvd'];
	$grn=new grn_goods();
	$grn->dbconnect();

$grn->dbselect();
$data=$grn->get_grn_details($id);



	echo"
<table padding='2' cellspacing='2' border='1'>
<tr bgcolor='#CCCCCC'>
<th>Item name</th><th>Oder number</th><th>Ordered quntity</th><th>Received quanity</th><th>Unit price</th><th>Order Amount</th><th>Invoice Amount</th><th>Receive</th>
</tr>";

while($row=$grn->fetch_object($data)){
	$trans_no=$row->no;
	$order_no=$row->order_no;
	$item_id=$row->itid;
	$orderedquantity=$row->quantity;
	$receivedq=$row->received_quantity;
	$unitcost=$row->unit_cost;
	$totalodered=$row->total_cost;
	$itemname=$row->item_description;
	$am=$row->invoice_total;
	$amount1=$grn->formatMoney($totalodered);

	$amount2=$grn->formatMoney($am);
	if($k==1){
		echo "<tr bgcolor='#EEEEEE'>";
		$k=0;
	}else{
		echo "<tr bgcolor=#ffffff>";
		$k++;
	}
	echo"<td align='center'>$itemname</td><td align='center'>$order_no</td><td align='center'>$orderedquantity</td><td align='center'>$receivedq</td><td align='center'>$unitcost</td><td align='center'>$amount1</td><td align='center'>$amount2</td><td><a href='receiving_goods.php?mode=selected&id=$order_no&grn=$grns&itname=$itemname&odquantity=$orderedquantity&itemid=$item_id&itemno=$trans_no&price=$unitcost&rcvd=$receivedq'>select</a></td></tr>";
}

echo "<table>";
?>
<BR>
RECEIVING <b> <?php echo $itemnames ; ?> </b>Now.
<form  action="receiving_goods.php" method="post" name="grn2">


	      <table border=0 cellspacing=1 cellpadding=3 class="product_table">
            <tbody class="submenu">
              <tr>

                <td align=right width=145 >Order Number </td>
                <td width="350"><input type="text" name="orderno" readonly="orderno" value="<?php echo $id; ?>" size=40 maxlength=60></td>
              </tr>
              <tr>


                <td align=right width=145>Goods received Number</td>
                <td><input type="text" name="grno" readonly="grno"value="<?php echo $grns;?>"  size=40 maxlength=40>                </td>
              </tr>
              <tr>
                <td align=right width=145> Item decription               </td>
                <td><input type="text" name="itemdes" readonly="itemdes"value="<?php echo $itemnames?>"  size=40 maxlength=40>                </td>
              </tr>



                  <tr>
                <td align=right width=145>Ordered quantiry</td>
                <td><input type="text" name="oquantity" readonly="oquantity" value="<?php echo $orderquantity;?>"  size=40 maxlength=40></td>
              </tr>
              <tr>


                <td align=right width=145>Received quantity              </td>
                <td><input type="text" name="rquantity" value=""  size=40 maxlength=40  onBlur="validatereceivedquantity();">                </td>
              </tr>
              <tr>


                <td align=right width=145>Unit price              </td>
                <td><input type="text" name="uprice"  readonly="uprice" value="<?php echo $price; ?>"  size=40 maxlength=40>                </td>
              </tr>
                         <tr>


                <td align=right width=145>Receiving Status                </td>
                <td>
     	 	<select name="cash_credit">
 		 	<option value="">--Select--</option>
    		<option value="cash">Cash</option>
   		 <option value="credit">Credit</option>
   		 <option value="cash and credit">Cash and Credit</option>
  				</select>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Batch Number       </td>
                <td><input type="text" name="batchno" value=""  size=40 maxlength=40>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Expare date       </td>
                <td><div align="left">
                  <script>DateInput('expdate', true, 'YYYY-MM-DD')</script>
                </div></td>
              </tr>
              <tr>


                <td align=right>&nbsp;</td>
                <td><input type="hidden" name="itemno" value="<?php echo $itemno; ?>">
                <input type="hidden" name="rcd" value="<?php echo $rcvd; ?>"></td>
              </tr>

<!--goes here -->
              <tr>


                <td align=right width=145>&nbsp;</td>
                <td align=right>




				        <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">

                <input type="submit" value="Save this" name="receiveitem" onClick="return checkForm2();"/> &nbsp;<input type="reset" value="Reset"> </td>
              </tr>
            </tbody>
          </table>

</form>

<?
}else if(isset($_POST['receiveitem'])){
	 $no=$_POST['itemno'];
	 $grno=$_REQUEST['grno'];
	 $orderno=$_REQUEST['orderno'];
	 $itemid=$_POST['itemid'];
	 $oquantity=$_POST['oquantity'];
	 $rquantity=$_POST['rquantity'];
	 $invototal=$rquantity*$_POST['uprice'];
	 $status=$_POST['cash_credit'];
	 $batch=$_POST['batchno'];
	 $expdate=$_POST['expdate'];

$process=new grn_goods();
$process->dbconnect();

$process->dbselect();

if($process->add_grn_detail($no,$grno,$orderno,$itemid,$oquantity,$rquantity,$invototal,$status,$batch,$expdate))
{
	$process->update_invoice_grn_master($grno,$orderno,$invototal);

	$process->update_purchase_detail($no,$orderno,$rquantity);

	$process->update_purchase_order_status($orderno);

     $additem->insert_item( $itemid,1,$batch,$expdate,$rquantity);
	echo"The Item is succesful received. ";

	$data=$process->get_grn_details($orderno);

	echo"
<table padding='2' cellspacing='2' border='1'>
<tr bgcolor='#CCCCCC'>
<th>Item name</th><th>Oder number</th><th>Ordered quntity</th><th>Received quanity</th><th>Unit price</th><th>Order Amount</th><th>Invoice Amount</th><th>Receive</th>
</tr>";

while($row=$process->fetch_object($data)){
	$trans_no=$row->no;
	$order_no=$row->order_no;
	$item_id=$row->itid;
	$orderedquantity=$row->quantity;
	$receivedq=$row->received_quantity;
	$unitcost=$row->unit_cost;
	$totalodered=$row->total_cost;
	$itemname=$row->item_description;
	$am=$row->invoice_total;
	$amount1=$process->formatMoney($totalodered);

	$amount2=$process->formatMoney($am);
	if($k==1){
		echo "<tr bgcolor='#EEEEEE'>";
		$k=0;
	}else{
		echo "<tr bgcolor=#ffffff>";
		$k++;
	}
	echo"<td align='center'>$itemname</td><td align='center'>$order_no</td><td align='center'>$orderedquantity</td><td align='center'>$receivedq</td><td align='center'>$unitcost</td><td align='center'>$amount1</td><td align='center'>$amount2</td><td><a href='receiving_goods.php?mode=selected&id=$order_no&grn=$grno&itname=$itemname&odquantity=$orderedquantity&itemid=$item_id&itemno=$trans_no&price=$unitcost&rcvd=$receivedq'>select</a></td></tr>";
}

echo "<table>";



}

}
else{
	//receiving starts with this form
	?>
COMPLETE THE FORM BELOW FIRST:
	<form  action="" method="post" name="grn">


	      <table border=0 cellspacing=1 cellpadding=3 class="product_table">
            <tbody class="submenu">
              <tr>

                <td align=right width=145 >Order Number </td>
                <td width="350"><input type="text" name="orderno" readonly="orderno" value="<?php echo $order_id; ?>" size=40 maxlength=60></td>
              </tr>
              <tr>


                <td align=right width=145>Supplier Name</td>
                <td><input type="text" name="supplier" readonly="supplier"value="<?php echo $supplier;?>"  size=40 maxlength=40>                  </td>
              </tr>
              <tr>
                <td align=right width=145> Date Ordered                 </td>
                <td><input type="text" name="odate" readonly="odate"value="<?php echo $plced_date;?>"  size=40 maxlength=40>                  </td>
              </tr>

               <tr>
                <td align=right width=145>Order Placed by                 </td>
                <td><input type="text" name="oby" readonly="oby"  value="<?php echo $placed_by;?>" size=40 maxlength=40 ></td>
              </tr>

                  <tr>
                <td align=right width=145>Order Amount</td>
                <td><input type="text" name="amount" readonly="amount" value="<?php echo $amount;?>"  size=40 maxlength=40></td>
                  </tr>
              <tr>


                <td align=right width=145>Currency               </td>
                <td>
  <select name="currency">
   <option value="">---Select one---</option>
   <option value="Tshs">Tanzanian Shilling Tshs</option>
    <option value="US $">US dollar $</option>
  </select><input type="hidden" name="supplierid"  value="<?php echo $supplier_id;?>" >                  </td>
              </tr>
              <tr>


                <td align=right width=145>Date Received                   </td>
                <td><input type="text" name="datereceived" value="<?php echo $datedefault;?>"  size=40 maxlength=40 >                  </td>
              </tr>
              <tr>


                <td align=right width=145><p>Order Received By</p>                 </td>
                <td><input type="text" name="receivedby" value=""  size=40 maxlength=40 ></td>
              </tr>
              <tr>
              <tr>


                <td align=right width=145>Receiving Status                </td>
                <td>
  <select name="cash_credit">
  <option value="">--Select--</option>
    <option value="cash">Cash</option>
    <option value="credit">Credit</option>
    <option value="cash and credit">Cash and Credit</option>
  </select>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Invoice date             </td>
                <td><div align="left">
                  <script>DateInput('invoicedate', true, 'YYYY-MM-DD')</script>
                </div>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Invoice number              </td>
                <td><input type="text" name="invoiceno" value=""  size=40 maxlength=40>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Delivery number              </td>
                <td><input type="text" name="deliveryno" value=""  size=40 maxlength=40>                  </td>
              </tr>
              <tr>


                <td align=right width=145>Delivery date         </td>
                <td><input type="text" name="deliverydate" value="<?php echo $datedefault; ?>"  size=40 maxlength=40>                  </td>
              </tr>
              <tr>


                <td align=right>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

<!--goes here -->
              <tr>


                <td align=right width=145>&nbsp;</td>
                <td align=right>




				        <input type="hidden" name="mode" value="create">
		                <input type="submit" value="Receive Now" name="receive" onClick="return checkForm();"/>
                  &nbsp;
				        <input type="reset" value="Reset"> </td>
              </tr>
            </tbody>
          </table>

  </form>

<?php
//receiving form ends here.
}







?>