<!doctype html>
<html>
<head>
<title>Students Table</title>
</head>
<body>
<?php

//################################
//########## MAINLINE ############
//include('extra/util.php');
//include('extra/connect.php');
//include('extra/functions.php');
include('sitelogin.php');
//connect();

$fieldArray = array(0 => "fname", 1 => "hometown");
ViewTable("students", $fieldArray);
?>
</body>
</html>