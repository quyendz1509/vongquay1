<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../../modules/database.php';
// Gọi class function sử dụng chung
require '../../modules/admin/function.php';
//
$reset = new classFuncAdmin();

if (isset($_POST) && $_POST) {
	if (isset($_SESSION['id'])) {
 		// thông tin người dùng...
		$thongtin = $reset->check_account($_SESSION['id']);
 		// quyền 
		$websetting = $reset->infoSettingWeb();
		if ($thongtin['rules'] != $websetting['role_admin']) {
			$error  = array('status' => 0, 'messages' => 'Bạn là ai? không phải admin thì không có quyền đâu nha :D ');
		}else{
	// Xử lý code ở đây nha
			$stk = htmlspecialchars($_POST['stk']);
			$chuthe = htmlspecialchars($_POST['chuthe']);
			$name = htmlspecialchars($_POST['name']);
			$img = htmlspecialchars($_POST['img']);

			if ($name == '' || $stk == '' || $img == '' || $chuthe == '') {
				$error  = array('status' => 0, 'messages' => 'Không được bỏ trống thông tin');
			}else{
				$reset->add_payment($name,$img,$chuthe,$stk);
				$error  = array('status' => 99, 'messages' => 'Thêm thẻ  <strong class="text-success">'.$name.'</strong> thành công !');	
			}

	// Kết thúc xử lý code ở đây nha

		}
	}else{
		$error  = array('status' => 0, 'messages' => 'Cốc cốc ai dẩy ? ');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
 	// code...
}