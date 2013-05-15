<?php
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

$sql='SELECT nr, name FROM care_ward';
$result=$db->Execute($sql);
echo '<select>';
while ($ward=$result->FetchRow()) {
	echo '<option value='.$ward['nr'].'>'.$ward['name'].'</option>';
}
echo '</select>';

if($tracker>1)
{
   $requests->Move($tracker-2);
   $test_request=$requests->FetchRow();
   $requests->MoveFirst();

?>
<select name=urgency>
<option value=0>Normal</option>
<option value=3>Priority</option>
<option value=5>Urgent</option>
<option value=7>Emergency</option>
</select>
<a href="<?php echo $thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker-1); ?>"><img <?php echo createComIcon($root_path,'uparrowgrnlrg.gif','0','left',TRUE) ?> alt="<?php echo $LDPrevRequest ?>"></a>
<?php
}
if($tracker<$batchrows)
{
   $requests->Move($tracker);
   $test_request=$requests->FetchRow();
?>
<a href="<?php echo $thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".($tracker+1); ?>"><img <?php echo createComIcon($root_path,'dwnarrowgrnlrg.gif','0','right',TRUE) ?>  alt="<?php echo $LDNextRequest ?>"></a>
<?php
}

$tracker=1;
echo "<br><br>";

$send_date="";

/* Display the list of pending requests */
$requests->MoveFirst();
while($test_request=$requests->FetchRow())
{
  //echo $tracker."<br>";
  list($buf_date,$x)=explode(" ",$test_request['send_date']);
  if($buf_date!=$send_date)
  {
     echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($buf_date,$date_format)."</b></font><br>";
	 $send_date=$buf_date;
  }
  if($batch_nr!=$test_request['batch_nr'])
  {
        echo "<img src=\"".$root_path."gui/img/common/default/pixel.gif\" border=0 width=4 height=7>
        <a onmouseover=\"showBallon('".$test_request['name_first']." ".$test_request['name_last']." encounter: ".$test_request['encounter_nr']." Hospital file nr: ".$test_request['selian_pid']."',0,150,'#99ccff'); window.status='Care2x Tooltip'; return true;\"
	onmouseout=\"hideBallon(); return true;\" href=\"".$thisfile.URL_APPEND."&target=".$target."&subtarget=".$subtarget."&pn=".$test_request['encounter_nr']."&batch_nr=".$test_request['batch_nr']."&user_origin=".$user_origin."&tracker=".$tracker."\">";
			if($test_request['batch_nr'])
			{
				if(IS_TANZANIAN)
				{
					//echo $enc_obj->showPID($test_request['selian_pid']);
				//}
				//else
				//{
					if ($test_request['priority']==0) {
						echo '<font size=1 color="green">';						
					}
					if ($test_request['priority']==3) {
						echo '<font size=1 color="blue">';						
					}
					if ($test_request['priority']==5) {
						echo '<font size=1 color="orange">';						
					}
					if ($test_request['priority']==7) {
						echo '<font size=1 color="red">';						
					}
					echo $test_request['selian_pid'].'/'.$test_request['name_first']." ".$test_request['name_last'];
					echo '</font>';
				}
			}
	echo " ".$test_request['room_nr']."</a><br>";
   }
   else
   {
        echo "<img ".createComIcon($root_path,'redpfeil.gif','0','',TRUE)."> <FONT size=1 color=\"red\">";
			if($test_request['batch_nr'])
			{
				if(IS_TANZANIAN)
				{
				//	echo $enc_obj->showPID($test_request['selian_pid']);
				//}
				//else
				//{
					echo $test_request['selian_pid'];
				}
			}
	echo " ".$test_request['room_nr']."</font><br>";
        $track_item=$tracker;
   }

   /* Check for the barcode png image, if nonexistent create it in the cache */
   if(!file_exists($root_path."cache/barcodes/en_".$test_request['encounter_nr'].".png"))
   {
	  echo "<img src='".$root_path."classes/barcode/image.php?code=".$test_request['encounter_nr']."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
	}

  $tracker++;
}
/* Reset tracker to the actual request being shown */
$tracker=$track_item;
?>
