<?php
	include("../connect/connect_db.php");
	
	$cid = $_POST['cid'];
	

	
	$query = "SELECT
i.innerscan_service_id,
i.cid,
i.date_serv,
i.weight,
i.height,
i.waist_cm,
i.sbp,
i.dbp,
i.congenital_disease,
i.fat_percentage,
i.muscle_mass,
i.bone_mass,
i.bmi,
i.metabolic_rate,
i.body_water,
i.abdominal_fat,
i.last_update,
i.token,energy_need
FROM bmi_trends.innerscan_service i 
INNER JOIN 
(SELECT s.cid,innerscan_service_id,MAX(s.date_serv) date_serv FROM bmi_trends.innerscan_service s WHERE s.cid = '$cid') s
ON i.cid = s.cid and i.date_serv = s.date_serv
WHERE i.cid = '$cid'
GROUP BY i.cid
";
	$rs = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($rs)){
		$rows[] = $row;
	}
	echo json_encode($rows);
	

	
	
?>