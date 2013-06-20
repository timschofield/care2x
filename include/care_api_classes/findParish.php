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

$parish =$_GET['parish'];
$query="SELECT id,parish FROM care_ug_parish WHERE subcounty_id = ".$parish;
// $result=mysql_query($query);
?>
	<select name="parish" size="1" id="parish" onchange="getVillage(this.value,'<?php echo $base_url; ?>')">
         <?php
           if (isset($_POST['parish'])) {
          ?>
          <option value="<?php echo $_POST['parish'];?>" ><?php echo $_POST['parish'];?></option>
          <?php
           } else  { ?>
            <option value="-1" >---select Parish--------</option>
          <?
         // lets get all the districts
          // $sql = "SELECT id,district_name ";
          $result = $db->Execute($query) or die("Failure to connect to database");
          while($parish = $result->FetchRow()) {
          ?>
           <option value="<?php echo $parish['id'];?>" ><?php echo $parish['parish'];?></option>

         <?php
         }
        }
      ?>
 </select>

