<?php
error_log("tasks.php");
include '../dao/task_dao.php';

$tasks = get_tasks($_SESSION['user_id']);

include '../inc/header.php';
?>
<h1>tasks</h1>
<?php foreach($tasks as $task){ ?>


<?php } ?>

<?php
include '../inc/footer.php';
?>