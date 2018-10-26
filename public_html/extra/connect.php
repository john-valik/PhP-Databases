<?php
function connect()
{
	$conn = mysql_connect('localhost','jvalikon','jv92185');
	$db = mysql_select_db('jvalikon',$conn);
}
?>