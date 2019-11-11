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

?>

<!-- Default Example -->
<? if(!empty($row_data['register_id'])) { ?>
            <div class="row clearfix">
                    <div class="card">
						<img id='barcode' class="pull-right" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=http://203.157.162.18/sfl/index.php?floder=inc%26service=people_health_menu%26pid=<?=$pid; ?>%26rid=<?=$rid; ?>" alt="" title="QR" width="150" height="150" />						
                        <div class="header">
                            <h2>
                เลือกเมนู 
				<p><i class="material-icons ">account_box</i> ชื่อ-สกุล :  <b class="font-underline"><?=$row_data['fullname']; ?></b>      เพศ :  <b class="font-underline"><?=$row_data['sex']; ?> </b>     อายุ :  <b class="font-underline"><?=$row_data['age_y']; ?>  ปี</b>      อาชีพ :  <b class="font-underline"><?=$row_data['occupationname']; ?></b></p>
                                <small><code>แสดงเฉพาะข้อมูลการตรวจสุขภาพที่ละลม</code></small><br>
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
                            <div class="row">
                                <div class="col-xs-6 col-md-4">
                                    <a href="index.php?floder=inc&service=people_health_chart&pid=<?=$pid ?>&rid=<?=$rid ?>" class="thumbnail">
                                        <img src="images/user_trend.png" class="img-responsive">
										 <div class="caption align-center">
                                            <h3 >Trends พฤติกรรมสุขภาพ</h3>
</div>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-4">
                          <a href="index.php?floder=inc&service=people_health_page&pid=<?=$pid ?>&rid=<?=$rid ?>" class="thumbnail">
                                        <img src="images/medical_icon_1-512.png" width="300" height="300" class="img-responsive">
																 <div class="caption align-center">
                                            <h3 >ผลการตรวจ/พฤติกรรมสุขภาพ</h3>
</div>
                                    </a>
                                    </a>
                                </div>
                                <div class="col-xs-6 col-md-4">
                                   <a href="index.php?floder=inc&service=people_health_visit&pid=<?=$pid ?>&rid=<?=$rid ?>" class="thumbnail">
                                        <img src="images/Medical_Chart-512.png"  class="img-responsive">
 <div class="caption align-center">
                                            <h3 >ประวัติการตรวจ/ประเมินพฤติกรรม</h3>
</div>										
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
<? }else{ ?>
<script type="text/javascript">

			  //These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessagex() {
    swal({
        title: "ไม่พบข้อมูลการลงทะเบียนของท่าน",
        text: "กรุณาทำรายการอื่น",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ตกลง",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
          location.href = "index.php";
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

window.onload=showBasicMessagex;
</script>	
<? } ?>
					

