<?php 

include_once 'connection.php';

if(isset($_SESSION['admin_id']))
{
	$sql_select = "select * from task";
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

		$res = ['status'=>'All task selected sucessfully...','result'=>$result,'total_task'=>'Total '.$i.' task has been assigned'];
		echo json_encode($res);
	}
	else
	{
		$error = ["error"=>"There is no any task has been assinged to anyone...."];
		echo json_encode($error);
	}

	
}
else
{
	$error = ["error"=>"Kindly admin login first...."];
	echo json_encode($error);
}

 ?>