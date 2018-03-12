<?php

 	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 
 	define('DBHOST', 'localhost');
 	define('DBUSER', 'id4954070_tran0202');
 	define('DBPASS', 'tvdl2410.db');
 	define('DBNAME', 'id4954070_tvdl');
 
 	$connection = mysqli_connect(DBHOST,DBUSER,DBPASS);
 	$dbconnection = mysqli_select_db($connection,DBNAME);
 
 	if (!$connection) {
  		die("Connection failed : " . mysqli_error());
 	}
 
 	if (!$dbconnection) {
  		die("Database Connection failed : " . mysqli_error());
 	}
?>