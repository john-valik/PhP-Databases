<!doctype html>
<html>
<head>
<title>Input</title>
</head>
<body>
<?php
include('extra/connect.php');

function displayInputForm()
{
	echo "<form name='getdata' action='$PHP_SELF' method='post'>";
	echo "Enter SQL Commands<br> ";
	echo "<textarea name='data' rows='10' cols='60'></textarea><br>";
	echo "<br><input type='submit' value='Run SQL'></form>";
}

function exeCommand($Arr)
{
	$data = $Arr['data'];
	if(substr($data,-1,1)==';')
	{
		$data = substr($data,0,strlen($data-1));
	}
	$ArrData = explode(';',$data);
	$c = Count($ArrData);
	$num = $c-1;
	
	for($x=0;$x<$c;$x++)
	{
		$result = mysql_query($ArrData[$x]) or die($ArrData[$x]);
	}
	
	echo "Data Entered! <a href='index.php'>Home</a>";
}
//################################
//########## MAINLINE ############
connect();
if($_POST)
{
	exeCommand($_POST);
}
else
{
	displayInputForm();
}
?>
</body>
</html>