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
left join bmi_trends.coccupation c on b.occupation = c.occupationcode
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
INNER JOIN 
(SELECT s.cid,MAX(s.date_serv) date_serv FROM bmi_trends.innerscan_service s WHERE md5(s.cid) = '$pid') s
ON i.cid = s.cid and i.date_serv = s.date_serv
WHERE md5(i.cid) = '$pid'
GROUP BY i.cid
";
	$rs = mysqli_query($con,$query_g);
$row_d = mysqli_fetch_array($rs);
$date_serv = strtotime($row_d['date_serv']);

$query = "SELECT
h.health_assessment_id,
h.health_assessment_name,
h.health_assessment_desc,
h.health_assessment_status
FROM bmi_trends.health_assessment  h
WHERE h.health_assessment_status = 'Y' order by h.health_assessment_id
";
$rs = mysqli_query($con,$query);
$rsa = mysqli_query($con,$query);
$rsh = mysqli_query($con,$query);
$row_h = mysqli_fetch_array($rs);

mysql_data_seek($rsh,0);
$row_h1 = mysqli_fetch_array($rsh);
$health_assessment_name1 = $row_h1['health_assessment_name'];

mysql_data_seek($rsh,1);
$row_h2 = mysqli_fetch_array($rsh);
$health_assessment_name2 = $row_h2['health_assessment_name'];

mysql_data_seek($rsh,2);
$row_h3 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,3);
$row_h4 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,4);
$row_h5 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,5);
$row_h6 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,6);
$row_h7 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,7);
$row_h8 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,8);
$row_h9 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,10);
$row_h10 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,11);
$row_h11 = mysqli_fetch_array($rsh);

mysql_data_seek($rsh,12);
$row_h12 = mysqli_fetch_array($rsh);


$sql_ans = "SELECT
h.health_behavior_risk_id,
h.register_id,
r1.r1_id,h.eating_vegetable_id,r1.eating_vegetable_name,r1.eating_vegetable_score,
r2.r2_id,h.eating_salty_id,r2.eating_salty_name,r2.eating_salty_score,
r3.r3_id,h.drinking_sweet_id,r3.eating_sweet_name,r3.eating_sweet_score,
r4.r4_id,h.short_winded_id,r4.short_winded_name,r4.short_winded_score,
r5.r5_id,h.long_sitting_id,r5.long_sitting_name,r5.long_sitting_score,
h.sleeping_time,
h.wakeup_time,
		CASE	WHEN TIMESTAMPDIFF(MINUTE,CONCAT('2017-10-01 ',h.sleeping_time),CONCAT(if(h.wakeup_time>='00:00','2017-10-02 ','2017-10-01 '),h.wakeup_time,':00'))/60 <= 4 THEN 1 
			WHEN TIMESTAMPDIFF(MINUTE,CONCAT('2017-10-01 ',h.sleeping_time),CONCAT(if(h.wakeup_time>='00:00','2017-10-02 ','2017-10-01 '),h.wakeup_time,':00'))/60 BETWEEN 4.1 AND 6.9 THEN 2
			ELSE 3 END AS sleeping_score,
