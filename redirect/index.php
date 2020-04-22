<?php
require_once 'function.php';
if(isset($_GET['uid'])){
	$uid = $_GET["uid"] ;
	$file_name_log = "./".date("Ymd").".txt";
	addLog($file_name_log,$uid);
	header("Location: ../landing_page/?uid=".$uid); 
	exit();
}else{
	header("Location: https://www.zurich.co.id"); 
}
?>