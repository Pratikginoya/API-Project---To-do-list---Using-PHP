<?php 

include_once 'connection.php';

if(isset($_SESSION['admin_id']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$address = $_POST['address'];
	$city = $_POST['city'];

	if($name!="" && $email!="" && $password!="" && $address!="" && $city!="")
	{
		$sql_insert = "insert into user_register (name,email,password,address,city)values('$name','$email','$password','$address','$city')";

		if(mysqli_query($conn,$sql_insert))
		{
			$res = ["status"=>"Data inserted sucessfully"];
		}

		echo json_encode($res);
	}
	else
	{
		$error = ["error"=>"Kindly insert required details to run the query....!"];
		echo json_encode($error);
	}
}
else
{
	$error = ["error"=>"Kindly admin login first...."];
	echo json_encode($error);
}

 ?>