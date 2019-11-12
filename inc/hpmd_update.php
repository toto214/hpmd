
		<link type="text/css" href="datepicker_buddhist_year/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker_buddhist_year/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker_buddhist_year/js/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
       

<div class="container-fluid">
 <!-- Advanced Form Example With Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

						 <div class="header">
						  <h3>ข่าวประชาสัมพธ์และอัพเดทเอกสาร </h3>
						 </div>
                        <div class="body">
                         <form name="input" action="index.php?floder=ajax&service=Add_Get_Person" method="POST">
            
                                <fieldset>
                                <div class="form-group form-float">
                                    <div class="row clearfix">
                                            <div class="col-md-3">
                                                <p>
                                                    <b>งาน</b>
                                                </p>
                                                <div class="input-group input-group-lg">                                      
                                                    <div class="form-line">
                                                        <input type="text" id="fname" name="fname" class="form-control" placeholder="" required="required">
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                             
									   <!-- row 2 -->
                                    <div class="row clearfix">
                                            <div class="col-md-12">
                                                <p>
                                                    <b>รายละเอียด</b>
                                                </p>
                                                <div class="input-group input-group-lg">                                      
                                                    <div class="form-line">
                                                        <input type="text" id="fname" name="fname" class="form-control" placeholder="" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- row 3 -->
                                    <div class="row clearfix">
                                            <div class="col-md-6">
                                                <p>
                                                    <b>อัพโหลดเอกสาร</b>
                                                </p>
                                                <div class="input-group input-group-lg">                                      
                                                    <div class="form-line">
                                                        <input type="text" id="fname" name="fname" class="form-control" placeholder="" required="required">
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
  
                            
<button type="submit" class="btn  bg-red waves-effect pull-right"> <i class="material-icons">save</i>บันทึกเพื่อไปข้อถัดไป</button>							
                                     

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
	