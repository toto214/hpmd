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
                            <div>
                                <p>ทดสอบระบบ อัพเดทข้อมูลของฝ่ายส่งเสริมฯ</p>
                                 <form action="#" method="POST" autocomplete="off">
                                <div class="alert alert-danger alert-incorrect d-none" role="alert"></div>
                                <?php if(isset($_COOKIE["user_id"])){?>
                                <?php foreach($_COOKIE["user_id"] as $k => $v){?>
                                <div title="<?php echo $v;?>" style="width:99px;display:inline-block;position:relative;cursor:pointer;" class="text-center card-user-cookie card-user-<?php echo $k;?> formlogin" data-key="<?php echo $k;?>" data-username="<?php echo $v;?>">
                                <button type="button" class="close" aria-label="Close" style="position: absolute; right: 14px;" data-toggle="modal" data-target="#deleteModal" data-key="<?php echo $k;?>" data-username="<?php echo $v;?>">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="account_info" data-key="<?php echo $k;?>" data-username="<?php echo $v;?>">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="" width="75" class="img-fluid rounded-circle img-thumbnail">
                                    <?php echo "<p>".$v."</p>";?>
                                </div>
                                </div>   
                                <?php } ?>
                                <?php } ?> 

                                <div title="" style="width:99px;display:inline-block;position:relative;cursor:pointer;" class="text-center  formlogin card-user-choose d-none mx-auto">
                                <button type="button" class="close" aria-label="Close" style="position: absolute; right: 14px;" data-toggle="modal" data-target="#deleteModal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="account_info_choose" >
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="" width="75" class="img-fluid rounded-circle img-thumbnail">
                                    
                                </div>
                                <p style="display:inline-block;margin: 0;"></p> <span class="small notme text-danger">Not Me?</span>
                                </div>  

                                <div class="form-group username">
                                    <div class="input-group">
                                    <input type="text" class="form-control login-input" id="username" name="username" placeholder="Username" value="">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text login-input-group-text" id="btnGroupAddon"><span class="fa fa-user"></span>
                                        </div>
                                    </div>
                                    </div>
                                    <span id="error-username" class="text-danger small"></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                    <input type="password" class="form-control login-input" id="password" name="password" placeholder="Password" value="">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text login-input-group-text" id="btnGroupAddon"><span class="fa fa-lock"></span>
                                        </div>
                                    </div>
                                    </div>
                                    <span id="error-password" class="text-danger small"></span>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="remember" value="1" class="custom-control-input" id="remember">
                                    <label class="custom-control-label small" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-login">Login</button>
                                    <button class="btn btn-primary btn-block d-none btn-loading" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Login...
                                    </button>
                                </div>
                                <!-- <div class="text-center">
                                    <a href="#" class="small">forgot password?</a>
                                </div> -->
                                <!-- <div class="text-center">
                                    <a href="register.php" class="small">Register</a>
                                </div> -->
                                </form>
                            </div>

                        </div>
                    </div>
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