<?php 

include_once 'connection.php';
session_destroy();

$msg = ['status'=>'User logout Sucessfully.....'];

echo json_encode($msg);


 ?>