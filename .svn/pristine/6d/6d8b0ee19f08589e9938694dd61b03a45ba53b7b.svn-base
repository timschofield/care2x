<?php
	include 'xmlrpc/lib/xmlrpc.inc';

	include 'config.inc.php';

	echo '<a href="index.php">Home</a></BR>';
 
	if (!isset($_POST['submit'])) {
		echo '<FORM METHOD="post" action=' . $_SERVER['PHP_SELF'] . '><table border=1>';
		echo '<tr><td>Stock ID</td><td><INPUT type="text" name="stockid"></td></tr>';
		echo '<tr><td>Category</td><td><INPUT type="text" name="categoryid"></td></tr>';
		echo '<tr><td>Description</td><td><INPUT type="text" name="description"></td></tr>';
		echo '<tr><td>Long Description</td><td><INPUT type="text" name="longdescription"></td></tr>';
		echo '<tr><td>Units</td><td><INPUT type="text" name="units"></td></tr>';
		echo '<tr><td>MB Flag</td><td><INPUT type="text" name="mbflag"</td></tr>';
		echo '<tr><td>Last Current Cost Date</td><td><INPUT type="text" name="lastcurcostdate"</td></tr>';
		echo '<tr><td>Actual Cost</td><td><INPUT type="text" name="actualcost"></td></tr>';
		echo '<tr><td>Last Cost</td><td><INPUT type="text" name="lastcost"></td></tr>';
		echo '<tr><td>Material Cost</td><td><INPUT type="text" name="materialcost"></td></tr>';
		echo '<tr><td>Labour Cost</td><td><INPUT type="text" name="labourcost"></td></tr>';
		echo '<tr><td>Overhead Cost</td><td><INPUT type="text" name="overheadcost"></td></tr>';
		echo '<tr><td>Lowest Level</td><td><INPUT type="text" name="lowestlevel"></td></tr>';
		echo '<tr><td>Discontinued</td><td><INPUT type="text" name="discontinued"></td></tr>';
		echo '<tr><td>Controlled</td><td><INPUT type="text" name="controlled"></td></tr>';
		echo '<tr><td>EOQ</td><td><INPUT type="text" name="eoq"></td></tr>';
		echo '<tr><td>Volume</td><td><INPUT type="text" name="volume"></td></tr>';
		echo '<tr><td>Kgs</td><td><INPUT type="text" name="kgs"></td></tr>';
		echo '<tr><td>Barcode</td><td><INPUT type="text" name="barcode"></td></tr>';
		echo '<tr><td>Discount Category</td><td><INPUT type="text" name="discountcategory"></td></tr>';
		echo '<tr><td>Tax Category ID</td><td><INPUT type="text" name="taxcatid"></td></tr>';
		echo '<tr><td>Serialised</td><td><INPUT type="text" name="serialised"></td></tr>';
		echo '<tr><td>Append File</td><td><INPUT type="text" name="appendfile"></td></tr>';
		echo '<tr><td>Perishable</td><td><INPUT type="text" name="perishable"></td></tr>';
		echo '<tr><td>Decimal Places</td><td><INPUT type="text" name="decimalplaces"></td></tr>';
		echo '</table><input type="Submit" name="submit" value="Insert Customer"';
		echo '</FORM>';
 	} else {
		foreach ($_POST as $key => $value) {
			if ($value<>'' and $key<>'submit') {
				$StockItemDetails[$key] = $value;
			}
		}
		$stockitem = php_xmlrpc_encode($StockItemDetails);
		$user = new xmlrpcval($weberpuser);
		$password = new xmlrpcval($weberppassword);

		$msg = new xmlrpcmsg("weberp.xmlrpc_InsertStockItem", array($stockitem, $user, $password));

		$client = new xmlrpc_client($ServerURL);
		$client->setDebug($DebugLevel);

		$response = $client->send($msg);
		echo $response->faultstring();

	}
?>
