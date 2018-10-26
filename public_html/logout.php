<!doctype html>
<html>
<head>
<title>Logout</title>
</head>
<body>
<?php
include('sitelogin.php');

//################################
//########## MAINLINE ############
$strSiteMember = serialize($siteMember);
setcookie('sitemember', $strSiteMember, time()+15);
session_destroy();

?>
</body>
</html>