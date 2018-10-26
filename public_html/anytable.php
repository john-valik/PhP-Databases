<!doctype html>
<html>
<head>
<title>Any Table</title>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');

function showField($Arr)
{
	$t = $Arr['table'];
	$f = $Arr['field'];
	echo " The $f field in the $t table";
}

function numFieldsInTable($t)
{
	$sql = "describe $t";
	$result = mysql_query($sql) or die ($sql);
	return mysql_num_rows($result);
}

function describeTable($t)
{
	$sql = "describe $t";
	$result = mysql_query($sql) or die($sql);
	echo "<tr>";
	while ($row = mysql_fetch_array($result))
	{
		$f = $row[0];
		$ty = $eow[1];
		echo "<th>$f</th>";
	}
	echo "</tr>";
}

function showTable($t)
{
	echo "<table border='1'>";
	describeTable($t);
	$sql = "select * from $t";
	$num = numFieldsInTable($t);
	$result = mysql_query($sql) or die($sql);
	
	while($row=mysql_fetch_array($result))
	{
		echo "<tr>";
		for($x=0;$x<$num;$x++)
		{
			$data = $row[$x];
			echo "<td>$data</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

function showFieldList($t)
{
	$sql = "describe $t";
	$result = mysql_query($sql) or die($sql);
	echo "<form name='getfield' action='$PHP_SELF' method='post'>";
	echo "<input type='hidden' name='table' value='$t'>";
	echo "<select name='field'>";
	
	while ($row = mysql_fetch_array($result))
	{
		$f = $row[0];
		echo "<option value='$f'>$f</option>";
	}
	echo "</select>";
	echo "<input type='submit' value='See Table'>";
	echo "</form>";
	
	showTable($t);
}

function showTableList()
{
	$sql = "show tables";
	$result = mysql_query($sql) or die($sql);
	
	echo "<form name='gettable' action='$PHP_SELF' method='post'>";
	echo "<select name='table'>";
	while ($row = mysql_fetch_array($result))
	{
		$t = $row[0];
		echo "<option value='$t'>$t</option>";
	}
	echo "</select>";
	echo "<input type='submit' value='See Table'>";
	echo "</form>";
}

//################################
//########## MAINLINE ############
connect();
if($_POST['field'])
{
	showField($_POST);
	exit;
}

if($_POST['table'])
{
	showFieldList($_POST['table']);
}
else
{
	showTableList();
}

?>
</body>
</html>