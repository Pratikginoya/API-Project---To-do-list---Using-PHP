<?php 

include_once 'connection.php';

if(isset($_SESSION['admin_id']))
{
	$user_id = $_POST['user_id'];
	$task = $_POST['task'];

	$sql_select = "select * from user_register where id='$user_id'";
	$data = mysqli_query($conn,$sql_select);
	$user_id_check = mysqli_num_rows($data);
	$row = mysqli_fetch_assoc($data);

	if($user_id_check>0 && $row['user_status']=='Active')
	{
		if($user_id!="" && $task!="")
		{
			$sql_insert = "insert into task (user_id,task)values('$user_id','$task')";

			if(mysqli_query($conn,$sql_insert))
			{
				$res = ['status'=>'Task inserted sucessfully...'];

				echo json_encode($res);
			}
		}
		else
		{
			$error = ['error'=>'Kindly insert user_id and task to run the query.....!'];
			echo json_encode($error);
		}
	}
	else
	{
		if($user_id_check==0)
		{
			$error = ['error'=>'Mentioned user_id is not found in database, Kindly insert this user or provide correct user_id.....!'];
			echo json_encode($error);
		}
		else
		{
			$error = ['error'=>'Mentioned user_id is Deactive..! Kindly check and change the status of user_id first....'];
			echo json_encode($error);
		}
	}
}
else
{
	$error = ["error"=>"Kindly admin login first....!"];
	echo json_encode($error);
}


 ?>