substr(TIMESTAMPDIFF(MINUTE,CONCAT('2017-10-01 ',h.sleeping_time),CONCAT(if(h.wakeup_time>='00:00','2017-10-02 ','2017-10-01 '),h.wakeup_time,':00'))/60,1,4) sleeping_hour,
r7.r7_id,h.brush_teeth_id,r7.brush_teeth_name,r7.brush_teeth_score,
r8.r8_id,h.dental_services_id,r8.dental_services_name,if(h.dental_services_id = 1,1,IF(dental1= 'Y',3,2)) AS dental_services_score,
if(h.dental1 = 'Y','ตรวจสุขภาพช่องปาก','') dental1,
if(h.dental2 = 'Y','อุดฟัน','') dental2,
if(h.dental3 = 'Y','ขูดหินปูน','') dental3,
if(h.dental4 = 'Y','ถอนฟัน','') dental4,
if(h.dental5 = 'Y','รักษารากฟัน','') dental5,
if(h.dental6 = 'Y','ใส่ฟันปลอม','') dental6,
if(h.dental7 = 'Y','ผ่าฟันคุด','') dental7,
if(h.dental_other = 'Y','อื่นๆ','') dental_other,
h.dental_other_desc,
r9.r9_id,h.smoking_id,r9.smoking_name,r9.smoking_score,
r10.r10_id,h.drink_beer_id,r10.drink_beer_name,r10.drink_beer_score,
r11.r11_id,h.helmet_id,r11.helmet_name,r11.helmet_score,
r12.r12_id,h.safety_belt_id,r12.safety_belt_name,r12.safety_belt_score,
h.last_update,
h.cid,
h.del_status
FROM `health_behavior_risk`  h
LEFT JOIN (SELECT '1' r1_id,
r.eating_vegetable_id,
r.eating_vegetable_name,
r.eating_vegetable_score FROM rsk_eating_vegetable r) r1 on h.eating_vegetable_id = r1.eating_vegetable_id
LEFT JOIN (SELECT
'2' r2_id,
r.eating_salty_id,
r.eating_salty_name,
r.eating_salty_score
FROM `rsk_eating_salty`  r) r2 on h.eating_salty_id = r2.eating_salty_id
LEFT JOIN (SELECT
'3' r3_id ,r.eating_sweet_id,r.eating_sweet_name,r.eating_sweet_score FROM `rsk_drinking_sweet` r
) r3 on h.drinking_sweet_id = r3.eating_sweet_id
LEFT JOIN (SELECT
'4' r4_id,r.short_winded_id,
r.short_winded_name,
r.short_winded_score
FROM `rsk_short_winded` r
) r4 on h.short_winded_id = r4.short_winded_id
LEFT JOIN (SELECT
'5' r5_id,r.long_sitting_id,
r.long_sitting_name,
r.long_sitting_score
FROM `rsk_long_sitting` r) r5 on h.long_sitting_id = r5.long_sitting_id
#LEFT JOIN rsk_sleep r6 on 1=1
LEFT JOIN (SELECT
'7' r7_id,r.brush_teeth_id,
r.brush_teeth_name,
r.brush_teeth_score
FROM `rsk_brush_teeth` r) r7 on h.brush_teeth_id = r7.brush_teeth_id
LEFT JOIN (SELECT
'8' r8_id,r.dental_services_id,
r.dental_services_name,
r.dental_services_score
FROM `rsk_dental_services`  r
) r8 on h.dental_services_id = r8.dental_services_id
LEFT JOIN (SELECT
'9' r9_id,r.smoking_id,
r.smoking_name,
r.smoking_score
FROM `rsk_smoking`  r
) r9 ON h.smoking_id = r9.smoking_id
LEFT JOIN (SELECT
'10' r10_id,r.drink_beer_id,
r.drink_beer_name,
r.drink_beer_score
FROM `rsk_drink_beer`  r
) r10 ON h.drink_beer_id = r10.drink_beer_id
LEFT JOIN (SELECT
'11' r11_id,r.helmet_id,
r.helmet_name,
r.helmet_score
FROM `rsk_helmet`  r
) r11 ON h.helmet_id = r11.helmet_id
LEFT JOIN (SELECT
'12' r12_id,r.safety_belt_id,
r.safety_belt_name,
r.safety_belt_score
FROM `rsk_safety_belt` r
) r12 ON h.safety_belt_id = r12.safety_belt_id
INNER JOIN 
(SELECT s.register_id,s.cid,MAX(date(s.last_update)) date_serv FROM bmi_trends.health_behavior_risk s WHERE md5(s.register_id) = '$rid' GROUP BY s.register_id) s
ON  h.register_id = s.register_id   and DATE(h.last_update) = s.date_serv
WHERE  md5(h.register_id) = '$rid'
GROUP BY h.cid ";
$query_ans = mysqli_query($con,$sql_ans) ;
#mysql_data_seek($query_ans,0);
$ans_h = mysqli_fetch_array($query_ans);
$date_serv_ans = strtotime($ans_h['last_update']);
$all_score = $ans_h['eating_vegetable_score']+$ans_h['eating_salty_score']+$ans_h['eating_sweet_score']+$ans_h['short_winded_score']
+$ans_h['long_sitting_score']+$ans_h['sleeping_score']+$ans_h['brush_teeth_score']+$ans_h['dental_services_score']+$ans_h['smoking_score']+$ans_h['drink_beer_score']/*+$ans_h['helmet_score']+$ans_h['safety_belt_score']*/;

