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
$subcounty=$_GET['subcounty'];
$link = mysql_connect('localhost', 'root', 'root'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('care2xkhl');
$query="SELECT id,subcounty FROM care_ug_subcounty WHERE county_id = ".$subcounty;
// $result=mysql_query($query);

?>
 <select name="subcounty" size="1" id="subcounty" onchange="getParish(this.value)">
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
          $result = mysql_query($query) or die("Failure to connect to database");
          while($subcounty = mysql_fetch_array($result)) {
          ?>
           <option value="<?php echo $subcounty['id'];?>" ><?php echo $subcounty['subcounty'];?></option>

         <?php
         }
        }
      ?>
 </select>

