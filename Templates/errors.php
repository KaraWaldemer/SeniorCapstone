<?php
/*
@File: errors.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains Functions used across the project to spot and report errors
*/

/*
@Function: element_required
@Input: $post, an element of a form which is required to continue
@Output: returns black if the field is filled in, else red
*/
function element_required($post)
{
  if(filledIn($post))
  {
      return 'black';
  }
  else
  {
      return 'red';
  }
}

/*
@Function: filledIn
@Input: $post, an element of a form
@Output: returns true if the element is filled in with a length greater than zero, else false
*/
function filledIn($post)
{
  if(isset($post) && strlen($post) != 0)
  {
    return true;
  }
  else
  {
      return false;
  }
}

/*
@Function: date_filled
@Input: $m, the month element of the form
		$d, the day element of the form
		$y, the year element of the form
@Output: returns red if any of the three fields is not filled in, else returns black
*/
function date_filled($m, $d, $y)
{
  if(element_required($m) == 'red' || strlen(element_required($d)) == 'red' || strlen(element_required($y)) == 'red')
  {
      return 'red';
  }
  else
  {
      return 'black';
  }
}

/*
@Function: user_exist
@Input: $rows, the number of users stored in the database
		$result, reference to list of entries
		$email, the username provided
		$pword, the password provided
		$correct, control variable
@Output: Empty string if $email and $pword matched a user in the database, else error string
*/
function user_exist($rows, $result, $email, $pword, $correct)
{
	for($j = 0; $j < $rows; ++$j)
	{
		$row = mysql_fetch_row($result);

		if($row[0] == $email && $row[4] == $pword)
		{
		    $correct = 1;
		    $_SESSION['user'] = $email; //updates the session variable which indicates who is logged in
		}
	}

	if($correct == 1)
	{
		$_SESSION['loggedIn'] = TRUE; //updates the session variable which indicates a user is logged in
		header('Location: index.php'); //loads the homepage upon successful login
		return "";
	}
	else
	{
		return "Invalid email/password combination";
	}
}

/*
@Function: checkFile
@Input: $file, reference to proper element of the global variable $_FILE
@Output: The revised name of the file to be stored if all checks are sucessful, else error string
*/
function checkFile($file)
{
	if((($file["type"] == "image/gif")
		|| ($file["type"] == "image/jpeg")
		|| ($file["type"] == "image/pjpeg")
		|| ($file["type"] == "image/jpg")
		|| ($file["type"] == "image/png"))) //verifies that the file is the one of the approved types
	{
		if($file["error"] > 0) //there was some error in the upload from the form
		{
		  return "Error1";
		}
		else
		{
		  $fName = time() . $file['name'];//creates a unique file name by appending the current time stamp to the front
		  if(file_exists("images/uploads" . $fName)) //double check that the file name is unique
		  {
			return "Error2";
		  }
		  else
		  {
			return $fName;
		  }
		}
	}
	else
	{
	  return "Error3"; //incorrect type
	}
}

/*
@Function: isYours
@Input: $id, reference to a list containing the information on the pet being viewed
@Output: Returns true if the particular pet entry was created by the currently logged in user
*/
function isYours($id)
{
    $row = mysql_fetch_row(getOwner($id));
    if(strcmp($row[0], $_SESSION['user']) == 0)//checks if the currently logged in user is the owner of the specified record
    {
		return TRUE;
    }
    else
    { return FALSE; }
}
?>