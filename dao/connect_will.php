<?php
function connect(){
	include '../local_constants.php';
	$conn = new mysqli($database_server_name, $database_username, $database_password, $database_name);
	if($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
	return $conn;
} 