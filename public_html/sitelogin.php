<!doctype html>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php
include('extra/util.php');
include('extra/connect.php');
include('extra/functions.php');
include('siteuser.php');
 
function validUser($un, $pw)
{
	$valid = false;
	$sql = "select * from siteusers where email='$un' and pword='$pw'";
	$result = mysql_query($sql) or die($sql);
	
	if(mysql_num_rows($result) > 0)
	{
		$valid = true;
	}
	return $valid;
}

function getUserInfo()
{
	echo "<form name='getlogin' action='$PHP_SELF' method='post'>";
	echo "Email:<input type='text' name='email' size='50'><br>";
	echo "Password:<input type='password' name='pword' size='15'><br>";
	echo "<br><input type='submit' value='LogIn'></form>";
}

function getUserDetails($un, $epw, $field)
{
	$ans = 'N/A';
	$sql = "select * from siteusers where email='$un' and pword='$epw'";
	$result = mysql_query($sql) or die($sql);
	
	if($row=mysql_fetch_assoc($result))
	{
		$ans = $row[$field];
	}
	return $ans;
}

//################################
//########## MAINLINE ############
session_start();
connect();

if($_SESSION['sitemember'])
{
	$siteMember = unserialize($_SESSION['sitemember']);
	if(!validUser($siteMember->uname, $siteMember->pword))
	{
		echo "You are tying to hack into the system.";
		session_destroy();
		exit;
	}
	$siteMember->fname = getUserDetails($siteMember->uname, $siteMember->pword, 'fname');
	$siteMember->lname = getUserDetails($siteMember->uname, $siteMember->pword, 'lname');
	$siteMember->role = getUserDetails($siteMember->uname, $siteMember->pword, 'role');
	echo "Welcome, " . $siteMember->fullName();
	$strSiteMember = serialize($siteMember);
	$_SESSION['sitemember'] = $strSiteMember;
}
else
{
	if($_COOKIE['sitemember'])
	{
		$siteMember = unserialize($_COOKIE['sitemember']);
		if(!validUser($siteMember->uname, $siteMember->pword))
		{
			echo "Bad cookie.";
			session_destroy();
			exit;
		}
		
		echo "Hello, " . $siteMember->fullName();
		$strSiteMember = serialize($siteMember);
		$_SESSION['sitemember'] = $strSiteMember;
	}
	else
	{
		if(!$_POST)
		{
			getUserInfo();
			exit;
		}

		$un = $_POST['email'];
		$pw = md5($_POST['pword']);
		if(!validUser($un,$pw))
		{
			echo "You are not a valid user.";
			exit;
		}

		$siteMember = new siteuser($un, $pw);
		$siteMember->fname = getUserDetails($un, $pw, 'fname');
		$siteMember->lname = getUserDetails($un, $pw, 'lname');
		$siteMember->role = getUserDetails($un, $pw, 'role');
		echo "Welcome, " . $siteMember->fullName();
		$strSiteMember = serialize($siteMember);
		$_SESSION['sitemember'] = $strSiteMember;
	}
}
?>
</body>
</html>