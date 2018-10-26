<!doctype html>
<html>
<head>
<link rel='stylesheet' href='../style.css' type='text/css'>
</head>
<body class='default'>
<h1>Hiking Destinations</h1>
<?php
include('../extra/connect.php');

function lakesList()
{
	$sql = "select id,placename from lakes";
	$result = mysql_query($sql) or die ($sql);
	
	echo "<table border='1'>";
	while ($row = mysql_fetch_assoc($result))
	{
		$id = $row['id'];
		$place = $row['placename'];
		echo "<tr><td><a href='onelake.php?id=$id' target='mainFrame'>$place</a></td></tr>";
	}
	echo "</table>";
}

//################################
//########## MAINLINE ############
connect();
lakesList();
?>
</body>
</html>