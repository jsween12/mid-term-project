<?php
    class category{
        //db stuff

        private $conn; 
        private $table = 'categories'; 

        //Object properties

        public $id; 
        public $category; 

        //constructor with database

        public function __construct($db){
            $this->conn = $db; 
        }


    //Get all from categories's table
        public function readAll(){
        //create a query
        $query = 'SELECT * FROM '. $this->table; 
        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //execute query
        $stmt->execute(); 

        return $stmt; 
        }

    // Get category by ID

    public function return_single(){
        //create a query
        $query = 'SELECT `id`, `category` FROM `categories` WHERE id =?';
        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //bind ID to the query (the question mark placeholder)
        $stmt->bindParam(1, $this->id);

        //execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC); 

        //if there is no data after execute then return false
        if($row == NULL){return false;} 

        //if the id field is set to null, then return_single will return false; I took this out because
        //trying to read a null array cause error messages
       // if($row['id']==null){return false; }

        //set the pdo properties return to the local variables in the other's object
        
        $this->id = $row['id']; 
        $this->category = $row['category']; 

        return $stmt; 
        
    }


    //Create new category (returns pdo object if created successfully, and null if not)

    public function create() {
        //create query
        $query = 'INSERT INTO ' . $this->table . '(`category`) VALUES (:category)';

        //prepare statement 
        $stmt = $this->conn->prepare($query);

        //clean up data
        $this->category = htmlspecialchars(strip_tags($this->category)); 

        //bind data

        $stmt->bindParam(':category', $this->category); 

        //this line is a bit clunky. It just records whether or not the execute statement works. 
        $works = $stmt->execute(); 

        //this should copy the id of the newly created category to the object's id. 
        $this->id = $this->conn->lastInsertId(); 

        //execute query. If it works, retern the ID of the new category. If not, return NULL. 
        if($works){ return true;
        }
        else {//if not print error
        printf("Error: %s.\n", $stmt->error); 
        return false; }

    }

         //Update author
        public function update() {
        //create query
        $query = 'UPDATE ' . $this->table . ' SET `category` = :category WHERE id = :id'; 
        

        //prepare statement 
        $stmt = $this->conn->prepare($query);

        //clean up data
        $this->category = htmlspecialchars(strip_tags($this->category)); 
        $this->id = htmlspecialchars(strip_tags($this->id)); 

        //bind data

        $stmt->bindParam(':id', $this->id); 
        $stmt->bindParam(':category', $this->category); 

        //first check to see if the execute statment works. If not, return false. 
        if($stmt->execute()==false){
            //if not print error
        printf("Error: %s.\n", $stmt->error); 
        return false;
        }
        // Next check to see if the mySQL update command actually changed anything. 
        $rowChange = $stmt->rowCount(); 
        if($rowChange>0){return true; }

        else
        {return false; }

        
    }

    //delete category

    public function delete(){
        //create query

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?'; 

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean up data
        $this->id = htmlspecialchars(strip_tags($this->id)); 
    
        //bind data
        $stmt->bindParam(1, $this->id); 

        //execute query and see if it executes 
        if($stmt->execute()==false){
            printf("Error: %s.\n", $stmt->error); 
            return false; 
            return false; 
            return false; 
            
        }
        //now check to see if any data was affected in the database
        $rowChange = $stmt->rowCount(); 

        if($rowChange==false){return false; }

        else return true; 
        
    }

    }

    ?>