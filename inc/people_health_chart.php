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


$query_g = "
select t.*,concat(t.bmi,'(',t.bmi_name,')') d_bmi_name  from(SELECT
i.innerscan_service_id,i.cid,
DATE_FORMAT(i.date_serv,'%d/%m/%Y') date_serv,
#i.date_serv,
i.weight,i.height,i.waist_cm,i.sbp,i.dbp,i.congenital_disease,i.fat_percentage,
i.muscle_mass,i.bone_mass,i.bmi,
CASE WHEN i.bmi >= 25 THEN 'อ้วน'  
WHEN i.bmi BETWEEN 23 and 24.99 THEN 'ท้วม'
WHEN i.bmi BETWEEN 18.5 and 22.99 THEN 'ปกติ'
WHEN i.bmi BETWEEN 10 and 18.49 THEN 'ผอม' ELSE 'จัดกลุ่มไม่ได้' END bmi_name,i.metabolic_rate,i.body_water,i.abdominal_fat,i.last_update,i.token,i.energy_need
FROM bmi_trends.innerscan_service i 
WHERE md5(i.cid) = '$pid'
order by i.date_serv asc ) t
";
	$rs = mysqli_query($con,$query_g);
$c_date_serv = array(); //ตัวแปรแกน y
$c_weight = array();
$c_waist_cm = array();
$c_fat_percentage = array();
$c_muscle_mass = array();

$query_chart = mysqli_query($con,$query_g);
while($row_chart=mysqli_fetch_array($query_chart)) {
	
	$totol[] = "\"".$row_chart['date_serv']."\""; 
	$bmi[] = "\"".$row_chart['bmi']."\""; 
	$weight[] = "\"".$row_chart['weight']."\""; 
	$bmi_name[] = "\"".$row_chart['bmi_name']."\""; 
	$d_bmi_name[] = "\"".$row_chart['d_bmi_name']."\""; 
	$energy_need[] = "\"".$row_chart['energy_need']."\""; 
	$metabolic_rate[] = "\"".$row_chart['metabolic_rate']."\""; 
	$bone_mass[] = "\"".$row_chart['bone_mass']."\""; 
	$abdominal_fat[] = "\"".$row_chart['abdominal_fat']."\""; 
 array_push($c_date_serv,$row_chart['date_serv']);
 array_push($c_weight,$row_chart['weight']);
  array_push($c_waist_cm,$row_chart['waist_cm']);
    array_push($c_fat_percentage,$row_chart['fat_percentage']);
  array_push($c_muscle_mass,$row_chart['muscle_mass']);
 #array_push($name_array,stripslashes($row_chart['group504name']));
}
$date_serv = implode(",", $totol); 
$c_bmi = implode(",", $bmi); 
$c_bmi_name = implode(",", $bmi_name); 
$c_d_bmi_name = implode(",", $d_bmi_name); 
$c_weight = implode(",", $weight); 
$c_energy_need = implode(",", $energy_need); 
$c_metabolic_rate = implode(",", $metabolic_rate); 
$c_bone_mass = implode(",", $bone_mass); 
$c_abdominal_fat = implode(",", $abdominal_fat); 
?>    
	
            <div class="row clearfix">
                    <div class="card">
						<img id='barcode' class="pull-right" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=http://203.157.162.18/sfl/index.php?floder=inc%26service=people_health_chart%26pid=<?=$pid; ?>%26rid=<?=$rid; ?>" alt="" title="QR" width="150" height="150" />						
                        <div class="header">
						   <div class="bs-example" data-example-id="media-alignment">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="javascript:void(0);">
                                            <img class="media-object" src="images/user_trend.png" width="64" height="64">
                                        </a>
                                    </div>
                                    <div class="media-body">
            <h4 class="media-heading">Trends การตรวจสุขภาพ  ชื่อ-สกุล :  <b class="font-underline"><?=$row_data['fullname']; ?></b>      เพศ :  <b class="font-underline"><?=$row_data['sex']; ?> </b>     อายุ :  <b class="font-underline"><?=$row_data['age_y']; ?>  ปี</b></h4>
                                        <p>
															<a class="btn bg-pink waves-effect" href="index.php?floder=inc&service=people_health_menu&pid=<?=$pid ?>&rid=<?=$rid ?>">
                                    <i class="material-icons">menu</i>
                                    <span><strong>กลับไปหน้าเมนู</strong></span>
                                </a>
                                            <small><code>แสดงเฉพาะข้อมูลการตรวจสุขภาพที่ละลม</code></small> 

                                        </p>

                                    </div>
                                </div>															
