<?php 

include_once 'connection.php';

if(isset($_SESSION['admin_id']))
{
	$task_id = $_POST['task_id'];
	$user_id = $_POST['user_id'];
	$task = $_POST['task'];
	$status = "";

	if($_POST['task_status']==0)
	{
		$status = 'Pending';
	}
	else if($_POST['task_status']==1)
	{
		$status = 'Accept';
	}
	else if($_POST['task_status']==2)
	{
		$status = 'Running';
	}
	else if($_POST['task_status']==3)
	{
		$status = 'Completed';
	}
	else if($_POST['task_status']==4)
	{
		$status = 'Decline';
	}
	else{
		$error = ['error'=>'Kindly insert task status as 0 to 4 only (0=Pending, 1=Accept, 2=Running, 3=Completed, 4=Decline).....!'];
		echo json_encode($error);
	}

	$sql_select = "select * from user_register where id='$user_id'";
	$data = mysqli_query($conn,$sql_select);
	$user_id_check = mysqli_num_rows($data);
	$row = mysqli_fetch_assoc($data);

	if($user_id_check>0 && $row['user_status']=='Active')
	{
		if($user_id!="" && $task!="" && $status!="" & $task_id!="")
		{
			$sql_update = "update task set user_id='$user_id',task='$task',task_status='$status' where task_id='$task_id'";

			if(mysqli_query($conn,$sql_update))
			{
				$req = ['status'=>'Task updated sucessfully.....'];
				echo json_encode($req);
			}
		}
		else
		{
			$error = ['error'=>'Kindly insert required data to run the query.....!'];
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
	$error = ["error"=>"Kindly admin login first...."];
	echo json_encode($error);
}


 ?>