<?php

	$servername = "localhost";
	$username = "id4954070_tran0202";
	$password = "tvdl2410.db";
	$database = "id4954070_tvdl";

	try {
	    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	    // set the PDO error mode to exception
	    $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully"; 
	} catch (PDOException $e) {    
	    echo "Connection failed: " . $e -> getMessage();
	}

?>