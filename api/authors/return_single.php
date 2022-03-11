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

//get id and assign it to your author object

$author->id = isset($_GET['id']) ? $_GET['id'] : die();


//call authors read method to get the author info. Note that if comes back false, then it prints 'authorID not found' below

if($author->return_single()){


    //create an array and assign the author info to it
    $author_arr = array(
        'id' => $author->id, 
        'author' => $author->author
    );

    //convert this array to JSON
    print_r(json_encode($author_arr)); 

}

else {
    echo json_encode('authorId Not Found'); die();

}

?>