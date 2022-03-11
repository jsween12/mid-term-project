<?php
//Headers

header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json'); 

include_once '../../config/Database.php';
include_once '../../model/categories.php';

//instantiate database 
$database = new Database(); 
//connect this (not sure why you have to make two variables for this. Why not just make call $database->connect(). D
//doesn't that connect it? 
$db = $database->connect(); 

//instantiate author object

$category = new category($db); 

//call authors read method

$result = $category->readAll(); 

//get row count

$num = $result->rowCount(); 

//check if there are any categories in table

if($num >0){
    //post array
    $category_arr = array(); 
    $category_arr['data'] = array(); 

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); 

        $category_item = array(
            'id' => $id,
            'category' => $category
        ); 

        //push author_item array to 'data'array. It'll loop through each entry and assign the id and category
        array_push($category_arr['data'], $category_item); 
    }

    //turn into JSON and output

    echo json_encode($category_arr); 


} else{
    echo json_encode(array('message' => 'categoryId Not Found'));  
}

?>