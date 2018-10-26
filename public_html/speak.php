<!doctype html>
<html>
<head>
<title>Speak</title>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');

function journalEntry($words)
{
	$w = addslashes($words);
	$ip = $_SERVER['REMOTE_ADDR'];
	$d = date('Y-m-d H:i:s');
	$sql = "insert into journal (thedate, words, ip) values ('$d','$w','$ip')";
	$result = mysql_query($sql) or die ($sql);
	//echo "You said: " . $words;
}

function speak()
{
	echo "<form name='speak' action='$PHP_SELF' method='post'>";
	echo "What on your mind?<br>";
	echo "<input type='text' name='words' size='80'>";
	echo "<input type='submit' value='Speak'>";
	echo "</form>";
}

//################################
//########## MAINLINE ############
connect();

if($_POST['words'])
{
	journalEntry($_POST['words']);
}
speak();
?>
</body>
</html>