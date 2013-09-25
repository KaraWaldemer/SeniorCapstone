<?php
  session_start();
/*
@File: logout.php
@Author: Kara Wolter
@Project: Lost/Found Dog Registry
@Purpose: destroys the session and opens the homepage
*/

  session_destroy();
  header('Location: index.php');
?>