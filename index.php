<?
@session_start();
ob_start();
include("connect/connect_db.php");
include "connect/thai_date.php";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>กลุ่มงานส่งเสริมสุขภาพ สสจ.บุรีรัมย์</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    
        <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	    <!-- Bootstrap DatePicker Css -->
    <link href="plugins/bootstrap-timepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
        <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    
    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

	    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">



</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>กรุณารอซักครู่...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
        <!-- Top Bar -->
<?php include('header.php'); ?>
    <!-- #Top Bar -->
    
    <!--<section> -->
    <!-- Left Sidebar -->
    <?php include('leftmenu.php'); ?> 
          <!-- #END# Left Sidebar -->
   <!-- </section>-->
    
    <section class="content">
        <div class="container-fluid">
   <?php 
   if($_GET['service']==''){
					include('inc/hpmd_main.php');
				}else {
					if(!@include(''.$_GET['floder'].'/'.$_GET['service'].'.php')){
						include_once("inc/error.php");
										}
										}
   ?>

        </div>

		
        </section>

    
     <!-- Jquery Core Js -->
    <script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
	
					<!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script type="text/javascript" src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script type="text/javascript" src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script type="text/javascript" src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script type="text/javascript" src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script type="text/javascript" src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script  type="text/javascript" src="plugins/raphael/raphael.min.js"></script>
    <script type="text/javascript" src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script type="text/javascript" src="plugins/chartjs/Chart.bundle.js"></script>
	    <!-- Sparkline Chart Plugin Js -->
    <script type="text/javascript" src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
            <!-- Jquery Validation Plugin Css -->
    <script type="text/javascript" src="plugins/jquery-validation/jquery.validate.js"></script>
        <!-- JQuery Steps Plugin Js -->
    <script type="text/javascript" src="plugins/jquery-steps/jquery.steps.js"></script>
        <!-- Waves Effect Plugin Js -->
    <script type="text/javascript" src="plugins/node-waves/waves.js"></script>
		    <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
	

    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script type="text/javascript" src="plugins/flot-charts/jquery.flot.js"></script>
    <script type="text/javascript" src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script type="text/javascript" src="plugins/flot-charts/jquery.flot.time.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <script src="js/pages/index.js"></script>
    <script src="js/pages/forms/form-wizard.js"></script>
   

    

       
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>     



	
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="plugins/bootstrap-timepicker/js/bootstrap-datetimepicker.js"></script>    
	<script src="js/pages/charts/chartjs.js"></script>




	       <script src="js/pages/forms/advanced-form-elements.js"></script>
    <script src="js/demo.js"></script>
	

					

		<script>
		function  checkNumber(elm){
  if(isNaN(elm.value))
		 {
			alert('กรุณากรอกเฉพาะตัวเลขครับ.');
			elm.value = '0';
		 }
}
function check_email(elm){
    var regex_email=/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
    if(!elm.value.match(regex_email)){
        alert('รูปแบบ email ไม่ถูกต้อง');
		elm.value = '';
    }
}
function checkLength(el) {
  if (el.value.length != 6) {
    alert("length must be exactly 6 characters")
	el.value = '';
  }
}
		</script>
</body>
</html>
