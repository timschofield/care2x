{{* pass_entry_mask.tpl  Password check entry template *}}
<!-- Begin Nedstat Basic code -->
<!-- Title: Care2x -->
<!-- URL: http://health.elct.org/care2x -->
<script language="JavaScript" type="text/javascript"
src="http://m1.nedstatbasic.net/basic.js">
</script>
<script language="JavaScript" type="text/javascript" >
<!--
  nedstatbasic("ACw1NwFtqur/nlJOPwNwBUxdOH+g", 0);
// -->
</script>
<noscript>
<a target="_blank"
href="http://www.nedstatbasic.net/stats?ACw1NwFtqur/nlJOPwNwBUxdOH+g"><img
src="http://m1.nedstatbasic.net/n?id=ACw1NwFtqur/nlJOPwNwBUxdOH+g"
border="0" width="18" height="18"
alt="Nedstat Basic - Free web site statistics
Personal homepage website counter"></a><br>
<a target="_blank" href="http://www.nedstatbasic.net/">Free counter</a>
</noscript>
<!-- End Nedstat Basic code -->

<!--<table width=100% border=0 cellpadding="0" cellspacing="0">-->

	{{* Any eventuall display content for the top part of the mask (sTopDisplayRow) must be packaged as a table row *}}
	{{$sTopDisplayRow}}

	<tr>
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

	<tr>
		<td class="passborder" width=1%></td>
		<td class="passbody">
			<p><br>
			<center>

			{{if $bShowErrorPrompt}}
				<table border=0>
					<tr>
						<td>{{$sMascotImg}}</td>
						<td align="center">{{$sErrorMsg}}</td>
					</tr>
				</table>
			{{/if}}

			<table border=0 cellpadding=0  cellspacing=0>
				<tr>
					{{$sMascotColumn}}
					<td valign=top>
						<table cellspacing=0 class="passmaskframe">
							<tr>
								<td>
									<table cellpadding=20 cellspacing=0 class="passmask">
										<tr>
											<td>

												<p>
												<FORM {{$sPassFormParams}}>
													<div class="prompt">
														{{$LDPwNeeded}}!<p>
													</div>
													<nobr>{{$LDUserPrompt}}:</nobr>
													<br>
													<INPUT type="text" name="userid" size="14" maxlength="25"> {{$sDemoLoginInfo}}<p>
													<nobr>{{$LDPwPrompt}}:<br>
													<INPUT type="password" name="keyword" size="14" maxlength="25"> {{$sDemoPasswordInfo}}

													{{* Do not move the sPassHiddenInputs outside of the <form></form> block *}}
													{{$sPassHiddenInputs}}

													</nobr><p>
													{{$sPassSubmitButton}}&nbsp;&nbsp;&nbsp;&nbsp;{{$sCancelButton}}
												</form>

											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

			<p><br>
			</center>

		</td>
		<td class="passborder">
			&nbsp;
			</td>
	</tr>

	<tr >
		<td class="passborder" colspan=3>&nbsp;</td>
	</tr>

</table>