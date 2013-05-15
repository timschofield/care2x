<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

    $debug=FALSE;
    ($debug) ? $db->debug=TRUE : $db->debug=FALSE;
    $sql = "SELECT *  FROM care_encounter limit 0,100";

    $request = $db->Execute($sql);
	$res_arr = $request->GetArray();
   	//header('Content-Type: text/xml');
   	$myWDDX =  wddx_serialize_vars("res_arr");
   	//echo $myWDDX;
	//print_r($res_arr);
	$filename = './xml/all_encounter.xml';

	if (is_writable($filename)) {

	    if (!$handle = fopen($filename, "w")) {
	         print "cannot open $filename ";
	         exit;
	    }
	    if (!fwrite($handle, $myWDDX)) {
	        print "cannot write tp $filename ...";
	        exit;
	    }

	    fclose($handle);

	} else {
	    print "oopps,  $filename is not writable";
	}
	print "done";
?>
