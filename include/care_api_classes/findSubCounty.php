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

<?
$root_path = "../../";
require_once($root_path.'include/inc_environment_global.php');
global $base_url;

$subcounty=$_GET['subcounty'];
$query="SELECT id,subcounty FROM care_ug_subcounty WHERE county_id = ".$subcounty;
// $result=mysql_query($query);

?>
 <select name="subcounty" size="1" id="subcounty" onchange="getParish(this.value,'<?php echo $base_url; ?>')">
         <?php
           if (isset($_POST['subcounty'])) {
          ?>
          <option value="<?php echo $_POST['subcounty'];?>" ><?php echo $_POST['subcounty'];?></option>
          <?php
           } else  { ?>
            <option value="-1" >---select subcounty--------</option>
          <?
         // lets get all the districts
          // $sql = "SELECT id,district_name ";
          $result = $db->Execute($query) or die("Failure to connect to database");
          while($subcounty = $result->FetchRow()) {
          ?>
           <option value="<?php echo $subcounty['id'];?>" ><?php echo $subcounty['subcounty'];?></option>

         <?php
         }
        }
      ?>
 </select>

