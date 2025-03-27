<?php
    require_once ("./Classes/UserApi.php");

    header("Content-Type: application/json;charset=utf-8");

    $userApi = new UserApi();
    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $result = $userApi->insertUser($_POST["username"],$_POST["password"],$_POST["email"]);
            echo $result;
            break;
    }
?>