<!doctype html>
<html>
<head>
<title>Daily Vote Tally</title>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');

function VoteTally()
{
	$sql = "select question,answer,ipaddr from dailyquestions join dailychoices on dailyquestions.id=dailychoices.qid ";
	$sql .= "join dailyresponses on dailychoices.id=dailyresponses.aid ";
	$sql .= "where datestart<=current_date and dateend>=current_date";
	$result = mysql_query($sql) or die($sql);
	
	$row = mysql_fetch_assoc($result);
	$t = "<tr><th colspan='2'>Question: " . $row['question'] . ")";
	$t .= "[" . $row['answer'] . "|" . $row['ipaddr'] . "]";
	
	while($row = mysql_fetch_assoc($result))
	{
		$t .= "[" . $row['answer'] . "|" . $row['ipaddr'] . "]";
	}
	
	echo tableWrapper($t);
}	

//################################
//########## MAINLINE ############
connect();
VoteTally();
?>
</body>
</html>