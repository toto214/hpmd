<?php  

//นับคนตรวจสุขภาพ
$sql = "SELECT  COUNT(DISTINCT i.cid) cid,
COUNT(DISTINCT (IF(b.sex = '1',b.cid,null))) male  ,
COUNT(DISTINCT (IF(b.sex = '2',b.cid,null))) female  

FROM bmi_trends.innerscan_service   i
LEFT JOIN  bmi_trends.bmi_register_user  b on i.cid = b.cid";
$query_sql = mysqli_query($con,$sql);
$row_data = mysqli_fetch_array($query_sql);

//นับคนตอบแบบสอบถามพฤิติกรรมสุขภาพ
$sql2 = "SELECT  COUNT(DISTINCT b.cid) cid,
COUNT(DISTINCT (IF(b.sex = '1',b.cid,null))) male  ,
COUNT(DISTINCT (IF(b.sex = '2',b.cid,null))) female  

FROM bmi_trends.health_behavior_risk   i
LEFT JOIN  bmi_trends.bmi_register_user  b on i.register_id = b.register_id";
$query_sql2 = mysqli_query($con,$sql2);
$row_data2 = mysqli_fetch_array($query_sql2);

$sql_bmi = "select b.bmi_id,concat(t.bmi,'(',b.bmi_result,')') d_bmi_name,b.bmi_result,COUNT(t.cid) cid  from(SELECT
i.innerscan_service_id,i.cid,
DATE_FORMAT(i.date_serv,'%d/%m/%Y') date_serv,
#i.date_serv,
i.weight,i.height,i.waist_cm,i.sbp,i.dbp,i.congenital_disease,i.fat_percentage,
i.muscle_mass,i.bone_mass,i.bmi,
CASE WHEN i.bmi >= 25 THEN '4'  
WHEN i.bmi BETWEEN 23 and 24.99 THEN '3'
WHEN i.bmi BETWEEN 18.5 and 22.99 THEN '2'
WHEN i.bmi BETWEEN 10 and 18.49 THEN '1' ELSE '0' END bmi_name,i.metabolic_rate,i.body_water,i.abdominal_fat,i.last_update,i.token,i.energy_need
FROM bmi_trends.innerscan_service i 
INNER JOIN 
(SELECT s.cid,MAX(s.date_serv) date_serv FROM bmi_trends.innerscan_service s GROUP BY s.cid ) s
ON i.cid = s.cid and i.date_serv = s.date_serv
GROUP BY i.cid
order by i.date_serv asc ) t
LEFT OUTER JOIN bmi_trends.cbmi_result b on t.bmi_name = b.bmi_id
GROUP BY b.bmi_id";
$query_bmi = mysqli_query($con,$sql_bmi);
while($row_bmi=mysqli_fetch_array($query_bmi)) {

	$bmi_result[] = "\"".$row_bmi['bmi_result']."\""; 
	$bmi_cid[] = "\"".$row_bmi['cid']."\""; 
}
$c_bmi_result = implode(",", $bmi_result); 
$c_bmi_cid = implode(",", $bmi_cid); 

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

mysqli_data_seek($rsh,0);
$row_h1 = mysqli_fetch_array($rsh);
$health_assessment_name1 = $row_h1['health_assessment_name'];

mysqli_data_seek($rsh,1);
$row_h2 = mysqli_fetch_array($rsh);
$health_assessment_name2 = $row_h2['health_assessment_name'];

mysqli_data_seek($rsh,2);
$row_h3 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,3);
$row_h4 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,4);
$row_h5 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,5);
$row_h6 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,6);
$row_h7 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,7);
$row_h8 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,8);
$row_h9 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,10);
$row_h10 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,11);
$row_h11 = mysqli_fetch_array($rsh);

mysqli_data_seek($rsh,12);
$row_h12 = mysqli_fetch_array($rsh);


$sql_ans = "SELECT 
		avg(h.eating_vegetable_score) eating_vegetable_score,
		avg(h.eating_salty_score) eating_salty_score,
		avg(h.eating_sweet_score) eating_sweet_score,
		avg(h.short_winded_score) short_winded_score,
		avg(h.long_sitting_score) long_sitting_score,
		avg(h.sleeping_score) sleeping_score,
		avg(h.brush_teeth_score) brush_teeth_score,
		avg(h.dental_services_score) dental_services_score,
		avg(h.smoking_score) smoking_score,
		avg(h.drink_beer_score) drink_beer_score,COUNT(h.register_id) register_id
 FROM  
(SELECT
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
(SELECT s.register_id,s.cid,MAX(date(s.last_update)) date_serv FROM bmi_trends.health_behavior_risk s  GROUP BY s.register_id) s
ON  h.register_id = s.register_id   and DATE(h.last_update) = s.date_serv

GROUP BY h.register_id )  h";
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

