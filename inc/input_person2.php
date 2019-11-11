
<?php
if(!empty($_SESSION['lalom_cid'])){
} else{
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=login>"; 
exit();
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
where md5(b.cid) = '".$_GET['pid']."'
GROUP BY b.cid";
$query_sql = mysqli_query($con,$sql);
$row_data = mysqli_fetch_array($query_sql);

$query = "SELECT
i.innerscan_service_id,i.cid,i.date_serv,i.weight,
i.height,i.waist_cm,i.sbp,i.dbp,i.congenital_disease,i.fat_percentage,
i.muscle_mass,i.bone_mass,i.bmi,i.metabolic_rate,i.body_water,i.abdominal_fat,i.last_update,i.token
FROM bmi_trends.innerscan_service i 
INNER JOIN 
(SELECT s.cid,MAX(s.date_serv) date_serv FROM bmi_trends.innerscan_service s WHERE md5(s.cid) = '".$_GET['pid']."') s
ON i.cid = s.cid and i.date_serv = s.date_serv
WHERE md5(i.cid) = '".$_GET['pid']."'
GROUP BY i.cid
";
	$rs = mysqli_query($con,$query);
$row_d = mysqli_fetch_array($rs);
$date_serv = strtotime($row_d['date_serv']);
?>
		<link type="text/css" href="datepicker_buddhist_year/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker_buddhist_year/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker_buddhist_year/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
       

<div class="container-fluid">
 <!-- Advanced Form Example With Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h3>รายละเอียดเก็บข้อมูลสุขภาพเบื้องต้น</h3>
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
							                                    <div class="col-md-12">
									       <p>
   <b>ชื่อ-สกุล :  <b class="font-underline"><?=$row_data['fullname']; ?></b>      เพศ :  <b class="font-underline"><?=$row_data['sex']; ?> </b>     อายุ :  <b class="font-underline"><?=$row_data['age_y']; ?>  ปี</b>      อาชีพ :  <b class="font-underline"><?=$row_data['occupationname']; ?></b></b>
                                    </p>

                                    </div>
                        </div>
						 <div class="header">
						  <h3>2.ผลการวิเคราะห์เครื่องวัดองค์ประกอบร่างกาย (Inner Scan)</h3>
						 </div>
                        <div class="body">
                         <form name="input" action="index.php?floder=ajax&service=Add_Inner_Scan" method="POST">
						
						 <div class="row clearfix">
                                <div class="col-md-5">
<h4><b> <i class="material-icons col-amber">content_paste</i> บันทึกผลครั้งล่าสุด ณ วันที่  <?=thai_date($date_serv); ?> </b></h4>
								</div>
								 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								 <input name="cid" id="cid" type="hidden" value="<?=$row_data['cid']; ?>" />
								 <input name="register_id" id="register_id" type="hidden" value="<?=$row_data['register_id']; ?>" />
                <button type="button" onclick="GetInnerScan();" class="btn bg-red waves-effect"><i class="material-icons">check_box</i>
<span>ดึงผลครั้งล่าสุด</span></button>
                                    </div>

								</div>


                           
                               
                                <fieldset>
                                    <div class="form-group form-float">
								<div class="row clearfix">
								                                <div class="col-md-3">
                                    <p>
                                        <b>วันที่รับบริการ</b>
                                    </p>
                                <div class="input-group "> 
                                        <div class="form-group">
                                         <div class="form-line">
                                          <input type="text" class="form-control" size="10" id="date_serv" name="date_serv" />
</div>
</div>
 <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        </div>
                                       
                                       
                                    </div>
								<div class="col-md-2">
                                    <p>
                                        <b>น้ำหนัก</b>
                                    </p>
                                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" onkeyup="checkNumber(this);" name="weight" id="weight" required>
                                        <label class="form-label"></label>
                                    </div>
                                 <div class="help-info">กิโลกรัม</div> 
                                </div>
                       
 
                                </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>ส่วนสูง</b>
                                    </p>
                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="height" id="height" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">เซนติเมตร</div> 
                                </div>
                                </div>
                                <div class="col-md-2 center">
                                    <p>
                                        <b>รอบเอว</b>
                                    </p>
                                         <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="waist_cm" id="waist_cm" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">เซนติเมตร</div> 
                                </div>
                                </div>
                              
								
                                       </div>
									   
									   <!-- row 2 -->
						<div class="row clearfix">
						  <div class="col-md-3">
                                    <p>
                                        <b>ค่าความดันโลหิต(บน)</b>
                     <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="sbp" id="sbp" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">มิลลิเมตรปรอท</div> 
                                </div>
                            </div>
													  <div class="col-md-3">
                                    <p>
                                        <b>ค่าความดันโลหิต(ล่าง)</b>
                     <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="dbp" id="dbp" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">มิลลิเมตรปรอท</div> 
                                </div>
                            </div>
												<div class="col-md-4">
                                    <p>
                                        <b>โรคประจำตัว</b>
                     <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="congenital_disease" id="congenital_disease" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">จากการวินิจฉัยของแพทย์</div> 
                                </div>
                            </div>
                                <div class="col-md-2">
                                    <p>
                                        <b>เปอร์เซ็นต์ไขมัน</b>
                                    </p>
                        <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="fat_percentage" id="fat_percentage" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">%</div> 
                                </div>
                                       
                                       
                                    </div>

 
 
						
							</div>
									   <!-- row 3 -->
						<div class="row clearfix">
						                    <div class="col-md-2">
                                    <p>
                                        <b>มวลกล้ามเนื้อ</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="muscle_mass" id="muscle_mass" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">กิโลกรัม</div> 
                                </div>
                            </div>

                                                    <div class="col-md-3">
                                    <p>
                                        <b>เปอร์เซ็นต์น้ำในร่างกาย</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="body_water" id="body_water" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">%</div> 
                                </div>
                          </div> 


						     <div class="col-md-3">
                                    <p>
                                        <b>มวลกระดูก</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="bone_mass" id="bone_mass" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">กิโลกรัม</div> 
                                </div>
                            </div>  

							                         <div class="col-md-3">
                                    <p>
                                        <b>พลังงานที่ร่างกายต้องการ</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="energy_need" id="energy_need" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">กิโลแคลอรี่ (Kcal)</div> 
                                </div>
                            </div> 





					</div>
															   <!-- row 4 -->
 
						<div class="row clearfix">


                    <div class="col-md-3">
                                    <p>
                                        <b>อัตราการเผาพลาญ</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="metabolic_rate" id="metabolic_rate" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">เทียบเท่ากับคนอายุ(ปี)</div> 
                                </div>
                    </div>


                

				    <div class="col-md-5">
                                    <p>
                                        <b>ไขมันที่เกาะตามอวัยวะในช่องท้อง</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                  
                                        <input type="number" step="any" class="form-control" name="abdominal_fat" id="abdominal_fat" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info"></div> 
                                </div>
                            </div> 
                                                    <div class="col-md-4">
                                    <p>
                                        <b>ค่าดัชนีมวลกาย (BMI)</b>
                                    </p>
                    <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" step="any" class="form-control" name="bmi" id="bmi" required>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="help-info">กก./ม² (กิโลกรัมหารด้วยส่วนสูงเป็นเมตรยกกำลังสอง)</div> 
                                </div>
                            </div>  
					</div>
<button type="submit" class="btn  bg-blue waves-effect pull-right"> <i class="material-icons">save</i>บันทึก</button>							
                                       </div>

									   </div>
                                </fieldset>
                            </form> 
                        </div>
						
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
            </div>
			
      
 <script>        
 function GetInnerScan(){
 var cid = $("#cid").val();
		$.ajax({
			type: "POST",
			url: "ajax/AjaxGetInnerScan.php",
			data: "cid="+cid,
			cache: false,
			success: function(data){
				var personInfo = JSON.parse(data);
				$('#weight').val(personInfo[0]['weight']);
				$('#height').val(personInfo[0]['height']);
				$('#waist_cm').val(personInfo[0]['waist_cm']);
				$('#sbp').val(personInfo[0]['sbp']);
				$('#dbp').val(personInfo[0]['dbp']);
				$('#congenital_disease').val(personInfo[0]['congenital_disease']);
				$('#fat_percentage').val(personInfo[0]['fat_percentage']);
				$('#muscle_mass').val(personInfo[0]['muscle_mass']);
				$('#bone_mass').val(personInfo[0]['bone_mass']);
				$('#bmi').val(personInfo[0]['bmi']);
				$('#energy_need').val(personInfo[0]['energy_need']);
				$('#metabolic_rate').val(personInfo[0]['metabolic_rate']);
				$('#body_water').val(personInfo[0]['body_water']);
				$('#abdominal_fat').val(personInfo[0]['abdominal_fat']);
			}
		});
	}
    </script>    
 <script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


		    // กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)

		    $("#date_serv").datepicker({   format: 'yyyy-mm-dd',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน});

		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true,dateFormat: 'yy-mm-dd', isBuddhist: true, defaultDate: toDay,dayNames: ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

     		    $("#datepicker-en").datepicker({ dateFormat: 'dd/mm/yy'});

		    $("#inline").datepicker({ dateFormat: 'yy-mm-dd', inline: true });


			});
		</script>
        <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
        });
    </script>
	<script>
