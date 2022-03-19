
<?php

    class Database{
        private $conn; 
        private $hostname; 
        private $username; 
        private $password; 
        private $database; 


        public function connect(){
            //get the url from config vars on Heroku
            $url = getenv('JAWSDB_URL');
            //it looks like this uses the url to assign all the following variables 
            $dbparts = parse_url($url); 

            $this->hostname = $dbparts['host'];
            $this->username = $dbparts['user'];
            $this->password = getenv('pass'); 
            $this->database = ltrim($dbparts['path'], '/'); 

            try{

            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connection Successful";
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage(); 
            }

        }

    }





    ?>
    
