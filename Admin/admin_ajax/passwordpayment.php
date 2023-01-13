<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../../modules/database.php';

// 
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
			$password = htmlspecialchars($_POST['password']);
			$settings_Banks = $reset->getBankConfig($thongtin['id']);

			if ($password == '') {
				// code...
				$error  = array('status' => 0, 'messages' => 'Không bỏ trống thông tin ');
				
			}else if( !password_verify($password, $settings_Banks['password_hash']) ){
				$error  = array('status' => 0, 'messages' => 'Mật khẩu xác nhận không chính xác.');

			}else{
				$hash_pass = password_hash($password, PASSWORD_BCRYPT, ['cost'=> 10]);
				$result = $reset->updateBanksConfig($hash_pass,$thongtin['id']);
				$_SESSION['passwordpayment'] = $password;
				if ($reuslt == '') {
					$error  = array('status' => 99, 'messages' => 'Đăng nhập thành công. Đang tải lại trang ');

				}else{
					$error  = array('status' => 0, 'messages' => 'Lỗi không xác định. Vui lòng liên hệ admin');

				}

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