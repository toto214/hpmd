<?php
session_start();
include("../connect/connect_db.php");


$register_id = $_POST['register_id'];
$cid = $_POST['cid'];
$date_serv = $_POST['date_serv'];
$eating_vegetable_id = $_POST['a1'];
$eating_salty_id = $_POST['a2'];
$drinking_sweet_id = $_POST['a3'];
$short_winded_id = $_POST['a4'];
$long_sitting_id = $_POST['a5'];
$sleeping_time = $_POST['a6'];
$wakeup_time = $_POST['a6_2'];
$sleep_id = $_POST['a6_3'];
$brush_teeth_id = $_POST['a7'];
$dental_services_id = $_POST['a8'];
if($_POST['dental1'] == "Y") {
$dental1 = $_POST['dental1'];
}else {
$dental1 = "N";	
}
if($_POST['dental2'] == "Y") {
$dental2 = $_POST['dental2'];
}else {
$dental2 = "N";	
}
if($_POST['dental3'] == "Y") {
$dental3 = $_POST['dental3'];
}else {
$dental3 = "N";	
}
if($_POST['dental4'] == "Y") {
$dental4 = $_POST['dental4'];
}else {
$dental4 = "N";	
}
if($_POST['dental5'] == "Y") {
$dental5 = $_POST['dental5'];
}else {
$dental5 = "N";	
}
if($_POST['dental6'] == "Y") {
$dental6 = $_POST['dental6'];
}else {
$dental6 = "N";	
}
if($_POST['dental7'] == "Y") {
$dental7 = $_POST['dental7'];
}else {
$dental7 = "N";	
}
if($_POST['dental_other'] == "Y") {
$dental_other = $_POST['dental_other'];
}else {
$dental_other = "N";	
}

$dental_other_desc = $_POST['dental_other_desc'];
$smoking_id = $_POST['a9'];
$drink_beer_id = $_POST['a10'];
$helmet_id = $_POST['a11'];
$safety_belt_id = $_POST['a12'];



$cid_md5 = md5($cid);
$rid_md5 = md5($register_id);

$sql_d = "delete from bmi_trends.health_behavior_risk where date(last_update) = '$date_serv' and cid = '$cid'";
$query_d = mysqli_query($con,$sql_d);


$sql = "INSERT INTO bmi_trends.health_behavior_risk
       (register_id,eating_vegetable_id,eating_salty_id,drinking_sweet_id,short_winded_id,long_sitting_id,sleeping_time,wakeup_time,brush_teeth_id,dental_services_id,dental1,dental2,dental3,dental4,dental5,dental6,dental7,dental_other,dental_other_desc,smoking_id,drink_beer_id,helmet_id,safety_belt_id,last_update,cid,del_status)
VALUES ('$register_id','$eating_vegetable_id','$eating_salty_id','$drinking_sweet_id','$short_winded_id','$long_sitting_id','$sleeping_time','$wakeup_time','$brush_teeth_id','$dental_services_id','$dental1','$dental2','$dental3','$dental4','$dental5','$dental6','$dental7','$dental_other','$dental_other_desc','$smoking_id','$drink_beer_id','$helmet_id','$safety_belt_id','$date_serv','$cid','Y')";
$rs = mysqli_query($con,$sql);

#echo "<script language='javascript'>alert('บันทึกข้อมูลทั่วไปเรียบร้อยครับ');</script>";										
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=people_health_page&pid=$cid_md5&rid=$rid_md5";


/*if($rs){
 echo "TRUE";
}else{
 echo 'FALSE';
}*/
?>