<?php
    require_once("./Classes/Dbh.php");

    
    class ContentApi extends Dbh{
        public function insertContent($content,$username){
            if(empty($content)){
                return json_encode(["error" => "文章不能空白!!"],JSON_UNESCAPED_UNICODE);
            }
            elseif(empty($username)){
                return json_encode(["error" => "請先登入!!"],JSON_UNESCAPED_UNICODE);
            }
            else {
                $content = htmlspecialchars($content,ENT_QUOTES,"UTF-8");
                $username = htmlspecialchars($username,ENT_QUOTES,"UTF-8");
                $query = "INSERT INTO articles(content,username) VALUES (:content,:username) ";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute([
                    "content" => $content,
                    "username" => $username
                ]);
                return json_encode(["message" => "上傳已完成!!"],JSON_UNESCAPED_UNICODE);
            }
            
        }

        public function queryContent($username){
            $username = htmlspecialchars($username,ENT_QUOTES,"UTF-8");
            if(empty($username)){
                return json_encode(["error" => "使用者名稱不能空白!!"],JSON_UNESCAPED_UNICODE);
            }
            $query = "SELECT content,username,content_date FROM articles WHERE username = :username";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([
                "username" => $username
            ]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($result,JSON_UNESCAPED_UNICODE);
        }

        public function updateContent($id,$content,$username){
            if(empty($id)){
                return json_encode(["error" =>"id不能空白!!"],JSON_UNESCAPED_UNICODE);
            }
            elseif(empty($content)){
                return json_encode(["error"=>"文章不能空白!!"],JSON_UNESCAPED_UNICODE);
            }
            else{
                $content = htmlspecialchars($content,ENT_QUOTES,"UTF-8");
                $query = "UPDATE articles SET content = :content WHERE id = :id AND username =:username";
                $stmt = $this->connect()->prepare($query);
                $stmt ->execute([
                    "id" => $id,
                    "content" => $content,
                    "username" => $username
                ]);
                return json_encode(["message" => "編輯已完成!!"],JSON_UNESCAPED_UNICODE);
            }
        }
        public function deleteContent($id,$username){
            $id = htmlspecialchars($id,ENT_QUOTES,"UTF-8");
            $username = htmlspecialchars($username,ENT_QUOTES,"UTF-8");

            $query = "DELETE FROM articles WHERE id = :id AND username =:username";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([
                "id" => $id,
                "username" => $username
            ]);
            return json_encode(["message" => "刪除已完成!!"],JSON_UNESCAPED_UNICODE);
        }
    }
?>