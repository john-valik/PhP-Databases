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

function displayNumAnsForm()
{
	echo "<form name='getnumans' action='$PHP_SELF' method='post'>";
	echo "How many answers will be in today's question?<br>";
	echo "<input type='text' name='numanswers' size=10>";
	echo "<input type='submit' value='Continue'></form>";
}

function displayQuestionForm($Arr)
{
	$numanswers = $Arr['numanswers'];
	
	echo "<form name='getnumans' action='$PHP_SELF' method='post'>";
	echo "What is todays question?<br>";
	echo "<input type='text' name='question' size='80'><br>";
	echo "Start Date: <input type='text' name='datestart' size=10><br>";
	echo "End Date: <input type='text' name='dateend' size=10><br>";
	
	for($x = 1; $x <= $numanswers; $x++)
	{
		echo "Answer #$x: <input type='text' name='ans$x' size=50><br>";
	}
	echo "<input type='hidden' name='numanswers' value='$numanswers'><br>";
	echo "<input type='submit' value='Submit Question'></form>";
}

function insertQuestion($Arr)
{
	$ds = $Arr['datestart'];
	$de = $Arr['dateend'];
	$numanswers = $Arr['numanswers'];
	$q = addslashes($Arr['question']);
	
	$sql = "insert into dailyquestions (question,datestart,dateend) values ('$q','$ds','$de')";
	$result = mysql_query($sql) or die($sql);
	echo "Added question: $q";
	
	$qid = getMaxID("dailyquestions");
	
	for($x = 1; $x <= $numanswers; $x++)
	{
		$ansname = "ans" . $x;
		$ans = addslashes($Arr[$ansname]);
		$sqlans = "insert into dailychoices (qid,answer) values ('$qid','$ans')";
		$resultans = mysql_query($sqlans) or die ($sqlans);
		echo "Added answer: $ans";
	}
	echo "<a href='index.php'>Go Home</a>";
}

function getMaxID($table)
{
	$sql = "select max(id) as maxid from $table";
	$result = mysql_query($sql) or die($sql);
	$row = mysql_fetch_assoc($result);
	return $row['maxid'];
}

//################################
//########## MAINLINE ############
connect();

if($_POST['question'])
{
	insertQuestion($_POST);
	exit;
}
if($_POST['numanswers'])
{
	displayQuestionForm($_POST);
	exit;
}
displayNumAnsForm();
?>
</body>
</html>