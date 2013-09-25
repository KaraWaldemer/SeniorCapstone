<?php
session_start();
/*
@File: Links.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates a page which displays related links
*/

$title = "Related Links";
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
if(isset($_SESSION['loggedIn'])) //determines which header to use based on if user is logged in
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
		<table>
		  <tr>
		    <td>
		     <u>Stray Rescue <a href="http://strayrescue.org/">Homepage</a>:</u><br />
		      Stray Rescue is an organization dedicated to rescuing and rehabilitating abused and abandoned animals in the Metro Saint Louis area.
		      <hr width="75%" align="center">
		    </td>
		  </tr>
		  <tr>
		    <td>
		      <u>Bi-State Pet Food Pantry <a href="http://www.bistatepetfoodpantry.org/">Homepage</a>:</u><br />
		      The Bi-State Pet Food Pantry is a local organization which collects pet food, treats, and care items. <br />
		      On a monthly basis, they hold a distribution day where they give those in need supplys to care for their pets.
		      <hr width="75%" align="center">
		    </td>
		  </tr>
		  <tr>
		    <td>
		      <u>Animal Protective Association of Missori <a href="http://www.apamo.org/home.aspx">Homepage</a>:</u><br />
		      The Animal Protective Association of Missouri is a non-profit organization dedicated to bringing people<br />
		      and pets together, advancing humane education and creating programs beneficial to the human/animal bond.
		      <hr width="75%" align="center">
		    </td>
		  </tr>
		  <tr>
		    <td>
		      <u>Follow Stray Rescue on <a href="http://www.facebook.com/StrayRescue">Facebook</a>:</u><br />
		      If you have a Facebook account, like our page to recieve the latest updates and pictures.
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