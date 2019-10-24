<?php
session_start();
include("../connect/connect_db.php");
$sql = "SELECT
p.personnel_hr_id,p.hospcode,c.hosname,c.hostype,ht.hostypename,p.hospcode_hr,p.pname,p.fname,p.lname,
concat(p.pname,p.fname,'  ',p.lname) fullname,
p.cid,p.sex,p.internal_department_hr_id,i.internal_department_hr_name,p.position_code,ph.position_name,
p.manager_code,p.position_number,
p.type_officer_id,th.type_officer,p.current_status_id,ch.current_status_name,p.brithdate,p.begin_work,
p.salary,p.email,p.mobile_phone,p.sign_src,p.last_update,p.personnel_address,personnel_picture,
p.last_update_profile,concat(c.provcode,c.distcode) distid,
GROUP_CONCAT(ct.commander_type_name ORDER BY pc.commander_type_id) commander_type_name,ht.hostypegroup,
hg.hostypegroupname
FROM hrd_00019.personnel_hr  p 
LEFT JOIN  hrd_00019.chospital c on p.hospcode = c.hoscode 
LEFT JOIN  hrd_00019.internal_department_hr i on p.internal_department_hr_id = i.internal_department_hr_id
LEFT JOIN  hrd_00019.position_hr ph on p.position_code = ph.position_code
LEFT JOIN  hrd_00019.type_officer_hr th on p.type_officer_id = th.type_officer_id
LEFT JOIN  hrd_00019.current_status_hr ch on p.current_status_id = ch.current_status_id
LEFT JOIN hrd_00019.chostype ht on c.hostype = ht.hostypecode
LEFT JOIN hrd_00019.hostypegroup hg on ht.hostypegroup = hg.hostypegroup
LEFT JOIN hrd_00019.personnel_commander pc on p.hospcode = pc.hospcode and p.cid = pc.cid
LEFT JOIN hrd_00019.commander_type ct on pc.commander_type_id = ct.commander_type_id
WHERE p.username = '".$_POST['username']."' and p.password = '".$_POST['password']."'
";
$rs = mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);
if($count>0){
$_SESSION["lalom_cid"]=$row["cid"];
$_SESSION["lalom_hospcode"]=$row["hospcode"];
$_SESSION["lalom_internal_department_hr_id"]=$row["internal_department_hr_id"];
$_SESSION["lalom_hostypegroup"]=$row["hostypegroup"];
$_SESSION["lalom_fullname"]=$row["fullname"];

echo "TRUE";
}


?>