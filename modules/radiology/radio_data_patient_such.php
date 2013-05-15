<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';

define('LANG_FILE','radio.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$mode = $_GET['mode'];

$thisfile=basename(__FILE__).URL_APPEND.'lang='.$lang.'sid='.$sid.'&mode='.$mode;
$breakfile='radiolog.php';

/*
# Workaround
if(!isset($mode)){
	$mode='';

}
*/

$mode= $_REQUEST['mode'] ;	

//$db->debug=1;

$keyword=trim($keyword);
$toggle=0;

echo $mode;
 
# Initialize page´s control variables
if($mode=='paginate'){
	$keyword=$HTTP_SESSION_VARS['sess_searchkey'];
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='DESC';
	$oitem='send_date';

	# Workaround: Resolve the search key variables
	if(empty($keyword)&&!empty($searchkey)) $keyword=$searchkey;
		
	if(is_numeric($keyword)){
		$keyword=(int) $keyword;
	}else{
		# Convert other wildcards
		$keyword=strtr($keyword,'*&','%_');
	}
}

if($search&&!empty($keyword)){

	# Load the date formatter 
	include_once($root_path.'include/inc_date_format_functions.php');
    
	include_once($root_path.'include/care_api_classes/class_lab.php');
	include_once($root_path.'include/care_api_classes/class_radio.php');
	
	$lab_obj=new Radio();
	
	#Load and create paginator object
	include_once($root_path.'include/care_api_classes/class_paginator.php');
	$pagen=& new Paginator($pgx,$thisfile,$HTTP_SESSION_VARS['sess_searchkey'],$root_path);

	$GLOBAL_CONFIG=array();
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);	
	# Get the max nr of rows from global config
	$glob_obj->getConfig('pagin_patient_search_max_block_rows');
	if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
		else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);

	$encounter=&$lab_obj->searchPatientWithPendingRadResults($keyword,$pagen->MaxCount(),$pgx,$oitem,$odir); 
	//echo $lab_obj->getLastQuery()."<p>";
	# Get the resulting record count
	if($linecount=$lab_obj->LastRecordCount()){
	
		if($mode!='paginate') $HTTP_SESSION_VARS['sess_searchkey']=$keyword;

		$pagen->setTotalBlockCount($linecount);
		# Count total available data
		if(isset($totalcount)&&$totalcount){
			$pagen->setTotalDataCount($totalcount);
		}else{
			if($editmode){
				@$lab_obj->searchEncounterRadiologyInfo($keyword);
			}else{
				@$lab_obj->searchEncounterRadResults($keyword);
			}
			$totalcount=$lab_obj->LastRecordCount(); 
			$pagen->setTotalDataCount($totalcount);
		}
		$pagen->setSortItem($oitem);
		$pagen->setSortDirection($odir);
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?>

<script language="JavaScript">
<!-- Script Begin
function checkForm(v) {
	if((v.value=="")||(v.value==" ")){
		v.value="";
		v.focus();
		return false;
	}else{
		return true;
	}
}
//  Script End -->
</script>
</HEAD>

<BODY onLoad="document.sform.keyword.select()">

<img <?php echo createComIcon($root_path,'sthorax.png','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>" SIZE=5> <b><?php echo "$LDRadData - "; $mode = $_REQUEST['mode']; if($mode=='done') echo "$LDNewData"; else echo "$LDEditRadData"; ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'such-b.gif') ?>></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>&nbsp;

</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td valign=top><p><br>
<ul>

<!-- This is the search entry mask -->



<FORM action="<?php echo $thisfile; ?>" method="post" name="sform" onSubmit="return checkForm(sform.keyword)">

<B><?php echo $LDSearchWordPrompt ?></B></font><p>
<font size=3>
<INPUT type="text" name="keyword" size="20" maxlength="40" value="<?php echo $keyword ?>"></font>
<input type=hidden name="search" value=1>
<input type=hidden name="sid" value=<?php echo $sid ?>>
<input type=hidden name="lang" value=<?php echo $lang ?>>
<input type=hidden name="editmode" value=<?php echo $editmode ?>>
<INPUT type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:gethelp('search_patient.php','Laboratories :: Search Patient','<?php echo $mode ?>','<?php echo $linecount ?>','<?php echo $datafound ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>></a>
</FORM>
<p>
<?php 

$prev_nr=0;

# Print the search result message 
if($search||$mode=='paginate'){
	if ($linecount) echo str_replace('~nr~',$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
	else echo str_replace('~nr~','0',$LDSearchFound);
}

if($linecount){

	$dcount=0;

	$append="&search=1&editmode=$editmode&mode=$mode";

	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

	# Create the column descriptors 
?>	
	<table border=0 cellpadding=3 cellspacing=1> 
	<tr class="wardlisttitlerow">

     <td><b>
	  <?php echo $pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDBatchNumber,'batch_nr',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDSelianFileNr,'selian_pid',$oitem,$odir,$append);  ?></b></td>
	  
      <td ><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
	  <td><b>
	  <?php echo $pagen->makeSortLink($LDDateOfTestRequest,'send_date',$oitem,$odir,$append);  ?></b></td>
    	<td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font face=arial size=2 color="#ffffff"><b><?php echo $LDSelect; ?></td>
	</tr>

<?php
/*	for($i=0;$i<sizeof($LDfieldname);$i++) {
		echo"<td><font face=arial size=2 color=#ffffff><b>".$LDfieldname[$i]."</b></td>";
	}
*/

           
	# List all the stored lab result documents of the patient 
	
	while($zeile=$encounter->FetchRow()){

		//if($zeile['encounter_nr']!=$prev_nr){

			//$prev_nr=$zeile['encounter_nr'];
			//$dcount++;

			echo '
			<tr class=';
			if($toggle) { echo 'wardlistrow2>';} else {echo 'wardlistrow1>';}
			$toggle=!$toggle;
			echo '<td>';
			echo '&nbsp;'.$zeile['encounter_nr'];
			if($zeile['encounter_class_nr']==2) echo ' <img '.createComIcon($root_path,'redflag.gif','0','',TRUE).'> <font size=1 color="red">'.$LDAmbulant.'</font>';
			
        	echo '</td>';

        	echo '<td>';
        	echo '&nbsp;'.$zeile['batch_nr'];
        	echo '</td>';
        	
        	echo '<td>';
        	echo '&nbsp;'.$zeile['selian_pid'];
        	echo '</td>';
			
						echo '<td>';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}
			
			echo '</td><td>';
			echo '&nbsp;'.ucfirst($zeile['name_last']);
			echo '</td>
					<td>';
			echo '&nbsp;'.ucfirst($zeile['name_first']);
			echo '</td>
					<td>';
			echo '&nbsp;'.formatDate2Local($zeile['date_birth'],$date_format);
			echo '</td>';	
						
					echo '</td>
					<td>';
			echo '&nbsp;'.formatDate2Local($zeile['send_date'],$date_format);
			echo '</td>';	
			#  if mode is edit, create the button linked to labor_data_check_arch.php 
			#  if mode is not edit, create button linked to labor_datalist_noedit.php (read only list)

			echo'
				<td>&nbsp';
						
			if($mode=='done'){

				echo'
                                        <a href=\''.$root_path.'modules/laboratory/labor_test_findings_radio.php'.URL_APPEND.'&pn='.$zeile['encounter_nr'].'&batch_nr='.$zeile['batch_nr'].'&subtarget=radio&user_origin=rad&mode=done&nostat=1\ title="'.$LDClk2See.'">

                                        <button onClick="javascript:window.location.href=\''.$root_path.'modules/laboratory/labor_test_findings_radio'.URL_REDIRECT_APPEND.'&pn='.$zeile['encounter_nr'].'&batch_nr='.$zeile['batch_nr'].'&user_origin=rad&subtarget=radio&mode=done&nostat=1 \'"><img '.createComIcon($root_path,'update2.gif','0','absmiddle',FALSE).' alt="'.$LDClk2See.'"><font size=1> '.$LDRadReport;


			}else{
				echo'
					<a href=\''.$root_path.'modules/laboratory/labor_test_findings_radio.php'.URL_APPEND.'&pn='.$zeile['encounter_nr'].'&batch_nr='.$zeile['batch_nr'].'&subtarget=radio&user_origin=rad&edit=1&nostat=1\ title="'.$LDClk2See.'">
					
					<button onClick="javascript:window.location.href=\''.$root_path.'modules/laboratory/labor_test_findings_radio'.URL_REDIRECT_APPEND.'&pn='.$zeile['encounter_nr'].'&batch_nr='.$zeile['batch_nr'].'&user_origin=rad&subtarget=radio&edit=1&&nostat=1 \'"><img '.createComIcon($root_path,'update2.gif','0','absmiddle',FALSE).' alt="'.$LDClk2See.'"><font size=1> '.$LDEditRadReport;

				/*
				echo'
					<a href="labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$zeile['encounter_nr'].'&noexpand=1&nostat=1&user_origin=lab"  title="'.$LDClk2See.'">
					<button onClick="javascript:window.location.href=\'labor_datalist_noedit.php'.URL_REDIRECT_APPEND.'&encounter_nr='.$zeile['encounter_nr'].'&noexpand=1&nostat=1&user_origin=lab\'"><img '.createComIcon($root_path,'update2.gif','0','absmiddle',FALSE).' alt="'.$LDClk2See.'"><font size=1> '.$LDLabReport;
			   */
			}
						
			echo '</font></button></a>&nbsp;
				</td></tr>';

		//}
	}
	if($totalcount>$pagen->MaxCount()){
		echo '
			<tr><td colspan=5>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext,$append).'</td>
			</tr>';
	}
	echo '</table>';
					
	# If result is more than 15 items, create an additional search entry mask below the list
	if($dcount>$pagen->MaxCount()){
		echo '
				<p><font color=red><B>'.$LDNewSearch.':</font>
				<FORM action="'.$thisfile.'" method="post" name="form2" onSubmit="return checkForm(form2.keyword)">
				'.$LDSearchWordPrompt.'</B><p>
				<INPUT type="text" name="keyword" size="20" maxlength="40" value="'.$keyword.'"> 
				<input type=hidden name="search" value=1>
				<input type=hidden name="sid" value="'.$sid.'">
				<input type=hidden name="lang" value="'.$lang.'">
				<input type=hidden name="editmode" value="'.$editmode.'">
				<INPUT type="image"  '.createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle').'></FORM>
				<p>';
	}
}

?>
<p>
<br>&nbsp;
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>

<p>

</ul>
&nbsp;
</FONT>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>

</table>        
<p>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
