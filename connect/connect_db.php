<?php
$con= mysqli_connect("127.0.0.1","root","12345678","hpmd_01") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET character_set_results=utf8");
mysqli_query($con, "SET ccharacter_set_results=utf8");
mysqli_query($con, "SET character_set_connection=utf8");



?>