if($all_score >= 6 && $all_score <= 14) {
	$score_level = "1";
	$score_color = "col-red";
}else if($all_score >= 15 && $all_score <= 22){
	$score_level = "2";
	$score_color = "col-amber";
}else if ($all_score >= 23 && $all_score <= 30){
	$score_level = "3";
	$score_color = "col-green";
}
$sql_sug = "SELECT
h.health_suggestion_id,
h.health_suggestion_name,
h.health_suggestion_level,
h.health_suggestion_level_name
FROM health_suggestion  h WHERE h.health_suggestion_level = '$score_level'
";
$query_sug = mysqli_query($con,$sql_sug);
$row_sug = mysqli_fetch_array($query_sug);

$text_url = "";
?>

                <!-- Radar Chart -->
		<a class="btn bg-blue waves-effect" href="index.php?floder=inc&service=people_health_menu&pid=<?=$pid ?>&rid=<?=$rid ?>">
                                    <i class="material-icons">menu</i>
                                    <span><strong>กลับไปหน้าเมนู</strong></span>
                                </a>
				 <div class="row clearfix">
                <div class=" col-sm-12">
                    <div class="card">
					<img id='barcode' class="pull-right" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=http://203.157.162.18/sfl/index.php?floder=inc%26service=people_health_page%26pid=<?=$pid; ?>%26rid=<?=$rid; ?>" alt="" title="QR" width="150" height="150" />	
                        <div class="header">
    		
     <p> <b><h2><i class="material-icons col-deep-green">assignment_ind</i>รายละเอียดเก็บข้อมูลตรวจสุขภาพเบื้องต้น</h2></b> </p>
	<p><h5><i class="material-icons ">account_box</i> ชื่อ-สกุล :  <b class="font-underline"><?=$row_data['fullname']; ?></b>      เพศ :  <b class="font-underline"><?=$row_data['sex']; ?> </b>     อายุ :  <b class="font-underline"><?=$row_data['age_y']; ?>  ปี</b>      อาชีพ :  <b class="font-underline"><?=$row_data['occupationname']; ?></b></h5></p>
	<p><h5><b> <i class="material-icons">assignment</i> ผลบันทึกผลครั้งล่าสุด วันที่  <?=thai_date($date_serv); ?> </b></h5></p>


                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Print</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                              <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">pregnant_woman</i>
                        </div>
                        <div class="content">
                            <div class="text">น้ำหนัก</div>
                            <div class="number"><?=$row_d['weight']; ?></div>
                        </div>
                    </div>
                </div>

				                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-cyan">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">ส่วนสูง</div>
                            <div class="number"><?=$row_d['height']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-lime"">
                            <i class="material-icons">accessibility_new</i>
                        </div>
                        <div class="content">
                            <div class="text">รอบเอว</div>
                     <div class="number"><?=$row_d['waist_cm']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-pink">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">ค่าความดันโลหิต</div>
                         <div class="number"><?=$row_d['sbp']; ?>/<?=$row_d['dbp']; ?></div>
                        </div>
                    </div>
                </div>
				                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-red">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">เปอร์เซ็นต์ไขมัน</div>
                     <div class="number"><?=$row_d['fat_percentage']; ?>%</div>
                        </div>
                    </div>
                </div>
								                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-teal">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">มวลกล้ามเนื้อ</div>
                     <div class="number"><?=$row_d['muscle_mass']; ?>kg</div>
                        </div>
                    </div>
                </div>
												                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon "">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">มวลกระดูก</div>
                     <div class="number"><?=$row_d['bone_mass']; ?>kg</div>
                        </div>
                    </div>
                </div>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-purple">
                            <i class="material-icons">accessibility</i>
                        </div>
                        <div class="content">
                            <div class="text">ค่าดัชนีมวลกาย (BMI)</div>
                     <div class="number"><?=$row_d['bone_mass']; ?></div>
                        </div>
                    </div>
                </div>
																	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-light-green">
                            <i class="material-icons">accessibility_new</i>
                        </div>
                        <div class="content">
                            <div class="text">พลังงานที่ร่างกายต้องการ</div>
                     <div class="number"><?=$row_d['energy_need']; ?>Kcal</div>
                        </div>
                    </div>
                </div>
													<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-red">
                            <i class="material-icons">timer</i>
                        </div>
                        <div class="content">
                            <div class="text">อัตราการเผาพลาญ</div>
                     <div class="number"><?=$row_d['metabolic_rate']; ?>ปี</div>
                        </div>
                    </div>
                </div>
																	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-amber">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">เปอร์เซ็นต์น้ำในร่างกาย</div>
                     <div class="number"><?=$row_d['body_water']; ?> %</div>
                        </div>
                    </div>
                </div>
											<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                    <div class="info-box hover-zoom-effect">
                        <div class="icon bg-blue-grey">
                            <i class="material-icons">accessibility_new</i>
                        </div>
                        <div class="content">
                            <div class="text">ไขมันที่เกาะในช่องท้อง</div>
                     <div class="number"><?=$row_d['abdominal_fat']; ?> </div>
                        </div>
                    </div>
                </div>
            </div>
                
                    </div>
                </div>
				</div>
				</div>
				            <div class="row clearfix">
                <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <i class="material-icons">question_answer</i> ผลการประเมินพฤติกรรมสุขภาพ
                                <small><code>ตอบแบบสอบถามล่าสุด ณ วันที่ <?=thai_date($date_serv_ans); ?> </code></small>
                            </h2>
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
                        <div class="body table-responsive">
                            <table class="table table-striped" style="width:80%" align="center">
                                <thead>
                                    <tr>
                                        <th style="width:5px">ข้อ</th>
                                        <th >คำถาม</th>                               
                                    </tr>
                                </thead>
                                <tbody>
					
                                    <tr>
                                        <td align="center" ><strong><?=$row_h1['health_assessment_id']; ?></strong></td>
                                        <td><b><?=$row_h1['health_assessment_name']; ?></b></td>
                                    </tr>
                                    <tr>
                                      <td >&nbsp;</td>
      <td><strong class="font-underline  col-indigo">คำตอบ : <?=$ans_h['eating_vegetable_name']; ?></strong>  <strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['eating_vegetable_score']; ?></span></strong></td>
                                    </tr>
                                    <tr>
                                     <td align="center"><strong><?=$row_h2['health_assessment_id']; ?></strong></td>
                                      <td><strong><?=$row_h2['health_assessment_name']; ?></strong></td>
                                    </tr>
                                    <tr>
                  <td >&nbsp;</td>
                   <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['eating_salty_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['eating_salty_score']; ?></span></strong></td>
                                    </tr>
                                    <tr>
                      <td align="center"><strong><?=$row_h3['health_assessment_id']; ?></strong></td>
                                      <td><strong><?=$row_h3['health_assessment_name']; ?></strong></td>
                                    </tr>
                                    <tr>
                                     <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['eating_sweet_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['eating_sweet_score']; ?></span></strong></td>
                                    </tr>
                                    <tr>
                      <td align="center"><strong><?=$row_h4['health_assessment_id']; ?></strong></td>
                                      <td><strong><?=$row_h4['health_assessment_name']; ?></strong></td>
                                    </tr>
                                    <tr>
                                     <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['short_winded_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['short_winded_score']; ?></span></strong></td>
                                    </tr>
                                    <tr>
                      <td align="center"><strong><?=$row_h5['health_assessment_id']; ?></strong></td>
                                      <td><strong><?=$row_h5['health_assessment_name']; ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['long_sitting_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['long_sitting_score']; ?></span></strong></td>
                                    </tr>
                                    <tr>
                      <td align="center"><strong><?=$row_h6['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h6['health_assessment_name']; ?></strong></td>
                                    </tr>
                                    <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-teal">เข้านอน : <?=$ans_h['sleeping_time']; ?> ตื่นนอน : <?=$ans_h['wakeup_time']; ?></strong><strong><i class="material-icons col-pink">alarm</i><?=$ans_h['sleeping_hour']; ?>  ชั่วโมง </strong> <strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['sleeping_score']; ?></span></strong></td>
                                    </tr>
                                     <tr>
                      <td align="center"><strong><?=$row_h7['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h7['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['brush_teeth_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['brush_teeth_score']; ?></span></strong></td>
                                    </tr>
                                     <tr>
                      <td align="center"><strong><?=$row_h8['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h8['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['dental_services_name']; ?> </strong><strong><font color="#339900">(<?=$ans_h['dental1']; ?> <?=$ans_h['dental2']; ?> <?=$ans_h['dental3']; ?> <?=$ans_h['dental4']; ?> <?=$ans_h['dental5']; ?> <?=$ans_h['dental6']; ?> <?=$ans_h['dental7']; ?> <?=$ans_h['dental_other']; ?> <?=$ans_h['dental_other_desc']; ?>)</font></strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['dental_services_score']; ?></span></strong></td>
                                    </tr>
                                     <tr>
                      <td align="center"><strong><?=$row_h9['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h9['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['smoking_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['smoking_score']; ?></span></strong></td>
                                    </tr>
                                     <tr>
                      <td align="center"><strong><?=$row_h10['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h10['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['drink_beer_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['drink_beer_score']; ?></span></strong></td>
                                    </tr>
			<!--						 <tr>
                      <td align="center"><strong><?=$row_h11['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h11['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['helmet_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['helmet_score']; ?></span></strong></td>
                                    </tr>
									 <tr>
                      <td align="center"><strong><?=$row_h12['health_assessment_id']; ?></strong></td>
                      <td><strong><?=$row_h12['health_assessment_name']; ?></strong></td>
                                    </tr>
                                     <tr>
                                      <td >&nbsp;</td>
  <td><strong class="font-underline col-indigo">คำตอบ : <?=$ans_h['safety_belt_name']; ?> </strong><strong style="float:right">คะแนนที่ได้ : <span class="badge bg-pink"><?=$ans_h['safety_belt_score']; ?></span></strong></td>
                                    </tr> -->
                                </tbody>
                            </table>
                          <div class="body">
                            <blockquote class="m-b-25">
                   <b><p><i class="material-icons col-pink">note_add</i> รวมคะแนน :  <?=$all_score; ?>/30 คะแนน  <i class="material-icons col-light-blue">assignment_ind</i> พฤติกรรมสุขภาพของท่านอยู่ในระดับ : <i class="material-icons <?=$score_color; ?>">favorite</i> <font  class="font-underline <?=$score_color; ?>"><?=$row_sug[health_suggestion_level_name]; ?></font></p></b>
                            </blockquote>
							 <blockquote class="m-b-25">
                             <p><strong><i class="material-icons col-green">verified_user</i>คำแนะนำ</strong>:</p>
                                 <h5><?=$row_sug[health_suggestion_name]; ?> </h5>
                            </blockquote>
                        </div>

                      </div>
                    </div>
                </div>
            </div>
            <!-- #END# Striped Rows -->
			
							            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             <i class="material-icons">equalizer</i> กราฟแสดงผลการประเมินพฤติกรรมสุขภาพ
                    <!--  <small>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code></small> -->
                            </h2>
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
 <canvas id="radarChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Striped Rows -->






    <!-- ChartJs -->
    <script type="text/javascript" src="plugins/chartjs/Chart.bundle.js"></script>


    <script>
  //radar
  var ctxR = document.getElementById("radarChart").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'radar',
  data: {
                labels: ["1.กินผัก", "2.กินเค็ม", "3.กินหวาน", "4.รู้สึกเหนี่อย", "<?=$row_h5['health_assessment_name'] ?>", "การนอน", "7.การแปรงฟัน", "8.ตรวจฟัน", "9.สูบบุหรี่", "10.ดื่มเบียร์"/*,"<?=$row_h11['health_assessment_name'] ?>","<?=$row_h12['health_assessment_name'] ?>"*/],
                datasets: [{
                    label: "คะแนนเฉลี่ยแต่ละข้อ",
                    data: [<?=$ans_h['eating_vegetable_score']; ?>,<?=$ans_h['eating_salty_score'] ?>,<?=$ans_h['eating_sweet_score'] ?>,<?=$ans_h['short_winded_score'] ?>,<?=$ans_h['long_sitting_score'] ?>,<?=$ans_h['sleeping_score'] ?>,<?=$ans_h['brush_teeth_score'] ?>,<?=$ans_h['dental_services_score'] ?>,<?=$ans_h['smoking_score'] ?>,<?=$ans_h['drink_beer_score'] ?>/*,<?=$ans_h['helmet_score'] ?>,<?=$ans_h['safety_belt_score'] ?>*/],
                    borderColor: 'rgba(0, 188, 212, 0.8)',
                    backgroundColor: 'rgba(0, 188, 212, 0.5)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.8)',
                    pointBorderWidth: 1
                }/*, {
                        label: "My Second dataset",
                        data: [72, 48, 40, 19, 50, 27, 80],
                        borderColor: 'rgba(233, 30, 99, 0.8)',
                        backgroundColor: 'rgba(233, 30, 99, 0.5)',
                        pointBorderColor: 'rgba(233, 30, 99, 0)',
                        pointBackgroundColor: 'rgba(233, 30, 99, 0.8)',
                        pointBorderWidth: 1
                    }*/]
            },
    options: {
                responsive: true,
 scale: {
    ticks: {
      min: 0,
      max: 3
    }
  }
    }
  });


</script>
				