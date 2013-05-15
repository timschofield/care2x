<?php $insurance_tz->Display_Header(); ?>


<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >


<script language="javascript">
<!--
function saveData()
{
    document.forms["inputform"].submit();
}
function reset()
{
    document.forms["inputform"].submit();
}
-->
</script>

<link rel="StyleSheet" href="dtree.css" type="text/css" />
<script type="text/javascript" src="dtree.js"></script>


<?php $insurance_tz->Display_Headline($LDManageInsurances,'',''); ?>
<br>
		<table cellpadding=20>
		<tr valign=top>

		<!-- left side (list of insurances) -->
		<td>
			
		<form method="GET" name="inputform" action="<?php echo $root_path?>modules/billing_tz/insurance_company_tz_manage.php" method="POST">
			<table cellpadding=5 ><font color=#000000>
				<tr>
					<td bgcolor=#FFFFFF><input type="submit" name="toggle" value="toggle active/inactive insurances"/></td>
				</tr>
			<?php if ($status)
					{
						$colorText = "#ff0000";
						$text = "Deleted Insurances";
					}
					else{
						$colorText = "#ffff66";
						$text = "Active Insurances";
					}
			?>

			<th bgcolor=<?php echo $colorText.'>'.$text.'</th>'?>
			<?php

			/* The following routine creates the list of insurances on the left side:  */

			require($root_path.'include/inc_insurance_lister.php');

			?>

			</table>

		</td>
		<!-- right side (form) -->
		<td valign="top">
		<table>

		<?php
		if ($insuranceExists || $noInsuranceName)
		{
			$color = '#FF0000';
		}
		else $color = '#000000';

		echo '<tr><td><h3>Edit ' .$name. ':</h3></td><td align="right">';
		if (!$status)
			{
				echo '<input height="21" border="0" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_newpat2.gif"/>';
			}
		echo '</td></tr><tr><td><font color='.$color.'>'.$LDInsurance.':</td>';?>
		<td><input type="text" name="name" size="30" maxlength="60" value="<?php echo $name?>"></td></tr>

		<tr></tr>
		<?php
			if ($insuranceParentSame)
			{
				$color = '#FF0000';
			}
			else $color = '#000000';
		echo '<tr><td><font color='.$color.'>'.$LDParent_Insurer?>
		</td><td>
		<?php

			echo '<SELECT name="id_insurer">';
			echo '<OPTION value="-1" >--select insurance--</OPTION>';

			foreach($name_insurer_array_all as $row)
			{
				$mark = '';

				if($id_insurer == $row[insurance_ID])
					$check = 'selected';
				else
					$check = '';

				if ($row[deleted] == 1)
					$markOn = ' (del)';

				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].$markOn.'</OPTION></i>';

			}

			echo '</SELECT>'; ?>

		</td></tr>

		<tr>
		<?php
			if ($wrong_max_pay)
			{
				$color = '#FF0000';
			}
			else $color = '#000000';


		echo '<td><font color='.$color.'>'.$LDInsurance_Limit?></td><td><input type="text" name="max_pay" size="10" maxlength="10" value="<?php echo $max_pay?>"><?php echo $LDPerPerson?></td>
		</tr>
		<tr><td><?php echo $LDContactPerson.':'?></td><td><input type="text" name="contact_person" size="30" maxlength="60" value="<?php echo $contact_person?>"></td></tr>
		<tr><td><?php echo $LDPOBOX.':'?></td><td><input type="text" name="po_box" size="30" maxlength="50" value="<?php echo $po_box?>"></td></tr>
		<tr><td><?php echo $LDCity?></td><td><input type="text" name="city" size="30" maxlength="60" value="<?php echo $city?>"></td></tr>
		<tr><td><?php echo $LDPhone.':'?></td><td><input type="text" name="phone" size="30" maxlength="60" value="<?php echo $phone?>"></td></tr>
		<tr><td><?php echo $LDEmail.':'?></td><td><input type="text" name="email" size="30" maxlength="60" value="<?php echo $email?>"></td></tr>

		<?php	if ($insuranceExists )
				{
					$errorMess = 'Insurance name already exists.';

				}else if ($noInsuranceName)
						{
							$errorMess = 'Please insert insurance name.';

						}else if ($insuranceParentSame)
								{
									$errorMess = 'Parent insurer and insurer can not be the same.';
								}
								else if ($wrong_max_pay)
								{
									$errorMess = 'Please insert valid amount';
								}
		?>
		<tr><td>&nbsp;</td></tr>
		<tr><td colspan=2><font color=#FF0000><?php echo $errorMess?>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>

		<tr><td>
			</td><td align="right">
  			<input height="21" border="0"  width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>
			<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="insurance_tz.php?ntid=false&lang=$lang"><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>-->
		</td></tr>
		<tr><td>&nbsp;</td></tr>


		<th bgcolor=#ffff66 colspan=2 ><?php echo $LDRelationshipsInsurances?></th>
		<tr bgcolor=#ffffaa><td colspan=2>

		<!-- start of block "insurance tree" -->

