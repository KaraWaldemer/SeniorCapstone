<?php
/*
@File: Matching.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: Contains Functions which are used to determine if a newly entered entry has any possible matches in the database
*/

include_once "Templates/dcalls.php";

/*
@Function: compare
@Input: $db_server, reference to current instance of database
		$id, entry_id of pet being viewed
		$type, opposite type to the currently viewed pet
@Output: Returns an array populated with information on possibly related entries
*/
function compare($db_server, $id, $type)
{
    $result = array();
    $ent = get_Features($id);
    $pet = mysql_fetch_row(Details($id));
    $gen = $pet[4];
    $age = $pet[3];
    $wgt = $pet[5];
    $date = $pet[6];
    $size1 = findSize($ent);
    $inDb = find($type);
    $size2 = findSize($inDb);

    for($i = 0; $i < $size1; $i++) //steps through all of the features for the given entry_id
    {
	$rowA = mysql_fetch_row($ent);
	$strA = $rowA[0];

	for($j = 0; $j < $size2; $j++) //steps through each of the opposite typed entries in database
	{
	    $rowJ = mysql_fetch_row($inDb);

	    if(strcmp($rowJ[4], $gen) == 0) //verifies genders match
	    {
		if(strcmp($rowJ[3], $age) == 0)	//verifies age range matches
		{
		    if(strcmp($rowJ[5], $wgt) == 0) //verifies weight range matches
		    {
			if(testDates($date, $rowJ[6], $type)) //checks dates
			{
			  $ftrs = get_Features($rowJ[0]);
			  $size3 = count($ftrs);
			  $inner = array();
			  $count = 0;
			  for($k = 0; $k < $size3; $k++) //steps through the features of each entry who meet above criteria
			  {
			      $rowK = mysql_fetch_row($ftrs);
			      $strB = $rowK[0];

			      if(strcmp($strA, $strB) == 0) //checks if features match
			      {
				  $count = $count + 1;
			      }
			  }
			  	if($count > 0) //---------------------------------NEW CHECK--------------------------
			  	{
					/*Only populates return array with entries that pass all checks*/
					$inner[] = $rowJ[0];
					$inner[] = $size3;
					$inner[] = $count;
					$result[] = $inner;
				}
			}
		    }
		}
	    }
	}
    }

    return $result;
}

/*
@Function: testDates
@Input: $d1, date associated with pet being viewed
		$d2, date associated with oppositely typed entry in database
		$t, the type of the entry being viewed
@Output: Returns true if all criteria met, else false
*/
function testDates($d1, $d2, $t)
{
    $date1 = explode("-", $d1);
    $date2 = explode("-", $d2);

  if($t == 0) //entry being viewed is lost so verify its date is prior to that of the found entry
  {
    if($date1[0] <= $date2[0])
    {
	return TRUE;
	if($date1[1] <= $date2[1])
	{
	    if($date1[2] <= $date2[2])
	    {
		return TRUE;
	    }
	    else
	    {  return FALSE; }
	}
	else
	{  return FALSE; }
     }
     else
     {  return FALSE; }
  }
  else //entry being viewed is found so verify its date is after that of the lost entry
  {
    if($date1[0] >= $date2[0])
    {
	return TRUE;
	if($date1[1] >= $date2[1])
	{
	    if($date1[2] >= $date2[2])
	    {
		return TRUE;
	    }
	    else
	    {  return FALSE; }
	}
	else
	{  return FALSE; }
     }
     else
     {  return FALSE; }
  }
}

?>