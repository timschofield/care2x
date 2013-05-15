<?php
/*
 * DCMC HOSPITAL
 * created by DENNIS MOLLEL,
 * deemagics@yahoo.com
 * October 2008.
 */
session_start();

require('./roots.php');

require($root_path.'include/inc_environment_global.php');

$lang_tables[]='search.php';
define('LANG_FILE','dental.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/inc_date_format_functions.php');

include_once($root_path.'include/care_api_classes/class_mini_dental.php');

$histry= new dental;

$pName = new dental;

$histry->viewtype=($view=='cons')?4:0;

#print ($pName->viewtype.'<hr />');

$fileno_obj = new dental;

/**
 * Patient Encounter
 */
$encounter_nr= $_GET['encounter'];

/**
 * Patient ID
 */

 $pid= $_GET['pid'];

(!$pid)? $pid=$pName->GetPidFromEncounter($encounter_nr): $pid=$pid;

/**
 * colors for the report
 */

 $printThiS=FALSE;

 $c1='#FFFFF';
 $c2='#F4F8F3';

/**
 * Number of Records to display
 */

 $records = '15';

 /**
  * Double-Check for File No.
  */

(!$_GET['filenr'])?	$fileno = $fileno_obj->GetFileNoFromPID($pid) : $fileno = $_GET['filenr'];

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $LDHeadHistory;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../dental/dental_reports.css" rel="stylesheet" type="text/css">
<style type="text/css">
  <!--

	a, a:visited{text-decoration:none; color:black;}
	a:hover{text-decoration:underline; color:blue;}
	body{margin:0px;}
	.style3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
	.style5 {
		color: #FFFFFF;
		font-weight: bold;
		font-size: 14px;
	}
	.style7 {font-size: 10px}

	.button{background: maroon; color:white;}
	.button2{background: black; color:white;}

	.button,.button2{border:1px solid yellow; padding:3px 10px 3px 10px;
			 width:100px; font:normal 11px Tahoma, monospace;}
	a.button,a.button2{text-align:none}
	.button:hover,.button2:hover{ background:white; border:1px solid black; color:black;}

	.button1 {background: maroon; color:white;}
	.button2 {background: black; color:white;}

	#prntcc{width:100%; padding:12px 0px 12px 0px; border-bottom:1px solid maroon; text-align:center;}
	#readnote{margin:0px auto; width:600px;}
  -->
</style>

<script language="JavaScript" type="text/JavaScript">
<!--
function printPage() {
  	document.getElementById("prnt").innerHTML='&nbsp;';
	document.getElementById("prnttop").innerHTML='&nbsp;';
	document.getElementById("specials").innerHTML='&nbsp;';
	document.getElementById("min").style.height='5px';
	document.getElementById("min").style.overflow='hidden';
	javascript:window.print();
}
//-->
</script>
<script src="../dental/dental_filling_.js" language="javascript"></script>
<script src="../dental/JQ.js" language="javascript"></script>
</head>

<?php   print '<body ';

		($mode=='new')? print 'onload="' .
							  'navigate(\''.$_GET['encounter'] .
							  '&url=../dental/gui_patient_history.php|' . $pid .
							  '\', \'../dental/gui_dental_addnotes.php\');">' : print '>';
	?>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;&nbsp;&nbsp;Patient Notes</STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align='right' style='padding-top:5px;'>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dental.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr align="left" valign=bottom>
    <td height="10" colspan="2" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" class="botline">
      &nbsp; </td>
