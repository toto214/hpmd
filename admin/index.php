<?php
require_once"include/connection.php";
if(isset($_SESSION["USER_ID"])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminDEMO</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    
</head>
<style>
    body {
        background-color: #eceff4 !important;
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="#">AdminDEMO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                         <?php echo $_SESSION["USERNAME"];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#LogoutModal">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="main-content mt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            Welcome
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form>
                            <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputState">งานกลุ่มวัย</label>
                                <select id="inputState" class="form-control">
                                    <option selected>เลือก</option>
                                    <option>แม่และเด็ก</option>
                                    <option>พัฒนาการเด็ก</option>
                                    <option>วัยเรียน</option>
                                    <option>วัยรุ่น</option>
                                    <option>วัยทำงาน</option>
                                    <option>ผู้สูงอายุ</option>
                                    <option>ผู้พิการ</option>

                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">รายละเอียด</label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="รายละเอียด">
                            </div>

                            <div class="form-row">
                               
                                <div class="input-group">
                                <div class="custom-file col-md-6">
                                <label for="inputZip">ผู้อัพเดท</label>
                                    <input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
                                </div>
                                </div>

                                <div class="form-group col-md-2">
                                <label for="inputZip">ผู้อัพเดท</label>
                                <input type="text" class="form-control" id="inputZip">
                                
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>  <!-- ปิด Card body--> 
                    </div>  <!-- ปิด Card --> 
                </div>
            </div>
        </div>
    </div>



<div id="LogoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Logout ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
          <h1 style="font-size:5.5rem;"><i class="fa fa-sign-out text-danger" aria-hidden="true"></i></h1>
          <p>Are you sure you want to log-out?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>

</body>

</html>

<?php 
}else{
    // header("location:login.php");} 
    include"login.php";
}
?>