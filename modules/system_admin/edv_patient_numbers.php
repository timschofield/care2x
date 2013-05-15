<?php
	/*
	 * Created on May 1, 2009
	 * Dennis Mollel : softweb crafters ltd.
	 *
	 * See the file "copy_notice.txt" for the licence notice
	 *
	 */

	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('roots.php');
	require($root_path.'include/inc_environment_global.php');

	define('LANG_FILE','edp.php');
	define('NO_2LEVEL_CHK',1);
	require_once($root_path.'include/inc_front_chain_lang.php');
	// reset all 2nd level lock cookies
	require($root_path.'include/inc_2level_reset.php');

	if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
	$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
	$HTTP_SESSION_VARS['sess_path_referer']=$top_dir.basename(__FILE__);
	$HTTP_SESSION_VARS['sess_user_origin']='amb';
	$HTTP_SESSION_VARS['sess_parent_mod']='';

	require_once($root_path.'include/care_api_classes/class_multi.php');
	$nb = new multi;
	$items='nr,name';

	# extract hospital numbers
	$v = $nb->__read_hospno();
	$val = explode('|',$v);

	if ($_POST['hospNo']){
		#clear existing memory chips
		unset($v);
		unset($val);
		# extract hospital numbers
		$vc  = ($_POST['ppid']==1)     ? '1|' : '1|'; # MUST BE SHOWN --- MANDATORY
		$vc .= ($_POST['penc']==1)     ? '1|' : '0|'; # ENCOUNTER
		$vc .= ($_POST['hno']==1)      ? '1|' : '1|'; # HOSPITAL NUMBER
		$vc .= ($_POST['ctc']==1)      ? '1|' : '0|'; # CTC

		$vc .= ($_POST['billing']==1)  ? '1|' : '0|'; # SPECIAL BILLING / POOR FUND
		$vc .= ($_POST['yletter']==1)  ? '1|' : '2|'; # PRINT LETTER FOR SPECIAL BILLING
		$vc .= ($_POST['nhif']==1)     ? '1|' : '0|'; # NHIF NUMBER
		$vc .= ($_POST['diabetic']==1) ? '1|' : '0|'; # DIABETIC NUMBER

		$vc .= ($_POST['nrooming']==1) ? '1|' : '2|'; # Enable/Disable Rooming List

		$vc .= ($_POST['flagdiag']==1) ? '1|' : '0|'; # Patient Diagnosis flaging

		$vc .= ($_POST['expire']==1)   ? '1|' : '0|' ; # User password Expiring Date

		$vc .= ($_POST['nodisch']==1)  ? '1'  : '0' ; # User password Expiring Date

		# save outputs
		$saved = $nb->_saveNumbers($vc);

		# get saved numbers
		$val = $nb->__genNumbers();

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
<script src="<?php print $root_path; ?>/modules/dental/JQ.js" language="javascript"></script>
<style type="text/css">
<!--
.botline {
	border-bottom:3px solid #66FF66;
	padding:5px auto 5px auto !important;
}
-->
</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" valign='bottom' class="botline">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;&nbsp;&nbsp;<?php echo $LDPatientNumber; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align='right' style='padding-top:5px;' class="botline">
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('dental.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr  valign=top>
    <td colspan="5">
      <!--    here is the forms are start   -->

		<form method="POST">
			<table border=0 cellspacing=1 cellpadding=2 style="width:40%; margin:15px 0px 0px 10px;">
			<tbody class="submenu">
			  <tr class="wardlisttitlerow" style="height:30px !important;">
			    <td colspan="2" align="center"><FONT  color="#000099"><b><?php echo $LDItems; ?></b></td>
			   <td nowrap style="padding:0px 7px 0px 7px !important;"><FONT  color="#000099"><b><?php echo $LDStatus; ?></b></td>
			  </tr>

			<?php
			 if ($saved=='saved'){
			  echo '<tr>
						<td colspan="3" style="width:10%; background-color:green; text-align:center; color:yellow; padding:4px; font:bold 12px Tahoma;">' .
						'' .
						'Saved' .
						'
			       </td>
				</tr>';
			 }


			# Heading
			  echo '<tr>
						<td colspan=3 style="padding:4px;"><FONT  color="#000000"><b> '.$LDNumberHead.'</b> </FONT> </td>
				</tr>';


			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDpPID.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="ppid" disabled="disabled" checked="true" ';
						//if ($val[0]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

			# ENCOUNTER NUMBER FOR KCMC
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDEncNr.'</b> </FONT></td>
						<td align="center">' .
						'<input type="checkbox" name="penc"';
						if ($val[1]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';


			  echo '<tr>
				<td style="width:10%; text-align:center;" valign="top"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
				<td align="left" colspan="2"><FONT  color="#0000cc"><b>'.$LDHospitalFNr.'</b><br />' .
					'<label>
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="hno" id="hno" onclick="checkbox(\'hno\')" type="radio" ';

					  if ($val[2]==1) print ' checked="true" ';

				 echo '' .
					  ' value="1" />
					  '.$LDFNr.'</label>
					  <br />
					  <label>
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="ohno" id="ohno" onclick="checkbox(\'ohno\')" type="radio" ';

					  if ($val[2]==2) print ' checked="true" ';

				 echo '' .
					  ' value="2" />
					  '.$LDOFNr.'</label>' .
					'' .
					'</font>
				</td>
				</tr>';




			# Heading
			  echo '<tr>
						<td colspan=3 style="padding:8px 4px 4px 4px;"><FONT  color="#000000"><b> '.$LDpOtherNumbers.'</b> </FONT> </td>
				</tr>';

				# NHIF Number
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDpNHIF.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="nhif" ';
							if ($val[6]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

			  # CTC  NUMBER
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDCtcNr.'</b> </FONT></td>
						<td align="center">' .
						'<input type="checkbox" name="ctc"';
						if ($val[3]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

				# Diabetic Number
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDpDiabetic.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="diabetic" ';
							if ($val[7]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

			# spacer
			  echo '<tr>
						<td colspan=3> &nbsp; </td>
				</tr>';

			# Heading
			  echo '<tr>
						<td colspan=3 style="padding:8px 4px 4px 4px;"><FONT  color="#000000"><b> '.$LDBillingHead.'</b> </FONT> </td>
				</tr>';

			# Poor Fund program
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDSpecialBiling.'</b> </FONT></td>
						<td align="center">' .
						'<input type="checkbox" name="billing" id="billing" onclick="javascript:DisableNrs(this.value);"';
						if ($val[4]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

			# show letters
			  echo '<tr>
				<td style="width:10%; text-align:center;" valign="top"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
				<td align="left" colspan="2"><FONT  color="#0000cc"><b>'.$LDShowBarua.'</b><br />' .
					'<label>
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="yletter" id="yletter" onclick="checkbox(\'yletter\')" type="radio" ';

					  if ($val[4]==1) {if ($val[5]==1) print ' checked="true" ';}

				 echo '' .
					  ' value="1" />
					  '.$LDShowY.'</label>
					  <br />
					  <label>
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="nletter" id="nletter" onclick="checkbox(\'nletter\')" type="radio" ';

					  if ($val[4]==1) if ($val[5]==2) print ' checked="true" ';

				 echo '' .
					  ' value="2" />
					  '.$LDShowN.'</label>' .
					'' .
					'</font>
				</td>
				</tr>';



			# spacer
			  echo '<tr>
						<td colspan=3> &nbsp; </td>
				</tr>';

			# Heading
			  echo '<tr>
						<td colspan=3 style="padding:8px 4px 4px 4px;"><FONT  color="#000000"><b> '.$LDListHead.'</b> </FONT> </td>
				</tr>';

			# show letters
			  echo '<tr>
				<td style="width:10%; text-align:center;" valign="top"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
				<td align="left" colspan="2"><FONT  color="#0000cc"><b>'.$LDEnableList.'</b><br />' .
					'<label>
					  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="nrooming" id="nrooming" onclick="rooming(\'nrooming\')" type="radio" ';

					  if ($val[8]==1) print ' checked="true" ';

				 echo '' .
					  ' value="1" />
					  '.$LDListing.'</label>
					  <br />
					  <label>
					  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .
					  '<input name="yrooming" id="yrooming" onclick="rooming(\'yrooming\')" type="radio" ';

					  if ($val[8]==2) print ' checked="true" ';

				 echo '' .
					  ' value="2" />
					  '.$LDRooming.'</label>' .
					'' .
					'</font>
				</td>
				</tr>';



			# spacer
			  echo '<tr>
						<td colspan=3> &nbsp; </td>
				</tr>';

			# Heading
			  echo '<tr>
						<td colspan=3 style="padding:8px 4px 4px 4px;"><FONT  color="#000000"><b> '.$LDOtherSettings.'</b> </FONT> </td>
				</tr>';


				# Flag patients with no Diagnosis
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDFlagDiagnosis.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="flagdiag" ';
							if ($val[9]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

				# Dont discharge without Diagnosis
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDNoDischarge.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="nodisch" ';
							if ($val[11]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

				# Password expiring features
			  echo '<tr>
						<td style="width:10%; text-align:center;"><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
						<td><FONT  color="#0000cc"><b>'.$LDExpire.'</b> </FONT></td>
						<td  style="width:10%; text-align:center;">' .
						'<input type="checkbox" name="expire" ';
							if ($val[10]==1) print ' checked="true" ';
				   echo ' value="1" >
			       </td>
				</tr>';

			# spacer
			  echo '<tr>
						<td colspan=3> &nbsp; </td>
				</tr><tr>
						<td colspan=3> &nbsp; </td>
				</tr>';

			  echo '<tr>
				<td style="width:10%; text-align:right;" colspan="3">
					<input type="image" '. createLDImgSrc($root_path,'savedisc.gif','0') . ' border=0></td>
				</tr>';

			?>
			</tbody>
			</table>
			<input type="hidden" value='save' id='hospNo' name='hospNo' />
			</form>

      <!--    here is the form ends   -->
    </td>
  </tr>
<tr>
<script language='javascript' type='text/javascript'>
	<!--
		function checkbox(st){
			if (st=='ohno'){
				document.getElementById('ohno').value = 1;
				document.getElementById('hno').value = 0;
				$("#hno").attr("checked",false);
			}
			else if (st=='hno'){
				document.getElementById('ohno').value = 0;
				document.getElementById('hno').value = 1;
				$("#ohno").attr("checked",false);
			}

			if (st=='yletter'){
				document.getElementById('yletter').value = 1;
				document.getElementById('nletter').value = 0;
				$("#nletter").attr("checked",false);
				$("#billing").attr("checked",true);
			}
			else if (st=='nletter'){
				document.getElementById('yletter').value = 0;
				document.getElementById('nletter').value = 1;
				$("#yletter").attr("checked",false);
			}
		}

		function rooming(vs){
			if (vs=='nrooming'){
				document.getElementById('yrooming').value = 0;
				document.getElementById('nrooming').value = 1;
				$("#yrooming").attr("checked",false);
				$("#nrooming").attr("checked",true);
			}
			else if (vs=='yrooming'){
				document.getElementById('nrooming').value = 0;
				document.getElementById('yrooming').value = 1;
				$("#nrooming").attr("checked",false);
				$("#yrooming").attr("checked",true);
			}
		}

		function DisableNrs(s){
			if (s!=0){
				$("#yletter").attr("checked",false);
				$("#nletter").attr("checked",false);
				$('#yletter').removeAttr('disabled');
				$('#nletter').removeAttr('disabled');
			} else {
				$("#billing").value = 0;
				$('#yletter').attr('disabled', 'disabled');
				$('#nletter').attr('disabled', 'disabled');
			}
		}
	-->
</script>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>
</table>
</body>
</html>
