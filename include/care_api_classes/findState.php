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

<? $district=$_GET['district'];
$link = mysql_connect('localhost', 'root', 'root'); //changet the configuration in required
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('test');
$query="SELECT distinct(subcounty) as subcounty from districts where lower(name) = '".strtolower($district)."'";
echo $query;
$result=mysql_query($query);

?>
<select name="subcounty" onchange="getCity(this.value)">
<option>Select SubCounty</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['subcounty']?>><?=$row['subcounty']?></option>
<? } ?>
</select>
