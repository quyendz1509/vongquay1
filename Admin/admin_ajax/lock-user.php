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
			$id = htmlspecialchars($_POST['id']);
			$status = htmlspecialchars($_POST['status']);
			
			if ($reset->check_account($id)) {
				$reset->lock_user($status,$id);
			$error  = array('status' => 99, 'messages' => 'Đã khóa tài khoản <strong>'.$id.'</strong> thành công');
			}else{
			$error  = array('status' => 0, 'messages' => 'Không tìm thấy tài khoản.');

			}
		}

	}else{
		$error  = array('status' => 0, 'messages' => 'Cốc cốc ai dẩy ? ');
	}
}

if (isset($error)) {
	print_r(json_encode($error));
 	// code...
}