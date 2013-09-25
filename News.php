<?php
session_start();
/*
@File: News.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the page used to display related news records
*/

require "Templates/info.php";
$title = "Related News";
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
if(isset($_SESSION['loggedIn'])) //determines header based on if a user is logged in
{
include "Templates/header2.php";
}
else
{
include "Templates/header1.php";
}

if(isset($_POST['Entry'])) //populates variables based on article selected
{
    $source = $News[$_POST['Entry']][3];
    $ttl = $News[$_POST['Entry']][0];
}
else //Default article to display
{
    $source = $News[0][3];
    $ttl = $News[0][0];
}
echo <<<_END
	    </td>
	  </tr>
	  <tr>
	    <td height="80%">
		<table width="100%">
		    <tr>
_END;

for($i = 0; $i < count($News); $i++)
{
$title = $News[$i][0];
$author = $News[$i][1];
$provider = $News[$i][2];

echo <<<_END
      <td width="20%">
	<table>
	  <tr>
	    <td>
	      Tile:
	    </td>
	    <td>
	      $title
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Author:
	    </td>
	    <td>
	      $author
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Provider:
	    </td>
	    <td>
	      $provider
	    </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	      <form method="post" action="News.php">
		<input type="hidden" name='Entry' value=$i />
		<input type="submit" name='Preview' value='Preview'/>
	      </form>
	    </td>
	  </tr>
	</table>
      </td>
_END;
}

/*displays a preview of the selected article*/
echo <<<_END
    </tr>
    <tr>
      <td width="100%" colspan="5">
		<table width="100%">
		    <tr>
		      <td>
			<h3>$ttl</h3>
		      </td>
		    </tr>
		    <tr>
		      <td>
			<iframe height="400" width="90%" src='$source'></iframe>
		      </td>
		    </tr>
		    <tr>
		      <td>
			<a href='$source'>View Article In New Page</a>
		      </td>
		    </tr>
		</table>
	    </td>
	  </tr>
	</table>
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
?>