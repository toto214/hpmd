<?php
	include("../connect/connect_db.php");
	
	$cfname = $_POST['cfname'];
	
$sql_c = "SELECT b.cid  FROM bmi_trends.bmi_register_user   b where concat(b.fname,' ',b.lname) LIKE '%$cfname%'";
$query_sql_c = mysqli_query($con,$sql_c);
$count = mysqli_num_rows($query_sql_c);
if($count>0){
	
	$query = "SELECT
b.register_id,b.cid CID,b.pname PRENAME,b.fname NAME,b.lname LNAME,b.sex SEX,b.birthdate BIRTH,b.member_type_id,
b.username,b.`password`,b.last_login,b.version_usage,b.profile_link,b.occupation OCCUPATION_NEW
FROM bmi_trends.bmi_register_user b   where concat(b.fname,' ',b.lname) LIKE '%$cfname%'";
	$rs = mysqli_query($con,$query);
	while($row = mysqli_fetch_array($rs)){
		$rows[] = $row;
	}
	echo json_encode($rows);
	
}else {
$query = "SELECT
p.HOSPCODE,p.CID,p.PID,p.HID,p.PRENAME,
p.`NAME`,p.LNAME,p.HN,p.SEX,p.BIRTH,p.MSTATUS,
p.OCCUPATION_OLD,p.OCCUPATION_NEW,p.RACE,p.NATION,
p.RELIGION,p.EDUCATION,p.FSTATUS,p.FATHER,p.MOTHER,
p.COUPLE,p.VSTATUS,p.MOVEIN,p.DISCHARGE,p.DDISCHARGE,
p.ABOGROUP,p.RHGROUP,p.LABOR,p.PASSPORT,p.TYPEAREA,
p.D_UPDATE,p.check_hosp,p.check_typearea,p.addr,
p.vhid,p.check_vhid,p.maininscl,p.inscl,p.error_code,p.home
FROM hdc.t_person_db p 

WHERE concat(p.`NAME`,' ',p.LNAME) LIKE '%$cfname%';";
	$rs = mysqli_query($hdc,$query);
	while($row = mysqli_fetch_array($rs)){
		$rows[] = $row;
	}
	echo json_encode($rows);	
}
	
	
?>