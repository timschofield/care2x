<?php
class grn_goods extends supplier{
	var $order_id;
	var $date_ordered;
	var $supplier_id;
	var $order_price;
	var $delivery_no;
	var $delivery_date;
	var $received_by;
	var $placed_by;
	var $cash_credit;
	var $currency;
	var $invoice_date;
	var $invoice_no;
	var $date_received;
    var $price;
	var $inv;


	function _constuct(){

	}
	function grn_goods($oid,$odate,$sid,$oby,$oprice,$datercd,$rby,$invdate,$invno,$curr,$status,$dno,$ddate){
		$this->order_id=$oid;
		$this->date_ordered=$odate;
		$this->supplier_id=$sid;
		$this->placed_by=$oby;
		$this->order_price=$oprice;
		$this->received_by=$rby;
		$this->invoice_no=$invno;
		$this->invoice_date=$invdate;
		$this->currency=$curr;
		$this->cash_credit=$status;
		$this->date_received=$datercd;
		$this->delivery_no=$dno;
		$this->delivery_date=$ddate;


	}



	function getorder_id(){
		return $this->order_id;
	}
	function getdate_ordered(){
		return $this->date_ordered;
	}
	function getsupplier_id(){
		return $this->supplier_id;
	}
	function getplaced_by(){
		return $this->placed_by;
	}
	function getreceived_by(){
		return $this->received_by;
	}
	function getreceived_date(){
		return $this->date_received;
	}
	function getcurrency(){
		return $this->currency;
	}
		function getinvoice_no(){
		return $this->invoice_no;
	}
		function getinvoice_date(){
		return $this->invoice_date;
	}
		function getcash_credit(){
		return $this->cash_credit;
	}
		function getorder_price(){
		return $this->order_price;
	}
	function getdelivery_no(){
		return $this->delivery_no;
	}
	function getdelivery_date(){
		return $this->delivery_date;
	}
	function check_order_duplicate($id){

		$sql="select order_no from care_tz_grn_master where order_no=$id";
		$result=$this->query($sql);
		return $result;
	}
	function add_in_grn_master($orderid,$supplierid,$dno,$ddate,$receivedby,$datereceived,$status,$amounts,$currency,$invoicedate,$invoiceno){
      $sql="insert into care_tz_grn_master (order_no,supplier_id,delivery_no,delivery_date,item_received_by,date_received,cash_credit,total_price,currency,invoice_date,invoice_no) values('$orderid','$supplierid','$dno','$ddate','$receivedby','$datereceived','$status','$amounts','$currency','$invoicedate','$invoiceno')";
      $this->query($sql);
      $result=mysql_insert_id();
      return $result;
	}

	function get_grn_details($oid){
		        $sql1="SELECT no,order_no,care_tz_purchase_order_detail.item_id as itid,quantity,received_quantity,unit_cost,total_cost,item_description ,unit_cost*received_quantity as invoice_total FROM care_tz_purchase_order_detail,care_tz_drugsandservices
                          WHERE order_no ='$oid' AND quantity <> received_quantity AND care_tz_purchase_order_detail.item_id=care_tz_drugsandservices.item_id ORDER BY received_quantity,quantity";
          $result=$this->query($sql1);
                          return $result;
	}

	function add_grn_detail($no,$grno,$orderno,$itemid,$oquantity,$rquantity,$invototal,$status,$batch,$expdate){
		$sql2="insert into care_tz_grn_detail (item_no,grn_no,order_no,item_id,ordered_quantity,received_quantity,invoice_total,receiving_status,batch_no,exp_date) values ('$no','$grno','$orderno','$itemid','$oquantity','$rquantity','$invototal','$status','$batch','$expdate')";
		$result=$this->query($sql2);
		return $result;
	}

	function update_purchase_detail($itemno,$orderno,$rquantity){
		$sql3="update care_tz_purchase_order_detail set received_quantity=received_quantity + $rquantity where no='$itemno' AND order_no='$orderno'";
		$result=$this->query($sql3);
		return $result;
	}

	function update_invoice_grn_master($grno,$orderno,$amounts){
		$sql4="update care_tz_grn_master set invoice_amount=invoice_amount + $amounts where grn_no='$grno' AND order_no='$orderno' " ;
		$result= $this->query($sql4);
		return $result;
	}

	function update_purchase_order_status($orderno){
		$sql0="select sum(total_price) as total_price,sum(invoice_amount) as invoice_amount  from care_tz_grn_master where order_no='$orderno' group by order_no";
		$result=$this->query($sql0);

		$row=$this->fetch_object($result);

		$totalprice=mysql_result($result,0,'total_price');

		$invoiceamount=mysql_result($result,0,'invoice_amount');

		if($totalprice==$invoiceamount){
			$sql01="update care_tz_purchase_order set status='received' where order_no='$orderno'";
			$this->query($sql01);
		}

		else
		{
		 $sql01="update care_tz_purchase_order set status='attended' where order_no='$orderno'";
		 $this->query($sql01);

		}
		//$this->query($sql01);
	}


}
?>