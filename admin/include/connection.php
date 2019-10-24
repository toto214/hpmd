<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "12345678";
$dbname = "hpmd_01";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>