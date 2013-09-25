<?php
session_start();
/*
@File: Lost.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page which displays the entries for lost dogs
*/
require_once "Templates/info.php";
$title = "Lost Dog Listings";
include "Templates/dcalls.php";

$db_server = login();

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
if(isset($_SESSION['loggedIn'])) //display header based on if user is logged in
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
	    <td height="80%" valign='top'>
_END;

/*gets all lost entries and displays them*/
$result = find('0');
$rows = findSize($result);

for($j = 0; $j < $rows; ++$j)
{
	$row = mysql_fetch_row($result);

echo <<<_END
Name: $row[2]<br />
Age: $row[3]<br />
Gender: $row[4]<br /><br />
<form method="post" action="PetDetail.php">
<input type="hidden" name='Entry' value=$row[0] />
<input type="submit" name='Details' value='Details'/>
</form>


<hr width="75%" align="center">
_END;
}

echo <<<_END
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