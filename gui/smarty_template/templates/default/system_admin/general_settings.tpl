{{* quick_informer.tpl  Quick informer edit form 2004-06-29 Elpidio Latorila *}}
{{* Note: the input elements are written in raw form here to give you the chance to redimension them. *}}
{{* Note: In redimensioning the input elements, be very careful not to change their names nor value tags. *}}
{{* Note: Never change the "maxlength" value *}}

<ul>
<FONT class="prompt"><p>
{{$sMascotImg}} {{$LDDataSaved}} {{$ergebnis}}
<p>
{{$LDGeneralSettingsHeading}}
</font>
<p>

<br>

<form {{$sFormAction}} method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>

<tr>
		<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDGeneralSettingsPID}}</b> </FONT></td>
		<td><input name="identificationNr" type="radio" value="PID" {{$checkPID}} /></td>

</tr>
<tr>
		<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDGeneralSettingsHospFileNr}}</b>
		<td><input name="identificationNr" type="radio" value="HospFileNr" {{$checkHospFileNr}} /></td>
</tr>

</table>
<br>
<p>
{{$sSave}}&nbsp;&nbsp;&nbsp;&nbsp;{{$sCancel}}
</form>