<?php

define('ROW_MAX',15); # define here the maximum number of rows for displaying the parameters

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
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename($_SERVER['PHP_SELF']);

//$db->debug=true;
require_once($root_path.'include/care_api_classes/class_advanced_search.php');


# Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');
//window.opener.location.reload();

$search_obj = & new advanced_search();
if(!$chosentype) $chosentype='tribe';
if($chosentype=='tribe')
{
	if (is_array($result_array=$search_obj->get_equal_words("tribe_name", "care_tz_tribes", false, 65, 'tribe_id'))) 
	{
		true;
	}
}
elseif($chosentype=='city')
{
	if (is_array($result_array=$search_obj->get_equal_words("name", "care_address_citytown", false, 65, 'nr'))) 
	{
		true;
	}
}
else
{
	if (is_array($result_array=$search_obj->get_equal_words("name", "care_tz_religion", false, 65, 'nr'))) 
	{
		true;
	}
}


if($todo=="updatedata")
{
	if($savemode=="newitem")
	{
		if($newitem && $code && $accepted && $accepted2)
		{

			if($chosentype=='tribe')
			{
				$dropdownvalue=$search_obj->insert_new_tribe($newitem, $code);
			}
			elseif($chosentype=='city')
			{
				$dropdownvalue=$search_obj->insert_new_city($newitem, $code);
			}
			else
			{
				$dropdownvalue=$search_obj->insert_new_religion($newitem, $code);
			}
		}
		else $error++;
	}
	else
	{
		$dropdownvalue=$item;
	}
	if($chosentype=='tribe')
	{
		$tribe_info = $search_obj->get_tribe_info($dropdownvalue);
		$dropdowntext = $tribe_info['tribe_name'];
	}
	elseif($chosentype=='city')
	{
		$region_info = $search_obj->get_citytown_info($dropdownvalue);
		$dropdowntext = $region_info['name'];
	}
	else
	{
		$religion_info = $search_obj->get_religion_info($dropdownvalue);
		$dropdowntext = $religion_info['name'];
		echo $dropdownvalue.'ttttttt';
	}
}
?>



<script language="JavaScript">
<!-- Script Begin
<?php
if($dropdowntext)
{
	if($chosentype=='tribe')
		$element = 'name_maiden';
	elseif($chosentype=='city')
		$element = 'addr_citytown_nr';
	else
		$element = 'religion';
	echo '
	var l = window.opener.document.forms["aufnahmeform"].elements["'.$element.'"].options.length;
	
	window.opener.document.forms["aufnahmeform"].elements["'.$element.'"].options[l-1].text = \''.$dropdowntext.'\'
	window.opener.document.forms["aufnahmeform"].elements["'.$element.'"].options[l-1].value = \''.$dropdownvalue.'\'
	window.close();
	';
}

?>
function toggleenabled(mode)
{
	if(mode==1)
	{
		document.newitem.item.disabled = false;
		document.newitem.newitem.disabled = true;
		document.newitem.code.disabled = true;
		document.newitem.accepted.disabled = true;
		document.newitem.accepted2.disabled = true;
	}
	else
	{
		document.newitem.item.disabled = true;
		document.newitem.newitem.disabled = false;
		document.newitem.code.disabled = false;
		document.newitem.accepted.disabled = false;
		document.newitem.accepted2.disabled = false;
	}
}
//  Script End -->
</script>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>New Item</TITLE>


<?php 
require($root_path.'include/inc_js_gethelp.php'); 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a12_b{font-family:arial; font-size:12; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php

 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td width="50%" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> 
&nbsp;Insert new item
 </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_param_edit.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr></td>
</tr>
<tr align="center">
<td  bgcolor=#dde1ec colspan=2>

<FONT    SIZE=-1  FACE="Arial">


<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1 width="100%">
<tr>
<td  bgcolor=#ff0000 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">

</td>
</tr>
<tr>
<td  colspan=2>

<form action="<?php echo $thisfile; ?>" method="post" name="newitem">

<table border="0" cellpadding=2 cellspacing=1 width="100%">
<tr>
	<td colspan="2">Please select the the desired item from the list below. If it is not
	listed there select "Insert a new item" and enter its name into the text box. Please check
	for correct spelling first and hit "Save" to go back to the patient form.</td>
</tr>	
<?php 

		echo '
		<tr>
			<td  class="a12_b" bgcolor="#efefef" width="50%">
				<input type="radio" checked name="savemode" value="listitem" onClick="toggleenabled(1);">&nbsp;Select an item below</td>
			<td width="50%" bgcolor="#efefef"  class="a12_b">
				<input type="radio" name="savemode" value="newitem" onClick="toggleenabled(0);">&nbsp;Insert a new item
			</td>
		</tr>
		<tr>
			<td  class="a12_b" bgcolor="#fefefe" width="50%">';

				echo '<SELECT name="item" size=17  style="width:231px;">';
				$check="selected";
				foreach($result_array as $unit)
				{
					
					echo '<OPTION value="'.$unit[1].'" '.$check.'>'.$unit[0].'</OPTION>';
					$check="";
				}
			 echo '</SELECT>';
			 echo'
				
				</td>
			<td width="50%" bgcolor="#fefefe"  class="a12_b" valign="top">
				Enter the new item name here:
				<input type="text" name="newitem" size=30 disabled maxlength="32"><br><br>
				Enter a valid item code:
				<input type="text" name="code" size=30 disabled maxlength="32"><br><br>
				Please check again for correct spelling and  confirm that you really want to add a new item permanently to the database.<br>
				<input type="checkbox" name="accepted" disabled> Yes, I know what I\'m doing.<br>
				<input type="checkbox" name="accepted2" disabled> Yes, it is written correctly.<br>
				<input type="hidden" name="todo" value="updatedata">
			</td>
		</tr>
			';
?>
</table>
<input type=hidden name="parameterselect" value="<?php echo $parameterselect; ?>">
<input type=hidden name="nr" value="<?php echo $nr; ?>">
<input type=hidden name="id" value="<?php echo $tp['id']; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<input type=hidden name="mode" value="save">
<input type=hidden name="chosentype" value="<?php echo $chosentype; ?>">
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>> 

</td>
</tr>

</table>

</form>

</FONT>
<p>
</td>

</tr>
</table>        

</BODY>
</HTML>
