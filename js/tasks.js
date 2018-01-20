console.log("tasks.js");
$('#task-input-con').hide();

function createTask(){
    $('#task-input-con').show();
    $('#create-task').hide();

}

function submitTask(){
    $('#task-input-con').hide();
    $('#create-task').show();
    var title = $('#task-input').val();
    $('#task-input').val("");
    $.post({
        url: rootUrl+'ajax/tasks-ajax.php',
        data: {action: 'createTask', title: title},
        success: function(data){
            if(data.success){
                appendTask(data.objects.task);
            }
            else {
                alert("error, task not created.");
            }
        }
    })
}

function appendTask(task){
    console.log("append "+task.id+", "+task.title);
    var $taskCon = $('.task.prototype').clone();
    $taskCon.attr("id", "task-"+task.id).removeClass('prototype');
    $taskCon.find('.task-checkbox').data('task-id', task.id);
    $taskCon.find('.title').html(task.title);
    $('.tasks-con').prepend($taskCon);
}

function completeTask(event){
    var $taskCon = $(event.target).closest('.task');
}