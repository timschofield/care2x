<?php


include('roots.php');
include($root_path.'classes/adodb/adodb.inc.php');	 # load code common to ADOdb
include('config.php');

$tables_name_of_des=&$conn_des->Execute('show tables from '.$des_dbname.'');
$c = &$conn_des;
echo "constructor:"; print_r(get_object_vars($c));
?>
<script type='text/javascript'>

function setValues(){
	document.form.sql_.value="<?php echo $_REQUEST['sql_']; ?>";
	if(document.form.sql_.value=="")
	{
		document.form.join.disabled=true;
	}
}

function makeSQL()
{
	for (var i=0;i<document.form.tables_name.options.length;i++)
	{
		if (document.form.tables_name.options[i].selected==true)
		document.form.sql_.value="select * from "+document.form.tables_name.options[i].value;
	}
	document.form.join.disabled=false;
}

function joinTable()
{
	for (var i=0;i<document.form.tables_name.options.length;i++)
	{
		if (document.form.tables_name.options[i].selected==true)
		document.form.sql_.value=document.form.sql.value + "\ninner join "+document.form.tables_name.options[i].value+" on ";
	}
}

function Link(x)
{
<?php
/*$t=$_REQUEST['anz_source_fields'];
$g=$_REQUEST['anz_des_fields'];

if($t != $g)
{
	echo "alert('Number of Columns is unequal');";
}
else*/
{
	echo 'Ziel1 = ("gui_elt.php?");';
	echo 'Ziel1 = Ziel1+x+"";';
	echo 'window.location.href = Ziel1;';
}
?>

}

</script>
<link rel="stylesheet" type="text/css" href="form/style.css">

<body onload="setValues();">
<form name="form" methode="get" action="gui_elt.php">
<table border="1" width="100%" height="50%" id="centeredtable">
	<tr>
		<td valign="top">
			<select name="tables_name" size=50% multiple onchange="makeSQL()">
			<?php
				while($name=$tables_name_of_des->FetchRow())
				{
					echo '<option>'.$name['Tables_in_'.$des_dbname.''].'</option>';
				}
			?>

			</select>
		</td>
		<td valign="top" width="100%">
		<table border=0 height="100%" width="100%" id="centeredtable" >
			<tr>
			<td valign="top" height="28%" align="center" bgcolor="#c0bbb2">
				 SQL-Statment<br>
				  <textarea id="txtarea" name="sql_" rows="10" cols="80">
				  </textarea><br/>
	  		      <input type="submit" name="ok" value="Ok"/>
			</td>
			</tr>
			<tr>
				<td width="100%" height="100%" bgcolor="#c0bbb2" valign="top" width="95%">
<?php
	$sql=$_GET['sql_'];
	$index = strpos($sql, "from");
	$index=$index+5;
    $table= substr($sql,$index,strlen($sql));
?>
<hr>
Destination: <?php echo $table ?>
<hr>
<?php $des_table=$table; ?>
<div style="width:100%; height:30%; overflow:scroll; border:1px  ; background-color:white;" >

  <table border=1 id="centeredtable" >

    <?php

    if($table!="")
    {

		$test=&$conn_des->Execute('show fields from '.$table.'');
		if(strpos($sql, "*"))
		{
			echo '<tr id="firstline">';
			$i=0;
		    while($fields=$test->FetchRow())
		    {
		    	echo '<td bgcolor="lightgray"><font size=2>'.$fields['Field'].'</font></td>';
		    	$field_names[$i]=$fields['Field'];
		    	$i++;
		    }
			echo '</tr>';
		}
	else
		{
			echo '<tr>';
			$a=strpos($sql,"select")+7;
			$b=strpos($sql,"from")-$a-1;
			$string = substr($sql,$a,$b);
			$fields_s=$string;
			echo '<input type="hidden" name="tables" value="'.$string.'">';
			$tok = strtok($string, ",");
			$i=0;
			while ($tok !== false) {
			    echo '<td bgcolor="lightgray"><font size=2>'.$tok.'</font></td>';
			    $field_names[$i]=str_replace(' ', '',$tok);
		    	$i++;
		    	$tok = strtok(",");
			}
			echo '</tr>';

		}


	    $test2=&$conn_des->Execute(''.$sql.' limit 0,10');

		while($fields_content=$test2->FetchRow())
		{
			echo '<tr>';

				foreach($field_names as $field_name)
				{
					if(strlen($fields_content[$field_name])<=10)
					{
						echo '<td><font size=2>'.$fields_content[''.$field_name.''].'</font></td>';
					}
					else
					{
						echo '<td><font size=2>'.substr($fields_content[$field_name],0,10).'...</font></td>';
					}
				}
			echo '</tr>';
		}
	echo '<input type="hidden" name="anz_des_fields" value="'.$i.'">';
    }
     ?>
  </table>
