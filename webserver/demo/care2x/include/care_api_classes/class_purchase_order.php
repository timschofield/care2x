<?php
require('./roots.php');
class purchaseorder extends supplier
{
  var $status;

	function _construct(){

	}
	
	function getstatus($orderno)
	{
	 
	 if(trim($orderno)!="")
	  {
	    $res = mysql_query("select status from care_tz_purchase_order where order_no='$orderno'") or die(mysql_error());
		$row = mysql_fetch_array($res);
		$this->status = $row['status'];
	  }
	  elseif(!isset($_GET['status']))
	  { 
	  if(isset($_POST['search']))
	  {
	    $this->status='';
	  }
	  else
	  {
	    $this->status = 'new';
	  }
	  }
	  else
	  {
	    $this->status = $_GET['status'];
	  }
	   
	}
	function add_order($datecreated,$supplier_id,$createdby){
		$sqlo1="insert into care_tz_purchase_order (order_date,supplier_id,ordered_by) values('$datecreated','$supplier_id','$createdby')";
      $this->query($sqlo1);
      $result=mysql_insert_id();
      return $result;
	}
	function get_order($order_id){
		$sqlo2="select * from care_tz_purchase_order where order_no='$order_id'";
		$result=$this->query($sqlo2);
		return $result;
	}
	function get_supplier($id){
		$sqlo3="select Company_Name from care_tz_supplier_deatail where Suplier_id='$id'";
		$result=$this->query($sqlo3);
		return mysql_result($result,0,'Company_Name');
	}
	function generate_order($orderno,$supplier,$orderedby,$datecreated){
		$val="
		<table border='0' cellpadding=2><tr><td>
<b>Order number :</b></td><td>$orderno</td></tr>
<tr><td><b>Supplier  : </b></td><td>$supplier</td></tr>
<tr><td><b>Ordered by  :</b></td><td>$orderedby</td></tr>
<tr><td><b>Order date  :</b></td><td>$datecreated</td></tr>
</table>";
return $val;
	}
	function add_order_items($orderno,$item_id,$quantity,$unit_cost,$total_cost){
     $sql04="insert into care_tz_purchase_order_detail (order_no,item_id,quantity,unit_cost,total_cost) values($orderno,$item_id,$quantity,$unit_cost,$total_cost)";
     $result=$this->query($sql04);
     return $result;
	}
	function get_order_details($id){
		$sq="select * from care_tz_purchase_order_detail where order_no='$orderno'";
		$result=$this->query($sq);
		return $result;
	}
	function orders($supplier){
	$this->getstatus("");
		$sql1="select order_no,order_date,supplier_id,ordered_by, Company_Name from care_tz_purchase_order,care_tz_supplier_deatail where
care_tz_supplier_deatail.Suplier_id=care_tz_purchase_order.supplier_id AND care_tz_supplier_deatail.Company_Name LIKE
'%$supplier%' and care_tz_purchase_order.status like '%$this->status%' group by order_no
	order by order_no desc";
	$result=$this->query($sql1);
	return $result;
	}
function get_total($id){
	$s="select sum(total_cost)as m from care_tz_purchase_order_detail where order_no='$id'";
	$sum=$this->query($s);
	//$sum=mysql_query("select sum(total_cost)as m from care_tz_purchase_order_detail where order_no='$o'");
$result=mysql_result($sum,0,'m');
return $result;
}

function formatMoney($amount)
{
	$amount = round($amount, 2);
	return sprintf('%9.2f', $amount);
}
function update_order_items($orderno,$item_id,$quantity,$unit_cost,$total_cost,$updateno){
     $sql05="UPDATE care_tz_purchase_order_detail SET item_id='$item_id',quantity='$quantity',total_cost='$total_cost',unit_cost='$unit_cost' where order_no='$orderno' AND no='$updateno'";

     $result=$this->query($sql05);
     return $result;
	}



}
?>