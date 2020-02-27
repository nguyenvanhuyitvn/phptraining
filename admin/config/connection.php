<?php 
	$host = 'localhost';
	$dbName = 'vietpro';
	$username = 'root';
	$password= '';

	$conn =  mysqli_connect($host, $username, $password, $dbName);
	mysqli_set_charset($conn, "SET NAMES 'utf8'");

	if(mysqli_connect_error()){
		echo "Failure to connect to mySQL".mysqli_connect_error();
	}else{
		echo "Connection is established";
	}

?>