<?php
/*
@File: dcalls.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains Functions used across the project to manipulate the database.
*/

require_once 'info.php';

/*
@Function: login
@Input: None
@Output: Returns reference to database instance or error string
*/
function login()
{
global $db_hostname, $db_username, $db_password, $db_database; //global variables from info.php

$db_server = mysql_connect("$db_hostname", "$db_username", "$db_password");

if(!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database, $db_server)
	or die("Unable to select database: " . mysql_error());

return $db_server;
}

/*
@Function: getOwner
@Input: $id, the entry_id of the current entry being viewed
@Output: Returns result of query or error string
*/
function getOwner($id)
{
    $query = "SELECT User_ID from entries where Entry_ID=" . $id; //determines the username associated with a given entry
    $result = mysql_query($query);

    if(!$result) die ("Database access failed 4: " . mysql_error());

    return $result;
}

/*
@Function: alterUser
@Input: None
@Output: None
@Purpose: change the password for a user
*/
function alterUser()
{
$result = getUsers();
		$rows = findSize($result);

		for($j = 0; $j < $rows; ++$j) //steps through the users in the database
		{
			$row = mysql_fetch_row($result);

			if($row[0] == $email && $row[5] == $question && $row[6] == $ans) //checks the input values against those in the database
			{ $correct = 1; }
		}
		if($correct == 1) //a match was found
		{
			$query = "UPDATE $db_database.user SET Password = '$pword1' WHERE user_id = '$email'"; //changes the password of the user

			if(!mysql_query($query, $db_server))
				echo "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />";

			header('Location: login.php');
		}
		else
		{
			$error = "Invalid information entered";
		}
}

/*
@Function: find
@Input: $type, the type of record desired
@Output: Returns result of query or error string
*/
function find($type)
{
  $query = "SELECT * FROM pet NATURAL JOIN entries WHERE Entry_Type=" . $type . " ORDER BY Entry_ID"; //gets all entries of the specified type ordered by when entered in database
  $result = mysql_query($query);

  if(!$result) die ("Database access failed 3: " . mysql_error());

  return $result;
}

/*
@Function: get_Features
@Input: $id, entry_id of the pet we want the features for
@Output: Returns result of query or error string
*/
function get_Features($id)
{
    $query = "SELECT Feature FROM features WHERE Entry_ID=" . $id;
     $result = mysql_query($query);
    if(!$result) die ("Database access failed 1: " . mysql_error());

    return $result;
}

/*
@Function: get_Health
@Input: $id, entry_id of the pet we want the health issues for
@Output: Returns result of query or error string
*/
function get_Health($id)
{
    $query = "SELECT Health_Issue FROM health WHERE Entry_ID=" . $id;
     $result = mysql_query($query);
    if(!$result) die ("Database access failed 10: " . mysql_error());

    return $result;
}

/*
@Function: details
@Input: $ENum, entry_id of the pet you want details on
@Output: Returns result of query or error string
*/
function details($ENum)
{
  $query = "SELECT * FROM pet where Entry_ID=" . $ENum;
  $result = mysql_query($query);

  if(!$result) die ("Database access failed 2: " . mysql_error());

  return $result;
}

/*
@Function: getImg
@Input: $ENum, Entry_id whose pic you want to find
@Output: Returns result of query or error string
*/
function getImg($ENum)
{
  $query = "SELECT * FROM image where Entry_ID=" . $ENum;
  $result = mysql_query($query);

  if(!$result) die ("Database access failed: " . mysql_error());

  return $result;
}

/*
@Function: getUsers
@Input: $db_server, reference to the instance of the database being used
@Output: Returns result of the query or error string
*/
function getUsers($db_server)
{
$query = "SELECT * FROM user";
	$result = mysql_query($query);

	if(!$result) die ("Database access failed: " . mysql_error());

return $result;
}

/*
@Function: insertUser
@Input: $db_server, reference to the instance of the database being used
		$e, the username of the user to be inserted
		$f, the first name of the user to be inserted
		$l, the last name of the user to be inserted
		$p, the phone number of the user to be inserted
		$pw, the password of the user to be inserted
		$q, the security question of the user to be inserted
		$a, the security answer of the to be inserted
		$existing, error string
@Output: None
*/
function insertUser($db_server, $e, $f, $l, $p, $pw, $q, $a, $existing)
{
		$query = "INSERT INTO user VALUES" .
					"('$e', '$f', '$l', '$p', '$pw', '$q', '$a')";

		if(!mysql_query($query, $db_server))
		{
			if(mysql_errno() == 1062) //Primary key duplication
			{
			    $existing = "That email address has already been used, please choose another";
			}
		}
		else
		{
			$_SESSION['loggedIn'] = TRUE; //indicates someone is logged in
			$_SESSION['user'] = $e; //indicates who is logged in
			header('Location: index.php'); //opens homepage
		}
}

