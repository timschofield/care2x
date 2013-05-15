{{* ward_occupancy.tpl 2004-06-15 Elpidio Latorilla *}}
{{* main frame containing ward list and submenu block *}}

{{$sWarningPrompt}}

<style type="text/css">
	.mimHover{
		border:1px solid blue; padding:2px 10px 2px 10px; font-weight:bold; text-transform:upper; background:#ccc;
	}

	.mimHover:hover{
		background:#fff;
	}
	.bold{font-weight:bold;}
</style>
<div style="width:100%; padding:3px; text-align:center; background:lime; border-bottom:5px solid white;" class="adm_item">
	<input type='button' value="Refresh Patient List" name = 'btn' class="mimHover" onclick="window.location.href='{{$sReloadBtn}}'" >
</div>

<form method = "post" action = "" name ="discharge_form" onSubmit =" return confSubmit(this)">
<table cellspacing="0" cellpadding="0" width="100%">
<tbody>
	<tr valign="top">
		<td>
			{{if $bShowPatientsList}}
				{{include file="ambulatory/outpatients_list.tpl"}}
			{{/if}}
<div style="width:100%; padding:3px; text-align:center; background:lime; border-top:5px solid white;" class="adm_item">
	<input type='button' value="Refresh Patient List" name = 'btn' class="mimHover" onclick="window.location.href='{{$sReloadBtn}}'" >
</div>
			<p>
			{{$showDiagnosis}}
			<p>
			{{$showLabs}}
			<p>
			{{$showPrescr}}
			<p>
			{{$showRadio}}
			<p align = "right">
			{{$LDSelectOutpatients}} | {{$LDUnSelectOutpatients}}
			<p align="right">
			{{$sDischargeSelected}}
			<p align="left">
			{{$pbClose}}
		</td>
		<td align="right">
			{{$sSubMenuBlock}}
		</td>
	</tr>
</tbody>
</table>
</form>