</tr>
</table>

  <table width="600"  border="0" align="center" cellpadding="4" cellspacing="1" class="style3">
    <tr bgcolor="#FFFFFF">
      <td height="36" colspan="2" id="min">
	  <div id="prnttop">
		  <div id="prntcc">
		  	<input name="New" type="button" id="Close2" value="Add Notes &raquo;" class="button" onClick="navigate('<?php echo $encounter_nr; ?>&url=<?php echo '../dental/gui_patient_history.php|'.$pid; ?>', '../dental/gui_dental_addnotes.php')" >
		  	<input name="Print" type="button" id="Print2" value="Print this &raquo;" class="button" onClick="printPage();" >
		  	<input name="Close" type="button" id="Close2" value="Close" class="button2" onClick="javascript:window.close();" >
		  </div>
	  </div>
	  </td>
    </tr>

    <tr bgcolor="#FFFFFF">
      <td height="36" colspan="2" id = "min">
		<div id="specials" >
			 &nbsp;
		</div>
	  </td>
    </tr>

    <tr bgcolor="#A6BFA2">
      <td height="36" colspan="2"><div align="center" class="style5" style="text-transform:uppercase;"><?php echo $LDHeadHistory;?> </div></td>
    </tr>
    <tr>
      <td width="81" bgcolor="#F0F4F0"><div align="right"><span class="style3">Name:</span></div></td>
      <td width="572" bgcolor="#F9F9F9">
      	<strong>
			<?php $pName->GetPatientNameFromPid($pid); ?>
		</strong></td>
    </tr>
    <tr>
      <td width="81" bgcolor="#F0F4F0"><div align="right"><span class="style3">PID:</span></div></td>
      <td width="572" bgcolor="#F9F9F9">
      	<strong>
			<?php echo $pid; ?>
		</strong></td>
    </tr>

    <tr>
      <td bgcolor="#F0F4F0"><div align="right"><span class="style3">File Nr:</span></div></td>
      <td bgcolor="#F9F9F9"><strong>
			<?php echo $fileno;?>
		</strong></td>
    </tr>

    <tr style="display:none;">
      <td width="81" bgcolor="#F0F4F0"><div align="right"><span class="style3">Measurements:</span></div></td>
      <td width="572" bgcolor="#F9F9F9">
      	<strong>
			<a href="#" onclick="window.location.href='../../modules/registration_admission/show_weight_height.php<?php print URL_REDIRECT_APPEND."&target=$target&allow_update=1&pid=".$HTTP_SESSION_VARS['sess_pid']; ?>'" title="Visit Patient Measurement History">
				View
			</a>
		</strong></td>
    </tr>

    <tr align="left" valign="top">
      <td colspan="2" style="padding-top:9px;">

        <table width="590"  border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="#A6BFA2" class="style3">
          <tr bgcolor="#D2DFD0">
            <td width="93"><strong>Date</strong></td>
            <td width="368"><strong>Patient Notes </strong></td>
            <td width="101"><strong>Written by:</strong></td>
          </tr>

		  <!--//-->

			<?php $histry->PrintPatientNotes($pid,$LDNoRecordFound,$c1,$c2,$records,$encounter_nr); ?>

		  <!--//-->

          <tr align="center" valign="top" bgcolor="#A6BFA2">
            <td colspan="3" class="style7">****End****</td>
          </tr>
      </table>      </td>
    </tr>

    <tr align="left" valign="top">
      <td colspan="2">
	  <div id="prnt">
		  <div id="prntcc">
		  	<input name="New" type="button" id="Close2" value="Add Notes &raquo;" class="button" onClick="navigate('<?php echo $_GET['encounter']; ?>&url=<?php echo '../dental/gui_patient_history.php|'.$pid; ?>', '../dental/gui_dental_addnotes.php')" >
		  	<input name="Print" type="button" id="Print2" value="Print this &raquo;" class="button" onClick="printPage();" >
		  	<input name="Close" type="button" id="Close2" value="<?php ($_GET['frm'] == 'chart')?  print '&laquo; back' : print 'Close'; ?>" class="button2" onClick="javascript:window.<?php ($_GET['frm'] == 'chart')?  print 'history.back()' : print 'close()'; ?>;" >
		  </div>
	  </div>
	  </td>
    </tr>
    <tr align="left" valign="top">
      <td height="22" colspan="2">&nbsp;	  </td>
    </tr>

  </table>
</body>
</html>