/*function save(){
					var cid = $("#cid") = '<?=$row_data['cid'] ?>';
					var date_serv = $("#date_serv").val();
					var weight = $("#weight").val();
					var height= $("#height").val();
					var waist_cm = $("#waist_cm").val();
					var sbp = $("#sbp").val();
					var congenital_disease = $("#congenital_disease").val();
					var fat_percentage = $("#fat_percentage").val();
					var muscle_mass = $("#muscle_mass").val();
					var bone_mass = $("#bone_mass").val();
					var bmi = $("#bmi").val();
					var metabolic_rate = $("#metabolic_rate").val();
					var body_water = $("#body_water").val();
					var abdominal_fat = $("#abdominal_fat").val();

					if(gas_reporting_for !="" && gas_reporting_content !="" && gas_reporting_benefit !="" && gas_reporting_signer !="" ){
					$.ajax({
						type: "POST",
						url: "Ajax/add_gas_reporting.php",
						data: "gas_reporting_for="+gas_reporting_for
								+"&gas_info_id="+gas_info_id
								+"&gas_reporting_hospcode="+gas_reporting_hospcode
								+"&gas_reporting_department_id="+gas_reporting_department_id
								+"&gas_reporting_budjet="+gas_reporting_budjet
							  +"&gas_reporting_content="+gas_reporting_content
							  +"&gas_reporting_benefit="+gas_reporting_benefit
							  +"&gas_reporting_signer="+gas_reporting_signer,
						cache: false,
						success: function(data){
							alert("บันทึกข้อมูลเรียบร้อย");		
							window.location.href = "index.php?page=governor_hrd&path=page";

						}
					});
					}else{
						alert("กรุณากรอกข้อมูล  ให้ครบถ้วน");
					}	
				}*/
				</script>
	