<?php /* Smarty version 2.6.0, created on 2009-03-03 19:19:01
         compiled from registration_admission/reg_form.tpl */ ?>
				<?php echo $this->_tpl_vars['sRegFormJavaScript']; ?>


				<?php if ($this->_tpl_vars['error'] || $this->_tpl_vars['errorDupPerson']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "registration_admission/reg_error_duplicate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

				<?php echo $this->_tpl_vars['pretext']; ?>


		<?php if ($this->_tpl_vars['bSetAsForm']): ?>
		<form method="post" action="<?php echo $this->_tpl_vars['thisfile']; ?>
" name="aufnahmeform" ENCTYPE="multipart/form-data" onSubmit="return chkform(this)">
		<?php endif; ?>

		<table border=0 cellspacing=0 cellpadding=0 <?php echo $this->_tpl_vars['sFormWidth']; ?>
>
				<tr>
					<td class="reg_item">
						<?php echo $this->_tpl_vars['LDRegistryNr']; ?>

					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['pid']; ?>

						<br>
						<?php echo $this->_tpl_vars['sBarcodeImg']; ?>

					</td>
					<td <?php echo $this->_tpl_vars['sPicTdRowSpan']; ?>
 class="photo_id" align="center">
						<a href="#"  onClick="showpic(document.aufnahmeform.photo_filename)"><img <?php echo $this->_tpl_vars['img_source']; ?>
 name="headpic"></a>
						<br>
						<?php echo $this->_tpl_vars['LDPhoto']; ?>

						<br>
						<?php echo $this->_tpl_vars['sFileBrowserInput']; ?>

					</td>
				</tr>
				<?php echo $this->_tpl_vars['sFileNr']; ?>

				<tr>
					<td  class="reg_item">
						<?php echo $this->_tpl_vars['LDRegDate']; ?>

					</td>
					<td class="reg_input">
						<FONT color="#800000">
						<?php echo $this->_tpl_vars['sRegDate']; ?>

					</td>
				</tr>

				<tr>
					<td  class="reg_item">
						<?php echo $this->_tpl_vars['LDRegTime']; ?>

					</td>
					<td class="reg_input">
						<FONT color="#800000">
						<?php echo $this->_tpl_vars['sRegTime']; ?>

					</td>
				</tr>

				

				<?php echo $this->_tpl_vars['sPersonTitle']; ?>

				<?php echo $this->_tpl_vars['sNameLast']; ?>

				<?php echo $this->_tpl_vars['sNameFirst']; ?>

				<?php echo $this->_tpl_vars['sName2']; ?>

				<?php echo $this->_tpl_vars['sName3']; ?>

				<?php echo $this->_tpl_vars['sNameMiddle']; ?>

    			<?php if ($this->_tpl_vars['bShowTribeSelection']): ?>
    					    					<tr>
    					  <td class="reg_item">
    					    <?php echo $this->_tpl_vars['sNameTribe']; ?>

   					    </td>
        					  <td class="reg_input">
        					    <?php echo $this->_tpl_vars['sTribeSelect']; ?>

        				</td>
        			  </td>
    					</tr>

    				<?php else: ?>
    				  <?php echo $this->_tpl_vars['sNameTribe']; ?>

    				<?php endif; ?>

    					<tr>
    					  <td class="reg_item" valign=top class="reg_input">
            		<?php echo $this->_tpl_vars['sTownCity']; ?>

            		<td colspan=2 class="reg_input">
        		    <?php echo $this->_tpl_vars['sTownCitySelect']; ?>

        		    </td>
            		</td>
            	</tr>
				<?php echo $this->_tpl_vars['sNameOthers']; ?>


				<tr>
					<td class="reg_item">
						<?php echo $this->_tpl_vars['LDBday']; ?>

					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['sBdayInput']; ?>
&nbsp;<?php echo $this->_tpl_vars['sCrossImg']; ?>
 <?php echo $this->_tpl_vars['sDeathDate']; ?>

					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['LDSex']; ?>
 <?php echo $this->_tpl_vars['sSexM']; ?>
 <?php echo $this->_tpl_vars['LDMale']; ?>
&nbsp;&nbsp; <?php echo $this->_tpl_vars['sSexF']; ?>
 <?php echo $this->_tpl_vars['LDFemale']; ?>

					</td>
				</tr>

			<?php if ($this->_tpl_vars['LDBloodGroup']): ?>
				<tr>
				<td class="reg_item">
					<?php echo $this->_tpl_vars['LDBloodGroup']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sBGAInput'];  echo $this->_tpl_vars['LDA']; ?>
  &nbsp;&nbsp; <?php echo $this->_tpl_vars['sBGBInput'];  echo $this->_tpl_vars['LDB']; ?>
 &nbsp;&nbsp; <?php echo $this->_tpl_vars['sBGABInput'];  echo $this->_tpl_vars['LDAB']; ?>
  &nbsp;&nbsp; <?php echo $this->_tpl_vars['sBGOInput'];  echo $this->_tpl_vars['LDO']; ?>

          &nbsp;&nbsp;
					| <?php echo $this->_tpl_vars['RHfactor']; ?>
 <?php echo $this->_tpl_vars['sBRHposInput'];  echo $this->_tpl_vars['RHpos']; ?>
  &nbsp;&nbsp; <?php echo $this->_tpl_vars['sBRHnegInput'];  echo $this->_tpl_vars['RHneg']; ?>

					<br>
				</td>
				</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['LDCivilStatus']): ?>
				<tr>
				<td class="reg_item">
					<?php echo $this->_tpl_vars['LDCivilStatus']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sCSSingleInput'];  echo $this->_tpl_vars['LDSingle']; ?>
  &nbsp;&nbsp;
					<?php echo $this->_tpl_vars['sCSMarriedInput'];  echo $this->_tpl_vars['LDMarried']; ?>
 &nbsp;&nbsp;
					<?php echo $this->_tpl_vars['sCSDivorcedInput'];  echo $this->_tpl_vars['LDDivorced']; ?>
  &nbsp;&nbsp;
					<?php echo $this->_tpl_vars['sCSWidowedInput'];  echo $this->_tpl_vars['LDWidowed']; ?>
 &nbsp;&nbsp;
					<?php echo $this->_tpl_vars['sCSSeparatedInput'];  echo $this->_tpl_vars['LDSeparated']; ?>

				</td>
				</tr>
			<?php endif; ?>

				<tr>
				<td colspan=3>
				  <br>
					<?php echo $this->_tpl_vars['LDAddress']; ?>

				</td>
				</tr>

				<tr>
					<td>
						&nbsp;
					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['sStreetInput']; ?>

					</td>
					<td class="reg_input">
						 &nbsp;&nbsp; 					</td>
				</tr>

				<tr>
					<td class="reg_item">
						<?php echo $this->_tpl_vars['LDTownCity']; ?>

					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['sTownCityInput']; ?>
 <?php echo $this->_tpl_vars['sTownCityMiniCalendar']; ?>

					</td>
					<td class="reg_input">
						&nbsp;&nbsp;
					</td>
				</tr>

				<tr>
					<td class="reg_item">
						<?php echo $this->_tpl_vars['LDTribe']; ?>

					</td>
					<td class="reg_input">
						<?php echo $this->_tpl_vars['sTribe']; ?>
 &nbsp;
					</td>
					<td class="reg_input">
						&nbsp;&nbsp;
					</td>
				</tr>

				<tr>
				</tr>

			<?php if ($this->_tpl_vars['bShowInsurance']): ?>

				<?php echo $this->_tpl_vars['sInsuranceNr']; ?>


				<tr>
				<td>
					&nbsp;
				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sErrorInsClass']; ?>

					<?php if (count($_from = (array)$this->_tpl_vars['sInsClasses'])):
    foreach ($_from as $this->_tpl_vars['InsClass']):
