<?php
$con= mysqli_connect("127.0.0.1","root","12345678","bmi_trends") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET character_set_results=utf8");
mysqli_query($con, "SET ccharacter_set_results=utf8");
mysqli_query($con, "SET character_set_connection=utf8");

$hdc= mysqli_connect("203.157.162.35","root","dbadmin##","hdc") or die("Error: " . mysqli_error($hdc));

mysqli_query($hdc, "SET character_set_results=utf8");
mysqli_query($hdc, "SET ccharacter_set_results=utf8");
mysqli_query($hdc, "SET character_set_connection=utf8");



?>