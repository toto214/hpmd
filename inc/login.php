  <div class="login-page">
  <div class="login-box">
        <div class="card">
            <div class="body">
               
                    <div class="msg">กรุณาใช้ username และ password จากระบบ smboss</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required >
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" onclick="AjaxLogin();" type="submit">SIGN IN</button>
                        </div>
                    </div>
                <!--    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div> -->
             
            </div>
        </div>
    </div>
    </div>
</div>
 

    
                 
            
<script>
				function AjaxLogin(){
					var username = $("#username").val();
   					var password = $("#password").val();
					if(username !="" && password !="" ){
						$.ajax({
							type: "POST",
							url: "ajax/AjaxLogin.php",
							data: "username="+username
							+"&password="+password,
						
							cache: false,
							success: function(data){
								if(data){
									//alert(data);								
									window.location.href = "index.php?floder=inc&service=main"; 
	
								//window.history.back(1);
								
								
								}else{
									alert("ไม่พบ ชื่อผู้ใช้ หรือรหัสผ่านในฐานข้อมูล ใน ฐานข้อมูล");
									clear();
								}
							}
					   });
					}else{
						alert("กรุณากรอกข้อมูล Username และ Passowd ให้ครบถ้วน");
					}
				}
				function clear(){
					$("#username").val("");
					$("#password").val("");
				}
			</script>