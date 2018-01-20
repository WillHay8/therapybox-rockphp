<?php
error_log("tasks.php");
include '../dao/tasks_dao.php';
$_SESSION['user_id'] = 1;
$tasks = get_tasks_for_user($_SESSION['user_id']);

include '../inc/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-12">
                    <h1>Tasks</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="tasks-con">
                            <div class="task prototype">
                                <span class="title"></span><span class="complete"><input id="" type="checkbox" /></span>
                            </div>
                        <?php foreach($tasks as $task){ ?>

                            <div id="task-<?=$task['id']?>" class="task">
                                <span class="title"><?=$task['title']?></span><span><input id="task-check-<?=$task['id']?>" type="checkbox" <?php echo $task['complete']? 'checked' : '' ?> /></span>
                            </div>

                        <?php } ?>
                    </div>
                    <div id="task-input-con" class="row">
                        <div class="col-10">
                            <input type="text" id="task-input" placeholder="Your task" style="width: 100%"/>
                        </div>
                        <div class="col-2">
                            <button id="submit-task" onclick="submitTask()">Submit</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="create-task-con"><button id="create-task" onclick="createTask()">Create Task</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../inc/footer.php';
?>
<script>
console.log("tasks.php");
</script>