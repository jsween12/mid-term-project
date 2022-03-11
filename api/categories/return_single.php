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

//instantiate categories object

$category = new category($db); 

//get id and assign it to your category object

$category->id = isset($_GET['id']) ? $_GET['id'] : die();


//call category read method to get the category info. Note that if comes back false, then it prints 'categoryID not found' below

if($category->return_single()){


    //create an array and assign the cateogry info to it
    $category_arr = array(
        'id' => $category->id, 
        'category' => $category->category
    );

    //convert this array to JSON
    print_r(json_encode($category_arr)); 

}

else {
    echo json_encode(
        array('message'=> 'No Category Found')
    );

}

?>