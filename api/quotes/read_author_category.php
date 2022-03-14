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

//instantiate quote object

$quote = new quote($db); 

//get the authorID from the client and put it into your object so the method can use it. 
//$quote->categoryID = isset($_GET['categoryID']) ? $_GET['categoryID'] : die();

//if the client sent authorID and categoryID via GET, then put those values in the object's params. 
if(isset($_GET['authorID']) and isset($_GET['categoryID'] )){
    $quote->authorID = $_GET['authorID']; 
    $quote->categoryID = $_GET['categoryID']; 
}
else {die();} 

//call quote read method

$result = $quote->read_author_category(); 

//get row count

$num = $result->rowCount(); 

//check if there are any any quotes in table

if($num >0){
    //post array
    $quotes_arr = array(); 
    $quotes_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        $quotes_item = array(
            'id' => $id,
            'quote' => $quote,
            'authorID'=>$authorID,
            'categoryID'=> $categoryID

        ); 

        //push quotes_item array to 'data'array. It'll loop through each entry and assign the id and quote, authorID, categoryID
        array_push($quotes_arr['data'], $quotes_item); 
    }

    //turn into JSON and output

    echo json_encode($quotes_arr); 


} else{
    echo json_encode(array('message' => 'No Quotes Found'));  
}

?>