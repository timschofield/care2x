<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
/**
* eComBill 1.0.04 for Care2002 beta 1.0.04 
* (2003-04-30)
* adapted from eComBill beta 0.2 
* developed by ecomscience.com http://www.ecomscience.com 
* GPL License
*/
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

//define('NO_CHAIN',1);
define('LANG_FILE','billing.php');

$local_user='aufnahme_user';
require_once($root_path.'include/inc_front_chain_lang.php');

    /* include('includes/condb.php');
    error_reporting(0);
    connect_db(); */  
    if($service=='HS')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='HS'";
    if($service=='LT')
    	$qryLT="SELECT * FROM care_billing_item WHERE item_type='LT'";
    $resultqryLT=$db->Execute($qryLT);
    if(is_object($resultqryLT)) $cntLT=$resultqryLT->RecordCount();
/*    $resultqryLT=mysql_query($qryLT);
    $cntLT=mysql_num_rows($resultqryLT);
*/
$breakfile='patientbill.php'.URL_APPEND.'&patientno='.$patientno.'&full_en='.$full_en;

# Extract the language variable
extract($TXT);

?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php if($service=='LT')echo $SelectLaboratoryTests;?><?php if($service=='HS')echo $SelectHospitalServices;?></title>
<SCRIPT language="JavaScript">
<!--
function submitform()
{
	var sel = new Array(document.selectlab.elements.length);
	var temp;
	var tempstr;
	var counter;
	str = document.selectlab.hidden.value;
	querystr = "confirmlabtests.php?";

	counter = 1;
	for (i=0;i<document.selectlab.elements.length;i++)
	{	
		temp = str.indexOf("#");
		if(document.selectlab.elements[i].type=="checkbox")
		{
			tempstr = str.substring(0,temp);
			str=str.substring(temp+1,str.length);					
			if(document.selectlab.elements[i].checked == true)
				querystr=querystr+"itemcode"+counter+"="+tempstr+"&";
			counter = counter + 1;					
		}		
	}
	document.selectlab.action = querystr;
	document.selectlab.submit();
}
//-->
</SCRIPT>


</head>

<body bgcolor="#FFFFFF" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>
<table border="0" width="101%" bgcolor=#99ccff>
      <tr>
        <td width="101%"><font color="#330066" size="+2" face="Arial"><strong><?php echo $eComBill; ?>-
          <?php if($service=='LT')echo $SelectLaboratoryTests;if($service=='HS')echo $SelectHospitalServices; ?></strong></font></td>
      </tr>
    </table>
<blockquote>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </p>
  <form name="selectlab" id="selectlab" method="POST" action="">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
    <div align="center">
      <center>
      <table cellSpacing="1" cellPadding="3" width="450" bgColor="#999999" border="0" height="138">
<?php
	echo "<tr bgColor=\"#eeeeee\">";
	echo "<td align=\"left\" height=\"73\" width=\"7666\" colspan=\"6\"><font size=\"5\" color=\"#FF0000\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	if($service=='LT') echo $SelectLaboratoryTests;?><?php if($service=='HS')echo $SelectHospitalServices;
	echo "<p><font color=\"#800000\" size=\"4\">";
	if($service=='LT') echo $PleaseSelectLaboratoryTestsforthePatient;?><?php if($service=='HS') echo $PleaseSelectHospitalServicesforthePatient;
	echo "</font></td>";
	echo "<tr bgColor=\"#eeeeee\">";
	echo "<th align=\"center\" height=\"7\" width=\"133\" bgcolor=\"#CCCCCC\">&nbsp;</th>";
	echo "<th align=\"center\" height=\"7\" width=\"514\" bgcolor=\"#CCCCCC\">$TestName</th>";
	echo "<th height=\"7\" width=\"826\" align=\"center\" bgcolor=\"#CCCCCC\">$TestCode</th>";
	echo "<th height=\"7\" width=\"623\" align=\"center\" bgcolor=\"#CCCCCC\">$Costperunit</th>";
	echo "<th height=\"7\" width=\"1014\" align=\"center\" valign=\"middle\" bgcolor=\"#CCCCCC\">$NumberofUnits</th>";
	if($cntLT){
	for($cnt=0;$cnt<$cntLT;$cnt++)
	{
		$item=$resultqryLT->FetchRow();
		$itemcode="";
		echo "</tr>";
		echo "<tr bgColor=\"#eeeeee\">";
		echo "<td align=\"center\" height=\"7\" width=\"133\"><input type=\"checkbox\" name=\"selectitem.$cnt\" id=\"nounits.$cnt\" value=\"ON\"></td>";
		echo "<td align=\"center\" height=\"7\" width=\"514\">".$item['item_description'];
		echo "</td>";
		echo "<td height=\"7\" width=\"826\" align=\"center\">".$item['item_code'];
		echo "</td>";
		echo "<td height=\"7\" width=\"623\" align=\"center\">".$item['item_unit_cost'];
		echo "</td>";
		echo "<td height=\"7\" width=\"1014\" align=\"center\" valign=\"middle\"><select size=\"1\" name=nounits.$cnt id=nounits.$cnt>";
		echo "<option selected>1</option>";
		echo "<option>2</option>";
		echo "<option>3</option>";
		echo "<option>4</option>";
		echo "<option>5</option>";
		echo "</select></td>";          
		echo "</tr>";
		if($cnt != ($cntLT-1))
		{
			echo "<tr bgColor=\"#dddddd\" height=\"1\">";
			echo "<td height=\"5\" width=\"7666\" colspan=\"6\"><img height=\"1\" src=\"pics/hor_bar.bmp\" width=\"5\"></td>";
			echo "</tr>";
		}
		$itemcode=$item['item_code'];
		$itemcode1=$itemcode1.$itemcode;
		$itemcode1=$itemcode1."#";
	}
	}
    $itemcode=$itemcode1;
?>
<input type="hidden" name="hidden" value="<?php echo $itemcode; ?>">
<input type="hidden" name="patientno" value="<?php echo $patientno; ?>">
<input type="hidden" name="service" value="<?php echo $service; ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="full_en" value="<?php echo $full_en ?>">
      </table>
    &nbsp;<p>
    <input type="button" onclick="javascript:submitform();" value="<?php echo $AddtoPatientBill; ?>" name="B1">
	&nbsp;&nbsp;<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','bottom'); ?>></a>      

      </center>
    </div>
    <p>&nbsp;</p>
  </form>
</blockquote>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</body>
</html>

