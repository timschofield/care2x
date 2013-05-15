
							<label><?php echo $LDDate; ?>

							</label>

						      <input name="selected_date" type="text" size=10 maxlength=10  value="<?php if(empty($selected_date)) 
 echo @formatdate2Local(date('Y-m-d'),$date_format); else echo @formatDate2Local($selected_date,$date_format);  ?>"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" 
onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
							  <a href="javascript:show_calendar('form1.selected_date','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a><font size=1>[<?php
			$dfbuffer="LD_".strtr($date_format,".-/","phs");
			echo $$dfbuffer;
			?>]			 

							<label><?php echo $LDAdmitType; ?>

                                                <?php echo '<SELECT name="admission_id">';

                                                echo '<OPTION selected value="0" >All</OPTION>';
                                                echo '<OPTION value="2">Outpatient</OPTION>';
                                                echo '<OPTION value="1">Inpatient</OPTION>';

                                                echo '</SELECT>';
                                                ?>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                        
                                                        <label><?php echo $LDBillType; ?>

                                                <?php echo '<SELECT name="bill_type">';

                                                echo '<OPTION selected value="0" >All</OPTION>';
                                                echo '<OPTION value="1">Cash</OPTION>';
                                                echo '<OPTION value="2">Credit</OPTION>';

                                                echo '</SELECT>';
                                                ?>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>

 
							<label>
								<input type="submit" name="show" value="<?php echo $LDShow; ?>">
							</label>
				
