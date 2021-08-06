<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] == 'GET'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Tasks.php';
    
    $database = new Db_connect();
    $db = $database->setConnection();

    $task = new Tasks($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id))
    {
        $task->id = $data->id;

        $task->getTaskById();

        if($task->id != null){

            $task_array = [
                "id" => $task->id,
                "user_id" => $task->user_id,
                "title" => $task->title,
                "description" => $task->description,
                "creation_date" => $task->creation_date,
            ];

            http_response_code(200);
            echo json_encode($task_array);
    }
    else
    {
        http_response_code(404);     
        echo json_encode(["Task does not exists"]);
    }
    }
}
else
{
    http_response_code(405);
    echo json_encode(["Method Not Allowed"]);
}
