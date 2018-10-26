<!doctype html>
<html>
<head>
<title>Todays Question</title>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');

function displayInvoiceIdForm()
{
	echo "<form name='getid' action='$PHP_SELF' method='get'>";
	echo "What is your invoice number?<br>";
	echo "<input type='text' name='id' size=10>";
	echo "<input type='submit' value='Submit'></form>";
}

function printInvoice($id)
{
	$sql = "select * from icesales where invoiceid='$id'";
	$result = mysql_query($sql) or die($sql);
	
	if(mysql_num_rows($result) == 0)
	{
		echo "There is no Invoice #$id.";
		exit;
	}
	
	$row = mysql_fetch_assoc($result);
	$fname = $row['fname'];
	$lname = $row['lname'];
	$thedate = $row['thedate'];
	$thetime = $row['thetime'];
	$custid = $row['customerid'];
	$iid = $row['invoiceid'];
	$add = $row['streetaddress'];
	$city = $row['city'];
	$st = $row['state'];
	$zip = $row['zip'];
	$p = $row['cost'];
	$q = $row['q'];
	$flavor = $row['flavor'];
	$man = $row['fname'];
	
	echo "Invoice #: $iid Customer ID: $custid <br>";
	echo "Customer: $fname $lname <br>";
	echo "$add <br> $city, $st $zip <br>";
	echo "Date: $thedate $thetime <br>";
	
	$extprice = $p * $q;
	
	echo "<table border='1'>";
	echo "<tr><td>$q</td><td>$flavor</td><td>$man</td><td>$extprice</td></tr>";
	
	$subtotalcost = $extprice;
	
	while ($row = mysql_fetch_assoc($result))
	{
		$p = $row['cost'];
		$q = $row['q'];
		$flavor = $row['flavor'];
		$man = $row['manufacturer'];
		$extprice = $p * $q;
		
		echo "<tr><td>$q</td><td>$flavor</td><td>$man</td><td>$extprice</td></tr>";
		$subtotalcost += $extprice;
	}
	echo "<tr><td colspan='3'>Subtotal:</td><td>$subtotalcost</td><tr>";
	$taxrate = 0.08;
	$tax = $subtotalcost * $taxrate;
	echo "<tr><td colspan='3'>Tax:</td><td>$tax</td><tr>";
	$grandtotal = $subtotalcost + $tax;
	echo "<tr><td colspan='3'>Grand Total:</td><td>$grandtotal</td><tr>";
}

//################################
//########## MAINLINE ############
connect();

if($_GET['id'])
{
	$id = $_GET['id'];
	printInvoice($id);
}
else
{
	displayInvoiceIdForm();
}	
?>
</body>
</html>