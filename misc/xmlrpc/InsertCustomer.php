<?php
	include 'xmlrpc/lib/xmlrpc.inc';
	include 'config.inc.php';

	echo '<a href="index.php">Home</a></BR>';
 
	if (!isset($_POST['submit'])) {
		echo '<FORM METHOD="post" action=' . $_SERVER['PHP_SELF'] . '><table border=1>';
		echo '<tr><td>Debtor No</td><td><INPUT type="text" name="debtorno"></td></tr>';
		echo '<tr><td>Debtor name</td><td><INPUT type="text" name="name"></td></tr>';
		echo '<tr><td>Address 1</td><td><INPUT type="text" name="address1"></td></tr>';
		echo '<tr><td>Address 2</td><td><INPUT type="text" name="address2"></td></tr>';
		echo '<tr><td>Address 3</td><td><INPUT type="text" name="address3"</td></tr>';
		echo '<tr><td>Address 4</td><td><INPUT type="text" name="address4"</td></tr>';
		echo '<tr><td>Address 5</td><td><INPUT type="text" name="address5"></td></tr>';
		echo '<tr><td>Address 6</td><td><INPUT type="text" name="address6"></td></tr>';
		echo '<tr><td>Currency code</td><td><INPUT type="text" name="currcode"></td></tr>';
		echo '<tr><td>Sales Type</td><td><INPUT type="text" name="salestype"></td></tr>';
		echo '<tr><td>Client Since</td><td><INPUT type="text" name="clientsince"></td></tr>';
		echo '<tr><td>Hold reason</td><td><INPUT type="text" name="holdreason"></td></tr>';
		echo '<tr><td>Payment Terms</td><td><INPUT type="text" name="paymentterms"></td></tr>';
		echo '<tr><td>Discount</td><td><INPUT type="text" name="discount"></td></tr>';
		echo '<tr><td>Payment Discount</td><td><INPUT type="text" name="pymtdiscount"></td></tr>';
		echo '<tr><td>Last Paid</td><td><INPUT type="text" name="lastpaid"></td></tr>';
		echo '<tr><td>Last Paid Date</td><td><INPUT type="text" name="lastpaiddate"></td></tr>';
		echo '<tr><td>Credit Limit</td><td><INPUT type="text" name="creditlimit"></td></tr>';
		echo '<tr><td>Branch To Address Invoices to</td><td><INPUT type="text" name="invaddrbranch"></td></tr>';
		echo '<tr><td>Discount Code</td><td><INPUT type="text" name="discountcode"></td></tr>';
		echo '<tr><td>EDI Invoices</td><td><INPUT type="text" name="ediinvoices"></td></tr>';
		echo '<tr><td>EDI Orders</td><td><INPUT type="text" name="ediorders"></td></tr>';
		echo '<tr><td>EDI Reference</td><td><INPUT type="text" name="edireference"></td></tr>';
		echo '<tr><td>EDI Transport</td><td><INPUT type="text" name="editransport"></td></tr>';
		echo '<tr><td>EDI Address</td><td><INPUT type="text" name="ediaddress"></td></tr>';
		echo '<tr><td>EDI Server User</td><td><INPUT type="text" name="ediserveruser"></td></tr>';
		echo '<tr><td>EDI Server Password</td><td><INPUT type="text" name="ediserverpwd"></td></tr>';
		echo '<tr><td>Tax Ref</td><td><INPUT type="text" name="taxref"></td></tr>';
		echo '<tr><td>Customer PO Line</td><td><INPUT type="text" name="customerpoline"></td></tr>';
		echo '</table><input type="Submit" name="submit" value="Insert Customer"';
		echo '</FORM>';
 	} else {
		foreach ($_POST as $key => $value) {
			if ($value<>'' and $key<>'submit') {
				$CustomerDetails[$key] = $value;
			}
		}
		$customer = php_xmlrpc_encode($CustomerDetails);
		$user = new xmlrpcval($weberpuser);
		$password = new xmlrpcval($weberppassword);

		$msg = new xmlrpcmsg("weberp.xmlrpc_InsertCustomer", array($customer, $user, $password));

		$client = new xmlrpc_client($ServerURL);
		$client->setDebug($DebugLevel);

		$response = $client->send($msg);
		echo $response->faultstring();

	}
?>
