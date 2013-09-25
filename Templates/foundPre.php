<?php
/*
@File: foundPre.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the preview of recent found pets which appears on the homepage
*/


$found = find(1); //retrieve all found entries
$size = findSize($found);
echo "<table><tr><td align='center'><h3><u>Found Pets</u></h3></td></tr>";

/*
Checks number of elements in Found table.
Populates preview with the first four entries
or as many as there are if less than 4.
*/
if($size > 4)
{
    for($i = 0; $i < 4; $i++)
    {
		$row = mysql_fetch_row($found);
		echo populate($row);
	}
}
else
{
    for($i = 0; $i < $size; $i++)
    {
		$row = mysql_fetch_row($found);
		echo populate($row);
    }
}
echo submitButton('Found.php'); //used to open found page with all found entries
echo "</table>";

?>