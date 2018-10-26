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

function InsertVote($Arr)
{
	$qid = $Arr['qid'];
	$aid = $Arr['aid'];
	$d = date('Ymd');
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$sql = "insert into dailyresponses (qid,aid,ipaddr,thedate) values ('$qid','$aid','$ip','$d')";
	$result = mysql_query($sql) or die ($sql);
	
	echo "Thank toy for voting.<br>";
	echo "<a href='index.php'>Go Home</a>";
}

function TodaysQuestion()
{
	$sql = "select dailyquestions.id as qid, dailyquestions.question, dailychoices.id as aid, dailychoices.answer ";
	$sql .= "from dailyquestions join dailychoices on dailyquestions.id=dailychoices.qid ";
	$sql .= "where datestart<=current_date and dateend>=current_date";
	$result = mysql_query($sql) or die($sql);
	
	if(mysql_num_rows($result) == 0)
	{
		echo "There is no question of the day for today.";
		exit;
	}
	//else
	//{
		echo "<form name='getvote' action='$PHP_SELF' method='get'>";
			echo "<table border='1'>";
	
			$row = mysql_fetch_assoc($result);
			$q = $row['question'];
			$qid = $row['qid'];
	
			echo "<input type='hidden' name='qid' value='$qid'>";
			echo "<tr><th>Question:$q</th></tr>";
		
			$ans = $row['answer'];
			$aid = $row['aid'];
			echo "<tr><td><input type='radio' name='aid' value='$aid'>$ans</td></tr>";
		
			while ($row = mysql_fetch_assoc($result))
			{
				$ans = $row['answer'];
				$aid = $row['aid'];
				echo "<tr><td><input type='radio' name='aid' value='$aid'>$ans</td></tr>";
			}
		
			echo "</table>";
		echo "<input type='submit' value='Vote'></form>";
	//}
}

//################################
//########## MAINLINE ############
connect();

if($_GET['aid'])
{
	InsertVote($_GET);
}
else
{
	TodaysQuestion();
}
?>
</body>
</html>