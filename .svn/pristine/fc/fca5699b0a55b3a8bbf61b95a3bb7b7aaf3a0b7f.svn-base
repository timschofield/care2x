
<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/care_api_classes/supplier_database_class.php');
require($root_path.'include/care_api_classes/class_reordering_level.php');
if(isset($_GET['view']))
{
$choice = $_GET['view'];
if($choice=="")
 {
 $choice = "set";
 }
}
else
{
 $choice ="set";

}
$reorder = new reordering();
if(isset($_GET['id']))
{
 $item_id = $_GET['id'];
  $check = true;
}
else
{
$check = false;
}
if(isset($_POST['st']))
{
 $string=$_POST['st'];
 $choice = $_GET['view'];

}
else
  {
   $string = $_GET['string'];
    
  }
?>
<p align="center"><form name="search" action="index.php?goto=reorder&view=<?php echo $choice;?>" method="post"><table align="center"><tr><td>Search :</td><td><input type="text" value="<?php echo $string; ?>" name="st" /></td><td><input type="submit" value="Search" /></td></tr></table></form></p>
<?php
if(isset($_POST['level']))
 {
 $level = $_POST['level'];
 $item_id = $_POST['id'];
  $reorder->insert($item_id,$level);
  $check=true;
 }

if($check)
 {
 $reorder->get_medicine($item_id);
 $id=  $reorder->id;
 $name=  $reorder->name;
 $page= $reorder->pageNum;
 if($choice=="all")
 {
  $level=$reorder->get_level($id);
  }
 ?>
 <p align="center"><form name="insert" action="index.php?goto=reorder&page=<?php echo $_GET['page'];?>&string=<?php echo $_GET['string'];?>&view=<?php echo $_GET['view'];?>" method="post"><table align="center"><tr><td>Medicine:</td><td><label><?php echo $name; ?></label></td>
 </tr><tr><td>Re-ordering level:</td><td><input type="text" value="<?php echo $level; ?>" name="level" /><?php echo "<font color='red'>  ".$reorder->msg."<font>"; ?></td></tr>
 <tr><td align="right"><input type="hidden" name="id" value="<?php echo $id; ?>" /><input type="reset" value="reset" /></td><td><input type="submit" value="Submit" /></td></tr></table></form></p>
 <?
 }
$reorder->display($string,10,$choice);
 
 
?>
