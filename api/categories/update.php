<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: PUT'); 
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
$category->category = $data->category; 


//execute 
if($category->update()){
    echo json_encode(
        array('message'=> 'updated category ('. $category->id . ', ' . $category->category . ')')); 
    
} else{
echo json_encode(
    array('message'=> 'categoryId Not Found') 
    );
}


?>


