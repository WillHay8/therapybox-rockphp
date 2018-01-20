<?php

function get_tasks_for_user($user_id){
    include 'connect_will.php';
    $conn = connect();
	$get_stmt = $conn->prepare("select id, title, complete, date_created, date_completed from task order by date_created desc");
    $get_stmt->bind_param('i', $user_id);
    if($get_stmt->execute()){
        $tasks = [];
        $get_stmt->bind_result($id, $title, $complete, $date_created, $date_completed);
        while($get_stmt->fetch()){
            $tasks[] = [
                "id"=> $id,
                "title" => $title, 
                "complete" => $complete,
                "date_created" => $date_created, 
                "date_completed" => $date_completed
            ];
        }
        $get_stmt->close();
        $conn->close();
        return $tasks;
    }else{
        error_log("error executing get tasks statement");
        error_log($conn->error);
    }
    $get_stmt->close();
    $conn->close();
    return false;
}