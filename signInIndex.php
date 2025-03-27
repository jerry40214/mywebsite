<?php
    require_once("./Classes/UserApi.php");
    header("Content-Type: application/json;charset=utf-8");

    $userApi = new UserApi();
    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $result = $userApi -> checkUser($_POST["username"],$_POST["password"]);
            echo $result;
            break;
    }
?>