<!doctype html>
<html>
<head>
<title>Listen</title>
<meta http-equiv='refresh' content='5'>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');

function emo($w)
{
	$w = str_replace(':)', '&#9786;', $w);
	$w = str_replace(';)', '&#128521;', $w);
	$w = str_replace('Waffle', "<img src='images/emoticons/waffle.gif'>", $w);
	$w = str_replace('OK', "<img src='images/emoticons/ok.gif'>", $w);
	return $w;
}

function listen($n)
{
	$sql = "select * from journal order by id desc limit $n";
	$result = mysql_query($sql) or die($sql);
	echo "<table border='1'>";
	while ($row=mysql_fetch_assoc($result))
	{
		$d = $row['thedate'];
		$w = emo($row['words']);
		$ip = $row['ip'];
		
		echo "<tr><td>$d</td><td>$ip</td><td>$w</td></tr>";
	}
	echo "</table>";
}

//################################
//########## MAINLINE ############
connect();

$n = 10;
if($_GET['n'])
{
	$n = $_GET['n'];
}

listen($n);
?>
</body>
</html>