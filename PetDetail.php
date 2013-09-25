<?php
session_start();
/*
@File: PetDetail.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates page to view details on a selected pet
*/

require_once "Templates/info.php";
$title = "Pet Details";
include "Templates/dcalls.php";
include "Templates/Matching.php";
include "Templates/errors.php";
require "Templates/Preview.php"; //---------------------new require

$Name = "";
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

if(isset($_SESSION['loggedIn'])) //check if user is logged in to decide which header to use
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

if(isset($_POST['Entry'])) //populate result as required if page reached by post method
{
    $result = mysql_fetch_row(details($_POST['Entry']));

}
else if(isset($_GET["id"])) //populate result as required if page was reached by get method
{
  $result = mysql_fetch_row(details($_GET["id"]));
}
else //page was reached by a non-supported method
{
    $result = -1;
}

/*verifies page was reached in a proper way*/
$rsltSize = count($result);
if(count($rsltSize) > 0)
{
    $id = $result[0];
    $pic = mysql_fetch_row(getPic($id));
    $tpe = mysql_fetch_row(getTpe($id));

    $yours = isYours($result[0]); //checks if the logged in user owns this record

    if($tpe[0] == 0)
    {
	$type = "Lost";
	$type2 = 1;
    }
    else
    {
	$type = "Found";
	$type2 = 0;
    }

	/*uses uploaded photo if found else uses default image*/
    if(strlen($pic[1]) > 0)
    {
	  $img = "images/uploads/" . $pic[1];
    }
    else
    {
	  $img = "images/noImage.gif";
    }

    $location = str_replace(' ', '+', $result[8]); //creates variable on location data tailored to google maps format

echo <<<_END
  <center>
    <table>
      <tr>
	<td>
	  <table>
	  	<tr> //--------------------New row--------------
	  		<td>Type:</td>
	  		<td>$type</td>
	  	</tr>
	    <tr>
	      <td>Name:</td>
	      <td>$result[2]</td>
	    </tr>
	    <tr>
	      <td>Age: </td>
	      <td>$result[3]</td>
	    </tr>
	    <tr>
	      <td>Gender: </td>
	      <td>$result[4]</td>
	    </tr>
	    <tr>
	      <td>Weight: </td>
	      <td>$result[5] lbs</td>
	    </tr>
	    <tr>
	      <td>Date $type: </td>
	      <td>$result[6]</td>
	    </tr>
	    <tr>
	      <td>Time $type: </td>
	      <td>$result[7]</td>
	    </tr>
	    <tr>
	      <td>Location: </td>
	      <td>$result[8]</td>
	    </tr>
	    <tr>
	      <td valign="top">Features:</td>
	      <td>
_END;
$ftrs = get_Features($id);
$fsize = findSize($ftrs);

for($i = 0; $i < $fsize; $i++)
{
    $row = mysql_fetch_row($ftrs);
    echo "&#149 $row[0]<br />";
}
echo <<<_END
	      </td>
	    </tr>
	    <tr>
	      <td valign="top">Health Issues:</td>
	      <td>
_END;
$hlth = get_Health($id);
$hsize = findSize($hlth);

for($i = 0; $i < $hsize; $i++)
{
    $row = mysql_fetch_row($hlth);
    echo "&#149 $row[0]<br />";
}
echo <<<_END
	      </td>
	    </tr>
	  </table>
	</td>
	<td>
	  <img src='$img' height="200" width="200"/>
	</td>
	<td>
	    <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=$location&amp;aq=0&amp;oq=$location&amp;sll=37.0625,-95.677068&amp;sspn=55.937499,134.736328&amp;ie=UTF8&amp;hq=&amp;hnear=$location&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=$location&amp;aq=0&amp;oq=$location&amp;sll=37.0625,-95.677068&amp;sspn=55.937499,134.736328&amp;ie=UTF8&amp;hq=&amp;hnear=$location&amp;t=m&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>
	</td>
      </tr>
_END;

if($yours) //if entry belongs to the currently logged in user display any possible matches to that record
{
$similars = compare($db_server, $id, $type2);
$sze = count($similars);

if($sze != 0)
{
    echo "<tr><td colspan='3'><center><u>Possible Matches:</u></center></td></tr><tr><td colspan='3'><table><tr>";
    for($i = 0; $i < $sze; $i++)
    {
	$tmpID = $similars[$i][0];
	$temp = mysql_fetch_row(details($tmpID));
	echo "<td><table>";
	echo "<tr><td>Name:</td><td>" . $temp[2] . "</td></tr>";
	echo "<tr><td>Date $invType:</td><td>" . $temp[6] . "</td></tr>";
	echo "<tr><td colspan='2'><a href='PetDetail.php?id=$tmpID'>See More</a></td></tr></table></td>";
    }
echo <<<_END
      </tr>
    </table>
_END;
}
}
echo <<<_END
      </tr>
    </table>
  </center>
_END;



}
else //displays error data if page reach in an incorrect way
{
    echo "No Available Data";

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