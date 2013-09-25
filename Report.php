<?php
session_start();
/*
@File: Report.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page for users to report lost/found pets
*/

$title = "Report Lost/Found Dog";
include "Templates/dcalls.php";
include "Templates/errors.php";
include "Templates/FileAccess.php";

$db_server = login();
$nColor = $aColor = $wColor = $dateColor = $lColor = $fColor = $hColor = $pColor = 'black';
$pError = "";

//define("MAX_SIZE","100");
$errors2 = 0;

if(isset($_POST['type'])) //verifies a type of record is selected
{
	$type = get_post('type'); //gets the type

	if($type == 'Lost') //if lost entry
	{
		/*populates variables for fields that are required*/
		$nError = element_required($_POST['Name']);
		$aError = element_required($_POST['age']);
		$wError = element_required($_POST['weight']);
		$dateError = date_filled($_POST['month'], $_POST['day'], $_POST['year']);
		$lError = element_required($_POST['location']);

		/*verifies all required fields are filled in*/
		if(strlen($nColor) == 5 &&
		   strlen($aColor) == 5 &&
		   strlen($wColor) == 5 &&
		   strlen($dateColor) == 5 &&
		   strlen($lColor) == 5)
		{
			$name = get_post('Name');
			$age = get_post('age');
			$gender = get_post('gender');
			$weight = get_post('weight');
			$month = get_post('month');
			$day = get_post('day');
			$year = get_post('year');
			$hour = get_post('hour');
			$minute = get_post('minute');
			$aop = get_post('aop');
			$loc = get_post('location');

			$result = insertPet($db_server, $name, $age, $gender, $weight, $year, $month, $day, $hour, $minute, $aop, $loc, '0'); //creates entry in db for new pet

			/*Makes sure the features field is filled in*/
			$fColor = element_required($_POST['features']);
			if(strlen($fColor) == 5)
			{
			    $ftrs = explode(", ", get_post('features'));
			    $fsize = count($ftrs);
			    for($i = 0; $i < $fsize; $i++) //inserts each individual feature
			    {
				insertFeature($db_server, $ftrs[$i]);
			    }
			}

			/*checks if the health field is filled in and populates the db as required*/
			if(filledIn($_POST['health']))
			{
			    $hlth = explode(", ", get_post('health'));
			    $hsize = count($hlth);
			    for($i = 0; $i < $hsize; $i++)
			    {
				insertHealth($db_server, $hlth[$i]);
			    }
			}

			/*checks if an image was uploaded then performs checks on the file before transfering it to the server and updates the db*/
			if(isset($_FILES['file']))
			{
			    $rtn = checkFile($_FILES['file']);
			    if(strlen($rtn) != 6)
			    {
				$pError = uploadImage($_FILES['file'], $rtn);
				insertImage($result, $rtn);
			    }
			    else
			    {
				$pError = $rtn;
			    }
			}
		}
	}
	else //found type is selected
	{
		/*populates variables for required fields*/
		$dateColor = date_filled($_POST['month'], $_POST['day'], $_POST['year']);
		$lColor = element_required($_POST['location']);

		/*verifies all required fields are filled in*/
		if(strlen($dateColor) == 5 && strlen($lColor) == 5)
		{
			$name = get_post('Name');
			$age = get_post('age');
			$gender = get_post('gender');
			$weight = get_post('weight');
			$month = get_post('month');
			$day = get_post('day');
			$year = get_post('year');
			$hour = get_post('hour');
			$minute = get_post('minute');
			$aop = get_post('aop');
			$loc = get_post('location');

			$result = insertPet($db_server, $name, $age, $gender, $weight, $year, $month, $day, $hour, $min, $aop, $loc, '1'); //creates new pet entry

			/*verifies the features field is populated and updates the db as required*/
			$fColor = element_required($_POST['features']);
			if(strlen($fColor) == 5)
			{
			    $ftrs = explode(", ", get_post('features'));
			    $fsize = count($ftrs);
			    for($i = 0; $i < $fsize; $i++)
			    {
				insertFeature($db_server, $ftrs[$i]);
			    }
			}

			/*checks if the health field is populated and updates db as required*/
			if(filledIn($_POST['health']))
			{
			    $hlth = explode(", ", get_post('health'));
			    $hsize = count($hlth);
			    for($i = 0; $i < $hsize; $i++)
			    {
				insertHealth($db_server, $hlth[$i]);
			    }
			}

			/*checks if image uploaded then transfers it to the server and update the db as required*/
			if(isset($_FILES['file']))
			{
			    $rtn = checkFile($_FILES['file']);
			    if(strlen($rtn) != 6)
			    {
				$pError = uploadImage($_FILES['file'], $rtn);
				insertImage($result, $rtn);
			    }
			    else
			    {
				$pError = $rtn;
			    }
			}
		}
	}
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
if(isset($_SESSION['loggedIn'])) //a user is logged in
{
include "Templates/header2.php";

echo <<<_END
	    </td>
	  </tr>
	  <tr>
	    <td height="80%" valign='top'>
	      <table>
		<tr>
<form method="post" action="Report.php" enctype="multipart/form-data">
	<td>
	Report Type:</td><td> <select name="type">
					<option value="Lost">Lost</option>
					<option value="Found">Found</option>
				 </select></td></tr>
	<tr><td>Name:</td><td> <input type="text" name="Name" size="10" /> <font color=$nColor> * </font></td></tr>
	<tr><td>Age:</td><td> <select name="age">
			<option value="Young (< 3yrs)">Young (< 3yrs)</option>
			<option value="Adult (3-8yrs)">Adult (3-8yrs)</option>
			<option value="Senior (9+yrs)">Senior (9+yrs)</option>
			<option value="Unknown">Unknown</option>
	      </select></td></tr>
	<tr><td>Gender:</td><td> <select name="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select></td></tr>
	<tr><td>Weight:</td><td> <select name="weight">
			<option value="Small (< 27lbs)">Small (< 27lbs)</option>
			<option value="Medium (28-57lbs)">Medium (28-57lbs)</option>
			<option value="Large (58-97lbs)">Large (58-97lbs)</option>
			<option value="X-Large (> 98lbs)">X-Large (> 98lbs)</option>
		</select></td></tr>
	<tr><td>Date:</td><td>	<input type="text" name="month" size="2" maxlength="2" />/<input type="text" name="day" size="2" maxlength="2" />/<input type="text" name="year" size="4" maxlength="4" /><font color=$dColor> * </font> (mm/dd/yyy)</td></tr>
	<tr><td>Time:</td><td>	<select name="hour">
_END;
for($i=1; $i<13; $i++)
{
	$value = pad($i);
	echo "<option value=\"$value\">$value</option>";
}
echo <<<_END
			</select>:
			<select name="minute">
_END;
for($i=0; $i<60; $i++)
{
	$value = pad($i);
	echo "<option value=\"$value\">$value</option>";
}
echo <<<_END
			</select>
			<select name="aop">
				<option value="AM">AM</option>
				<option value="PM">PM</option>
			</select></td></tr>

	<tr><td>Location:</td><td> <input type="textarea" name="location" size="100" /> <font color=$lColor> * </font> (Specific address or intersection)</td></tr>
	<tr><td>Features:</td><td> <input type="textarea" name="features" size="100" /> <font color=$fColor> * </font> Separate features with a comma (ie: breed, coloring, etc.)</td></tr>
	<tr><td>Health Issues:</td><td> <input type="textarea" name="health" size="100" /> Seperate issues with a comma (ie: poor eyesight, diabetes, etc.)</td></tr>
	<tr><td>Upload Picture:</td><td> <input type="file" name="file" id="file"/> </td></tr>
	<tr><td colspan="2"><input type="submit" name="Submit" value="Submit" /></td></tr>
</form>
<tr><td colspan="2">* Required Field</td></tr>
	      </table>
	    </td>
	  </tr>
	  <tr>
	    <td>
_END;
}
else //no user is logged in so block this feature until logged in
{
include "Templates/header1.php";
echo <<<_END
	    </td>
	  </tr>
	  <tr>
	    <td height="80%" valign='top' align='center'>
		Please log in or register to use this feature.<br />
		<form method="post" action="Report.php">
		    <input type="button" value="Log In" onclick=window.location.href="login.php" />
		    <input type="button" value="Register" onclick=window.location.href="register.php" />
		</form>
	    </td>
	  </tr>
	  <tr>
	    <td>
_END;
}


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