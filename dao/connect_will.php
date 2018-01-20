<?php
function connect(){
	include '../local_constants.php';
<<<<<<< HEAD
	$conn = new mysqli($servername, $username, $password, $database);
=======
	$conn = new mysqli($server_name, $database_username, $database_password, $database_name);
>>>>>>> ce24aa292271d451e5f2a57611a0d90540206bd6
	if($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
	return $conn;
} 