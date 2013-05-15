<script language="javascript">

function chkform(d) {
 
 var radio_choice = false;
 var radio_buttons = document.getElementsByName('unit_price');
 var radio_length = radio_buttons.length;
 
 for (counter = 0; counter < radio_buttons.length; counter++)
	{
		if(d.unit_price[counter].checked)
		{
		radio_choice = true;
		}

	}
	
  if (!radio_choice)
	{
	
	alert("Please enter Price Category");
	return false;

  }  
  else 
  
  return true;
  
}

</script>

<?php $billing_tz->Display_Header($LDSelectPricelist,'',''); ?>

<BODY bgcolor="#ffffff" link="#000066" alink="#cc0000" vlink="#000066" onLoad="javascript:setBallon('BallonTip','','');" >

<?php $billing_tz->Display_Headline('Select Pricelist', '', '','billing_create2.php','Billing :: Create Quotation'); ?>

<form name="form" method="get" action="billing_tz_quotation_create.php" onSubmit ="return chkform(this)">

<table align="center"><tr><td>
	<?php $bill_obj->ShowPriceList(); ?></td><tr><td align="center">
	<input type="submit" name="ok" value="Ok">
	<input type="hidden" name="namelast" value="<?php echo $_REQUEST['namelast']; ?>">
	<input type="hidden" name="patient" value="<?php echo $_REQUEST['patient']; ?>">
	<input type="hidden" name="namefirst" value="<?php echo $_REQUEST['namefirst']; ?>">
	<input type="hidden" name="countpres" value="<?php echo $_REQUEST['countpres']; ?>">
	<input type="hidden" name="countlab" value="<?php echo $_REQUEST['countlab']; ?>">
	<input type="hidden" name="encounter_nr" value="<?php echo $_REQUEST['encounter_nr']; ?>">
	<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"></td></tr>
</table>
</form>

<?php $billing_tz->Display_Footer('Select Pricelist', '', '','billing_create2.php','Billing :: Create Quotation'); ?>
		
<?php $billing_tz->Display_Credits(); ?>
