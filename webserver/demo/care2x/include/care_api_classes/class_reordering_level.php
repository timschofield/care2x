<?php
class reordering extends supplier
{
 var $offset;
 var $paggingquery;
 var $pageNum;
 var $rowsPerPage;
 var $name;
 var $id;
 var $string1;
 var $msg;
 var $level;
  function reordering()
   {
    $this->dbconnect();
    $this->dbselect();
   }

 function display($string,$rowsPerPage,$choice)
   {
     $this->string1 = $string;
     $this->rowsPerPage=$rowsPerPage;
     $this->paging_set($rowsPerPage);
	 echo"<table width='90%' align='center'>";
	 if($choice=="below")
	 {

     $query = "select care_tz_drugs_reordering_level.item_id,care_tz_drugsandservices.item_id,care_tz_drugs_reordering_level.reordering_level,care_tz_drugsandservices.item_full_description,sum(care_tz_stock_in_hand.current_qty) as av from care_tz_drugs_reordering_level,care_tz_stock_in_hand,care_tz_drugsandservices where care_tz_drugs_reordering_level.item_id=care_tz_drugsandservices.item_id and
 care_tz_drugsandservices.item_id=care_tz_stock_in_hand.item_id and care_tz_drugs_reordering_level.reordering_level > (select sum(current_qty) from care_tz_stock_in_hand where care_tz_stock_in_hand.item_id=care_tz_drugs_reordering_level.item_id) and item_full_description like '%".$string."%' group by care_tz_drugs_reordering_level.item_id order by item_full_description ";
	  $result = mysql_query("select care_tz_drugs_reordering_level.item_id,care_tz_drugsandservices.item_id,care_tz_drugs_reordering_level.reordering_level,care_tz_drugsandservices.item_full_description,sum(care_tz_stock_in_hand.current_qty) as av from care_tz_drugs_reordering_level,care_tz_stock_in_hand,care_tz_drugsandservices where care_tz_drugs_reordering_level.item_id=care_tz_drugsandservices.item_id and
 care_tz_drugsandservices.item_id=care_tz_stock_in_hand.item_id and care_tz_drugs_reordering_level.reordering_level > (select sum(current_qty) from care_tz_stock_in_hand where care_tz_stock_in_hand.item_id=care_tz_drugs_reordering_level.item_id) and item_full_description like '%".$string."%' group by care_tz_drugs_reordering_level.item_id order by item_full_description limit ".$this->offset.",".$rowsPerPage."");
	 echo "<tr bgcolor='#c2c2c2'><td><strong>S/no.</strong></td><td><strong>Medicine</strong></td><td><strong>Available qty</strong></td><td><strong>Re-ordering level</strong></td><td><strong>edit</strong></td></tr>";
	 }
	 if($choice=="all")
	{
	 $query = "select care_tz_drugsandservices.item_id,care_tz_drugsandservices.item_full_description from care_tz_drugsandservices,care_tz_drugs_reordering_level where care_tz_drugs_reordering_level.item_id =care_tz_drugsandservices.item_id and
	 purchasing_class='drug_list' and item_full_description like '%".$string."%' order by item_full_description ";
	  $result = mysql_query("select care_tz_drugsandservices.item_id,care_tz_drugsandservices.item_full_description from care_tz_drugsandservices,care_tz_drugs_reordering_level where care_tz_drugs_reordering_level.item_id =care_tz_drugsandservices.item_id and
	 purchasing_class='drug_list' and item_full_description like '%".$string."%' order by item_full_description limit ".$this->offset.",".$rowsPerPage."");
	 echo "<tr bgcolor='#c2c2c2'><td><strong>S/no.</strong></td><td><strong>Medicine</strong></td><td><strong>Available qty</strong></td><td><strong>Re-ordering level</strong></td><td><strong>view</strong></td><td><strong>edit</strong></td></tr>";

	}
	if($choice=="set")
	{
	 $query = "select item_id,item_full_description from care_tz_drugsandservices where purchasing_class='drug_list' and item_full_description like '%".$string."%' and item_id not in (select item_id from care_tz_drugs_reordering_level)";

	  $result = mysql_query("select care_tz_drugsandservices.item_id,care_tz_drugsandservices.item_full_description from care_tz_drugsandservices where purchasing_class='drug_list' and item_full_description like '%".$string."%' and care_tz_drugsandservices.item_id not in (select item_id from care_tz_drugs_reordering_level) order by care_tz_drugsandservices.item_full_description limit ".$this->offset.",".$rowsPerPage."");
	   echo "<tr bgcolor='#c2c2c2'><td>S/no.</td><td>Medicine</td><td>Available</td><td>Set</td></tr>";
	}

	 $n = $this->offset + 1;
	 while($rows = mysql_fetch_object($result))
	 {
	   $id = $rows->item_id;
	   $name=$rows->item_full_description;
	   $this->result($choice,$n,$name,$id,$string);
	   $n++;
	   if(isset($_GET['store']))
  {
  	if($id==$_GET['id'])
  	{
   $query1 = mysql_query("select sum(care_tz_stock_in_hand.current_qty) as sum,care_tz_store_info.Store_name,care_tz_location.Name,care_tz_drugsandservices.item_full_description from care_tz_stock_in_hand,care_tz_drugsandservices,care_tz_drugs_reordering_level,care_tz_store_info,care_tz_location where care_tz_drugs_reordering_level.item_id =care_tz_drugsandservices.item_id and
	 care_tz_stock_in_hand.Store_id=care_tz_store_info.Store_id and care_tz_stock_in_hand.item_id=care_tz_drugsandservices.item_id and care_tz_location.id=care_tz_store_info.location_id and purchasing_class='drug_list' and care_tz_stock_in_hand.item_id=$id group by care_tz_stock_in_hand.Store_id ");
	 $k=1;
    $num = mysql_num_rows($query1);
    if($num!=0)
    {
	 echo "<tr><td  colspan='6' ><table align='center' width='80%'><tr bgcolor='#c2c2c2'><td>no.</td><td>Location</td><td>Store name</td><td>Amount</td></tr>";
	while($ro = mysql_fetch_object($query1))
	{
	 $name1=$ro->item_full_description;
     $sum = $ro->sum;
     $store = $ro->Store_name;
     $loc = $ro->Name;
     echo "<tr><td>".$k."</td><td>".$loc."</td><td>".$store."</td><td>".$sum ."</td></tr>";
     $k++;
	}
	echo "</td></tr></table>";
  }
  	}
  }
	 }
	 echo "</table>";
	 $this->paging_get($query,$choice);
   }


   function paging_set($rowsPerPage)
    {

    $this->pageNum = 1;
    if(isset($_GET['page']))
    {
    $this->pageNum = $_GET['page'];

    }
   $this->offset = ($this->pageNum - 1) * $rowsPerPage;
	}



	function paging_get($query,$choice)
	{
	$string = $this->string1;
	$res = mysql_query($query);
$numrows=mysql_num_rows($res);
$rowsPerPage=$this->rowsPerPage;
$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';
for($page = 1; $page <= $maxPage; $page++)
{
   if ($page == $this->pageNum)
   {
      $nav .= " $page ";
   }
   else
   {
      $nav .= " <a href=\"$self?page=$page&goto=reorder&string=$string&view=$choice\">$page</a> ";
   }
}
if ($this->pageNum > 1)
{
   $page  = $this->pageNum - 1;
   $prev  = " <a href=\"$self?page=$page&goto=reorder&string=$string&view=$choice\">[Prev]</a> ";

   $first = " <a href=\"$self?page=1&goto=reorder&string=$string&view=$choice\">[First Page]</a> ";
}
else
{
   $prev  = '&nbsp;';
   $first = '&nbsp;';
}

if ($this->pageNum < $maxPage)
{
   $page = $this->pageNum + 1;
   $next = " <a href=\"$self?page=$page&goto=reorder&string=$string&view=$choice\">[Next]</a> ";

   $last = " <a href=\"$self?page=$maxPage&goto=reorder&string=$string&view=$choice\">[Last Page]</a> ";
}
else
{
   $next = '&nbsp;';
   $last = '&nbsp;';
}

 echo '<table width=90% align="center"><tr><td align=center>'.$first . $prev . $nav . $next . $last.'
             </td></tr></table>';

	}

 function get_medicine($item_id)
   {
    $res = mysql_query("select item_id,item_full_description from care_tz_drugsandservices where item_id=$item_id");
	$row = mysql_fetch_object($res);
	$this->name = $row->item_full_description;
	$this->id = $row->item_id;
   }

  function insert($id,$level)
  {
    if($level=="")
	{
	 $this->msg="fill reordering level field";
	}
	elseif(!ereg('(^[0-9]+$)',$level))
	{
	 $this->msg="use intergers only for reordering level";
	}
	else
	{
    $res1 = mysql_query("select * from care_tz_drugs_reordering_level where item_id=$id");
	$num = mysql_num_rows($res1);
	if($num==0)
	{
	 $query = "insert into care_tz_drugs_reordering_level(item_id,reordering_level) values($id,$level)";
	}
	else
	{
	 $query = "update care_tz_drugs_reordering_level set reordering_level=$level where item_id=$id";
	}
	if(mysql_query($query))
	 {
	  $this->msg = "succes !";

	 }
	 else
	 die(mysql_error());
	}
	$this->get_medicine($id);
  }
  function result($choice,$n,$name,$id,$string)
  {
   if($choice=="set")
   {
   $resi = mysql_query("select * from care_tz_drugs_reordering_level where item_id=$id");
   $num = mysql_num_rows($resi);
   if($num==0)
   {
   $rowi = mysql_fetch_object($resi);
   $level = $rowi->reordering_level;
   $resu = mysql_query("select sum(current_qty) as av from care_tz_stock_in_hand where item_id=$id") or die(mysql_error());
   $rowu = mysql_fetch_object($resu);
   $available = $rowu->av;
   if($available=="")
   {
   $available="not available";
   }
   if($id==$_GET['id'] || $id==$_POST['id'] )
   {
    $color = "yellow";
   }
    echo "
	   <tr bgcolor='".$color."'><td>".$n."</td><td>".$name."</td><td>".$available."</td><td><a href='index.php?goto=reorder&id=$id&string=$string&page=".$this->pageNum."&view=$choice''>select</a></td></tr>";
	   }
   }
   elseif($choice=="all")
   {
   $resi = mysql_query("select * from care_tz_drugs_reordering_level where item_id=$id");
   $num = mysql_num_rows($resi);
   if($num!=0)
   {
   $rowi = mysql_fetch_object($resi);
   $level = $rowi->reordering_level;
   $resu = mysql_query("select sum(current_qty) as av from care_tz_stock_in_hand where item_id=$id") or die(mysql_error());
   $rowu = mysql_fetch_object($resu);
   $available = $rowu->av;
   if($available=="")
   {
   $available="not available";
   }
   if($id==$_GET['id'] || $id==$_POST['id'] )
   {
    $color = "yellow";
   }
   echo "
	   <tr bgcolor='".$color."'><td>".$n."</td><td>".$name."</td><td>".$available."</td><td>".$level."</td><td><a href='index.php?goto=reorder&id=$id&string=$string&page=".$this->pageNum."&view=$choice&store=store'>view</a></td><td><a href='index.php?goto=reorder&id=$id&string=$string&page=".$this->pageNum."&view=$choice'>edit</a></td></tr>";
   }
   }
   elseif($choice=="below")
   {
    $resi = mysql_query("select * from care_tz_drugs_reordering_level where item_id=$id");
   $num = mysql_num_rows($resi);
   if($num!=0)
   {
   $rowi = mysql_fetch_object($resi);
   $level = $rowi->reordering_level;
   $resu = mysql_query("select sum(current_qty) as av from care_tz_stock_in_hand where item_id=$id") or die(mysql_error());
   $rowu = mysql_fetch_object($resu);
   $available = $rowu->av;
   if($available=="")
   {
   $available="not available";
   }
   if($id==$_GET['id'] || $id==$_POST['id'] )
   {
    $color = "yellow";
   }
   echo "
	   <tr bgcolor='".$color."'><td>".$n."</td><td>".$name."</td><td>".$available."</td><td>".$level."</td><td><a href='index.php?goto=reorder&id=$id&string=$string&page=".$this->pageNum."&view=$choice'>edit</a></td></tr>";
   }
   }

  }
 function checklevel($id)
   {
   $resi = mysql_query("select * from care_tz_drugs_reordering_level where item_id=$id");
   $num = mysql_num_rows($resi);
   $rowi = mysql_fetch_object($resi);
   $level = $rowi->reordering_level;
   $resu = mysql_query("select sum(current_qty) as av from care_tz_stock_in_hand where item_id=$id") or die(mysql_error());
   $rowu = mysql_fetch_object($resu);
   $available = $rowu->av;
   }
   function get_level($id)
   {
    $res = mysql_query("select reordering_level from care_tz_drugs_reordering_level where item_id = $id");
	$ro = mysql_fetch_object($res);
	return $ro->reordering_level;
   }
}


?>

