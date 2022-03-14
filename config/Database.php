<?php
    class Database {
        //Database parameters
        private $host = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        private $db_name = 'cvjc3r90rtdy4yc5'; 
        private $username = 'qm7c0wjqg3rep2tu'; 
        private $password = 'wtkltqyyhjgilte5' ; 
        private $conn; 

        // Database connection with pdo

        public function connect(){
            $this->conn = null; 

            try{
                $this->conn = new PDO('mysql: host='. $this->host . ';dbname='. $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            } catch (PDOException $e) {
                echo 'Connection Error: '. $e->getMessage(); 
            }
            return $this->conn; 
        }

    }

    ?>
