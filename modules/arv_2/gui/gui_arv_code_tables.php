<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script language="JavaScript" type="text/JavaScript">
<!--
function trim(sString) {
	while (sString.substring(0,1) == ' ') {
		sString = sString.substring(1, sString.length);
	}
	while (sString.substring(sString.length-1, sString.length) == ' ') {
		sString = sString.substring(0,sString.length-1);
	}
	return sString;
}

function add(element,id,item_text,other) {
	var destination_obj       = parent.frames['mainFrame'].document.forms[0].elements[element];
	var item_value=id+"|"+other+"|"+item_text;
	
	if (document.forms[0].elements['field_'+ id]) {
		if(trim(document.forms[0].elements['field_'+ id].value)=="") {
			alert("Please enter a value!");
			return false;
		}
	}
	
	if (destination_obj.type=="text") {
		destination_obj.value=item_text;
		destination_obj_hidden=parent.frames['mainFrame'].document.forms[0].elements[element.substring(0,element.indexOf("_txt"))];
		destination_obj_hidden.value=item_value;
	}
	else {
		if(check_existance(destination_obj,item_text)) {
			alert("You have it in the list");
			return false;
		}
		else {
			new_item_obj = new Option (item_text,item_value);
			destination_obj.options[destination_obj.options.length]=new_item_obj;
			
		}
	}
	return true;
}
	
function remove(element,item_text) {
	var destination_obj       = parent.frames['mainFrame'].document.forms[0].elements[element];

	if (destination_obj.type=="text") {
		destination_obj.value="";	
		destination_obj_hidden=parent.frames['mainFrame'].document.forms[0].elements[element.substring(0,element.indexOf("_txt"))];
		destination_obj_hidden.value="";
	}
	else {
		for (var i = 0; i <destination_obj.options.length ; i++) {
			if(destination_obj.options[i].text==item_text) {
				destination_obj.options[i]=null;
			}
		}
	}
	return true;  
}
	
function check_existance(destination_obj,item_text) {
	for (var i = 0; i <destination_obj.options.length ; i++) {
		if(destination_obj.options[i].text==item_text) {
			return true;
		}
	}
	return false; 
} 

//-->
</script>
<style type="text/css">
<!--

table {
	border: 2px ridge black;
}

body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size:11px;
}

td {
	background-color:#F0F8FF;
}

/* hovered items */
.row:hover,
.even:hover,
.hover {
    background: #99ccff;
    color: #000000;
}

/* hovered table rows */
table tr.row:hover td,
table tr.hover td {
    background:   #99ccff;
    color:   #000000;
}
-->
</style>
</head>

<body>
<?php
if($_GET['table']) {
	if ($_GET['table']=="laboratory_param[]") echo  $o_arv_visit->getLabParamTable($_GET['table']);
	if ($_GET['table']=="drugsandservices[]") echo  $o_arv_visit->getDrugTable($GET['table']);
	else echo $o_arv_visit->getCodesTable($_GET['table']);
}
?>

</body>
</html>
