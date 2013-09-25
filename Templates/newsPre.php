<?php
/*
@File: newsPre.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Creates the preview of news stories which appears on the homepage
*/

echo <<<_END
<table width="100%">
    <tr>
      <td align="center">
	  <h3><u>News Articles</u></h3>
      </td>
    </tr>
    <tr>
      <td>
	<table>
	  <tr>
	    <td>
	      Tile:
	    </td>
	    <td>
	      St. Louis secures site for new dog pound
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Author:
	    </td>
	    <td>
	      David Hunn
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Provider:
	    </td>
	    <td>
	      stltoday.com
	    </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	      <a href="http://www.stltoday.com/news/local/govt-and-politics/political-fix/st-louis-secures-site-for-new-dog-pound/article_7a2b1694-9488-11e1-927b-001a4bcf6878.html">View Article In New Page</a>
	      <hr width="75%" align="center">
	    </td>
	  </tr>
	</table>
      </td>
    </tr>
    <tr>
      <td>
	<table>
	  <tr>
	    <td>
	      Tile:
	    </td>
	    <td>
	      Gary Montgomery Charged with Animal Neglect
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Author:
	    </td>
	    <td>
	      Paul Friswold
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Provider:
	    </td>
	    <td>
	      Riverfront Times
	    </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	      <a href="http://blogs.riverfronttimes.com/dailyrft/2012/04/gary_montgomery_animal_neglect_stray_rescue.php">View Article In New Page</a>
	      <hr width="75%" align="center">
	    </td>
	  </tr>
	</table>
      </td>
    </tr>
    <tr>
      <td>
	<table>
	  <tr>
	    <td>
	      Tile:
	    </td>
	    <td>
	      Tarot Card Reader Brings Pets & Owners Together
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Author:
	    </td>
	    <td>
	      Patrick Clark
	    </td>
	  </tr>
	  <tr>
	    <td>
	      Provider:
	    </td>
	    <td>
	      KPLR 11 St. Louis
	    </td>
	  </tr>
	  <tr>
	    <td colspan="2">
	      <a href="http://kplr11.com/2012/04/18/tarot-card-reader-brings-pets-owners-together/">View Article In New Page</a>
	      <hr width="75%" align="center">
	    </td>
	  </tr>
	</table>
      </td>
    </tr>
    <tr>
      <td>
_END;
echo submitButton('News.php');
echo <<<_END
      </td>
    </tr>
 </table>
_END;
?>