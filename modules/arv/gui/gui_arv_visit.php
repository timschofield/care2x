<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<script language="JavaScript" type="text/JavaScript">
<!--
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
//-->
</script>
<title>ARV visit</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
.mainTable {
	border: 2px ridge black;
	margin-top:15px;
	width:764px;
	margin-left:auto;
	margin-right:auto;
}

.mainTable tr {
	background-color:#F0F5FF;
}

textarea, input{
	font-family: verdana, arial, tahoma,sans-serif;
    font-size: 14px;
    margin-left:10px
}

input[type=submit] {
    font-size:12px;
	background-color:#F0F5FF;
	color:#330066;
	font-weight:bold;
}

.error {
	color: red;
	font-weight: bold;
}

.error2 {
	color: red;
	font-weight: bold;
	text-align: center;
	font-size:18px;
}

.leftTable {
	background-color:#99ccff;
	color: #330066;
	font-weight: bold;
}

.blue {
	color: #330066;
	font-weight: bold;
}

td > table {
	padding-left:0px;
	margin:10px;
	font-size: 9px;
}
-->
</style>
<body>
<table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td bgcolor="#99ccff">&nbsp;&nbsp;<font color="#330066">Patient Record Form</font></td>
  <td bgcolor="#99ccff" align=right><a
   href="javascript:gethelp('arv_visit.php','<?php echo $src; ?>')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a><a
   href="<?php echo $root_path.$breakfile.URL_APPEND.$add_breakfile?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>     </td>
 </tr>
