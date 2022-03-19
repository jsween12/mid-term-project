<?php
class Database {
  // Define the class properties here
private $conn; 
  public function connect() {
    // if creating a Heroku connection, this is straight from the dev center link: 
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');

    // Create your new PDO connection 
    try {
      $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
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