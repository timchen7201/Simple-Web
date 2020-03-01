<?php
$host = 'localhost';
  $dbuser = 'root';
  $dbpw = '';
  $dbname = 'project';
  $_SESSION['link'] = mysqli_connect($host, $dbuser, $dbpw, $dbname);
?>