?>
						<?php echo $this->_tpl_vars['InsClass']; ?>

					<?php endforeach; unset($_from); endif; ?>
				</td>
				</tr>

				<tr>
				<td class="reg_item">
					<?php echo $this->_tpl_vars['LDInsuranceCo']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sInsCoNameInput']; ?>
 <?php echo $this->_tpl_vars['sInsCoMiniCalendar']; ?>

				</td>
				</tr>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['bNoInsurance']): ?>
				<tr>
				<td>
					&nbsp;
				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['LDSeveralInsurances']; ?>

				</td>
				</tr>
			<?php endif; ?>
								<?php echo $this->_tpl_vars['sPhone1']; ?>

				<?php echo $this->_tpl_vars['sPhone2']; ?>

				<?php echo $this->_tpl_vars['sCellPhone1']; ?>

				<?php echo $this->_tpl_vars['sCellPhone2']; ?>

				<?php echo $this->_tpl_vars['sFax']; ?>

				<?php echo $this->_tpl_vars['sEmail']; ?>

				<?php echo $this->_tpl_vars['sCitizenship']; ?>

				<?php echo $this->_tpl_vars['sSSSNr']; ?>

				<?php echo $this->_tpl_vars['sNatIdNr']; ?>

				<?php echo $this->_tpl_vars['sReligion']; ?>


				<tr>
				<td class="reg_item">
					<?php echo $this->_tpl_vars['LDEthnicOrig']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sEthnicOrigInput']; ?>
 <?php echo $this->_tpl_vars['sEthnicOrigMiniCalendar']; ?>

				</td>
			</tr>

			<?php if ($this->_tpl_vars['bShowOtherHospNr']): ?>
				<tr>
				<td class="reg_item" valign=top class="reg_input">
					<?php echo $this->_tpl_vars['LDOtherHospitalNr']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sOtherNr']; ?>

					<?php echo $this->_tpl_vars['sOtherNrSelect']; ?>

				</td>
				</tr>
				<?php endif; ?>

				<tr>
				<td class="reg_item">
					<?php echo $this->_tpl_vars['LDRegBy']; ?>

				</td>
				<td colspan=2 class="reg_input">
					<?php echo $this->_tpl_vars['sRegByInput']; ?>

				</td>
			</tr>
		</table>

		<?php echo $this->_tpl_vars['sHiddenInputs']; ?>

		<?php echo $this->_tpl_vars['sUpdateHiddenInputs']; ?>

		<p>
		<?php echo $this->_tpl_vars['pbSubmit']; ?>
 &nbsp;&nbsp; <?php echo $this->_tpl_vars['pbReset']; ?>
 <?php echo $this->_tpl_vars['pbForceSave']; ?>


		<?php if ($this->_tpl_vars['bSetAsForm']): ?>
		</form>
		<?php endif; ?>

		<?php echo $this->_tpl_vars['sNewDataForm']; ?>
