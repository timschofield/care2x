{{* Template for admission input and data display *}}
{{* Files using this: *}}
{{* - /modules/registration_admission/aufnahme_start.php *}}
{{* - /modules/registration_admission/aufnahme_daten_zeigen.php *}}

	{{if $bSetAsForm}}
	<form method="post" action="{{$thisfile}}" name="aufnahmeform" onSubmit="return chkform(this)">
	{{/if}}

		<table border="0" cellspacing=1 cellpadding=0 width="100%">

		{{if $error}}
				<tr>
					<td colspan=4 class="warnprompt">
						<center>
						{{$sMascotImg}}
						{{$LDError}}
						</center>
					</td>
				</tr>
		{{/if}}

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
					<td  class="adm_item">
						{{$LDCaseNr}}
					</td>
					<td class="adm_input">
						{{$encounter_nr}}
						<br>
						{{$sEncBarcode}} {{$sHiddenBarcode}}
					</td>
					<td {{$sRowSpan}} align="center" class="photo_id">
						{{$img_source}}
					</td>
				</tr>

				<tr>
					<td  class="adm_item">
						{{$LDAdmitDate}}:
					</td>
					<td class="vi_data">
						{{$sAdmitDate}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
					{{$LDAdmitTime}}:
					</td>
					<td class="vi_data">
						{{$sAdmitTime}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDTitle}}:
					</td>
					<td class="vi_data">
						{{$title}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDLastName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_last}}</b>
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDFirstName}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$name_first}} &nbsp; {{$sCrossImg}}
					</td>
				</tr>

			{{if $name_2}}
				<tr>
					<td class="adm_item">
						{{$LDName2}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_2}}
					</td>
				</tr>
			{{/if}}

			{{if $name_3}}
				<tr>
					<td class="adm_item">
						{{$LDName3}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_3}}
					</td>
				</tr>
			{{/if}}

			{{if $name_middle}}
				<tr>
					<td class="adm_item">
						{{$LDNameMid}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$name_middle}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDBday}}:
					</td>
					<td bgcolor="#ffffee" class="vi_data">
						{{$sBdayDate}} &nbsp; {{$sCrossImg}} &nbsp; <font color="black">{{$sDeathDate}}</font>
					</td>
					<td bgcolor="#ffffee" class="vi_data"><b>
						{{$LDSex}}: {{$sSexType}}
					</td>
				</tr>

			{{if $LDBloodGroup}}
				<tr>
					<td class="adm_item">
						{{$LDBloodGroup}}:
					</td>
					<td class="vi_data" colspan=2>&nbsp;
						{{$blood_group}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDAddress}}:
					</td>
					<td colspan=2 class="vi_data">
						{{$addr_str}}  {{$addr_str_nr}}
						<br>
						{{$addr_zip}} {{$addr_citytown_name}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						<font color="red">{{$LDAdmitClass}}</font>:
					</td>
					<td colspan=2 class="vi_data">
						{{$sAdmitClassInput}}
					</td>
				</tr>
			{{if $LDWard}}
				<tr>
					<td class="adm_item">
						<font color="red">{{$LDWard}}</font>:
					</td>
					<td colspan=2 class="adm_input">
						{{$sWardInput}}
					</td>
				</tr>
			{{/if}}

				{{* done by d.r. from merotech
				<tr>
					<td class="adm_item">
						{{$LDDiagnosis}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_diagnosis}}
					</td>
				</tr>
				*}}
				<tr>
					<td class="adm_item">
						{{$LDRecBy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$registration_fee}}
					</td>
				</tr>

				<tr>
                                        <td class="adm_item">
                                                {{$LDAmbulance}}:
                                        </td>
                                        <td colspan=2 class="adm_input">
                                                {{$ambulance_fee}}
                                        </td>
                                </tr>
                               <tr>
                                        <td class="adm_item">
                                                {{$LDRefDoctor}}:
                                        </td>
                                        <td colspan=2 class="adm_input">
                                                {{$referral_doc}}
                                        </td>
                                </tr>
				<tr>
				  <td class="adm_item">&nbsp;</td>
				  <td colspan=2 class="adm_input">&nbsp;</td>
		 		 </tr>

				{{if $LDDepartment}}
                                <tr>
                                        <td class="adm_item">
                                                <font color="red">{{$LDDepartment}}</font>:
                                        </td>
                                        <td colspan=2 class="adm_input">
                                                {{$sDeptInput}}
                                        </td>
                                </tr>
	                        {{/if}}

				<tr>
					<td class="adm_item">
						{{$LDTherapy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$consultation_fee}}
					</td>
				</tr>
			{{if $LDWard}}
				<tr>
					<td class="adm_item">
						{{$LDServices}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$LDServicesLst}}
					</td>
				</tr>
			{{/if}}
				<tr>
                                  <td class="adm_item">&nbsp;</td>
                                  <td colspan=2 class="adm_input">&nbsp;</td>
                                 </tr>

				<tr>
					<td class="adm_item">
						{{$LDSpecials}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_notes}}
					</td>
				</tr>

				<tr>
					<td class="adm_item">
						{{$LDRefFrom}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$referrer_institution}}
					</td>
				</tr>

				<!-- The insurance class  -->
				{{* done by d.r. from merotech
				<tr>
					<td class="adm_item">
						{{$LDBillType}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sBillTypeInput}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDInsuranceNr}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$insurance_nr}}
					</td>
				</tr>
				<tr>
					<td class="adm_item">
						{{$LDInsuranceCo}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$insurance_firm_name}}
					</td>
				</tr>
				*}}
			{{if $LDCareServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDCareServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareServiceInput}} {{$LDFrom}} {{$sCSFromInput}} {{$LDTo}} {{$sCSToInput}} {{$sCSHidden}}
					</td>
				</tr>
			{{/if}}

			{{if $LDRoomServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDRoomServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareRoomInput}} {{$LDFrom}} {{$sRSFromInput}} {{$LDTo}} {{$sRSToInput}} {{$sRSHidden}}
					</td>
				</tr>
			{{/if}}

			{{if $LDAttDrServiceClass}}
				<tr>
					<td class="adm_item">
						{{$LDAttDrServiceClass}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$sCareDrInput}} {{$LDFrom}} {{$sDSFromInput}} {{$LDTo}} {{$sDSToInput}} {{$sDSHidden}}
					</td>
				</tr>
			{{/if}}

				<tr>
					<td class="adm_item">
						{{$LDAdmitBy}}:
					</td>
					<td colspan=2 class="adm_input">
						{{$encoder}}
					</td>
				</tr>

				{{$sHiddenInputs}}

				<tr>
					<td colspan="3">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						{{$pbCancel}}
					</td>
					<td align="right">
					{{* done by d.r. from merotech *}}	{{*{{$pbRefresh}} {{$pbRegData}}*}}&nbsp;
					</td>
					<td align="right">
						{{$pbSave}}
					</td>
				</tr>

		</table>

			{{$sErrorHidInputs}}
			{{$sUpdateHidInputs}}

	{{if $bSetAsForm}}
	</form>
	{{/if}}

	{{$sNewDataForm}}
	<p>
