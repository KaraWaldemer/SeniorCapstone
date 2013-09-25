<?php
/*
@File: info.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains variables which are used across the project in different files
*/

/*database login variables
  Removed for security purposes*/
$db_hostname = '';
$db_database = '';
$db_username = '';
$db_password = '';

/*Static array containing information on news articles*/
$News = array(
	  array("St. Louis secures site for new dog pound", "David Hunn", "stltoday.com", "http://www.stltoday.com/news/local/govt-and-politics/political-fix/st-louis-secures-site-for-new-dog-pound/article_7a2b1694-9488-11e1-927b-001a4bcf6878.html"),
	  array("Fairview Heights pasta dinner benefits stray rescue group", "News-Democrat", "BND.com", "http://www.bnd.com/2012/04/24/2152740/fairview-heights-pasta-dinner.html"),
	  array("Gary Montgomery Charged with Animal Neglect; Stray Rescue Instrumental in Developing Case", "Paul Friswold", "Riverfront Times", "http://blogs.riverfronttimes.com/dailyrft/2012/04/gary_montgomery_animal_neglect_stray_rescue.php"),
	  array("Tarot Card Reader Brings Pets & Owners Together", "Patrick Clark", "KPLR 11 St. Louis", "http://kplr11.com/2012/04/18/tarot-card-reader-brings-pets-owners-together/"),
	  array("Brangus: Big Muscles, Big Heart", "TWB", "Mehlville-Oakville Patch", "http://mehlville-oakville.patch.com/articles/brangus-big-muscles-big-heart")
	);

/*
@Function: pad
@Input: $int, the string to be padded
@Output: Returns the string padded with a zero if the size is less than 2, else the input string
*/
function pad($int)
{
    if(strlen($int) < 2)
	  return "0" . $int;
     else
	  return $int;
}

/* -----------in PREVIEWS.PHP----------
@Function: populate
@Input: $r, array containing details on a pet
@Output: Returns html code which creates a table populated and formatted with the data for that pet

function populate($r)
{
      $pic = mysql_fetch_row(getPic($r[0]));
      if(strlen($pic[1]) > 0)
      {
	    $img = "images/uploads/" . $pic[1];
      }
      else
      {
	    $img = "images/noImage.gif"; //uses the default photo if no user uploaded image available
      }
      return "<tr>
		<td>
		  <table>
		    <tr>
		      <td rowspan='3'>
			<img src='$img' height='100' width='100'/>
		      </td>
		      <td>
			Name: $r[2]
		      </td>
		    </tr>
		    <tr>
		      <td>
			Age: $r[3]
		      </td>
		    </tr>
		    <tr>
		      <td>
			  Gender: $r[4]
		      </td>
		    </tr>
		    <tr>
		      <td colspan='2'>
			<form method='post' action='PetDetail.php'>
			  <input type='hidden' name='Entry' value=$r[0] />
			  <input type='submit' name='Details' value='Details'/>
			</form>
		      </td>
		    </tr>
		  </table>
		    <hr width='75%' align='center'>
		</td>
	      </tr>";
}
*/

/* --------------IN PREVIEWS.PHP------------
@Function: submitButton
@Input: $str, the file name that the user provides
@Output: Empty string if no extension found else a string containing the extension

function submitButton($type)
{
      return "<tr>
		<td>
		  <form method='post' action=$type>
			<input type='submit' name='See More' value='See More'/>
		   </form>
		</td>
	      </tr>";
}
*/
?>