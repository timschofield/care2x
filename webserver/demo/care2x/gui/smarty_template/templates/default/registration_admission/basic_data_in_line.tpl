{{* Template for displaying basic data of patient/person *}}
{{* Used by /modules/registration_admission/gui_bridge/default/gui_show.php *}}

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		{{if $is_discharged}}
				<tr>
					<td bgcolor="red" colspan="3">
						&nbsp;
						{{$sWarnIcon}}
						<font color="#ffffff">
						<b>
						{{$sDischarged}}
						</b>
						</font>
					</td>
				</tr>
		{{/if}}

				<tr>
					<td  {{$sClassItem}}>
						{{$LDCaseNr}}
					</td>
					<td {{$sClassInput}}>
						{{$sEncNrPID}}
					</td>
					<td {{$sClassItem}}>
						{{$LDLastName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_last}}</b>
					</td>
					<td {{$sClassItem}}>
						{{$LDFirstName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$name_first}}
					</td>
					<td {{$sClassItem}}>
						{{$LDBday}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$sBdayDate}} &nbsp; {{$sCrossImg}} &nbsp; <font color="black">{{$sDeathDate}}</font>
					</td>
				</tr>

		</table>