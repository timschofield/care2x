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

define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename($_SERVER['PHP_SELF']);
//$db->debug=true;
if(!isset($prescriber)||empty($prescriber)) $prescriber=$_COOKIE[$local_user.$sid];

$title="$LDMedication/$LDDosage";
$maxelement=5; // set to default maximum nr of elements for entry
/* Create charts object */
require_once($root_path.'include/care_api_classes/class_charts.php');
$charts_obj= new Charts;


	if($mode=='save'){
		/* Reset colorbar flags */
		$mark_antibiotic=0;
	    $mark_diuretic=0;
		$mark_anticoag=0;
		$mark_iv=0;
		
		/* Load visual signalling functions */
		include_once($root_path.'include/inc_visual_signalling_fx.php');
		
		$saved=false;

		for($i=0;$i<$maxelement;$i++){
			$tdx='m'.$i;
			$ddx='d'.$i;
			$cdx='c'.$i;
			
			if(!(empty($$tdx)||empty($$ddx))){
				$data_array['encounter_nr']=$pn;
				$data_array['color_marker']=$$cdx;
				$data_array['dosage']=$$ddx;
				$data_array['article']=$$tdx;
                $data_array['prescriber']=$prescriber;

				switch($$cdx)
				{
					case 'a': $mark_antibiotic =1; break;
					case 'w': $mark_diuretic=1; break;
					case 'c': $mark_anticoag=1; break;
					case 'i': $mark_iv=1; break;
				}

                if($charts_obj->savePrescriptionFromArray($data_array)) $saved=true;
				
			}else{
				continue;
			}
			
		}
		
		if($saved){
			if($mark_antibiotic) setEventSignalColor($pn,SIGNAL_COLOR_ANTIBIOTIC);
			if($mark_diuretic) setEventSignalColor($pn,SIGNAL_COLOR_DIURETIC);
			if($mark_anticoag) setEventSignalColor($pn,SIGNAL_COLOR_ANTICOAG);
			if($mark_iv) setEventSignalColor($pn,SIGNAL_COLOR_IV);
			header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&dystart=$dystart&dyname=$dyname");
			exit;
		}
			
	}
	 // end of if(mode==save)
	$count=0;
	$medis=$charts_obj->getAllCurrentPrescription($pn);
	if(is_object($medis)){
		$count=$medis->RecordCount();
	}
?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$title &LDInputWin" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.newdata.value) return false;
	else return true
	}
 function parentrefresh(){
	window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
	}
-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v13 { font-family:verdana,arial;font-size:13; }
.v10 { font-family:verdana,arial;font-size:10; }
</style>

</HEAD>
<BODY  bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080"    topmargin="0" marginheight="0" 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	echo $title.'<br><font size=4>';	
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $winid ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>


<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >

<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0 >
  <tr>
    <td>
	
  <?php
if($count){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCurrentEntry; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDosage; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$medis->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		$toggle=!$toggle;
		switch($row['color_marker'])
		{
			case 'a': $bgc ='#00ff00'; break;
			case 'w': $bgc ='#ffff00'; break;
			case 'c': $bgc ='#dd36fc'; break;
			case 'i': $bgc ='#ff699f'; break;
			default: $bgc='#ffffff'; break;
		}

?>


  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['article']) echo $row['article']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($row['dosage']) echo $row['dosage']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>	
	
<table border=0 width=100% cellspacing=1>

  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13"><?php echo "$LDMedication - $LDDosage" ?></td>
  </tr>  
  
  <tr>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"></td>
   			 <td  align=center class="v12"><?php echo $LDDosage ?></td>
   			 <td  align=center class="v12"><?php echo $LDColorMark ?>:</td>
		  </tr>
			<?php 
			$v=array();
			for($i=0;$i<$maxelement;$i++)
			{
				echo '
 						 <tr>
   						 <td ><input type="text" name="m'.$i.'" size=35 maxlength=40>
        				</td>
   						 <td class="v12"><input type="text" name="d'.$i.'" size=15 maxlength=16>
						 </td>
   						 <td class="v10"><nobr>
						 	<input type="radio" name="c'.$i.'" value="n" ';
							echo '>&nbsp;&nbsp;&nbsp;<input type="radio" name="c'.$i.'" value="a" ';
							echo '><span style="background:#00ff00"><font color="#003300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						 	<input type="radio" name="c'.$i.'" value="w" ';
							echo '><span style="background:#ffff00"><font color="#666600">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						 	<input type="radio" name="c'.$i.'" value="c" ';
							echo '><span style="background:#dd36fc"><font color="#000033">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<input type="radio" name="c'.$i.'" value="i" ';
							echo '><span style="background:#ff699f"><font color="#330000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></nobr>
						 </td>
  						</tr>
 						 ';
				}
 			?>
			<tr>
   			 <td  class="v12" colspan=2>
			 <?php echo $LDNurse ?>:<br>
			 <input type="text" name="prescriber" size=25 maxlength=30 value="<?php echo $prescriber ?>">
			 </td>
   			 <td   class="v12"><?php echo $LDLegend ?>:<br>
			 <span style="background:#ffffff"><font color="#003300"> <?php echo $LDNormal ?> </span><br>
			 <span style="background:#00ff00"><font color="#003300"> <?php echo $LDAntibiotic ?> </span><br>
			 <span style="background:#ffff00"><font color="#000000"> <?php echo $LDDialytic ?> </span><br>
			 <span style="background:#dd36fc"><font color="#000000"> <?php echo $LDHemolytic ?> </span><br>
			 <span style="background:#ff699f"><font color="#000000"> <?php echo $LDIntravenous ?> </span><br></td>
		  </tr>

		</table>
	
	</td>
    
  </tr>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="maxelement" value="<?php echo $maxelement ?>">
<input type="hidden" name="enc" value="<?php echo strtr($enc," ","+") ?>">
<input type="hidden" name="mode" value="save">

</form>
<p>
<a href="javascript:document.infoform.submit();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<!-- <a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
 -->&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0" alt="<?php echo $LDClose ?>">
</a>
<?php endif; ?>

</BODY>

</HTML>