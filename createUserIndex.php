<?php
    require_once ("./Classes/UserApi.php");

    header("Content-Type: application/json;charset=utf-8");

    $userApi = new UserApi();
    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $input = json_decode(file_get_contents("php://input"),true);
            $result = $userApi->insertUser($input["username"],$input["password"],$input["email"]);
            echo $result;
            break;
    }
?>