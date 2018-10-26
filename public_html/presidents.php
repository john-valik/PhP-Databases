<!doctype html>
<html>
<head>
<title>John Valikonis</title>
</head>
<body>
<?php
function listPresidents($ord) 
{
	$sql = "select * from presidents";
	$result = mysql_query($sql) or die ($sql);

	echo "<$ord>\n";
	while($row = mysql_fetch_assoc($result))
	{
		$prez = $row['president'];
		$party = $row['party'];
		
		echo "<li>$prez ($party)</li>\n";
	}
	echo "</$ord>";
echo "<li>$prez ($party)</li>\n";	
}
// *********************************
// *********** MAINLINE ************
include('extra/connect.php');
connect();
$ord = 'ul';
if($_GET['order'])
{
	$ord = $_GET['order'];
}
if($_GET['ord'])
{
	$ord = $_GET['ord'];
}
if($_GET['o'])
{
	$ord = $_GET['o'];
}
listPresidents($ord);
?>
</body>
</html>