</table>
<?php

	echo $o_arv_visit->get_Error_message('db');
	echo $o_arv_case->displayARVData();
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" name="arv_visit">
<table class="mainTable">
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right">Visit date:</td>
			<td valign="top" align="left"><?php echo $_GET['arv_data']['create_time']; ?></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right">Weight:</td>
			<td valign="top" align="left"><?php echo $messages['weight'] ?><input name="arv_data[weight]" size="4" maxlength="5" type="text" value="<?php echo $_GET['arv_data']['weight']?>"/></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right">AIDS defining events:</td>
			<td valign="top" align="left">
				<input name="select_aidsdef_events" value="select>>" type="submit"/>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td class="leftTable"></td>
			<td><?php echo $o_arv_visit->displaySelectedItems_table($_GET['a_item_no'])?></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">

			<td valign="top" class="leftTable" align="right"><div class="label">Confirmed new TB case:</div></td>
			<td valign="top" align="left">
				<?php
				$elements = array(
						    array('name' => 'yes', 'value' => '1'),
						    array('name' => 'no', 'value' => '2'),
						    array('name' => 'don\'t know',  'value' => '-1')
							);
				foreach ($elements as $element) {
		    		printf('<input type="radio" name="arv_data[test_TB]" value="%s" %s/> %s',
		       		$element['value'],
		        		($_GET['arv_data']['test_TB'] == $element['value']) ? 'checked="checked" ' : '',
		        	$element['name']);
				}
				?>
			</td>
		</tr>
		<tr  height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Cotrimoxazole:</div></td>
			<td valign="top" align="left">
				<?php
				$elements = array(
						    array('name' => 'yes', 'value' => '1'),
						    array('name' => 'no', 'value' => '2'),
						    array('name' => 'don\'t know',  'value' => '-1')
							);
				foreach ($elements as $element) {
		    		printf('<input type="radio" name="arv_data[test_Cotrimoxazole]" value="%s" %s/> %s',
		       		$element['value'],
		        		($_GET['arv_data']['test_Cotrimoxazole'] == $element['value']) ? 'checked="checked" ' : '',
		        	$element['name']);
				}
				?>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">INH:</div></td>
			<td valign="top" align="left">
				<?php
				$elements = array(
						    array('name' => 'yes', 'value' => '1'),
						    array('name' => 'no', 'value' => '2'),
						    array('name' => 'don\'t know',  'value' => '-1')
							);
				foreach ($elements as $element) {
		    		printf('<input type="radio" name="arv_data[test_INH]" value="%s" %s/> %s',
		       		$element['value'],
		        		($_GET['arv_data']['test_INH'] == $element['value']) ? 'checked="checked" ' : '',
		        	$element['name']);
				}
				?>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Difflucan:</div></td>
			<td valign="top" align="left">
				<?php
				$elements = array(
						    array('name' => 'yes', 'value' => '1'),
						    array('name' => 'no', 'value' => '2'),
						    array('name' => 'don\'t know',  'value' => '-1')
							);
				foreach ($elements as $element) {
		    		printf('<input type="radio" name="arv_data[test_Difflucan]" value="%s" %s/> %s',
		       		$element['value'],
		        		($_GET['arv_data']['test_Difflucan'] == $element['value']) ? 'checked="checked" ' : '',
		        	$element['name']);
				}
				?>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Hospitalization, pregnancy, <br> other problems, complications, <br> please mention:</div></td>
			<td valign="top" align="left">
				<textarea maxlength="255" name="arv_data[other_problems]" rows="3" cols="30"><?php echo $_GET['arv_data']['other_problems']; ?></textarea>
			</td>
		</tr>
		<tr height="25px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right">Codes for ARV Therapie:</td>
			<td><?php echo $o_arv_visit->displaySelectedARVDrugs_table()?></td>
		<tr height="23px" bgcolor="#F0F5FF">

			<td valign="top" class="leftTable" align="right"><div class="label">ARV status:</div></td>
			<td valign="top" align="left">
				<?php
				$elements = array(
						    array('name' => 'no arv', 'value' => '1'),
						    array('name' => 'start arv', 'value' => '2'),
						    array('name' => 'continue',  'value' => '3'),
						    array('name' => 'change',  'value' => '4'),
						    array('name' => 'stop arv',  'value' => '5'),
						    array('name' => 'don\'t know',  'value' => '-1')
							);
				foreach ($elements as $element) {
		    		printf('<input type="radio" name="arv_data[care_tz_arv_status_id]" value="%s" %s/> %s <br/>',
		       		$element['value'],
		        		( $_GET['arv_data']['care_tz_arv_status_id']== $element['value']) ? 'checked="checked" ' : '',
		        	$element['name']);
				}
				?>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Why start, change, stop:</div></td>
			<td  valign="top" align="left">
				<input name="select_status_reason" value="select>>" type="submit"/>
			</td>
		</tr>
		<tr bgcolor="#F0F5FF">
			<td height="25px" class="leftTable"> </td>
			<td><?php echo $o_arv_visit->displaySelectedItems_table($_GET['r_item_no'])?></td></tr>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Relevant comedication:</div></td>
			<td valign="top" align="left">
				<?php echo $o_arv_visit->displayAllDrugs(); ?>
			</td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">CD4:</div></td>
			<td><?php echo $o_arv_visit->displayLabParamFromName('CD4')?></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">HB:</div></td>
			<td><?php echo $o_arv_visit->displayLabParamFromName('Hemoglobin (Hb)')?></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top"class="leftTable"  align="right"><div class="label">Abnormal lab results:</div></td>
			<td><?php echo $o_arv_visit->displayLabResults_table()?></td>
		</tr>
		<tr height="23px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label">Sign clinician:</div></td>
			<td valign="top" align="left"><?php echo $messages['create_id'] ?><input maxlength="80" name="arv_data[create_id]" type="text" value="<?php echo $_GET['arv_data']['create_id']?>" /></td></tr>
		<tr height="30px" bgcolor="#F0F5FF">
			<td valign="top" class="leftTable" align="right"><div class="label"></div></td>
			<td  valign="bottom" align="left">
				<input name="submit" value="submit" type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
			</td>
		</tr>
</table>
<input type="hidden" name="pid" value="<?php echo $_GET['pid']?>" />
		<input type="hidden" name="mode" value="<?php echo $_GET['mode']?>" />
		<input type="hidden" name="arv_visit_id" value="<?php echo $_GET['arv_visit_id']?>" />
		<?php
			while (list ($key, $val) = each ($_GET['a_item_no'])) {
				echo "<input type=\"hidden\" name=\"a_item_no[$key]\" value=\"$val\" />";
			}
			while (list ($key, $val) = each ($_GET['r_item_no'])) {
				echo "<input type=\"hidden\" name=\"r_item_no[$key]\" value=\"$val\" />";
			}
		?>
		<input type="hidden" name="arv_data[create_time]" value="<?php echo $_GET['arv_data']['create_time']; ?>" />
		<input type="hidden" name="encounter_nr" value="<?php echo $_GET['encounter_nr']?>" />
	</form>
</body>
</html>



