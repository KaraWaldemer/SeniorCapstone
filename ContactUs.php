<?php
session_start();
/*
@File: ContactUs.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates page for viewing contact information
*/

$title = "Contact Us";
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
	    <td height="80%" align='center' valign='top'>
		<h1><u>Contact Information</u></h1><br />
		<table>
		  <tr>
		    <td>
			<h2>By Email</h2><br />
			You may contact the webpage designer, Kyle Wolter, at kwolter1@slu.edu with any questions.<br />
		    </td>
		  </tr>
		  <tr>
		    <td>
		    <hr width='75%' align='center'>
		    </td>
		  </tr>
		  <tr>
		    <td>
			<h2>By Phone</h2><br />
			Office number for Stray Rescue: (314)771-6121<br />
			Fax: (314)621-3109<br />
		    </td>
		  </tr>
		  <tr>
		    <td>
		    <hr width='75%' align='center'>
		    </td>
		  <tr>
		  <tr>
		    <td>
			<h2>By Mail</h2><br />
			Stray Rescue of St. Louis<br />
			2320 Pine Street<br />
			St. Louis, MO 63103
		    </td>
		  </tr>
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
?>