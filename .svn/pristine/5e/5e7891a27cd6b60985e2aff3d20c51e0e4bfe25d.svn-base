<?php


include('roots.php');
include($root_path.'classes/adodb/adodb.inc.php');	 # load code common to ADOdb

include('config.php');
$des_table= $_REQUEST['des_table'];
$source_table= $_REQUEST['source_table'];


			if($_REQUEST['des_tables']!="")
			{
				$string=$_REQUEST['des_tables'];
				$string = str_replace(",","-,",$string);
				$string = $string."-";
				$filter=str_replace(",", " OR field='",$string);
				$filter=str_replace("-", "'",$filter);
				$filter_d = "where field='" . $filter;
			}
			else
			{
				$filter_d="";
			}

			if($_REQUEST['source_tables']!="")
			{
				$string=$_REQUEST['source_tables'];
				$string = str_replace(",","-,",$string);
				$string = $string."-";
				$filter=str_replace(",", " OR field='",$string);
				$filter=str_replace("-", "'",$filter);
				$filter_s = "where field='" . $filter;
			}
			else
			{
				$filter_s="";
			}


?>

<html>
<link rel="stylesheet" type="text/css" href="form/style.css">
<script type='text/javascript'>



function Link(x)
{
	Ziel1 = ("gui_elt.php?");
	Ziel1 = Ziel1+x+"";
	window.location.href = Ziel1;
}

</script>
<body>
<form name="form" methode="get" action="">
<table border=1 id="centeredtable" align="center">
<tr>
<td>
	<table border="1" width="100%" height="50%" id="centeredtable">
		<tr>
			<td id="firstline" colspan="2" align="center">Destination Table: <?php echo $des_table; ?></td>
		</tr>
	<?php

		//$conn_des->PConnect($des_host, $des_user, $des_password, $des_dbname);
		$fields_des=&$conn_des->Execute('show fields from '.$des_table.' '.$filter_d.'');

			while($field=$fields_des->FetchRow())
			{
				echo '<tr>';
				echo '<td id="sideline" >'.$field['Field'].'</td>';
				echo '<td><input type="text" name="type_d" value="'.$field['Type'].'"></td>';
				echo '</tr>';
			}

	?>
	</table>
</td>
<td>
	<table border=1 id="centeredtable">
		<tr>
			<td id="firstline" colspan="2" align="center">Source Table: <?php echo $source_table; ?></td>
		</tr>
	<?php
			
		
		//$conn_des->Close();
		//$conn_source->PConnect($des_host, $des_user, $des_password, $des_dbname);

		echo "conneciton:".$des_host."".$des_user."". $des_password."". $des_dbname."<br>";
		$fields_source=&$conn_source->Execute('show fields from '.$source_table.' '.$filter_s.'');
		echo 'show fields from '.$source_table.' '.$filter_s.'';
			while($field=$fields_source->FetchRow())
			{
				echo '<tr>';
				echo '<td id="sideline" >'.$field['Field'].'</td>';
				echo '<td><input type="text" name="type_s" value="'.$field['Type'].' disabled="true"></td>';
				echo '</tr>';
			}
	?>
	</table>
</td>
</td>
</tr>
<tr>
<td colspan="2" align="center">
		<input type="button" name="name" value="back" onclick="javascript:window.history.back();">
  		<input type="button" name="name" value="Next" onClick="Link('activeTab=Step5&des_table=<?php echo $_REQUEST['des_table'];?>&des_tables=<?php echo $_REQUEST['des_tables'];?>&sql=<?php echo $_REQUEST['sql'];?>' )">
</td>
</tr>
</table>
</form>
</body>
</html>