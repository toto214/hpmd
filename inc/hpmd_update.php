
<?php
if(!empty($_SESSION['lalom_cid'])){
} else{
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=login>"; 
exit();
} 
$input_type = $_GET['input_type'];
if($input_type==2) {
$input_type_text = "<h4>เลือกการบันทึกผลการวิเคราะห์เครื่องวัดองค์ประกอบร่างกาย (Inner Scan)</h4>";
}else if ($input_type==3) {
$input_type_text = "<h4>เลือกการบันทึกแบบประเมินพฤติกรรมสุขภาพ</h4>";
}
include "ajax/mod11x.php";
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
                        </div>
						 <div class="header">
						  <h3>1.ข้อมูลทั่วไป <?=$input_type_text; ?></h3>
						 </div>
                        <div class="body">
                         <form name="input" action="index.php?floder=ajax&service=Add_Get_Person" method="POST">
						<label for="cid">ค้นหาบุคคลจากหมายเลขบัตรประชาชน</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="cfname">ค้นหาบุคคลจาก ชื่อ - นามสกุล</label>	
						 <div class="row clearfix">
                                <div class="col-md-4">

                                <div class="form-group">
                                    <div class="form-line">
                                    <input name="input_type" type="hidden" value="<?=$input_type; ?>" />
            <input type="text" id="cid" name="cid" class="form-control" onblur="CheckIDCardxxx(cid);" onkeyup="GetPerson();" placeholder="13 หลัก" required="required">
                                    </div>
									 <!-- <input type="button"  class="btn btn-primary"value="GEN หมายเลขบัตร กรณีไม่ทราบเลขบัตร" onclick="GMM();" /> -->
                                </div>
								</div>
	
									
								
                                <div class="col-md-4">
  
                                <div class="form-group">
                                    <div class="form-line">
            <input type="text" id="cfname" name="cfname" class="form-control"  placeholder="ชื่อ - สกุล" >
                                    </div>
                                </div>
								</div>
								
								 <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <button type="button" id="getperson" onclick="GetPerson2();" class="btn bg-indigo waves-effect"><i class="material-icons">check_box</i>
<span>ตรวจสอบจากฐานข้อมูลโดยชื่อ</span></button>
                                    </div>

								</div>

                           
                               
                                <fieldset>
                                    <div class="form-group form-float">
								<div class="row clearfix">
								<div class="col-md-3">
                                    <p>
                                        <b>คำหน้านาม</b>
                                    </p>
                                                           
                                       
                                             <select class="form-control show-tick" id="prename" name="prename" data-live-search="true" required="required">
                                       <option value="">เลือก</option>
																  <?
	$sql_race= "SELECT
c.id_prename,
c.prename,
c.detail
FROM hdc.cprename c WHERE c.id_prename in ('001','002','003','004','005')";
	$query_race = mysqli_query($hdc,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>

       <option  value="<?=$obj_race["id_prename"];?>"><?=$obj_race["prename"];?></option>
      <?
	}
	?>
                                    </select> 
 
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>ชื่อ</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
                                            <input type="text" id="fname" name="fname" class="form-control" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>นามสกุล</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
                                            <input type="text" id="lname" name="lname" class="form-control" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>เพศ</b>
                                 <select class="form-control show-tick" id="sex" name="sex" data-live-search="true" required="required">
                                        <option value="1">ชาย</option>
                                        <option value="2">หญิง</option>
                                    </select> 
                            </div>
							
                                       </div>
									   <!-- row 2 -->
						<div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>วันเกิด</b>
                                    </p>
                                <div class="input-group "> 
                                        <div class="form-group">
                                         <div class="form-line">
                                          <input type="text" class="form-control" size="10" id="birth" name="birth" />
</div>
</div>
 <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        </div>
                                       
                                       
                                    </div>
                    <div class="col-md-5">
                                    <p>
                                        <b>อาชีพ</b>
                                    </p>
                                 <select class="form-control " id="occ" name="occ" data-live-search="true" >
                                       <option value="">เลือก</option>
																  <?
	$sql_race= "SELECT
c.occupationcode,
c.occupationname
FROM coccupation c";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["occupationcode"];?>"><?=$obj_race["occupationname"];?></option>

      <?
	}
	?>
                                    </select> 
                            </div>
                             <div class="col-md-3">
                                    <p>
                                        <b>ประเภท</b>
                                    </p>
                                 <select class="form-control " id="member_type_id" name ="member_type_id" data-live-search="true" required="required">
																  <?
	$sql_race= "SELECT
m.member_type_id,
m.member_type_name
FROM bmi_trends.member_type m #where m.member_type_id in (1)";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
       <option  value="<?=$obj_race["member_type_id"];?>"><?=$obj_race["member_type_name"];?></option>

      <?
	}
	?>
                                    </select> 
                            </div>   
                            
<button type="submit" class="btn  bg-red waves-effect pull-right"> <i class="material-icons">save</i>บันทึกเพื่อไปข้อถัดไป</button>							
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
 			function CheckIDCard(){
			var s = $("#cid").val();
var pin = 0 , j = 13 , pin_num = 0; 
if ( s == ""){
return;
}
var ChkPinID = true;
if( ChkPinID == false ) { return false; }
if( s.length == 13 ) {
for(var i = 0; i < s.length; i++ ) {
if( i != 12 ) {
pin = s.charAt(i) * j + pin;
}
j --;
}
pin_num = ( 11 - ( pin %11 ))%10;
if( s.charAt(12) != pin_num ) {
alert("เลขที่บัตรประจำตัวประชาชนไม่ถูกต้อง กรุณาป้อนเลขที่บัตรประจำตัวประชาชนอีกครั้ง");
clear();
return false;
}
}else{
alert("เลขที่บัตรประจำตัวประชาชนไม่ถูกต้อง กรุณาป้อนเลขที่บัตรประจำตัวประชาชนอีกครั้ง");
clear();
return false;
}
return true;
}
 </script>       
 <script>    

     
 function GetPerson(){
 var cid = $("#cid").val();
		$.ajax({
			type: "POST",
			url: "ajax/AjaxGetPerson.php",
			data: "cid="+cid,
			cache: false,
			success: function(data){
				var personInfo = JSON.parse(data);
				$('#fname').val(personInfo[0]['NAME']);
				$('#lname').val(personInfo[0]['LNAME']);
				$('#sex').val(personInfo[0]['SEX']).change();
				$('#birth').val(personInfo[0]['BIRTH']);
				$('#prename').val(personInfo[0]['PRENAME']).change();
				$('#occ').val(personInfo[0]['OCCUPATION_NEW']).change();
				$('#member_type_id').val(personInfo[0]['member_type_id']).change();
			}
		});
	}
	
	 function GetPerson2(){
 var cfname = $("#cfname").val();
		$.ajax({
			type: "POST",
			url: "ajax/AjaxGetPerson2.php",
			data: "cfname="+cfname,
			cache: false,
			success: function(data){
				var personInfo = JSON.parse(data);
				$('#cid').val(personInfo[0]['CID']);
				$('#fname').val(personInfo[0]['NAME']);
				$('#lname').val(personInfo[0]['LNAME']);
				$('#sex').val(personInfo[0]['SEX']).change();
				$('#birth').val(personInfo[0]['BIRTH']);
				$('#prename').val(personInfo[0]['PRENAME']).change();
				$('#occ').val(personInfo[0]['OCCUPATION_NEW']).change();
				$('#member_type_id').val(personInfo[0]['member_type_id']).change();
			}
		});
	}
    </script>    
 <script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


		    // กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)

		    $("#birth").datepicker({   format: 'yyyy-mm-dd',
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
	