<div class="dtree">

	<p><a href="javascript: d.openAll();">open all</a> | <a href="javascript: d.closeAll();">close all</a></p>

	<script type="text/javascript">
		<!--

		d = new dTree('d');
		d.config.inOrder = false;
		d.config.useSelection = false;
		d.add(0,-1,'Overview parent insurers');
		<?php

			require_once($root_path.'include/care_api_classes/class_tz_insurance.php');


			global $db;
			$coreObj = new Insurance_tz;
			$name_array = $name_insurer_array_all;


			foreach($name_array as $rowOuter)
			{
				//innerer Einschub:

				$sql="SELECT *  FROM care_tz_insurances_admin where insurance_ID = ".$rowOuter['insurance_ID'].';';

				$resultInner = $db->Execute($sql);

				$rowInner=$resultInner->FetchRow();


				$link =$root_path."modules/billing_tz/insurance_company_tz_manage.php".URL_APPEND."&insurance_ID" .
				"=".$rowInner['insurance_ID']."&name=".$rowInner['name']."&id_insurer=".$rowInner['insurer']."&max_pay=".$rowInner['max_pay']."&status=".$status."&contact_person" .
				"=".$rowInner['contact_person']."&po_box=".$rowInner['po_box']."&city=".$rowInner['city']."&phone=".$rowInner['phone']."&email=".$rowInner['email'];

				if ($status == '')
				{
					$status = 0;
				}

				if ($status!=$rowInner['deleted'])
					$link.="&treeLink='toggle from tree'";

				if ($rowInner['deleted'])
				{
					$name = $rowOuter['name']." (del)";
				}
				else
				{
					$name = $rowOuter['name'];
				}



				$parentNode = $rowOuter['id_insurer'];
				if ($parentNode == -1)
				{
					$parentNode = 0;
				}



				echo 'd.add('.$rowOuter['insurance_ID'].','.$parentNode.', "'.$name.'", "'.$link.'");';


			}
		?>



		document.write(d);

		//-->
	</script>

</div>



		<!-- end of block "insurance tree" -->
		</td></tr>
		<tr><td>&nbsp;</td></tr>


		<?php //DELETE (active insurances)
		if (!$status){

			echo '<tr bgcolor=#FFFFFF> <td colspan=2><SELECT name="delete">';
			echo '<OPTION value="-1" selected>--select insurance--</OPTION>';

			foreach($name_insurer_array_act as $row)
			{
				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].'</OPTION>';
			}

			echo '</SELECT>';
			echo '<input type="submit" name="deletebutton" value="delete insurance" onClick="return confirm(\'Are You sure you want to delete?\')"/>';
			
		}

		else //REACTIVATE (deleted insurances)
		{
			echo '<tr bgcolor=#FFFFFF> <td colspan=2><SELECT name="reactivate">';
			echo '<OPTION value="-1" selected>--select insurance--</OPTION>';

			foreach($name_insurer_array_del as $row)
			{
				echo '<OPTION value="'.$row[insurance_ID].'" '.$check.'>'.$row[name].'</OPTION>';
			}

			echo '</SELECT>';
			echo '<input type="submit" name="reactivatebutton" value="reactivate"/>';
			
		}

		?></td>
		</tr>

		</table>
		<input type="hidden" name="insurance_ID" value=<?php echo $insurance_ID?>>
		<input type="hidden" name="status" value="<?php echo $status?>">

		<input type="hidden" name="name_old" value='<?php echo $name?>'>
		<input type="hidden" name="max_pay_old" value=<?php echo $max_pay?>>
		<input type="hidden" name="id_insurer_old" value=<?php echo $id_insurer?>>

		<input type="hidden" name="contact_person_old" value='<?php echo $contact_person?>'>
		<input type="hidden" name="po_box_old" value='<?php echo $po_box?>'>
		<input type="hidden" name="city_old" value='<?php echo $city?>'>
		<input type="hidden" name="phone_old" value='<?php echo $phone?>'>
		<input type="hidden" name="email_old" value='<?php echo $email?>'>
		</td>

		</tr>

		</table>
			<!--<?php if (!$status)
			{
				echo '<input height="21" border="0" align="absmiddle" width="76" type="image" name="clear" value="clear" onClick="reset()" alt="clear" src="../../gui/img/control/blue_aqua/en/en_newpat2.gif"/><br><br>';
			}
			else
				echo '<br><br>';
			?>

  			<input height="21" border="0" align="absmiddle" width="76" type="image" name="save" value="save" onClick="saveData()" alt="Save data" src="../../gui/img/control/blue_aqua/en/en_savedisc.gif"/>

			</p>
			<a href="insurance_tz.php?ntid=false&lang=$lang"><img src="../../gui/img/control/blue_aqua/en/en_close2.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>-->

		</form>
		</blockquote>
		</td>

	</tr>
</table>

<?php $insurance_tz->Display_Footer($LDManageInsurances, '', ''); ?>

<?php $insurance_tz->Display_Credits(); ?>