</div>

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
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends ดัชนีมวลกาย BMI</h2>
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
                            <canvas id="line_bmi" height="150"></canvas>
                        </div>
                    </div>
                </div>
				<div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends น้ำหนัก</h2>
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
					
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
				</div>		
					
				<div class="row clearfix">
								                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends รอบเอว</h2>
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
                            <canvas id="line_waist_cm" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends เปอร์เซ็นต์ไขมัน</h2>
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
                            <canvas id="line_fat_percentage" height="150"></canvas>
                        </div>
                    </div>
                </div>
				

				</div>	

								<div class="row clearfix">
				                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends มวลกล้ามเนื้อ</h2>
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
                            <canvas id="line_muscle_mass" height="150"></canvas>
                        </div>
                    </div>
                </div>
								                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends มวกกระดูก</h2>
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
                            <canvas id="line_bone_mass" height="150"></canvas>
                        </div>
                    </div>
                </div>
				                
				</div>

								<div class="row clearfix">
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends พลังงานที่ร่างกายต้องการ</h2>
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
                            <canvas id="line_energy_need" height="150"></canvas>
                        </div>
                    </div>
                </div>
				                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends อัตราการเผาผลาญ</h2>
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
                            <canvas id="line_metabolic_rate" height="150"></canvas>
                        </div>
                    </div>
                </div>
				

				</div>	

								<div class="row clearfix">
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Trends ไขมันที่เกาะในช่องท้อง</h2>
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
                            <canvas id="line_abdominal_fat" height="150"></canvas>
                        </div>
                    </div>
                </div>

				

				</div>					
                        </div>
                    </div>
                </div>

				

				

				 <!-- ChartJs -->
    <script type="text/javascript" src="plugins/chartjs/Chart.bundle.js"></script>


<script>
  //น้ำหนัก
  var ctxR = document.getElementById("line_chart").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "(ก.ก.)",
                    data: [<?=$c_weight;?>],
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
                legend: false
    }
  });

    //รอบเอว
  var ctxR = document.getElementById("line_waist_cm").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "ซ.ม.",
                    data: [<?= implode(',', $c_waist_cm) // ข้อมูล array แกน y ?>],
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
                legend: false
    }
  });
  
   // % ไขมัน
  var ctxR = document.getElementById("line_fat_percentage").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "%",
                    data: [<?= implode(',',$c_fat_percentage) // ข้อมูล array แกน y ?>],
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
                legend: false
    }
  });
  
  // % มวลกล้ามเนื้อ
  var ctxR = document.getElementById("line_muscle_mass").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "%",
                    data: [<?= implode(',',$c_muscle_mass) // ข้อมูล array แกน y ?>],
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
                legend: false
    }
  });
  
   // BMI
  var ctxR = document.getElementById("line_bmi").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$c_d_bmi_name;?>],
                datasets: [{
                    label: "ดัชนีมวลกาย",
                    data: [<?=$c_bmi;?>],
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
                legend: true
    }
  });
  
      //พลังงานที่ร่างกายต้องการ
  var ctxR = document.getElementById("line_energy_need").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "Kcal",
                    data: [<?=$c_energy_need; ?>],
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
                legend: false
    }
  });
   //อัตราการเผาผลาญ
  var ctxR = document.getElementById("line_metabolic_rate").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "ปี",
                    data: [<?=$c_metabolic_rate; ?>],
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
                legend: false
    }
  });
  
   //มวลกระดูก
  var ctxR = document.getElementById("line_bone_mass").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "ก.ก.",
                    data: [<?=$c_bone_mass; ?>],
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
                legend: false
    }
  });
  
   //มวลกระดูก
  var ctxR = document.getElementById("line_abdominal_fat").getContext('2d');
  var myRadarChart = new Chart(ctxR, {
    type: 'line',
  data: {
                labels: [<?=$date_serv;?>],
                datasets: [{
                    label: "ก.ก.",
                    data: [<?=$c_abdominal_fat; ?>],
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
                legend: false
    }
  });
  //These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessagex() {
    swal("Here's a message!", "It's pretty, isn't it?");
}
</script>