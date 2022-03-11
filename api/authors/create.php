<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: POST'); 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); 

include_once '../../config/Database.php';
include_once '../../model/Authors.php';


//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate author object

$author = new author($db); 

//get raw posted data from client

$data = json_decode(file_get_contents("php://input")); 

//assign author object the values we just got above from client
$author->author = $data->author; 

//now that the object has the info, we can call create() and it'll send the mySQL to the database with the proper info from our object inserted
//call the create method and assign the pdo object a variable. 
 

if($author->create()){
    echo json_encode(
        array('message'=> 'created author ('. $author->id . ', ' . $author->author . ')')); 
    

} else{

echo json_encode(
    array('message'=> 'Missing Required Parameters')
    );

}



?>




    
