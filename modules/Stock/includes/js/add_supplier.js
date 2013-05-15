
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
  action="process_supplier.php"
  submit();

  return true;
  }
  }
  }
