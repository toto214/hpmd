<?php
include('phpqrcode/qrlib.php'); 
QRcode::png($_GET['w']);
?>