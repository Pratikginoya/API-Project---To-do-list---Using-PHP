<?php 

include_once 'connection.php';

if(isset($_SESSION['user_login_id']))
{
	$id = $_SESSION['user_login_id'];
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


	$sql_select = "select * from task where user_id='$id' and task_status='$status'";
	$data=mysqli_query($conn,$sql_select);
	$count = mysqli_num_rows($data);

	if($count>0)
	{
		$i=0;
		while($row = mysqli_fetch_assoc($data))
		{
			$result[$i] = $row;
			$i++;
		}

		$res = ['status'=>'All task selected sucessfully...','result'=>$result,'total_task'=>'Total '.$i.' task has been '.$status];
		echo json_encode($res);
	}
	else
	{
		$error = ["error"=>$status." Task not available...."];
		echo json_encode($error);
	}	
}
else
{
	$error = ["error"=>"Kindly user login first...."];
	echo json_encode($error);
}

 ?>