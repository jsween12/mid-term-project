<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Methods: DELETE'); 
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'); 

include_once '../../config/Database.php';
include_once '../../model/quotes.php';


//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate quote object

$quote = new quote($db); 

//get raw posted data from client

$data = json_decode(file_get_contents("php://input")); 

//assign author object the values we just got above from client
$quote->id = $data->id; 


//now that the object has the info, we can call delete() and it'll send the mySQL to the database with the proper info from our object inserted
if($quote->delete()){
    //create an array and assign the quote info to it
    $quote_arr = array(
        'id' => $quote->id
    );

    //convert this array to JSON
    print_r(json_encode($quote_arr)); 
    




} else{
    echo json_encode(
        array('message'=> 'No Quote Found')
    );

}



?>