<?php
error_log("tasks-ajax.php");
include('../local_constants.php');
include_once('../dao/tasks-dao.php');

$success = 1;
$message = "";
$extraData = [];
$result = array(
	'success' => &$success,
	'message' => &$message,
	'objects' => &$objects
	);

$user_id = isset($_SESSION['user_id'])? $_SESSION['user_id'] : 0;
$action = isset($_POST['action'])? $_POST['action'] : '';

if($action == 'createTask'){
    $title = $_POST['title'];
    $id = create_task($title);
    $task = [
        'id' => $id,
        'title' => $title
    ];
    $objects['task'] = $task;
}

header("Content-Type: text/json; charset=utf8");	
echo json_encode($result);