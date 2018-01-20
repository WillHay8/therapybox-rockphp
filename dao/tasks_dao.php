<?php
function task_dao_connect(){
	include '../local_constants.php';
	include $private_dir . 'kampfire-sql-config.php';
	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error){
		die("connection failed: " . $conn->connect_error);
	}
	return $conn;
} 

function get_fuel_count_for_kamp($kamp_id){
    $conn = fuel_dao_connect();
	$get_stmt = $conn->prepare("select count(*) from fuel where kampId=?");
    $get_stmt->bind_param('i', $kamp_id);
    if($get_stmt->execute()){
        $get_stmt->bind_result($fuel_count);
        if($get_stmt->fetch()){
            $get_stmt->close();
            $conn->close();
            return $fuel_count;
        }
        else{
            error_log("error fetching get fuel result");
        }
    }else{
        error_log("error executing get fuel statement");
    }
    $get_stmt->close();
    $conn->close();
    return $false;
}