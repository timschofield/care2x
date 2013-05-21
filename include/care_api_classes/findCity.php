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
mysql_select_db('test');
$query="SELECT distinct(parish) as parish from districts WHERE lower(subcounty) = '".strtolower($subcounty)."'";
echo $query;
$result=mysql_query($query);

?>
<select name="subcounty">
<option>Select City</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value><?=$row['parish']?></option>
<? } ?>
</select>
