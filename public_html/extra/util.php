<?php
function tableWrapper($table)
{
	$result = "<table border='1'>";
	
	$table = str_replace("[","<tr><td>",$table);
	$table = str_replace('|','</td><td>',$table);
	$table = str_replace(']','</td></tr>',$table);
	
	$table = str_replace('(','<tr><th>',$table);
	$table = str_replace(')','</th></tr>',$table);
	
	$result .= $table;
	$result .= "</table>";
	return $result;
}
?>