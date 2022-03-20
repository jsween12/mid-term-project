<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

switch($method){

    case 'GET':
        if(isset($_GET['id'])) include 'return_single.php'; 
        else { include 'readAll.php'; }
        break; 

    case 'POST:
        include 'create.php';
        break; 

    case 'PUT': 
        include 'update.php';
        break; 

    case 'DELETE':
        include 'delete.php'; 
        break; 

}

?>