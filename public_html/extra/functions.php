<?php
/*****************************************
Function ViewTable(MySQL Table Name, Table Field Names)
Function VeiwStudents()
*****************************************/

function ViewTable($table, $fieldsArray)
{
	// Builds string for SQL command from Array
	$sqlFields;
	foreach($fieldsArray as $fields)
	{
		$sqlFields .= "$fields,";
	}
	$sqlFields = rtrim($sqlFields,", ");
		
	
	// 	Fetches MySQL table rows and builds string for TableWapper
	$sql = "select $sqlFields from $table";
	$result = mysql_query($sql) or die($sql);
	while($row=mysql_fetch_assoc($result))
	{
		foreach($fieldsArray as $f) // loop to get values for each row
		{
			$resultRow .= "$row[$f]|";
		}
			
		$resultRow = rtrim($resultRow,"| ");
		$resultTable .= "[$resultRow]";
		$resultRow = "";// Clear variable before loop
	}
	echo tableWrapper($resultTable);
}

function ViewStudents()
{
	$sql = "select * from students";
	$result = mysql_query($sql) or die($sql);
	
	while($row=mysql_fetch_assoc($result))
	{
		$fname = $row['fname'];
		$hometown = $row['hometown'];
		$major = $row['major'];
		$table .= "[$fname|$hometown|$major]";
		//echo "$fname $hometown </br>";
	}
	//echo "$table";
	echo tableWrapper($table);
}
?>