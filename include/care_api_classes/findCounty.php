<!--//---------------------------------+
//  Developed by Roshan Bhattarai    |
//	http://roshanbh.com.np           |
//  Contact for custom scripts       |
//  or implementation help.          |
//  email-nepaliboy007@yahoo.com     |
//---------------------------------+-->
<?
#### Roshan's Ajax dropdown code with php
#### Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
#### if you have any problem contact me at http://roshanbh.com.np
#### fell free to visit my blog http://php-ajax-guru.blogspot.com
?>

<<<<<<< HEAD
<? 

$root_path = "../../";
require_once($root_path.'include/inc_environment_global.php');
$baseurl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
global $base_url;

=======
<?
 $root_path="../../";
 require_once($root_path.'include/inc_environment_global.php');
>>>>>>> 77e6c4bafb81b5861a83ac301becf5b7a5f0aa45
$county=$_GET['county'];
$query="SELECT id,county from care_ug_county WHERE district_id = ".$county;

?>
<<<<<<< HEAD
    <select name="county" size="1" id="county" onchange="getSubCounty(this.value,'<?php echo $base_url; ?>')">
=======
    <select name="county" size="1" id="county" onchange="getSubCounty(this.value, '<?php echo $_SERVER['SERVER_NAME']; ?>')">
>>>>>>> 77e6c4bafb81b5861a83ac301becf5b7a5f0aa45
         <?php
           if (isset($_POST['county'])) {
          ?>
          <option value="<?php echo $_POST['county'];?>" ><?php echo $_POST['county'];?></option>
          <?php
           } else  { ?>
            <option value="-1" >---select county--------</option>
          <?
<<<<<<< HEAD
        $result=$db->Execute($query);
	while($county = $result->FetchRow()) {
=======
         // lets get all the districts
          // $sql = "SELECT id,district_name ";

 	  $result=$db->Execute($query);
           // $myrow=$result->FetchRow();

 	  // $result = mysql_query($query) or die("Failure to connect to database");
           while($county = $result->FetchRow()) {
>>>>>>> 77e6c4bafb81b5861a83ac301becf5b7a5f0aa45
          ?>
           <option value="<?php echo $county['id'];?>" ><?php echo $county['county'];?></option>

         <?php
         }
        }
      ?>
 </select>

