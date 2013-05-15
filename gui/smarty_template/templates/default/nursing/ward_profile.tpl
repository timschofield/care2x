{{* ward_profile.tpl  Showing ward profile 2004-06-28 Elpidio Latorilla *}}


<form action="nursing-station-info.php" method="post" onSubmit="return check(this)">

<ul>
<table>
  <tbody>
    <tr>
      <td class="adm_item">{{$LDStation}}</td>
      <td class="adm_input" colspan="2">{{$name}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDWard_ID}}</td>
      <!--<td class="adm_input"><textarea name="nr" cols=4 rows=1 wrap="physical">{{$ward_id}}</textarea></td>-->
      <td class="adm_input" colspan="2">{{$ward_id}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDDept}}</td>
      <td class="adm_input" colspan="2">{{$dept_name}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDDescription}}</td>
      <td class="adm_input"><textarea name="description" cols=40 rows=8 wrap="physical">{{$description}}</textarea></td>
      <!--<td class="adm_input" colspan="2">{{$description}}</td>-->
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoom1Nr}}</td>
      <td class="adm_input"><textarea name="room_nr_start" cols=4 rows=1 wrap="physical">{{$room_nr_start}}</textarea></td>
      <!--<td class="adm_input" colspan="2">{{$room_nr_start}}</td>-->
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoom2Nr}}</td>
      <td class="adm_input"><textarea name="room_nr_end" cols=4 rows=1 wrap="physical">{{$room_nr_end}}</textarea></td>
      <!--<td class="adm_input" colspan="2">{{$room_nr_end}}</td>-->
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoomPrefix}}</td>
      <td class="adm_input"><textarea name="roomprefix" cols=4 rows=1 wrap="physical">{{$roomprefix}}</textarea></td>
      <!--<td class="adm_input" colspan="2">{{$roomprefix}}</td>-->
    </tr>
   <tr>
      <td class="adm_item">{{$LDCreatedOn}}</td>
      <td class="adm_input" colspan="2">{{$date_create}}</td>
    </tr>
   <tr>
      <td class="adm_item">{{$LDCreatedBy}}</td>
      <td class="adm_input" colspan="2">{{$create_id}}</td>
    </tr>

  {{if $bShowRooms}}
   <tr>
      <td class="adm_item" colspan="3">&nbsp;</td>
    </tr>
   <tr  class="wardlisttitlerow">
      <td>{{$LDRoom}}</td>
      <td>{{$LDBedNr}}</td>
      <td>{{$LDRoomShortDescription}}</td>
    </tr>

	{{$sRoomRows}}

  {{/if}}

  </tbody>
</table>
<p>
<input type="hidden" name="roomCount" value="{{$roomCount}}">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="nr" value="{{$ward_descr}}">
<input type="submit" value="save">

</form>
<table width="100%">
  <tbody>
  	<tr valign="top">
  	  <td>{{$sClose}}</td>
      <td align="right">{{$sWardClosure}}</td>
    </tr>
  </tbody>
</table>
</form>
</ul>