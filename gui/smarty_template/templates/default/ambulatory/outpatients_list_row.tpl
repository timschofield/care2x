{{* ward_occupancy_list_row.tpl 2004-06-15 Elpidio Latorilla *}}
{{* modified by Dennis Mollel 2010-11-23 E-Africa Version *}}
{{* One row for each occupant or room/bed *}}
{{* This template is used by /modules/nursing/nursing_station.php to populate the ward_occupancy_list.tpl template *}}

 {{if $bToggleRowClass}}
	<tr class="wardlistrow1" {{$sFlagDiag}}>
 {{else}}
	<tr class="wardlistrow2" {{$sFlagDiag2}} >
 {{/if}}
		<td>{{$sClass}}</td>
		<td>{{$sMiniColorBars}}</td>
		<td>&nbsp;{{$sBed}} {{$sBedIcon}}</td>
		<td>&nbsp;{{$sTitle}} {{$sFamilyName}}{{$cComma}} {{$sName}}</td>
		<td>&nbsp;{{$sBirthDate}}</td>
		<td>&nbsp;{{$sPatNr}}</td>
		<td>&nbsp;{{$sAdmissionDate}}</td>
		<td>&nbsp;{{$sInsuranceType}}</td>
		<td>&nbsp;{{$sAdmitDataIcon}} {{$sDischargeInfoIcon}} {{$sARVIcon}} {{$sChartFolderIcon}} {{$sNotesIcon}} {{$sTransferIcon}} {{$sDischargeIcon}} {{$sNoDiag}}</td>
		<td>&nbsp;{{$sCheckBox}}</td>

	</tr>
	<tr>
		<td colspan="10" class="thinrow_vspacer">{{$sOnePixel}}</td>
	</tr>
