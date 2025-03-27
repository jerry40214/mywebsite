<?php
    require_once("./Classes/Dbh.php");
    session_start();
    class UserApi extends Dbh{
        public function insertUser($username , $password , $email){

            if(empty($username)){
                return json_encode(["error" => "username不能空白!!"]);
            }
            elseif(empty($password)){
                return json_encode(["error" => "password不能空白!!"]);
            }
            elseif(empty($email)){
                return json_encode(["error" => "email不能空白!!"]);
            }
            else{
                $username = htmlspecialchars($username,ENT_QUOTES,"UTF-8");
                $password = htmlspecialchars($password,ENT_QUOTES,"UTF-8");
                $email = htmlspecialchars($email,ENT_QUOTES,"UTF-8");

                $password = password_hash($password,PASSWORD_DEFAULT);

                $query = "INSERT INTO users (name,password,email) VALUES (:username,:password,:email)";
                $stmt = $this->connect() ->prepare($query);
                $stmt->bindParam(":username",$username);
                $stmt->bindParam(":password",$password);
                $stmt->bindParam(":email",$email);
                $stmt->execute();
                return json_encode(["message"=>"註冊完成!!"]);
            }
        }
        public function checkUser($username,$password){
            if(empty($username)){
                return json_encode(["error" => "username不能空白!!"]);
            }
            elseif(empty($password)){
                return json_encode(["error" => "password不能空白!!"]);
            }
            else{
                $username = htmlspecialchars($username,ENT_QUOTES,"UTF-8");
                $password = htmlspecialchars($password,ENT_QUOTES,"UTF-8");

                $query = "SELECT password FROM users WHERE name =:username";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute([
                    "username" => $username
                ]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result && password_verify($password,$result["password"])){
                    $_SESSION["username"] = $username;
                    return json_encode(["message"=>"登入成功!!!"],JSON_UNESCAPED_UNICODE);
                }
                else{
                    return json_encode(["error"=>"登入失敗!!!"],JSON_UNESCAPED_UNICODE);
                }
            }
        }
    }
?>