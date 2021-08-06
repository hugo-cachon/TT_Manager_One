<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER["REQUEST_METHOD"] == 'POST'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';

    $database = new db_connect();
    $db = $database->setConnection();

    $users = new Tasks($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->description) && !empty($data->title))
    {
        $users->id = $data->id;
        $users->title = $data->title;
        $users->description = $data->description;
        $users->user_id = $data->user_id;
        
        if($users->createTask())
        {
            http_response_code(201);
            echo json_encode(["Task has been added to the database"]);
        }
        else
        { 
            http_response_code(503);
            echo json_encode(["Error"]);
        }
    }
}
else 
{
    http_response_code(405);
    echo "Method Not Allowed";
    die();
}
