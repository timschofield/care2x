var xmlHttp

function showReport()
{
 xmlHttp = GetXmlHttpObject()
  if(xmlHttp==null)
  {
	  alert("The browser does not support HTTP Request")
	  return
  }
  
  var url = "addlocation.php"
  url = url+"?sid="+Math.random()
  xmlHttp.onreadystatechange=stateChanged
  xmlHttp.open("GET",url,true)
  xmlHttp.send(null)
}

function stateChanged()
{
	if(xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{
		document.getElementById("formnew").innerHTML=xmlHttp.responseText
	}
}


function GetXmlHttpObject()
{
	
var xmlHttp = null;

   try
   {
	   xmlHttp = new XMLHttpRequest();
   }
   catch(e)
   {
	   try
	   {
		   xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	   }
	   catch(e)
	   {
		   xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	   }
   }
   return xmlHttp;
}
