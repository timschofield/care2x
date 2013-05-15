
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/checkdate.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/dtpick_care2x.js"></script>
<script src="<?php print $root_path; ?>/include/_jquery.js" language="javascript"></script> 
						
			
							<label><?php echo $LDDate; ?>

							</label>

						      <input name="selected_date" type="text" size=10 maxlength=10  value="<?php if(!empty($selected_date)) 
 echo @formatDate2Local($selected_date,$date_format);  ?>"  onBlur="IsValidDate(this,'<?php echo $date_format ?>')" 
onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
							  <a href="javascript:show_calendar('form1.selected_date','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a><font size=1>[<?php
			$dfbuffer="LD_".strtr($date_format,".-/","phs");
			echo $$dfbuffer;
			?>]			 


 
							<label>
								<input type="submit" name="show" value="<?php echo $LDShow; ?>">
							</label>
				
