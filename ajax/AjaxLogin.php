<?php
session_start();
include("../connect/connect_db.php");
$sql = "SELECT username , password from
WHERE username = '".$_POST['username']."' and password = '".$_POST['password']."'";
$rs = mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);
if($count>0){
$_SESSION["lalom_cid"]=$row["user_id"];
$_SESSION["lalom_hospcode"]=$row["first_name"];
$_SESSION["lalom_internal_department_hr_id"]=$row["last_name"];
$_SESSION["lalom_hostypegroup"]=$row["username"];
$_SESSION["lalom_fullname"]=$row["member_type"];

echo "TRUE";
}


?>