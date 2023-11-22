<?php 

include_once 'connection.php';
session_destroy();

$msg = ['status'=>'Admin logout Sucessfully.....'];

echo json_encode($msg);


 ?>