<?php 

include_once 'connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql_select = "select * from user_register where email='$email' and password='$password'";
$data = mysqli_query($conn,$sql_select);
$row_count = mysqli_num_rows($data);

$sql_select_active = "select * from user_register where email='$email' and password='$password' and user_status='Active'";
$data_active = mysqli_query($conn,$sql_select_active);
$row_count_active = mysqli_num_rows($data_active);


if($row_count>0)
{
	if($row_count_active>0)
	{
		$row = mysqli_fetch_assoc($data);

		$_SESSION['user_login_id'] = $row['id'];

		$msg = ["status"=>"User ".$row['name']." _ Loged-in sucessfully..."];
	}
	else
	{
		$msg = ["error"=>"Your id is Deactive by the admin...! Kindly co-ordinate with the admin...."];
	}
}
else
{
	$msg = ["error"=>"Mentioned email and password is not found...."];
}

echo json_encode($msg);

 ?>