/*
@Function: insertPet
@Input: $db_server, reference to the instance of the database being used
		$n, the name of the pet to be inserted
		$a, the age of the pet to be inserted
		$g, the gender of the pet to be inserted
		$w, the weight class of the pet to be inserted
		$y, the year associated with the pet to be inserted
		$m, the month associated with the pet to be inserted
		$d, the day associated with the pet to be inserted
		$h, the hour associated with the pet to be inserted
		$min, the minute associate with the pet to be inserted
		$aop, the time of day associated with the pet to be inserted
		$loc, the location associated with the pet to be inserted
		$tpe, the type of the pet entry to be inserted
@Output: Returns the entry_id of the newly submitted pet upon sucess, else error code
*/
function insertPet($db_server, $n, $a, $g, $w, $y, $m, $d, $h, $min, $aop, $loc, $tpe)
{
	$date = $y . "-" . $m . "-" . $d; //format date
	$time = $h . ":" . $m . " " . $aop; //format time
	$query = "INSERT INTO pet VALUES (NULL, 'Dog', '$n', '$a', '$g', '$w', '$date', '$time', '$loc')"; //creates new pet entry with provided data
	if(!mysql_query($query, $db_server))
		return -1;
	else
	{
		$id = mysql_insert_id(); //retrieves the most recently used entry_id
		$usr = $_SESSION['user']; //associates the currently logged in user with this entry
		$query = "INSERT INTO entries VALUES ('$usr', $id, '$tpe')"; //creates new entries entry with provided data
		if(!mysql_query($query))
			return -2;
	}
	return $id;
}

/*
@Function: insertFeature
@Input: $db_server, reference to the instance of the database being used
		$feat, the feature to be inserted
@Output: Returns html code which creates a table populated and formatted with the data for that pet
*/
function insertFeature($db_server, $feat)
{
	$query = "INSERT INTO features VALUES (LAST_INSERT_ID(), '$feat')"; //inserts feature linked with the most recently used entry_id
		if(!mysql_query($query, $db_server))
			echo "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />";
}

/*
@Function: insertHealth
@Input: $db_server, reference to the instance of the database being used
		$health, the health issue to be inserted
@Output: None
*/
function insertHealth($db_server, $health)
{
	$query = "INSERT INTO health VALUES (LAST_INSERT_ID(), '$health')"; //inserts issue linked with the most recently used entry_ID
		if(!mysql_query($query, $db_server))
			echo "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />";
}

/*
@Function: inser
@Input: $id, the Entry_ID to associate with provided image
		$name, the path/name of the file to be associated with a specific entry
@Output: Returns error string or success string
*/
function insertImage($id, $name)
{
    $query = "INSERT INTO image VALUES ($id, '$name')";
	  if(!mysql_query($query))
	      return "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />";
	  else
	      return "worked";
}

/*
-------Depreciated---------
@Function: insertPic
@Input: $imagefile, the path/name of the file to be associated with a specific entry
@Output: None

function insertPic($imagefile)
{
	 $query = "INSERT INTO image VALUES (1, 1, '$imagefile', NULL, NULL, NULL)";
		 if(!mysql_query($query))
			echo "UPDATE failed: $query<br />" . mysql_error() . "<br /><br />"; //error string
}
*/

/*
@Function: findSize
@Input: $result, reference to list generated from a database call
@Output: Returns the number of elements in the list
*/
function findSize($result)
{
  $rows = mysql_num_rows($result);
  return $rows;
}

/*
@Function: get_post
@Input: $var, string entry from a form
@Output: Returns the string after it has escape strings removed
*/
function get_post($var)
{
	return mysql_real_escape_string($_POST[$var]);
}

/*
@Function: getPic
@Input: $entID, Entry_ID of the pet whose picture we want
@Output: Returns error string or reference to result containing image information
*/
function getPic($entID)
{
      $query = "SELECT * FROM image WHERE Entry_ID =" . $entID;
	  $result = mysql_query($query);
	  if(!$result)
	    return "Failed";
	  else
	    return $result;
}

/*
@Function: getGender
@Input: $id, Entry_ID of the pet we need the gender of
@Output: Returns error string or reference variable to result containing gender of specified pet
*/
function getGender($id)
{
      $query = "SELECT Gender From pet WHERE Entry_ID=" . $id;
	$result = mysql_query($query);
	  if(!$result)
	    return "UPDATE failed: $query<br />" . mysql_error() . "<br />";
	  else
	    return $result;
}

/*
@Function: getTpe
@Input: $id, Entry_ID of the pet we need the type of
@Output: Returns error string or reference to list of element(s) retrieved
*/
function getTpe($id)
{
    $query = "SELECT Entry_Type FROM entries WHERE Entry_ID=" . $id;
	$result = mysql_query($query);
	if(!$result)
	    return "SELECT failed: $query<br />" . mysql_error() . "<br />";
	else
	    return $result;
}

/*
--------------(COMMENTED OUT IN FINAL LIVE VERSION)---------------------
@Function: clearDB
@Input: None
@Output: None
@Purpose: Wipes Database of all entries. Used for cleanup and testing.

function clearDB()
{
    $query = "DELETE FROM user WHERE User_ID >= 0";
	mysql_query($query);

	$query = "DELETE FROM pet WHERE Entry_ID >= 0";
	mysql_query($query);

	$query = "DELETE FROM features WHERE Entry_ID >= 0";
	mysql_query($query);

	$query = "DELETE FROM health WHERE Entry_ID >= 0";
	mysql_query($query);

	$query = "DELETE FROM image WHERE Entry_ID >= 0";
	mysql_query($query);

	$query = "DELETE FROM entries WHERE Entry_ID >= 0";
	mysql_query($query);
}
*/

?>