<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');



require($root_path.'include/care_api_classes/supplier_database_class.php');
global $keyword,$criteria,$number_of_search_results,$result,$message,$mode,$var;
$mode="";
$mode=$_REQUEST['mode'];
$var="createorder";



if (!empty($_POST['keyword'])) {
  // We have work...

  $supplier_obj = new supplier();
  $supplier_obj->setsearch_keyword($_POST['keyword']);
  $supplier_obj->setcriteria($_POST['criteria']);
  $keyword=$supplier_obj->getkeyword();
  $criteria=$supplier_obj->getcriteria();
$supplier_obj->dbconnect();
$supplier_obj->dbselect();
if ($keyword=="*"){
	 //$sql2="select Suplier_id,Company_Name,Contact_Person from care_tz_supplier_deatail ORDER BY Suplier_id DESC";
  $result=$supplier_obj->get_all_suppliers();


}

   else if($keyword && $criteria)
   {
   $result= $supplier_obj->get_criteria_search_results($criteria,$keyword);

  }
  if($result){

  	 $number_of_search_results = $supplier_obj->recordcount($result);
$message="";




  $bg_color_change = 1;

  while ($search_element = $supplier_obj->fetch_object($result)) {

    if ($bg_color_change) {
      $http_buffer.="<tr bgcolor=#ffffaa>";
      $bg_color_change = 0;
    } else {
      $http_buffer.="<tr bgcolor=#ffffdd>";
      $bg_color_change = 1;
    }

    $supplier_id = $search_element->Suplier_id;
    $company_name = $search_element->Company_Name;
    $contactperson= $search_element->Contact_Person;
    $http_buffer.=" <td>".$supplier_id."</td>
                    <td>".$company_name."</td>
                    <td>".$contactperson."</td>




                    <td><div align=\"center\"><a href=\"supplier_informations.php?mode=show&supplier_id=".$supplier_id."\"><img src=\"".$root_path."gui/img/common/default/common_infoicon.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td><div align=\"center\"><a href=\"supplier_informations.php?mode=edit&supplier_id=".$supplier_id."\"><img src=\"".$root_path."gui/img/common/default/hammer.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>
                    <td><div align=\"center\"><a href=\"supplier_informations.php?mode=erase&supplier_id=".$supplier_id."\"><img src=\"".$root_path."gui/img/common/default/delete.gif\" width=\"16\" height=\"16\" border=\"0\"></a></td>";


    $http_buffer.="</tr>";


  }

}else{
$message="Specify a Search Criteria Please";
}

}
require("gui/gui_supplier_search.php");
exit;
?>