</div>

<?php
   // $conn_des->Close();
   //	$conn_source->PConnect($source_host, $source_user, $source_password, $source_dbname);
	$tables_name_of_source=$conn_source->Execute('show tables from '.$source_dbname.'');

	$sql=$_GET['sql'];
	$index = strpos($sql, "from");
	$index=$index+5;
    $table= substr($sql,$index,strlen($sql));
 ?>
<hr>
Source: <?php echo $table ?>
<hr>
<?php $source_table=$table; ?>
<div style="width:100%; height:30%; overflow:scroll; border:1px solid ; background-color:white;" >

  <table border=1 id="centeredtable" >

    <?php

    if($table!="")
    {
	    $test=&$conn_source->Execute('show fields from '.$table.'');
		if(strpos($sql, "*"))
		{
			echo '<tr id="firstline">';
			$i=0;
		    while($fields=$test->FetchRow())
		    {
		    	echo '<td bgcolor="lightgray"><font size=2>'.$fields['Field'].'</font></td>';
		    	$field_names[$i]=$fields['Field'];
		    	$i++;
		    }
			echo '<input type="hidden" name="anz_source_fields" value="'.$i.'">';
			echo '</tr>';

		}
	else
		{
			echo '<tr>';
			$a=strpos($sql,"select")+7;
			$b=strpos($sql,"from")-$a-1;
			$string = substr($sql,$a,$b);
			$tok = strtok($string, ",");
			$i=0;
			while ($tok !== false) {
			    echo '<td bgcolor="lightgray"><font size=2>'.$tok.'</font></td>';
			    $field_names[$i]=str_replace(' ', '',$tok);
		    	$i++;
		    	$tok = strtok(",");
			}
			echo '<input type="hidden" name="anz_source_fields" value="'.$i.'">';
			echo '</tr>';

		}


	    $test2=&$conn_source->Execute(''.$sql.' limit 0,10');

		while($fields_content=$test2->FetchRow())
		{
			echo '<tr>';

				foreach($field_names as $field_name)
				{
					if(strlen($fields_content[$field_name])<=10)
					{
						echo '<td><font size=2>'.$fields_content[''.$field_name.''].'</font></td>';
					}
					else
					{
						echo '<td><font size=2>'.substr($fields_content[$field_name],0,10).'...</font></td>';
					}
				}
			echo '</tr>';
		}
    }
     ?>
  </table>
</div>

				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
				<input type="button" name="back" value="back" onclick="javascript:window.history.back();">
  				<input type="button" name="next" value="Next" onClick="Link('activeTab=Step4&sql=<?php echo $_REQUEST['sql']; ?>&sql_=<?php echo $_REQUEST['sql_']; ?>&des_table=<?php echo $des_table; ?>&source_table=<?php echo $source_table; ?>&source_tables=<?php echo $_REQUEST['source_tables']; ?>&des_tables=<?php echo $fields_s; ?>' )">
		</td>
	</tr>
</table>
<input type="hidden" name="source_tables" value="<?php echo $_REQUEST['source_tables']; ?>" >
<input type="hidden" name="sql" value="<?php echo $_REQUEST['sql']; ?>">
<input type="hidden" name="activeTab" value="Step3">
</form>
</body>