<?php
    class Dbh{
        private $host = "localhost";
        private $dbname = "userdb";
        private $dbuser = "root";
        private $password = "";

        public function connect(){
            try{
                $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->dbuser,$this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }   
            catch(PDOException $e){
                echo "連線失敗". $e->getMessage();
            }
        }
    }
?>