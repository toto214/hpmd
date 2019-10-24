<?php
session_start();
include("../connect/connect_db.php");
$sql = "SELECT
*
FROM member 

WHERE username = '".$_POST['username']."' and password = '".$_POST['password']."'
";
$rs = mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);

echo json_encode($rows,JSON_UNESCAPED_UNICODE);
?>
