
<?php

/*
    class Database {
        //Database parameters
        private $host = "x8autxobia7sgh74.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        private $db_name = 'cvjc3r90rtdy4yc5'; 
        private $username = 'qm7c0wjqg3rep2tu'; 
<<<<<<< HEAD
        private $password = 'wtkltqyyhjgilte5 '; 
=======
        private $password = 'wtkltqyyhjgilte5' ; 
>>>>>>> 3eee931771abc11d53e2d6398b9e54678fcc2d4f
        private $conn; 

        // Database connection with pdo

        public function connect(){
            $this->conn = null; 

            try{
                $this->conn = new PDO('mysql: host='. $this->host . ';dbname='. $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                echo "Connection successful"; 
            } catch (PDOException $e) {
                echo 'Connection Failed: '. $e->getMessage(); 
            }
            return $this->conn; 
        }

    }
    */

    //lets try this again for Heroku...

    class Database{
        private conn; 

        public function connect(){
            //get the url from config vars on Heroku
            $url = getenv('JAWSDB_URL');
            //it looks like this uses the url to assign all the following variables 
            $dbparts = parse_url($url); 

            $hostname = $dbparts['host'];
            $username = $dbparts['user'];
            $password = $dbparts['pass']; 
            $database = ltrim($dbparts['path'], '/'); 

            try{

            $this->conn = new PDO("mysql:host=" . $hostname . "; dbname=" . $database.", " . $username. ', ' . $password); 

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
    
