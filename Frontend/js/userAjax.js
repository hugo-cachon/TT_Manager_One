const createUser = "http://localhost/TT_Manager_One/Backend/API/UserService/create.php";
const getUsersUrl = "http://localhost/TT_Manager_One/Backend/API/UserService/read.php";
const deleteUserUrl = "http://localhost/TT_Manager_One/Backend/API/UserService/delete.php";

// create user
$('#createUser').on("submit", function() {
    let data = {
    "name": $("#username").val(),
    "email": $("#email").val()
}
$.ajax({
    url: createUser,
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


// read users 
$.getJSON( getUsersUrl, function(data) {
    var items = [];
    $.each( data.users, function() {
        $.each(this, function( key, val) {
            items.push( "<li id='" + key + "'>" + val + "</li>" );      
        })
    });  
    /*
    $( "<ul/>", {
      "class": "user-list",
      html: items.join( "" )
    }).appendTo( "body" );*/
});


/* Postman -> ok
var userdelete = {
    "id": "11"
}

$.ajax({
    url: deleteUserUrl, 
    data: JSON.stringify(userdelete),
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
