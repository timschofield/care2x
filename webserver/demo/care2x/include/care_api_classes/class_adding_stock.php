<?php

class addstore extends supplier
{
var $locationid;
var $locationname;
var $storeid;
var $storename;
var $storetype;
var $msg;
var $msg2;
 function addstore()
      {
	    $this->dbconnect();
		$this->dbselect();
	  }

 function insertlocation($locname,$lid)
      {
	  if(trim($locname)=="")
	    {
		  $warn="<font color='red'>*</font>";
		  $this->locationname=$warn;
		  $this->msg2 = "<font color='red'>the location name can not be blank</font>";
		}
	 else
	 {
	 	if($lid!='')
	 	$query0 = "update care_tz_location set Name='$locname' where id=$lid";
	 	else
	  $query0 = "insert into care_tz_location(Name) values('$locname')";
	  $this->query($query0);
	  $this->locationid=mysql_insert_id();
	   $this->locationname="";
	    $this->msg2 = "<font color='red'>Location added</font>";
	    if($lid!='')
	    $this->msg2 = "<font color='red'>Location edited</font>";
	  }
	 }

 function insertstore($sttype,$stname,$locid,$acti)
    {
	  $query5 = "select * from care_tz_store_info where Store_name='$stname' and Store_type='$sttype' and location_id='$locid' ";
	  $res = $this->query($query5);
	  $num = mysql_num_rows($res);

	  if(trim($sttype)=="" || trim($stname)=="" || trim($locid)=="")
	  {
	    $warn="<font color='red'>*</font>";
	    if(trim($sttype)=="")
		  $this->storetype=$warn;
		if(trim($stname)=="")
		  $this->storename=$warn;
		if(trim($locid)=="")
		   $this->locationid=$warn;
		   $this->msg = "<font color='red'>fill each item in the form</font>";
	  }
	  elseif($num!=0 && $acti=="")
	  {
	    $this->msg = "<font color='red'>The store exists, choose another name</font>";
	  }
	  else
	  {
	  	if($acti!="")
	  	$query1 = "update care_tz_store_info set Store_type='$sttype',Store_name='$stname',location_id='$locid' where Store_id=$acti";
	  	else
	  $query1 = "insert into care_tz_store_info(Store_type,Store_name,location_id) values('$sttype','$stname','$locid')";
	  $this->query($query1);
	  $this->msg = "<font color='red'>Store added</font>";
	  if($acti!="")
	  $this->msg = "<font color='red'>Store edited</font>";
	  $warn="";
	  $this->storetype=$warn;
	  $this->storename=$warn;
	  $this->locationid=$warn;
	  }
	}

 function get_all_locations()
   {
   $query2 = "select * from care_tz_location";
   $result = $this->query($query2);
   return $result;
   }

}










?>
