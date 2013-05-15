<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
//$_SESSION['sess_path_referer']=str_replace($doc_root.'/','',__FILE__);
//echo __FILE__;

header("location:".$root_path."main/login.php?");
exit;
?>
