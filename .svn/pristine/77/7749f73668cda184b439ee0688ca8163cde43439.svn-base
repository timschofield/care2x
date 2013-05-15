<script  language="javascript">
function popNotes(d){
	alert(d);
}
-->
</script>
<table border=0 cellpadding=4 cellspacing=1 width=100% class="frame">

<?php
$toggle=0;
while(list($x,$row)=each($msr_comp)){
	if($toggle) $bgc='#f3f3f3';
		else $bgc='#FFFFCC';
	$toggle=!$toggle;
?>

  <tr <?php echo $tbg; ?>>
    <td width="17%" align="left" valign="top"><?php echo $LDDate; ?></td>
    <td align="left" valign="top"><?php echo $LDType; ?></td>
    <td align="left" valign="top"><?php echo $LDUnit.' '.$LDValue; ?></td>
    <td align="left" valign="top"><?php echo $LDNotes; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td width="17%" rowspan="10" align="left" valign="top" bgcolor="<?php echo $bgc; ?>"><?php echo @formatDate2Local($row['msr_date'],$date_format); ?></td>
    <td width="19%" align="left" valign="top"><b><?php echo $LDFileNr; ?><b></td>
    <td width="16%" align="left" valign="top" bgcolor="#FFFFFF"><b><?php echo $fileNr; ?></b></td>
    <td width="48%" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top" bgcolor="<?php echo $bgc; ?>"><?php echo $LDEncounterNr; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $row['encounter_nr']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td width="19%" align="left" valign="top"><?php echo $LDTime; ?></td>
    <td width="16%" align="left" valign="top" bgcolor="#FFFFFF"><?php echo strtr($row['msr_time'],'.',':'); ?></td>
    <td width="48%" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LDWeight; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[6]['value'].' '.$unit_ids[$row[6]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[6]['notes'];?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LDHeight; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <?php print $row[7]['value'].' '.$unit_ids[$row[7]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"> <?php print $row[7]['notes']; ?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LD['head_circumference']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[9]['value'].' '.$unit_ids[$row[9]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[9]['notes'];	?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LD['Pulse']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[10]['value'].' '.$unit_ids[$row[10]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[10]['notes'];	?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LD['resprate']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[11]['value'].' '.$unit_ids[$row[11]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[11]['notes'];	?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LD['bp']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[12]['value'].' '.$unit_ids[$row[12]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[12]['notes'];	?></td>
  </tr>
  <tr bgcolor="<?php echo $bgc; ?>">
    <td align="left" valign="top"><?php echo $LD['temp']; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[13]['value'].' '.$unit_ids[$row[13]['unit_nr']]; ?></td>
    <td align="left" valign="top" bgcolor="#FFFFFF"><?php print $row[13]['notes'];	?></td>
  </tr>

<?php
}
?>

</table>
<?php
if($parent_admit&&!$is_discharged) {
?>
<p>
<img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle'); ?>>
<a href="<?php echo $thisfile.URL_APPEND.'&pid='.$HTTP_SESSION_VARS['sess_pid'].'&target='.$target.'&mode=new'; ?>">
<?php echo $LDEnterNewRecord; ?>
</a>
<?php
}
?>
