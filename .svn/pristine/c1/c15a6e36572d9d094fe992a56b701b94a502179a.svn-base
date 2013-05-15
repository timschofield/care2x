<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (preg_match('/inc_products_search_mod.php/i',$_SERVER['PHP_SELF'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

/**
* CARE 2002 Integrated Hospital Information System
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
if($cat=='pharma') $dbtable='care_pharma_products_main';
	else $dbtable='care_med_products_main';
# clean input data
$keyword=addslashes(trim($keyword));
//$db->debug=true;

#this is the search module
if((($mode=='search')||$update)&&($keyword!='')){

	if($update){
				
		$sql="SELECT  * FROM $dbtable WHERE  bestellnum='$keyword'";
        	$ergebnis=$db->Execute($sql);
		$linecount=$ergebnis->RecordCount();
	}else{
		$sql="SELECT * FROM $dbtable WHERE  bestellnum='$keyword'
					OR artikelnum $sql_LIKE '$keyword'
					OR industrynum $sql_LIKE '$keyword'
					OR artikelname $sql_LIKE '$keyword'
					OR generic $sql_LIKE '$keyword'
					OR description $sql_LIKE '$keyword'";
				//print $sql;
        	$ergebnis=$db->Execute($sql);

		if(!$linecount=$ergebnis->RecordCount()){
			$sql="SELECT * FROM $dbtable WHERE  bestellnum $sql_LIKE '$keyword%'
					OR artikelnum $sql_LIKE '$keyword%'
					OR industrynum $sql_LIKE '$keyword%'
					OR artikelname $sql_LIKE '$keyword%'
					OR generic $sql_LIKE '$keyword%'
					OR description $sql_LIKE '$keyword%'";

        		$ergebnis=$db->Execute($sql);
			$linecount=$ergebnis->RecordCount();
		}
	} //end of if $update else
	//if parent is order catalog
	if(($linecount==1)&&$bcat){
		$ttl=$ergebnis->FetchRow();
		$ergebnis->MoveFirst();
		$title_art=$ttl['artikelname'];
	}
// print "from table ".$linecount;
}

?>
