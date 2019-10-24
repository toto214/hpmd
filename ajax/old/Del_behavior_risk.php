<?php
include("../connect/connect_db.php");
	$health_behavior_risk_id = $_POST['health_behavior_risk_id'];

	

			$query = "DELETE FROM health_behavior_risk WHERE health_behavior_risk_id='".$health_behavior_risk_id."'";
		mysqli_query($con,$query);

		
	if($query){
		echo "TRUE";
	}else{
		echo "FALSE";
		
	}
	
?>