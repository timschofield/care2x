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
#### fell free to visit my blog http://roshanbh.com.np
?>

<?
$root_path = "../../";
require_once($root_path.'include/inc_environment_global.php');
global $base_url;

$village = $_GET['village'];
$query="SELECT id,village FROM care_ug_village WHERE parish_id = ".$village;
// echo $query;
// $result=mysql_query($query);
?>
	<select name="village" size="1" id="village">
         <?php
           if (isset($_POST['village'])) {
          ?>
          <option value="<?php echo $_POST['village'];?>" ><?php echo $_POST['village'];?></option>
          <?php
           } else  { ?>
            <option value="-1" >---select Village--------</option>
          <?
         // lets get all the districts
          // $sql = "SELECT id,district_name ";
          $result = $db->Execute($query) or die("Failure to connect to database");
          while($village =$result->FetchRow()) {
          ?>
           <option value="<?php echo $village['id'];?>" ><?php echo $village['village'];?></option>

         <?php
         }
        }
      ?>
 </select>

