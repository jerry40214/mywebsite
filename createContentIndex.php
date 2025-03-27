<?php
    require_once("./Classes/ContentApi.php");
    session_start();
    header("Content-Type: application/json;charset=utf-8");

    $contentApi = new ContentApi();

    switch($_SERVER["REQUEST_METHOD"]){
        case "POST":
            $input = json_decode(file_get_contents("php://input"),true);
            switch($input["type"]){
                case "forSubmit":
                    $content = isset($input["content"]) ?$input["content"]:NULL;
                    $result = $contentApi ->insertContent($content,$_SESSION["username"]);
                    echo $result;
                    break;
                case "forSearch":
                    $username = isset($input["username"])? $input["username"]:NULL;
                    $result = $contentApi ->queryContent($username);
                    echo $result;
                    break;
            }
            break;
        case "PUT":
            $input = json_decode(file_get_contents("php://input"),true);
            $id = isset($input["id"]) ? $input["id"]:NULL;
            $content = isset($input["content"]) ? $input["content"]:NULL;
            $result = $contentApi->updateContent($id,$content,$_SESSION["username"]);
            echo $result;
            break;
        case "DELETE":
            $input = json_decode(file_get_contents("php://input"),true);
            $id = isset($input["id"]) ? $input["id"]:NULL;
            $result = $contentApi->deleteContent($id,$_SESSION["username"]);
            echo $result;
            break;
    }
?>