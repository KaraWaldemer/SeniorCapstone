<?php
session_start();
/*
@File: AboutUs.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page with About Us information
*/

$title = "About Us";
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
if(isset($_SESSION['loggedIn'])) //checks if a user is logged in and displays appropriate header
{
include "Templates/header2.php";
}
else
{
include "Templates/header1.php";
}

echo <<<_END
	    </td>
	  </tr>
	  <tr>
	    <td height="80%" align="center" valign="top">
		<h2><u>What is Stray Rescue of Saint Louis?</u></h2>
		<p>Stray Rescue's sole purpose is to rescue stray animals in need of medical attention, restore them to health,<br />
		   and place them in loving adoptive homes. Virtually all of the pets we save have been abused and neglected.<br />
		   They've been dumped on highways, or remote country roads. Abandoned in public parks, empty houses and dark alleys.<br />
		   We've saved dogs left chained behind buildings after their owners had moved away.</p>
		<p>Rescued animals often make the best pets. As a no-kill organization, pets from Stray Rescue seem to understand that<br />
		   they have a second lease on life. in return for a little affection and attention, these remarable animals reward<br />
		   their new owners with a love and loyalty unmatched anywhere.</p>
		    <hr width='50%' align='center'>

		<h2><u>What is the Virtual Lost Dog Bulletin Board?</u></h2>
		<p>The purpose of this website is to provide a centralized location for keeping records of missing dogs in the <br />
		   Metro Saint Louis area. This tool allows users to view detailed records of dogs which are missing and found in the region.<br />
		   It also allows the user to create records of dogs that they have either lost or found which will then be compared with <br />
		   other records in order to find possible matches.</p>
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
?>