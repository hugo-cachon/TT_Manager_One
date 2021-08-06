<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER["REQUEST_METHOD"] == 'GET'){

    include_once '../../Config/Database.php';
    include_once '../../Models/Users.php';
    
    $database = new Db_connect();
    $db = $database->setConnection();

    $user = new Users($db);

    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id))
    {
        $user->id = $data->id;

        $user->getUserById();

        if($user->id != null)
        {
            $result_arr = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
            ];

            http_response_code(200);
            echo json_encode($result_arr);
        }
        else
        {
            http_response_code(404);
            echo json_encode(["User not found"]);
        }
        
    }
}
else
{
    http_response_code(405);
    echo json_encode(["Method Not Allowed"]);
}
