<?php 
session_start();
        if(isset($_POST['username'])){
				//connection
                include("../connect/connect_db.php");
				//รับค่า user & password
                  $username = $_POST['username'];
                  $uassword = $_POST['password'];
				//query 
                  $sql="SELECT * FROM member Where username='".$username."' and password='".$password."' ";

                  $result = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result)==1){

                      $row = mysqli_fetch_array($result);

                      $_SESSION["UserID"] = $row["user_id"];
                      $_SESSION["User"] = $row["first_name"]." ".$row["last_name"];
                      $_SESSION["Userlevel"] = $row["member_type"];
                        
                    
                      if($_SESSION["Userlevel"]=="1"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php

                       echo "TRUE";

                      }


                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";

                  }

        }else{


             Header("Location: form.php"); //user & password incorrect back to login again

        }
              
                    
?>

