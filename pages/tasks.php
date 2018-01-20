<?php
error_log("tasks.php");
include '../dao/tasks_dao.php';
$_SESSION['user_id'] = 1;
$tasks = get_tasks_for_user($_SESSION['user_id']);

include '../inc/header.php';
?>
<h1>tasks</h1>
<?php foreach($tasks as $task){ ?>


<?php } ?>

<?php
include '../inc/footer.php';
?>