<?php 
session_start();
$conn = mysqli_connect('localhost','root','','api_project');

if(!$conn)
{
	echo 'connection fail....';
}

 ?>