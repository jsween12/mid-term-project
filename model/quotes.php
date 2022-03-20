<?php
    class quote{
        //db stuff

        private $conn; 
        private $table = 'quotes'; 

        //Post properties

        public $id; 
        public $quote;
        public $authorID; 
        public $categoryID;  

        //constructor with database

        public function __construct($db){
            $this->conn = $db; 
        }


    //Get all from quotes' table
        public function readAll(){
        //create a query
        //$query = 'SELECT * FROM '. $this->table; 

        //commented out above line and added this when I realized I had missed this requirement
        //for the output of readAll() quotes. This is much better. 
        $query = 'SELECT quotes.id, quotes.quote, authors.author, categories.category  
        FROM `quotes` 
        JOIN authors
        ON quotes.authorID = authors.id
        JOIN categories
        ON quotes.categoryID = categories.id';






        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //execute query
        $stmt->execute(); 

        return $stmt; 
        }

    // Get quote by ID

    public function return_single(){
        //create a query
        $query = 'SELECT * FROM `quotes` WHERE id =?';
        
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
        $this->quote = $row['quote']; 
        $this->authorID = $row['authorID'];
        $this->categoryID = $row['categoryID'];


        return $stmt; 
        
    }


    //Create new quote (returns pdo object if created successfully, and null if not)

    public function create() {
        //create query

        $query = 'INSERT INTO ' . $this->table . '(`quote`, `authorID`, `categoryID`) VALUES (:quote, :authorID, :categoryID)';

        //prepare statement 
        $stmt = $this->conn->prepare($query);

        //clean up data
        $this->quote = htmlspecialchars(strip_tags($this->quote)); 

        //bind data

        $stmt->bindParam(':quote', $this->quote); 
        $stmt->bindParam(':authorID', $this->authorID); 
        $stmt->bindParam(':categoryID', $this->categoryID); 

        //this line is a bit clunky. It just records whether or not the execute statement works. 
        $works = $stmt->execute(); 

        //this should copy the id of the newly created author to the object's id. 
        $this->id = $this->conn->lastInsertId(); 

        //execute query. If it works, retern the ID of the new author. If not, return NULL. 
        if($works){ return true;
        }
        else {//if not print error
        printf("Error: %s.\n", $stmt->error); 
        return false; }

    }

         //Update quotes
        public function update() {
        //create query
        $query = 'UPDATE ' . $this->table . ' SET `id` = :id, `quote`=:quote,`authorID`=:authorID,`categoryID`=:categoryID WHERE id = :id'; 
        

        //prepare statement 
        $stmt = $this->conn->prepare($query);

        //clean up data
        $this->id = htmlspecialchars(strip_tags($this->id)); 
        $this->quote = htmlspecialchars(strip_tags($this->quote)); 
        $this->authorID = htmlspecialchars(strip_tags($this->authorID)); 
        $this->categoryID = htmlspecialchars(strip_tags($this->categoryID)); 



        //bind data

        $stmt->bindParam(':id', $this->id); 
        $stmt->bindParam(':quote', $this->quote); 
        $stmt->bindParam(':authorID', $this->authorID); 
        $stmt->bindParam(':categoryID', $this->authorID); 
        


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

    //delete quote

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
        }
        //now check to see if any data was affected in the database
        $rowChange = $stmt->rowCount(); 
        //if nothing was changed, return false
        if($rowChange==false){return false; }
        //otherwise we're good. 
        else return true; 

    }

    public function read_all_author(){
        //create a query
        $query = 'SELECT * FROM `quotes` WHERE authorID =?';
        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //bind ID to the query (the question mark placeholder)
        $stmt->bindParam(1, $this->authorID);

        //execute query
        $stmt->execute();

        //return the data
        return $stmt; 
        
    }

    public function read_all_category(){
        //create a query
        $query = 'SELECT * FROM `quotes` WHERE categoryID =?';
        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //bind ID to the query (the question mark placeholder)
        $stmt->bindParam(1, $this->categoryID);

        //execute query
        $stmt->execute();

        //return the data
        return $stmt; 
        
    }

    public function read_author_category(){
        //create a query
        $query = 'SELECT * FROM `quotes` WHERE authorID=? AND categoryID =?';
        
        //prepare statment
        $stmt = $this->conn->prepare($query); 

        //bind ID to the query (the question mark placeholder)
        $stmt->bindParam(1, $this->authorID);
        $stmt->bindParam(2, $this->categoryID);

        //execute query
        $stmt->execute();

        //return the data
        return $stmt; 
        
    }

    }

    ?>