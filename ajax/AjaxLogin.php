<?php
session_start();
include("../connect/connect_db.php");
$sql = "SELECT username , pass from
WHERE username = '".$_POST['username']."' and pass = '".$_POST['password']."'
";

$rs = mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);
if($count>0){
$_SESSION["lalom_cid"]=$row["username"];
$_SESSION["lalom_hospcode"]=$row["hospcode"];
$_SESSION["lalom_internal_department_hr_id"]=$row["internal_department_hr_id"];
$_SESSION["lalom_hostypegroup"]=$row["hostypegroup"];
$_SESSION["lalom_fullname"]=$row["fullname"];

echo "TRUE";
}


?>