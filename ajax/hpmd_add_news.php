<?php
session_start();
include("../connect/connect_db.php");
$job = $_POST['job'];
$detail = $_POST['detail'];

$user = $_POST['user'];




$sql = "INSERT INTO news
       (id,detail,job,user)
VALUES ('','$detail','$job','$user')";
$rs = mysqli_query($con,$sql);

echo "<script language='javascript'>alert('บันทึกข้อมูลทั่วไปเรียบร้อยครับ');</script>";										
#echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person3&&pid=$cid_md5";
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=hpmd_main";

/*if($rs){
 echo "TRUE";
}else{
 echo 'FALSE';
}*/
?>