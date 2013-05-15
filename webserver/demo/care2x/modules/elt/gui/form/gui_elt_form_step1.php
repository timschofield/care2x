<script type='text/javascript'>
function setSelect()
{
	if(document.form.typ.value=="2")
	{
			document.getElementById('sql').style.visibility='visible';
			document.getElementById('exe').style.visibility='visible';
			document.getElementById('con').style.visibility='hidden';
	}
	if(document.form.typ.value=="1")
	{
			document.getElementById('sql').style.visibility='hidden';
			document.getElementById('exe').style.visibility='hidden';
			document.getElementById('con').style.visibility='visible';
	}

}
function setStyle()
{
		document.getElementById('sql').style.visibility='hidden';
		document.getElementById('exe').style.visibility='hidden';
}
</script>
<body onload="setStyle();">
  <form action="" method="get" name="form">

  Quell:<br><br>

  Host:<input type="text" name="source_host" value="localhost" size="40" maxlength="40"/><br>
  User:<input type="text" name="source_user" value="root" size="40" maxlength="40"/><br>
  Password:<input type="text" name="source_password" value="" size="40" maxlength="40"/><br>
  DB-Name:<input type="text" name="source_dbname" value="caredb" size="40" maxlength="40"/><br>
  DB-Typ:<input type="text" name="source_dbtyp" value="mysql" size="40" maxlength="40"/><br>

  <br/>

  Ziel:<br><br>

  Host:<input type="text" name="des_host" value="localhost" size="40" maxlength="40"/><br>
  User:<input type="text" name="des_user" value="root" size="40" maxlength="40"/><br>
  Password:<input type="text" name="des_password" value="" size="40" maxlength="40"/><br>
  DB-Name:<input type="text" name="des_dbname" value="caredb" size="40" maxlength="40"/><br>
  DB-Typ:<input type="text" name="des_dbtyp" value="mysql" size="40" maxlength="40"/><br>
	<br><br>
  		ELT-Typ	<select name="typ" onchange="setSelect()">
	  				<option value="1"> Generate a new database query</option>
	  				<option value="2"> Load a exist database queryt</option>
	  			</select><br><br>
	  			<select id="sql" name="sqlscript">
	  				<option>testscript1</option>
	  				<option>testscript2</option>
				</select>

  <input type="hidden" name="activeTab" value="Step2"/>
  <input type="submit" id="exe" name="execute" value="Execute"/><br>
  <input type="submit" id="con" name="connect" value="Connect"/>


  </form>

</body>