<?php $bill_obj->Display_Header($LDBillingInsurance,'',''); ?>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066>

<?php $bill_obj->Display_Headline('','',$LDInsuranceCompaniesOverview, 'insurance_companies_overview.php', 'Administrative Companies :: Overview'); ?>


				
				<!-- Section if all companies (also hidden ones) should be visible or not -->
				<form method="post" name="ShowAllForm">
					<?php echo $LDShowAllQuestion;?>
					<input type="checkbox" name="ShowHiddenCompanies" Value="1" OnClick="document.ShowAllForm.submit();" <?if ($_POST['ShowHiddenCompanies']) echo "checked"?>>
				</form>
				<!-- End of Section to show all companies -->
				<p>
					<a href="insurance_company_tz_new.php"><?php echo $LDInsertCompany; ?></a>
				</p>
				<?php $insurance_tz->ShowInsuranceList(false,$_POST['ShowHiddenCompanies']); ?>
				<!-- Section if all companies (also hidden ones) should be visible or not -->
				<form method="post" name="ShowAllForm">
					<?php echo $LDShowAllQuestion;?>
					<input type="checkbox" name="ShowHiddenCompanies" Value="1" OnClick="document.ShowAllForm.submit();" <?if ($_POST['ShowHiddenCompanies']) echo "checked"?>>
				</form>
				<!-- End of Section to show all companies -->			
				<p>
				<a href="insurance_company_tz_new.php"><?php echo $LDInsertCompany; ?></a>
				</p>

<?php $bill_obj->Display_Footer('','',$LDInsuranceCompaniesOverview, 'insurance_companies_overview.php', 'Administrative Companies :: Overview'); ?>

<?php $bill_obj->Display_Credits(); ?>
