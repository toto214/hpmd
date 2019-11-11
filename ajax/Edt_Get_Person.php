<?php
session_start();
include("../connect/connect_db.php");

$cid = $_POST['cid'];
$pname = $_POST['prename'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$sex = $_POST['sex'];
$birthdate = $_POST['birth'];
$member_type_id = $_POST['member_type_id'];
$occupation = $_POST['occ'];
$username = $_POST['username'];
$password = $_POST['password'];

$register_id = $_POST['register_id'];


	$sql_2 = "UPDATE  bmi_trends.bmi_register_user g
SET g.pname = '$pname' , 
g.fname = '$fname' ,
g.lname = '$lname',
g.sex = '$sex',
g.birthdate = '$birthdate',
g.member_type_id = '$member_type_id',
g.occupation = '$occupation',
g.username = '$username',
g.password = '$password'
WHERE g.register_id = '$register_id' ";
$rs_2 = mysqli_query($con,$sql_2);

echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=user_manager";


?>