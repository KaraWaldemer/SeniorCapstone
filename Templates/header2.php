<?php
/*
@File: header2.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the header that appears on pages when a user is logged in
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
	<td width="20%" align="right" valign="top">
	    <form method="post" action="logout.php">
		<input type="button" value="Log Out" onclick=window.location.href="logout.php" />
	    </form>
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