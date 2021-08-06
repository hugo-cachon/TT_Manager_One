const getTasksUrl = "http://localhost/TT_Manager_One/Backend/API/TasksService/read.php";
const deleteTaskUrl = "http://localhost/TT_Manager_One/Backend/API/TasksService/delete.php";
const createTask = "http://localhost/TT_Manager_One/Backend/API/TasksService/create.php"

// read task
$.getJSON( getTasksUrl, function(data) {
    var items = [];
    $.each( data.tasks, function() {
        $.each(this, function( key, val) {
            items.push( "<li id='" + key + "'>" + val + "</li>" );      
        })
    });  
    /*
    $( "<ul/>", {
      "class": "task-list",
      html: items.join( "" )
    }).appendTo( "body" ); */
})



// create task
$('#createTask').on("submit", function() {
    let data = {
        "id": "0",
        "user_id": "1",
        "title": $("#title").val(),
        "description": $("#description").val(),
    }
    $.ajax({
        url: createTask,
        data : JSON.stringify(data),
        method: 'POST',
        processData: false, 
        success: function(data) {
            console.log(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
});

/* Postman -> ok
var taskdelete = {
    "id": "1"
}

$.ajax({
    url: deleteTaskUrl, 
    data: JSON.stringify(taskdelete),
    method : 'DELETE',
    processData: false,
    success: function(data) {
        console.log(data);
    },
    error: function(err) {
        console.log(err)
    }
});
*/
