<?php
include("../connect/connect_db.php");
	$register_id = $_POST['register_id'];

	

			$query = "DELETE FROM bmi_register_user WHERE register_id='".$register_id."'";
		mysqli_query($con,$query);

		
	if($query){
		echo "TRUE";
	}else{
		echo "FALSE";
		
	}
	
?>