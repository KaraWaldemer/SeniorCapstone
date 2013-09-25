<?php
session_start();
/*
@File: register.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page a user can use to create a new account
*/

$title = "Register New User";
require_once "Templates/info.php";
include "Templates/dcalls.php";
include "Templates/errors.php";

$db_server = login();

$email_error = "";
$password_error = "";
$existing = "";

if($_SESSION['regCount'] == 0) //check used to show when required fields are left off
{
    $fnColor = $lnColor = $pColor = $e1Color = $e2Color = $pw1Color = $pw2Color = $aColor = 'black';
}
else
{
	/*populate variables for required fields*/
    $fnColor = element_required($_POST['fname']);
    $lnColor = element_required($_POST['lname']);
    $pColor = element_required($_POST['phone']);
    $e1Color = element_required($_POST['email']);
    $e2Color = element_required($_POST['email2']);
    $pw1Color = element_required($_POST['pword']);
    $pw2Color = element_required($_POST['pword2']);
    $aColor = element_required($_POST['ans']);
}

/*All required fields are filled in*/
if($_SESSION['regCount'] > 0 &&
      strlen($fnColor) == 5 &&
      strlen($lnColor) == 5 &&
      strlen($pColor) == 5 &&
      strlen($e1Color) == 5 &&
      strlen($e2Color) == 5 &&
      strlen($pw1Color) == 5 &&
      strlen($pw2Color) == 5 &&
      strlen($aColor) == 5)
{
	$_SESSION['regCount'] = 0;
	$fName = get_post('fname');
	$lName = get_post('lname');
	$phone = get_post('phone');
	$email1 = get_post('email');
	$email2 = get_post('email2');
	$pword1 = get_post('pword');
	$pword2 = get_post('pword2');
	$question = get_post('question');
	$ans = get_post('ans');

	if($email1 != $email2)
	{ $email_error = "Emails need to match"; }
	else if($pword1 != $pword2)
	{ $password_error = "Passwords need to match"; }
	else
	{
		insertUser($db_server, $email1, $fName, $lName, $phone, $pword1, $question, $ans, $existing); //create new user entry
	}
}
else
{
    $_SESSION['regCount']++;
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
<form method="post" action="register.php">
	<tr><td>First Name:</td><td> <input type="text" name="fname" /><font color=$fnColor> * </font></td></tr>
	<tr><td>Last Name:</td><td> <input type="text" name="lname" /><font color=$lnColor> * </font></td></tr>
	<tr><td>Phone Number:</td><td> <input type="text" name="phone" /><font color=$pColor> * </font> (xxx-xxx-xxxx)</td></tr>
	<tr><td>Username/Email:</td><td> <input type="text" name="email" /><font color=$e1Color> * </font>$email_error</td></tr>
	<tr><td>Confirm UN/Email:</td><td> <input type="text" name="email2" /><font color=$e2Color> * </font></td></tr>
	<tr><td>Password:</td><td> <input type="password" name="pword" /><font color=$pw1Color> * </font>$password_error</td></tr>
	<tr><td>Confirm Password:</td><td> <input type="password" name="pword2" /><font color=$pw2Color> * </font></td></tr>
	<tr><td>Security Question:</td><td> <select name="question">
		<option value="Q1">What is your mothers maiden name?</option>
		<option value="Q2">What city were you born in?</option>
		<option value="Q3">What is the name of your first pet?</option>
	</select></td></tr>
	<tr><td>Answer:</td><td> <input type="text" name="ans"><font color=$aColor> * </font></td></tr>
	<tr><td colspan="2"><input type="submit" value="Register" /></td></tr>
</form>
<tr><td colspan="2">* Required Field </td></tr>
<tr><td colspan="2">$existing</td></tr>
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