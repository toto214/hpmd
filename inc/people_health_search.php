<div class="fp-page bg-light-green">
    <div class="fp-box ">
        <div  align="center">
            <h4>ค้นหาข้อมูลสุขภาพเบื้องต้นของท่าน</h4>
           <!-- <small>Admin BootStrap Based - Material Design</small> -->
        </div>
        <div class="card" >
            <div class="body">
                <form action="index.php?floder=inc&service=people_health_menu" method="POST">
                    <div class="msg">
                       กรุณาระบุหมายเลขบัตรประชาชน 13 หลัก
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="pid" placeholder="" required autofocus>
                        </div>
                    </div>

                    <button class="btn btn-block btn-lg bg-gray waves-effect" type="submit">ค้นหา</button>

                 <!--    <div class="row m-t-20 m-b--5 align-center">
                        <a href="sign-in.html">Sign In!</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>