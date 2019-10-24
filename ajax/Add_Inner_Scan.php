<?php
session_start();
include("../connect/connect_db.php");

$cid = $_POST['cid'];
$register_id = $_POST['register_id'];
$date_serv = $_POST['date_serv'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$waist_cm = $_POST['waist_cm'];
$sbp = $_POST['sbp'];
$dbp = $_POST['dbp'];
$congenital_disease = $_POST['congenital_disease'];
$fat_percentage = $_POST['fat_percentage'];
$muscle_mass = $_POST['muscle_mass'];
$bone_mass = $_POST['bone_mass'];
$bmi = $_POST['bmi'];
$metabolic_rate = $_POST['metabolic_rate'];
$body_water = $_POST['body_water'];
$abdominal_fat = $_POST['abdominal_fat'];
$energy_need = $_POST['energy_need'];

$cid_md5 = md5($cid);
$rid_md5 = md5($register_id);
$sql_d = "delete from bmi_trends.innerscan_service where date_serv = '$date_serv' and cid = '$cid'";
$query_d = mysqli_query($con,$sql_d);


$sql = "INSERT INTO bmi_trends.innerscan_service
       (cid,date_serv,weight,height,waist_cm,sbp,dbp,congenital_disease,fat_percentage,muscle_mass,bone_mass,bmi,metabolic_rate,body_water,abdominal_fat,energy_need,last_update,register_id)
VALUES ('$cid','$date_serv','$weight','$height','$waist_cm','$sbp','$dbp','$congenital_disease','$fat_percentage','$muscle_mass','$bone_mass','$bmi','$metabolic_rate','$body_water','$abdominal_fat','$energy_need',now(),'$register_id')";
$rs = mysqli_query($con,$sql);

echo "<script language='javascript'>alert('บันทึกข้อมูลทั่วไปเรียบร้อยครับ');</script>";										
#echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=input_person3&&pid=$cid_md5";
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=people_health_page&pid=$cid_md5&rid=$rid_md5";

/*if($rs){
 echo "TRUE";
}else{
 echo 'FALSE';
}*/
?>