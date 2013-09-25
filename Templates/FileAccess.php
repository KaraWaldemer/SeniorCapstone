<?php
/*
@File: FileAccess.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains functions used to manipulate files provided by users
*/

/*
@Function: uploadImage
@Input: $file, reference to the proper element of the global $_FILE variable
		$name, name of the new file to be stored on the server.
@Output: Success message with the path of the stored image
*/
function uploadImage($file, $name)
{
	move_uploaded_file($file["tmp_name"],
	"images/uploads/" . $name);
	return "Stored in: " . "images/uploads/" . $name;
}

/*
@Function: getExtension
@Input: $str, the file name that the user provides
@Output: Empty string if no extension found else a string containing the extension
*/
function getExtension($str)
{
  $i = strpos($str,".");
  if(!$i) { return ""; }
  $l = strlen($str) - $i;
  $ext = substr($str, $i+1, $l);
  return $ext;
}
?>