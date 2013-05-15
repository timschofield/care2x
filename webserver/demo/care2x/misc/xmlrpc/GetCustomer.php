<?php

	include 'xmlrpc/lib/xmlrpc.inc';

	include './config.inc.php';

	echo '<a href="index.php">Home</a></BR>';

	if (isset($_GET['debtorno'])) {
		$_POST['debtor']=$_GET['debtorno'];
		$_POST['submit']='set';
	}
	if (!isset($_POST['submit'])) {
		echo '<FORM METHOD="post" action=' . $_SERVER['PHP_SELF'] . '>Enter customer code';
		echo '<INPUT type="text" name="debtor"></BR><input type="Submit" name="submit" value="Find Customer"';
		echo '</FORM>';
 	} else {
		$debtorno = new xmlrpcval($_POST['debtor']);
		$user = new xmlrpcval($weberpuser);
		$password = new xmlrpcval($weberppassword);

		$msg = new xmlrpcmsg("weberp.xmlrpc_GetCustomer", array($debtorno, $user, $password));

		$client = new xmlrpc_client($ServerURL);
		$client->setDebug($DebugLevel);

		$response = $client->send($msg);
		$debtor = php_xmlrpc_decode($response->value());
		echo "<table border=1>";
		if (sizeof($debtor)<20) {
			echo 'nicht da';
			echo 'oops, an error number '.$debtor[0].' has occurred';
		}
		else
		{
		echo "da";
		foreach ($debtor as $key => $value) {
			if (!is_numeric($key)) {

				echo "<tr><td>".$key."</td><td>".$debtor[$key]."</td></tr>";
			}
		}
		echo "</table>";
		}
	}
?>
