<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 

include_once '../../config/Database.php';
include_once '../../model/quotes.php';

//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate author object

$quote = new quote($db); 

//get id and assign it to your author object

$quote->id = isset($_GET['Id']) ? $_GET['Id'] : die();


//call quote read method to get the author info. Note that if comes back false, then it prints 'quote not found' below

if($quote->return_single()){


    //create an array and assign the quote info to it
    $quote_arr = array(
        'id' => $quote->id, 
        'quote' => $quote->quote, 
        'author'=> $quote->author,
        'category'=> $quote->category
    );

    //convert this array to JSON
    print_r(json_encode($quote_arr)); 

}

else {
    echo json_encode(
        array('message'=> 'No Quotes Found')
    );
    


}

?>
