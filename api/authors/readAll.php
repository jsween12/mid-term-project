<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 

include_once '../../config/Database.php';
include_once '../../model/Authors.php';

//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate author object

$author = new author($db); 

//call authors read method

$result = $author->readAll(); 

//get row count

$num = $result->rowCount(); 

//check if there are any authors in table

if($num >0){
    //post array
    $author_arr = array(); 
    $author_arr = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        $author_item = array(
            'id' => $id,
            'author' => $author
        ); 

        //push author_item array to 'data'array. It'll loop through each entry and assign the id and author
        array_push($author_arr, $author_item); 
    }

    //turn into JSON and output

    echo json_encode($author_arr); 


} else{
    echo json_encode(array('message' => 'authorId Not Found'));  
}

?>