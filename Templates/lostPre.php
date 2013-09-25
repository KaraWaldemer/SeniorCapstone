<?php
/*
@File: lostPre.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the preview of recently lost dogs which appears on the homepage
*/

$lost = find(0); //retrieve all lost entries
$size = findSize($lost);
echo "<table><tr><td align='center'><h3><u>Lost Pets</u></h3></td></tr>";

/*
Check number of elements in lost table.
Displays the first four or as many as there are if less than 4.
*/
if($size > 4)
{
    for($i = 0; $i < 4; $i++)
    {
		$row = mysql_fetch_row($lost);
		echo populate($row);
    }
}
else
{
    for($i = 0; $i < $size; $i++)
    {
		$row = mysql_fetch_row($lost);
		echo populate($row);
    }
}
echo submitButton('Lost.php'); //used to open lost page with all entries
echo "</table>";

?>