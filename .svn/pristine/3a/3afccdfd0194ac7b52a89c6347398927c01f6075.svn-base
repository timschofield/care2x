<?php
	include '../webERP/xmlrpc/lib/xmlrpc.inc';

	include 'config.inc.php';

	echo '<a href="index.php">Home</a></BR>';
 
	if (isset($_GET['stockid'])) {
		$_POST['stockid']=$_GET['stockid'];
		$_POST['submit']='set';
	}
	if (!isset($_POST['submit'])) {
		echo '<FORM METHOD="post" action=' . $_SERVER['PHP_SELF'] . '>Enter stock id';
		echo '<INPUT type="text" name="stockid"></BR>';
		echo 'Enter Location ID<INPUT type="text" name="locationid"></BR><input type="Submit" name="submit" value="Get Balance"';
		echo '</FORM>';
 	} else {
		$stockid = new xmlrpcval($_POST['stockid']);
		$locationid = new xmlrpcval($_POST['locationid']);
		$user = new xmlrpcval($weberpuser);
		$password = new xmlrpcval($weberppassword);

		$msg = new xmlrpcmsg("weberp.xmlrpc_GetStockBalance", array($stockid, $locationid, $user, $password));

		$client = new xmlrpc_client($ServerURL);
		$client->setDebug($DebugLevel);

		$response = $client->send($msg);
		$debtor = php_xmlrpc_decode($response->value());
		echo "<table border=1>";
		if (sizeof($debtor)<1) {
			echo 'oops, an error number '.$debtor[0].' has occurred';
		}
		foreach ($debtor as $key => $value) {
			if (!is_numeric($key)) {
				echo "<tr><td>".$key."</td><td>".$debtor[$key]."</td></tr>";
			}
		}
		echo "</table>";
	}
?>
