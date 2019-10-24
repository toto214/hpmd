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
$username = $_POST['cid'];
$password = $_POST['cid'];

$cid_md5 = md5($cid);

$sql_c = "SELECT b.cid  FROM bmi_trends.bmi_register_user  b where b.cid = '$cid'";
$query_sql_c = mysqli_query($con,$sql_c);
$count = mysqli_num_rows($query_sql_c);
if($count>0){
	$sql_2 = "UPDATE  bmi_trends.bmi_register_user g
SET g.pname = '$pname' , 
g.fname = '$fname' ,
g.lname = '$lname',
g.sex = '$sex',
g.birthdate = '$birthdate',
g.member_type_id = '$member_type_id',
g.occupation = '$occupation'
WHERE g.cid = '$cid' ";
$rs_2 = mysqli_query($con,$sql_2);

if($_POST['input_type']==2) {
#echo "<script language='javascript'>alert('บันทึกข้อมูลทั่วไปเรียบร้อยครับ');</script>";										
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person2&pid=$cid_md5&input_type=2";
}else if($_POST['input_type']==3)  {
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person3&pid=$cid_md5&input_type=3";
}
}else {

$sql = "INSERT INTO bmi_trends.bmi_register_user
       (cid,pname,fname,lname,sex,birthdate,member_type_id,occupation,username,password)
VALUES ('$cid','$pname','$fname','$lname','$sex','$birthdate','$member_type_id','$occupation',$username,$password)";
$rs = mysqli_query($con,$sql);

if($_POST['input_type']==2) {
#echo "<script language='javascript'>alert('บันทึกข้อมูลทั่วไปเรียบร้อยครับ');</script>";										
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person2&pid=$cid_md5&input_type=2";
}else if($_POST['input_type']==3)  {
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person3&pid=$cid_md5&input_type=3";
}
}

/*if($rs){
 echo "TRUE";
}else{
 echo 'FALSE';
}*/
?>