$sql_sug = "SELECT r.score,COUNT(r.register_id) register_id FROM 
(SELECT 
(h.eating_vegetable_score+h.eating_salty_score+h.eating_sweet_score+h.short_winded_score+h.long_sitting_score
+h.sleeping_score+h.brush_teeth_score+h.dental_services_score+h.smoking_score+h.drink_beer_score) all_score,
CASE 
WHEN 
(h.eating_vegetable_score+h.eating_salty_score+h.eating_sweet_score+h.short_winded_score+h.long_sitting_score
+h.sleeping_score+h.brush_teeth_score+h.dental_services_score+h.smoking_score+h.drink_beer_score) BETWEEN 6 and 14 THEN 'ปรับปรุง' 
WHEN 
(h.eating_vegetable_score+h.eating_salty_score+h.eating_sweet_score+h.short_winded_score+h.long_sitting_score
+h.sleeping_score+h.brush_teeth_score+h.dental_services_score+h.smoking_score+h.drink_beer_score) BETWEEN 15 and 22 THEN 'พอใช้' 
WHEN 
(h.eating_vegetable_score+h.eating_salty_score+h.eating_sweet_score+h.short_winded_score+h.long_sitting_score
+h.sleeping_score+h.brush_teeth_score+h.dental_services_score+h.smoking_score+h.drink_beer_score) BETWEEN 23 and 30 THEN 'ดี' 
ELSE  '' END score,
COUNT(h.register_id) register_id
 FROM  
(SELECT
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
(SELECT s.register_id,s.cid,MAX(date(s.last_update)) date_serv FROM bmi_trends.health_behavior_risk s  GROUP BY s.register_id) s
ON  h.register_id = s.register_id   and DATE(h.last_update) = s.date_serv

GROUP BY h.register_id)  h
GROUP BY  h.register_id )  r
GROUP BY r.score ORDER BY score
";
$query_sug = mysqli_query($con,$sql_sug);
while($row_sug=mysqli_fetch_array($query_sug)) {

	$score[] = "\"".$row_sug['score']."\""; 
	$sug_register_id[] = "\"".$row_sug['register_id']."\""; 
}
$c_score = implode(",", $score); 
$c_sug_register_id = implode(",", $sug_register_id); 

  ?>
  <div class="row clearfix">
  <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box  hover-expand-effect">
                        <div class="icon bg-blue">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><b>ผู้ตรวจสุขภาพ (คน)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
                            <div class="number count-to" data-from="0" data-to="<?=$row_data['cid']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
						<div class="icon bg-blue">
                            <i class="material-icons">wc</i>
                        </div>
                        <div class="content">
                            <div class="text"><b>ชาย</b>&nbsp;/&nbsp;<b>หญิง</b></div>
                            <div class="number "><?=$row_data['male']; ?>&nbsp;/&nbsp;<?=$row_data['female']; ?></div>
							  
                        </div>

                    </div>
                </div>
				
				  <div class="col-lg-6 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box  hover-expand-effect">
                        <div class="icon bg-pink">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text"><b>ตอบแบบสอบถาม (คน)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div>
                            <div class="number count-to" data-from="0" data-to="<?=$row_data2['cid']; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
						<div class="icon bg-pink">
                            <i class="material-icons">wc</i>
                        </div>
                        <div class="content">
                            <div class="text"><b>ชาย</b>&nbsp;/&nbsp;<b>หญิง</b></div>
                            <div class="number "><?=$row_data2['male']; ?>&nbsp;/&nbsp;<?=$row_data2['female']; ?></div>
                        </div>

                    </div>
                </div>

	
  </div>
<div class="row clearfix">
 <!--<div class="block-header">
                <h2>DASHBOARD</h2>
            </div> -->
			                <!-- With Captions -->

                <!-- #END# With Captions -->
				
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="material-icons">pie_chart</i> ภาพรวมดัชนีมวลกาย</h2>
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
                            <canvas id="pie_chart_bmi" height="150"></canvas>
                        </div>
                    </div>
                </div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class="material-icons">pie_chart</i>ภาพรวมคะแนนพฤติกรรมสุขภาพ</h2>
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
                            <canvas id="pie_chart_score" height="150"></canvas>
                        </div>
                    </div>
                </div>
				</div>
				
				<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             <i class="material-icons">equalizer</i> ภาพรวมแสดงผลการประเมินพฤติกรรมสุขภาพของผู้ประเมิน
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
					<!--	
				<div class="row clearfix">

		
				                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>ภาพกิจกรรม</h2>
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
                            <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                               
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic_2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="2"></li>
                                </ol>
                       
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="images/image-gallery/10.jpg" />
                                        <div class="carousel-caption">
                                            <h3>First slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="images/image-gallery/12.jpg" />
                                        <div class="carousel-caption">
                                            <h3>Second slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="images/image-gallery/19.jpg" />
                                        <div class="carousel-caption">
                                            <h3>Third slide label</h3>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                </div>
                            
                                <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				</div> -->
				
 <!-- ChartJs -->
    <script type="text/javascript" src="plugins/chartjs/Chart.bundle.js"></script>
	<script>
  //BMI
  var ctxR = document.getElementById("pie_chart_bmi").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
	
    type: 'doughnut',
  data: {

                   datasets: [{
                    data: [<?=$c_bmi_cid;?>],
                    backgroundColor: [
                        "rgb(255,215,0)",
                        "rgb(154,205,50)",
                        "rgb(255,193,7)",
                        "rgb(255,0,0)"
                    ],
					label: 'Dataset 1'
                }],

                labels: [<?=$c_bmi_result;?>]
            },
    options: {
                responsive: true,
				  showTooltips: true,
				legend: {
            display: true,
        }
		
    },
	 centerText: {
        display: true,
        text: "280"
    }
  });
  </script>
  
	<script>
  //SCORE
  var ctxR = document.getElementById("pie_chart_score").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
	
    type: 'pie',
  data: {

                   datasets: [{
                    data: [<?=$c_sug_register_id;?>],
                    backgroundColor: [
                        "rgb(154,205,50)",
                        "rgb(255,255,0)",
                        "rgb(255,0,0)",
                        "rgb(255,0,0)"
                    ],
					label: 'Dataset 1'
                }],

                labels: [<?=$c_score;?>]
            },
    options: {
                responsive: true,
				  showTooltips: true,
				legend: {
            display: true,
        }
		
    },
	 centerText: {
        display: true,
        text: "280"
    }
  });
  </script>
  
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
				