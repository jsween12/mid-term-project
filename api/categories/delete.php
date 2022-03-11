<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: DELETE'); 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); 

include_once '../../config/Database.php';
include_once '../../model/categories.php';


//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate category object

$category = new category($db); 

//get raw posted data from client

$data = json_decode(file_get_contents("php://input")); 

//assign category object the values we just got above from client
$category->id = $data->id; 


//now that the object has the info, we can call delete() and it'll send the mySQL to the database with the proper info from our object inserted
if($category->delete()){
    echo json_encode(
       // array('message'=> $category->id)
       $category->id 
    );
} else{
    echo json_encode(
        array('message'=> 'No Category Found')
    );

}



?>