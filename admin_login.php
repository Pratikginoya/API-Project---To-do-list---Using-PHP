<?php 

include_once 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql_select = "select * from admin_login where email='$email' and password='$password'";
$data = mysqli_query($conn,$sql_select);
$row_count = mysqli_num_rows($data);

if($row_count>0)
{
	$row = mysqli_fetch_assoc($data);

	$_SESSION['admin_id'] = $row['id'];

	$msg = ["status"=>"Admin Loged-in sucessfully..."];
}

echo json_encode($msg);

 ?>