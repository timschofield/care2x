<?php /* Smarty version 2.6.22, created on 2012-10-16 18:51:33
         compiled from doctors/submenu_doctors.tpl */ ?>
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

  urlholder="../nursing/nursing-station-pass.php?rt=pflege&doclist="+e+"&sid=<?php echo $this->_tpl_vars['SID_Parameter']; ?>
&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;

  //window.open(urlholder,'win',winspecs);

  window.location.href=urlholder;
 }
 -->
</script>

		 <blockquote>
			<TABLE cellSpacing=0  width=600 class="submenu_frame" cellpadding="0">
			<TBODY>
			<TR>
				<TD>
					<TABLE cellSpacing=1 cellPadding=3 width=600>
					<TBODY class="submenu">

					<TR>
						<td colspan=3>

							<span style="font:bold 18px Tahoma, Arial; color:darkblue; padding:10px;">
								Medical Services
							</span>

							<table border=0 cellpadding=1 cellspacing=1>
							<?php echo $this->_tpl_vars['tblDoctorInfo']; ?>

							</table>
						</td>
					</TR>

					<tr>
						<td align="left" colspan=3 STYLE="PADDING:10PX;">
						<table>
								<tbody>
								<tr><td>&bull; <a href="javascript:statbel('1','12','Medical')" STYLE="FONT-WEIGHT:BOLD;">MEDICINE</a></td><td> </td></tr>
								<tr><td>&bull; <a href="javascript:statbel('2','12','Obstetrics')" STYLE="FONT-WEIGHT:BOLD;">OB/GYN</a></td><td> </td></tr>

								<tr><td>&bull; <a href="javascript:statbel('3','12','Pediatrics')" STYLE="FONT-WEIGHT:BOLD;">PEDIATRICS</a></td><td> </td></tr>
								<tr><td>&bull; <a href="javascript:statbel('4','12','gensurgery')" STYLE="FONT-WEIGHT:BOLD;">GENERAL SURGERY</a></td><td> </td></tr>
								<tr><td>&bull; <a href="javascript:statbel('5','12','Orthopedics')" STYLE="FONT-WEIGHT:BOLD;">ORTHOPEDICS SURGERY</a></td><td> </td></tr>

								<tr><td>&bull; <a href="javascript:statbel('6','12','spina')" STYLE="FONT-WEIGHT:BOLD;">SPINA BIFIDA & HC SURGERY</a></td><td> </td></tr>
								<tr><td>&bull; <a href="javascript:statbel('7','12','mental')" STYLE="FONT-WEIGHT:BOLD;">MENTAL HEALTH</a></td><td> </td></tr>
								<tr><td>&bull; <a href="javascript:statbel('0','12','unknown')" STYLE="FONT-WEIGHT:BOLD;">UNKNOWN</a></td><td> </td></tr>
								</tbody>
							</table>
						</td>
					</tr>

					<!--

					
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					 -->

					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php echo $this->_tpl_vars['LDDocsForumTxt']; ?>


					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/submenu_row_spacer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					
					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
			<a href="<?php echo $this->_tpl_vars['breakfile']; ?>
"><img <?php echo $this->_tpl_vars['gifClose2']; ?>
 alt="<?php echo $this->_tpl_vars['LDCloseAlt']; ?>
" <?php echo $this->_tpl_vars['dhtml']; ?>
></a>
			<p>
			</blockquote>