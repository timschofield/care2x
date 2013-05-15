<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');

require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2005 Robert Meggle based on the development of Elpidio Latorilla (2002,2003,2004,2005)
* elpidio@care2x.org, meggle@merotech.de
*
* See the file "copy_notice.txt" for the licence notice
*/

//define('NO_2LEVEL_CHK',1);
require($root_path.'include/inc_front_chain_lang.php');

$debug = TRUE;

  	if ($_POST['evaluate']) {

  		//$arr_stock[][];

  		$i=0;
  		echo move_uploaded_file($_FILES['import_file']['tmp_name'], "./newfile.txt");
		$handle = fopen("./newfile.txt", "r");
		while (!feof($handle)) {
		    $buffer = fgets($handle, 4096);
			$arr_stock[$i]=$buffer;
			$i++;
		}
		fclose($handle);


  	}




require ("gui/gui_setup_import_purchase_list.php");

?>