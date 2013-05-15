<?php

	include 'xmlrpc/lib/xmlrpc.inc';
	include 'config.inc.php';

	echo '<a href="index.php">Home</a></BR>';
 
	if (!isset($_POST['submit'])) {
		echo '<FORM METHOD="post" action=' . $_SERVER['PHP_SELF'] . '><table border=1>';
		echo '<tr><td>Debtor No</td><td><INPUT type="text" name="debtorno"></td></tr>';
		echo '<tr><td>Branch Code</td><td><INPUT type="text" name="branchcode"></td></tr>';
		echo '<tr><td>Transaction Date</td><td><INPUT type="text" name="trandate"></td></tr>';
		echo '<tr><td>Settled</td><td><INPUT type="text" name="settled"></td></tr>';
		echo '<tr><td>Reference</td><td><INPUT type="text" name="reference"</td></tr>';
		echo '<tr><td>Tpe</td><td><INPUT type="text" name="tpe"</td></tr>';
		echo '<tr><td>Order</td><td><INPUT type="text" name="order_"></td></tr>';
		echo '<tr><td>Exchange Rate</td><td><INPUT type="text" name="rate"></td></tr>';
		echo '<tr><td>Net Amount</td><td><INPUT type="text" name="ovamount"></td></tr>';
		echo '<tr><td>Sales Tax</td><td><INPUT type="text" name="ovgst"></td></tr>';
		echo '<tr><td>Freight amount</td><td><INPUT type="text" name="ovfreight"></td></tr>';
		echo '<tr><td>Discount amount</td><td><INPUT type="text" name="ovdiscount"></td></tr>';
		echo '<tr><td>Difference on Exchange</td><td><INPUT type="text" name="diffonexch"></td></tr>';
		echo '<tr><td>Allocated Amount</td><td><INPUT type="text" name="alloc" value=0></td></tr>';
		echo '<tr><td>Invoice Text</td><td><INPUT type="text" name="invtext"></td></tr>';
		echo '<tr><td>Ship Via</td><td><INPUT type="text" name="shipvia"></td></tr>';
		echo '<tr><td>EDI Sent</td><td><INPUT type="text" name="edisent"></td></tr>';
		echo '<tr><td>Consignment</td><td><INPUT type="text" name="consignment"></td></tr>';
		echo '</table><input type="Submit" name="submit" value="Insert Invoice"';
		echo '</FORM>';
 	} else {
		$_POST['partcode']='TEST';
		$_POST['salesarea']='NW';
		foreach ($_POST as $key => $value) {
			if ($value<>'' and $key<>'submit') {
				$InvoiceDetails[$key] = $value;
			}
		}
		$invoice = php_xmlrpc_encode($InvoiceDetails);
		$user = new xmlrpcval($weberpuser);
		$password = new xmlrpcval($weberppassword);

		$msg = new xmlrpcmsg("weberp.xmlrpc_InsertSalesInvoice", array($invoice, $user, $password));

		$client = new xmlrpc_client($ServerURL);
		$client->setDebug($DebugLevel2);

		$response = $client->send($msg);
		echo $response->faultstring();

	}


?>