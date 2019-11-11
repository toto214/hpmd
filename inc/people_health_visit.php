<?  
if(!empty($_GET['pid'])) {
	$pid = ($_GET['pid']);
	$rid = ($_GET['rid']);
}else {
	$pid = md5($_POST['pid']);
}

$sql = "SELECT
b.register_id,
b.cid,
b.pname,concat(p.prename,
b.fname,'  ',
b.lname) fullname,
if(b.sex = '1','ชาย','หญิง') sex,
b.birthdate,
b.member_type_id,
b.username,
b.`password`,
b.last_login,
b.version_usage,
b.profile_link,
b.occupation,c.occupationname,TIMESTAMPDIFF(YEAR,b.birthdate,date(NOW())) age_y
FROM bmi_trends.bmi_register_user  b  
LEFT JOIN bmi_trends.cprename  p on b.pname = p.id_prename
INNER JOIN bmi_trends.coccupation c on b.occupation = c.occupationcode
where md5(b.cid) = '$pid'
GROUP BY b.cid";
$query_sql = mysqli_query($con,$sql);
$row_data = mysqli_fetch_array($query_sql);

$rid = md5($row_data['register_id']);


$query_g = "SELECT
i.innerscan_service_id,i.cid,i.date_serv,i.weight,
i.height,i.waist_cm,i.sbp,i.dbp,i.congenital_disease,i.fat_percentage,
i.muscle_mass,i.bone_mass,i.bmi,i.metabolic_rate,i.body_water,i.abdominal_fat,i.last_update,i.token,i.energy_need
FROM bmi_trends.innerscan_service i 

WHERE md5(i.cid) = '$pid'
order by i.date_serv desc
";
	$rs = mysqli_query($con,$query_g);


?>    
	<!-- Contextual Classes With Linked Items -->
            <div class="row clearfix">
          
                    <div class="card">
			<img id='barcode' class="pull-right" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=http://203.157.162.18/sfl/index.php?floder=inc%26service=people_health_visit%26pid=<?=$pid; ?>%26rid=<?=$rid; ?>" alt="" title="QR" width="150" height="150" />	
                        <div class="header">
                            <h2>
                              <i class="material-icons col-deep-green">history</i> ประวัติข้อมูลตรวจสุขภาพเบื้องต้น
                                <small>ชื่อ-สกุล :  <b class="font-underline"><?=$row_data['fullname']; ?></b>      เพศ :  <b class="font-underline"><?=$row_data['sex']; ?> </b>     อายุ :  <b class="font-underline"><?=$row_data['age_y']; ?>  ปี</b>      อาชีพ :  <b class="font-underline"><?=$row_data['occupationname']; ?></b></small>
                            </h2>
												<a class="btn bg-brown waves-effect" href="index.php?floder=inc&service=people_health_menu&pid=<?=$pid ?>&rid=<?=$rid ?>">
                                    <i class="material-icons">menu</i>
                                    <span><strong>กลับไปหน้าเมนู</strong></span>
                                </a>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">					
                            <div class="list-group">
													<? while($row_d = mysqli_fetch_array($rs)) {
$date_serv = strtotime($row_d['date_serv']); ?>
                                <a href="javascript:void(0);" class="list-group-item ">
                                    <h4 class="list-group-item-heading">วันที่ <?=thai_date($date_serv); ?></h4>
                                    <p class="list-group-item-text">
น้ำหนัก : <?=$row_d[weight]; ?> ส่วนสูง : <?=$row_d[height]; ?> รอบเอว : <?=$row_d['waist_cm']; ?> ค่าความดันโลหิต  <?=$row_d['sbp']; ?> /<?=$row_d['dbp']; ?> โรคประจำตัว  <?=$row_d['congenital_disease']; ?> เปอร์เซ็นต์ไขมัน  
<?=$row_d['fat_percentage']; ?> มวลกล้ามเนื้อ  <?=$row_d['muscle_mass']; ?> มวกกระดูก  <?=$row_d['bone_mass']; ?> ค่าดัชนีมวลกาย  <?=$row_d['bmi']; ?> พลังงานที่ร่างกายต้องการ  <?=$row_d['energy_need']; ?> อัตราการเผาพลาญ  <?=$row_d['metabolic_rate']; ?> เปอร์เซ็นต์น้ำในร่างกาย <?=$row_d['body_water']; ?> ไขมันที่เกาะตามอวัยวะในช่องท้อง  <?=$row_d['abdominal_fat']; ?>
                                 </p>
									
                                </a>
                          		<? } ?>      
                            </div>				
                        </div>
                    </div>
                </div>
          
            <!-- #END# Contextual Classes With Linked Items -->
