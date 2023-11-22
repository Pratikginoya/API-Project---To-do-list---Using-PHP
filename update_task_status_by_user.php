<?php 

include_once 'connection.php';

if(isset($_SESSION['user_login_id']))
{
	$id = $_SESSION['user_login_id'];
	$task_id = $_POST['task_id'];
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

	$sql_select = "select * from task where task_id='$task_id' and user_id='$id'";
	$data = mysqli_query($conn,$sql_select);
	$user_id_check = mysqli_num_rows($data);
	$row = mysqli_fetch_assoc($data);

	if($user_id_check>0)
	{
		if($task_id!="" && $status!="")
		{
			$sql_update = "update task set task_status='$status' where task_id='$task_id'";

			if(mysqli_query($conn,$sql_update))
			{
				$req = ['status'=>'Task status updated sucessfully as '.$status.' .....'];
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
		$error = ['error'=>'This task or task_id is not assigned to you.....!'];
		echo json_encode($error);
	}
}
else
{
	$error = ["error"=>"Kindly user login first...."];
	echo json_encode($error);
}


 ?>