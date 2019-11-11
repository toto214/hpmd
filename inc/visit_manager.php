<?php

if(!empty($_SESSION['lalom_cid'])){
} else{
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=login>"; 
exit();
}



$sql = "SELECT
concat(
r.fname,'  ',
r.lname) fullname,
i.innerscan_service_id,i.cid,i.date_serv,i.weight,
i.height,i.waist_cm,i.sbp,i.dbp,i.congenital_disease,i.fat_percentage,
i.muscle_mass,i.bone_mass,i.bmi,i.metabolic_rate,i.body_water,i.abdominal_fat,i.last_update,i.token,i.energy_need,
r.fname,r.lname,r.register_id
FROM bmi_trends.innerscan_service i 
LEFT JOIN bmi_trends.bmi_register_user r on i.cid = r.cid
GROUP BY i.innerscan_service_id
order by i.date_serv desc
";
$query_sql = mysqli_query($con,$sql);

$i=1;
?>

<!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                       <i class="material-icons ">assignment_late</i>การบันทึกข้อมูลการวิเคราะห์ร่างกาย INNER SCAN
                            </h2>
                            
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                            
               
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                    <thead>
                                        <tr>
										<th width="5px">ที่</th>
										<td align="center" width="8px"><b>id</b></td>
                                            <td align="center"><strong>ชื่อ-สกุล</strong></td>                                  
                                             <td align="center"><strong>วันที่รับบริการ</strong></td>
                                           <!-- <td align="center"><strong>ประเภท</strong></td> -->
                                            <td align="center"><b>จัดการ</b></td>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
									<? while($row_data = mysqli_fetch_array($query_sql)) { 
									$date_serv = strtotime($row_data['date_serv']);
									?>
                                        <tr>
                                            <td align="center"><?=$i++; ?></td>
											<td align="center"><?=$row_data['innerscan_service_id']; ?></td>
                                            <td><?=$row_data['fullname']; ?></td>
                                            <td><?=thai_date($date_serv); ?></td> 
                                      <!--      <td align="center"><?=$row_data['member_type_name']; ?></td> -->
     <td align="center"> <a  href="index.php?floder=inc&service=people_health_menu&pid=<?=md5($row_data['cid']); ?>&rid=<?=md5($row_data['register_id']); ?>" target="_blank" class="btn bg-purple btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">remove_from_queue</i>
                                </a>
								<button   onclick="Ajax_Deleting(<?php echo $row_data['innerscan_service_id']; ?>)" class="btn bg-red btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">delete</i>
                                </button>
</td>
                                        </tr>
                   <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
<?php			
			$sql2 = "
			SELECT
concat(
r.fname,'  ',
r.lname) fullname,
h.health_behavior_risk_id,
h.register_id,
h.eating_vegetable_id,
h.eating_salty_id,
h.drinking_sweet_id,
h.short_winded_id,
h.long_sitting_id,
h.sleeping_time,
h.wakeup_time,
h.brush_teeth_id,
h.dental_services_id,
h.dental1,
h.dental2,
h.dental3,
h.dental4,
h.dental5,
h.dental6,
h.dental7,
h.dental_other,
h.dental_other_desc,
h.smoking_id,
h.drink_beer_id,
h.helmet_id,
h.safety_belt_id,
date(h.last_update) date_serv,
h.cid cid_rsk,
r.cid,
h.del_status
FROM health_behavior_risk h  
LEFT JOIN bmi_trends.bmi_register_user r on h.register_id = r.register_id
GROUP BY h.health_behavior_risk_id
ORDER BY h.last_update DESC
";
$query_sql2 = mysqli_query($con,$sql2);

$i=1;
?>

<!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                       <i class="material-icons ">library_books</i>การบันทึกข้อมูลแบบสอบถามพฤติกรรมสุขภาพ
                            </h2>
                            
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                            
               
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTable">
                                    <thead>
                                        <tr>
										<th width="5px">ที่</th>
										<td align="center" width="8px"><b>id</b></td>
                                            <td align="center"><strong>ชื่อ-สกุล</strong></td>                                  
                                             <td align="center"><strong>วันที่รับบริการ</strong></td>
                                           <!-- <td align="center"><strong>ประเภท</strong></td> -->
                                            <td align="center"><b>จัดการ</b></td>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
									<? while($row_data = mysqli_fetch_array($query_sql2)) { 
									$date_serv = strtotime($row_data['date_serv']);
									?>
                                        <tr>
                                            <td align="center"><?=$i++; ?></td>
											<td align="center"><?=$row_data['health_behavior_risk_id']; ?></td>
                                            <td><?=$row_data['fullname']; ?></td>
                                            <td><?=thai_date($date_serv); ?></td> 
                                      <!--      <td align="center"><?=$row_data['member_type_name']; ?></td> -->
                  <td align="center"> <a  href="index.php?floder=inc&service=people_health_menu&pid=<?=md5($row_data['cid']); ?>&rid=<?=md5($row_data['register_id']); ?>" target="_blank" class="btn bg-orange btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">remove_from_queue</i>
                                </a>
			<button   onclick="Ajax_Deleting2('<?php echo $row_data['health_behavior_risk_id']; ?>')" class="btn bg-black btn-circle waves-effect waves-circle waves-float waves-light">
                                    <i class="material-icons">delete</i>
                                </button>
</td>
                                        </tr>
                   <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
		<script type="text/javascript" charset="utf-8">	
			function Ajax_Deleting(innerscan_service_id){
		var con = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
		if(con){
			$.ajax({
				type: "POST",
				url: "ajax/Del_Inner_Scan.php",
				data: "innerscan_service_id="+innerscan_service_id,

				cache: false,
				success: function(data){
					if(data=="TRUE"){
						alert("ลบข้อมูลเรียบร้อย"+innerscan_service_id);
				
				window.location.href = "index.php?floder=inc&service=visit_manager";

					}
				}
			});
		}
	}
	
	function Ajax_Deleting2(health_behavior_risk_id){
		var con = confirm("คุณต้องการลบข้อมูลใช่หรือไม่");
		if(con){
			$.ajax({
				type: "POST",
				url: "ajax/Del_behavior_risk.php",
				data: "health_behavior_risk_id="+health_behavior_risk_id,

				cache: false,
				success: function(data){
					if(data=="TRUE"){
						alert("ลบข้อมูลเรียบร้อย"+health_behavior_risk_id);
				
				window.location.href = "index.php?floder=inc&service=visit_manager";

					}
				}
			});
		}
	}
	</script>