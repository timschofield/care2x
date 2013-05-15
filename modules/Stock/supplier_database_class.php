<?php
class supplier
{
   var $host;
   var $user;
   var $password;
   var $db;
   var $connection;
   var $companyname;
   var $contactperson;
   var $address1;
   var $adress2;
   var $phone1;
   var $phone2;
   var $cell1;
   var $cell2;
   var $email;
   var $fax;
   var $banker;
   var $bankdetails;
   var $accountnumber;
   var $creditlimit;
   var $creditperiod ;
   var $keyword;
   var $criteria;




   /* Class constructor */
   function _construct(){



   }

   function dbconnect(){
         $this->connection=mysql_connect("localhost","root","")or die(mysql_error());
         return $this->connection;
   }
   function dbselect(){
       $dbselect=mysql_select_db("caredb",$this->connection);
       return $dbselect;
   }
	  //excuting any query
	  function query($sql){
	  	$query=mysql_query($sql)or die(mysql_error());
	  return $query;
	  }
	  //setting suppliers attributes and getting them
	  function setcompanyname($companyname){
	  $this->companyname=$companyname;
	  }
	  function getcompanyname(){
	  return $this->companyname;
	  }
	  function setcontactperson($contactperson){
	  $this->contactperson=$contactperson;
	  }
	  function getcontactperson(){
	  return $this->contactperson;
	  }
	  function setaddress1($address1){
	  $this->address1=$address1;
	  }
	  function getaddress1(){
	  return $this->address1;
	  }
	  function setaddress2($address2){
	  $this->address2=$address2;
	  }
	  function getaddress2(){
	  return $this->address2;
	  }
	  function setphone1($phone1){
	  $this->phone1=$phone1;
	  }
	  function getphone1(){
	  return $this->phone1;
	  }
	   function setphone2($phone2){
	  $this->phone2=$phone2;
	  }
	  function getphone2(){
	  return $this->phone2;
	  }
	   function setcell1($cell1){
	  $this->cell1=$cell1;
	  }
	  function getcell1(){
	  return $this->cell1;
	  }
	  function setcell2($cell2){
	  $this->cell2=$cell2;
	  }
	  function getcell2(){
	  return $this->cell2;
	  }
	  function setemail($email){
	  $this->email=$email;
	  }
	  function getemail(){
	  return $this->email;
	  }
	  function setfax($fax){
	  $this->fax=$fax;
	  }
	  function getfax(){
	  return $this->fax;
	  }
	   function setbanker($banker){
	  $this->banker=$banker;
	  }
	  function getbanker(){
	  return $this->banker;
	  }
	  	   function setbankdetail($bankdetail){
	  $this->bankdetails=$bankdetail;
	  }
	  function getbankdetail(){
	  return $this->bankdetails;
	  }
	  	   function setaccountno($accountnumber){
	  $this->accountnumber=$accountnumber;
	  }
	  function getaccountno(){
	  return $this->accountnumber;
	  }
	   function setcreditlimit($creditlimit){
	  $this->creditlimit=$creditlimit;
	  }
	  function getcreditlimit(){
	  return $this->creditlimit;
	  }
	  	   function setcreditperiod($creditperiod){
	  $this->creditperiod=$creditperiod;
	  }
	  function getcreditperiod(){
	  return $this->creditperiod;
	  }
	  function setsearch_keyword($searchkeyword){
	  	$this->keyword=$searchkeyword;

	  }
	  function setcriteria($searchcriteria){
	  	$this->criteria=$searchcriteria;
	  }
	  function getkeyword(){
	  	return $this->keyword;
	  }
      function getcriteria(){
      	return $this->criteria;
      }
      function fetch_object($results){

      	return mysql_fetch_object($results);
      }
      function recordcount($record){

      	return mysql_num_rows($record);
      }

	  //Add supplier info
   function addSupplier($companyname, $contactperson,$address1,$adress2,$cell1,$cell2,$phone1,$phone2, $email,$fax,$banker,$bankdetails,$accountnumber,$creditlimit,$creditperiod )
	   {
	   $sql1= "INSERT INTO Care_tz_Supplier_deatail (Company_Name,Contact_person,Address1,Address2,Phone1,Phone2,Cell1,Cell2,Email,Fax,Banker,Bank_Details,Account_no,Credit_limit,Credit_period)
	   VALUES ('$companyname', '$contactperson','$address1','$adress2','$phone1','$phone2','$cell1','$cell2', '$email','$fax','$banker','$bankdetails','$accountnumber','$creditlimit','$creditperiod ')";
      if($result=$this->query($sql1)){
	  return true;
	  }
	  else{
	  return $result;
	  }
	   }
	   //get all suppliers in the database
	   function get_all_suppliers(){
           $sql2="select Suplier_id,Company_Name,Contact_Person from care_tz_supplier_deatail ORDER BY Suplier_id DESC";
           $result=$this->query($sql2);
           return $result;

	   }
	   function get_criteria_search_results($criteria,$keyword)
	   {
          $sql3="select Suplier_id,Company_Name,Contact_Person from care_tz_supplier_deatail where  $criteria like '%$keyword%'  ORDER BY Suplier_id DESC";
          		$result=$this->query($sql3);
          		return $result;
	   }
       function show_supplier_details($id){
       	$sql4="select * from care_tz_supplier_deatail where Suplier_id='$id'";
       	$result=$this->query($sql4);
       	return $result;
       }
     function update_supplier($id,$companyname, $contactperson,$address1,$adress2,$cell1,$cell2,$phone1,$phone2, $email,$fax,$banker,$bankdetails,$accountnumber,$creditlimit,$creditperiod )
     {
     	$sql5="update care_tz_supplier_deatail set Company_Name='$companyname',Contact_Person='$contactperson',Address1='$address1',Address2='$adress2',Phone1='$cell1',Phone2='$cell2',Cell1='$phone1',Cell2='$phone2',Email='$email',Fax='$fax',Banker='$banker',Bank_Details='$bankdetails',Account_no='$accountnumber',Credit_Limit='$creditlimit',Credit_Period='$creditperiod' where Suplier_id='$id'";
     	if($result=$this->query($sql5)){
     		return true;
     	}else{
     		return $result;
     	}
	   }
	   function detete_supplier($id){
	   	$sql6="DELETE from care_tz_supplier_deatail where Suplier_id='$id'";
	   	$result=$this->query($sql6);
	   	return $result;
	   }

}
?>