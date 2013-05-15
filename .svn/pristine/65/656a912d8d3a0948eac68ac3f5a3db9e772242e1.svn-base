
<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/care_api_classes/supplier_database_class.php');
require($root_path.'include/care_api_classes/class_adding_stock.php');

$store = new addstore();
if(isset($_POST['store']))
  {
   
   $location = $_POST['locationid'];
   $storename = $_POST['storename'];
   $storetype = $_POST['type'];
   $store->insertstore( $storetype,$storename,$location);
   $warn1=$store->locationid;
   $warn2=$store->storetype;
   $warn3 = $store->storename;
   $msg = $store->msg;
   if($msg=="<font color='red'>Store added</font>")
    {
	  $storename = "";
	}
  }
elseif(isset($_POST['location']))
  {
   $locname = $_POST['locationname'];
   $location = $_POST['locationid'];
   $storename = $_POST['storename'];
   $storetype = $_POST['type'];
   $store->insertlocation($locname);
   $warm4 = $store->locationname;
   $msg2= $store->msg2;
   
  }



?>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>

<form action="index.php?goto=addstore" method="post" name="addstock">
<fieldset><legend>Add store</legend>
<table width="412" border="0" align="center" summary="Fill this for to add store">
<caption>
<span class="style1">Fill this form to add store</span><br>
<p align="center"><?php echo $msg; ?></p>

</caption>
  <tr>
    <td>Store type </td>
    <td><label>
      <select name="type" id="type"><option value="">---Pick type---</option>
	  <?php $types = array("Pharmacy","Repository store");
	        for($n=0; $n<2; $n++)
			{
			 if($types[$n]==$storetype)
			    $select = "selected='selected'";
			 else  $select = "";
			 echo "<option value='".$types[$n]."' ".$select.">".$types[$n]."</option>";
        
			}
	         
	   ?>
        
      </select>
      <?php echo $warn2; ?></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Store Location </td>
    <td><?php $result=$store->get_all_locations(); 
	          
	?><select name="locationid" id="locationid">
	<option value="">---pick location---</option>
	<?php while($rows=mysql_fetch_object($result))
	{
	  $locid = $rows->id;
	  $locname = $rows->Name;
	  if($locid==$location)
	   echo  "
	  <option value='".$locid."' selected='selected'>".$locname."</option>";
	  else
	  echo "
	  <option value='".$locid."'>".$locname."</option>";
	} ?>
	
        </select>
      <?php echo $warn1; ?> 
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Store Name </td>
    <td><input name="storename" type="text" id="storename" value="<?php echo $storename; ?>">
      <?php echo $warn3; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input name="cancel" type="reset" id="cancel" value="Cancel">
    </label>
      <label>
      <input name="store" type="submit" id="store" value="Submit">
      </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</fieldset>

<p>
<br/></p>
<p>
<br/>
</p>

<fieldset><legend>Add location</legend>
<table align="center">
<caption><strong>Fill this form to add location </strong><br />
<p align="center"><?php echo $msg2; ?></p></caption>
<tr><td>location Name</td><td><input name="locationname" type="text" value="<?php $locname; ?>" /><?php echo $warn4; ?></td><td></td></tr>
<tr><td>
  <div align="right">
    <input type="reset" name="Submit2" value="Reset" />
  </div>
</td>
  <td><input name="location" type="submit" id="location" value="Submit" /></td>
  <td></td></tr>
</table>


</fieldset>
</form>