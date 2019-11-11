
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
left join bmi_trends.coccupation c on b.occupation = c.occupationcode
where md5(b.cid) = '".$_GET['pid']."'
GROUP BY b.cid";
$query_sql = mysqli_query($con,$sql);
$row_data = mysqli_fetch_array($query_sql);

$query = "SELECT
h.health_assessment_id,
h.health_assessment_name,
h.health_assessment_desc,
h.health_assessment_status
FROM bmi_trends.health_assessment  h
WHERE h.health_assessment_status = 'Y' order by h.health_assessment_id
";
$rs = mysqli_query($con,$query);
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
						  <h3>3.แบบประเมินพฤติกรรมสุขภาพ</h3>
						 </div>
                        <div class="body">
                         <form name="input" action="index.php?floder=ajax&service=Add_health_behavior_risk" method="POST">
						 <input name="cid" id="cid" type="hidden" value="<?=$row_data['cid']; ?>" />
						  <input name="register_id" id="register_id" type="hidden" value="<?=$row_data['register_id']; ?>" />
					<!--	 <div class="row clearfix">
                                <div class="col-md-5">
<h4><b> <i class="material-icons col-amber">content_paste</i> บันทึกผลครั้งล่าสุด วันที่  <?=thai_date($date_serv); ?> </b></h4>
								</div>
								 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								
                <button type="button" onclick="GetInnerScan();" class="btn bg-red waves-effect"><i class="material-icons">check_box</i>
<span>ดึงผลครั้งล่าสุด</span></button>
                                    </div>

								</div> -->


                           
                               
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
								
								
                                       </div>
									   <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h1['health_assessment_name'] ?></h4>
							<select class="form-control " id="a1" name ="a1"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.eating_vegetable_id,
r.eating_vegetable_name
FROM `rsk_eating_vegetable` r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["eating_vegetable_id"];?>"><?=$obj_race["eating_vegetable_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>

									     </p>
									   </div>
									   
									   					   <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h2['health_assessment_name'] ?></h4>
									   <select class="form-control " id="a2" name ="a2"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.eating_salty_id,
r.eating_salty_name
FROM `rsk_eating_salty` r";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["eating_salty_id"];?>"><?=$obj_race["eating_salty_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>
									   </div>
									   
									     <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h3['health_assessment_name'] ?></h4>
							<select class="form-control " id="a3" name ="a3"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.eating_sweet_id,
r.eating_sweet_name
FROM `rsk_drinking_sweet` r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["eating_sweet_id"];?>"><?=$obj_race["eating_sweet_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>
									   </div>
									   
									    <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h4['health_assessment_name'] ?></h4>
						<select class="form-control " id="a4" name ="a4"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.short_winded_id,
r.short_winded_name
FROM `rsk_short_winded` r

";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["short_winded_id"];?>"><?=$obj_race["short_winded_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>
									   </div>
									   
									 <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h5['health_assessment_name'] ?></h4>
							<select class="form-control " id="a5" name ="a5"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.long_sitting_id,
r.long_sitting_name
FROM `rsk_long_sitting` r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["long_sitting_id"];?>"><?=$obj_race["long_sitting_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>
									   </div>
									   
									  <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h6['health_assessment_name'] ?></h4>
		                         <div class="col-md-6">
								 <h4>เข้านอน</h4>
                                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">access_time</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="time" class="form-control" name="a6" id="datetimepicker3" placeholder="Ex: 23:59">
                                            </div>
                                        </div>
										</div>

                             
									  
									   	                         <div class="col-md-6">
								 <h4>ตื่นนอน</h4>
                                                            <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">access_time</i>
                                            </span>
                                            <div class="form-line">
                                                <input type="time" class="form-control" name="a6_2" id="datetimepicker3" placeholder="Ex: 23:59">
                                            </div>
                                        </div>
										</div>

                             
									   </div>
					<!--				   <select class="form-control " id="a6_3" name ="a6_3"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.rsk_sleep_id,
r.rsk_sleep_name,
r.rsk_sleep_score
FROM `rsk_sleep`  r

";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["rsk_sleep_id"];?>"><?=$obj_race["rsk_sleep_name"];?></option>

      <?
	}
	?>
                                    </select>  -->
									   </div>
									   
									   
									   							    <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h7['health_assessment_name'] ?></h4>
						<select class="form-control " id="a7" name ="a7"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.brush_teeth_id,
r.brush_teeth_name
FROM `rsk_brush_teeth` r

";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["brush_teeth_id"];?>"><?=$obj_race["brush_teeth_name"];?></option>

      <?
	}
	?>
                                    </select> 
									   </div>
									   </div>
									   
									   							    <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h8['health_assessment_name'] ?></h4>
						<select class="form-control " id="a8" name ="a8"   onChange="Check_Dental_Service(this.value);" required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.dental_services_id,
