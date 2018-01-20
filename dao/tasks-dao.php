<?php
function get_tasks_for_user($user_id){
    include 'connect_will.php';
    $conn = connect();
	$get_stmt = $conn->prepare("select id, title, complete, date_created, date_completed from task where user_id=? order by date_created desc");
    error_log("before bind");
    $get_stmt->bind_param('i', $user_id);
    error_log("after bind");
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
        error_log("return tasks");
        return $tasks;
    }else{
        error_log("error executing get tasks statement");
        error_log($conn->error);
    }
    $get_stmt->close();
    $conn->close();
    return false;
}

function create_task($user_id, $title){
    include 'connect_will.php';
    $conn = connect();
    $insert_stmt = $conn->prepare("insert into task (user_id, title, complete, date_created) values (?, ?, 0, NOW())");
    $insert_stmt->bind_param("is", $user_id, $title);
    if($insert_stmt->execute()){
        $id = $conn->insert_id;
        $insert_stmt->close();
        $conn->close();
        return $id;
    }else{
        error_log($conn->error);
    }
    $insert_stmt->close();
    $conn->close();
    return false;
}
