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
    $.post({
        url: rootUrl+'/ajax/tasks-ajax.php',
        data: {action: 'createTask', title: title},
        success: function(data){
            if(data.success){
                appendTask(data.task);
            }
            else {
                alert("error, task not created.");
            }
        }
    })
}

function appendTask(task){
    $taskCon = $('.task .prototype').clone();
    $taskCon.attr("id", "task-"+task.id).removeClass('prototype');
    $taskCon.find('.title').html(task.title);
    $('.tasks-con').append($taskCon);
}