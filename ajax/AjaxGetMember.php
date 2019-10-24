<?php
	include("../connect/connect_db.php");
	

	
$query = "SELECT *    FROM member";

$rs = mysqli_query($con,$query);
while($row = mysqli_fetch_array($rs)){
    $rows[] = $row;
}
echo json_encode($rows,JSON_UNESCAPED_UNICODE);



?>