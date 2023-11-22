<?php 

include_once 'connection.php';

if(isset($_SESSION['admin_id']))
{
	$id = $_GET['id'];
	$status = "";

	if($_GET['user_status']==1)
	{
		$status = 'Active';
	}
	else if($_GET['user_status']==0)
	{
		$status = 'Deactive';
	}
	else
	{
		$error = ['error'=>'Kindly insert user status as 0 or 1 only (0=Deactive, 1=Active).....!'];
		echo json_encode($error);
	}

	if($id!="" && $status!="")
	{
		$sql_update = "update user_register set user_status='$status' where id='$id'";

		if(mysqli_query($conn,$sql_update))
		{
			$res = ["status"=>"User status updated sucessfully as $status"];
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