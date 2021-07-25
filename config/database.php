<?php 
    class Database {
		
		private $host = "geoportal.kukarkab.go.id";
        private $database_name = "namadatabase";
        private $username = "username";
        private $password = "password";

        public $conn;

        public function getConnectionPostgreSQL(){
            $this->conn = null;
            try{
                $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
		

		
    }  
?>