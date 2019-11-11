<?php
if(!empty($_SESSION['lalom_cid'])){
} else{
echo "<META HTTP-EQUIV=Refresh content=0;URL=index.php?floder=inc&service=login>"; 
exit();
} 

$sql = "SELECT
b.register_id,
b.cid,b.fname,b.lname,
b.pname,concat(p.prename,
b.fname,'  ',
b.lname) fullname,b.sex,
if(b.sex = '1','ชาย','หญิง') sexname,
b.birthdate,
b.member_type_id,
b.username,
b.`password`,
b.last_login,
b.version_usage,
b.profile_link,
b.occupation,c.occupationname,TIMESTAMPDIFF(YEAR,b.birthdate,date(NOW())) age_y,m.member_type_name
FROM bmi_trends.bmi_register_user  b  
LEFT JOIN bmi_trends.cprename  p on b.pname = p.id_prename
left join bmi_trends.coccupation c on b.occupation = c.occupationcode
left join bmi_trends.member_type m on b.member_type_id = m.member_type_id
where b.register_id = '".$_GET['register_id']."'
GROUP BY b.cid";
$query_sql = mysqli_query($con,$sql);
$row_data = mysqli_fetch_array($query_sql);
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
                            <h3>ข้อมูลผู้ลงทะเบียนใช้งาน Application  <u><?=$row_data['fullname']; ?></u></h3>
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
                         <form name="input" action="index.php?floder=ajax&service=Edt_Get_Person" method="POST">
                         <input name="register_id" type="hidden" value="<?=$row_data[register_id]; ?>" />
                               
                                <fieldset>
                                    <div class="form-group form-float">
									<div class="row clearfix">
		<div class="col-md-4">
                                    <p>
                                        <b>USERNAME</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
               <input type="text" id="username" name="username" class="form-control" value="<?=$row_data['username']; ?>" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>PASSWORD</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
             <input type="text" id="password" name="password" class="form-control" placeholder="" value="<?=$row_data['password']; ?>" required="required">
                                        </div>
                                    </div>
                                </div>		
                                <div class="col-md-4">
                                    <p>
                                        <b>เลขบัตรประชาชน</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
             <input type="text" id="cid" name="cid" class="form-control" onblur="CheckIDCard(cid);" placeholder="" value="<?=$row_data['cid']; ?>" required="required">
                                        </div>
                                    </div>
                                </div>									
									</div>
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
 <? if($obj_race["id_prename"]==$row_data["pname"]){  ?>
      <option selected="selected" value="<?=$obj_race["id_prename"];?>"><?=$obj_race["prename"];?></option>
      <? }else { ?>
       <option  value="<?=$obj_race["id_prename"];?>"><?=$obj_race["prename"];?></option>
             <?
	}
	?>
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
                                            <input type="text" id="fname" name="fname" class="form-control" value="<?=$row_data['fname']; ?>" placeholder="" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>นามสกุล</b>
                                    </p>
                                    <div class="input-group input-group-lg">                                      
                                        <div class="form-line">
                                            <input type="text" id="lname" name="lname" class="form-control" placeholder="" value="<?=$row_data['lname']; ?>" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>เพศ</b>
                            <select class="form-control show-tick" id="sex" name="sex" data-live-search="true" required="required">
                                       <option value="">เลือก</option>
																  <?
	$sql_race= "SELECT
s.sex,
s.sexname
FROM hdc.csex  s
";
	$query_race = mysqli_query($hdc,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
 <? if($obj_race["sex"]==$row_data["sex"]){  ?>
      <option selected="selected" value="<?=$obj_race["sex"];?>"><?=$obj_race["sexname"];?></option>
      <? }else { ?>
       <option  value="<?=$obj_race["sex"];?>"><?=$obj_race["sexname"];?></option>
             <?
	}
	?>
      <?
	}
	?>
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
      <input type="text" class="form-control" size="10" id="birthx" value="<?=$row_data['birthdate']?>" name="birth" />
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
FROM hdc.coccupation c";
	$query_race = mysqli_query($hdc,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
		<? if($obj_race["occupationcode"]==$row_data["occupation"]){  ?>
      <option selected="selected" value="<?=$obj_race["occupationcode"];?>"><?=$obj_race["occupationname"];?></option>
      <? }else { ?>
       <option  value="<?=$obj_race["occupationcode"];?>"><?=$obj_race["occupationname"];?></option>
	  <? 
	  } 
	  ?>
      <?
	}
	?>
                                    </select> 
                            </div>
                             <div class="col-md-3">
                                    <p>
                                        <b>ประเภท</b>
                                    </p>
                                 <select class="form-control show-tick" id="member_type_id" name ="member_type_id" data-live-search="true" required="required">
																  <?
	$sql_race= "SELECT
m.member_type_id,
m.member_type_name
FROM bmi_trends.member_type m #where m.member_type_id in (1)";
	$query_race = mysqli_query($con,$sql_race) or die ("Error Query [".$strSQL."]");
	while($obj_race = mysqli_fetch_array($query_race))
	{
	?>
	<? if($obj_race["member_type_id"]==$row_data["member_type_id"]){  ?>
      <option selected="selected" value="<?=$obj_race["member_type_id"];?>"><?=$obj_race["member_type_name"];?></option>
      <? }else { ?>
       <option  value="<?=$obj_race["member_type_id"];?>"><?=$obj_race["member_type_name"];?></option>
      <?
	}
	?>
      <?
	}
	?>
                                    </select> 
                            </div>   
                            
<button type="submit" class="btn  bg-black waves-effect pull-right"> <i class="material-icons">save</i>บันทึก</button>							
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
  <script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


		    // กรณีต้องการใส่ปฏิทินลงไปมากกว่า 1 อันต่อหน้า ก็ให้มาเพิ่ม Code ที่บรรทัดด้านล่างด้วยครับ (1 ชุด = 1 ปฏิทิน)

		    $("#birthx").datepicker({   format: 'yyyy-mm-dd',
                todayBtn: true,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true              //Set เป็นปี พ.ศ.
            }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน});




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