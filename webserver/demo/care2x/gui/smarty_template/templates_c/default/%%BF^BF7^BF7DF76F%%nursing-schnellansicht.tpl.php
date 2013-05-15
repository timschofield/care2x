<?php /* Smarty version 2.6.22, created on 2012-10-05 21:36:49
         compiled from nursing/nursing-schnellansicht.tpl */ ?>
<!--
Do not attempt to edit the javascript code block unless you are 100% sure you know what you are doing !!
-->
<script language="javascript">
<!--
var urlholder;

 function gotostat(station){
    winw=screen.width ;
    winw=(winw / 2) - 400;
    winh=screen.height ;
    winh=(winh / 2) - 300;
    winspecs="width=800,height=600,screenX=" + winw + ",screenY=" + winh + ",menubar=no,resizable=yes,scrollbars=yes";

     urlholder="nursing-station.php?route=validroute&user={$aufnahme_user}&station=" + station;
     stationwin=window.open(urlholder,station,winspecs);
 }

 function statbel(e,ward_nr,st){

  <?php if ($this->_tpl_vars['dhtml']): ?>
     w=window.parent.screen.width;
     h=window.parent.screen.height;
  <?php else: ?>
     w=800;
     h=600;
  <?php endif; ?>

  winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);

  if (e==1) urlholder="nursing-station-pass.php?rt=pflege&sid=<?php echo $this->_tpl_vars['SID_Parameter']; ?>
&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  else urlholder="nursing-station.php?rt=pflege&sid=<?php echo $this->_tpl_vars['SID_Parameter']; ?>
&edit=0&retpath=quick&ward_nr="+ward_nr+"&station="+st;
  //stationwin=window.open(urlholder,station,winspecs);
  window.location.href=urlholder;
 }
 -->
</script>

<?php echo $this->_tpl_vars['tblCalendar']; ?>

<div class="warnprompt">
	<img <?php echo $this->_tpl_vars['gifVarrow']; ?>
 alt=""><?php if ($this->_tpl_vars['is_today']): ?> <?php echo $this->_tpl_vars['LDTodays']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['LDOld']; ?>
 <?php endif; ?> <?php echo $this->_tpl_vars['LDOccupancy']; ?>

	&nbsp;&nbsp;
	(<?php echo $this->_tpl_vars['formatDate2Local']; ?>
)
</div>

<table  cellpadding="0" cellspacing=0 border="0"  width="100%">

	<tr class="wardlisttitlerow" align=center><td><b>&nbsp;<?php echo $this->_tpl_vars['LDStation']; ?>
&nbsp;</b></td>
		<td><img  <?php echo $this->_tpl_vars['gifImg_mangr']; ?>
 alt="<?php echo $this->_tpl_vars['LDNrUnocc']; ?>
"> <font face="verdana,arial" size="2" ><b><?php echo $this->_tpl_vars['LDFreeBed']; ?>
</b></td>
		<td><font  color="<?php echo $this->_tpl_vars['PIE_CHART_USED_COLOR']; ?>
">&nbsp;<b><?php echo $this->_tpl_vars['LDOccupied']; ?>
</b></font></td>
		<td>&nbsp;<b><?php echo $this->_tpl_vars['LDOccupancy']; ?>
 (%)</b></td>
		<td>&nbsp;<b><?php echo $this->_tpl_vars['LDBedNr']; ?>
</b></td>
		<td><b>&nbsp;<?php echo $this->_tpl_vars['LDOptions']; ?>
&nbsp;</b></td>
	</tr>

    <?php echo $this->_tpl_vars['WardRows']; ?>


</table>

	<br>

<?php if (! $this->_tpl_vars['iWardCount']): ?>
	<p class="warnprompt">
	<img <?php echo $this->_tpl_vars['gifMascot1_r']; ?>
 alt="">
    <b><?php echo $this->_tpl_vars['LDNoOcc']; ?>
</b>
	</p>
	
	<p>
	<a href="<?php echo $this->_tpl_vars['LINKArchiv']; ?>
"><?php echo $this->_tpl_vars['LDClk2Archive']; ?>
 <img <?php echo $this->_tpl_vars['gifBul_arrowgrnlrg']; ?>
 alt=""></a>
	</p>
	<br>&nbsp;
<?php endif; ?>

<?php if ($this->_tpl_vars['from'] == 'arch'): ?>
	<a href="<?php echo $this->_tpl_vars['LINKArchiv']; ?>
"><img <?php echo $this->_tpl_vars['pbBack2']; ?>
 alt="" width=110 height=24></a>
<?php else: ?>
	<a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"><img <?php echo $this->_tpl_vars['gifClose2']; ?>
 alt="<?php echo $this->_tpl_vars['LDCloseAlt']; ?>
" <?php echo $this->_tpl_vars['dhtml']; ?>
></a>
<?php endif; ?>