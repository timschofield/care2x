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

  {{if $dhtml}}
     w=window.parent.screen.width;
     h=window.parent.screen.height;
  {{else}}
     w=800;
     h=600;
  {{/if}}

  winspecs="menubar=no,resizable=yes,scrollbars=yes,width=" + (w-15) + ", height=" + (h-60);

  urlholder="../nursing/nursing-station-pass.php?rt=pflege&doclist="+e+"&sid={{$SID_Parameter}}&edit=1&retpath=quick&ward_nr="+ward_nr+"&station="+st;

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
							{{$tblDoctorInfo}}
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

					{{*$LDQViewTxt*}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{*$LDDutyPlanTxt*}} -->

					{{include file="common/submenu_row_spacer.tpl"}}

					{{$LDDocsForumTxt}}

					{{include file="common/submenu_row_spacer.tpl"}}

					{{*$LDNewsTxt*}}

					</TBODY>
					</TABLE>
				</TD>
			</TR>
			</TBODY>
			</TABLE>

			<p>
			<a href="{{$breakfile}}"><img {{$gifClose2}} alt="{{$LDCloseAlt}}" {{$dhtml}}></a>
			<p>
			</blockquote>
