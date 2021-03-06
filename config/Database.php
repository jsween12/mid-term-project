<?php
class Database {
  // Define the class properties here
private $conn; 
private $hostname; 
private $username; 
private $password; 
private $database; 
private $url;
private $dbparts; 

function __construct(){
  // This constructor runs when the object is instantiated and allows for dynamic variable creation
  //(lesson learned. Thank you discord peeps and Dave)
    $this->url = getenv('JAWSDB_URL');
    $this->dbparts = parse_url($this->url);

    $this->hostname = $this->dbparts['host'];
    $this->username = $this->dbparts['user'];
    $this->password = getenv('pass');
    $this->database = ltrim($this->dbparts['path'], '/');
}

public function connect() {

    // Create your new PDO connection 
    try {
    $this->conn = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database, $this->username, $this->password);
    
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //this line messes up the json output so I'm commenting it out
    //echo( "Connected successfully");
    }
    catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    return $this->conn; 

}

}


?>