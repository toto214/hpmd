<?php
include("../connect/connect_db.php");
	$innerscan_service_id = $_POST['innerscan_service_id'];

	

			$query = "DELETE FROM innerscan_service WHERE innerscan_service_id='".$innerscan_service_id."'";
		mysqli_query($con,$query);

		
	if($query){
		echo "TRUE";
	}else{
		echo "FALSE";
		
	}
	
?>