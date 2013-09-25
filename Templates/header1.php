<?php
/*
@File: header1.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the header that appears on pages when no user is logged in
*/

echo <<<_END
<table bgcolor="Khaki" width="100%">
    <tr>
	<td width="20%">
	    <img src="images//StrayRescue.png") height=100 width=70 style="float: left;">
	</td>
	<td class="title">
	    $title
	    <br />
	</td>
	<td width="20%">
	    <form method="post" action="login.php">
		<table bgcolor="Khaki">
		    <tr>
			<td>
			    <font class="lin">User Name/Email: </font>
			</td>
			<td>
			    <input type="text" name="email" />
			</td>
		    </tr>
		    <tr>
			<td>
			    <font class="lin">Password: </font>
			</td>
			<td>
			    <input type="password" name="pword" />
			</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center">
			    <input type="submit" value="Log In" />
			    <input type="button" value="Register" onclick=window.location.href="register.php" />
			</td>
		    </tr>
		</table>
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

$_SESSION['linCount'] = 1;
?>