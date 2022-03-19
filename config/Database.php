<?php
class Database {
  // Define the class properties here
private $conn; 
private $hostname; 
private $username; 
private $password; 
private $database; 

  public function connect() {
    // if creating a Heroku connection, this is straight from the dev center link: 
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $this->hostname = $dbparts['host'];
    $this->username = $dbparts['user'];
    $this->password = $dbparts['pass'];
    $this->database = ltrim($dbparts['path'],'/');

    // Create your new PDO connection 
    try {
      $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    }
    catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}


?>