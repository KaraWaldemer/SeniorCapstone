<?php
/* --------------REMOVED FROM FINAL LIVE VERSION----------------------
@File: errors.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: File used to wipe database clean for testing purposes
*/
include "Templates/dcalls.php";

$db_server = login();

clearDB();

mysql_close($db_server);
?>