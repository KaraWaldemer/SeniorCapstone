<?php
/*
@File: Previews.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains functions used to populate previews for homepage
*/

/*
@Function: populate
@Input: $r, array containing details on a pet
@Output: Returns html code which creates a table populated and formatted with the data for that pet
*/
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
			  <input type='hidden' name='Entry' value=$r[0] /> //used on details page to determine which entry to retrieve from database
			  <input type='submit' name='Details' value='Details'/>
			</form>
		      </td>
		    </tr>
		  </table>
		    <hr width='75%' align='center'>
		</td>
	      </tr>";
}

/*
@Function: submitButton
@Input: $str, the file name that the user provides
@Output: Empty string if no extension found else a string containing the extension
*/
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
?>