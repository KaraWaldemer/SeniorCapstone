<?php
session_start();
/*
@File: forgot.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates a page that allows users to change their password
*/

require_once "Templates/info.php";
$title = "Forgot Password";
include "Templates/dcalls.php";
include "Templates/errors.php";

$db_server = login();

$correct = 0;
$error = "";

if($_SESSION['fCount'] == 0) //error handling variable checks
{
    $uColor = $aColor = $p1color = $p2color = 'black';
}
else
{
	/*populate variables for required fields*/
    $uColor = element_required($_POST['email']);
    $aColor = element_required($_POST['ans']);
    $p1Color = element_required($_POST['pword1']);
    $p2Color = element_required($_POST['pword2']);
}

/*verifies all elements are filled in*/
if($_SESSION['fCount'] > 0 &&
	strlen($uColor) == 5 &&
	strlen($aColor) == 5 &&
	strlen($p1Color) == 5 &&
	strlen($p2Color) == 5)
{
	$_SESSION['fCount'] = 0;
	$email = get_post('email');
	$question = get_post('question');
	$ans = get_post('ans');
	$pword1 = get_post('pword1');
	$pword2 = get_post('pword2');

	if($pword1 != $pword2) //verifies new passwords match
	{
		echo "New passwords must match.<br />";
	}
	else
	{
		$result = getUsers();
		$rows = findSize($result);

		for($j = 0; $j < $rows; ++$j)
		{
			$row = mysql_fetch_row($result);

			if($row[0] == $email && $row[5] == $question && $row[6] == $ans)
			{ $correct = 1; }
		}
		if($correct == 1)
		{
			$query = "UPDATE $db_database.user SET Password = '$pword1' WHERE user_id = '$email'";

			if(!mysql_query($query, $db_server))
				echo "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />";

			header('Location: login.php');
		}
		else
		{
			$error = "Invalid information entered";
		}
	}
}
else
{
      $_SESSION['fCount']++;
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
<form method="post" action="forgot.php">
	<tr><td>User Name/Email:</td><td> <input type="text" name="email" /><font color=$uColor> * </font></td></tr>
	<tr><td>Security Question:</td><td> <select name="question">
		<option value="Q1">What is your mothers maiden name?</option>
		<option value="Q2">What city were you born in?</option>
		<option value="Q3">What is the name of your first pet?</option>
	</select></td></tr>
	<tr><td>Answer:</td><td> <input type="text" name="ans" /><font color=$aColor> * </font></td></tr>
	<tr><td>New Password:</td><td> <input type="password" name="pword1" /><font color=$p1Color> * </font></td></tr>
	<tr><td>Verify Password:</td><td> <input type="password" name="pword2" /><font color=$p2Color> * </font></td></tr>
	<tr><td><input type="submit" value="Update" /></td>
	<td><input type="button" value="Return to Log In" onclick="window.location.href='login.php'" /></td></tr>
</form>
<tr><td colspan="2">* Required Field </td></tr>
<tr><td colspan="2">$error</td></tr>
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