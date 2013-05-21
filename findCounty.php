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
require('./roots.php');
global $db;
$county=$_GET['county'];
$query="SELECT id,county from care_ug_county WHERE district_id = ".$county;

?>
    <select name="county" size="1" id="county" onchange="getSubCounty(this.value)">
         <?php
           if (isset($_POST['county'])) {
          ?>
          <option value="<?php echo $_POST['county'];?>" ><?php echo $_POST['county'];?></option>
          <?php
           } else  { ?>
            <option value="-1" >---select County--------</option>
          <?
         // lets get all the districts
          // $sql = "SELECT id,district_name ";
          $result = $db->Execute($query);
          while($county = $result->Fetchrow()) {
          ?>
           <option value="<?php echo $county['id'];?>" ><?php echo $county['county'];?></option>

         <?php
         }
        }
      ?>
 </select>

