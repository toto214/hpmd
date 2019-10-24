<?php
session_start();

if($_SESSION['lalom_cid']!=""){
	session_destroy();
	echo "TRUE";
}else{
	echo "FALSE";
}

?>