r.dental_services_name
FROM `rsk_dental_services` r where r.dental_services_id in ('1','2')
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["dental_services_id"];?>"><?=$obj_race["dental_services_name"];?></option>

      <?
	}
	?>
                                    </select> 

									   </div>
									   
										<div class="row-clearfix" id="dental_item" style="display:none;">
										<div class="col-md-12">
								                            <div class="demo-checkbox">
                                <input type="checkbox" id="md_checkbox_21" name="dental1" class="filled-in chk-col-red" value="Y"   />
                                <label for="md_checkbox_21">ตรวจสุขภาพช่องปาก</label>
                                <input type="checkbox" id="md_checkbox_22" name="dental2" class="filled-in chk-col-pink" value="Y"   />
                                <label for="md_checkbox_22">อุดฟัน</label>
                                <input type="checkbox" id="md_checkbox_23" name="dental3" class="filled-in chk-col-purple" value="Y"   />
                                <label for="md_checkbox_23">ขูดหินปูน</label>
                                <input type="checkbox" id="md_checkbox_24" name="dental4" class="filled-in chk-col-deep-purple" value="Y"   />
                                <label for="md_checkbox_24">ถอนฟัน</label>
                                <input type="checkbox" id="md_checkbox_25" name="dental5" class="filled-in chk-col-indigo" value="Y"   />
                                <label for="md_checkbox_25">รักษารากฟัน</label>
                                <input type="checkbox" id="md_checkbox_26" name="dental6" class="filled-in chk-col-blue" value="Y"   />
                                <label for="md_checkbox_26">ใส่ฟันปลอม</label>
                                <input type="checkbox" id="md_checkbox_27" name="dental7" class="filled-in chk-col-light-blue" value="Y"   />
                                <label for="md_checkbox_27">ผ่าฟันคุด</label>
                                <input type="checkbox" id="md_checkbox_33" onChange="Check_Dental_Service_Other(this.value);" name="dental_other" class="filled-in chk-col-yellow" value="Y"   />
                                <label for="md_checkbox_33">อื่นๆ</label>
								<div id="dental_item_other" style="display:none;">
							 <input type="text" id="md_checkbox_34" name="dental_other_desc" style="background: #C0F9BD" class="form-control"     />
							 <label for="md_checkbox_34">ระบุุ</label>
							 </div>
                            </div>

									</div>
									   </div>								   
									   </div>
									   
									   							    <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h9['health_assessment_name'] ?></h4>
						<select class="form-control " id="a9" name ="a9"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.smoking_id,
r.smoking_name
FROM `rsk_smoking` r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["smoking_id"];?>"><?=$obj_race["smoking_name"];?></option>

      <?
	}
	?>
                                    </select> 	   
									  
									   </div>
									   </div>
									   
						<div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h10['health_assessment_name'] ?></h4>
							<select class="form-control " id="a10" name ="a10"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.drink_beer_id,
r.drink_beer_name
FROM `rsk_drink_beer` r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["drink_beer_id"];?>"><?=$obj_race["drink_beer_name"];?></option>

      <?
	}
	?>
                                    </select> 	
									   </div>
									   </div>
<!--									   
									   <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h11['health_assessment_name'] ?></h4>
							<select class="form-control " id="a11" name ="a11"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.helmet_id,
r.helmet_name,
r.helmet_score
FROM `rsk_helmet` r

";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["helmet_id"];?>"><?=$obj_race["helmet_name"];?></option>

      <?
	}
	?>
                                    </select> 	
									   </div>
									   </div>
									   
									   									   <div class="row clearfix">
									   <div class="col-md-12">
									   <h4><?=$row_h12['health_assessment_name'] ?></h4>
							<select class="form-control " id="a12" name ="a12"  required="required">
							<option value="">เลือกคำตอบ</option>
																  <?
	$sql_race= "SELECT
r.safety_belt_id,
r.safety_belt_name,
r.safety_belt_score
FROM `rsk_safety_belt`  r
";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["safety_belt_id"];?>"><?=$obj_race["safety_belt_name"];?></option>

      <?
	}
	?>
                                    </select> 	
									   </div>
									   </div> -->
									   


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
				$('#congenital_disease').val(personInfo[0]['congenital_disease']);
				$('#fat_percentage').val(personInfo[0]['fat_percentage']);
				$('#muscle_mass').val(personInfo[0]['muscle_mass']);
				$('#bone_mass').val(personInfo[0]['bone_mass']);
				$('#bmi').val(personInfo[0]['bmi']);
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
				
				<script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datepicker({
                    format: 'LT'
                });
            });
			
				function Check_Dental_Service(val){
		if(val==2){
			document.getElementById("dental_item").style.display = "";
		}else{
			document.getElementById("dental_item").style.display = "none";
			document.getElementById("dental_item").value = "";
		}
	}	
function Check_Dental_Service_Other(val){
		if(val=="Y"){
			document.getElementById("dental_item_other").style.display = "";
		}else{
			document.getElementById("dental_item_other").style.display = "none";
			document.getElementById("dental_item_other").value = "";
		}
	}						
        </script>
				
