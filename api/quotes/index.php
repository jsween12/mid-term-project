<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}
switch($method){

    case "GET":
        //note: This one must come first. If you put it last, the third case fires because the 
        //authorID is set. 
        $bool1 = isset($_GET['authorId']);
        $bool2 = isset($_GET['categoryId']); 
        if( $bool1 and $bool2) 
        {include 'read_author_category.php'; 
        break;}

        if(isset($_GET['id'])) 
        {include 'return_single.php'; 
        break;}


        if(isset($_GET['authorId'])){
        include 'read_all_author.php';
        break;
        }

        if(isset($_GET['categoryId'])) 
        {include 'read_all_category.php';
        break;}

        include 'readAll.php'; 
        break; 

    case "POST":
        include 'create.php';
        break; 

    case "PUT": 
        include 'update.php';
        break; 

    case 'DELETE':
        include 'delete.php'; 
        break; 

}

?>