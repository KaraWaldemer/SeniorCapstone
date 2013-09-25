<?php
session_start();
/*
@File: login.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page which allows users to log in and handles log in attempts from other pages
*/

require_once "Templates/info.php";
$title = "User Login";
include "Templates/dcalls.php";
include "Templates/errors.php";

$db_server = login();

$error = "";

if($_SESSION['linCount'] == 0) //checks error reporting variable
{
    $uColor = $pColor = 'black';
}
else
{
    $uColor = element_required($_POST['email']);
    $pColor = element_required($_POST['pword']);
}

/* verifies all fields are filled in then checks them against the database*/
if($_SESSION['linCount'] > 0 && strlen($uColor) == 5 && strlen($pColor) == 5)
{
	$email = get_post('email');
	$pword = get_post('pword');

	$result = getUsers($db_server);
	$rows = findSize($result);

	$error = user_exist($rows, $result, get_post('email'), get_post('pword'), 0);
}
else
{
      $_SESSION['linCount']++;
}


echo <<<_END
<html>
	<head>
		<title>Find My Pet</title>
		<link rel="stylesheet" type="text/css" href="Templates/format.css">
	</head>
	<body bgcolor="LightSteelBlue">

	<table width='100%' height="100%">
	  <tr>
	    <td>
_END;
include "Templates/header3.php";
echo <<<_END
	    </td>
	  </tr>
	  <tr>
	    <td height="80%" valign='top'>
		<table>
<form method="post" action="login.php">
	<tr><td>User Name/Email:</td><td> <input type="text" name="email" /><font color=$uColor> * </font></td></tr>
	<tr><td>Password:</td><td> <input type="password" name="pword" /><font color=$pColor> * </font></td></tr>
	<tr><td><input type="submit" value="Log In" /></td>
	<td><input type="button" value="Forgot" onclick="window.location.href='forgot.php'" /></td></tr>
</form>
<tr><td colspan="2">* Required Element</td></tr>
<tr><td colspan="2">$error </td></tr>
	      </table>
	    </td>
	  </tr>
	  <tr>
	    <td>
_END;
include "Templates/footer.php";

echo <<<_END
	    </td>
	  </tr>
	</table>
</body>
</html>
_END;

mysql_close($db_server);
?>