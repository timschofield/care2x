//--------------------------------------------------------------------------------
// Gloabl variable section - all global variables will be declared here:
var arr=new Array();

//--------------------------------------------------------------------------------
// function section - Just helptools for the main functions
function check_existance(itemdescription , source_obj , destination_obj) {
  // (c) by Merotech (RM) 2005
 for(var i=0;i<destination_obj.length;i++) {
  //alert (destination_obj.options[i].text);
  if (source_obj.options[source_obj.selectedIndex].text==destination_obj.options[i].text) {
    //alert (destination_obj.options[i].text);
    return true;
    }
  }
return false;
} // end of function check_existance(itemdescription , source_obj , destination_obj)

//--------------------------------------------------------------------------------
// main function section - these functions will be called by the php/html content file

function item_add() {
  // (c) by Merotech (RM) 2005

  var source_obj            = document.forms[0].elements['itemlist[]'];
  var destination_obj       = document.forms[0].elements['selected_item_list[]'];
  var item_selected_index   = source_obj.selectedIndex;
	
  if (item_selected_index >= 0) {
      
    var new_item_text         = source_obj.options[item_selected_index].text;
    var new_item_value        = source_obj.options[source_obj.selectedIndex].value;
    if(new_item_value=="-1") return false;
    if(destination_obj.length > 0)
	    if(destination_obj.options[0].value=="-1")
	    {
		    arr[destination_obj.options[0].value]--;
		    destination_obj.options[0].text=null;
		    destination_obj.options[0]=null;
	  	}
    if (check_existance(new_item_text , source_obj ,destination_obj))
        alert ("You have it in the list!");
      else {
        new_item_obj = new Option ( new_item_text , new_item_value);
        destination_obj.options[destination_obj.options.length]=new_item_obj;
      } // end of if 
      
    return true;  
    
  } else {
    alert ("please select at least one item on the left side...");
  }
} // end of item_add()

function item_delete() {
  // (c) by Merotech (RM) 2005
  var destination_obj = document.forms[0].elements['selected_item_list[]'];
  if (destination_obj.selectedIndex >= 0 ) {
    arr[destination_obj.options[destination_obj.selectedIndex].value]--;
    destination_obj.options[destination_obj.selectedIndex].text=null;
    destination_obj.options[destination_obj.selectedIndex]=null;
    return true;
  } else {
    alert ("Please select one tiem on the right side if you have to remove it");
    return false;
  } // end of if
    
} // end of function item_delete()

function submit_form(reference, t, session, todo) {
  // (c) by Merotech (RM) 2005
  
  var destination_obj = document.forms[0].elements['selected_item_list[]'];
  var parameters="reference="+reference.name;

	switch(todo)
	{
		case "search":
			try
			{
			for (i = 0; i < document.forms[0].elements['search_mode'].length; ++i)
			if (document.forms[0].search_mode[i].checked == true)
				parameters += "&keyword="+document.forms[0].elements['keyword'].value + "&search_mode="+document.forms[0].search_mode[i].value;
			}
			catch(E){};
			break;
	  case "createquicklist":
	  	try
	  	{
	  		parameters += "&createquicklist="+document.forms[0].elements['createquicklist'].value;
	  	}
	  	catch(E) {}
	  	break;
	  case "updatequicklist":
	  	try
	  	{
			  for (i = 0; i < document.forms[0].elements['quicklist'].length; ++i)
			  if (document.forms[0].elements['quicklist'].options[i].selected == true)
			  {
	  				AreYouSure = confirm("Are you really sure you want to UPDATE the quicklist '" + document.forms[0].elements['quicklist'].options[i].text.toUpperCase() + "' in the database PERMANENTLY?");
	  				if(!AreYouSure) return false;
	  				parameters += "&updatequicklist="+document.forms[0].elements['quicklist'].options[i].value;
	  		}
	  	}
	  	catch(E) {}
	  	break;
	  case "deletequicklist":
	  	try
	  	{
			  for (i = 0; i < document.forms[0].elements['quicklist'].length; ++i)
			  if (document.forms[0].elements['quicklist'].options[i].selected == true)
			  {
	  				AreYouSure = confirm("Are you really sure you want to DELETE the quicklist '" + document.forms[0].elements['quicklist'].options[i].text.toUpperCase() + "' from the database PERMANENTLY?");
	  				if(!AreYouSure) return false;
	  				parameters += "&deletequicklist="+document.forms[0].elements['quicklist'].options[i].value;
	  		}
	  	}
	  	catch(E) {}
	  	break;
		case "quicklist":
	  	try
	  	{
			  for (i = 0; i < document.forms[0].elements['quicklist'].length; ++i)
			  if (document.forms[0].elements['quicklist'].options[i].selected == true)
			    	parameters += "&quicklist="+document.forms[0].elements['quicklist'].options[i].value;
		  }
		  catch(E){}
		  break;
		case "manage": 
	  	try
	  	{
			  for (i = 0; i < document.forms[0].elements['quicklist'].length; ++i)
			  if (document.forms[0].elements['quicklist'].options[i].selected == true)
			    	parameters += "&quicklist="+document.forms[0].elements['quicklist'].options[i].value;
		  }
		  catch(E){}
			try
			{
			for (i = 0; i < document.forms[0].elements['search_mode'].length; ++i)
			if (document.forms[0].search_mode[i].checked == true)
				parameters += "&keyword="+document.forms[0].elements['keyword'].value + "&search_mode="+document.forms[0].search_mode[i].value;
			}
			catch(E){};
			break;
	}
	try
	{
	  if (destination_obj.length > 0)
	    for (var i=0 ; i<destination_obj.length; i++ )
	    	if(destination_obj.options[i].value!=-1)
	      	parameters+="&item_no["+i+"]="+destination_obj.options[i].value;	
  }
  catch(E){}
  window.location.href=t+"?"+session+"&"+parameters;
  return 0;
}


function submit_button(t, session, mode) {
  // (c) by Merotech (RM) 2005
  alert (document.forms[0].elements['new_quicklist_name'].value);
  var destination_obj = document.forms[0].elements['selected_item_list[]'];  
  var parameters=mode+"&";
  
  for (i = 0; i < document.forms[0].elements['quicklist'].length; ++i)
  if (document.forms[0].elements['quicklist'].options[i].selected == true)
    parameters += "quicklist="+document.forms[0].elements['quicklist'].options[i].value;

  
  if (destination_obj.length > 0 )
    for (var i=0 ; i<destination_obj.length; i++ )
      parameters+="&item_no["+i+"]="+destination_obj.options[i].value;
  window.location.href=t+"?"+session+"&"+parameters;
  return 0;
}


function add_to_list(itemtext, itemvalue) {
  // (c) by Merotech (RM) 2005
  var destination_obj       = document.forms[0].elements['selected_item_list[]'];
  new_item_obj = new Option ( itemtext, itemvalue);
  destination_obj.options[destination_obj.options.length]=new_item_obj;  
}

function checklist()
{
  var destination_obj       = document.forms[0].elements['selected_item_list[]'];
  var itemlist_obj = document.forms[0].elements['itemlist[]'];
  if(destination_obj.length<=0) 
  {
  	alert('No items selected!');
  	return false;
  }
	else
	{
		destination_obj.options[0].selected = true;
		itemlist_obj.options[0].selected = true;
		return true;
	}
}
