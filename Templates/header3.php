<?php
/*
@File: header3.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the header which appears on pages that deal with user manipulation
*/

echo <<<_END
<table bgcolor="Khaki" width="100%">
    <tr>
	<td width="20%">
	    <img src="images//StrayRescue.png" height=100 width=70 style="float: left;">
	</td>
	<td class="title">
	    $title
	    <br />
	</td>
	<td width="20%">
	</td>
    </tr>
    <tr>
	<td colspan="3">
	    <center><table bgcolor="blue" width="90%">
		<tr>
		    <td class="linkbar"><a class="bar" href="index.php">Home</a></td>
		    <td class="linkbar"><a class="bar" href="Lost.php">Lost</a></td>
		    <td class="linkbar"><a class="bar" href="Found.php">Found</a></td>
		    <td class="linkbar"><a class="bar" href="Report.php">Report</a></td>
		    <td class="linkbar"><a class="bar" href="News.php">News</a></td>
		    <td class="linkbar"><a class="bar" href="Links.php">Links</a></td>
		    <td class="linkbar"><a class="bar" href="AboutUs.php">About Us</a></td>
		    <td class="linkbar"><a class="bar" href="ContactUs.php">Contact Us</a></td>
		</tr>
	    </table></center>
	</td>
    </tr>
</table>
_END;
?>