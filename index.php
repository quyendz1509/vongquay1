<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require 'modules/database.php';

// Gọi class function sử dụng chung
require 'modules/function.php';


// tạo biến $reset là function
$reset = new func();

// setting
$setting = $reset->infoSettingWeb();

if ($setting['trangthai'] != 1) {
	require 'controller/404.php';
}else{

	if(isset($_SESSION['id'])){
		$info = $reset->check_account($_SESSION['id']);
		if (!$info) {
			session_destroy();
			header('location: /home.html');
		}else if($info['status'] != 0){
			session_destroy();
			header('location: /home.html');
		}
	}

	if (isset($_GET['ctrl'])) {
	// tạo biến ctrl
		$ctrl = $_GET['ctrl'];

	// file controller
		$file = 'controller/main.php';
		if(!file_exists($file)){
			require 'controller/home.php';
		}else{
			require $file;
		}

	}else{
		require 'controller/home.php';
	}
}


?>