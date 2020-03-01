<?php
 // this will avoid mysql_connect() deprecation error, 
 error_reporting( ~E_ALL & ~E_DEPRECATED &  ~E_NOTICE );
 // I strongly suggest you to use PDO or MySQLi.
$db=mysqli_connect('localhost','root','', 'php');
$dbcon=mysqli_select_db($db, php);
 if (!$db ) {
  die("Error to connect to database : " . mysqli_error($db));
 }
 if ( !$dbcon ) {
  die("Can\t tesssssssssssss : " . mysqli_error($d));
 }