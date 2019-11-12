<!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><? if(!empty($_SESSION['lalom_hospcode'])){  ?> เข้าสู่ระบบโดย<? }else{ ?><? } ?></div>
                    <div class="email"><?=$_SESSION['lalom_fullname']; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                         <!--   <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                            <li role="separator" class="divider"></li> 
                            <li><a href="#" onclick="AjaxLogout();"><i class="material-icons">input</i>ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">เมนูสำหรับประชาชน</li>
                    <li >
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li <?php if(strpos($_GET['service'],'people_health') !== false ){ echo "class='active'";}    ?>>
                        <a href="index.php?floder=inc&service=login">
                            <i class="material-icons" >directions_run</i>
                            <span>ข้อมูลตรวจสุขภาพเบื้องต้น</span>
                        </a>
                    </li>

      <!--             <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Tables</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/normal-tables.html">Normal Tables</a>
                            </li>
                            <li>
                                <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                            </li>
                            <li>
                                <a href="pages/tables/editable-table.html">Editable Tables</a>
                            </li>
                        </ul>
                    </li> -->
                    

                    <li class="header">เมนูสำหรับเจ้าหน้าที่</li>
                    <? if(empty($_SESSION['lalom_hospcode'])){  ?> 
                    <li <?php if(strpos($_GET['service'],'login') !== false ){ echo "class='active'";}    ?>>
                        <a href="index.php?floder=inc&service=login">
                            <i class="material-icons col-red">lock_open</i>
                            <span>เข้าสู่ระบบ</span>
                        </a>
                    </li>
                    <? } else { ?>
                    <li  <?php if(strpos($_GET['input_type'],'2') !== false ){ echo "class='active'";}    ?>>
                        <a href="index.php?floder=inc&service=input_person&input_type=2">
                            <i class="material-icons col-amber">input</i>
                            <span>บันทึกข้อมูลการวิเคราะห์ร่างกาย</span>
                        </a>
                    </li>
					                    <li  <?php if(strpos($_GET['input_type'],'3') !== false ){ echo "class='active'";}    ?>>
                        <a href="index.php?floder=inc&service=input_person&input_type=3">
                            <i class="material-icons col-purple">input</i>
                            <span>บันทึกข้อมูลพฤติกรรมสุขภาพ</span>
                        </a>
                    </li>
			<li <?php if(strpos($_GET['service'],'user_manager') !== false ){ echo "class='active'";}    ?>>
                       <a href="index.php?floder=inc&service=user_manager">
                            <i class="material-icons col-light-blue">group</i>
                            <span>จัดการผู้ใช้งาน APPLICATION</span>
                        </a>
                    </li>
					
				<li <?php if(strpos($_GET['service'],'visit_manager') !== false ){ echo "class='active'";}    ?>>
                       <a href="index.php?floder=inc&service=visit_manager">
                            <i class="material-icons col-deep-orange">receipt</i>
                            <span>จัดการข้อมูลที่บันทึก</span>
                        </a>
                    </li>
					<!--
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li> -->
                    <? } ?>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);">สำนักงานสาธารณสุขจังหวัดบุรีรัมย์</a>.
                </div>
            <!--    <div class="version">
                    <b>Version: </b> 1.0.5
                </div> -->
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <script>
	function AjaxLogout(){
		var logout = confirm("คุณต้องการออกจากระบบใช่หรือไม่");
		if (logout == true) {
			$.ajax({
				type: "POST",
				url: "ajax/AjaxLogout.php",
				cache: false,
				success: function(data){
					if(data){
						window.location.href = "index.php";
					}
				}
			});
		}
	}
</script>
