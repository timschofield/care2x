<?php
$debug = FALSE;


require_once($root_path."include/inc_img_fx.php");
require_once($root_path.'include/inc_date_format_functions.php');
/**
*  A help function to either create input elements for lab's intern entries or
*  to show the entries in case of status != pending
*  Used in pathology
*/
function printLabInterns($param)
{
   global $stored_request, $date_format;

		   if($stored_request['status']=="pending")
		   {
	           echo '
	                   <input type="text" name="'.$param.'" size=10 maxlength=10 value="';

			   if($stored_request[$param]) echo $stored_request[$param];

			   echo '">&nbsp;';
		    }
			else
			{
			   echo '<font face="verdana" size=2 color="#000000">'.$stored_request[$param].'</font>';
			}

}

function printCheckBox($param,$printout=true)
{
   	global $stored_request, $root_path;

    if($stored_request[$param]==1) $buffer= '<img '.createComIcon($root_path,'chkbox_chk.gif','0','absmiddle',TRUE).'>';
	  else $buffer= '<img '.createComIcon($root_path,'chkbox_blk.gif','0','absmiddle',TRUE).'>';
	if($printout) echo $buffer;
		else return $buffer;

}

function printRadioButton($param,$value,$printout=true)
{
   	global $stored_request, $root_path;

    if($value )
	{
	   if($stored_request[$param]) $buffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle',TRUE).'>';
	   else $buffer='';
	}
	  elseif(!$stored_request[$param]) $buffer= '<img '.createComIcon($root_path,'radio_chk.gif','0','absmiddle',TRUE).'>';
	    else $buffer='';

	if(empty($buffer)) $buffer= '<img '.createComIcon($root_path,'radio_blk.gif','0','absmiddle',TRUE).'>';

	if($printout) echo $buffer;
		else return $buffer;

}

/* The following routine creates the list of pending requests */

if(!isset($tracker)||!$tracker) $tracker=1;


$tracker=1;
echo "<br><br>";

$send_date="";

/* Display the list of pending requests */
$requests->MoveFirst();
if ($debug) echo "back path is:".$back_path."<br>";
while($test_request=$requests->FetchRow())
{
  if ($debug) echo $tracker."<br>";
  list($buf_date,$x)=explode(" ",$test_request['prescribe_date']);
  if($buf_date!=$send_date)
  {
     echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($buf_date,$date_format)."</b></font><br>";
	 $send_date=$buf_date;
  }
  if ($debug) echo "Batch_nr=".$batch_nr." -- test_request['batch_nr']=".$test_request['batch_nr']."<br>";
  if ($debug) echo "prescription_date=".$prescription_date." -- test_request['prescribe_date'=".$test_request['prescribe_date']."<br>";
  if ($debug) echo "Patient number:".$pn."<br>";
  if($batch_nr!=$test_request['batch_nr'] || $prescription_date != $test_request['prescribe_date'] )
  {
        echo "<img src=\"".$root_path."gui/img/common/default/pixel.gif\" border=0 width=4 height=7>
        <a onmouseover=\"showBallon('".$test_request['name_first']." ".$test_request['name_last']." encounter: ".$test_request['encounter_nr']." Hospital file nr: ".$test_request['selian_pid']."',0,150,'#99ccff'); window.status='Care2x Tooltip'; return true;\"
	onmouseout=\"hideBallon(); return true;\" href=\"".$thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&batch_nr=".$test_request['batch_nr']."&prescription_date=".$test_request['prescribe_date']."&pn=".$test_request['encounter_nr']."&user_origin=".$user_origin."&tracker=".$tracker."&back_path=".$back_path."\">";

			if($test_request['batch_nr'])
			{
					//echo $test_request['selian_pid'].'/'.$test_request['name_first']." ".$test_request['name_last'];
					echo $test_request['selian_pid'];
			}
	    echo " ".$test_request['room_nr']."/".$test_request['name_first']." ".$test_request['name_last']."</a><br>";
   }
   else
   {
        echo "<img ".createComIcon($root_path,'redpfeil.gif','0','',TRUE)."> <FONT size=1 color=\"red\">";
			if($test_request['batch_nr'])
			{
					echo $test_request['selian_pid'];
			}
	echo " ".$test_request['room_nr']."</font><br>";
        $track_item=$tracker;
   }


  $tracker++;
}
/* Reset tracker to the actual request being shown */
$tracker=$track_item;
?>