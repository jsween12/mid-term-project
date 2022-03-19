
<?php

    class Database{
        private $conn; 
        private $hostname; 
        private $username; 
        private $password; 
        private $database; 

        private $url; 
        private $dbparts; 


        public function connect(){
            //get the url from config vars on Heroku
            $this->url = getenv('JAWSDB_URL');
            //it looks like this uses the url to assign all the following variables 
            $this->dbparts = parse_url($url); 

            $this->hostname = $this->dbparts['host'];
            $this->username = $this->dbparts['user'];
            $this->password = getenv('pass'); 
            $this->database = ltrim($this->dbparts['path'], '/'); 

            try{

            $this->conn = new PDO("mysql:host=" . $this->hostname . "; dbname=" . $this->database.", " . $this->username. ', ' . $this->password); 

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
    
