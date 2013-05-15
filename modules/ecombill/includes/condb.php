<?php
error_reporting(0);
function connect_db()
{
	$redir="includes/ErrorPage.php";
	$linkdb=mysql_connect("localhost","httpd","") or
	die ("<META http-equiv='refresh' content='0; url=$redir'>");
	mysql_select_db ("maho") or
	die ("<META http-equiv='refresh' content='0; url=$redir'>");
	
}

function disconnect_db()
{
	$redir="includes/ErrorPage.php";
	$linkdb=mysql_connect("localhost","root","");
        	mysql_close($linkdb) or
        	die ("<META http-equiv='refresh' content='0; url=$redir' >");
   

}
?>
