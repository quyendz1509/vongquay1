<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';



// Gọi class function sử dụng chung
require '../modules/admin/function.php';

// 

// tạo biến $reset là function
$reset = new classFuncAdmin();

$admins = $reset->infoSettingWeb();
$list_bank = $reset->listBankSupport();
if(isset($_SESSION['id'])){
	$info = $reset->check_account($_SESSION['id']);
	if ($info['rules'] != $admins['role_admin']) {
		header('location: /home.html');
	}else if($info['status'] != 0){
		session_destroy();
		header('location: /home.html');
	}
	else{
		// doanh thu theo ngày
		$doanhthungay =  $reset->tongDoanhThu('day', date('Y-m-d', time())); 
			// doanh thu theo tháng
		$doanhthuthang =  $reset->tongDoanhThu('month', date('m', time())); 
		// Tổng thành viên
		$countMember = $reset->countMember();
		// Tổng sản phẩm
		$countProducts = $reset->countMember('products');
		// Tính tổng tiền nạp hôm nay
		$doanhthuCardToday = $reset->tongDoanhThu('card', date('Y-m-d', time()));
		// Tính tổng tiền nạp THEO THÁNG
		$doanhthuThangNay = $reset->tongDoanhThu('card-thangs', date('m', time()));
		/*
	Doanh thu nạp tiền banks: $banks
	Doanh thu nạp tiền momo: $momo
	Doanh thu nạp tiền thẻ cào: $thecao
	Doanh thu nạp tiền admin cộng tay: $congtay
		*/
	$banks = $reset->doanhThuByType('banks',date('Y-m-d', time()));
	$momo = $reset->doanhThuByType('momo',date('Y-m-d', time()));
	$thecao = $reset->doanhThuByType('thecao',date('Y-m-d', time()));
	$congtay = $reset->doanhThuByType('admin',date('Y-m-d', time()));



	if (isset($_GET['ctrl'])) {
	// tạo biến ctrl
		$ctrl = $_GET['ctrl'];
	// file controller
		$file = 'admin_controller/'.$ctrl.'.php';
		if(!file_exists($file)){
			require 'admin_controller/home.php';
		}else{
			require $file;
		}

	}else{
		require 'admin_controller/home.php';
	}
}
}else{
	header('location: /home.html');
}


?>