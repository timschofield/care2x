{{* ward_occupancy_list.tpl  2004-05-15 Elpidio Latorilla *}}
{{* Table frame for the occupancy list *}}

<table cellspacing="0" width="100%">
<tbody>
	<tr>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item">&nbsp;</td>
		<td class="adm_item">Sex</td>
		<td class="adm_item">{{$LDFamilyName}}, {{$LDName}}</td>
		<td class="adm_item">{{$LDBirthDate}}</td>
		<td class="adm_item">{{$LDPatNr}}</td>
		<td class="adm_item">{{$LDAdmissionDate}}</td>
		<td class="adm_item">{{$LDInsuranceType}}</td>
		<td class="adm_item" colspan=2>{{$LDOptions}}</td>
	</tr>

	{{$sOccListRows}}

 </tbody>
</table>
