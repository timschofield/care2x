 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Add Supplier Details</title>
  <style type="text/css">
  <!--
  body,td,th {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #000000;
  }
  a:link {
  color: #000099;
  text-decoration: none;
  }
  a:visited {
  text-decoration: none;
  color: #000099;
  }
  a:hover {
  text-decoration: underline;
  background-color:#FFFF00;
  color: #990000;
  }
  a:active {
  text-decoration: none;
  color: #000099;
  }
  .wrapper {
  border: thin groove #CCCCCC;
  padding: 5px;
  width: 700px;
  }
  input {
  border: 1px solid #ABADB3;
  background-color: #FFFFFF;
  padding: 2px;
  }
  .lblCol {
  font-weight: bold;
  color: #990000;
  }
  -->
  </style>

  <script type="text/javascript" language="javascript">
  function submitForm()
  {
  var save;
  save=false;
  with(document.supplier){
  if(companyName.value==''){
  alert("Enter Company Name please");
  companyName.focus();
  return save;
  }
  if(contactPerson.value==''){
  alert("Enter Contact person`s Name please");
  contactPerson.focus();
  return save;
  }
  if(address1.value==''){
  alert("Enter Permanent Adderss please");
  address1.focus();
  return save;
  }
  if(address2.value==''){
  alert("Enter  Adderss wich should appear on order/purchase please");
  address2.focus();
  return save;
  }
  if(phone1.value==''){
  alert("Enter  Telephone number please");
  phone1.focus();
  return save;
  }
  if(cell1.value==''){
  alert("Enter  Mobile number please");
  cell1.focus();
  return save;
  }else{
  action="add_supplier.php"
  submit();

  return true;
  }
  }
  }
  </script>
  </head>

<body>
  <table width="90%" border="0" class="wrapper" align="left">
  <tr>
  <td>
  <div id="formBox">
  <h2>Enter Suppliers Details</h2>
  <hr />
  <form action="" method="post"  name="supplier" >
  <table width="100%" border="0" cellspacing="6" cellpadding="5">
  <tr>
  <td width="16%" class="lblCol">Company Name:</td>
  <td width="84%"><input type="text" name="companyName"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Contact Person:</td>
  <td><input type="text" name="contactPerson"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Permanent Address :</td>
  <td><textarea  name="address1" cols="50" rows="3"  /></textarea></td>
  </tr>
   <tr>
  <td class="lblCol">Address to appear on Order/Purchase:</td>
  <td><textarea  name="address2" cols="50" rows="3"   /></textarea></td>
  </tr>
  <tr>
  <td class="lblCol">Telephone number 1:</td>
  <td><input type="text" name="phone1"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Telephone number 2:</td>
  <td><input type="text" name="phone2"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Mobile number 1:</td>
  <td><input type="text" name="cell1"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Mobile number 2:</td>
  <td><input type="text" name="cell2"   /></td>
  </tr>
  <tr>
  <td class="lblCol">Email Address:</td>
  <td><input type="text" name="emailAddress"  /></label></td>
  </tr>
  <tr>
  <td class="lblCol">Fax:</td>
  <td><input name="fax" type="text"    />
  </td>
  </tr>
  <tr>
  <td class="lblCol">Banker:</td>
  <td><input name="banker" type="text"    /></td>
  </tr>
<tr>
  <td class="lblCol">Bank Details:</td>
  <td><input name="bankDetails" type="text"    /></td>
  </tr>
<tr>
  <td class="lblCol">Account Number:</td>
  <td><input name="accountNumber" type="text"    /></td>
  </tr>
  <tr>

  <td class="lblCol">Credit Limit:</td>
  <td><input name="creditLimit" type="text"    /></td>

  </tr>
<tr>
  <td class="lblCol">Credit Period:</td>
  <td><input name="creditPeriod" type="text"    /></td>
  </tr>
  <tr>
  <td colspan="2">
  <div id="notifier" align="center" style="display:block">
  <input type="submit" name="addsupplier" id="submit" value="Add New" onclick="return submitForm();" />
  </div>
  </td>
  </tr>
  </table>
  </form>
  </div>
  </td>
  </tr>
  </table>
  </body>
  </html>
