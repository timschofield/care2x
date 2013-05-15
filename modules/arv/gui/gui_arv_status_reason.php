<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="Dorothea Reichert">
<title>ARV status</title>
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<style type="text/css">
<!--
	body {background-color:#F0F5FF;}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
	function gethelp(x,s,x1,x2,x3,x4)
	{
		if (!x) x="";
		urlholder="../../main/help-router.php<?php echo URL_APPEND; ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
		helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
		window.helpwin.moveTo(0,0);
	}

	function trim(sString) {
		while (sString.substring(0,1) == ' ') {
			sString = sString.substring(1, sString.length);
		}
		while (sString.substring(sString.length-1, sString.length) == ' ') {
			sString = sString.substring(0,sString.length-1);
		}
		return sString;
	}
	
	function check_existance(itemdescription , source_obj , destination_obj) {
	// (c) by Merotech (RM) 2005
	 	for(var i=0;i<destination_obj.length;i++) {

	  	if (source_obj.options[source_obj.selectedIndex].text==destination_obj.options[i].text) {
	    	return true;
	    }
	  }
	return false;
	} 
	
	function item_delete() {
	// (c) by Merotech (RM) 2005
	
		var destination_obj = document.forms[0].elements['selected_item_list[]'];
	  	if (destination_obj.selectedIndex >= 0 ) {
	    	destination_obj.options[destination_obj.selectedIndex].text=null;
	    	destination_obj.options[destination_obj.selectedIndex]=null;
	    	return true;
	  	} 
	  	else {
	    	alert ("Please select one tiem on the right side if you have to remove it");
	    	return false;
	 	} 	    
	} 
	
	function submit_form(dest,session,querystring) {
	// (c) by Merotech (RM) 2005
		var parameters;
		var destination_obj = document.forms[0].elements['selected_item_list[]'];
		
		try {
			for (i = 0; i < document.forms[0].elements['group'].length; ++i) {
				if (document.forms[0].elements['group'].options[i].selected == true) {
					parameters += "&group="+document.forms[0].elements['group'].options[i].value;
				}
			}
		}
		catch(E) {}
		try {
		  if (destination_obj.length > 0) {
		  	for (var i=0 ; i<destination_obj.length; i++ ) {
		    	if(destination_obj.options[i].value!=-1) {
		      		parameters+="&r_item_no["+destination_obj.options[i].value+"]="+destination_obj.options[i].text;		
				}      	
		    }
		  }
		}
		catch(E) {};
		
		window.location.href=dest+session+"&"+parameters+querystring;
		return 0;
	}
	
	function item_add_notes() {
		var source_obj            = document.forms[0].elements['itemlist[]'];
		var destination_obj       = document.forms[0].elements['selected_item_list[]'];
		var new_item_text_add     = trim(document.forms[0].textfield.value);
	    var item_selected_index   = source_obj.selectedIndex;
	  
	    var new_item_text         = source_obj.options[item_selected_index].text;
	    var new_item_value        = source_obj.options[source_obj.selectedIndex].value;
	    
	    new_item_text+=": "+new_item_text_add;
	    
	    new_item_obj = new Option (new_item_text, new_item_value);
	    destination_obj.options[destination_obj.options.length]=new_item_obj;
	    
	    document.getElementById('hidden').style.visibility = "hidden";
	    document.forms[0].textfield.value="";  	
	}
	
	function item_add() {
	// (c) by Merotech (RM) 2005
	
		var source_obj            = document.forms[0].elements['itemlist[]'];
	  	var destination_obj       = document.forms[0].elements['selected_item_list[]'];
	 	var item_selected_index   = source_obj.selectedIndex;
	  
	  	document.getElementById('hidden').style.visibility = "hidden";
	  
	  	if (item_selected_index >= 0) {   
	    	var new_item_text         = source_obj.options[item_selected_index].text;
	    	var new_item_value        = source_obj.options[source_obj.selectedIndex].value;
	    
	    var span
	    span=document.getElementById('text');
	    
	    switch (source_obj.options[item_selected_index].value) {
			case "25":
				document.getElementById('hidden').style.visibility = "visible"
				span.firstChild.data="Please specify other adverse event";
		   		return;
		    case "32":
		    	document.getElementById('hidden').style.visibility = "visible"
		    	span.firstChild.data="Please specify where to transferred";
		    	return;
		    case "36":
		    	document.getElementById('hidden').style.visibility = "visible"
		    	span.firstChild.data="Please specify other reason";
		    	return;
		}
	    if(new_item_value=="-1") return false;
	    if(destination_obj.length > 0)
		    if(destination_obj.options[0].value=="-1")
		    {
			    destination_obj.options[0].text=null;
			    destination_obj.options[0]=null;
		  	}
	    
	    if (check_existance(new_item_text , source_obj ,destination_obj) && source_obj.value!=25  && source_obj.value!=36 )
	        alert ("You have it in the list!");
	    else {
	        new_item_obj = new Option ( new_item_text , new_item_value);
	        destination_obj.options[destination_obj.options.length]=new_item_obj;
	    } 
	    return true;  
	    
	  } 
	  else 
	  {
	    alert ("please select at least one item on the left side...");
	  }
	} 

//-->
</script>
</head>
<body>
<table cellspacing="0"  class="titlebar" border=0>
	<tr valign=top  class="titlebar" >
  		<td bgcolor="#99ccff" >
  			&nbsp;&nbsp;<font color="#330066">NATIONAL CARE AND TREATMENT PROGRAMME</font>
  		</td>
  		<td bgcolor="#99ccff" align=right><a
	   		href="javascript:gethelp('arv_status_reason.php','ARV Status Reason')"><img src="../../gui/img/control/blue_aqua/en/en_hilfe-r.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" ></a><a
	   		href="<?php echo $root_path.$breakfile.URL_APPEND.$querystring?>" ><img src="../../gui/img/control/blue_aqua/en/en_cancel.gif" border=0 width="76" height="21" alt="" style="filter:alpha(opacity=70)" ></a>     
   		</td>
	</tr>
</table>
<form name="mainform" method="post" action="">
	<table class="mainTable" width="100%" border="0" cellpadding="1" cellspacing="1">
	  <tr>
	    <td width="32%"  bgcolor="#F0F5FF">&nbsp;</td>
	    <td width="38%"  bgcolor="#F0F5FF"><p><span class="fett">Please select a group:</span>      
	      <select name="group" onChange="javascript:submit_form('<?php echo "arv_status_reason.php";?>','<?php echo URL_APPEND;?>','<?php echo $querystring;?>');">
	          <option>------------Please Select-------------</option>
	         <?php $o_arv_visit->displayARVStatusReasonGroup($group,$selected); ?>
	      </select>
	    </td>
	    <td width="30%"  bgcolor="#F0F5FF">&nbsp;</td>
	  </tr>
	  <tr>
	    <td colspan="3"  bgcolor="#F0F5FF"><p align="center">       
	        <select name="itemlist[]" size="20" style="width:600px;" onDblClick="javascript:item_add();">
	          <!-- dynamically managed content -->
	          <?php echo $o_arv_visit->displayARVStatusReasonGroup_Items($group); ?>
	          <!-- dynamically managed content --> 
	        </select>
	        </p></td>
	  </tr>
	  <tr bgcolor="#F0F5FF">
	    <td colspan="3" align="center">
	    <table border="0" cellpadding="0" cellspacing="0" align="center" width="500">
	      <tr>
	        <td width="33%"><a href="#" onClick="javascript:item_add();"><img  src="../../gui/img/control/default/en/en_add_item.gif" border=0 width="110" height="24" alt="" ></a></td>
	        <td width="34%" align="center"><a href="#" onClick="javascript:submit_form('arv_visit.php','<?php echo URL_APPEND ?>','<?php echo $querystring;?>')"><img  src="../../gui/img/control/default/en/en_im_finished.gif" border=0 width="110" height="24" alt=""></a></td>
	        <td width="33%" align="right"><a href="#" onClick="javascript:item_delete();"><img  src="../../gui/img/control/default/en/en_delete_item.gif" border=0 width="110" height="24" alt=""></a></td>
	      </tr>
	    </table>
	    </td>
	  </tr>
	  <tr>
	    <td colspan="3" bgcolor="#F0F5FF"><div align="center"><p>
	      <select name="selected_item_list[]" size="5" style="width:600px;" onDblClick="javascript:item_delete();">
	        <!-- dynamically managed content -->
	        <?php echo $o_arv_visit->displaySelected_Items($r_item_no); ?>
	        <!-- dynamically managed content -->
	      </select>
	      <br>
	      </div>
	    </td>
	  </tr>
	  <tr bordercolor="#333333">
	    <td colspan="3" align="center" bgcolor="#F0F5FF"">
	    <p>&nbsp;</p>
	    <div id="hidden" style="border: 5px solid red;visibility:hidden;width:480px;padding:2px">
	  	&nbsp;&nbsp;
		<input type="text" name="textfield" />
	  	<input type="button" name="Submit" value="Senden" onClick="javascript:item_add_notes()" />
	  	</div>
	    <p>&nbsp;</p>
	    </td>
	  </tr>
	</table>
</form>
</body>
</html>

 