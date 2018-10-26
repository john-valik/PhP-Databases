<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<link rel='stylesheet' href='../style.css' type='text/css'>
<title>One Lake</title>
</head>
<body class='default'>
<?php
include('../extra/connect.php');

function displayLake($id)
{
	$sql = "select * from lakes where id='$id'";
	$result = mysql_query($sql) or die($sql);
	
	if($row = mysql_fetch_assoc($result))
	{
		$place = $row['placename'];
		$info = $row['info'];
		$photo = "../images/lakesphotos/" . $place . ".jpg";
		echo "<h1>$place</h1>";
		echo "<img src='$photo' alt='a photo of $place'>";
		echo "$info";
	}
	else
	{
		echo "There is no with id: $id";
	}
}

//################################
//########## MAINLINE ############
connect();
$id=0;
if($_GET['id'])
{
	$id = $_GET['id'];
}
displayLake($id);
?>
</body>
</html>