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

 function __contstruct(){
  // This constructor runs when the object is instantiated and allows for dynamic variable creation
  //(lesson learned. Thank you discord peeps and Dave)
    //$this->url = getenv('JAWSDB_URL');
    //$this->dbparts = parse_url($this->url);

    $this->hostname = getenv('host');
    $this->username = getenv('user');
    $this->password = getenv('pass');
    $this->database = getenv('database');

}




  public function connect() {

    // Create your new PDO connection 
    try {
      $this->conn = new PDO('mysql:host=' . $this->hostname . ';' . dbname=$this->database, $this->username, $this->password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      return $this->conn; 
    }
    catch(PDOException $e)
    {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}


?>